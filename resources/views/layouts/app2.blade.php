<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

    <title>@yield('title', config('app.name', 'Laravel'))</title>
</head>

<body>
    <div class="body-layout">
        <nav class="navbar-expand-lg navbar ">
            {{-- <nav class="navbar navbar-expand-lg navbar" style="background-color: #2c99e7;"> --}}
            <div class="container-fluid">
                <a class="navbar-brand text-white ms-5" href="{{ route('landing') }}">
                    <svg height="60px" width="40px" version="1.1" id="logo_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                        <path style="fill:#93C7EF;"
                            d="M222.312,336.366l-43.813-45.11l169.244-164.379c9.159-9.991,13.964-22.928,13.537-36.498
	                    c-0.313-9.984-3.43-19.449-8.944-27.495h-66.493V0h93.151l9.074,8.522c22.299,20.941,35.105,49.311,36.064,79.884
	                    c0.957,30.573-10.047,59.69-30.988,81.987l-1.012,1.03L222.312,336.366z" />
                        <path style="fill:#C9E3F7;"
                            d="M223.607,336.366L52.772,170.395C9.543,124.367,11.821,51.752,57.848,8.522L66.924,0h93.151v62.885
	                    H93.597c-13.24,19.39-11.882,46.035,4.58,63.994l169.244,164.377L223.607,336.366z" />
                        <path style="fill:#D80027;"
                            d="M386.066,318.433v64.85c0,36.3-29.532,65.832-65.832,65.832s-65.832-29.532-65.832-65.832v-78.085
	                    l55.211-53.623l-43.813-45.11l-42.84,41.609l-42.835-41.604l-43.813,45.11l55.206,53.619v78.085
	                    c0,70.975,57.742,128.717,128.717,128.717s128.717-57.742,128.717-128.717v-64.85L386.066,318.433L386.066,318.433z" />
                        <path style="fill:#A2001D;"
                            d="M386.066,318.433v64.85c0,36.3-29.532,65.832-65.832,65.832s-65.832-29.532-65.832-65.832v110.551
	                    C273.678,505.356,296.192,512,320.234,512c70.975,0,128.717-57.742,128.717-128.717v-64.85H386.066z" />
                        <circle style="fill:#93C7EF;" cx="419.472" cy="331.213" r="70.745" />
                        <polygon style="fill:#A2001D;"
                            points="254.402,305.198 309.613,251.574 265.8,206.464 254.402,217.535 " />
                        <circle style="fill:#5A8BB0;" cx="419.472" cy="331.213" r="39.303" />
                    </svg>

                    <span class="ms-1">
                        <h4 class="d-inline">Covid 19 Hospital</h4>
                    </span>
                </a>
            </div>
            <div class="d-flex">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav fs-5 fw-bold gap-2 me-3 text-white">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="{{ route('landing') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hospital.index') }}">Hospitals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctor.index') }}">Doctors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('test.index') }}">Tests</a>
                        </li>
                        @if (auth()->check())
                            <li class="nav-item dropdown ">
                                <div class="btn btn-primary nav-button dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/icon/user.png') }}" alt="" width="30px">
                                </div>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li class="dropdown-item">{{ auth()->user()->name }}</li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mt-2">Logout</button>
                                </form>
                            </li> --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')

    </div>
    <footer class="footer mt-auto py-3 bg-light text-center">
        <div class="container m-auto">
            <span class="text-muted">&copy; {{ now()->year }} Covid 19 Hospital</span>
        </div>
    </footer>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
    @yield('scripts')

</body>

</html>
