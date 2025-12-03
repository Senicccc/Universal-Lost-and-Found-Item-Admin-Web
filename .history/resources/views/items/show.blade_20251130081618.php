@extends('layouts.app')

@section('content')
<h4>Item Details</h4>

<div class="mb-3">
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="row">
    <div class="col-md-4">
        @if($item->image_url)
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid img-thumbnail">
        @else
            <div class="border p-4 text-center text-muted">No image</div>
        @endif
    </div>
    <div class="col-md-8">
        <h3>{{ $item->title }}</h3>
        <p><strong>Status:</strong> <span class="badge bg-{{ $item->status=='unclaimed'?'warning':'success' }}">{{ ucfirst($item->status) }}</span></p>
        <p><strong>Location:</strong> {{ $item->city }}, {{ $item->province }}</p>
        <p><strong>Address:</strong> {{ $item->address }}</p>
        <p><strong>Description:</strong></p>
        <p>{{ $item->description }}</p>
    </div>
</div>

@endsection
