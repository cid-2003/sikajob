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

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
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
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">

    
     <!-- .............................. FONT AWESOME CDN .............................. -->
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	 
</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->

<main>
  <!-- Container START -->
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100 py-5">
      <!-- Main content START -->
      <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5" >
        <!-- Sign up START -->
        <div class="card card-body rounded-3 p-4 p-sm-8" >
          <div class="text-center">
            <!-- Title -->
            <h1 class="mb-2">Inscription</h1>
            <span class="d-block">Vous avez déjà un compte? <a href="{{ route('login')}}">Connectez-vous ici</a></span>
          </div>
          <!-- Form START -->
          <form method="POST" action="{{route('register.store')}}" enctype="multipart/form-data" class="mt-4">
			@csrf
			{{-- nom --}}
			<div class="mb-3 input-group-lg">
				<input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autocomplete="name" autofocus placeholder="Nom">
				@error('name')
				    <span class="invalid-feedback" role="alert">
					    <strong>{{ $message }}</strong>
				    </span>
			    @enderror
			</div>

			{{-- prenom --}}
			<div class="mb-3 input-group-lg">
				<input type="text" id="prenom" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{old('prenom')}}" required autocomplete="prenom" autofocus placeholder="Prénom">
				@error('prenom')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
			</div>

            <!-- Email -->
            <div class="mb-3 input-group-lg">
              <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required autocomplete="email" placeholder="Email">
			  @error('email')
				<span class="invalid-feedback" role="alert">
					<strong> {{ $message }} </strong>
				</span>
			  @enderror
              <small>Nous ne partagerons jamais votre email avec une autre personne.</small>
            </div>

			<!-- Metiers -->
            <div class="mb-3 input-group-lg">
				<input id="metiers" name="metiers" type="text" class="form-control @error('metiers') is-invalid @enderror" value="{{old('metiers')}}" required autocomplete="metiers" placeholder="Metiers">
				@error('metiers')
				  <span class="invalid-feedback" role="alert">
					  <strong> {{ $message }} </strong>
				  </span>
				@enderror
			</div>

			 <!-- Sélection de rôle -->
			 <div class="mb-3 input-group-lg">
				<label for="role" class="form-label">Sélectionnez votre rôle</label>
				<select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
					<option value="">Choisissez votre rôle</option>
					<option value="Recruteur" >Recruteur</option>
					<option value="Candidat">Candidat</option>
				</select>
				@error('role')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>

            <!-- New password -->
            <div class="mb-3 position-relative">
              <!-- Input group -->
              <div class="input-group input-group-lg">
                <input class="form-control fakepassword @error('password') is-invalid @enderror" type="password" id="psw-input" name="password" required autocomplete="password" placeholder="Mot de passe">
				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
                <span class="input-group-text p-0">
                  <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                </span>
              </div>
              <!-- Pswmeter -->
              <div id="pswmeter" class="mt-2"></div>
              <div class="d-flex mt-1">
                <div id="pswmeter-message" class="rounded"></div>
                <!-- Password message notification -->
                <div class="ms-auto">
                  <i class="fa fa-info-circle ps-1" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Include at least one uppercase, one lowercase, one special character, one number and 8 characters long." data-bs-original-title="" title=""></i>
                </div>
              </div>
            </div>

			{{-- Photo de profile --}}
			<div class="mb-3 input-group-lg">
				<input type="file" id="photo" class="form-control @error('photo') is-invalid @enderror" name="photo" placeholder="Photo de profile">
				@error('photo')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			
            <!-- Button -->
            <div class="d-grid">
				<button type="submit" class="btn btn-lg btn-primary">S'inscrire</button>
			</div>
            <!-- Copyright -->
            <p class="mb-0 mt-3 text-center">©2025 <a target="_blank" href="https://www.SikaJob.com/">SikaJob.</a> All rights reserved</p>
          </form>
          <!-- Form END -->
        </div>
        <!-- Sign up END -->
      </div>
    </div> <!-- Row END -->
  </div>
  <!-- Container END -->

</main>

<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<!-- Vendors -->
<script src="{{ asset('assets/vendor/pswmeter/pswmeter.min.js')}}"></script>

<!-- Theme Functions -->
<script src="{{ asset('assets/js/functions.js')}}"></script>

</body>
</html>