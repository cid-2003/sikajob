

  {{-- Seuls les recruteurs peuvent faire des publications, les candidats vons juste postuler --}}
  @if(Auth::check() && Auth::user()->role === 'Recruteur')
  <div class="card card-body">
      <div class="d-flex mb-3">
          <!-- Avatar -->
          <div class="avatar avatar-xs me-2">
              <a href="#"> <img class="avatar-img rounded-circle"
                      src="{{ Auth::check() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('path/to/default-image.jpg') }}"
                      alt=""> </a>
          </div>
          <!-- Post input -->
          <form method="POST" action="" class="w-100">
              @csrf
              <textarea class="form-control pe-4 border-0" rows="2" data-autoresize="" id="publication" name="content"
                  placeholder="Publication...">
               </textarea>
          </form>
          <div>
              <button type="submit" class="btn btn-success-soft m-2 ">Publier</button>
          </div>
      </div>
      <!-- Share feed toolbar START -->
      <ul class="nav nav-pills nav-stack small fw-normal">
          <li class="nav-item">
              <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                  data-bs-target="#feedActionPhoto"> <i
                      class="fa fa-image text-success pe-2"></i>Photo</a>
          </li>
      </ul>
      <!-- Share feed toolbar END -->
  </div>
  @endif

        
  <div class="card">
    @if (Auth::check() && Auth::user()->role === 'Candidat')
    @foreach ($recruteurs as $recruteur)
    <!-- Card body START -->
    <div class="card-body">
        <div class="tiny-slider arrow-hover">
            <div class="tiny-slider-inner ms-n4" data-arrow="true" data-dots="false" data-items-xl="3" data-items-lg="2" data-items-md="2" data-items-sm="2" data-items-xs="1" data-gutter="12" data-edge="30">
                <!-- Slider items -->
                <div> 
                    <!-- Card add friend item START -->
                    <div class="card shadow-none text-center">
                        <!-- Card body -->
                        <div class="card-body p-2 pb-0">
                            <div class="avatar avatar-xl">
                                <a
                                href="{{ route('profile.show', $publication->user->id) }}">
                                <img class="avatar-img rounded-circle"
                                    src="{{ $recruteur->photo ? asset('storage/' . $recruteur->photo) : asset('path/to/default-image.jpg') }}"
                                    alt="">
                            </a>
                            </div>

                            <h6 class="card-title mb-1 mt-3"> <a href="#!">
                                {{ $recruteur->name }} {{ $recruteur->prenom }}
                            </a>
                            @if ($recruteur->badge)
                                <i
                                    class="fa fa-check-circle -fill text-success small"></i>
                            @endif
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

</div>