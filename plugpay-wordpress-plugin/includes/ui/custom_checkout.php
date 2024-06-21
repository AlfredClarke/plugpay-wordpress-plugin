<?php
// Customize WooCommerce checkout page
function plugpay_customize_checkout_page() {
    // Your code to customize the checkout page (e.g., add PlugPay payment method selector)
}

// Hook into WooCommerce checkout page to apply customization
add_action('woocommerce_checkout_before_customer_details', 'plugpay_customize_checkout_page');
?>
