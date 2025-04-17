<div class="nav-item w-100">
    <form  action="{{ route('index') }}" method="GET" class="rounded position-relative ms-5">
        <input name="search" id="search" class="form-control ps-5 bg-light" type="search" placeholder="Recherche..." aria-label="Search">
        <button class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y" type="submit"><i class="fa fa-search fs-5"> </i></button>
    </form>

    <!-- Filtres cachés - appliqués par défaut -->
    <input type="hidden" name="filter[]" value="all">
</div>

@if($search)
<h4>Résultats pour "{{ $search }}"</h4>
@endif

{{-- Utilisateurs trouvés --}}
<h5 class="mt-4">Utilisateurs trouvés :</h5>
<div class="row">
@forelse($users as $user)
    <div class="col-md-4 mb-3">
        <div class="card">
            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/avatar/placeholder.jpg') }}" class="card-img-top">
            <div class="card-body">
                <h5>{{ $user->name }} {{ $user->prenom }}</h5>
                <p>{{ $user->metiers }}</p>
                <p><i class="fa fa-envelope me-1"></i> {{ $user->email }}</p>
            </div>
        </div>
    </div>
@empty
    <p>Aucun utilisateur trouvé.</p>
@endforelse
</div>

{{-- Offres trouvées --}}
<h5 class="mt-4">Offres trouvées :</h5>
<div class="row">
@forelse($publications as $publication)
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>{{ $publication->titre }}</h5>
                <p>{{ $publication->description }}</p>
                <p><strong>Salaire :</strong> {{ $publication->salaire }} | <strong>Contrat :</strong> {{ $publication->contrat }}</p>
            </div>
        </div>
    </div>
@empty
    <p>Aucune offre trouvée.</p>
@endforelse
</div>