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

        <div class="container mt-4 flex-grow-1">
            <h2>Add Instructor</h2>

            @if ($errors -> any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors -> all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('instructors.store') }}" method="POST" novalidate  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon:</label>
                    <input 
                        type="file" 
                        class="form-control" 
                        name="icon" 
                        id="icon" 
                        accept="image/*"
                    >
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio:</label>
                    <textarea class="form-control" name="bio" id="bio" rows="3" required>{{ old('bio') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="programs" class="form-label d-block mb-2">Programs:</label>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @php
                            $checked = old('programs', []);
                        @endphp

                        @foreach($programs as $program)
                            @php
                                $id = 'program-' . $program->id;
                            @endphp
                                <input
                                    type="checkbox"
                                    class="btn-check"
                                    name="programs[]"
                                    id="{{ $id }}"
                                    value="{{ $program->id }}"
                                    autocomplete="off"
                                    {{ in_array($program->id, $checked) ? 'checked' : '' }}
                                >
                                <label class="btn btn-outline-danger" for="{{ $id }}">
                                    {{ $program->title }}
                                </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-danger">Add Instructor</button>
                <a href="{{ route('instructors.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>

        <footer class="bg-danger text-white p-3 mt-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 KidSpark. All rights reserved.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>