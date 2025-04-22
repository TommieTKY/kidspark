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
            <div class="container my-5">
                <div class="d-flex justify-content-center">
                    <div class="card col-lg-6 shadow-lg rounded-4 p-4">
                        <div class="card-body">
                            @if ($program->title)
                                <img src="{{ asset('storage/' . $program->image) }}" class="card-img-top" alt="Program Image">
                            @else
                                <span>No Image</span>
                            @endif
                            <div class="card-body">
                                <h1>{{ $program->title }}</h1>
                                <p class="card-text">Description: {{ $program->description }}</p>
                                <p class="card-text">Price: ${{ $program->price }}</p>
                                <p class="card-text">Instructors:</p>
                                <ul class="list-group mb-3">
                                    @forelse($program->instructors as $instructor)
                                        <li class="list-group-item list-group-item-action"><a class="link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('instructors.show', $instructor->id) }}">{{ $instructor->name }}</a></li>
                                    @empty
                                        <li class="list-group-item">No instructors assigned.</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('programs.index') }}" class="btn btn-secondary">Back to List</a>
                                <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>