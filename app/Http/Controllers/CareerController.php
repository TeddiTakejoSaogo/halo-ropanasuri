<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobApplicationRequest;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('department')->where('status', 'Published');

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        $jobs = $query->latest()->paginate(10);
        return view('career.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        if ($job->status !== 'Published') {
            abort(404);
        }
        return view('career.show', compact('job'));
    }

    public function apply(StoreJobApplicationRequest $request, Job $job)
    {
        $path = $request->file('resume')->store('job_applications/cv', 'local');

        $job->applications()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'portfolio_url' => $request->portfolio_url,
            'resume_path' => $path,
            'status' => 'Pending',
        ]);

        return redirect()->route('career.show', $job->id)
                         ->with('success', 'Lamaran Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}
