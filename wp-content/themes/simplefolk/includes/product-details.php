<!-- /wp-content/themes/simplefolk/includes/product-details.php -->

<?php
$product_id = get_post_meta(get_the_ID(), '_product_id', true);

if (class_exists('WooCommerce') && !empty($product_id)) {


    $product = wc_get_product($product_id);

    if ($product && $product->exists()) {
        // Ensure the global product object is set
        global $product;
        $product = wc_get_product($product_id);
?>
<div class="product-details">
    <div class="woocommerce">
        <?php
                // Display the product price
                woocommerce_template_single_price();

                // Display the add to cart button
                woocommerce_template_single_add_to_cart();
                ?>
    </div>
</div>
<?php
    }
    
    // else {
    //     echo '<p>No product found or invalid product ID.</p>';
    // }
}
//  else {
//     if (!class_exists('WooCommerce')) {
//         echo 'WooCommerce is not active.';
//     } elseif (empty($product_id)) {
//         echo 'Product ID is not set.';
//     }
// }
?>