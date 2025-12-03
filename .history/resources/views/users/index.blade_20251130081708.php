@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Users</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Create User</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>
                <a href="{{ route('users.show', $u->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
