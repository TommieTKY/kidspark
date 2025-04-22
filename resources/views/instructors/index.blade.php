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
                <h1>Manage Instructors</h1>
            </div>
            <a href="{{ route('instructors.create')}}" class="btn btn-success mb-4">New Instructor</a>

            <div class="row row-cols-1 row-cols-md-4 g-3">
                @foreach($instructors as $instructor)
                    <div class="col">
                        <div class="card h-100">
                            <h1 class="card-header bg-danger-subtle fs-5">{{ $instructor->name }}</h1>

                            <div class="pt-4 text-center">
                            @if ($instructor->icon)
                                <img src="{{ asset('storage/' . $instructor->icon) }}" class="card-img-top d-block mx-auto" style="max-height: 8rem; width: auto;" alt="Program Image">
                            @else
                                <i class="bi bi-person-circle" style="font-size:5rem"></i>
                            @endif
                            </div>

                            <div class="card-body text-center">
                                <p class="card-text">Teaching Programs:</p>
                                <ul class="mb-3">
                                    @forelse($instructor->programs as $program)
                                        <a href="{{ route('programs.show', $program->id) }}"><span class="badge bg-danger-subtle text-black fw-normal">{{ $program->title }}</span></a>
                                    @empty
                                        <li class="list-group-item">No programs assigned yet.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="card-footer">
                                <small class="text-body-secondary d-flex justify-content-evenly align-items-center gap-2">
                                    <a href="{{ route('instructors.show', $instructor->id) }}" class="btn btn-info btn-sm">Details</a>
                                    <a href="{{ route('instructors.edit', $instructor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" class="d-inline">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this instructor?')">Delete</button>
                                    </form>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>