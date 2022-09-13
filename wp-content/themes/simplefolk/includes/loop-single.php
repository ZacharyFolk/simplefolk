<?php
while (have_posts()) :
    the_post();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
    $the_tags = get_the_tags();
    $tag_array = wp_list_pluck($the_tags, 'name');
    $tag_list = implode(', ', $tag_array);
?>

<div class="content-wrap single-post">
    <main id="main" class="single-main" role="main">
        <div id="primary" class="content-area">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (has_post_thumbnail()) :
                        // TODO : Add customizer for multiple styles here, eg: top landscape, float left, float right, full, etc.. 
                    ?>
                <figure class="main-image">
                    <a class="glightbox" data-caption="<?php echo $image_caption; ?>"
                        href="<?php the_post_thumbnail_url(); ?>">
                        <?php get_img_with_sizes('square_hero'); ?>
                    </a>
                </figure>

                <?php if ($image_caption) :
                            echo '<figcaption>' . $image_caption . '</figcaption>';
                        endif;
                    endif; ?>
                <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>
                <div class="post-meta">
                    <p>Published : <?php the_time('m/j/y g:i A'); // full dates : F jS, Y
                                        // echo " at ";
                                        // the_time('g:i a');
                                        ?>
                    </p>
                    <?php
                        $u_time = get_the_time('U');
                        $u_modified_time = get_the_modified_time('U');
                        if ($u_modified_time >= $u_time + 86400) {
                            echo "<p> | Last modified : ";
                            the_modified_time('m/j/y g:i A');

                            echo "</p> ";
                        } ?>
                </div>
                <div class="share-buttons">

                    <span> Share this post: </span>
                    <?php // get_fb_button(); // 
                        ?>

                    <div id="fb_share">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="30" height="35"
                            viewBox="0 0 30 35">
                            <title>facebook</title>
                            <path
                                d="M22.672 2c0.734 0 1.328 0.594 1.328 1.328v21.344c0 0.734-0.594 1.328-1.328 1.328h-6.109v-9.297h3.109l0.469-3.625h-3.578v-2.312c0-1.047 0.281-1.75 1.797-1.75l1.906-0.016v-3.234c-0.328-0.047-1.469-0.141-2.781-0.141-2.766 0-4.672 1.687-4.672 4.781v2.672h-3.125v3.625h3.125v9.297h-11.484c-0.734 0-1.328-0.594-1.328-1.328v-21.344c0-0.734 0.594-1.328 1.328-1.328h21.344z">
                            </path>
                        </svg>

                    </div>
                    <?php
                        //  FB only allows for a single tag :/ 
                        $first_tag = (empty($the_tags) ? '' : '#' . $the_tags[0]->name);
                        ?>
                    <script>
                    document.getElementById('fb_share').onclick = function() {
                        FB.ui({
                            display: 'popup',
                            method: 'share',
                            hashtag: '<?php echo $first_tag; ?>',
                            href: '<?php echo get_permalink(); ?>'
                        }, function(response) {})
                    }
                    </script>

                    <div id="twit_share">

                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <a target="_blank"
                            href="http://twitter.com/share?text=<?php echo the_title(); ?>&url=<?php echo the_permalink(); ?>&hashtags=<?php echo $tag_list; ?>">

                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28"
                                viewBox="0 0 26 28">
                                <title>twitter</title>
                                <path
                                    d="M25.312 6.375c-0.688 1-1.547 1.891-2.531 2.609 0.016 0.219 0.016 0.438 0.016 0.656 0 6.672-5.078 14.359-14.359 14.359-2.859 0-5.516-0.828-7.75-2.266 0.406 0.047 0.797 0.063 1.219 0.063 2.359 0 4.531-0.797 6.266-2.156-2.219-0.047-4.078-1.5-4.719-3.5 0.313 0.047 0.625 0.078 0.953 0.078 0.453 0 0.906-0.063 1.328-0.172-2.312-0.469-4.047-2.5-4.047-4.953v-0.063c0.672 0.375 1.453 0.609 2.281 0.641-1.359-0.906-2.25-2.453-2.25-4.203 0-0.938 0.25-1.797 0.688-2.547 2.484 3.062 6.219 5.063 10.406 5.281-0.078-0.375-0.125-0.766-0.125-1.156 0-2.781 2.25-5.047 5.047-5.047 1.453 0 2.766 0.609 3.687 1.594 1.141-0.219 2.234-0.641 3.203-1.219-0.375 1.172-1.172 2.156-2.219 2.781 1.016-0.109 2-0.391 2.906-0.781z">
                                </path>
                            </svg>

                        </a>
                    </div>
                </div>
                <?php the_content(); ?>

            </article>
        </div>
        <?php get_sidebar(); ?>
    </main>
</div>

</div>

<?php endwhile;