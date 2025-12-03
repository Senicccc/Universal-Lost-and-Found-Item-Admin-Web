@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Logs History</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
</div>

<table class="table table-striped table-bordered">
<thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Action</th>
        <th>Created At</th>
    </tr>
</thead>

<tbody>
    @foreach($logs as $log)
    <tr>
        <td>{{ $log->id }}</td>
        <td>{{ $log->user->name ?? '-' }}</td>
        <td>{{ $log->action }}</td>
        <td>{{ $log->created_at }}</td>
    </tr>
    @endforeach
</tbody>
</table>

@endsection
