<?php
// Encryption and decryption functions

// Function to encrypt data
function plugpay_encrypt_data($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

// Function to decrypt data
function plugpay_decrypt_data($encrypted_data, $key) {
    $data = base64_decode($encrypted_data);
    $iv_size = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $iv_size);
    $encrypted = substr($data, $iv_size);
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}
?>
