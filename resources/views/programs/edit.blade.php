<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="/app.css">
        <script src="/app.js"></script>        
    </head>
    <body>
        <header class="w3-padding">
            <h1 class="w3-text-red">Programs & Instructors Dashboard</h1>

            @auth            
                You are logged in as {{ auth()->user()->name }} | 
                <a href="{{ url('/console/logout') }}">Log Out</a> |
                <a href="{{ url('/console/dashboard') }}">Dashboard</a> |
                <a href="{{ url('/') }}">Website Home Page</a>
            @endauth
            @guest
                <a href="{{ url('/') }}">Return to My Home Page</a>
            @endguest
        </header>

        <hr>

        <section class="w3-padding">
            <h2>Edit Programs: {{$program->title}}</h2>

            @if ($errors -> any())
                @foreach ($errors -> all() as $error)
                    <li class="w3-text-red">{{ $error }}</li>
                @endforeach
            @endif

            <form action="{{ route('programs.update', $program -> id) }}" method="POST"  novalidate class="w3-margin-bottom">
                {{ csrf_field() }}
                @method('PUT')
                <div class="w3-margin-bottom">
                    <label for="title">Title:</label>
                    <input type="text" name="title" placeholder="Title" value="{{ old('title')?? $program->title}}" required>
                    <label for="description">Description:</label>
                    <textarea name="description" placeholder="Description…" required>{{ old('description')?? $program->description }}</textarea>
                    <label for="image">Image:</label>
                    <input type="text" name="image" placeholder="Image URL" value="{{ old('image')?? $program->image }}">
                    <label for="price">Price:</label>
                    <input type="number" name="price" placeholder="Price" value="{{ old('price')?? $program->price }}" required>

                    {{-- <select name="course" id="course">
                        @foreach ($courses as $course )
                            <option value="{{ $course -> id}}">{{ $course -> name }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <button type="submit" class="w3-button w3-green">Edit Program</button>
            </form>
            <a href="{{ route('programs.index')}}">Back to Program List</a>
        </section>
    </body>
</html>