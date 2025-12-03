@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Bookmarks</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
</div>

<table class="table table-bordered">
<thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Item</th>
        <th>Created</th>
    </tr>
</thead>

<tbody>
    @foreach($bookmarks as $b)
    <tr>
        <td>{{ $b->id }}</td>
        <td>{{ $b->user->name }}</td>
        <td>{{ $b->item->title }}</td>
        <td>{{ $b->created_at }}</td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
