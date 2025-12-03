<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ULaF Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f4f6f8; }
        .app-header { background:#1f2d3d; color:#fff }
        .app-card { background:#ffffff; border-radius:6px; box-shadow:0 2px 6px rgba(31,45,61,0.08); padding:20px }
    </style>
</head>
<body>

<header class="app-header py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">ULaF Admin Panel</h3>
            <small class="text-muted">Manage found items, users, bookmarks and logs</small>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
        </div>
    </div>
</header>

<main class="py-4">
    <div class="container">
        <div class="app-card">
            @yield('content')
        </div>
    </div>
    
</main>

</body>
</html>
