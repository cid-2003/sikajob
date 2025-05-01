<!DOCTYPE html>
<html lang="en">

<head>
    <title>Platformes d'emplois</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="CédoDev">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/dropzone/dist/dropzone.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendor/glightbox-master/dist/css/glightbox.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendor/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- .............................. FONT AWESOME CDN .............................. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
                <!-- Main content START -->
                <div class="col-lg-8 vstack gap-4">
                    <!-- My profile START -->
                    <div class="card">
                        <!-- Cover image -->
                        <div class="h-200px rounded-top"></div>
                        <!-- Card body START -->
                        <div class="card-body py-0">
                            <div class="d-sm-flex align-items-start text-center text-sm-start">
                                <div>
                                    <!-- Avatar -->
                                    <div class="avatar avatar-xxl mt-n5 mb-3 h-150px w-150px">
                                        <img class="avatar-img border border-white border-2 "
                                            src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('path/to/default-image.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="ms-sm-4 mt-sm-3">
                                    <!-- Info Si récruteurs avec badge sinon sans badge-->
                                    <h1 class="mb-0 h3"> {{ $user->name }} {{ $user->prenom }}

                                        @if ($user->role === 'Recruteur')
                                            <i class="fa fa-check-circle -fill text-success small"></i>
                                        @endif

                                    </h1>
                                    <!-- metiers -->
                                    <p>{{ ucfirst($user->role) }} </p>
                                </div>
                                <!-- Button -->
                                @if (Auth::id() === $user->id)
                                    <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                                        <a href="{{ route('settings') }}"><button class="btn btn-danger-soft me-2"
                                                type="button"><i class="fa fa-pencil -fill pe-1"></i> Modifier Profil
                                            </button></a>
                                    </div>
                                @endif
                            </div>
                            <!-- List profile -->
                            <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                <!-- Métiers -->
                                <li class="list-inline-item"><i class="fa fa-briefcase me-1"></i>
                                    {{ $user->metiers }} </li>
                                <!-- Pays -->
                                <li class="list-inline-item"><i class="fa fa-geo-alt me-1"></i> {{ $user->country }}
                                </li>
                            </ul>
                        </div>
                        <!-- Card body END -->
                        <div class="card-footer mt-3 pt-2 pb-0">
                            <!-- Nav profile pages -->
                            <ul
                                class="nav nav-bottom-line align-items-center justify-content-center justify-content-md-start mb-0 border-0">
                                <li class="nav-item"> <a class="nav-link active" href="{{ route('my-profile') }}">
                                        Publication </a> </li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('index') }}"> Accueil </a>
                                </li>
                                @if (Auth::id() === $user->id)
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('settings') }}">
                                            Paramètre</a> </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- My profile END -->

                    @if (Auth::check() && Auth::user()->role === 'Recruteur')
                        @forelse ($publications as $publication)
                            <div class="card">
                                <!-- Card header START -->
                                <div class="card-header border-0 pb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <!-- Avatar -->
                                            <div class="avatar me-2">
                                                <a href="#!">
                                                    <img class="avatar-img rounded-circle"
                                                        src="{{ $publication->user->photo ? asset('storage/' . $publication->user->photo) : asset('path/to/default-image.jpg') }}"
                                                        alt="">
                                            </div>
                                            <!-- Info -->
                                            <div>
                                                <div class="nav nav-divider">
                                                    <!-- nom -->
                                                    <h6 class="nav-item card-title mb-0">
                                                        <a href="{{ route('profile.show', $publication->user->id) }}">
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
                                                                cette offre
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

                                <div class="card-body">
                                    <!-- Contenu texte -->
                                    <p class="publication-text">
                                        <span
                                            class="short-text">{{ Str::limit($publication->content, 10, '...') }}</span>
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
                                                                    return optional($likers->user)->name;
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
                                                        data-bs-title="{{ count($likers) > 0 ? implode('<br>', $likers->user) : "Personne n'a encore liké ce post" }}">
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
                            </div>
                        @endforeach
                    @endif
                    
                    {{-- Pub liké --}}
                        @forelse ($likedPublications as $publication)
                          @if ($publication->user_id !== $profil->id)
                            <div class="card">
                                <!-- Card header START -->
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
                                                    <!-- nom -->
                                                    <h6 class="nav-item card-title mb-0">
                                                        <a href="{{ route('profile.show', $publication->user->id) }}">
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
                                                                cette offre
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
                                            <form method="POST" action="{{ route('signaler', ['name' => $profil->name]) }}">
                                                @csrf
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
                                </div>

                                <div class="card-body">
                                    <!-- Contenu texte -->
                                    <p class="publication-text">
                                        <span
                                            class="short-text">{{ Str::limit($publication->content, 10, '...') }}</span>
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
                                                                    return optional($likers->user)->name;
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
                                                        data-bs-title="{{ count($likers) > 0 ? implode('<br>', $likers->user) : "Personne n'a encore liké ce post" }}">
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
                            </div>
                          @endif
                        @endforeach
                </div>
                <!-- Main content END -->

                <!-- Right sidebar START -->
                <div class="col-lg-4">
                    <div class="row g-4">
                        <!-- Card START -->
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-header border-0 pb-0">
                                    <h5 class="card-title">A propos</h5>
                                    <!-- Button modal -->
                                </div>

                                <div class="card-body position-relative pt-0">
                                    <p>{{ $profil->settings->about ?? 'Non renseigné' }}</p>
                                    <ul class="list-unstyled mt-3 mb-0">
                                        {{--<li class="mb-2">
                                            <i class="fa fa-calendar fa-fw pe-1"></i>
                                            Dâte de naissance:
                                            <strong>{{ $profil->settings->born ?? 'Non renseignée' }}</strong>
                                        </li>--}}
                                        <li class="mb-2">
                                            <i class="fa fa-globe fa-fw pe-1"></i>
                                            Pays: <strong>{{ $profil->settings->country ?? 'Non renseigné' }}</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fa fa-phone fa-fw pe-1"></i>
                                            Numéro: <strong>{{ $profil->settings->number ?? 'Non renseigné' }}</strong>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope fa-fw pe-1"></i>
                                            Email: <strong>{{ $profil->email ?? 'Non renseigné' }}</strong>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <!-- Card END -->

                        <!-- Card START Experience -->
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                <!-- Card header START -->
                                <div class="card-header d-flex justify-content-between border-0">
                                    <h5 class="card-title">Expériences</h5>
                                    @if (Auth::id() === $user->id)
                                        <a class="btn btn-primary-soft btn-sm" href="{{ route('settings') }}">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                    @endif
                                </div>
                                <!-- Card header END -->

                                <!-- Card body START -->

                                <div class="card-body position-relative pt-0">
                                    @if (!empty($profil->settings->experiences))
                                        <div class="card">
                                            <div class="card-header">Expériences</div>
                                            <div class="card-body">
                                                @foreach (json_decode($profil->settings->experiences, true) as $experience)
                                                    <div class="d-flex mb-3">
                                                        <div>
                                                            <h6 class="card-title mb-0">{{ $experience['company'] }}
                                                            </h6>
                                                            <p class="small text-muted mb-0">
                                                                De :
                                                                {{ \Carbon\Carbon::parse($experience['start_date'])->format('M Y') }}
                                                                @if (!empty($experience['end_date']))
                                                                    à
                                                                    {{ \Carbon\Carbon::parse($experience['end_date'])->format('M Y') }}
                                                                @else
                                                                    à aujourd'hui
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-muted">Aucune expérience renseignée.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Card END -->
                </div>
            </div>
            <!-- Right sidebar END -->
        </div> <!-- Row END -->
        </div>
        <!-- Container END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- =======================JS libraries, plugins and custom scripts -->

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('assets/vendor/choices.js/public/assets/scripts/choices.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/glightbox-master/dist/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>

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
                                icon.style.color = "#007bff"; // Bleu : liké
                                button.classList.add("liked");
                            } else {
                                icon.style.color = ""; // Déliké
                                button.classList.remove("liked");
                            }

                            likeCountElement.textContent = data.likesCount;

                            // Optionnel : mettre à jour le tooltip dynamiquement si tu veux
                            if (button.hasAttribute("data-bs-title")) {
                                const tooltip = bootstrap.Tooltip.getInstance(button);
                                if (tooltip) tooltip.dispose();

                                const names = data.usernames?.length ?
                                    data.usernames.join('<br>') :
                                    "Personne n'a encore liké ce post";

                                button.setAttribute("data-bs-title", names);
                                new bootstrap.Tooltip(button); // recrée le tooltip
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
    </script>



</body>

</html>
