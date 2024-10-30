<?php
/**
 * Plugin Name: Crisp Slider
 * Description: A responsive slider for your WordPress site with basic slider or carousel with custom options.
 * Plugin URI: https://www.crispthemes.com/crispslider-free-responsive-wordpress-slider-plugin/
 * Author: Crisp Themes
 * Author URI: https://www.crispthemes.com/
 * Version: 1.0
 * Text Domain: crispslider
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 3, as
 published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Get some constants ready for paths when your plugin grows 
 * 
 */

define( 'CRISP_SLIDER_VERSION', '1.0' );
define( 'CRISP_SLIDER_PATH', dirname( __FILE__ ) );
define( 'CRISP_SLIDER_PATH_INCLUDES', dirname( __FILE__ ) . '/inc' );
define( 'CRISP_SLIDER_FOLDER', basename( CRISP_SLIDER_PATH ) );
define( 'CRISP_SLIDER_URL', plugins_url() . '/' . CRISP_SLIDER_FOLDER );
define( 'CRISP_SLIDER_URL_INCLUDES', CRISP_SLIDER_URL . '/inc' );


/**
 * 
 * The plugin base class - the root of all WP goods!
 * 
 * @author WP Designs
 *
 */
class Crisp_Slider_Plugin_Base {
	
	/**
	 * 
	 * Assign everything as a call from within the constructor
	 */
	public function __construct() {
		// add scripts and styles for frontend
		add_action( 'wp_enqueue_scripts', array( $this, 'crisp_slider_add_JS' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'crisp_slider_add_CSS' ) );
		
		// add scripts and styles only available in admin
		add_action( 'admin_enqueue_scripts', array( $this, 'crisp_slider_add_admin_JS' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'crisp_slider_add_admin_CSS' ) );
		
		// Register custom post type and metabox
		add_action( 'init', array( $this, 'crisp_slider_post_type' ), 5 );
		add_action( 'init', array( $this, 'crisp_slider_gallery_metabox' ), 6 );
		add_action( 'init', array( $this, 'crisp_slider_metabox' ), 7 );
		
		// Register activation and deactivation hooks
		register_activation_hook( __FILE__, 'crisp_slider_on_activate_callback' );
		register_deactivation_hook( __FILE__, 'crisp_slider_on_deactivate_callback' );
		
		// Translation-ready
		add_action( 'plugins_loaded', array( $this, 'crisp_slider_add_textdomain' ) );
		
		// Add the shortcode
		add_action( 'init', array( $this, 'crisp_slider_shortcode' ) );
		
		// Add the widget
		add_action( 'widgets_init', array( $this, 'crisp_slider_widget' ) );		
	}	
	
	/**
	 * 
	 * Adding JavaScript scripts
	 * 
	 * Loading existing scripts from wp-includes or adding custom ones
	 * 
	 */
	public function crisp_slider_add_JS() {
		wp_enqueue_script( 'jquery' );
		// load custom JSes and put them in footer
		wp_register_script( 'crisp-slider-script', plugins_url( '/js/jquery.bxslider.min.js' , __FILE__ ), array('jquery'), '4.1.2', true );
		wp_enqueue_script( 'crisp-slider-script' );
	}
	
	
	/**
	 *
	 * Adding JavaScript scripts for the admin pages only
	 *
	 * Loading existing scripts from wp-includes or adding custom ones
	 *
	 */
	public function crisp_slider_add_admin_JS( $hook ) {
		$screen = get_current_screen();
	    if ( $screen->post_type == 'crisp_slider' ) {
	        wp_enqueue_script( 'jquery' );
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('iris');
			wp_enqueue_media();
			wp_register_script( 'crisp-slider-script-admin', plugins_url( '/js/admin/crisp-script-admin.js' , __FILE__ ), array('jquery'), '1.0', true );
			wp_enqueue_script( 'crisp-slider-script-admin' );
	    }
	}
	
	/**
	 * 
	 * Add CSS styles
	 * 
	 */
	public function crisp_slider_add_CSS() {
		wp_register_style( 'crisp-slider-bxslider', plugins_url( '/css/jquery.bxslider.css', __FILE__ ), array(), '4.1.2', 'screen' );
		wp_register_style( 'crisp-slider-style', plugins_url( '/css/crisp-slider-style.css', __FILE__ ), array(), '1.0', 'screen' );
		wp_enqueue_style( 'crisp-slider-bxslider' );
		wp_enqueue_style( 'crisp-slider-style' );
	}
	
	/**
	 *
	 * Add admin CSS styles - available only on admin
	 *
	 */
	public function crisp_slider_add_admin_CSS( $hook ) {
		$screen = get_current_screen();
	    if ( $screen->post_type == 'crisp_slider' ) {
	    	wp_register_style( 'crisp-slider-style-admin', plugins_url( '/css/admin/crisp-style-admin.css', __FILE__ ), array(), '1.0', 'screen' );
			wp_enqueue_style( 'crisp-slider-style-admin' );
		}
	}
	
	/**
	 * Register Slider CPT
     *
	 */
	public function crisp_slider_post_type() {
		register_post_type( 'crisp_slider', array(
			'labels' => array(
				'name' => __("Sliders", 'crispslider'),
				'singular_name' => __("Slider", 'crispslider'),
				'add_new' => _x("Add New", 'crisp_slider', 'crispslider' ),
				'add_new_item' => __("Add New Slider", 'crispslider' ),
				'edit_item' => __("Edit Slider", 'crispslider' ),
				'new_item' => __("New Slider", 'crispslider' ),
				'view_item' => __("View Slider", 'crispslider' ),
				'search_items' => __("Search Slider", 'crispslider' ),
				'not_found' =>  __("No slider found", 'crispslider' ),
				'not_found_in_trash' => __("No slider found in Trash", 'crispslider' ),
			),
			'public' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => false,
			'has_archive' => false,
			'menu_position' => 25,
			'supports' => array(
				'title'
			)
		));	
	}

	/**
	 * 
	 *  Slider Setting MetaBoxes
	 *   
	 */
	public function crisp_slider_metabox() {
		include_once CRISP_SLIDER_PATH_INCLUDES . '/crisp-slider-metabox.php';
	}
	
	
	/**
	 * Register the shortcode for slider
	 * 
	 */
	public function crisp_slider_shortcode() {
		include_once CRISP_SLIDER_PATH_INCLUDES . '/crisp-slider-shortcode.php';
	}
	
	/**
	 * Slider Widget
	 */
	public function crisp_slider_widget() {
		include_once CRISP_SLIDER_PATH_INCLUDES . '/crisp-slider-widget.php';
	}

	/**
	 * Slider Gallery MetaBox
	 */
	public function crisp_slider_gallery_metabox() {
		include_once CRISP_SLIDER_PATH_INCLUDES . '/gallery.php';
	}
	
	/**
	 * Add textdomain for plugin
	 */
	public function crisp_slider_add_textdomain() {
		load_plugin_textdomain( 'crispslider', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}	
}


/**
 * Register activation hook
 *
 */
function crisp_slider_on_activate_callback() {
	// do something on activation
}

/**
 * Register deactivation hook
 *
 */
function crisp_slider_on_deactivate_callback() {
	// do something when deactivated
}

// Initialize everything
$crisp_plugin_base = new Crisp_Slider_Plugin_Base();
