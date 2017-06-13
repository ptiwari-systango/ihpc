<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
 
 function my_nav_wrap() {
  // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'  
  // open the <ul>, set 'menu_class' and 'menu_id' values
  $wrap  = '<ul id="%1$s" class="%2$s">';
  // get nav items as configured in /wp-admin/
  $wrap .= '%3$s';
  // the static link
  if( !is_user_logged_in() ){
  	$wrap .= '<li class="active top_submit_review"><a href="'.site_url('submit-review').'">submit review</a></li>
  			<li class="top_login"><a href="'.site_url('login').'">Log in</a></li>
  			<li><a href="'.site_url('sign-up').'">Sign up</a></li>
  			<li><a href="#"><img src="'.site_url("wp-content/themes/ihpc/assets/images/bars_icon.png").'"></a></li>';
  }
  else{
  	$wrap .= '<li class="active top_submit_review"><a href="'.site_url('submit-review').'">submit review</a></li>
  			<li><a href="'.wp_logout_url( ).'">Log out</a></li>
  			<li><a href="#"><img src="'.site_url("wp-content/themes/ihpc/assets/images/bars_icon.png").'"></a></li>';
  }  
  // close the <ul>
  $wrap .= '</ul>';
  // return the result
  return $wrap;
}
 
function ihpc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/ihpc
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'ihpc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ihpc' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'ihpc-featured-image', 2000, 1200, true );

	add_image_size( 'ihpc-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'ihpc' ),
		'social' => __( 'Social Links Menu', 'ihpc' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', ihpc_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
			
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'ihpc' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'ihpc' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'ihpc' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'ihpc' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'ihpc' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'ihpc_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );

	//New Customer type role
	/*$result = add_role(
		'companycustomer',
		__( 'Customer' ),
		array(
			'read'         => true,  // true allows this capability
			'edit_posts'   => true,
			'delete_posts' => false, // Use false to explicitly deny
		)
	);*/
}
add_action( 'after_setup_theme', 'ihpc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ihpc_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( ihpc_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'ihpc_content_width', $content_width );
}
add_action( 'template_redirect', 'ihpc_content_width', 0 );

/**
 * Register custom fonts.
 */
function ihpc_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'ihpc' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ihpc_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'ihpc-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ihpc_resource_hints', 10, 2 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ihpc_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Front Page Sidebar: Top', 'ihpc' ),
		'id'            => 'frontpage-sidebar-1',
		'description'   => __( 'Add widgets here to appear in your frontpage.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget hot-topics %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title sub-title"><span class="icon"></span>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Front Page Sidebar: Bottom', 'ihpc' ),
		'id'            => 'frontpage-sidebar-2',
		'description'   => __( 'Add widgets here to appear in your frontpage.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget hot-topics %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title sub-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ihpc' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget hot-topics %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title sub-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ihpc' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget col-lg-3 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ihpc' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget col-lg-3 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	

	register_sidebar( array(
			'name'          => __( 'Footer 4', 'ihpc' ),
			'id'            => 'footer-4',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' 
		) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 5', 'ihpc' ),
		'id'            => 'footer-5',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' 
	) );

	register_sidebar( array(
		'name'          => __( 'All Right Reserved', 'ihpc' ),
		'id'            => 'footer-policy',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ihpc' ),
		'before_widget' => '<section id="%1$s" class="widget policy-text %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/*register_sidebar( array(
		'name'          => __( 'Sidebar Banners', 'ihpc' ),
		'id'            => 'images-banner',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div id="%1$s" class="google_adds %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' 
	) );*/

}
add_action( 'widgets_init', 'ihpc_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function ihpc_excerpt_more( ) {

	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'ihpc_excerpt_more' );

//Limit Excerpt length
function ihpc_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'ihpc_excerpt_length', 999 );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function ihpc_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'ihpc_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ihpc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'ihpc_pingback_header' );

/**
 * Display custom color CSS.
 */
function ihpc_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo ihpc_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'ihpc_colors_css_wrap' ); 

/** 
 * Enqueue scripts and styles.
 */
function ihpc_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ihpc-fonts', ihpc_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'ihpc-style', get_stylesheet_uri() );
	//Font-Awesome Min
	wp_enqueue_style( 'ihpc-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'ihpc-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto' );
	wp_enqueue_style( 'ihpc-font-roboto-slab', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' );


	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'ihpc-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'ihpc-style' ), '1.0' );
		wp_style_add_data( 'ihpc-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'ihpc-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'ihpc-style' ), '1.0' );
	wp_style_add_data( 'ihpc-ie8', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'bootstrap-min', get_theme_file_uri( '/assets/css/bootstrap.min.css' ), array( 'ihpc-style' ), '1.0' );
	//theme CSS
	wp_enqueue_style( 'theme-css', get_theme_file_uri( '/assets/css/theme.css' ), array( 'ihpc-style' ), '1.0' );
	wp_enqueue_style( 'theme-responsive-css', get_theme_file_uri( '/assets/css/responsive_theme.css' ), array( 'ihpc-style' ), '1.0' );
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	$ihpc_l10n = array(
		'quote'  => ihpc_get_svg( array( 'icon' => 'quote-right' ) ),
	);
	
	wp_enqueue_script( 'bootstrap-min', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'ihpcscripts', get_theme_file_uri( '/assets/js/ihpcscripts.js' ), array( 'jquery' ), '1.0', true );
	wp_localize_script('ihpcscripts','ihcpvars',array('ihcp_nonce' => wp_create_nonce('ihcp_nonce'), 'ihcp_ajax_url' => admin_url( 'admin-ajax.php' )));


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ihpc_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function ihpc_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'ihpc_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function ihpc_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'ihpc_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function ihpc_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ihpc_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function ihpc_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'ihpc_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

//Including ReduxFramework in theme
//Author: DharmendraSingh
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/options-config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/options-config.php' );
}

//Require registered post type posts
require_once(dirname( __FILE__ ).'/post-types/postregister.php');


add_action( 'wp_ajax_home_search_title', 'home_search_title' );
add_action( 'wp_ajax_nopriv_home_search_title', 'home_search_title' );
function home_search_title(){
	print_r($_POST);

	wp_die();
}

//Pre Get posts filter via Ajax
add_action( 'wp_ajax_archive_company_filter', 'archive_company_filter' );
add_action( 'wp_ajax_nopriv_archive_company_filter', 'archive_company_filter' );
function archive_company_filter(){

	echo $_POST;
	add_filter( 'pre_get_posts', 'my_get_posts' );
	function my_get_posts( $query ) {
		if ( is_home() ) {
			$query->set( 'post_type', 'event' );
			$query->set( 'meta_key', '_start_date' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
			$query->set( 'meta_query', array(
				array(
					'key' => '_start_date'
				),
				array(
					'key' => '_end_date',
					'value' => time(),
					'compare' => '>=',
					'type' => 'numeric'
				)
			));
		}
		return $query;
	}

}

//Social Login FB,Google,Twitter
add_action( 'wp_ajax_ihpc_social_login', 'ihpc_social_login' );
add_action( 'wp_ajax_nopriv_ihpc_social_login', 'ihpc_social_login' );
function ihpc_social_login(){
	print_r($_POST);
	wp_die();
}

/***
* Register home page sidebar
* Refer function ihpc_widgets_init();
****/

/***
* Including IHPC required widgets
****/
include_once 'ihpc-widgets/most-active-users.php';
include_once 'ihpc-widgets/most-active-companies.php';

/****
* Getting most hatted power companies
****/
function get_companies_by_date($posts_per_page,$index){
	//Posts from current week
	if($index == 1){
		$dateQ = array( 'year' => date( 'Y' ), 'week' => date( 'W' ) );
	}
	//Posts 1 week ago
	if($index == 2){
		$dateQ = array( 'year' => date( 'Y' ), 'week' => date( 'W', strtotime('-1 Week') ) );
	}
	//Posts 1 month ago
	if($index == 3){
		$dateQ = array( 'year' => date( 'Y' ), 'month' => date( 'm', strtotime('-1 Month') ) );
	}
	$args = array(	'posts_per_page' => $posts_per_page,
					'post_type'	=> 'companies',
					'meta_key'  => 'ratings_average',
					'orderby'  	=> array( 'meta_value_num' => 'ASC', 'title' => 'ASC' ),
					'date_query' => array($dateQ)
				);
	$array = array();
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$ratting = get_post_meta(get_the_ID(), 'ratings_average', true);
			$nu_user_ratted = get_post_meta(get_the_ID(), 'ratings_users', true);			
			$array[$i]['url'] 			= get_permalink();
			$array[$i]['title'] 		= get_the_title();
			$array[$i]['date'] 			= get_the_date();
			$array[$i]['ihpc_ratings'] 	= $ratting;
			$array[$i]['nu_user_ratted'] 	= $nu_user_ratted;
			$i++;	
		}
	}
	return $array;
}


/*function most_hatted_power_companies(){
	$args = array(	'posts_per_page' => 20,
					'post_type'	=> 'companies',
					'meta_key'  => 'ratings_average',
					'orderby'  	=> array( 'meta_value_num' => 'ASC', 'title' => 'ASC' ),
				);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		$html1= $html2 = $html3 = '';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();			
			$nu_user_ratted = get_post_meta(get_the_ID(), 'ratings_users', true);			

			$curr_time 		= current_time( 'timestamp' );
			$last_month1 	= strtotime("-1 month",$curr_time);
			$last_month2 	= strtotime("-2 month",$curr_time);
			$last_week1 	= strtotime("-1 week",$curr_time);
			$last_week2 	= strtotime("-2 week",$curr_time);
			$post_date 		= strtotime(get_the_date());

			//This week posts
			if( ($post_date>$last_week1) ){
				$html1 .= '<li>
							<a href="'.get_permalink().'">'.get_the_title().'</a> 
							<span class="user-number">'.$nu_user_ratted.'</span>							
						</li>';
			}			
			//Getting last week posts
			if( ($post_date<=$last_week1) && ($post_date > $last_week2) ){
				$html2 .= '<li>
							<a href="'.get_permalink().'">'.get_the_title().'</a> 
							<span class="user-number">'.$nu_user_ratted.'</span>
								
						</li>';
			}
			//Getting last month posts
			if( ($post_date < $last_month1) && ($post_date > $last_month2) ){
				$html3 .= '<li>
							<a href="'.get_permalink().'">'.get_the_title().'</a> 
							<span class="user-number">'.$nu_user_ratted.'</span>
						  </li>';
			}			
		}
		wp_reset_postdata();
		$rtn = '';
		$rtn .= "<div class='col-md-4 user-list'><h4>Now</h4><ul>".$html1."</ul></div>";
		$rtn .= "<div class='col-md-4 user-list'><h4>Last Week</h4><ul>".$html2."</ul></div>";
		$rtn .= "<div class='col-md-4 user-list'><h4>Last Month</h4><ul>".$html3."</ul></div>";

		return $rtn;
	} else {
		return 'No data';
	}	
}*/

/****
* Getting meta values from db
****/
function get_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) )
        return;
    $r = $wpdb->get_results( $wpdb->prepare( "
        SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type ));
    foreach ( $r as $my_r )
        $metas[$my_r->ID] = $my_r->meta_value;
    return $metas;
}

/****
* Getting top locations
****/
function top_locations(){
	$locations = get_meta_values('company_location','companies'); 
	$locations = array_values($locations);
	$locations = array_unique($locations);
	sort($locations);
	foreach ($locations as $key => $location) {
		if( $key<5 ){
			$div1 .= "<li>$location</li>";
		}
		elseif( $key<9 ){
			$div2 .= "<li>$location</li>";	
		}
		elseif(  $key<14  ){
			$div3 .= "<li>$location</li>";
		}
	}
	return "<div>
				<ul>$div1</ul>
				<ul>$div2</ul>
				<ul>$div3</ul>
			</div>";
}

/****
* Getting categories
****/
function get_ihpc_categories($ihpc_taxonomy){
	$args = array(	'taxonomy' => $ihpc_taxonomy,
					'hide_empty' => false,
					'orderby'=>'name',
					'number' => 24
				);
	$terms = get_terms( $args );
	$cates = array();
	$i = 0;
	foreach ($terms as $key => $term) {
		$acf_term_format = $ihpc_taxonomy."_".$term->term_id;
		$term_url = get_field('category_icon', $acf_term_format);
		$cates[$i]['term_taxonomy_id'] = $term->term_id;
		$cates[$i]['permalink'] 	= get_term_link($term->term_id);
		$cates[$i]['img_url'] 		= $term_url;
		$cates[$i]['term_id'] 		= $term->term_id;
		$cates[$i]['name'] 			= $term->name;
		$cates[$i]['slug'] 			= $term->slug;
		$cates[$i]['term_group'] 	= $term->term_group;		
		$cates[$i]['taxonomy'] 		= $term->taxonomy;
		$cates[$i]['description'] 	= $term->description;
		$cates[$i]['parent'] 		= $term->parent;
		$cates[$i]['count'] 		= $term->count;
		$cates[$i]['filter'] 		= $term->filter;
		$i++;
	}
	return $cates;
}

/*
* Getting companies by ratings
*/
function get_companies_by_ratings($number_of_companies,$orderBy){
	$args = array(	'posts_per_page' => $number_of_companies,
					'post_type'	=> 'companies',
					'meta_key'  => 'ratings_average',
					'orderby'  	=> array( 'meta_value_num' => $orderBy, 'title' => 'ASC' ),
				);
	$array = array();
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$ratting = get_post_meta(get_the_ID(), 'ratings_average', true);			
			$array[$i]['url'] 			= get_permalink();
			$array[$i]['title'] 		= get_the_title();
			//$array[$i]['date'] 			= get_the_date();
			$array[$i]['date'] 			= human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
			$array[$i]['ihpc_ratings'] 	= $ratting;			
			$i++;	
		}
	}
	return $array;
}

function get_companies($number_of_companies){
	$args = array(	'posts_per_page' => $number_of_companies,
					'post_type'	=> 'companies'
				);
	$array = array();
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$array[$i]['url'] 			= get_permalink();
			$array[$i]['title'] 		= get_the_title();
			$array[$i]['date'] 			= get_the_date();
			$i++;	
		}
	}
	return $array;
}


/****
* Getting reviews
****/
function get_reviews( $number_of_reviews, $orderby = 'date', $order = 'DESC' ){
	$args = array(	'posts_per_page' => $number_of_reviews,
					'post_type'	=> 'review',
					'orderby' 	=> $orderby,
	    			'order' 	=> $order
				);
	$array 	= array();
	$i 		= 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();			
			$array[$i]['title'] 	= get_the_title();
			$array[$i]['excerpt'] 	= get_the_excerpt();
			$array[$i]['content'] 	= get_the_content();
			$array[$i]['permalink'] = get_permalink();
			//$array[$i]['date'] 		= get_the_date();
			$array[$i]['date'] 		= human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
			$i++;
		}		
		wp_reset_postdata();
		return $array;
	}
	else {
		return $array;
	}
}

/****
* Getting comments
****/
function get_ihpc_comments( $number_of_comments, $post_type ){
	$args = array(
	    'parent'	=> 0,
	    'post_type' => $post_type,
	    'number' 	=> $number_of_comments,
	    'orderby' 	=> 'date',
	    'order' 	=> 'DESC'
	  );
	$array 		= array();
	$comments 	= get_comments($args);
	$i = 0;
	foreach($comments as $comment) :
		$array[$i]['comment'] 	= $comment->comment_content;
		$array[$i]['date'] 		= get_comment_date('',$comment->comment_ID);
		$array[$i]['excerpt'] 	= get_comment_excerpt( $comment->comment_ID );
		$i++;
	endforeach;
	return $array;
}

function get_company_reviews($company_id){
	$args = array(	'posts_per_page' => -1,
					'post_type'	=> 'review',
					'meta_key'     => 'REVIEW_COMPANYID',
					'meta_value'   => $company_id,
					'meta_compare' => '='
				);
	$i = 0;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();		
			$i++;	
		}
	}
	return $i;
}


/***
* Register company
***/
add_action('admin_post_nopriv_register_company','register_company_callback');
//add_action( 'admin_post_register_company', 'register_company_callback' );
function register_company_callback(){
	if( !empty($_REQUEST) ){
		if( wp_verify_nonce($_POST['security-code'],'register_company') ){
			$user_arg = array();
			$user_arg['user_pass'] 		= '123456789';
			$user_arg['user_login'] 	= $_REQUEST['reg_company_name'];
			$user_arg['user_email'] 	= $_REQUEST['reg_company_email'];
			$user_arg['display_name'] 	= $_REQUEST['reg_company_title'];
		    $user_arg['role'] 			= 'contributor';
			$fullName = explode(" ", $_REQUEST['reg_company_fullname']);
			if( count($fullName) == 1 ){
				$firstName = $fullName[0];
				$user_arg['first_name'] = $firstName;
			}
			else{
				$firstName = $fullName[0];
				unset($fullName[0]);
				$lastName = implode(" ", $fullName);
				$user_arg['first_name'] = $firstName;
				$user_arg['last_name'] 	= $lastName;
			}			
		    $user_id = wp_insert_user( $user_arg );		    
		    if ( !is_wp_error( $user_id ) ) {
		    	update_user_meta( $user_id, 'user_phone	', $user_arg['reg_company_phone'] );
				wp_send_new_user_notifications( $user_id, 'both' );
				$redirect_to = site_url('login?msg=successfull registered a free plan, please login to comment');
				wp_safe_redirect( $redirect_to );
			}
			else{
				$errors = $user_id->errors;
				foreach ($errors as $key => $error) {
					$msg 			= $error[0];
					$redirect_to 	= site_url('login?msg='.$msg);
					wp_safe_redirect( $redirect_to );					
				}
			}
			exit();
		}
	}
}

/***
* making end points so no need to add pages
***/

/*add_action('init', 'ihpc_add_endpoints');
function ihpc_add_endpoints(){
	add_rewrite_endpoint('companiestax/view_all_companiestax/', EP_ALL);
	add_rewrite_endpoint('author/view_all_author/', EP_ALL);
}*/

function companies_template_redirect() {
    global $wp_query;
    /*echo "<pre>";
    print_r($wp_query);
    echo "</pre>";*/
    if( $wp_query->query_vars['author_name'] == 'view_all_author' ){
    	include dirname( __FILE__ ) . '/template/view_all_author-template.php';
    }    
    else if (  $wp_query->query_vars['companiestax'] == 'view_all_companiestax' ){
    	include dirname( __FILE__ ) . '/template/view_all_companiestax-template.php';
    }        
 	else{
 		return;
 	}
    exit;
}

add_action( 'template_redirect', 'companies_template_redirect' );
/** END **/


function get_post_by_category($post_type,$offset,$post_per_page,$category_name){
	$args = array(	'post_type' => $post_type,
					'posts_per_page' => $post_per_page,
					'category_name' => $category_name,
					'offset' => $offset
				);
	$the_query 	= new WP_Query( $args );
	$array 		= array();
	$i = 0;
	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$array[$i]['id'] 		= get_the_ID();
			$array[$i]['title'] 	= get_the_title();
			$array[$i]['excerpt'] 	= get_the_excerpt();
			$array[$i]['content'] 	= get_the_content();
			$array[$i]['permalink'] = get_permalink();
			$array[$i]['date'] 		= get_the_date();
			$array[$i]['img'] = get_the_post_thumbnail_url(get_the_ID(),'medium');
			$i++;
		}
		/* Restore original Post Data */
		wp_reset_postdata();
		return $array;
	} 
	else {
		return $array;
	}
}
