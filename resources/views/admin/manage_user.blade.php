@extends('auth.auth_layout')

@section('content')
    <h1>Kelola Pengguna</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.updateRole', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="role">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="approver" {{ $user->role == 'approver' ? 'selected' : '' }}>Approver</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <input type="number" name="approver_level" value="{{ $user->approver_level }}" min="1" max="2">
                            <button type="submit">Perbarui Peran</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
