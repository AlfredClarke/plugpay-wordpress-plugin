<?php
// Template Name: Dashboard Template
get_header();
?>
<div class="dashboard-container">
    <h2><?php esc_html_e('Transaction History', 'plugpay'); ?></h2>
    <!-- Display transaction history using custom queries or WordPress functions -->
    <?php
    // Check if WooCommerce is active
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        // Check if the user is logged in
        if (is_user_logged_in()) {
            // Get the current user's ID
            $user_id = get_current_user_id();
            // Get the current user's orders
            $orders = wc_get_orders(array(
                'customer_id' => $user_id,
                'limit' => 10,
                'orderby' => 'date',
                'order' => 'DESC',
            ));
            // Output order details
            if (!empty($orders)) {
                foreach ($orders as $order) {
                    echo '<p><strong>' . esc_html($order->get_order_number()) . '</strong> - ' . esc_html($order->get_date_created()->format('F j, Y')) . '</p>';
                    echo '<ul>';
                    foreach ($order->get_items() as $item) {
                        echo '<li>' . esc_html($item->get_name()) . ' x ' . esc_html($item->get_quantity()) . '</li>';
                    }
                    echo '</ul>';
                }
            } else {
                echo '<p>' . esc_html__('No orders found.', 'plugpay') . '</p>';
            }
        } else {
            // Display a login form
            echo '<p>' . esc_html__('Please log in to view your transaction history.', 'plugpay') . '</p>';
            echo '<a href="' . esc_url(wp_login_url(get_permalink())) . '">' . esc_html__('Log In', 'plugpay') . '</a>';
        }
    } else {
        // Display an error message if WooCommerce is not active
        wp_die('<p>' . esc_html__('WooCommerce is not active. Please install and activate WooCommerce to view your transaction history.', 'plugpay') . '</p>');
    }
    ?>
</div>

<?php get_footer(); ?>
