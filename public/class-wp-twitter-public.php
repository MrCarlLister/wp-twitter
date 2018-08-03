<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mrcarllister.co.uk
 * @since      1.0.0
 *
 * @package    Wp_Twitter
 * @subpackage Wp_Twitter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Twitter
 * @subpackage Wp_Twitter/public
 * @author     Carl Lister <carllister@hotmail.com>
 */


class Wp_Twitter_Public {

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
        $this->wp_twitter_options = get_option($this->plugin_name);
	}

   	/**
	 * Register shortcodes.
	 *
	 * @since    1.0.0
	 */
	public function make_shortcodes() {

		/**
		 * Creates shortcode for twitter feed
		 *
		 */

        add_shortcode ( 'xtweets', array($this,'wp_tweets_shortcode' ) );


	}


    public function wp_tweets_shortcode( $atts ) {
        $a = shortcode_atts( array(
	      'count' => 4
	   ), $atts );
        include_once( 'partials/wp-twitter-public-shortcode.php' );    
        

    }

}
