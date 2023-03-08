<?php
require_once('C:\Users\cleme\OneDrive\Bureau\test\wordpress\wp-load.php');
include_once(ABSPATH . 'wp-content\plugins\ultimate-member\includes\um-short-functions.php');
$user_id=get_current_user_id(); 
$name =um_get_display_name( $user_id );
global $wpdb;

$table_name = $wpdb->prefix . "notifandfeedback";
//if(isset($_POST['note-value'])) {
    $note = $_POST['note-value'];


$commentaire = $_POST['commentaire'];
var_dump($note);
$data = array(
   'nom_utilisateur' => $name,
   'note' => $note,
   'commentaire' => $commentaire
);

$wpdb->insert($table_name, $data);

if ($wpdb->insert_id === false) {
    echo "Erreur lors de l'insertion des données dans la table.";
} else {
    echo "Message enregistrer avec succès.";
    
}