<?php
// Input data validation functions

// Function to sanitize and validate input data
function plugpay_validate_input($data) {
    // Example: use WordPress sanitize functions
    $sanitized_data = array();
    foreach ($data as $key => $value) {
        $sanitized_data[$key] = sanitize_text_field($value);
    }
    return $sanitized_data;
}
?>
