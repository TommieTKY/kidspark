<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KidSpark - Dashboard</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/app.css">
        <script src="/app.js"></script>        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/console/dashboard') }}">KidSpark</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/console/dashboard') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/console/programs') }}">Programs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/console/instructors') }}">Instructors</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <span class="nav-link">Welcome, {{ auth()->user()->name }}</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Website Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/console/logout') }}">Logout</a>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Return to Home Page</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <h1 class="display-6">KidSpark Dashboard</h1>
            <div class="d-flex justify-content-center">
                <div class="row mt-4">
                    <div class="col-sm-4">
                        <div class="card p-4 text-bg-light">
                            <div class="card-body">
                                <h2 class="card-title">Programs Dashboard</h2>
                                <p class="card-text">
                                Centralize all your enrichment offerings in one place—create new programs, update details, assign instructors, and retire old courses with just a few clicks.
                                </p>
                                <a href="/console/programs" class="btn btn-danger">Manage Programs</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card p-4 text-bg-light">
                            <div class="card-body">
                                <h2 class="card-title">Instructors Dashboard</h2>
                                <p class="card-text">
                                View, add, or update instructor profiles. Assign them to programs and keep your teaching team organized and up to date.
                                </p>
                                <a href="/console/instructors" class="btn btn-danger">Manage Instructors</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card p-4 text-bg-light">
                            <div class="card-body">
                                <h2 class="card-title">Users Dashboard</h2>
                                <p class="card-text">
                                View, edit, and control user access. Keep your user database organized and up to date.
                                </p>
                                <a href="/console/users" class="btn btn-danger">Manage Users</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>