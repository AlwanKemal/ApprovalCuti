@extends('auth.auth_layout')

@section('title', 'Ajukan Cuti')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="mb-3">Form Pengajuan Cuti</h3>

        <form action="{{ route('leave.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary text-white">Kembali</a>
        </form>
    </div>
</div>
@endsection
