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

        <div class="container mt-4">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="d-flex mb-2">
                <h2>Manage Programs</h2>
            </div>
            <div class="d-flex mb-4">
                <a href="{{ route('programs.create')}}" class="btn btn-success">New Program</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-danger">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $program)
                            <tr>
                            <td>{{ $program->title}}</td>
                            <td>{{ $program->description}}</td>
                            <td>{{ $program->image}}</td>
                            <td>${{ $program->price}}</td>
                            <td>
                                <a href="{{ route('programs.edit', $program->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>