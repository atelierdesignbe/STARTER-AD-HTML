<?php

class SPEOS_Menu_Walker extends Walker_Nav_Menu {
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
 
    function start_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat("\t", $depth);
      $output .= "\n$indent<ul>\n";
    }
   
    function end_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent</ul>\n";
    }
   
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {


      $taxonomy = 'solutions'; //Choose the taxonomy
      $terms = get_terms( $taxonomy ); //Get all the terms
      $cats = array();
      sort_hierarchical($terms,$cats) ;
      $args = array( 'parent' => 0 );
      $parents = get_terms( array( 'solutions' ), $args );

      // SOLUTIONS
      if (in_array('solutions-menu', $item->classes)) {
              
          // LEVEL 1
          $output .= '<li class="solutions_menu menu-item-has-children">';

              $output .= '<span>' . $item->title . '</span>';

              $output .=  '<ul class="solutions_submenu-dropdown"><span class="solutions_submenu-dropdown-wrapper">';

              foreach ( $parents as $parent ) { 

                   // BY DOMAIN - BY ROLE - BY INDUSTRY
                  $output .= '<li class="solutions_menu-item-01">';
                  $output .= '<span>' . $parent->name .'</span>';

                  $output .=  '<ul class="solutions_menu-dropdown-02">';
                  $args['parent'] = $parent->term_id;
                  $argsOther['parent'] = $parent->term_id;


                     // SI IL Y A SOUS-TAXONOMY
                    if ( $parent = get_terms( array( 'solutions' ), $args ) ) { 

                    foreach ( $parent as $subchild ) {  
                      $output .= '<li class="solutions_menu-item-02-with-children">';
                      $output .= '<span class="sub_child-02">';
                      $output .=  $subchild->name;
                      $output .= '</span>';
                      $output .=  '<ul class="solutions_menu-dropdown-03">';


                      $args['parent'] = $subchild->term_id;

                      $loopSubSolutions = new WP_Query(
                        [
                            'post_type' => 'solution',
                            'orderby' => 'date',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                              array(
                                  'taxonomy' => 'solutions',
                                  'field' => 'term_id',
                                  'terms' => $args,
                              ),
                          ),
                        ]
                      );

                      while ($loopSubSolutions->have_posts()) : $loopSubSolutions->the_post(); 
  
                      $output .= '<li class="sub_child-03"><a href="'.get_the_permalink().'">';
                      $output .= get_the_title();
                      $output .= '</a>';
                      $output .= '</li>';
                    

                      endwhile;
                      wp_reset_postdata();

                      $output .=  '</span></ul>';
                    }

                     // SI IL Y A PAS DE SOUS-TAXONOMY

                  } 

                  $loopSolutionsReste = new WP_Query(
                    [
                        'post_type' => 'solution',
                        'orderby' => 'date',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                          array(
                              'taxonomy' => 'solutions',
                              'field' => 'term_id',
                              'terms' => $argsOther,
                          ),
                          array(
                            'taxonomy' => 'solutions',
                            'field' => 'term_id',
                            'terms' => array(30,31,13,12),
                            'operator' => 'NOT IN',
                        ),

                      ),
                    ]
                  );
                    while ($loopSolutionsReste->have_posts()) : $loopSolutionsReste->the_post(); 

                    $output .= '<li class="solutions_menu-item-02"><a  href="'.get_the_permalink().'">';
                    $output .= get_the_title();
                    $output .= '</a>';
                    $output .= '</li>';
                  

                    endwhile;
                    wp_reset_postdata();



                  // LOOP GENERALE DES SOLUTIONS

                      $loopSolutions = new WP_Query(
                        [
                            'post_type' => 'solution',
                            'orderby' => 'date',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                              array(
                                  'taxonomy' => 'solutions',
                                  'field' => 'term_id',
                                  'terms' => $args,
                              ),
                              array(
                                'taxonomy' => 'solutions',
                                'field' => 'term_id',
                                'terms' => array(13,12),
                                'operator' => 'NOT IN',
                            ),
                          ),
                        ]
                      );
                        while ($loopSolutions->have_posts()) : $loopSolutions->the_post(); 
  
                        $output .= '<li><a href="'.get_the_permalink().'">';
                        $output .= get_the_title();
                        $output .= '</a>';
                        $output .= '</li>';
                      

                        endwhile;
                        wp_reset_postdata();


                      $output .= '</ul>';

                  $output .= '</li>';
                  
              }

              $output .= '</ul>';


          $output .= '</li>';
          
          
      } 
      // CHALLENGES
      else if(in_array('challenges-menu', $item->classes)) {
        $output .= '<li class="challenges_menu menu-item-has-children">';
        $output .= '<span>';
        $output .= $item->title;
        $output .= '</span>';
        $output .=  '<ul class="challenges_submenu-dropdown">';

        $loopChall= new WP_Query(
          [
              'post_type' => 'challenge',
              'orderby' => 'date',
              'posts_per_page' => -1
          ]);

          while ($loopChall->have_posts()) : $loopChall->the_post();

          $output .= '<li><a style="color:red;"  href="'.get_the_permalink().'">';
          $output .= get_the_title();
          $output .= '</a>';
          $output .= '</li>';

          endwhile;
          wp_reset_postdata();

        $output .=  '</ul>';
        $output .= '</li>';
      } 
      // OTHER
      else {
   
      global $wp_query;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
      $class_names = $value = '';        
      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
   
      /* Add active class */
      if(in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
        unset($classes['current-menu-item']);
      }
   
      /* Check for children */
      $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
      if (!empty($children)) {
        $classes[] = 'has-sub';
      }
   
      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
   
      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
   
      $output .= $indent . '<li' . $id . $value . $class_names .'>';
   
      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
   
      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'><span>';
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $item_output .= '</span></a>';
      $item_output .= $args->after;
   
      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }

    }
   
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
      $output .= "</li>\n";
    }
  }


