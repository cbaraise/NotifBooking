<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
include_once( ABSPATH . 'wp-includes\pluggable.php' );
include_once(ABSPATH . 'wp-content\plugins\NotifBooking\notif.php');

// Démarre la session

$notifications=0;
$message="Vous n'avez pas de notification";
// Enregistre une notification dans la variable $_SESSION
session_start();
if (isset($_SESSION['notification'])) {
  // Affiche la notification dans $message
  $message = '<div class="' . $_SESSION['notification']['type'] . '">' . $_SESSION['notification']['message'] .'</div>';
  $notifications=$_SESSION['notification']['notifications'] ;
  
  // Supprime la notification de la session pour ne pas l'afficher plusieurs fois

  
}
if(isset($_POST['Vue'])){
  unset($_SESSION['notification']);
}

?>


<div class='notification-dropdown'>
        <button class='notification-button'>
          <span class='notification-badge'></span>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="25" height="25" viewBox="0 0 256 256" xml:space="preserve">

            <defs>
            </defs>
            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
              <path d="M 75.738 66.908 H 14.261 c -2.79 0 -5.204 -1.795 -6.008 -4.466 c -0.802 -2.673 0.222 -5.499 2.547 -7.036 c 0.887 -0.589 1.914 -1.133 3.135 -1.663 c 2.476 -1.129 3.323 -13.835 3.643 -18.618 c 0.141 -2.121 0.286 -4.309 0.484 -6.284 l 0.021 -0.172 c 1.641 -10.862 7.002 -18.394 15.542 -21.881 C 35.872 2.67 40.256 0 45 0 s 9.128 2.67 11.373 6.788 c 8.542 3.485 13.9 10.997 15.535 21.823 l 0.021 0.168 c 0.198 1.954 0.337 4.014 0.482 6.195 l 0.01 0.143 c 0.349 5.236 1.165 17.496 3.72 18.659 c 1.15 0.499 2.171 1.041 3.062 1.631 c 2.324 1.537 3.348 4.365 2.543 7.036 C 80.944 65.112 78.529 66.908 75.738 66.908 z M 17.242 59.908 h 55.53 c -5.932 -3.274 -6.645 -13.971 -7.334 -24.325 l -0.01 -0.142 c -0.14 -2.086 -0.271 -4.058 -0.454 -5.868 c -1.359 -8.868 -5.382 -14.331 -12.297 -16.698 l -1.543 -0.528 l -0.588 -1.522 C 49.662 8.537 47.433 7 45 7 c -2.433 0 -4.663 1.538 -5.548 3.827 l -0.588 1.521 l -1.542 0.528 c -6.914 2.367 -10.938 7.847 -12.304 16.753 c -0.183 1.836 -0.321 3.929 -0.456 5.953 C 23.869 45.976 23.153 56.705 17.242 59.908 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
              <path d="M 45 90 c -7.419 0 -13.474 -6.036 -13.497 -13.456 l -0.011 -3.511 h 27.015 l -0.011 3.511 C 58.474 83.964 52.419 90 45 90 z M 39.55 80.033 C 40.71 81.817 42.722 83 45 83 s 4.289 -1.183 5.449 -2.967 H 39.55 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            </g>
          </svg>
        </button>
        <ul class='notification-list'>
          <li><p class='defaultNotif'> <?= $message ?></p> </li>
          <li> 
            <form method="post">
              <button class='notif-confirm' name="Vue" type='submit'>Marquer comme Vue </button> 
            </form>
          </li>
        </ul>
        </div>
      <?php
      if(current_user_can( 'edit_posts' )){
        echo '
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <div class="notification-dropdown">
          <a href="http://localhost:9000/wp-admin/">
          <span class="material-symbols-outlined">
            admin_panel_settings
          </span>
          </a>
          </div>'
        ;
      }
      ?>
      </div>
      

        
   
<script>


    const notifications =  <?= $notifications ?>;
    const notificationBadge = document.querySelector('.notification-badge');
    const notifVueBtn = document.querySelector('.notif-confirm');
    const notifMessage = document.querySelector('.defaultNotif');

    if (notifications > 0) 
    {
        notificationBadge.style.display = 'block';
        notifVueBtn.style.display='block';
        notifMessage.style.display='block';
    } else 
    {
        notificationBadge.style.display = 'none';
        notifVueBtn.style.display='none';
        notifMessage.style.display='block';
    }
</script>

   