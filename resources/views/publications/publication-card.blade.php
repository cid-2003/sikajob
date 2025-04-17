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
                            <a href="{{ route('profile.show', $publication->user->id) }}">
                                {{$publication->user->name }}
                                {{$publication->user->prenom  }}
                            </a>
                        </h6>
                        <!-- heure -->
                        <span class="nav-item small">{{ $publication->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- metier -->
                    <p class="mb-0 small">{{$publication->user->metiers }}</p>
                </div>
            </div>
            <!-- Card feed action dropdown START -->
            <div class="dropdown">
                <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardFeedAction"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis"></i>
                </a>
                <!-- Card feed action dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
                    @auth
                    @if(Auth::check() && Auth::user()->role === 'Recruteur')
                    <li>
                        <button class="dropdown-item text-danger"
                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $publication->id }}').submit();">
                        <i class="fa fa-trash fa-fw pe-2"></i>Supprimer
                    </button>
                
                    <form id="delete-form-{{ $publication->id }}" action="{{ route('publications.destroy', $publication->id) }}"
                        method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    </li>
                    @endif

                    @if (Auth::check() && Auth::user()->role === 'Candidat')
                    <li>
                        <a class="dropdown-item" href="{{ route('publication.show', $publication->id) }}">
                            <i class="fa fa-paper-plane fa-fw pe-2"></i>Postuler à cette offre
                        </a>
                    </li>
                    
                     <form  method="POST" action="">
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#reportModal">
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
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Signaler ce compte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="reason" class="form-label">Raison du signalement :</label>
                        <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Signaler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Card body START -->
    <div class="card-body">
        <!-- Contenu texte -->
        <p class="publication-text">
            <span class="short-text">{{ Str::limit($publication->content, 10, '...') }}</span>
            <span class="full-text" style="display: none">{{ $publication->content}}</span>
            @if(strlen($publication->content) > 10)
                <a href="#" class="toggle-text" onclick="toggleText(this); return false;">(plus)</a>
            @endif
        </p>
        

        
        <!-- Interactions -->
        <div class="mt-3">
            @include('publications.like-button')
        </div>
    </div>
    <!-- Card body END -->
</div>
@empty
    
@endforelse

<script src="{{ asset('script.js') }}"></script>

<script>
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
</script>
