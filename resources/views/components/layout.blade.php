<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CHEMSEA - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/icon" />
    <!-- Favicon of the system !DO NOT REMOVE!-->

    <!-- External styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/dt-1.13.1/b-2.3.3/fh-3.3.1/r-2.4.0/datatables.min.css" />
    <!-- External styling ends -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- Alpine Js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- DataTable Import -->
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/dt-1.13.1/b-2.3.3/fh-3.3.1/r-2.4.0/datatables.min.js"></script>

    <!-- Main style css file for all content !DO NOT REMOVE! -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
</head>

<body>
    <div class="skipper"></div>

    <!-- Topbar -->
    <div class="topbar ps-1 pe-1">
        <p>
            Welcome to Chemical Service Application System (CHEMSEA)
        </p>
    </div>

    <!-- Bottombar -->
    @yield('bottombar')

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">

            <!-- Side Navigation Starts-->

            <div class="col-md-2">
                @if (View::hasSection('sidebar'))
                    @yield('sidebar')
                @endif
            </div>

            <!-- Side Navigation Ends-->

            <div class="col-md-8 col-sm-12">
                @include('components.alert')
                <div class="card login-card my-3 my-md-5">

                    <h5 class="card-header">@yield('card-title')</h5>
                    <div class="card-body">
                        @yield('content')
                    </div>

                </div>
            </div>

            <div class="col-md-2">

            </div>
        </div>

    </div>

    @if (View::hasSection('footer'))
        @yield('footer')
    @endif
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @if (View::hasSection('script'))
        @yield('script')
    @endif

</body>

</html>
