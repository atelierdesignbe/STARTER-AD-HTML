<?php
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDo77UBqCntbsSfn1gkYyRwuqgjToez-5A';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');