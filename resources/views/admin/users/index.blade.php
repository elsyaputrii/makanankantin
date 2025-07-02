@extends('layouts.admin')

@section('title', 'Manajemen Staff')

@section('content')
<div class="container">
    <h1>Manajemen Staff</h1>
    <a href="{{ route('admin.users.create') }}" style="display: inline-block; padding: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Tambah Staff Baru</a>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-top: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-top: 20px; border-radius: 5px;">
            {{ session('error') }}
        </div>
    @endif

    <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="padding: 10px;">No</th>
                <th style="padding: 10px;">Nama</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Role</th>
                <th style="padding: 10px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td style="padding: 10px; text-align: center;">{{ $index + $users->firstItem() }}</td>
                    <td style="padding: 10px;">{{ $user->name }}</td>
                    <td style="padding: 10px;">{{ $user->email }}</td>
                    <td style="padding: 10px;">{{ ucfirst($user->role) }}</td>
                    <td style="padding: 10px; text-align: center;">
                        <a href="{{ route('admin.users.edit', $user->id) }}" style="margin-right: 10px; color: #007bff; text-decoration: none;">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" style="background:none; border:none; color:red; cursor:pointer; padding:0; font-size: 1em;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 10px; text-align: center;">Tidak ada data staff.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</div>
@endsection
