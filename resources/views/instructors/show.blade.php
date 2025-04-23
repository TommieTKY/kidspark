<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KidSpark - Instructors Dashboard</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/app.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
        <script src="/app.js"></script>        
    </head>
    <body class="d-flex flex-column min-vh-100">
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

        <main>
            <div class="container my-5 flex-grow-1">
                <div class="d-flex justify-content-center">
                    <div class="card col-lg-6 shadow-lg rounded-4 p-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-3">
                            @if ($instructor->icon)
                                <img src="{{ asset('storage/' . $instructor->icon) }}" width="80" alt="{{ $instructor->name }}'s Icon">
                            @else
                                <i class="bi bi-person-circle" style="font-size:5rem"></i>
                            @endif
                            </div>
                            <div class="card-body">
                                <h1>{{ $instructor->name }}</h1>
                                <p class="card-text">{{ $instructor->bio }}</p>
                                <p class="card-text">Email: {{ $instructor->email }}</p>
                                <p class="card-text">Teaching Programs:</p>
                                <ul class="list-group mb-3">
                                    @forelse($instructor->programs as $program)
                                        <li class="list-group-item list-group-item-action"><a class="link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('programs.show', $program->id) }}">{{ $program->title }}</a></li>
                                    @empty
                                        <li class="list-group-item">No programs assigned.</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('instructors.index') }}" class="btn btn-secondary">Back to List</a>
                                <a href="{{ route('instructors.edit', $instructor->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this instructor?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-danger text-white p-3 mt-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 KidSpark. All rights reserved.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>