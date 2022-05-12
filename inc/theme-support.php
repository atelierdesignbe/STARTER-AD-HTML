<?php

/**
 * Theme support
 */

function theme_support()
{
    // Dynamic title tag support
    //add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'theme_support');
