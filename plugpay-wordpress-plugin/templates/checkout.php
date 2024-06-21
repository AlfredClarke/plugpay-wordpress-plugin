<?php
// Template Name: Check Template
get_();
?>
<div class="checkoutcontainer">
    <h2><? esc_html_e('Checkout', 'plugpay'); ?></h2>
    <!-- Customize checkout process using WooCommerce template tags and functions -->
    <?php
    // Check if WooCommerce is active
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        // Check if the user is logged in
        if (is_user_logged_in()) {
            // Display the checkout form
            if (function_exists('woocommerce_checkout')) {
                woocommerce_checkout();
            }
        } else {
            // Display a login form
            echo '<p>' . esc_html__('Please log in to proceed to checkout.', 'plugpay') . '</p>';
            echo '<a href="' . esc_url(wp_login_url(get_permalink())) . '">' . esc_html__('Log In', 'plugpay') . '</a>';
        }
    } else {
        // Display an error message if WooCommerce is not active
        wp_die('<p>' . esc_html__('WooCommerce is not active. Please install and activate WooCommerce to proceed to checkout.', 'plugpay') . '</p>');
    }
    ?>
</div>

<?php get_footer(); ?>
