<nav class="bottombar navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/applications/index">CHEMSEA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            </ul>
            @auth
                <a class="me-3" style="color: white; text-decoration: none;" href="/users/profile">My Profile</a>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="btn btn-danger mt-lg-0 mt-2 col-lg-auto col-12" href="/logout"
                        style="display: block;">Log
                        out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
