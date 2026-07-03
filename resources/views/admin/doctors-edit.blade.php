@extends('admin.layouts.app')

@section('title', 'Edit Dokter')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Data Dokter</h1>
            <a href="{{ route('admin.doctors') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" id="doctorForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dokter *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name', $doctor->name) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Spesialisasi *</label>
                            <input type="text" name="specialization" class="form-control" 
                                   value="{{ old('specialization', $doctor->specialization) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan *</label>
                            <input type="text" name="education" class="form-control" 
                                   value="{{ old('education', $doctor->education) }}" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengalaman</label>
                            <input type="text" name="experience" class="form-control" 
                                   value="{{ old('experience', $doctor->experience) }}" 
                                   placeholder="Contoh: 10 tahun">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Dokter</label>
                        
                        @if($doctor->photo)
                        <div class="mb-3">
                            <p class="text-muted mb-1">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $doctor->photo) }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="img-thumbnail" width="150">
                            <br>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                        </div>
                        @endif
                        
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        <div id="photoPreview" class="mt-2" style="display: none;">
                            <img id="previewImage" class="img-thumbnail" width="150">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $doctor->description) }}</textarea>
                    </div>
                    <!-- Jadwal Praktek -->
                    <div class="mb-3">
                        <label class="form-label">Jadwal Praktek</label>
                        <div id="schedules-container">
                            @php
                                $schedules = $doctor->schedules;
                                // Jika tidak ada jadwal, buat satu form kosong
                                if($schedules->count() === 0) {
                                    $schedules = [new \App\Models\DoctorSchedule()];
                                }
                            @endphp
                            
                            @foreach($schedules as $index => $schedule)
                            <div class="schedule-item row mb-2">
                                <div class="col-md-4">
                                    <select name="schedules[{{ $index }}][day]" class="form-select" required>
                                        <option value="">Pilih Hari</option>
                                        <option value="monday" {{ old("schedules.$index.day", $schedule->day) == 'monday' ? 'selected' : '' }}>Senin</option>
                                        <option value="tuesday" {{ old("schedules.$index.day", $schedule->day) == 'tuesday' ? 'selected' : '' }}>Selasa</option>
                                        <option value="wednesday" {{ old("schedules.$index.day", $schedule->day) == 'wednesday' ? 'selected' : '' }}>Rabu</option>
                                        <option value="thursday" {{ old("schedules.$index.day", $schedule->day) == 'thursday' ? 'selected' : '' }}>Kamis</option>
                                        <option value="friday" {{ old("schedules.$index.day", $schedule->day) == 'friday' ? 'selected' : '' }}>Jumat</option>
                                        <option value="saturday" {{ old("schedules.$index.day", $schedule->day) == 'saturday' ? 'selected' : '' }}>Sabtu</option>
                                        <option value="sunday" {{ old("schedules.$index.day", $schedule->day) == 'sunday' ? 'selected' : '' }}>Minggu</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="time" name="schedules[{{ $index }}][start_time]" 
                                        class="form-control" 
                                        value="{{ old("schedules.$index.start_time", $schedule->start_time ? date('H:i', strtotime($schedule->start_time)) : '') }}" 
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <input type="time" name="schedules[{{ $index }}][end_time]" 
                                        class="form-control" 
                                        value="{{ old("schedules.$index.end_time", $schedule->end_time ? date('H:i', strtotime($schedule->end_time)) : '') }}" 
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-schedule" 
                                            {{ $schedules->count() <= 1 ? 'style="display:none"' : '' }}>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-schedule">
                            <i class="fas fa-plus"></i> Tambah Jadwal
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $doctor->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ $doctor->status == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Update Dokter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let scheduleCount = {{ $doctor->schedules->count() }};
    if (scheduleCount === 0) scheduleCount = 1;
    
    document.getElementById('add-schedule').addEventListener('click', function() {
        const container = document.getElementById('schedules-container');
        
        const newSchedule = document.createElement('div');
        newSchedule.className = 'schedule-item row mb-2';
        newSchedule.innerHTML = `
            <div class="col-md-4">
                <select name="schedules[${scheduleCount}][day]" class="form-select" required>
                    <option value="">Pilih Hari</option>
                    <option value="monday">Senin</option>
                    <option value="tuesday">Selasa</option>
                    <option value="wednesday">Rabu</option>
                    <option value="thursday">Kamis</option>
                    <option value="friday">Jumat</option>
                    <option value="saturday">Sabtu</option>
                    <option value="sunday">Minggu</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="time" name="schedules[${scheduleCount}][start_time]" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="time" name="schedules[${scheduleCount}][end_time]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-schedule">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newSchedule);
        
        scheduleCount++;
        
        // Show remove buttons for all schedule items
        updateRemoveButtons();
    });
    
    // Event delegation for remove buttons
    document.getElementById('schedules-container').addEventListener('click', function(e) {
        if (e.target.closest('.remove-schedule')) {
            const scheduleItems = document.querySelectorAll('.schedule-item');
            if (scheduleItems.length > 1) {
                e.target.closest('.schedule-item').remove();
                updateRemoveButtons();
            } else {
                alert('Minimal harus ada satu jadwal praktek.');
            }
        }
    });
    
    function updateRemoveButtons() {
        const scheduleItems = document.querySelectorAll('.schedule-item');
        const removeButtons = document.querySelectorAll('.remove-schedule');
        
        if (scheduleItems.length > 1) {
            removeButtons.forEach(btn => {
                btn.style.display = 'block';
            });
        } else {
            removeButtons.forEach(btn => {
                btn.style.display = 'none';
            });
        }
    }
    
    // Initial update
    updateRemoveButtons();
});
</script>

<style>
.schedule-item {
    align-items: center;
}
</style>
@endsection