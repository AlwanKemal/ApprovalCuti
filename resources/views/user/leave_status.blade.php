@extends('auth.auth_layout')

@section('title', 'Status Cuti')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="mb-3">Status Pengajuan Cuti</h3>

        @if($leaves->isEmpty())
            <p>Saat ini Anda belum mengajukan cuti.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Approver 1</th>
                        <th>Status Approver 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                        <tr>
                            <td>{{ $leave->start_date }}</td>
                            <td>{{ $leave->end_date }}</td>
                            <td>{{ ucfirst($leave->status_approver1) }}</td>
                            <td>{{ ucfirst($leave->status_approver2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary text-white">Kembali</a>
    </div>
</div>
@endsection
