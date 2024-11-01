<?php
/**
 * Template Name: Login Render
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


	<?php 

	/**
	 * Filters the message to display above the login form.
	 *
	 * @since 2.1.0
	 *
	 * @param string $message Login message text.
	 */


	 ?>

		
					
<div id="login">
	<h1><a  tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	
		/**
		* Filters instructional messages displayed above the login form.
		*
		* @since 2.5.0
		*
		* @param string $messages Login messages.
		*/
		$message = "";
		$message = apply_filters( 'login_message', $message );
		if ( !empty( $message ) )
			echo str_replace( "message", "message loginform_designer", $message ) . "\n";
		echo '<p class="message loginform_designer hidden_designer" style="display:none;">' . __('You are now logged out.') . '<span id="message_disconnected"></span></p>';	
		//echo '<p class="message">' . apply_filters( 'login_message', $message ) . "</p>\n";
		echo '<div id="login_error" class="loginform_designer hidden_designer" style="display:none;">' . __('<strong>ERROR</strong>: Invalid username or email.') .'</div>';

		echo '<p class="message lostpasswordform_designer">' . __('Please enter your username or email address. You will receive a link to create a new password via email.') . '</p>';
		echo '<p class="message register registerform_designer">' . __('Register For This Site') . '</p>'
		//__('You are now logged out.')
		//echo '<div id="login_error">' . apply_filters( 'login_errors', $errors ) . "</div>\n";
	
	?>
	<form class="loginform_designer" name="loginform" id="loginform" >
		<p>
			<label for="user_login"><?php esc_html_e( 'Username or Email Address' ); ?><br />
			<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>
		</p>
		<p>
			<label for="user_pass"><?php esc_html_e( 'Password' ); ?><br />
			<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>
		</p>
		<?php do_action( 'login_form' ); ?>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> <?php esc_html_e( 'Remember Me' ); ?></label></p>
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php _e( 'Log in' ); ?>" />
		</p>
	</form>



	<form class= "lostpasswordform_designer" name="lostpasswordform" id="lostpasswordform">
		<p>
			<label for="user_login" ><?php _e( 'Username or Email Address' ); ?><br />
			<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" /></label>
		</p>
		<?php
		/**
		* Fires inside the lostpassword form tags, before the hidden fields.
		*
		* @since 2.1.0
		*/
		do_action( 'lostpassword_form' ); ?>
		<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Get New Password'); ?>" /></p>
	</form>

	<form class= "registerform_designer" name="registerform" id="registerform">
		<p>
			<label for="user_login"><?php _e('Username') ?><br />
			<input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr(wp_unslash($user_login)); ?>" size="20" /></label>
		</p>
		<p>
			<label for="user_email"><?php _e('Email') ?><br />
			<input type="email" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( wp_unslash( $user_email ) ); ?>" size="25" /></label>
		</p>
		<?php
		/**
		* Fires following the 'Email' field in the user registration form.
		*
		* @since 2.1.0
		*/
		do_action( 'register_form' );
		?>
		<p id="reg_passmail"><?php _e( 'Registration confirmation will be emailed to you.' ); ?></p>
		<br class="clear" />
		<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Register'); ?>" /></p>
	</form>



	<p id="nav">

	<?php			
			
		if ( get_option( 'users_can_register' ) ) echo '<a class="loginform_designer inline_designer">' . __( 'Register' ) . '</a> <span class="loginform_designer inline_designer not_selectable"> | </span>';

		echo '<a class="lostpasswordform_designer inline_designer">' . __( 'Log in' ) . '</a>';
		if ( get_option( 'users_can_register' ) ) echo '<span class="lostpasswordform_designer inline_designer not_selectable"> | </span>';
		echo '<a class="registerform_designer inline_designer">' . __( 'Log in' ) . '</a> <span class="registerform_designer inline_designer not_selectable"> | </span>';
		
	?>

	<a class="loginform_designer inline_designer"><?php _e( 'Lost your password?' ); ?></a>
	<?php	
		if ( get_option( 'users_can_register' ) ) echo '<a class="lostpasswordform_designer inline_designer">' . __( 'Register' ) . '</a>';
	?>

	<a class="registerform_designer inline_designer"><?php _e( 'Lost your password?' ); ?></a>
	</p>
	<p id="backtoblog"><a ><?php printf( _x( '&larr; Back to %s', 'site' ), get_bloginfo( 'title', 'display' ) )?></a></p>
	</div>
<div class="clear"></div>
					
<?php //get_footer(); 


do_action('wp_footer');
do_action('loin_ctrl_custom_login_form_footer');
//do_action('login_footer');



?>

</html>
