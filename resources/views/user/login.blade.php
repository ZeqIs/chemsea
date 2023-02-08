<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CHEMSEA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/icon" />
    <!-- Favicon of the system !DO NOT REMOVE!-->
    <!-- External styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- External styling ends -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    <!-- JQuery -->
    <script type="text/javascript" src="/resources/js/jquery-3.6.3.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- Alpine Js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Main style css file for all content !DO NOT REMOVE! -->
</head>

<!--Header start-->
<!--This is where all header elements sit including navbar and login modal-->
<header>
    <div class="topbar ps-1 pe-1">
        <p>
            Welcome to Chemical Service Application System (CHEMSEA)
        </p>
    </div>
    <nav class="bottombar navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/applications/index">CHEMSEA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-1">

            </div>
            <div class="col-lg-6 col-md-8 col-sm-10 col-12">
                @include('components.alert')
                <div class="card login-card my-5">
                    <h5 class="card-header">Login</h5>
                    <div class="card-body">
                        <form method="POST" action="/user/authenticate">
                            @csrf
                            <div class="my-3">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your e-mail">
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3" style="text-align: right;">
                                <input type="password" class="form-control" id="login-password" name="password"
                                    placeholder="Enter your password">
                                <a href="#" class="fgt-pw">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn btn-outline-primary col-12">Log in</button>
                        </form>
                    </div>
                </div>
                <p class="mb-2" style="text-align: center; font-size: 5vh; color: #17437d;">New here?</p>
                <a type="button" href="/register" class="btn btn-primary col-12">Create account</a>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-1">

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

<footer>

</footer>

</html>
