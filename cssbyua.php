<?php

/*
Plugin Name: cssbyua
Description: depending on the browser, change the css. Project created for Mobile css and inject css on android application. 
Version: 0.5
Author: Brad Parbs - Thomas BONSIRVEN
Author URI: #
*/

/**
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
add_action('wp_head','cssbyua');
add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );


function cssbyua(){
	//check to see what the user agent is

	$firefox = strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') ? true : false;
	$grossitsie = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? true : false;
	$safari = strpos($_SERVER["HTTP_USER_AGENT"], 'Safari') ? true : false;
	$chrome = strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') ? true : false;
	$opera = strpos($_SERVER["HTTP_USER_AGENT"], 'Opera') ? true : false;
	$iphone = strpos($_SERVER["HTTP_USER_AGENT"], 'iPhone') ? true : false;
	$universalandroid = strpos($_SERVER["HTTP_USER_AGENT"], 'universalandroid') ? true : false;
	//this is static
	echo '<!-- cssbyua -->';
	echo '<style type="text/css">';

	$options = get_option('cssbyua_theme_options');


	if($firefox){
	echo $options['firefox'];
	}
	if($chrome||$safari){
	echo $options['webkit'];
	}
	if($opera){
	echo $options['opera'];
	}
	if($grossitsie){
	echo $options['grossitsie'];
	}
	if($iphone){
	echo $options['iphone'];
	}
	if($universalandroid){
	echo $options['universalandroid'];
	}
	echo'</style>';
}


function theme_options_do_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'cssbyuatheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'cssbyuatheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'cssbyua_options' ); ?>
			<?php $options = get_option( 'cssbyua_theme_options' ); ?>

			<table class="form-table">


				<tr valign="top"><th scope="row"><?php _e( 'Firefox Specific CSS', 'cssbyuatheme' ); ?></th>
					<td>
						<textarea id="cssbyua_theme_options[firefox]" class="large-text" cols="50" rows="10" name="cssbyua_theme_options[firefox]"><?php echo esc_textarea( $options['firefox'] ); ?></textarea>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Webkit Specific CSS', 'cssbyuatheme' ); ?></th>
					<td>
						<textarea id="cssbyua_theme_options[webkit]" class="large-text" cols="50" rows="10" name="cssbyua_theme_options[webkit]"><?php echo esc_textarea( $options['webkit'] ); ?></textarea>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Internet Explorer Specific CSS', 'cssbyuatheme' ); ?></th>
					<td>
						<textarea id="cssbyua_theme_options[grossitsie]" class="large-text" cols="50" rows="10" name="cssbyua_theme_options[grossitsie]"><?php echo esc_textarea( $options['grossitsie'] ); ?></textarea>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Opera Specific CSS', 'cssbyuatheme' ); ?></th>
					<td>
						<textarea id="cssbyua_theme_options[opera]" class="large-text" cols="50" rows="10" name="cssbyua_theme_options[opera]"><?php echo esc_textarea( $options['opera'] ); ?></textarea>
					</td>
				</tr>	
				<tr valign="top"><th scope="row"><?php _e( 'iPhone Specific CSS', 'cssbyuatheme' ); ?></th>
					<td>
						<textarea id="cssbyua_theme_options[iphone]" class="large-text" cols="50" rows="10" name="cssbyua_theme_options[iphone]"><?php echo esc_textarea( $options['iphone'] ); ?></textarea>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'universalandroid Specific CSS', 'cssbyuatheme' ); ?></th>
					<td>
						<textarea id="cssbyua_theme_options[universalandroid]" class="large-text" cols="50" rows="10" name="cssbyua_theme_options[universalandroid]"><?php echo esc_textarea( $options['universalandroid'] ); ?></textarea>
					</td>
				</tr>

			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'cssbyuatheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}


function theme_options_validate( $input ) {
	$input['firefox'] = wp_filter_post_kses( $input['firefox'] );
	$input['webkit'] = wp_filter_post_kses( $input['webkit'] );
	$input['opera'] = wp_filter_post_kses( $input['opera'] );
	$input['grossitsie'] = wp_filter_post_kses( $input['grossitsie'] );
	$input['iphone'] = wp_filter_post_kses( $input['iphone'] );
	$input['universalandroid'] = wp_filter_post_kses( $input['universalandroid'] );

	return $input;
}



function theme_options_add_page() {	add_theme_page( __( 'cssbyua', 'cssbyuatheme' ), __( 'cssbyua', 'cssbyuatheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );}
function theme_options_init(){register_setting( 'cssbyua_options', 'cssbyua_theme_options', 'theme_options_validate' );}
?>