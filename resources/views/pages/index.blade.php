<!DOCTYPE html>
<html lang="en">

<head>
    <title>SikaJob - Platformes d'emplois</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="CédoDev">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Platformes d'emplois et de petit boulot pour étudiants et jeûnes diplomés">

    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
        }

        const setTheme = function(theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if (el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendor/OverlayScrollbars-master/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendor/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendor/glightbox-master/dist/css/glightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/dropzone/dist/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flatpickr/dist/flatpickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/plyr/plyr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/zuck.js/dist/zuck.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- .............................. FONT AWESOME CDN .............................. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-GMKQ4P9YMZ"></script> --}}
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GMKQ4P9YMZ');
    </script>

</head>

<body>

    <!-- =======================Header START -->
    <header class="navbar-light fixed-top header-static bg-mode">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img class="light-mode-item navbar-brand-item" src="{{ asset('assets/images/logo.svg') }}"
                        alt="logo">
                    <img class="dark-mode-item navbar-brand-item" src="{{ asset('assets/images/logo.svg') }}"
                        alt="logo">
                </a>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto icon-md btn btn-light p-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-animation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- Main navbar START -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Nav Search START -->
                    <div class="nav mt-3 mt-lg-0 flex-nowrap align-items-center px-4 px-lg-0">
                        <div class="nav-item w-100">
                            <form action="{{ route('index') }}" method="GET" class="rounded position-relative ms-5">
                                <input name="search" id="search" class="form-control ps-5 bg-light" type="search"
                                    placeholder="Recherche (ex: développeur, Dakar, CDI...)" aria-label="Search">
                                <button
                                    class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y"
                                    type="submit"><i class="fa fa-search fs-5"> </i></button>
                            </form>
                        </div>
                    </div>


                    <!-- Nav Search END -->

                    <!-- User non inscrit ou connectée verras ceci --->
                    <ul class="navbar-nav navbar-nav-scroll ms-auto">
                        <!-- Nav item 1 Demos -->
                        <li class="nav-item dropdown">
                            <h1><a href="{{ route('index') }}" class="nav-link active"
                                    style="font-size: 15px">Accueil</a></h1>
                        </li>

                        <!-- Nav item 2 Post -->
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="postMenu" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Compte</a>
                                <ul class="dropdown-menu" aria-labelledby="postMenu">
                                    <!-- dropdown submenu open left -->
                                    <li class="dropdown-submenu dropstart">
                                        <a class="dropdown-item dropdown-toggle" href="#"
                                            style="font-size: 15px">Authentification</a>
                                        <ul class="dropdown-menu dropdown-menu-end" data-bs-popper="none">
                                            <li> <a class="dropdown-item" href="{{ route('login') }}"
                                                    style="font-size: 15px">Connexion</a>
                                            </li>
                                            <li> <a class="dropdown-item" href="{{ route('register.view') }} "
                                                    style="font-size: 15px">Inscription</a> </li>
                                            {{-- <li> <a class="dropdown-item" href="forgot-password.html">Forgot password</a> </li> --}}
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
                <!-- Main navbar END -->

                <!-- Nav right START utilisateurs connecté verras ceci-->
                <ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
                    @auth
                        <li class="nav-item ms-2">
                            <a class="nav-link bg-light icon-md btn btn-light p-0" href="{{ route('settings') }}">
                                <i class="fa fa-gear -fill fs-6"> </i>
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link bg-light icon-md btn btn-light p-0" href="{{ route('notifications') }}">
                                <i class="fa fa-bell -fill fs-6"> </i>
                            </a>
                        </li>
                        <!-- Notification dropdown END -->
                        <!-- Profile dropdown Stars -->
                        <li class="nav-item ms-3 dropdown">
                            <a class="nav-link btn icon-md p-0" href="#" id="profileDropdown" role="button"
                                data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img class="avatar-img rounded-2"
                                    src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }}"
                                    alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3"
                                aria-labelledby="profileDropdown">
                                <!-- Profile info -->
                                <li class="px-3">
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Avatar -->
                                        <div class="avatar me-3">
                                            <img class="avatar-img rounded-circle"
                                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }}"
                                                alt="">
                                        </div>
                                        <div>
                                            <a class="h6 stretched-link" href="#">{{ Auth::user()->name }}
                                                {{ Auth::user()->prenom }}</a>
                                            <p class="small m-0">{{ Auth::user()->metiers }}</p>
                                            <p class="small m-0">{{ Auth::user()->role }}</p>
                                        </div>
                                    </div>
                                    <a class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center"
                                        href="{{ route('my-profile') }}">Voir profile</a>
                                </li>
                                <!-- Links -->
                                <li><a class="dropdown-item" href="{{ route('settings') }}"><i
                                            class="fa fa-gear fa-fw me-2"></i>Paramètre & Vie Privée</a></li>

                                <li class="dropdown-divider"></li>
                                <li>
                                    @csrf
                                    <a class="dropdown-item bg-danger-soft-hover" href="{{ route('logout') }}"><i
                                            class="fa fa-power-off fa-fw me-2"></i>Déconnexion</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <!-- Dark mode options START -->
                                <li>
                                    <div
                                        class="modeswitch-item theme-icon-active d-flex justify-content-center gap-3 align-items-center p-2 pb-0">
                                        <span>Mode:</span>
                                        <button type="button" class="btn btn-modeswitch nav-link text-primary-hover mb-0"
                                            data-bs-theme-value="light" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-sun fa-fw mode-switch"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                                                <use href="#"></use>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-modeswitch nav-link text-primary-hover mb-0"
                                            data-bs-theme-value="dark" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z" />
                                                <path
                                                    d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
                                                <use href="#"></use>
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="btn btn-modeswitch nav-link text-primary-hover mb-0 active"
                                            data-bs-theme-value="auto" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-circle-half fa-fw mode-switch"
                                                viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                                                <use href="#"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                                <!-- Dark mode options END-->
                            </ul>
                        </li>
                    @endauth
                    <!-- Profile START -->

                </ul>
                <!-- Nav right END -->
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- =======================Header END -->

    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- Container START -->
        <div class="container">
            <div class="row g-4">
                <!-- Sidenav START -->
                <div class="col-lg-3">
                    <!-- Advanced filter responsive toggler START -->
                    <div class="d-flex align-items-center d-lg-none">
                        <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
                            <span class="btn btn-primary"><i class="fa-solid fa-sliders-h"></i></span>
                            <span class="h6 mb-0 fw-bold d-lg-none ms-2">Profile</span>
                        </button>
                    </div>
                    <!-- Advanced filter responsive toggler END -->

                    <!-- Navbar START-->
                    @auth
                        <nav class="navbar navbar-expand-lg mx-0">
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
                                <!-- Offcanvas header -->
                                <div class="offcanvas-header">
                                    <button type="button" class="btn-close text-reset ms-auto"
                                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <!-- Offcanvas body Profil-->
                                <div class="offcanvas-body d-block px-2 px-lg-0">
                                    <!-- Card START -->
                                    <div class="card overflow-hidden">
                                        <!-- Cover image Profil-->
                                        <div class="h-50px"
                                            style=" background-position: center; background-size: cover; background-repeat: no-repeat;">
                                        </div>
                                        <!-- Card body Profil START -->
                                        <div class="card-body pt-5">
                                            <div class="text-center">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-lg mt-n5 mb-3 h-150px w-150px">
                                                    <a href="#!"><img class="avatar-img border border-white border-2"
                                                            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }} "
                                                            alt="">
                                                    </a>
                                                </div>
                                                <!-- Info -->
                                                <h4 class="mb-0"> <a href="">{{ Auth::user()->name }}
                                                        {{ Auth::user()->prenom }}</a>
                                                    @if ($user->role === 'Recruteur')
                                                        <i class="fa fa-check-circle -fill text-success small"></i>
                                                    @endif
                                                </h4>

                                                <h5>{{ Auth::user()->metiers }}</h5>
                                                <h6>{{ Auth::user()->role }}</h6>
                                                <p class="mt-3">{{ Auth::user()->about }}</p>
                                            </div>

                                            <!-- Divider -->
                                            <hr>

                                            <!-- Side Nav START -->
                                            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('index') }}"> <img
                                                            class="me-2 h-20px w-30px fa-fw"
                                                            src="{{ asset('assets/images/icon/home-outline-filled.svg') }}"
                                                            alt="">
                                                        <span>Feed </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('notifications') }}"> <img
                                                            class="me-2 h-20px w-30px fa-fw"
                                                            src="{{ asset('assets/images/icon/notification-outlined-filled.svg') }}"
                                                            alt="">
                                                        <span>Candidatures </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('settings') }}"> <img
                                                            class="me-2 h-20px w-30px fa-fw"
                                                            src="{{ asset('assets/images/icon/cog-outline-filled.svg') }}"
                                                            alt="">
                                                        <span>Paramètre </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Side Nav END -->
                                        </div>
                                        <!-- Card body END -->
                                        <!-- Card footer -->
                                        <div class="card-footer text-center py-2">
                                            <a class="btn btn-link btn-sm" href="{{ route('profil.user', $user->id) }} ">
                                                <h6>Voir Profile</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Card END -->

                                    <!-- Helper link START -->
                                    <ul class="nav small mt-4 justify-content-center lh-1">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('index') }}">Apropos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('settings') }}">Paramètre</a>
                                        </li>
                                    </ul>
                                    <!-- Helper link END -->
                                </div>
                            </div>
                        </nav>
                    @endauth
                    <!-- Navbar END-->
                </div>
                <!-- Sidenav END -->


                <div class="col-md-8 col-lg-6 vstack gap-4">
                    <!-- Textarea pour la publication, text, image, video -->
                    @if (Auth::check() && Auth::user()->role === 'Recruteur')
                        <div class="card card-body">
                            <div class="d-flex mb-3">
                                <!-- Avatar -->
                                <div class="avatar avatar-xs me-2">
                                    <a href="#">
                                        <img class="avatar-img rounded-circle"
                                            src="{{ Auth::check() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }}"
                                            alt="">
                                    </a>
                                </div>
                                <!-- Post input -->
                                <form method="POST" action="{{ route('publication.store') }}"
                                    enctype="multipart/form-data" class="w-100">
                                    @csrf
                                    <textarea class="form-control pe-4 border-0" rows="2" data-autoresize="" id="publication" name="content"
                                        placeholder="Publication..."></textarea>

                                    <button type="submit" class="btn btn-success-soft m-2 l-15">Publier</button>
                                </form>
                            </div>
                            <!-- Share feed toolbar START -->

                            <!-- Share feed toolbar END -->
                        </div>
                    @endif

                    <!-- Card feed item START -->
                    <div id="publicationContainer">
                        @forelse ($publications as $publication)
                            <div class="card">
                                <!-- Card header START -->
                                <div class="card-header border-0 pb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">

                                            <!-- Avatar -->
                                            <div class="avatar me-2">
                                                <a href="{{ route('profile.show', $publication->user->id) }}">
                                                    <img class="avatar-img rounded-circle"
                                                        src="{{ $publication->user->photo ? asset('storage/' . $publication->user->photo) : asset('path/to/default-image.jpg') }}"
                                                        alt="">
                                                </a>
                                            </div>

                                            <!-- Info -->
                                            <div>
                                                <div class="nav nav-divider">
                                                    <!-- nom -->
                                                    <h6 class="nav-item card-title mb-0">
                                                        <a href="{{ route('profil.user', $publication->user->id) }}">
                                                            {{ $publication->user->name }}
                                                            {{ $publication->user->prenom }}
                                                            @if ($publication->user->role === 'Recruteur')
                                                                <i
                                                                    class="fa fa-check-circle -fill text-success small"></i>
                                                            @endif
                                                        </a>
                                                    </h6>
                                                    <!-- heure -->
                                                    <span
                                                        class="nav-item small">{{ $publication->created_at->diffForHumans() }}</span>
                                                </div>
                                                <!-- metier -->
                                                <p class="mb-0 small">{{ $publication->user->metiers }}</p>
                                            </div>
                                        </div>
                                        <!-- Card feed action dropdown START -->
                                        <div class="dropdown">
                                            <a href="#"
                                                class="text-secondary btn btn-secondary-soft-hover py-1 px-2"
                                                id="cardFeedAction" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis"></i>
                                            </a>
                                            <!-- Card feed action dropdown menu -->
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="cardFeedAction">
                                                @auth
                                                    @if (Auth::check() && Auth::user()->role === 'Recruteur')
                                                        <li>
                                                            <button class="dropdown-item text-danger"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $publication->id }}').submit();">
                                                                <i class="fa fa-trash fa-fw pe-2"></i>Supprimer
                                                            </button>

                                                            <form id="delete-form-{{ $publication->id }}"
                                                                action="{{ route('publications.destroy', $publication->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </li>
                                                    @endif

                                                    @if (Auth::check() && Auth::user()->role === 'Candidat')
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('publication.show', $publication->id) }}">
                                                                <i class="fa fa-paper-plane fa-fw pe-2"></i>Postuler à
                                                                cette
                                                                offre
                                                            </a>
                                                        </li>

                                                        <form method="POST" action="">
                                                            <li>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal" data-bs-target="#reportModal">
                                                                    <i class="fa fa-ban fa-fw pe-2"></i>Signaler
                                                                </a>
                                                            </li>
                                                        </form>
                                                    @endif
                                                @endauth
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="copyToClipboard(event, '{{ url()->current() }}')">
                                                        <i class="fa fa-link fa-fw pe-2"></i>Copier lien
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Card feed action dropdown END -->
                                    </div>
                                </div>
                                <!-- Card header END -->
                                <!-- Modal de Signalement -->
                                <div class="modal fade" id="reportModal" tabindex="-1"
                                    aria-labelledby="reportModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                                    <form method="POST" action="{{ route('signaler', ['name' => $publication->user->name]) }}">
                                                @csrf
                                                <input type="hidden" name="recruteur_name" value="{{ $publication->user->name }}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Signaler ce compte</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="motif" class="form-label">Raison du signalement
                                                        :</label>
                                                    <textarea class="form-control" name="motif" id="motif" rows="3" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-danger">Signaler</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                </div>

                                <!-- Card body START -->
                                <div class="card-body">
                                    <!-- Contenu texte -->
                                    <p class="publication-text">
                                        <span
                                            class="short-text">{{ Str::limit($publication->content, 80, '...') }}</span>
                                        <span class="full-text"
                                            style="display: none">{{ $publication->content }}</span>
                                        @if (strlen($publication->content) > 10)
                                            <a href="#" class="toggle-text"
                                                onclick="toggleText(this); return false;">(plus)</a>
                                        @endif
                                    </p>

                                    <!-- Bouton like -->
                                    <div class="mt-3">
                                        <form action="" method="POST">
                                            @csrf
                                            <ul class="nav nav-stack">
                                                <li class="nav-item">
                                                    @php
                                                        $likers = [];

                                                        if (
                                                            $publication->relationLoaded('likes') &&
                                                            $publication->likes
                                                        ) {
                                                            $likers = $publication->likes
                                                                ->map(function ($like) {
                                                                    return optional($like->user)->name;
                                                                })
                                                                ->filter()
                                                                ->toArray();
                                                        }
                                                    @endphp
                                                    <button class="nav-link like-button {{ $publication->liked }}"
                                                        type="button" data-post-id="{{ $publication->id }}"
                                                        data-bs-container="body" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-html="true"
                                                        data-bs-custom-class="tooltip-text-start"
                                                        data-bs-title="{{ count($likers) > 0 ? implode('<br>', $likers) : "Personne n'a encore liké ce post" }}">
                                                        <i class="fa fa-thumbs-up pe-1"
                                                            style="{{ $publication->liked ? 'color: #007bff' : '' }}"></i>
                                                        <span
                                                            class="like-count">{{ $publication->likes()->count() }}</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                                <!-- Card body END -->
                            </div>
                            <hr>
                        @empty
                        @endforelse
                    </div>
                    <!-- Card feed item START -->
                    <div class="card">
                        <!-- Card body START People you may know(Recruteurs)-->
                        @if (Auth::check() && Auth::user()->role === 'Candidat')
                            @foreach ($recruteurs as $recruteur)
                            <div class="card-header d-flex justify-content-between align-items-center border-0 pb-0">
                                <h6 class="card-title mb-0">Recruteurs à connaître</h6>
                                <a href="{{ route('rec_cad') }}" class="btn btn-sm btn-primary-soft"> Voir plus </a>
                            </div>
                                <!-- Card body START -->
                                <div class="card-body">
                                    <div class="arrow-hover">
                                        <div class="ms-n4" data-arrow="true" data-dots="false"
                                            data-items-xl="3" data-items-lg="2" data-items-md="2" data-items-sm="2"
                                            data-items-xs="1" data-gutter="12" data-edge="30">
                                            <!-- Boucle sur les recruteurs -->
                                            <!-- Slider items -->
                                            <div>
                                                <!-- Card add friend item START -->
                                                <div class="card shadow-none text-center">
                                                    <!-- Card body -->
                                                    <div class="card-body p-2 pb-0">
                                                        <div class="avatar avatar-xl">
                                                            <a href="">
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ $recruteur->photo ? asset('storage/' . $recruteur->photo) : asset('path/to/default-image.jpg') }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <h6 class="card-title mb-1 mt-3">
                                                            <a href=""> {{-- {{ route('profil.user', $publication->user->id) }} --}}
                                                                {{ $recruteur->name }} {{ $recruteur->prenom }}
                                                                @if ($recruteur->role === 'Recruteur')
                                                                    <i
                                                                        class="fa fa-check-circle -fill text-success small"></i>
                                                                @endif
                                                            </a>
                                                        </h6>
                                                        <h6 class="mb-1 small lh-sm">{{ $recruteur->metiers }}</h6>
                                                        <p class="mb-0 small lh-sm">{{ $recruteur->role }}</p>
                                                    </div>
                                                    <!-- Card footer -->
                                                    <div class="card-footer p-2 border-0">
                                                        <a href="{{ route('profil.user', $recruteur->id) }}"
                                                            class="btn btn-sm btn-primary-soft w-100"> Voir Profil
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- Card add friend item END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card body END -->
                            @endforeach
                        @endif

                        <!-- Card body START People you may know(Candidat)-->
                        @if (Auth::check() && Auth::user()->role === 'Recruteur')
                            @foreach ($candidats as $candidat)
                            <div class="card-header d-flex justify-content-between align-items-center border-0 pb-0">
                                <h6 class="card-title mb-0">Candidats à connaître</h6>
                                <a href="{{ route('rec_cad') }}" class="btn btn-sm btn-primary-soft"> Voir plus </a>
                            </div>
                                <!-- Card body START -->
                                <div class="card-body">
                                    <div class="arrow-hover">
                                        <div class="ms-n4" data-arrow="true" data-dots="false"
                                            data-items-xl="3" data-items-lg="2" data-items-md="2" data-items-sm="2"
                                            data-items-xs="1" data-gutter="12" data-edge="30">
                                            <!-- Boucle sur les candidats -->

                                            <!-- Slider items -->
                                            <div>
                                                <!-- Card add friend item START -->
                                                <div class="card shadow-none text-center">
                                                    <!-- Card body -->
                                                    <div class="card-body p-2 pb-0">
                                                        <div class="avatar avatar-xl">
                                                            <a href="">
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ $candidat->photo ? asset('storage/' . $candidat->photo) : asset('path/to/default-image.jpg') }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <h6 class="card-title mb-1 mt-3">
                                                            <a href=""> {{-- {{ route('profil.user', $publication->user->id) }} --}}
                                                                {{ $candidat->name }} {{ $candidat->prenom }} </a>
                                                            <h6 class="mb-1 small lh-sm">{{ $candidat->metiers }}
                                                            </h6>
                                                            <p class="mb-0 small lh-sm">{{ $candidat->role }}</p>

                                                    </div>
                                                    <!-- Card footer -->
                                                    <div class="card-footer p-2 border-0">
                                                        <a href="{{ route('profil.user', $candidat->id) }}"
                                                            class="btn btn-sm btn-primary-soft w-100"> Voir Profil
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- Card add friend item END -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card body END -->
                            @endforeach
                        @endif
                    </div>

                    @foreach ($recommandations as $publication)
                    <div class="card card-body">
                        <div class="d-flex mb-3">
                            <!-- Avatar -->
                            <div class="avatar avatar-xs me-2">
                                <a href="#">
                                    <img class="avatar-img rounded-circle"
                                        src="{{ Auth::check() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                            <!-- Post input -->
                            <form method="POST" action="{{ route('publication.store') }}"
                                enctype="multipart/form-data" class="w-100">
                                @csrf
                                <textarea class="form-control pe-4 border-0" rows="2" data-autoresize="" id="publication" name="content"
                                    placeholder="Publication..."></textarea>

                                <button type="submit" class="btn btn-success-soft m-2 l-15">Publier</button>
                            </form>
                        </div>
                        <!-- Share feed toolbar START -->

                        <!-- Share feed toolbar END -->
                    </div>
                    @endforeach

                    <div id="scrollLoader" class="text-center my-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                    </div>
                    <!-- Load more button END -->

                    <!-- Message de fin -->
                    <div id="noMoreMessage" class="alert alert-warning text-center mt-3" style="display: none;">
                        Il n’y a plus de publications à afficher.
                    </div>
                </div>
                <!-- Main content END  -->
            </div> <!-- Row END -->
        </div>
        <!-- Container END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- Modal create Feed START créer publication-->
    <!-- Modal create Feed photo START -->
    <div class="modal fade" id="feedActionPhoto" tabindex="-1" aria-labelledby="feedActionPhotoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">


                <!-- Modal feed body START -->
                <div class="modal-body">
                    <!-- Add Feed -->
                    <form method="POST" action="{{ route('publication.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex mb-3">
                            <!-- Avatar -->
                            <div class="avatar avatar-xs me-2">
                                <img class="avatar-img rounded-circle"
                                    src="{{ Auth::check() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }}"
                                    alt="">
                            </div>
                            <!-- Feed box  -->
                            <div class="w-100">
                                <textarea class="form-control pe-4 fs-3 lh-1 border-0" rows="2" name="content" placeholder="Publication..."></textarea>
                            </div>
                        </div>
                        <!-- Modal feed footer -->
                        <div class="modal-footer">
                            <!-- Button -->
                            <button type="button" class="btn btn-danger-soft me-2"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success-soft">Publier</button>
                        </div>
                    </form>
                </div>
                <!-- Modal feed body END -->
            </div>
        </div>
    </div>
    <!-- Modal create Feed photo END -->

    <!-- =======================JS libraries, plugins and custom scripts -->

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/vendor/OverlayScrollbars-master/js/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox-master/dist/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/plyr/plyr.js') }}"></script>
    <script src="{{ asset('assets/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/zuck.js/dist/zuck.min.js') }}"></script>
    <script src="{{ asset('assets/js/zuck-stories.js') }}"></script>

    <!-- Theme Functions -->
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="{{ asset('script.js') }}"></script>
    <script>
        //script pour les like
        document.addEventListener("DOMContentLoaded", function() {
        const likeButtons = document.querySelectorAll(".like-button");
        likeButtons.forEach(button => {
            button.addEventListener("click", function() {
                const postId = this.dataset.postId;
                const likeCountElement = this.querySelector(".like-count");
                const icon = this.querySelector("i");

                fetch("{{ route('publication.like') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            publication_id: postId
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Erreur lors de la requête");
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.liked) {
                            icon.style.color = "#007bff";
                            button.classList.add("liked");
                        } else {
                            icon.style.color = "";
                            button.classList.remove("liked");
                        }

                        likeCountElement.textContent = data.likesCount;

                        // Mise à jour du tooltip
                        if (button.hasAttribute("data-bs-title")) {
                            const tooltip = bootstrap.Tooltip.getInstance(button);
                            if (tooltip) tooltip.dispose();

                            const names = data.usernames?.length ?
                                data.usernames.join('<br>') :
                                "Personne n'a encore liké ce post";

                            button.setAttribute("data-bs-title", names);
                            new bootstrap.Tooltip(button);
                        }
                    })
                    .catch(error => {
                        console.error("Erreur lors du like :", error);
                    });
            });
        });
    });

        //Script pour voir plus moins si le text est long
        function toggleText(link) {
            const container = link.closest('.publication-text');
            const shortText = container.querySelector('.short-text');
            const fullText = container.querySelector('.full-text');

            const isExpanded = fullText.style.display === 'inline';

            if (isExpanded) {
                fullText.style.display = 'none';
                shortText.style.display = 'inline';
                link.textContent = '(plus)';
            } else {
                fullText.style.display = 'inline';
                shortText.style.display = 'none';
                link.textContent = '(moins)';
            }
        }

        // Fonction pour charger plus de publications
        let offset = {{ count($publications) }};
        const limit = 10;
        let isLoading = false;
        let noMoreData = false;

        const publicationContainer = document.getElementById("publicationContainer");
        const scrollLoader = document.getElementById("scrollLoader");
        const noMoreMessage = document.getElementById("noMoreMessage");

        function loadMorePublications() {
            if (isLoading || noMoreData) return;

            isLoading = true;
            scrollLoader.style.display = "block";

            fetch(`/load-more-publications?offset=${offset}&limit=${limit}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(pub => {
                            const div = document.createElement("div");
                            div.classList.add("card", "mb-2", "p-3");
                            div.innerText = pub.content;
                            publicationContainer.appendChild(div);
                        });

                        offset += data.length;
                    }

                    if (data.length < limit) {
                        noMoreData = true;
                        noMoreMessage.style.display = "block";
                        setTimeout(() => {
                            noMoreMessage.style.display = "none";
                        }, 10000);
                    }

                    scrollLoader.style.display = "none";
                    isLoading = false;
                })
                .catch(error => {
                    console.error("Erreur lors du chargement des publications :", error);
                    scrollLoader.style.display = "none";
                    isLoading = false;
                });
        }
        // Détection du bas de page
        window.addEventListener("scroll", () => {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                loadMorePublications();
            }
        });

        //Fonction pour copier les liens
        function copyToClipboard(event, url) {
            event.preventDefault();
            navigator.clipboard.writeText(url).then(() => {
                alert("Lien copié !");
            }).catch(err => {
                console.error("Erreur lors de la copie : ", err);
            });
        };
    </script>


</body>

</html>
