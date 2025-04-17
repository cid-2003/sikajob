<form action="" method="POST">
    @csrf
    <ul class="nav nav-stack">
        <li class="nav-item">
            <button class="nav-link like-button {{ $publication->liked }}" type="button"
                data-post-id="{{ $publication->id }}" data-bs-container="body" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-text-start"
                data-bs-title="@if($publication->likes->count() > 0){{ implode('<br>', $publication->likes->map->user->pluck('name')->toArray()) }}@else Personne n'a encore liké ce post @endif">
                <i class="fa fa-thumbs-up -fill pe-1" @if($publication->liked) style="color: #007bff" @endif></i>
                <span class="like-count">{{ $publication->likes->count() }}</span>
            </button>
        </li>
    </ul>
</form>

<script>
    //script pour les like
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".like-button").forEach(button => {
            button.addEventListener("click", function () {
                let postId = this.getAttribute("data-post-id");
                let likeCountElement = this.querySelector(".like-count");
                let icon = this.querySelector("i");

                fetch("{{ route('publication.like') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({ publication_id: postId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.liked) {
                        icon.style.color = "#007bff"; // Bleu pour "liké"
                    } else {
                        icon.style.color = ""; // Retour à la couleur par défaut
                    }
                    likeCountElement.textContent = data.likesCount;
                })
                .catch(error => console.error("Erreur :", error));
            });
        });
    });
</script>


