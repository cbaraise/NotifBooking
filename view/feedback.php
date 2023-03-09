<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include_once(ABSPATH . 'wp-content\plugins\NotifBooking\notif.php');
include_once(ABSPATH . 'wp-content\plugins\ultimate-member\includes\um-short-functions.php');

?>

<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

  
<div class="fixed bottom-10 right-10">
  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" id="open-modal-btn"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 112.77 122.88" style="enable-background:new 0 0 112.77 122.88; width: 24px; height: 24px;" xml:space="preserve">
  <g><path d="M64.44,61.11c1.79,0,3.12-1.45,3.12-3.12c0-1.78-1.45-3.12-3.12-3.12H24.75c-1.78,0-3.12,1.45-3.12,3.12 c0,1.78,1.45,3.12,3.12,3.12H64.44L64.44,61.11L64.44,61.11L64.44,61.11z M77.45,19.73l18.1-19.14c0.69-0.58,1.39-0.81,2.2-0.35 l14.56,14.1c0.58,0.69,0.69,1.5-0.12,2.31L93.75,36.14L77.45,19.73L77.45,19.73L77.45,19.73L77.45,19.73z M87.74,42.27l-18.66,3.86 l2.36-20.28L87.74,42.27L87.74,42.27z M19.14,13.09h41.73l-3.05,6.45H19.14c-3.48,0-6.65,1.43-8.96,3.73s-3.73,5.46-3.73,8.96 v45.74c0,3.48,1.43,6.66,3.73,8.96c2.3,2.3,5.47,3.73,8.96,3.73h3.72v0.01l0.21,0.01c1.77,0.12,3.12,1.66,2.99,3.43l-1.26,18.1 L48.78,97.7c0.58-0.58,1.38-0.93,2.27-0.93h37.32c3.48,0,6.65-1.42,8.96-3.73c2.3-2.3,3.73-5.48,3.73-8.96V50.45h6.68v42.69 c0.35,9.63-3.58,15.04-19.43,15.7l-32.25-0.74l-32.73,13.87l-0.16,0.13c-1.35,1.16-3.38,1-4.54-0.36c-0.57-0.67-0.82-1.49-0.77-2.3 l1.55-22.34h-0.26c-5.26,0-10.05-2.15-13.52-5.62C2.15,88.03,0,83.24,0,77.98V32.23c0-5.26,2.15-10.05,5.62-13.52 C9.08,15.24,13.87,13.09,19.14,13.09L19.14,13.09L19.14,13.09z M79.69,78.42c1.79,0,3.12-1.45,3.12-3.12 c0-1.79-1.45-3.12-3.12-3.12H24.75c-1.78,0-3.12,1.45-3.12,3.12c0,1.78,1.45,3.12,3.12,3.12H79.69L79.69,78.42L79.69,78.42 L79.69,78.42z M50.39,43.81c1.78,0,3.12-1.45,3.12-3.12c0-1.67-1.45-3.12-3.12-3.12H24.75c-1.78,0-3.12,1.45-3.12,3.12 c0,1.78,1.45,3.12,3.12,3.12H50.39L50.39,43.81L50.39,43.81L50.39,43.81z"/></g></svg>
  </button>
</div>

<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal-form">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
            <!-- Icone ici -->
          </div>

          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Donnez-nous votre avis</h3>
            <form action='wp-content\plugins\NotifBooking\controller\feedbackController.php'  method="POST" >
            <div class="rating" >
    <span class="star" data-value="1" onclick="setNoteValue(1)">&#9733;</span>
    <span class="star" data-value="2" onclick="setNoteValue(2)">&#9733;</span>
    <span class="star" data-value="3" onclick="setNoteValue(3)">&#9733;</span>
    <span class="star" data-value="4" onclick="setNoteValue(4)">&#9733;</span>
    <span class="star" data-value="5" onclick="setNoteValue(5)">&#9733;</span>
  </div>
  <input  type="hidden" name="note-value" id="note-value" value="">

  <div class="mb-6">
    <label  class="block text-gray-700 text-sm font-bold mb-2" for="commentaire">Commentaire</label>
    <textarea required name="commentaire" id="commentaire" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="5"></textarea>
  </div>
          </div>
        </div>
      </div>

      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" id="send-avis-btn" type="submit">Envoyer</button>
       

        </form>
        <button class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm close-btn">
          x
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Récupérer les éléments HTML nécessaires
var openFormButton = document.getElementById("open-modal-btn");
var modal = document.getElementById("modal-form");
var closeSpan = document.getElementsByClassName("close-btn")[0];

// Ajouter un gestionnaire d'événement pour le clic sur le bouton flottant
openFormButton.onclick = function() {
  modal.style.display = "block";
}

// Ajouter un gestionnaire d'événement pour le clic sur le bouton de fermeture de la fenêtre modale
closeSpan.onclick = function() {
  modal.style.display = "none";
}

// Ajouter un gestionnaire d'événement pour le clic en dehors de la fenêtre modale pour la fermer
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
const stars = document.querySelectorAll(".star");

stars.forEach(function(star) {
  star.addEventListener("click", setRating);
});

function setRating(ev) {
  const clickedStar = ev.currentTarget;
  const rating = clickedStar.getAttribute("data-value");
  
  // Parcourir toutes les étoiles précédant l'étoile sélectionnée
  stars.forEach(function(star) {
    if (star.getAttribute("data-value") <= rating) {
      star.classList.add("active"); // Ajouter la classe "active" aux étoiles sélectionnées
    } else {
      star.classList.remove("active"); // Supprimer la classe "active" aux étoiles non sélectionnées
    }
  });
}

function setNoteValue(note) {
  
  document.getElementById('note-value').value = note;
}




</script>







