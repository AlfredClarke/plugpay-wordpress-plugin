<?php
/*
Plugin Name: Custom PlugPay WooCommerce Integration
Description: Custom integration with PlugPay for WooCommerce.
Version: 1.0
Author: Your Name
*/

// Ensure this file is being called by WordPress and WooCommerce is active
if (!defined('ABSPATH')) {
    exit;
}

// Hook into WooCommerce to initialize the integration
add_action('woocommerce_init', 'plugpay_woocommerce_init');

// Initialize the integration
function plugpay_woocommerce_init() {
    // Add custom payment gateway for PlugPay
    add_filter('woocommerce_payment_gateways', 'plugpay_add_payment_gateway');
}

// Function to add custom payment gateway for PlugPay
function plugpay_add_payment_gateway($gateways) {
    $gateways[] = 'WC_PlugPay_Gateway';
    return $gateways;
}

// Define custom payment gateway class
class WC_PlugPay_Gateway extends WC_Payment_Gateway {
    // Constructor method
    public function __construct() {
        $this->id = 'plugpay';
        $this->method_title = 'PlugPay';
        $this->method_description = 'Pay with PlugPay';
        $this->title = 'PlugPay';
        $this->has_fields = false;
        $this->supports = array(
            'products'
        );
        $this->init_form_fields();
        $this->init_settings();
        add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
    }

    // Initialize form fields
    public function init_form_fields() {
        $this->form_fields = array(
            'enabled' => array(
                'title'   => __('Enable/Disable', 'woocommerce'),
                'type'    => 'checkbox',
                'label'   => __('Enable PlugPay', 'woocommerce'),
                'default' => 'yes',
            ),
            'title' => array(
                'title'       => __('Title', 'woocommerce'),
                'type'        => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
                'default'     => __('PlugPay', 'woocommerce'),
                'desc_tip'    => true,
            ),
            // Add more settings as needed
        );
    }

    // Payment processing logic
    public function process_payment($order_id) {
        global $woocommerce;
        $order = wc_get_order($order_id);

        // Mark order as processing
        $order->update_status('processing', __('Payment received via PlugPay', 'woocommerce'));

        // Reduce stock levels
        $order->reduce_order_stock();

        // Empty cart
        $woocommerce->cart->empty_cart();

        // Return thank you page redirect
        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url($order),
        );
    }

    // Receipt page content
    public function receipt_page($order_id) {
        echo '<p>' . __('Thank you for your order, please click the button below to pay with PlugPay.', 'woocommerce') . '</p>';
        echo $this->generate_plugpay_form($order_id);
    }

    // Generate payment form
    public function generate_plugpay_form($order_id) {
        $order = wc_get_order($order_id);
        $amount = $order->get_total();

        // Construct payment URL and form
        $payment_url = 'https://plugpay.com/pay?amount=' . $amount . '&order_id=' . $order_id; // Example URL
        $form = '<a href="' . $payment_url . '" class="button alt">' . __('Pay with PlugPay', 'woocommerce') . '</a>';
        return $form;
    }
}
?>
