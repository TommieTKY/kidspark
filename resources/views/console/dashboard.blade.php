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

            <?php if(Auth::check()): ?>
                You are logged in as <?= auth()->user()->name ?> | 
                <a href="/console/logout">Log Out</a> | 
                <a href="/console/dashboard">Dashboard</a> | 
                <a href="/">Website Home Page</a>
            <?php else: ?>
                <a href="/">Return to My Home Page</a>
            <?php endif; ?>

        </header>

        <hr>

        <section class="w3-padding">
            <ul id="dashboard">
                <li><a href="/console/programs">Manage Programs</a></li>
                <li><a href="/console/instructors/list">Manage Instructors</a></li>
                <li><a href="/console/users/list">Manage Users</a></li>
                <li><a href="/console/logout">Log Out</a></li>
            </ul>
        </section>

    </body>
</html>