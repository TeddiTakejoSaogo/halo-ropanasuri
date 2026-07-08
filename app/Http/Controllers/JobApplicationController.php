<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index(Job $job)
    {
        $applications = $job->applications()->latest()->get();
        return view('admin.jobs.applications.index', compact('job', 'applications'));
    }

    public function downloadCv(JobApplication $application)
    {
        if (!Storage::disk('local')->exists($application->resume_path)) {
            return back()->with('error', 'File CV tidak ditemukan.');
        }

        return Storage::disk('local')->download($application->resume_path);
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Reviewed,Interview,Hired,Rejected'
        ]);

        $application->update(['status' => $validated['status']]);

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
