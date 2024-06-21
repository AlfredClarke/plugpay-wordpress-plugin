<?php
// Customize WooCommerce order confirmation emails
function plugpay_customize_order_confirmation_email($order_id, $order) {
    // Your code to customize order confirmation email content
}

// Hook into WooCommerce email header to apply customization
add_action('woocommerce_email_header', 'plugpay_customize_order_confirmation_email', 10, 2);
?>
