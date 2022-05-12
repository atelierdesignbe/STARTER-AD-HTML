<?php
wp_enqueue_script('jquery');   
wp_localize_script( 'jquery', 'my_ajax_vars', array(
    'ajaxurl'       => admin_url( 'admin-ajax.php' )
));