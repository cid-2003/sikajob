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
                    <img class="light-mode-item navbar-brand-item" src="{{asset('assets/images/logo.svg')}}" alt="logo">
                    <img class="dark-mode-item navbar-brand-item" src="{{asset('assets/images/logo.svg')}}" alt="logo">
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
                                    placeholder="Recherche..." aria-label="Search">
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
                            <h1><a href="{{ route('index') }}" class="nav-link active" style="font-size: 15px">Accueil</a></h1>
                        </li>

                        <!-- Nav item 2 Post -->
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="postMenu" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Compte</a>
                                <ul class="dropdown-menu" aria-labelledby="postMenu">
                                    <!-- dropdown submenu open left -->
                                    <li class="dropdown-submenu dropstart">
                                        <a class="dropdown-item dropdown-toggle" href="#" style="font-size: 15px">Authentification</a>
                                        <ul class="dropdown-menu dropdown-menu-end" data-bs-popper="none">
                                            <li> <a class="dropdown-item" href="{{ route('login') }}" style="font-size: 15px">Connexion</a>
                                            </li>
                                            <li> <a class="dropdown-item"
                                                    href="{{ route('register.view') }} " style="font-size: 15px">Inscription</a> </li>
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
                                                    <a href="#!"><img
                                                            class="avatar-img border border-white border-2"
                                                            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }} "
                                                            alt=""></a>
                                                </div>
                                                <!-- Info -->
                                                <h4 class="mb-0"> <a href="">{{ Auth::user()->name }}
                                                        {{ Auth::user()->prenom }}</a> </h4>
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
                                                            src="{{asset('assets/images/icon/home-outline-filled.svg')}}"
                                                            alt=""><span>Feed </span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('notifications') }}"> <img
                                                            class="me-2 h-20px w-30px fa-fw"
                                                            src="{{asset('assets/images/icon/notification-outlined-filled.svg')}}"
                                                            alt=""><span>Candidatures </span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('settings') }}"> <img
                                                            class="me-2 h-20px w-30px fa-fw"
                                                            src="{{asset('assets/images/icon/cog-outline-filled.svg')}}"
                                                            alt=""><span>Paramètre </span></a>
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
                <!-- Page pour postuler a une offre (publication)-->
                <div class="col-md-8 col-lg-6 vstack gap-4">
                    <div class="container">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <!-- Avatar -->
                                        <div class="avatar me-2">
                                            <a href="#!">
                                                <img class="avatar-img rounded-circle"
                                                    src="{{ $publication->user->photo ? asset('storage/' . $publication->user->photo) : asset('path/to/default-image.jpg') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <!-- Info -->
                                        <div>
                                            <div class="nav nav-divider">
                                                <!-- Nom -->
                                                <h6 class="nav-item card-title mb-0">
                                                    <a href="#!">
                                                        {{$publication->user->name }}
                                                        {{$publication->user->prenom  }}
                                                    </a>
                                                </h6>
                                                <!-- Heure -->
                                                <span
                                                    class="nav-item small">{{ $publication->created_at->diffForHumans() }}</span>
                                            </div>
                                            <!-- Métier -->
                                            <p class="mb-0 small">{{ $publication->user->metiers }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card header END -->

                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Contenu texte -->
                                <p>{{ $publication->content ?? '' }}</p>
                                <!-- Image -->
                                @if (isset($publication->img) && $publication->img)
                                    <div class="mt-3">
                                        <a href="{{ asset('storage/' . $publication->img) }}" data-glightbox
                                            data-gallery="image-popup">
                                            <img class="rounded img-fluid w-100"
                                                src="{{ asset('storage/' . $publication->img) }}"
                                                alt="Image publication">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <!-- Card body END -->
                        </div>

                        <!-- Formulaire de candidature -->
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Postuler à cette offre</h5>
                                <form method="POST"
                                    action="{{ route('postule', ['id' => $publication->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- CV Upload (PDF/DOC) -->
                                    <div class="col-12">
                                        <label class="form-label">CV (PDF, DOC, DOCX)</label>
                                        <input type="file" class="form-control" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                        <small class="text-muted">Téléversez votre CV</small>
                                    </div>
                                    <!-- Lettre de motivation -->
                                    <div class="mb-3">
                                        <label class="form-label">Lettre de motivation</label>
                                        <textarea class="form-control" id="letter" name="letter" rows="6"
                                            placeholder="Écrivez votre lettre de motivation ici..." required></textarea>
                                    </div>
                                    <!-- Bouton de soumission -->
                                    <form id="candidatureForm" method="POST" action="{{ route('candidature.store') }}">
                                        @csrf
                                    <button type="submit" class="btn btn-primary-soft">Envoyer la
                                        candidature</button>
                                    </form>
                                    <div id="message" class="mt-3"></div>
                                </form>
                                <!-- Affichage du message -->
                                @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main content END  -->

            </div> <!-- Row END -->
        </div>
        <!-- Container END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->


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
    <script src="{{ ('script.js') }}"></script>

    <script>
     


    </script>


</body>

</html>
