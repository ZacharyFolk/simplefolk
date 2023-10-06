<?php

/**
 * Template Name: Attachment Hashtag Template
 */
get_header();
// Get the ID of the current queried object (custom taxonomy term)
$term = get_queried_object();
?>
<div class="tax-header">
    <div class="tax-name">
        <?php echo $term->name; ?>
    </div>
    <?php if (!empty($term->description)) : ?>

        <div class="tax-desc">
            <?php echo $term->description; ?>
        </div>
    <?php endif; ?>
</div>
<div id="primary_full-width" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="archive-container">
            <?php get_template_part('includes/loop', 'archive'); ?>
        </div>
    </main>
</div>
<?php
get_footer();
