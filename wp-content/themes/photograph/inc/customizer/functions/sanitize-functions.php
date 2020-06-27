<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
/********************* PHOTOGRAPH CUSTOMIZER SANITIZE FUNCTIONS *******************************/
function photograph_checkbox_integer( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function photograph_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

function photograph_sanitize_category_select($input) {
	
	$input = sanitize_key( $input );
	return ( ( isset( $input ) && true == $input ) ? $input : '' );

}

function photograph_numeric_value( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}

function photograph_reset_alls( $input ) {
	if ( $input == 1 ) {
		delete_option( 'photograph_theme_options');
		$input=0;
		return absint($input);
	} 
	else {
		return '';
	}
}