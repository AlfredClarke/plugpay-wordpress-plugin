<?php
// plugin-options.php

function plugpay_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('PlugPay Settings', 'plugpay'); ?></h1>
        <form method="post" action="options.php">
            <?php
            // Output security fields for the registered setting "plugpay_settings"
            settings_fields('plugpay_settings');

            // Output settings sections and their fields
            do_settings_sections('plugpay_settings');

            // Submit button
            submit_button(__('Save Settings', 'plugpay'));
            ?>
        </form>
    </div>
    <?php
}

function plugpay_register_settings() {
    // Register a new setting for "plugpay_settings" section
    register_setting('plugpay_settings', 'plugpay_general_settings', 'plugpay_validate_settings');

    // Add a new section for "plugpay_settings" page
    add_settings_section('plugpay_general_section', __('General Settings', 'plugpay'), 'plugpay_general_section_callback', 'plugpay_settings');

    // Add fields to the "plugpay_general_section" section
    add_settings_field('plugpay_text_field', __('Text Field', 'plugpay'), 'plugpay_text_field_callback', 'plugpay_settings', 'plugpay_general_section');
    add_settings_field('plugpay_checkbox_field', __('Checkbox Field', 'plugpay'), 'plugpay_checkbox_field_callback', 'plugpay_settings', 'plugpay_general_section');
    add_settings_field('plugpay_select_field', __('Select Field', 'plugpay'), 'plugpay_select_field_callback', 'plugpay_settings', 'plugpay_general_section');
}

function plugpay_general_section_callback() {
    echo '<p>'.__('General settings for PlugPay plugin.', 'plugpay').'</p>';
}

function plugpay_text_field_callback() {
    $value = get_option('plugpay_general_settings')['text_field'] ?? '';
    echo '<input type="text" name="plugpay_general_settings[text_field]" value="' . esc_attr($value) . '" />';
}

function plugpay_checkbox_field_callback() {
    $checked = (isset(get_option('plugpay_general_settings')['checkbox_field']) && get_option('plugpay_general_settings')['checkbox_field']) ? 'checked' : '';
    echo '<input type="checkbox" name="plugpay_general_settings[checkbox_field]" ' . $checked . ' />';
}

function plugpay_select_field_callback() {
    $options = array(
        'option1' => 'Option 1',
        'option2' => 'Option 2',
        'option3' => 'Option 3'
    );
    $selected = get_option('plugpay_general_settings')['select_field'] ?? '';
    echo '<select name="plugpay_general_settings[select_field]">';
    foreach ($options as $key => $label) {
        $is_selected = ($selected == $key) ? 'selected' : '';
        echo '<option value="' . esc_attr($key) . '" ' . $is_selected . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
}

function plugpay_validate_settings($input) {
    // Validate and sanitize input fields
    $validated_input = array();

    if (isset($input['text_field'])) {
        $validated_input['text_field'] = sanitize_text_field($input['text_field']);
    }

    if (isset($input['checkbox_field'])) {
        $validated_input['checkbox_field'] = ($input['checkbox_field'] === 'on') ? true : false;
    }

    if (isset($input['select_field'])) {
        $validated_input['select_field'] = sanitize_text_field($input['select_field']);
    }

    return $validated_input;
}

add_action('admin_init', 'plugpay_register_settings');
