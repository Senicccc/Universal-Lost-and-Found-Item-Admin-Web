@extends('layouts.app')

@section('content')
<h3>Dashboard</h3>
<p>Click box to see details</p>
<hr>

<div class="row">

    <div class="col-md-3 mb-3">
        <a href="{{ route('users.index') }}" class="text-decoration-none text-reset">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2>{{ $total_users }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="{{ route('items.index') }}" class="text-decoration-none text-reset">
            <div class="card text-bg-info">
                <div class="card-body">
                    <h5>Total Items</h5>
                    <h2>{{ $total_items }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="{{ route('items.index') }}" class="text-decoration-none text-reset">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5>Unclaimed Items</h5>
                    <h2>{{ $unclaimed_items }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="{{ route('items.index') }}" class="text-decoration-none text-reset">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5>Claimed Items</h5>
                    <h2>{{ $claimed_items }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="{{ route('bookmarks.index') }}" class="text-decoration-none text-reset">
            <div class="card text-bg-secondary">
                <div class="card-body">
                    <h5>Bookmarks</h5>
                    <h2>{{ $total_bookmarks }}</h2>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="{{ route('logs.index') }}" class="text-decoration-none text-reset">
            <div class="card text-bg-dark">
                <div class="card-body">
                    <h5>Logs</h5>
                    <h2>{{ $total_logs }}</h2>
                </div>
            </div>
        </a>
    </div>

</div>
@endsection
