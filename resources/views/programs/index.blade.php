<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KidSpark - Programs Dashboard</title>

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

        <main class="container mt-4 flex-grow-1">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="d-flex mb-2">
                <h1>Manage Programs</h1>
            </div>
            <a href="{{ route('programs.create')}}" class="btn btn-success mb-4">New Program</a>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($programs as $program)
                    <div class="col">
                        <div class="card h-100">
                            <h1 class="card-header bg-danger-subtle fs-4">{{ $program->title }}</h1>

                            <div class="text-center p-4">
                            @if ($program->image)
                                <img src="{{ asset('storage/' . $program->image) }}" class="card-img-top d-block mx-auto" style="max-height: 12rem; width: auto;" alt="Program Image">
                            @else
                                <i class="bi bi-card-image" style="font-size:6rem"></i>
                            @endif
                            </div>

                            <div class="card-body text-center">
                                <p class="card-text">{{ $program->description }}</p>
                            </div>

                            <div class="card-footer">
                                <small class="text-body-secondary d-flex justify-content-evenly align-items-center gap-2">
                                    <a href="{{ route('programs.show', $program->id) }}" class="btn btn-info btn-sm">Details</a>
                                    <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                                    </form>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach                
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