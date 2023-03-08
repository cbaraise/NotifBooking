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
  add_action('wp_loaded','feedback');
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
?>