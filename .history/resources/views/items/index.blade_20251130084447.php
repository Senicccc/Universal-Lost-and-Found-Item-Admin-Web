@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Found Items List</h4>
    <div>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">Back</a>
        <a href="{{ route('items.create') }}" class="btn btn-primary">+ Add Item</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            
            <th>Title</th>
            <th>City</th>
            <th>Status</th>
            <th>Owner</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="" class="img-thumbnail" style="width:80px; height:auto">
                    @endif
                </td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->city }}</td>
                <td>
                    <span class="badge bg-{{ $item->status == 'unclaimed' ? 'warning' : 'success' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>{{ $item->user->name }}</td>

                <td>
                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-secondary">Edit</a>

                    @if($item->status == 'unclaimed')
                    <form action="{{ route('items.claim', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-success">Mark Claimed</button>
                    </form>
                    @endif

                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
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
