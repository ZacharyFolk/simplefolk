<?php

/**
 * Template Name: Attachment Hashtag Template
 */
get_header();
?>
<div id="primary_full-width" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="archive-container">
            <?php get_template_part('includes/loop', 'archive'); ?>
        </div>
    </main>
</div>
<?php
get_footer();