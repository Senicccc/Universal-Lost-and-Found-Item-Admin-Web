@extends('layouts.app')

@section('content')
<h4>Add New Item</h4>

<form action="{{ route('items.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>User ID</label>
        <input type="number" name="user_id" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>City</label>
        <input type="text" name="city" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Province</label>
        <input type="text" name="province" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control">
    </div>

    <div class="mb-3">
        <label>Image URL</label>
        <input type="text" name="image_url" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
