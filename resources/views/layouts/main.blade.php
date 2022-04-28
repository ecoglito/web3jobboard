<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>@yield("title")</title>
</head>
<style>
body{
    background: black;
    color: white;
}

.nav-link {
    color: white;
}

.nav {
    background-color: green;
}

.btn-link {
    color: white
}

.text-green {
    color: green;
}

.bg-green {
    background-color: green;
    text-align: center;
    color: white;
}

.table {
    color: white;
    border: 1px solid green;
}

.table a{
    color: green;
}

.text-red {
    color: red;
}

.horizontal-row {
    display: flex;
    flex-direction: row;    
    gap: 10px;
    padding-top: 5px;
}




</style>

<body>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jobs.index')}}">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('companies.index') }}" class="nav-link">Companies</a>
            </li>
            @if (Auth::check())
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link">Profile</a>
                </li>
               
                <li>
                    <form method="post" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link">Logout</button>
                    </form>
                </li>
                
            @else
                    <li class="nav-item">
                        <a href="{{ route('registration.index') }}" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
             @endif
        </ul>
    
    @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <h1 class="text-center my-5">
        <a href="/" class="text-green">
            Web3 Job-Board
        </a>
    </h1>

    <main>
        @yield("content")
    </main>

</body>
</html>