<?php
/**
 * @package Notif_Booking
 * @version 1.0.0
 */
/*
Plugin Name: NotifBooking
Plugin URI: 
Description: plugin qui permet d'afficher un onglet notification et qui affiche les rendez-vous pris avec le plugin booking-activities
Version: 1.0.0
Author URI:
*/

include_once( ABSPATH . 'wp-includes\pluggable.php' );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require plugin_dir_path(file: __FILE__).'vendor/autoload.php';

if(is_user_logged_in()){ //si l'utilisateur est connecté alors il peut voir et interragir avec la cloche 
  add_action('generate_menu_bar_items', 'icon_bell');
  $user_data = get_userdata(get_current_user_id());
  $name = $user_data->user_login;
  global $wpdb; // Utiliser la global $wpdb pour exécuter des requêtes SQL
  $results = $wpdb->get_results( "SELECT * FROM wp_notifandfeedback WHERE nom_utilisateur='$name'");


      if(!$results){
        add_action('generate_after_header','feedback');
    }
  }
  




// Ajouter le fichier CSS 
function enqueue_my_styles() {
  wp_enqueue_style( 'notifbooking-styles', plugins_url( 'src/css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_styles' );//ajoute le css au fichier


function icon_bell(){
  
  include( plugin_dir_path( __FILE__ ) . 'view\bell.php' );

}

function feedback(){
  include( plugin_dir_path( __FILE__ ) . 'view\feedback.php' );
}




//Menu Admin du plugin 
// Enregistrer le widget en tant que widget WordPress
add_action( 'widgets_init', function(){
    register_widget( 'Feedback_Widget' );
});

// Ajouter un onglet dans la page wp-admin
add_action( 'admin_menu', function(){
    add_menu_page(
        'Avis client', // Titre de l'onglet
        'Avis client', // Nom de l'onglet dans le menu
        'manage_options', // Capacité requise pour voir l'onglet
        'avis-client', // Slug de l'onglet
        'avis_client_page', // Fonction de rappel de l'onglet
        'dashicons-star-filled', // Icône de l'onglet
        100 // Position de l'onglet dans le menu
    );
});

// Fonction de rappel pour afficher le widget dans l'onglet
function avis_client_page() {
  if ( is_user_logged_in() ) {
    $user_id=get_current_user_id(); 
    $user_data = get_userdata( $user_id );
    $name = $user_data->user_login;
    }
    echo '<h1> Avis de nos clients </h1>' ;

    // Récupérer les éléments de la table en base de données
    global $wpdb; // Utiliser la global $wpdb pour exécuter des requêtes SQL
    $results = $wpdb->get_results( "SELECT * FROM wp_notifandfeedback ORDER BY wp_notifandfeedback .date_avis DESC;");
    // Afficher les éléments récupérés
    if ( $results ) {
		echo '<div class="avis-clients-container">';
		echo '<div class="avis-clients">';
		foreach ( $results as $result ) {
			$note = intval( $result->note );
			$etoiles = str_repeat( '&#9733;', $note ) . str_repeat( '&#9734;', 5 - $note );
            
			// Affichage du commentaire avec la note en étoiles
			echo '<div class="avis-client">';
			echo '<p class="nom-utilisateur">' . $result->nom_utilisateur. ' - ' . $result->date_avis  . '</p>';
			echo '<p class="note">' . $etoiles . '</p>';
			echo '<p class="commentaire">' . $result->commentaire . '</p>';
            if($name == $result->nom_utilisateur || current_user_can( 'edit_posts' )){
                
                
                echo '<form method="post">';
                  
                    echo'<button class="delete_avis" name="SuppBtn" value='.$result->id_feedback.' type="submit">Supprimer</button>';
                    echo '<input  type="hidden"  name="user-name" value="'.$result->nom_utilisateur.'">';

                    echo'</form>';  
              }

                if(isset($_POST['SuppBtn'])) {

                    $id = $_POST['SuppBtn'];
                    $name_user=$_POST['user-name'];
                    global $wpdb; // Utiliser la global $wpdb pour exécuter des requêtes SQL
                        
                        $results = $wpdb->get_results( "DELETE FROM wp_notifandfeedback WHERE id_feedback = $id");
                        // Ajoutez ici un message de confirmation ou une redirection vers la page d'accueil, par exemple.
                        
                        
                        $_SESSION['notification'][$name_user] = array(
                            'type' => 'AvisValid',
                            'message' => "Votre avis à été Supprimée !",
                            'notifications'=> "1"
                        );
                          header('Refresh:0');
            }
			echo '</div>';
			
		}
    } else {
        echo '<p>Aucun élément à afficher</p>';
    }
}


?>