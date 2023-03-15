<?php
    include_once(ABSPATH . 'wp-content\plugins\ultimate-member\includes\um-short-functions.php');

class Feedback_Widget extends WP_Widget {


// Constructeur du widget
function __construct() {
    parent::__construct(
        'feedback_widget', // ID du widget
        'Avis client', // Nom du widget
        array( 'description' => 'Les avis des clients en un seul endroit.' ) // Description du widget
    );
}
// Fonction pour afficher le contenu du widget
public function widget( $args, $instance ) {
    $user_id=get_current_user_id(); 
    $user_data = get_userdata( $user_id );
    $name = $user_data->user_login;
    echo $args['before_widget'];
    echo $args['before_title'] .'<h1> Avis de nos clients </h1>' . $args['after_title'];

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
            if($name == $result->nom_utilisateur){
                $id=$result->id_feedback;
                
                echo '<form method="post">';
                   
                    echo'<button class="delete_avis" name="SuppBtn" type="submit">Supprimer</button>';
                echo'</form>';  


                if(isset($_POST['SuppBtn'])) {
                    global $wpdb; // Utiliser la global $wpdb pour exécuter des requêtes SQL
                    if (isset($id)) {
                        $results = $wpdb->get_results( "DELETE FROM wp_notifandfeedback WHERE id_feedback = $id");
                        // Ajoutez ici un message de confirmation ou une redirection vers la page d'accueil, par exemple.
                        $_SESSION['notification'] = array(
                            'type' => 'AvisValid',
                            'message' => "Votre avis à bien été Supprimée !",
                            'notifications'=> "1"
                        );
                        
                          header('Refresh:0');
                      } 
            }
            
              

            }
			echo '</div>';
			
		}
    } else {
        echo '<p>Aucun élément à afficher</p>';
    }

    echo $args['after_widget'];
}



// Fonction pour gérer les paramètres du widget
public function form( $instance ) {
    // Code pour gérer les paramètres du widget
}

}


// Enregistrer un style personnalisé pour le widget
function enregistrer_style_widget_custom() {
    wp_enqueue_style( 'widget-style', plugins_url( 'NotifBooking\src\css\widget-style.css') );
}
add_action( 'wp_enqueue_scripts', 'enregistrer_style_widget_custom' );
?>