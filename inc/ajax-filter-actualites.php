<?php
function filter_actualites() {

$postType = $_POST['type'];
$tax = $_POST['category'];
;

$ajaxposts = new WP_Query([
 'post_type' => $postType,
  'posts_per_page' => -1,
  'tax_query' => [
    [
        'taxonomy' => 'news_cat',
        'field'    => 'slug',
       'terms'    => $tax ,
       'operator' => 'IN'
    ],
 ]
]);
$response = '';

if($ajaxposts->have_posts()) {
  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
    $response .= get_template_part( './templates/news/card-news-item' );

  endwhile;
} else {
  $response = 'empty';
  
}

echo $response;
exit;
}
add_action('wp_ajax_filter_actualites', 'filter_actualites');
add_action('wp_ajax_nopriv_filter_actualites', 'filter_actualites'); 



function reset_actualites() {

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
    $response .= get_template_part( './templates/news/card-news-item' );
  endwhile;
} else {
  $response = 'empty';
  
}

echo $response;
exit;
}
add_action('wp_ajax_reset_actualites', 'reset_actualites');
add_action('wp_ajax_nopriv_reset_actualites', 'reset_actualites');