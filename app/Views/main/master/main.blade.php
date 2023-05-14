<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Windz Learnig</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <script src="https://kit.fontawesome.com/1d954ea888.js"></script>
    @yield('css')
</head>

<body>
    <div id="app">
        @include('main.master.sidebar')
        <nav class="navbar navbar-expand-md bg-body-tertiary shadow-sm bg-body-tertiary rounded">
            <div class=" container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <p class="nav-link text-primary">
                                <i class="fas fa-user"></i>
                                {{ session()->get('user')->name }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('page-heading')</h3>
            </div>
            <div class="page-content">
                @yield('page-content')
            </div>
            @include('main.master.footer')
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('js')
</body>

</html>