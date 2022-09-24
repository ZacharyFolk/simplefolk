<?php
if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) { ?>
    <div class="entry-thumb">
        <figure class="entry-thumb-content">
            <?php the_post_thumbnail(); ?>
        </figure>
    </div>
    <?php } ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>

</article>
<?php }
} else { ?>
<h1 class="entry-title"> <?php esc_html_e('No Posts Found.', 'simplefolk'); ?> </h1>
<?php
} ?>