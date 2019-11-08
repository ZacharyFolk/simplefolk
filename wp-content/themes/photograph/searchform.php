<?php
/**
 * Displays the searchform
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
?>
<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<?php
		$photograph_settings = photograph_get_theme_options();
		$photograph_search_form = $photograph_settings['photograph_search_text'];?>
		<label class="screen-reader-text"><?php echo esc_html($photograph_search_form);?></label>
		<input type="search" name="s" class="search-field" placeholder="<?php echo esc_attr($photograph_search_form); ?>" autocomplete="off" />
		<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form> <!-- end .search-form -->