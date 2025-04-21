<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KidSpark - Programs Dashboard</title>

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
                            <a class="nav-link active" href="{{ url('/console/programs') }}">Programs</a>
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

        <main>
            <h1>{{ $program->title }}</h1>
            <p>{{ $program->description }}</p>
            <p>{{ $program->image }}</p>
            <p>{{ $program->price }}</p>
            <ul>
                @forelse($program->instructors as $instructor)
                    <li>{{ $instructor->name }}</li>
                @empty
                    <li>No instructors assigned.</li>
                @endforelse
            </ul>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>