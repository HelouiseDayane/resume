<?php

namespace Tests\Feature;

use App\Mail\{AdminNotificationMail, UserNotificationMail};
use App\Models\Resume;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\{Mail, Storage};
use Tests\TestCase;

class ResumeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_resume()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('resume.pdf', 100, 'application/pdf');

        $data = [
            'name'             => 'John Doe',
            'email'            => 'john@example.com',
            'phone'            => '123456789',
            'desired_position' => 'Software Developer',
            'education'        => 'Bachelor of Computer Science',
            'observations'     => 'Some observations',
            'resume_file'      => $file,
            'ip'               => '127.0.0.1',
        ];

        $response = $this->postJson('/api/resumes', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'name',
                         'email',
                         'phone',
                         'desired_position',
                         'education',
                         'observations',
                         'resume_file',
                         'ip',
                         'created_at',
                         'updated_at',
                     ],
                 ]);

        $this->assertDatabaseHas('resumes', [
            'name'             => 'John Doe',
            'email'            => 'john@example.com',
            'phone'            => '123456789',
            'desired_position' => 'Software Developer',
            'education'        => 'Bachelor of Computer Science',
            'observations'     => 'Some observations',
            'ip'               => '127.0.0.1',
        ]);

        // Assert the file was stored...
        Storage::disk('public')->assertExists("resumes/{$file->hashName()}");
    }

    /** @test */
    public function test_it_can_get_all_resumes()
    {
        Resume::factory()->count(3)->create();

        $response = $this->getJson('/api/resumes');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'name',
                         'email',
                         'phone',
                         'desired_position',
                         'education',
                         'observations',
                         'resume_file',
                         'ip',
                         'created_at',
                         'updated_at',
                     ],
                 ]);
    }

    /** @test */
    public function it_can_get_a_single_resume()
    {
        $resume = Resume::factory()->create();

        $response = $this->getJson("/api/resumes/{$resume->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => $resume->toArray(),
                 ]);
    }

    /** @test */
    public function it_can_delete_a_resume()
    {
        $resume = Resume::factory()->create();

        $response = $this->deleteJson("/api/resumes/{$resume->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('resumes', ['id' => $resume->id]);
    }

    /** @test */
    public function emails_are_sent_on_resume_creation()
    {
        Mail::fake();

        Storage::fake('public');

        $file = UploadedFile::fake()->create('resume.pdf', 100, 'application/pdf');

        $resumeData = [
            'name'             => 'John Doe',
            'email'            => 'john@example.com',
            'phone'            => '123456789',
            'desired_position' => 'Software Developer',
            'education'        => 'Bachelor of Computer Science',
            'observations'     => 'Some observations',
            'resume_file'      => $file,
            'ip'               => '127.0.0.1',
        ];

        $response = $this->postJson('/api/resumes', $resumeData);

        $response->assertStatus(201);

        Mail::assertSent(UserNotificationMail::class, function ($mail) use ($resumeData) {
            return $mail->hasTo($resumeData['email']);
        });

        Mail::assertSent(AdminNotificationMail::class, function ($mail) {
            return $mail->hasTo('seuemail@email.com');
        });
    }
}
