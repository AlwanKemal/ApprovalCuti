@extends('auth.auth_layout')

@section('content')
    <h1>Ajukan Cuti</h1>

    <form method="POST" action="{{ route('leave.store') }}">
        @csrf
        <div>
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" required>
        </div>
        <div>
            <label>Tanggal Selesai</label>
            <input type="date" name="end_date" required>
        </div>
        <button type="submit">Ajukan Cuti</button>
    </form>
@endsection
