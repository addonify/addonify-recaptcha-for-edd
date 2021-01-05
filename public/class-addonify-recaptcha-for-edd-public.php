<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Recaptcha_For_Edd
 * @subpackage Addonify_Recaptcha_For_Edd/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Addonify_Recaptcha_For_Edd
 * @subpackage Addonify_Recaptcha_For_Edd/public
 * @author     Addonify <addonify@gmail.com>
 */
class Addonify_Recaptcha_For_Edd_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Addonify_Recaptcha_For_Edd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Addonify_Recaptcha_For_Edd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/addonify-recaptcha-for-edd-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Addonify_Recaptcha_For_Edd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Addonify_Recaptcha_For_Edd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script ( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/addonify-recaptcha-for-edd-public.js', array('jquery'), $this->version, true );

		$args = array();

		$edd_settings = get_option( 'edd_settings' );

		if ( isset( $edd_settings['addonify_recaptcha_for_edd_show_recaptcha_in_login_form'] ) && $edd_settings['addonify_recaptcha_for_edd_show_recaptcha_in_login_form'] == true ) {
			$args['show_recaptch_in_login'] = true;
		}

		if ( $edd_settings['addonify_recaptcha_for_edd_client_key'] ) {
			$args['client_secrete_key'] = $edd_settings['addonify_recaptcha_for_edd_client_key'];
		}

		wp_localize_script( $this->plugin_name, 'addonify_recaptcha_vars', $args );

		wp_enqueue_script ( $this->plugin_name );

		
	}

	public function g_recaptcha_script() {
		wp_enqueue_script( $this->plugin_name . '-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), '', true );
	}

	public function insert_recaptcha() {

		$edd_settings = get_option( 'edd_settings' );

		$client_key = $edd_settings['addonify_recaptcha_for_edd_client_key'];

		echo '<p class="g-recaptcha" data-sitekey="' . esc_attr( $client_key ) . '"></p>';
	}

}
