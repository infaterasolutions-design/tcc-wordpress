<?php
// reset-template.php
// Place this in your WordPress root directory or theme directory and run via SSH or browser

require_once dirname(__DIR__, 2) . '/wp-load.php'; // Adjust path if placed elsewhere

$page_id = 43;
$meta_key = '_wp_page_template';

if (!function_exists('delete_post_meta')) {
    die("WordPress environment not loaded correctly.\n");
}

$deleted = delete_post_meta($page_id, $meta_key);

if ($deleted) {
    echo "SUCCESS: Deleted '$meta_key' for Page ID $page_id. The page will now use the Default Template.\n";
} else {
    // Maybe it was already default, let's explicitly set it just in case
    update_post_meta($page_id, $meta_key, 'default');
    echo "NOTICE: Set '$meta_key' to 'default' for Page ID $page_id.\n";
}
