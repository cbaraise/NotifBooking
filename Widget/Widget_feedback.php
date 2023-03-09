<?php
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
    echo $args['before_widget'];
    echo $args['before_title'] . 'Avis client ' . $args['after_title'];

    // Récupérer les éléments de la table en base de données
    global $wpdb; // Utiliser la global $wpdb pour exécuter des requêtes SQL
    $results = $wpdb->get_results( "SELECT * FROM wp_notifandfeedback ORDER BY wp_notifandfeedback .date_avis DESC;");
    // Afficher les éléments récupérés
    if ( $results ) {
        foreach ( $results as $result ) {
            echo '<p>' . $result->titre . '</p>';
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

// Enregistrement du widget
function register_mon_widget() {
register_widget( 'Mon_Widget' );
}
add_action( 'widgets_init', 'register_mon_widget' );

?>