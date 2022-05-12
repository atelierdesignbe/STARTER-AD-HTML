<?php

/**
 * Enqueue scripts
 */

function theme_register_scripts()
{
  wp_enqueue_script('theme-script', get_template_directory_uri() . '/public/assets/js/main.bundle.js', array(), rand(111, 9999), true);
}

add_action('wp_enqueue_scripts', 'theme_register_scripts');
