<?php
/**
 * The template for displaying the footer.
 */
?>

</div><!-- end #content -->


<footer id="colophon" class="site-footer">
	<div class="copyright">
		<a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" target="_blank" href="<?php echo esc_url(home_url('/')); ?>"><?php echo get_bloginfo('name', 'display'); ?></a> |
		<?php echo '&copy; ' . esc_attr__('Copyright Zachary Folk 2019, All right reserved ', 'photograph'); ?>
		<?php
		if (function_exists('the_privacy_policy_link')) {
			the_privacy_policy_link(' | ', '<span role="separator" aria-hidden="true"></span>');
		}
		?>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>