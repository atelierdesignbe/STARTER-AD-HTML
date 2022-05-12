<?php
// BEGIN dev+ custom alt code
// custom CSS for admin pages
add_action( 'admin_head', 'devplus_custom_admin_css' );
function devplus_custom_admin_css() {
	
	$admin_css_path = './assets/scss/devplus-admin.css';
	
	?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); echo $admin_css_path; ?>?v=<?php echo filemtime( get_template_directory() . $admin_css_path ); ?>" />
	<?php
	
}

// custom image alt
function devplus_get_image_alt( $attachment_id ) {
	
	// default site name + page title
	$alt = get_bloginfo( 'name' );
	
	if ( $page_title = get_the_title() ) {
		
		$alt .= " $page_title";
		
	}
	
	if ( function_exists( 'get_field' ) && function_exists( 'pll_current_language' ) ) {
		
		$acf_alt = get_field( 'alt_' . pll_current_language(), $attachment_id );
		
		if ( ! empty( $acf_alt ) ) {
			
			$alt = $acf_alt;
			
		}
		
	}
	
	return $alt;
	
}

add_filter( 'the_content', 'devplus_the_content', 999 );
add_filter( 'acf_the_content', 'devplus_the_content', 999 );
function devplus_the_content( $content ) {

	// haal alle images uit de content en geef ze de correcte alt
	if ( preg_match_all( '/<img [^>]+>/', $content, $imgs_matches ) ) {

		foreach ( $imgs_matches[0] as $image ) {

			$content = str_replace( $image, devplus_replace_img_alt( $image ), $content );

		}

	}

	return $content;

}

function devplus_replace_img_alt( $image ) {

	// determine the attachment id
	if ( preg_match( '/wp-image-([0-9]+)/i', $image, $class_id ) ) {

		$attachment_id = absint( $class_id[1] );

		if ( $attachment_id ) {

			$alt = esc_attr( devplus_get_image_alt( $attachment_id ) );

			if ( strstr( $image, 'alt="' ) === false ) {

				$image = str_replace( '<img', '<img alt="' . $alt . '"', $image );

			} else {

				$image = preg_replace( '/alt="(|[^"]+)"/', 'alt="' . $alt . '"', $image );

			}

		}

	}

	return $image;

}

// use this function to print images in page
function devplus_the_image( $acf_value, $image_size, $add ) {
	
	if ( ! empty( $acf_value ) ) {
		
		// if $acf_value is an integer (crop addon), format it first
		if ( is_numeric( $acf_value ) && function_exists( 'acf_get_attachment' ) ) {
			
			$acf_value = acf_get_attachment( $acf_value );
			
		}
		
		if ( ! empty( $acf_value ) && ! empty( $acf_value['ID'] ) && ! empty( $image_size ) && ! empty( $acf_value['sizes'][$image_size] ) ) {
			
			// custom alt when provided in back-end.
			echo '<img ' . $add . '" src="' . esc_url( $acf_value['sizes'][$image_size] ) . '" alt="' . esc_attr( devplus_get_image_alt( $acf_value['ID'] ) ) . '">';
			
		}
		
	}

}
// END dev+ custom alt code