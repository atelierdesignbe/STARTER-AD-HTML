<?php

/**
 * Register navigation
 */

function register_theme_nav()
{
  $locations = array(
    'Header' => "Header navigation",
    'Footer' => "Footer navigation"
  );

  register_nav_menus($locations);
}

add_action('init', 'register_theme_nav');
