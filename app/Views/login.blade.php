<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Windz Learning</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <style>
        #auth #auth-right {
            background-color: white !important;
            background: url('{{ asset("assets/images/gedungpens.png") }}') no-repeat center center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.884)),
            url('{{ asset("assets/images/gedungpens.png") }}');
            background-size: cover;
        }
    </style>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="img-fluid" style="max-width: 100px; margin-top: 10px; margin-left: 10px;">
                        <a href="/"><img src="https://upload.wikimedia.org/wikipedia/id/4/44/Logo_PENS.png"
                                class="img-fluid" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> {{ session()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('login.post') }}" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="email" name="email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault"
                                name="remember">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>