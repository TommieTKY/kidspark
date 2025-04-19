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

        @if(session()->has('message'))
            <div class="w3-padding w3-margin-top w3-margin-bottom">
                <div class="w3-red w3-center w3-padding">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <section class="w3-padding">
            <h2>Manage Programs</h2>
            <a href="{{ route('programs.create')}}" class="w3-button w3-green">New Program</a>

            <table class="w3-table w3-stripped w3-bordered w3-margin-bottom">
                <tr class="w3-red">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>

                @foreach($programs as $program)
                    <tr>
                        <td>{{ $program->title}}</td>
                        <td>{{ $program->description}}</td>
                        <td>{{ $program->image}}</td>
                        <td>${{ $program->price}}</td>
                        <td><a href="{{ route('programs.edit', $program->id)}}">Edit</a></td>
                        <td>
                            <form action="{{ route('programs.destroy', $program->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </section>
    </body>
</html>