<?php
while (have_posts()) :
    the_post();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
    $image = wp_get_attachment_image($image_id, 'medium_large');
    $full_image_link = wp_get_attachment_image_url($post->ID, 'full');

?>
<div class="wrap">
    <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>
    <div class="content-wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ($image) : ?>
                    <figure class="main-image">
                        <?php
                                // todo : add a simple modal to link to $full_image_link
                                echo $image; ?>
                    </figure>
                    <?php if ($image_caption) :
                                echo '<figcaption>' . $image_caption . '</figcaption>';
                            endif;
                        endif; ?>
                </article>
            </main>
        </div>
        <?php get_template_part('includes/archive-sidebar'); ?>
    </div>
    <?php endwhile; ?>

    <script>
    const image = document.querySelectorAll(".main-image img");
    let fullSizedImage = "<?php echo $full_image_link; ?>"; // todo : add this as data-attribute to the image
    // will have to override core wp_get_attachment_image_url or think of something better
    if (fullSizedImage) {
        image.forEach((img) => {
            img.addEventListener("click", (e) => {
                imgModal(fullSizedImage);
            });
        });
        let imgModal = (src) => {
            const modal = document.createElement("div");
            modal.setAttribute("class", "modal");

            const closeBtn = document.createElement("span");
            closeBtn.setAttribute("class", "close-button");

            document.querySelector("body").append(modal);
            const newImage = document.createElement("img");
            newImage.setAttribute("src", src);
            modal.append(newImage, closeBtn);

            closeBtn.onclick = () => {
                modal.remove();
            };
            document.onkeydown = function(evt) {
                evt = evt || window.event;
                var isEscape = false;
                if ("key" in evt) {
                    isEscape = (evt.key === "Escape" || evt.key === "Esc");
                } else {
                    isEscape = (evt.keyCode === 27);
                }
                if (isEscape) {
                    modal.remove();
                }
            };
        };
    }
    </script>