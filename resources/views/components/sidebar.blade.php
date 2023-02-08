<nav class="navbar navbar-expand-md ">
    <div class="navbar-collapse collapse" id="ch-side-nav">
        <ul class="navbar-nav mx-md-2 mt-md-5">
            <li class="nav-item side-nav-item">
                <a class="btn btn-success mb-2" href="/applications/create" role="button">New Application</a>
            </li>
            <li class="nav-item side-nav-item ">
                <a class="btn sn-btn sn-primary-btn mb-2" href="/applications/index">My
                    Applications</a>
            </li>
            <li class="nav-item side-nav-item">
                <a class="btn sn-btn sn-primary-btn mb-2" href="/requests/index">My
                    Reports</a>
            </li>
            @auth
                @if (Auth::user()->scientist == 1)
                    </li>
                    <li class="nav-item side-nav-item ">
                        <a class="btn sn-btn sn-primary-btn mb-2" href="/scientist/applications">Application List</a>
                    </li>
                    <li class="nav-item side-nav-item">
                        <a class="btn sn-btn sn-primary-btn mb-2" href="/scientist/requests">Requests List</a>
                    </li>
                @endif
            @endauth
        </ul>
    </div>
    <button class="navbar-toggler sidebar-toggle btn col m-0 p-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#ch-side-nav" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
            class="bi bi-chevron-double-down sidebar-collapsed" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd"
                d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
            class="bi bi-chevron-double-up sidebar-expanded" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708l6-6z" />
            <path fill-rule="evenodd"
                d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />
        </svg>
    </button>
</nav>
