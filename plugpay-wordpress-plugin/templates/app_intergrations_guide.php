<?php
// Template Name: App Integration Guide Template
get_header();
?>

<div class="app-integration-guide-container">
    <h2><?php esc_html_e('App Integration Guide', 'plugpay'); ?></h2>
    <!-- Provide app integration instructions with dynamic content -->
    <?php
    // Example: Display integration steps
    $integration_steps = array(
        esc_html__('Step 1: Download the PlugPay app from the App Store or Google Play Store.', 'plugpay'),
        esc_html__('Step 2: Register or log in to your PlugPay account within the app.', 'plugpay'),
        esc_html__('Step 3: Follow the instructions in the app to link your WooCommerce store.', 'plugpay'),
    );
    foreach ($integration_steps as $step) {
        echo '<p>' . $step . '</p>';
    }
    ?>
</div>

<?php
// Handle form submission
if (isset($_POST['action']) && $_POST['action'] === 'submit_contact_form') {
    // Validate form data
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    // Check if the email address is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        wp_die('<p>' . esc_html__('Please enter a valid email address.', 'plugpay') . '</p>');
    }

    // Send the email
    $to = 'your-email@example.com';
    $subject = 'Contact Form Submission from ' . $name;
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    wp_mail($to, $subject, $body);

    // Display a success message
    echo '<p>' . esc_html__('Your message has been sent successfully.', 'plugpay') . '</p>';
}
?>

<?php get_footer(); ?>
