<?php
// WooCommerce integration hooks and filters

// Hook into WooCommerce order status change to update order status on PlugPay
add_action('woocommerce_order_status_changed', 'plugpay_update_order_status_on_plugpay', 10, 3);

// Function to update order status on PlugPay when order status changes in WooCommerce
function plugpay_update_order_status_on_plugpay($order_id, $old_status, $new_status) {
    // Check if the payment method used is PlugPay
    $order = wc_get_order($order_id);
    if ($order && $order->get_payment_method() === 'plugpay') {
        // Update order status on PlugPay
        // Example: plugpay_api_update_order_status($order_id, $new_status);
    }
}

// Add more hooks and filters as needed for additional WooCommerce integrations
?>
