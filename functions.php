<?php
/**
 * Theme functions and definitions.
 * @author  	 Aleksandr Samokhin
 * @copyright  (c) Copyright by Aleksandr Samokhin
 * @link       https://aleksandrsamokhin.com
 * @package 	 wp-block-dev
 * @since 		 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

define( 'WP_BLOCK_DEV_THEME_VERSION', '1.0.0' );
define( 'WP_BLOCK_DEV_THEME_DIR', get_template_directory() );
define( 'WP_BLOCK_DEV_THEME_URI', get_template_directory_uri() );

/*--------------------------------------------------------------
# Theme Setup
--------------------------------------------------------------*/
if ( ! function_exists( 'wp_block_dev_setup' ) ) :
	function wp_block_dev_setup() {

		load_theme_textdomain( 'wp-block-dev', get_template_directory() . '/languages' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1170, 0 );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'wp-block-styles' );
		
	}
	add_action( 'after_setup_theme', 'wp_block_dev_setup' );
endif;


/*--------------------------------------------------------------
# Enqueue Styles
--------------------------------------------------------------*/
if ( ! function_exists( 'wp_block_dev_styles' ) ) :
	function wp_block_dev_styles() {

		wp_register_style( 'wp-block-dev-style', WP_BLOCK_DEV_THEME_URI . '/assets/css/style.min.css' );

		$dependencies = apply_filters( 'wp_block_dev_style_dependencies', array( 'wp-block-dev-style' ) );

		wp_register_style( 'wp-block-dev-style-blocks', WP_BLOCK_DEV_THEME_URI . '/assets/css/blocks.min.css', $dependencies, WP_BLOCK_DEV_THEME_VERSION );		
		
		wp_enqueue_style( 'wp-block-dev-style' );
		wp_style_add_data( 'wp-block-dev-style', 'rtl', 'replace' );
		wp_enqueue_style( 'wp-block-dev-style-blocks' );
		wp_style_add_data( 'wp-block-dev-style-blocks', 'rtl', 'replace' );

	}
	add_action( 'wp_enqueue_scripts', 'wp_block_dev_styles' );
endif;


/*--------------------------------------------------------------
# Enqueue Editor Styles
--------------------------------------------------------------*/
if ( ! function_exists( 'wp_block_dev_editor_styles' ) ) :
	function wp_block_dev_editor_styles() {

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );		

		add_editor_style( array(
			'./assets/css/editor.min.css',
			'./assets/css/blocks.min.css',
		) );

	}
	add_action( 'admin_init', 'wp_block_dev_editor_styles' );
endif;

// allow svg uploads
add_filter('upload_mimes', 'wp_block_dev_mimes');
function wp_block_dev_mimes($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

/*--------------------------------------------------------------
# Block Styles
--------------------------------------------------------------*/
// Post Template Grid
register_block_style(
	'core/post-template',
	array(
		'name' 				 => 'wp-block-dev-post-grid-row-gap-20',
		'label'        => esc_html__( 'Row gap 20', 'wp-block-dev' ),
		'inline_style' => '.is-style-wp-block-dev-post-grid-row-gap-20 { row-gap: 20px !important; }'
	)
);

register_block_style(
	'core/post-template',
	array(
		'name' 				 => 'wp-block-dev-post-grid-row-gap-40',
		'label'        => esc_html__( 'Row gap 40', 'wp-block-dev' ),
		'inline_style' => '.is-style-wp-block-dev-post-grid-row-gap-40 { row-gap: 40px !important; }'
	)
);

register_block_style(
	'core/post-template',
	array(
		'name' 				 => 'wp-block-dev-post-grid-gap-30',
		'label'        => esc_html__( 'Gap 30', 'wp-block-dev' ),
		'inline_style' => '
			.is-style-wp-block-dev-post-grid-gap-30 {
				column-gap: 30px !important;

				@media only screen and (min-width: 782px) {
					row-gap: 30px !important;
				}					
			}			
		'
	)
);

register_block_style(
	'core/post-template',
	array(
		'name' 				 => 'wp-block-dev-post-grid-gap-40',
		'label'        => esc_html__( 'Gap 40', 'wp-block-dev' ),
		'inline_style' => '.is-style-wp-block-dev-post-grid-gap-40 { column-gap: 40px !important; }'
	)
);

register_block_style(
	'core/post-template',
	array(
		'name' 				 => 'wp-block-dev-post-grid-gap-64',
		'label'        => esc_html__( 'Gap 64', 'wp-block-dev' ),
		'inline_style' => '.is-style-wp-block-dev-post-grid-gap-64 { column-gap: 64px !important; }'
	)
);

// Read More	
register_block_style(
	'core/read-more',
	array(
		'name' 				 => 'wp-block-dev-read-more-cover',
		'label'        => esc_html__( 'Cover', 'wp-block-dev' ),
		'inline_style' => '.is-style-wp-block-dev-read-more-cover {
			font-size: 0;
			display: block;
			width: 100%;
			position: absolute;
			bottom: 0;
			top: 0;
			left: 0;
			right: 0;
		}'
	)
);

// Cover
register_block_style(
	'core/cover',
	array(
		'name' 				 => 'ona-hover-scale',
		'label'        => esc_html__( 'Hover scale', 'ona' ),
		'inline_style' => '.is-style-ona-hover-scale {
			overflow: hidden;
		}
		.is-style-ona-hover-scale img {
			transition: transform 0.4s var(--ona-transition);
			will-change: transform;
		}
		.is-style-ona-hover-scale:hover img {
			transform: scale(1.05);
		}'
	)
);

register_block_style(
	'core/cover',
	array(
		'name' 				 => 'ona-full-link',
		'label'        => esc_html__( 'Full link', 'ona' ),
		'inline_style' => '.is-style-ona-full-link a::after {
			display:block;
			position:absolute;
			left:0;
			top:0;
			width:100%;
			height:100%;
			content:"";
		}'
	)
);