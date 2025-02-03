@extends('auth.auth_layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="mb-3">Kelola Pengguna</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Divisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->division ? $user->division->name : 'Tidak Ada' }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">Edit</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Role & Divisi - {{ $user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.updateRole', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="approver1" {{ $user->role == 'approver1' ? 'selected' : '' }}>Approver 1</option>
                                                <option value="approver2" {{ $user->role == 'approver2' ? 'selected' : '' }}>Approver 2</option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="division_id" class="form-label">Divisi</label>
                                            <select name="division_id" class="form-control">
                                                <option value="">Tidak Ada</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card p-4 shadow mt-4">
        <h3 class="mb-3">Tambah Divisi</h3>
        <form action="{{ route('admin.addDivision') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Divisi</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Divisi</button>
        </form>
    </div>
</div>
@endsection
