// Fonction pour faire disparaître les messages flash après quelques secondes


// Configuration de Dropzone.js si vous l'utilisez
//if (typeof Dropzone !== 'undefined') {
// Configuration globale pour Dropzone
//  Dropzone.autoDiscover = false;

// Initialiser les dropzones dans les modals
// const photoDropzone = new Dropzone('div[data-dropzone][form-action="photos"]', {
//   url: document.querySelector('form[action="' + route('publications.photo') + '"]')
//     .action,
// autoProcessQueue: false,
/////autoProcessQueue: false,
//    addRemoveLinks: true,
///// });

// Gérer la soumission du formulaire de photos
//  document.querySelector('form[action="' + route('publications.photo') + '"]').addEventListener(
//  'submit',
//  function(e) {
//  if (photoDropzone.getQueuedFiles().length > 0) {
//     e.preventDefault();
//       photoDropzone.processQueue();
//     }
//   });

// Gérer la soumission du formulaire de vidéo
// document.querySelector('form[action="' + route('publications.video') + '"]').addEventListener(
// 'submit',
// function(e) {
//   if (videoDropzone.getQueuedFiles().length > 0) {
//         e.preventDefault();
//           videoDropzone.processQueue();
//         }
//       });
// }
//}); 


//Fonction pour copier les liens
function copyToClipboard(event, url) {
    event.preventDefault();
    navigator.clipboard.writeText(url).then(() => {
        alert("Lien copié !");
    }).catch(err => {
        console.error("Erreur lors de la copie : ", err);
    });
};

// pour la modification
function loadEditModal(candidatureId) {
    $.ajax({
        url: '/candidature/' + candidatureId + '/edit', // Remplace par l'URL de ton API
        method: 'GET',
        success: function(data) {
            // Remplir le modal avec les données
            $('#currentCVLink').attr('href', '/storage/cv/' + data.cv); // Chemin vers le CV actuel
            $('#letter').val(data.letter); // Remplir la lettre de motivation

            // Afficher le modal
            $('#editModal').modal('show');
        },
        error: function() {
            alert('Erreur lors du chargement des informations de la candidature.');
        }
    });
}


//Script pour show.blade
   // Fonction pour faire disparaître les messages flash après quelques secondes
   document.addEventListener('DOMContentLoaded', function() {
    // Rechercher les messages flash
    const flashMessages = document.querySelectorAll('.alert-success, .alert-danger');

    // Si des messages sont présents, les faire disparaître après 5 secondes
    if (flashMessages.length > 0) {
        setTimeout(function() {
            flashMessages.forEach(function(message) {
                // Ajouter une classe de transition pour une disparition en fondu
                message.style.transition = 'opacity 1s';
                message.style.opacity = '0';

                // Supprimer l'élément après la transition
                setTimeout(function() {
                    message.remove();
                }, 1000);
            });
        }, 5000);
    }

    // Configuration de Dropzone.js si vous l'utilisez
    if (typeof Dropzone !== 'undefined') {
        // Configuration globale pour Dropzone
        Dropzone.autoDiscover = false;

        // Initialiser les dropzones dans les modals
        const photoDropzone = new Dropzone('div[data-dropzone][form-action="photos"]', {
            url: document.querySelector('form[action="' + route('publications.photo') + '"]')
                .action,
            autoProcessQueue: false,
            addRemoveLinks: true,
            maxFiles: 2
        });

        const videoDropzone = new Dropzone('div[data-dropzone][form-action="video"]', {
            url: document.querySelector('form[action="' + route('publications.video') + '"]')
                .action,
            autoProcessQueue: false,
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: 'video/*'
        });

        // Gérer la soumission du formulaire de photos
        document.querySelector('form[action="' + route('publications.photo') + '"]').addEventListener(
            'submit',
            function(e) {
                if (photoDropzone.getQueuedFiles().length > 0) {
                    e.preventDefault();
                    photoDropzone.processQueue();
                }
            });

        // Gérer la soumission du formulaire de vidéo
        document.querySelector('form[action="' + route('publications.video') + '"]').addEventListener(
            'submit',
            function(e) {
                if (videoDropzone.getQueuedFiles().length > 0) {
                    e.preventDefault();
                    videoDropzone.processQueue();
                }
            });
    }
});


//Affichage de message si la candidature est envoyé ou pas
$(document).ready(function() {
$('#candidatureForm').submit(function(e) {
e.preventDefault(); // Empêche le rechargement de la page

let formData = new FormData(this); // Récupère les données du formulaire

$.ajax({
    url: $(this).attr('action'), // URL définie dans le formulaire
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
        $('#message').html('<div class="alert alert-success">Candidature envoyée avec succès !</div>');
        $('#candidatureForm')[0].reset(); // Réinitialise le formulaire après l'envoi
    },
    error: function(xhr) {
        let errorMsg = '<div class="alert alert-danger">Une erreur est survenue. Veuillez réessayer.</div>';
        
        if (xhr.responseJSON && xhr.responseJSON.errors) {
            errorMsg = '<div class="alert alert-danger"><ul>';
            $.each(xhr.responseJSON.errors, function(key, value) {
                errorMsg += '<li>' + value + '</li>';
            });
            errorMsg += '</ul></div>';
        }

        $('#message').html(errorMsg);
    }
});
});
}); 
