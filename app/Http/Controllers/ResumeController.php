<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Mail\{AdminNotificationMail, UserNotificationMail};
use App\Models\Resume;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Resume::all();

        return response()->json($resumes);
    }

    public function store(StoreResumeRequest $request)
    {
        $validatedData = $request->validated();

        $existingResume = Resume::where('name', $validatedData['name'])
                             ->where('email', $validatedData['email'])
                             ->where('created_at', '>=', Carbon::now()->subMonths(6))
                             ->exists();

        if ($existingResume) {
            return response()->json(['message' => 'Já existe um currículo deste usuário inserido nos últimos 6 meses.'], 422);
        }

        if ($request->hasFile('resume_file')) {
            $file                         = $request->file('resume_file');
            $path                         = $file->store('resumes', 'public');
            $validatedData['resume_file'] = $path;
        }

        $resume = Resume::create($validatedData);
        Mail::to($resume->email)->send(new UserNotificationMail($resume));

        // Coloque aqui seu email caso queira testar
        Mail::to('seuemail@email.com')->send(new AdminNotificationMail($resume));

        return new ResumeResource($resume);
    }

    public function show($id)
    {
        $resume                      = Resume::findOrFail($id);
        $resumeData                  = new ResumeResource($resume);
        $resumeData->resume_file_url = asset('storage/' . $resume->resume_file);

        return $resumeData;
    }

    public function destroy($id)
    {
        $resume = Resume::findOrFail($id);
        $resume->delete();

        return response()->json(null, 204);
    }
}
