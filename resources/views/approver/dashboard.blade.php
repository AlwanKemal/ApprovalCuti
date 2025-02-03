@extends('auth.auth_layout')

@section('title', 'Dashboard Approver 1')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="mb-3">Pengajuan Cuti Menunggu Persetujuan Anda</h3>

        @if($leaves->isEmpty())
            <p>Tidak ada pengajuan cuti yang menunggu persetujuan.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                        <tr>
                            <td>{{ $leave->user->name }}</td>
                            <td>{{ $leave->start_date }}</td>
                            <td>{{ $leave->end_date }}</td>
                            <td>
                                <form action="{{ route('approver.approve', $leave->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Setujui</button>
                                </form>
                                <form action="{{ route('approver.reject', $leave->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
