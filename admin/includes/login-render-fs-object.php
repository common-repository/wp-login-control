<?php
/**
 * Template Name: Login Render Object
 *
 * @package WordPress
 * @subpackage all
 */

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();
	
//do_action('wp_head');

do_action('loin_ctrl_custom_login_form_head');


 ?>


<html>

					
<?php //get_footer(); 


do_action('wp_footer');
do_action('loin_ctrl_custom_login_form_footer');
//do_action('login_footer');



?>

</html>
