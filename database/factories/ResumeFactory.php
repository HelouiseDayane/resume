<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ResumeFactory extends Factory
{
    protected $model = Resume::class;

    public function definition()
    {
        $resumeFile     = UploadedFile::fake()->create('resume.pdf', 100, 'application/pdf');
        $resumeFilePath = 'resumes/' . $resumeFile->hashName();

        // Simula o armazenamento do arquivo durante os testes
        Storage::disk('public')->put($resumeFilePath, $resumeFile->getContent());

        return [
            'name'             => $this->faker->name,
            'email'            => $this->faker->safeEmail,
            'phone'            => $this->faker->phoneNumber,
            'desired_position' => $this->faker->jobTitle,
            'education'        => $this->faker->sentence,
            'observations'     => $this->faker->paragraph,
            'resume_file'      => $resumeFilePath,
            'ip'               => $this->faker->ipv4,
        ];
    }
}
