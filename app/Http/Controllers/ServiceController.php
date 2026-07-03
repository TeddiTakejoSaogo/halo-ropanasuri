<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }

    public function create()
    {
        return view('admin.services-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
            'operational_hours' => 'required|string|max:255',
        ]);

        Service::create($request->only([
            'name',
            'icon',
            'description',
            'operational_hours'
        ]));

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services-edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
            'operational_hours' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->only([
            'name',
            'icon',
            'description',
            'operational_hours'
        ]));

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->status = $service->status === 'active' ? 'inactive' : 'active';
        $service->save();

        return redirect()->back()->with('success', 'Status layanan berhasil diubah.');
    }
}