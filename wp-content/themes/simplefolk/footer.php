<?php

/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
 ?>
</div><!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer">
	<div class="site-info">
		<div class="wrap">
			<div class="copyright-wrap clearfix">
			
					<div class="copyright">
						<a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" target="_blank" href="<?php echo esc_url(home_url('/')); ?>"><?php echo get_bloginfo('name', 'display'); ?></a> | <?php echo '&copy; ' . esc_attr__('Copyright Zachary Folk 2019, All right reserved ', 'photograph'); ?>
						<?php
						if (function_exists('the_privacy_policy_link')) {
							the_privacy_policy_link(' | ', '<span role="separator" aria-hidden="true"></span>');
						}
						?>
					</div>
			
			</div> <!-- end .copyright-wrap -->
			<div style="clear:both;"></div>
		</div> <!-- end .wrap -->
	</div> <!-- end .site-info -->

		<a class="go-to-top">
			<span class="icon-bg"></span>
			<i class="fa fa-angle-up back-to-top-text"></i>
			<i class="fa fa-angle-double-up back-to-top-icon"></i>
		</a>

	<div class="page-overlay"></div>
	<nav id="context-menu" class="context-menu">
		<h6>All images &copy; copyright Zachary Folk</h6>
		<!-- <p>If you are interested in licensing an image please reach out to me using my contact form</p> -->
		<!-- <ul class="context-menu__items">
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="View">
          <i class="fa fa-eye"></i> View Task
        </a>
      </li>
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="Edit">
          <i class="fa fa-edit"></i> Edit Task
        </a>
      </li>
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="Delete">
          <i class="fa fa-times"></i> Delete Task
        </a>
      </li>
    </ul> -->
	</nav>
</footer> <!-- end #colophon -->
</div><!-- end .site-content-contain -->
</div><!-- end #page -->
<?php wp_footer(); ?>

<style type="text/css">
	/* tasks */

	.tasks {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.task {
		display: flex;
		justify-content: space-between;
		padding: 12px 0;
		border-bottom: solid 1px #dfdfdf;
	}

	.task:last-child {
		border-bottom: none;
	}

	/* context menu */

	.context-menu {
		display: none;
		position: fixed;
		top: 50%;
		left: 50%;
		/* bring your own prefixes */
		/* transform: translate(-50%, -50%); */
		margin-top: -50px;
		margin-left: -120px;
		z-index: 10;
		padding: 20px;
		width: 240px;
		background-color: #fff;
		border: solid 1px #dfdfdf;
		box-shadow: 1px 1px 2px #cfcfcf;
	}

	.context-menu--active {
		display: block;
	}

	.context-menu__items {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.context-menu__item {
		display: block;
		margin-bottom: 4px;
	}

	.context-menu__item:last-child {
		margin-bottom: 0;
	}

	.context-menu__link {
		display: block;
		padding: 4px 12px;
		color: #0066aa;
		text-decoration: none;
	}

	.context-menu__link:hover {
		color: #fff;
		background-color: #0066aa;
	}
</style>
</body>

</html>