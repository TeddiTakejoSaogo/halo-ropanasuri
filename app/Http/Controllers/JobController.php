<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('department')->latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.jobs.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'responsibilities' => 'required|string',
            'job_type' => 'required|in:Full-time,Part-time,Contract,Internship',
            'location' => 'required|string|max:255',
            'status' => 'required|in:Draft,Published,Closed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('jobs', 'public');
        }

        Job::create($validated);
        return redirect()->route('admin.jobs.index')->with('success', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    public function edit(Job $job)
    {
        $departments = Department::all();
        return view('admin.jobs.edit', compact('job', 'departments'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'responsibilities' => 'required|string',
            'job_type' => 'required|in:Full-time,Part-time,Contract,Internship',
            'location' => 'required|string|max:255',
            'status' => 'required|in:Draft,Published,Closed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($job->image_path) {
                Storage::disk('public')->delete($job->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('jobs', 'public');
        }

        $job->update($validated);
        return redirect()->route('admin.jobs.index')->with('success', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy(Job $job)
    {
        if ($job->image_path) {
            Storage::disk('public')->delete($job->image_path);
        }
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }
}
