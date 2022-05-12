<?php

/**
 * Completely Remove jQuery From WordPress
 */
function remove_jquery()
{
    if (!is_admin()) {
        /*wp_deregister_script('jquery');*/
        /* wp_register_script('jquery', false);*/
    }
}

add_action('init', 'remove_jquery');
