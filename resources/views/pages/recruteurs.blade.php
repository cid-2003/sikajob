<!-- Card body START People you may know(Recruteurs)-->
@if ( Auth::check() && Auth::user()->role === 'Candidat')
    
@foreach ($recruteurs as $recruteur)
<div class="card">
    <!-- Card body START -->
    <div class="card-body">
        <div class="tiny-slider arrow-hover">
            <div class="tiny-slider-inner ms-n4" data-arrow="true" data-dots="false" data-items-xl="3" data-items-lg="2" data-items-md="2" data-items-sm="2" data-items-xs="1" data-gutter="12" data-edge="30">
                <!-- Boucle sur les recruteurs -->
                
                <!-- Slider items -->
                <div> 
                    <!-- Card add friend item START -->
                    <div class="card shadow-none text-center">
                        <!-- Card body -->
                        <div class="card-body p-2 pb-0">
                            <div class="avatar avatar-xl">
                                <a href="{{ route('profile.show', $publication->user->id) }}">
                                    <img class="avatar-img rounded-circle"
                                        src="{{ $recruteur->photo ? asset('storage/' . $recruteur->photo) : asset('path/to/default-image.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                            <h6 class="card-title mb-1 mt-3"> <a href="#!"> {{ $recruteur->name }} {{ $recruteur->prenom }} </a>
                                @if ($recruteur->badge)
                                    <i class="fa fa-check-circle -fill text-success small"></i>
                                @endif</h6>
                                <h6 class="mb-1 small lh-sm">{{ $recruteur->metiers }}</h6>
                                <p class="mb-0 small lh-sm">{{ $recruteur->role }}</p>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer p-2 border-0">
                            <a href="{{ route('profil.user', $recruteur->id) }}"
                                class="btn btn-sm btn-primary-soft w-100"> Voir Profil </a>
                        </div>
                    </div>
                    <!-- Card add friend item END -->
                </div>
                
            </div>
        </div>
    </div>
    <!-- Card body END -->
</div>
@endforeach
@endif



@if (Auth::check() && Auth::user()->role === 'Recruteur')
@foreach ($candidats as $candidat)
<div class="card">
    <!-- Card body START -->
    <div class="card-body">
        <div class="tiny-slider arrow-hover">
            <div class="tiny-slider-inner ms-n4" data-arrow="true" data-dots="false" data-items-xl="3" data-items-lg="2" data-items-md="2" data-items-sm="2" data-items-xs="1" data-gutter="12" data-edge="30">
                <!-- Boucle sur les candidats -->
                
                <!-- Slider items -->
                <div> 
                    <!-- Card add friend item START -->
                    <div class="card shadow-none text-center">
                        <!-- Card body -->
                        <div class="card-body p-2 pb-0">
                            <div class="avatar avatar-xl">
                                <a href="{{ route('profile.show', $publication->user->id) }}">
                                    <img class="avatar-img rounded-circle"
                                        src="{{ $candidat->photo ? asset('storage/' . $candidat->photo) : asset('path/to/default-image.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                            <h6 class="card-title mb-1 mt-3"> <a href="#!"> {{ $candidat->name }} {{ $candidat->prenom }} </a>
                                <h6 class="mb-1 small lh-sm">{{ $candidat->metiers }}</h6>
                                <p class="mb-0 small lh-sm">{{ $candidat->role }}</p>
                                
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer p-2 border-0">
                            <a href="{{ route('profil.user', $candidat->id) }}"
                                class="btn btn-sm btn-primary-soft w-100"> Voir Profil </a>
                        </div>
                    </div>
                    <!-- Card add friend item END -->
                </div>
                
            </div>
        </div>
    </div>
    <!-- Card body END -->
</div>
@endforeach

@endif