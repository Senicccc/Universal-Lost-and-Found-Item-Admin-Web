@extends('layouts.app')

@section('content')
<h4>User Details</h4>

<table class="table table-bordered">
    <tr><th>ID</th><td>{{ $user->id }}</td></tr>
    <tr><th>Name</th><td>{{ $user->name }}</td></tr>
    <tr><th>Email</th><td>{{ $user->email }}</td></tr>
    <tr><th>Created At</th><td>{{ $user->created_at }}</td></tr>
</table>

<a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
@endsection
