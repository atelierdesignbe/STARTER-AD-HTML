<?php
function filter_uses_cases() {

$postType = $_POST['type'];
$tax = $_POST['category'];
;

$ajaxposts = new WP_Query([
 'post_type' => $postType,
  'posts_per_page' => -1,
  'tax_query' => [
    [
        'taxonomy' => 'use_cases_category',
        'field'    => 'slug',
       'terms'    => $tax ,
       'operator' => 'IN'
    ],
 ]
]);
$response = '';

if($ajaxposts->have_posts()) {
  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
    $response .= get_template_part( './templates/uses-cases/card-uses-item' );

  endwhile;
} else {
  $response = 'empty';
  
}

echo $response;
exit;
}
add_action('wp_ajax_filter_uses_cases', 'filter_uses_cases');
add_action('wp_ajax_nopriv_filter_uses_cases', 'filter_uses_cases'); 



function reset_uses_cases() {

$postType = $_POST['type'];
$tax = $_POST['category'];
;

$ajaxposts = new WP_Query([
 'post_type' => $postType,
  'posts_per_page' => -1,
]);
$response = '';

if($ajaxposts->have_posts()) {
  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
  $response .= get_template_part( './templates/uses-cases/card-uses-item' );

  endwhile;
} else {
  $response = 'empty';
  
}

echo $response;
exit;
}
add_action('wp_ajax_reset_uses_cases', 'reset_uses_cases');
add_action('wp_ajax_nopriv_reset_uses_cases', 'reset_uses_cases');