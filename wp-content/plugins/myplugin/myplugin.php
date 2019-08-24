<?php
/*
 * Plugin Name: My Plugin
 * Description: Displays the username if it is authorized, otherwise it displays the authorization form.
 * Author: Vladimir Cherepkov
 * Author URI: https://github.com/vova-iz-cheb
 */

add_action( 'check_submit', 'check_submit_func' );
add_action( 'check_user_login', 'check_user_login_func' );
add_action( 'create_reg_form', 'create_reg_form_func' );

function check_submit_func() {
	// check authentification form
	if ( isset( $_REQUEST['submit-login'] ) ) {
		global $login_error;
		if ( empty($_REQUEST['log'] ) OR empty( $_REQUEST['pwd'] ) ) {
			$login_error = "Все поля должны быть заполнены.";
		} else {
			$user = wp_signon();

			if( is_wp_error( $user ) ) {
				$login_error = $user->get_error_message();
			} else {
				wp_set_current_user( $user->ID ); 
			}
		}
	}

	// check registration form
	if ( isset( $_REQUEST['submit-reg'] ) ) {
		global $reg_error;
		$login = isset( $_REQUEST['login'] ) ? $_REQUEST['login'] : '';
		$email = isset( $_REQUEST['email'] ) ? $_REQUEST['email'] : '';
		$password = isset( $_REQUEST['password'] ) ? $_REQUEST['password'] : '';
		$password2 = isset( $_REQUEST['password2'] ) ? $_REQUEST['password2'] : '';

		if ( empty( $login ) OR empty( $email ) OR empty( $password ) OR empty( $password2 ) ) {
			$reg_error = "Все поля должны быть заполнены.";
		}
		elseif ( $password !== $password2 ) {
			$reg_error = "Пароли не совпадают.";
		} else {
			$user = wp_create_user($login, $password, $email);

			if ( is_wp_error( $user ) ) {
				$reg_error = $user->get_error_message();
			} else { // registration ok -> start authentification 
				$user = wp_signon( array(
					'user_login' 		=> $login,
					'user_password' => $password
				) );
				wp_set_current_user( $user->ID );
			}
		}
	}
}

function check_user_login_func() {
	if ( is_user_logged_in() ) {
?>
		<div class="user-box">
			<a href="<?php echo get_edit_user_link( get_current_user_id() ) ?>" title="Edit Profile"><?php echo get_avatar(get_current_user_id(), 32) ?> <?php echo wp_get_current_user()->display_name ?></a>
			<a href="<?php echo wp_logout_url( home_url() ) ?>" title="<?php esc_attr_e('Log Out', 'vcherepkov' ) ?>"><?php _e('Log Out', 'vcherepkov' ) ?></a>
		</div>
<?php
	} else {
?>
		<form action="" method="POST" class="form-auth">
			<?php if(isset($GLOBALS['login_error'])) { ?>
				<p class="error"><?php echo $GLOBALS['login_error'] ?></p>
			<?php } ?>
			<input type="text" name="log" placeholder="Mail/Login" value="<?php echo isset($_REQUEST['log']) ? $_REQUEST['log'] : '' ?>"><br>
			<input type="password" name="pwd" placeholder="Password" value="<?php echo isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : '' ?>"><br>
			<input type="submit" value="<?php _e('Log In', 'vcherepkov' ) ?>" name="submit-login">
			<input type="button" value="<?php _e('Registration', 'vcherepkov' )?>" class="reg__button">
		</form>
<?php
	}
}

function create_reg_form_func() {
	if(isset($GLOBALS['reg_error'])) {
		echo "<div class='bg-dark block'>";
	} else echo "<div class='bg-dark'>"
?>
		<form action="" method="POST" class="reg__form">
			<a href="javascript:void(0)" class="reg__close">&times;</a>
			<h2 class="reg__header"><?php _e('Registration', 'vcherepkov' )?>:</h2>
			<?php if(isset($GLOBALS['reg_error'])) { ?>
				<p class="error"><?php echo $GLOBALS['reg_error'] ?></p>
			<?php } ?>
			<input type="text" name="login" placeholder="Your login" value="<?php echo isset($_REQUEST['login']) ? $_REQUEST['login'] : '' ?>"><br>
			<input type="email" name="email" placeholder="Your email" value="<?php echo isset($_REQUEST['email']) ? $_REQUEST['email'] : '' ?>"><br>
			<input type="password" name="password" placeholder="Your password" value="<?php echo isset($_REQUEST['password']) ? $_REQUEST['password'] : '' ?>"><br>
			<input type="password" name="password2" placeholder="Once again" value="<?php echo isset($_REQUEST['password2']) ? $_REQUEST['password2'] : '' ?>"><br>
			<input type="submit" value="<?php _e('Send', 'vcherepkov' )?>" name="submit-reg">
		</form>
	</div>
<?php
}