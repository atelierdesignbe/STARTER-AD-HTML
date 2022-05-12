<?php

// Removes the wlwmanifest link
remove_action('wp_head', 'wlwmanifest_link');
// Removes the RSD link
remove_action('wp_head', 'rsd_link');
// Removes the WP shortlink
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// Removes the canonical links
remove_action('wp_head', 'rel_canonical');
// Removes the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links_extra', 3);
// Removes links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'feed_links', 2);
// Removes the index link
remove_action('wp_head', 'index_rel_link');
// Removes the prev link
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
// Removes the start link
remove_action('wp_head', 'start_post_rel_link', 10, 0);
// Removes the relational links for the posts adjacent to the current post
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// Removes the WordPress version i.e. -
remove_action('wp_head', 'wp_generator');
