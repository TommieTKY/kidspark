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

        <div class="container mt-4 flex-grow-1">
            <h2>Edit Program: {{$program->title}}</h2>

            @if ($errors -> any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors -> all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('programs.update', $program -> id) }}" method="POST" novalidate  enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title')?? $program->title}}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea name="description" class="form-control" placeholder="Description…" required>{{ old('description')?? $program->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input
                        type="file" 
                        class="form-control" 
                        name="image"
                        id="image" 
                        accept="image/*"
                    >
                    @if ($program->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $program->image) }}" width="50" alt="Current Image">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price')?? $program->price }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="instructors" class="form-label d-block mb-2">Instructors:</label>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @php
                            $checked = old('instructors', $program->instructors->pluck('id')->toArray());
                        @endphp

                        @foreach($instructors as $instructor)
                            @php
                                $id = 'instructor-' . $instructor->id;
                            @endphp
                                <input
                                    type="checkbox"
                                    class="btn-check"
                                    name="instructors[]"
                                    id="{{ $id }}"
                                    value="{{ $instructor->id }}"
                                    autocomplete="off"
                                    {{ in_array($instructor->id, $checked) ? 'checked' : '' }}
                                >
                                <label class="btn btn-outline-danger" for="{{ $id }}">
                                    {{ $instructor->name }}
                                </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-danger">Update Program</button>
                <a href="{{ route('programs.index') }}" class="btn btn-secondary">Back to Program List</a>
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