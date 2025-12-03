@extends('layouts.app')

@section('content')
<h4>Edit Item</h4>

<form action="{{ route('items.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required>{{ $item->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="{{ $item->city }}" required>
    </div>

    <div class="mb-3">
        <label>Province</label>
        <input type="text" name="province" class="form-control" value="{{ $item->province }}" required>
    </div>

    <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="{{ $item->address }}">
    </div>

    <div class="mb-3">
        <label>Image URL</label>
        <input type="text" name="image_url" class="form-control" value="{{ $item->image_url }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
