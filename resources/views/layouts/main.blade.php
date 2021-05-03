<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>@yield('title')</title>
</head>
<body> 
    @if (Auth::check())
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('diary.index') }}">10-min Diary</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(url()->current() === route('diary.index') || url()->current() === route('diary.create') || str_contains(url()->current(), 'edit') || str_contains(url()->current(), 'delete'))
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page">Diaries</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('diary.index') }}">Diaries</a>
                        </li>
                    @endif

                    @if(url()->current() === route('todo.index'))
                        <li class="nav-item">
                            <a class="nav-link active">To-Do</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('todo.index') }}">To-Do</a>
                        </li>
                    @endif

                    @if(url()->current() === route('about'))
                        <li class="nav-item">
                            <a class="nav-link active">About</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                    @endif
                </ul>

                <span class="navbar-text" style="margin-right: 20px">
                    Hello, {{ Auth::user()->name }}
                </span>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
                
            </div>
            </div>
        </nav>
    @endif
    <div class="container mt-3 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            @if (url()->current() === route('diary.create'))
                <li class="breadcrumb-item"><a href="{{ route('diary.index') }}">Diaries</a></li>
                <li class="breadcrumb-item active" aria-current="page">New Diary</li>
            @endif
            @if (str_contains(url()->current(), 'edit'))
                <li class="breadcrumb-item"><a href="{{ route('diary.index') }}">Diaries</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Diary - @yield('date')</li>
            @endif
            @if (str_contains(url()->current(), 'delete'))
                <li class="breadcrumb-item"><a href="{{ route('diary.index') }}">Diaries</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete Diary - @yield('date')</li>
            @endif
            </ol>
        </nav>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <header>
                <h2>@yield('title')</h2>
            </header>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>