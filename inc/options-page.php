<?php

/**
 * Options page
 */

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Page d\'options',
        'menu_title' => 'Options',
        'menu_slug' => 'options-settings',
        'icon_url' => 'dashicons-admin-generic',
        'redirect' => false
    ));
}
