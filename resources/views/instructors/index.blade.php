<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KidSpark - Instructors Dashboard</title>

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
                            <a class="nav-link" href="{{ url('/console/dashboard') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/console/programs') }}">Programs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/console/instructors') }}">Instructors</a>
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
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="d-flex mb-2">
                <h2>Manage Instructors</h2>
            </div>
            <a href="{{ route('instructors.create')}}" class="btn btn-danger">New Instructor</a>
            <div class="row mt-3">
                @foreach($instructors as $instructor)
                    <div class="col-sm-4">
                        <div class="card shadow-lg rounded-4 p-4 mt-4" style="min-height: 420px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    @if ($instructor->icon)
                                        <img src="{{ asset('storage/' . $instructor->icon) }}" width="80" alt="Instructor Icon">
                                    @else
                                        <span>No Icon</span>
                                    @endif
                                </div>
                                <h3 class="card-text text-center">
                                    {{ $instructor->name }}
                                </h3>
                                <div class="card-body text-center">
                                    <p class="card-text">{{ $instructor->email }}</p>
                                    <p class="card-text">{{ $instructor->bio }}</p>
                                    <a href="{{ route('instructors.edit', $instructor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" class="d-inline">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this instructor?')">Delete</button>
                                    </form>
                                    <a href="{{ route('instructors.show', $instructor->id) }}" class="btn btn-info btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>