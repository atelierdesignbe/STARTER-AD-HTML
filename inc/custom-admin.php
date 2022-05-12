<?php

// CUSTOM LOGIN AND ADMIN FOOTER

/**
 * Enqueue custom login
 */

function my_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/custom-admin/css/style-login.css');
}
add_action('login_enqueue_scripts', 'my_login_stylesheet');


/**
 * Custom admin footer
 */

function removeFooterAdmin()
{
    echo "Created by <a href='https://www.atelierdesign.be' target='_blank'>Atelier Design</a> / Powered by <a href='http://www.wordpress.org' target='_blank'>Wordpress</a>";
}
add_filter('admin_footer_text', 'removeFooterAdmin');
