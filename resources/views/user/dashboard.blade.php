@extends('auth.auth_layout')

@section('title', 'Dashboard User')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="mb-3">Selamat Datang, {{ auth()->user()->name }}!</h3>
        <p>Silakan pilih tindakan berikut:</p>
        <a href="{{ route('leave.create') }}" class="btn btn-primary mb-2 text-white">Ajukan Cuti</a>
        <a href="{{ route('leave.status') }}" class="btn btn-secondary text-white">Lihat Status Cuti</a>
    </div>
</div>
@endsection
