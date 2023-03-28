<?php

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
    global $wpdb; 
    $results = $wpdb->get_results( "SELECT * FROM wp_notifandfeedback ORDER BY wp_notifandfeedback .date_avis DESC;");
    // Affiche les éléments récupérés
    if ( $results ) {
		echo '<div class="avis-clients-container">';
		echo '<div class="avis-clients">';
		foreach ( $results as $result ) {
			$note = intval( $result->note );
			$etoiles = str_repeat( '&#9733;', $note ) . str_repeat( '&#9734;', 5 - $note );
            
			echo '<div class="avis-client" style="display; inline-block;margin: 30px;">';
			echo '<p class="nom-utilisateur">' . $result->nom_utilisateur. ' - ' . $result->date_avis  . '</p>';
			echo '<p class="note">' . $etoiles . '</p>';
			echo '<p class="commentaire">' . $result->commentaire . '</p>';
            if( get_super_admins()){
                echo '<form method="post">';
                  
                    echo'<button class="delete_avis" name="SuppBtn" value='.$result->id_feedback.' type="submit">Supprimer</button>';
                    echo '<input  type="hidden"  name="user-name" value="'.$result->nom_utilisateur.'">';

                    echo'</form>';  
              }
                if(isset($_POST['SuppBtn'])) {

                    $id = $_POST['SuppBtn'];
                    $name_user=$_POST['user-name'];
                    global $wpdb; 
                        $results = $wpdb->get_results( "DELETE FROM wp_notifandfeedback WHERE id_feedback = $id");
                        
            }
			echo '</div>';
			
		}
    } else {
        echo '<p>Aucun élément à afficher</p>';
    }
}
