<?php
/**
 * TC E-Commerce Shop functions and definitions
 *
 * @package TC E-Commerce Shop
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
/* Breadcrumb Begin */
function tc_e_commerce_shop_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url( home_url() );
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			the_category(',');
			if (is_single()) {
				echo "<span> ";
					the_title();
				echo "</span> ";
			}
		} elseif (is_page()) {
			echo "<span> ";
				the_title();
		}
	}
}
if ( ! function_exists( 'tc_e_commerce_shop_setup' ) ) :

/* Theme Setup */
function tc_e_commerce_shop_setup() {

	$GLOBALS['content_width'] = apply_filters( 'tc_e_commerce_shop_content_width', 640 );

	load_theme_textdomain( 'tc-e-commerce-shop', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('tc-e-commerce-shop-homepage-thumb',240,145,true);
	
       register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tc-e-commerce-shop' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	add_theme_support ('html5', array (
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

	add_theme_support('responsive-embeds');
	
	/*
	* Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/* Selective refresh for widgets */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			'sidebar-2' => array(
				'text_business_info',
			),
			'sidebar-3' => array(
				'text_about',
				'search',
			),
			'footer-1' => array(
				'text_about',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'text_business_info',
			),
			'footer-4' => array(
				'search',
			),
		),

		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
		),

		'theme_mods' => array(
			'tc_e_commerce_shop_mail' => __('example@gmail.com', 'tc-e-commerce-shop' ),
			'tc_e_commerce_shop_call' => __('9874563210', 'tc-e-commerce-shop' ),
			'tc_e_commerce_shop_facebook_url' => 'www.facebook.com',
			'tc_e_commerce_shop_twitter_url' => 'www.twitter.com',
			'tc_e_commerce_shop_instagram_url' => 'www.instagram.com',
			'tc_e_commerce_shop_youtube_url' => 'www.youtube.com',
			'tc_e_commerce_shop_footer_copy' => __('By ThemesCaliber', 'tc-e-commerce-shop' )
		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'tc-e-commerce-shop' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
    ));

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', tc_e_commerce_shop_font_url() ) );

	// Dashboard Theme Notification
	global $pagenow;
	
	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'tc_e_commerce_shop_activation_notice' );
	}
}
endif;
add_action( 'after_setup_theme', 'tc_e_commerce_shop_setup' );

// Dashboard Theme Notification
function tc_e_commerce_shop_activation_notice() {
	echo '<div class="welcome-notice notice notice-success is-dismissible">';
		echo '<h2>'. esc_html__( 'Thank You!!!!!', 'tc-e-commerce-shop' ) .'</h2>';
		echo '<p>'. esc_html__( 'Much grateful to you for choosing our Tc Ecommerce theme from themescaliber. we praise you for opting our services over others. we are obliged to invite you on our welcome page to render you with our outstanding services.', 'tc-e-commerce-shop' ) .'</p>';
		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=tc_e_commerce_shop_guide' ) ) .'" class="button button-primary">'. esc_html__( 'Click Here...', 'tc-e-commerce-shop' ) .'</a></p>';
	echo '</div>';
}

/* Theme Widgets Setup */
function tc_e_commerce_shop_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'tc-e-commerce-shop' ),
		'description'   => __( 'Appears on blog page sidebar', 'tc-e-commerce-shop' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s p-2 mb-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title pt-0 pb-2 mb-2">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'tc-e-commerce-shop' ),
		'description'   => __( 'Appears on page sidebar', 'tc-e-commerce-shop' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s p-2 mb-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title pt-0 pb-2 mb-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Thid Column Sidebar', 'tc-e-commerce-shop' ),
		'description'   => __( 'Appears on page sidebar', 'tc-e-commerce-shop' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s p-2 mb-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title pt-0 pb-2 mb-2">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$tc_e_commerce_shop_widget_areas = get_theme_mod('tc_e_commerce_shop_footer_widget_layout', '4');
	for ($i=1; $i<=$tc_e_commerce_shop_widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Nav ', 'tc-e-commerce-shop' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}	
	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'tc-e-commerce-shop' ),
		'description'   => __( 'Appears on shop page', 'tc-e-commerce-shop' ),	
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Single Product Page Sidebar', 'tc-e-commerce-shop' ),
		'description'   => __( 'Appears on shop page', 'tc-e-commerce-shop' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'tc_e_commerce_shop_widgets_init' );

/* Theme Font URL */
function tc_e_commerce_shop_font_url() {
	$font_url = '';
	$font_family = array(
	    'ABeeZee:ital@0;1',
		'Abril Fatfac',
		'Acme',
		'Allura',
		'Amatic SC:wght@400;700',
		'Anton',
		'Architects Daughter',
		'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Arsenal:ital,wght@0,400;0,700;1,400;1,700',
		'Arvo:ital,wght@0,400;0,700;1,400;1,700',
		'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Asap:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Assistant:wght@200;300;400;500;600;700;800',
		'Alfa Slab One',
		'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
		'Bangers',
		'Boogaloo',
		'Bad Script',
		'Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Barlow Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Berkshire Swash',
		'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Bree Serif',
		'BenchNine:wght@300;400;700',
		'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Cardo:ital,wght@0,400;0,700;1,400',
		'Courgette',
		'Caveat:wght@400;500;600;700',
		'Caveat Brush',
		'Cherry Swash:wght@400;700',
		'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700',
		'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700',
		'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Cookie',
		'Coming Soon',
		'Charm:wght@400;700',
		'Chewy',
		'Days One',
		'DM Serif Display:ital@0;1',
		'Dosis:wght@200;300;400;500;600;700;800',
		'EB Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800',
		'Economica:ital,wght@0,400;0,700;1,400;1,700',
		'Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Exo 2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Familjen Grotesk:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Fira Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Fredoka One',
		'Fjalla One',
		'Francois One',
		'Frank Ruhl Libre:wght@300;400;500;700;900',
		'Gabriela',
		'Gloria Hallelujah',
		'Great Vibes',
		'Handlee',
		'Hammersmith One',
		'Heebo:wght@100;200;300;400;500;600;700;800;900',
		'Hind:wght@300;400;500;600;700',
		'Inconsolata:wght@200;300;400;500;600;700;800;900',
		'Indie Flower',
		'IM Fell English SC',
		'Julius Sans One',
		'Jomhuria',
		'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
		'Josefin Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
		'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Kaisei HarunoUmi:wght@400;500;700',
		'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Kaushan Script',
		'Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700',
		'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
		'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Libre Baskerville:ital,wght@0,400;0,700;1,400',
		'Lobster',
		'Lobster Two:ital,wght@0,400;0,700;1,400;1,700',
		'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900',
		'Monda:wght@400;700',
		'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Marck Script',
		'Marcellus',
		'Merienda One',
		'Monda:wght@400;700',
		'Noto Serif:ital,wght@0,400;0,700;1,400;1,700',
		'Nunito Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900',
		'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
		'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Overpass Mono:wght@300;400;500;600;700',
		'Oxygen:wght@300;400;700',
		'Oswald:wght@200;300;400;500;600;700',
		'Orbitron:wght@400;500;600;700;800;900',
		'Patua One',
		'Pacifico',
		'Padauk:wght@400;700',
		'Playball',
		'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'PT Sans:ital,wght@0,400;0,700;1,400;1,700',
		'PT Serif:ital,wght@0,400;0,700;1,400;1,700',
		'Philosopher:ital,wght@0,400;0,700;1,400;1,700',
		'Permanent Marker',
		'Poiret One',
		'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Prata',
		'Quicksand:wght@300;400;500;600;700',
		'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700',
		'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
		'Rokkitt:wght@100;200;300;400;500;600;700;800;900',
		'Ropa Sans:ital@0;1',
		'Russo One',
		'Righteous',
		'Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Satisfy',
		'Sen:wght@400;700;800',
		'Slabo 13px',
		'Slabo 27px',
		'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
		'Shadows Into Light Two',
		'Shadows Into Light',
		'Sacramento',
		'Sail',
		'Shrikhand',
		'League Spartan:wght@100;200;300;400;500;600;700;800;900',
		'Staatliches',
		'Stylish',
		'Tangerine:wght@400;700',
		'Titillium Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700',
		'Trirong:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700',
		'Unica One',
		'VT323',
		'Varela Round',
		'Vampiro One',
		'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Volkhov:ital,wght@0,400;0,700;1,400;1,700',
		'Work Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Yanone Kaffeesatz:wght@200;300;400;500;600;700',
		'Yeseva One',
		'ZCOOL XiaoWei'
	);
	
	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/* Theme enqueue scripts */
function tc_e_commerce_shop_scripts() {
	wp_enqueue_style( 'tc-e-commerce-shop-font', tc_e_commerce_shop_font_url(), array() );
	wp_enqueue_style( 'tc-e-commerce-shop-block-patterns-style-frontend', get_theme_file_uri('/css/block-frontend.css') );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_style( 'tc-e-commerce-shop-basic-style', get_stylesheet_uri() );
	wp_style_add_data( 'tc-e-commerce-shop-style', 'rtl', 'replace' );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/css/fontawesome-all.css' );
	wp_enqueue_style( 'tc-e-commerce-shop-block-style', get_template_directory_uri().'/css/block-style.css' );

        // Body
    $tc_e_commerce_shop_body_color = get_theme_mod('tc_e_commerce_shop_body_color', '');
    $tc_e_commerce_shop_body_font_family = get_theme_mod('tc_e_commerce_shop_body_font_family', '');
    $tc_e_commerce_shop_body_font_size = get_theme_mod('tc_e_commerce_shop_body_font_size', '');
		// Paragraph
	    $tc_e_commerce_shop_paragraph_color = get_theme_mod('tc_e_commerce_shop_paragraph_color', '');
	    $tc_e_commerce_shop_paragraph_font_family = get_theme_mod('tc_e_commerce_shop_paragraph_font_family', '');
	    $tc_e_commerce_shop_paragraph_font_size = get_theme_mod('tc_e_commerce_shop_paragraph_font_size', '');
	// "a" tag
		$tc_e_commerce_shop_atag_color = get_theme_mod('tc_e_commerce_shop_atag_color', '');
	    $tc_e_commerce_shop_atag_font_family = get_theme_mod('tc_e_commerce_shop_atag_font_family', '');
	// "li" tag
		$tc_e_commerce_shop_li_color = get_theme_mod('tc_e_commerce_shop_li_color', '');
	    $tc_e_commerce_shop_li_font_family = get_theme_mod('tc_e_commerce_shop_li_font_family', '');
	// H1
		$tc_e_commerce_shop_h1_color = get_theme_mod('tc_e_commerce_shop_h1_color', '');
	    $tc_e_commerce_shop_h1_font_family = get_theme_mod('tc_e_commerce_shop_h1_font_family', '');
	    $tc_e_commerce_shop_h1_font_size = get_theme_mod('tc_e_commerce_shop_h1_font_size', '');
	// H2
		$tc_e_commerce_shop_h2_color = get_theme_mod('tc_e_commerce_shop_h2_color', '');
	    $tc_e_commerce_shop_h2_font_family = get_theme_mod('tc_e_commerce_shop_h2_font_family', '');
	    $tc_e_commerce_shop_h2_font_size = get_theme_mod('tc_e_commerce_shop_h2_font_size', '');
	// H3
		$tc_e_commerce_shop_h3_color = get_theme_mod('tc_e_commerce_shop_h3_color', '');
	    $tc_e_commerce_shop_h3_font_family = get_theme_mod('tc_e_commerce_shop_h3_font_family', '');
	    $tc_e_commerce_shop_h3_font_size = get_theme_mod('tc_e_commerce_shop_h3_font_size', '');
	// H4
		$tc_e_commerce_shop_h4_color = get_theme_mod('tc_e_commerce_shop_h4_color', '');
	    $tc_e_commerce_shop_h4_font_family = get_theme_mod('tc_e_commerce_shop_h4_font_family', '');
	    $tc_e_commerce_shop_h4_font_size = get_theme_mod('tc_e_commerce_shop_h4_font_size', '');
	// H5
		$tc_e_commerce_shop_h5_color = get_theme_mod('tc_e_commerce_shop_h5_color', '');
	    $tc_e_commerce_shop_h5_font_family = get_theme_mod('tc_e_commerce_shop_h5_font_family', '');
	    $tc_e_commerce_shop_h5_font_size = get_theme_mod('tc_e_commerce_shop_h5_font_size', '');
	// H6
		$tc_e_commerce_shop_h6_color = get_theme_mod('tc_e_commerce_shop_h6_color', '');
	    $tc_e_commerce_shop_h6_font_family = get_theme_mod('tc_e_commerce_shop_h6_font_family', '');
	    $tc_e_commerce_shop_h6_font_size = get_theme_mod('tc_e_commerce_shop_h6_font_size', '');
	    $tc_e_commerce_shop_theme_color = get_theme_mod('tc_e_commerce_shop_theme_color', '');


		$tc_e_commerce_shop_custom_css ='
		     body{
		    color:'.esc_html($tc_e_commerce_shop_body_color).'!important;
		    font-family: '.esc_html($tc_e_commerce_shop_body_font_family).'!important;
		    font-size: '.esc_html($tc_e_commerce_shop_body_font_size).'px !important;
		    }
			p,span{
			    color:'.esc_attr($tc_e_commerce_shop_paragraph_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_paragraph_font_family).';
			    font-size: '.esc_attr($tc_e_commerce_shop_paragraph_font_size).';
			}
			a{
			    color:'.esc_attr($tc_e_commerce_shop_atag_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_atag_font_family).';
			}
			li{
			    color:'.esc_attr($tc_e_commerce_shop_li_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_li_font_family).';
			}
			h1{
			    color:'.esc_attr($tc_e_commerce_shop_h1_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_h1_font_family).'!important;
			    font-size: '.esc_attr($tc_e_commerce_shop_h1_font_size).'!important;
			}
			h2{
			    color:'.esc_attr($tc_e_commerce_shop_h2_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_h2_font_family).'!important;
			    font-size: '.esc_attr($tc_e_commerce_shop_h2_font_size).'!important;
			}
			h3{
			    color:'.esc_attr($tc_e_commerce_shop_h3_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_h3_font_family).'!important;
			    font-size: '.esc_attr($tc_e_commerce_shop_h3_font_size).'!important;
			}
			h4{
			    color:'.esc_attr($tc_e_commerce_shop_h4_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_h4_font_family).'!important;
			    font-size: '.esc_attr($tc_e_commerce_shop_h4_font_size).'!important;
			}
			h5{
			    color:'.esc_attr($tc_e_commerce_shop_h5_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_h5_font_family).'!important;
			    font-size: '.esc_attr($tc_e_commerce_shop_h5_font_size).'!important;
			}
			h6{
			    color:'.esc_attr($tc_e_commerce_shop_h6_color).'!important;
			    font-family: '.esc_attr($tc_e_commerce_shop_h6_font_family).'!important;
			    font-size: '.esc_attr($tc_e_commerce_shop_h6_font_size).'!important;
			}
			input[type="submit"], .hvr-sweep-to-right:before, .cat-title a.r_button, .woocommerce #respond input#submit.alt,.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,nav.woocommerce-MyAccount-navigation ul li, .footertown input[type="submit"], #comments input[type="submit"].submit, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, .more-btn a, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, nav.woocommerce-MyAccount-navigation ul li, .pagination a:hover,.page-links a:hover, .pagination .current,.page-links .current, #sidebar ul li::before,#header .nav ul li:hover > ul,#sidebar .tagcloud a:hover,.bradcrumbs a, .bradcrumbs span,.post-categories a,#main .wp-block-button a,.wp-block-tag-cloud a:hover,.wp-block-search__button, a.wc-block-components-totals-coupon-link, a.components-button.wc-block-components-button.wp-element-button.wc-block-cart__submit-button.contained, a.wc-block-components-checkout-return-to-cart-button, .wc-block-components-totals-coupon__button.contained, button.wc-block-components-checkout-place-order-button{
			    background-color:'.esc_attr($tc_e_commerce_shop_theme_color).';
			}
			#comments a.comment-reply-link,.tags a:hover,.metabox,.primary-navigation ul ul a, .footertown .tagcloud a:hover, .woocommerce-product-search button[type="submit"], .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, #sidebar input[type="submit"], .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{
				background-color:'.esc_attr($tc_e_commerce_shop_theme_color).';
			}
			.wc-block-grid__product-onsale{
				background-color:'.esc_attr($tc_e_commerce_shop_theme_color).'!important;
			}
			.wc-block-grid__product-onsale{
				border-color:'.esc_attr($tc_e_commerce_shop_theme_color).'!important;
			}

			.toggle-menu i,#comments p a,span.post-title,.primary-navigation ul ul a:hover,.logo h1 a, .logo p a,.logo p, #our-products .woocommerce ul.products li:hover h2, .footertown .widget h3, #sidebar td#prev a, #sidebar caption,#sidebar th, #sidebar h3, #header .logo h1 a,section h4, h3.widget-title a,table#wp-calendar a, span.posted_in a, #sidebar .textwidget p a, .primary-navigation ul ul a:hover, .primary-navigation ul li a:hover, .scrollup, .scrollup:focus, .scrollup:hover, .footertown .widget ul li a:hover, #sidebar ul li a:hover, .metabox .entry-date a:hover,.metabox .entry-author a:hover, .copyright a:hover, .more-btn a:hover, .entry-content a, #content-ma a,#sidebar h2,.wp-block-latest-comments__comment-meta a, .footertown .wp-block-search__label,.footertown .widget h2,.wp-calendar-nav a,#sidebar .wp-block-search__label {
			    color:'.esc_attr($tc_e_commerce_shop_theme_color).';
			}
			.primary-navigation ul ul, a.button, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.wp-block-tag-cloud a:hover, .wp-block-search__button,#sidebar h2,#sidebar .tagcloud a:hover,.footertown .widget h2,.footertown .tagcloud a:hover, #sidebar .wp-block-search__label {
				border-color:'.esc_attr($tc_e_commerce_shop_theme_color).';
			}
			@media screen and (max-width: 1000px){
				.topbar,.email, .call, .sidebar, .side-menu{
					background:'.esc_attr($tc_e_commerce_shop_theme_color).';
				}
			}
		';	

	wp_add_inline_style( 'tc-e-commerce-shop-basic-style',$tc_e_commerce_shop_custom_css );

	require get_parent_theme_file_path( '/tc-style.php' );
	wp_add_inline_style( 'tc-e-commerce-shop-basic-style',$tc_e_commerce_shop_custom_css );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'tc-e-commerce-shop-customscripts', get_template_directory_uri(). '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery') ,'',true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tc_e_commerce_shop_scripts' );

/*radio button sanitization*/

 function tc_e_commerce_shop_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Excerpt Limit Begin */
function tc_e_commerce_shop_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'tc_e_commerce_shop_loop_columns');
if (!function_exists('tc_e_commerce_shop_loop_columns')) {
	function tc_e_commerce_shop_loop_columns() {
		$columns = get_theme_mod( 'tc_e_commerce_shop_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'tc_e_commerce_shop_shop_per_page', 9 );
function tc_e_commerce_shop_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'tc_e_commerce_shop_product_per_page', 9 );
	return $cols;
}

/**
 * Enqueue block editor style
 */
function tc_e_commerce_shop_block_editor_styles() {
	wp_enqueue_style( 'tc-e-commerce-shop-font', tc_e_commerce_shop_font_url(), array() );
	wp_enqueue_style( 'tc-e-commerce-shop-block-patterns-style-editor', get_theme_file_uri( '/css/block-editor.css' ), false, '1.0', 'all' );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/css/bootstrap.css' );
    wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/css/fontawesome-all.css' );
}
add_action( 'enqueue_block_editor_assets', 'tc_e_commerce_shop_block_editor_styles' );

function tc_e_commerce_shop_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

// URL DEFINES
define('TC_E_COMMERCE_SHOP_FREE_THEME_DOC',__('https://www.themescaliber.com/demo/doc/free-tc-e-commerce-shop/', 'tc-e-commerce-shop'));
define('TC_E_COMMERCE_SHOP_SUPPORT',__('https://wordpress.org/support/theme/tc-e-commerce-shop', 'tc-e-commerce-shop'));
define('TC_E_COMMERCE_SHOP_REVIEW',__('https://wordpress.org/support/theme/tc-e-commerce-shop/reviews/', 'tc-e-commerce-shop'));
define('TC_E_COMMERCE_SHOP_BUY_NOW',__('https://www.themescaliber.com/themes/multipurpose-ecommerce-wordpress-theme', 'tc-e-commerce-shop'));
define('TC_E_COMMERCE_SHOP_LIVE_DEMO',__('https://www.themescaliber.com/tc-e-commerce-shop', 'tc-e-commerce-shop'));
define('TC_E_COMMERCE_SHOP_PRO_DOC',__('https://themescaliber.com/demo/doc/tc-e-commerce-shop-documentation/', 'tc-e-commerce-shop'));
define('TC_E_COMMERCE_SHOP_SITE_URL',__('https://www.themescaliber.com/themes/ecommerce-shop-wordpress-theme', 'tc-e-commerce-shop'));

function tc_e_commerce_shop_credit_link() {
    echo "<a href=".esc_url(TC_E_COMMERCE_SHOP_SITE_URL)." target='_blank'>".esc_html__('Ecommerce WordPress Theme','tc-e-commerce-shop')."</a>";
}

function tc_e_commerce_shop_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function tc_e_commerce_shop_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function tc_e_commerce_shop_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

/** Posts navigation. */
if ( ! function_exists( 'tc_e_commerce_shop_post_navigation' ) ) {
	function tc_e_commerce_shop_post_navigation() {
		$tc_e_commerce_shop_pagination_type = get_theme_mod( 'tc_e_commerce_shop_post_navigation_type', 'numbers' );
		if ( $tc_e_commerce_shop_pagination_type == 'numbers' ) {
			the_posts_pagination();
		} else {
			the_posts_navigation( array(
	            'prev_text'          => __( 'Previous page', 'tc-e-commerce-shop' ),
	            'next_text'          => __( 'Next page', 'tc-e-commerce-shop' ),
	            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tc-e-commerce-shop' ) . ' </span>',
	        ) );
		}
	}
}

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Implement the get started page */
require get_template_directory() . '/inc/dashboard/getstart.php';

/* Webfonts */
require get_template_directory() . '/wptt-webfont-loader.php';

/* TGM Plugin Activation */
require get_template_directory() . '/inc/tgm/tgm.php';