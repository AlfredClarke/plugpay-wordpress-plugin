<?php
// settings-page.php

function plugpay_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('PlugPay Settings', 'plugpay'); ?></h1>

        <h2 class="nav-tab-wrapper">
            <a href="?page=plugpay-settings&tab=general" class="nav-tab <?php echo ($_GET['tab'] === 'general' || !isset($_GET['tab'])) ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('General', 'plugpay'); ?></a>
            <a href="?page=plugpay-settings&tab=payment" class="nav-tab <?php echo ($_GET['tab'] === 'payment') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Payment', 'plugpay'); ?></a>
            <a href="?page=plugpay-settings&tab=advanced" class="nav-tab <?php echo ($_GET['tab'] === 'advanced') ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Advanced', 'plugpay'); ?></a>
        </h2>

        <?php
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';

        switch ($active_tab) {
            case 'general':
                include_once('settings-general.php');
                break;
            case 'payment':
                include_once('settings-payment.php');
                break;
            case 'advanced':
                include_once('settings-advanced.php');
                break;
            default:
                include_once('settings-general.php');
        }
        ?>
    </div>
    <?php
}
