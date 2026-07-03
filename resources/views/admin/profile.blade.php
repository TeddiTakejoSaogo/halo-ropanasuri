@extends('admin.layouts.app')

@section('title', 'Profil Rumah Sakit')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Profil Rumah Sakit</h1>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Umum</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Nama Rumah Sakit</strong></label>
                        <p>{{ $profile->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Telepon</strong></label>
                        <p>{{ $profile->phone }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Alamat</strong></label>
                    <p>{{ $profile->address }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Email</strong></label>
                    <p>{{ $profile->email }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Deskripsi Singkat</strong></label>
                    <p>{{ $profile->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Logo Rumah Sakit -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Logo</h6>
            </div>
            <div class="card-body text-center">
                @if($profile->logo)
                    <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" class="img-fluid mb-3" style="max-height: 200px;" onerror="this.style.display='none'">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                        <span class="text-muted">No Logo</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Visi</h6>
            </div>
            <div class="card-body">
                <p>{{ $profile->vision }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Misi</h6>
            </div>
            <div class="card-body">
                @if(is_array($profile->mission))
                    <ul class="mb-0">
                        @foreach($profile->mission as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ $profile->mission }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sejarah</h6>
            </div>
            <div class="card-body">
                <p>{{ $profile->history }}</p>
            </div>
        </div>
    </div>
</div>
@endsection