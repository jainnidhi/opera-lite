<?php
/**
 * Opera functions and definitions
 *
 * @package Opera
 * @since Opera 1.0
 */

require( get_template_directory() . '/inc/customizer.php' ); // new customizer options


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Opera 1.0
 *
 * @return void
 */
if ( ! function_exists( 'opera_setup' ) ) {
	function opera_setup() {
		global $content_width;
                
                /**
                 * Set the content width based on the theme's design and stylesheet.
                 *
                 * @since Opera 1.0
                 */
                if ( ! isset( $content_width ) )
                        $content_width = 980; /* Default the embedded content width to 790px */


		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Opera, use a find and replace
		 * to change 'opera' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'opera', trailingslashit( get_template_directory_uri() ) . 'languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Create an extra image size for the Post featured image
		add_image_size( 'post_feature_full_width', 1500, 300, true );
                              
                
		// This theme uses wp_nav_menu() in one location
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'opera' ),
			) );

		// This theme supports a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

		// Enable support for Custom Backgrounds
		add_theme_support( 'custom-background', array(
				// Background color default
				'default-color' => 'eee',
				// Background image default
				'default-image' => ''
                                
			) );
               
	}
}
add_action( 'after_setup_theme', 'opera_setup' );



/**
 * Enqueue scripts and styles
 *
 * @since Opera 1.0
 *
 * @return void
 */
function opera_scripts_styles() {

	// Register and enqueue our icon font
	// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
	wp_enqueue_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'assets/css/font-awesome.min.css' , array(), '4.0.3', 'all' );
       
        wp_enqueue_style( 'opera-scrollbar', trailingslashit( get_template_directory_uri() ) . 'assets/css/jquery.mCustomScrollbar.css' , array(), '1.0', 'all' );
        
	$fonts_url = 'http://fonts.googleapis.com/css?family=Lato:300,400,700|Poly:300,400,700';
	if ( !empty( $fonts_url ) ) {
		wp_enqueue_style( 'opera-fonts', esc_url_raw( $fonts_url ), array(), null );
	}

	// Enqueue the default WordPress stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0', 'all' );
       

	/**
	 * Register and enqueue our scripts
	 */

	// Load Modernizr at the top of the document, which enables HTML5 elements and feature detects
	wp_enqueue_script( 'modernizr', trailingslashit( get_template_directory_uri() ) . 'assets/js/modernizr-2.7.1-min.js', array(), '2.7.1', false );
        wp_enqueue_script('jquery'); 
      
	wp_enqueue_script( 'opera-slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js' );
        wp_enqueue_script('opera-scrollbar', get_template_directory_uri() . '/assets/js/jquery.mCustomScrollbar.js', array(), '1.0', 'all', false);
        wp_enqueue_script('opera-custom-scripts', get_template_directory_uri() . '/assets/js/custom-scripts.js', array(), '1.0', 'all', false);
       
	
	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'opera_scripts_styles' );


/**
 * Register widgetized areas
 *
 * @since Opera 1.0
 *
 * @return void
 */
function opera_widgets_init() {
	register_sidebar( array(
			'name' => esc_html__( 'Main Sidebar', 'opera' ),
			'id' => 'sidebar-main',
			'description' => esc_html__( 'Appears in the sidebar on posts and pages except the optional Front Page template, which has its own widgets', 'opera' ),
			'before_widget' => '<aside id="%1$s" class=" clearfix widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		) );

}
add_action( 'widgets_init', 'opera_widgets_init' );


/**
 * Adjusts content_width value for full-width templates and attachments
 *
 * @since Opera 1.0
 *
 * @return void
 */
function opera_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1140;
	}
}
add_action( 'template_redirect', 'opera_content_width' );


/**
 * Change the "read more..." link so it links to the top of the page rather than part way down
 *
 * @since Opera 1.0
 *
 * @param string The 'Read more' link
 * @return string The link to the post url without the more tag appended on the end
 */
function opera_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'opera_remove_more_jump_link' );


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Opera 1.0
 *
 * @return string The 'Continue reading' link
 */
function opera_continue_reading_link() {
	return '&hellip;<p><a class="more-link" href="'. esc_url( get_permalink() ) . '" title="' . esc_html__( 'Read More', 'opera' ) . ' &lsquo;' . get_the_title() . '&rsquo;">' . wp_kses( __( 'Read More', 'opera' ), array( 'span' => array( 
			'class' => array() ) ) ) . '</a></p>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with the opera_continue_reading_link().
 *
 * @since Opera 1.0
 *
 * @param string Auto generated excerpt
 * @return string The filtered excerpt
 */
function opera_auto_excerpt_more( $more ) {
	return opera_continue_reading_link();
}
add_filter( 'excerpt_more', 'opera_auto_excerpt_more' );



/*
 * 
 * Set excerpt length for post on front page
 * and post excerpts on rest of the pages.
 * 
 */
function opera_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'post') {
        return 20;
    }
   
    else {
        return 50;
    }
}
add_filter('excerpt_length', 'opera_excerpt_length');


/**
 * Add Filter to allow Shortcodes to work in the Sidebar
 *
 * @since Opera 1.0
 */
add_filter( 'widget_text', 'do_shortcode' );

/** 
 * Additional settings for Easy Digital Downloads
 * 
 * @since Opera 1.0
 */


/**
 * Recreate the default filters on the_content
 * This will make it much easier to output the Theme Options Editor content with proper/expected formatting.
 * We don't include an add_filter for 'prepend_attachment' as it causes an image to appear in the content, on attachment pages.
 * Also, since the Theme Options editor doesn't allow you to add images anyway, no big deal.
 *
 * @since Opera 1.0
 */
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars'  );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop'  );


/*
 * Check if the front page is set 
 * to display latest blog posts
 * or a static front page
 * 
 * If it's set to display blog posts
 * then ignore the front-page.php 
 * template and head over to index.php
 * 
 *  
 * @since Opera 1.0
 */


function opera_filter_front_page_template( $template ) {
     return is_home() ? '' : $template ;
}
add_filter( 'frontpage_template', 'opera_filter_front_page_template' );


function opera_custom_favicon(){ 
    if(get_theme_mod('custom_favicon')) { ?>
    <link rel="shortcut icon" href="<?php echo get_theme_mod('custom_favicon'); ?> " />
    <?php }
}
add_action('wp_head','opera_custom_favicon');


/* Add theme extras */
require( get_template_directory() . '/inc/theme-extras.php' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );


class Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
               
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
                if($item->description != '') { $item_output .= '<i class="fa '. $item->description . '"></i>'; }
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
                
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}