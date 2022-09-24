<?php

$the_tags = get_the_tags();
$tag_array = wp_list_pluck($the_tags, 'name');
$tag_list = implode(', ', $tag_array);

?>

<div class="share-buttons">
    <span> Share this post: </span>
    <?php // get_fb_button(); // 
    ?>
    <div id="fb_share">
        <?php get_template_part('assets/svg/fb-line-icon'); ?>
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
            <?php get_template_part('assets/svg/twitter-line-icon'); ?>
        </a>
    </div>
</div>