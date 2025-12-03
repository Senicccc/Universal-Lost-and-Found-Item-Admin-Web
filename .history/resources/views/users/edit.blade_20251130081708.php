@extends('layouts.app')

@section('content')
<h4>Edit User</h4>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>

    <div class="mb-3">
        <label>Password (leave blank to keep current)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
