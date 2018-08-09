<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mrcarllister.co.uk
 * @since      1.0.0
 *
 * @package    Wp_Twitter
 * @subpackage Wp_Twitter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Twitter
 * @subpackage Wp_Twitter/admin
 * @author     Carl Lister <carllister@hotmail.com>
 */

require 'libs/twitterauth.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class Wp_Twitter_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->wp_twitter_options = get_option($this->plugin_name);

    }
// Create cron schedule for twitter api
    public function wp_twitter_create_cron_event($schedules) {

        if ( !wp_next_scheduled( 'wp_twitter_cron_job' ) ) {
            
            wp_schedule_event( time(), 'mrcl_twitter', 'wp_twitter_cron_job');
        }

        return $schedules;
    }

    // Twitter feed api call and caching
    public function wp_twitter_feed() {

        $consumer_key = $this->wp_twitter_options['consumer_key'];
        $consumer_secret = $this->wp_twitter_options['consumer_secret'];
        $access_tok = $this->wp_twitter_options['access_tok'];
        $access_secret = $this->wp_twitter_options['access_secret'];


        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_tok, $access_secret);
        $connection->setTimeouts(10, 15);
        $statuses = $connection->get("statuses/user_timeline", ["count" => 50,  "include_rts" => false, 'exclude_replies'=>true] );

        //Check twitter response for errors.
        if ( isset( $statuses->errors[0]->code )) {
            // If errors exist, print the first error for a simple notification.
            echo "Error encountered: ".$statuses->errors[0]->message." Response code:" .$statuses->errors[0]->code;
        } else {
            // No errors exist. Write tweets to json/txt file.
            $file = get_template_directory()."/tweets.json";
            $fh = fopen($file, 'w') or die("can't open file");
            fwrite($fh, json_encode($statuses));
            fclose($fh);
              
            if (file_exists($file)) {
                // echo $file . " successfully written (" .round(filesize($file)/1024)."KB)";
            } else {
                echo "Error encountered. File could not be written.";
            }
        }
    }

	public function add_plugin_admin_menu() {
		add_options_page( 'Twitter settings', 'Twitter', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
    	);

	}

	public function add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	public function display_plugin_setup_page() {
	    include_once( 'partials/wp-twitter-admin-display.php' );
	}

	// UPDATE OPTIONS PAGE
 	public function options_update() {
    	register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate')); // validate()
 	}

 	// FIELD VALIDATION
	public function validate($input) {
	    
        // All inputs        
	    $valid = array();

	    //Validate
        $valid['sched_days'] =  ( is_numeric($input['sched_days']) ) ? $input['sched_days'] : '';
        $valid['sched_hours'] =  ( is_numeric($input['sched_hours']) ) ? $input['sched_hours'] : '';
        $valid['sched_minutes'] =  ( is_numeric($input['sched_minutes']) ) ? $input['sched_minutes'] : '';
        $valid['sched_seconds'] =  ( is_numeric($input['sched_seconds']) ) ? $input['sched_seconds'] : '';

        $valid['access_tok'] =  (isset($input['access_tok']) && !empty($input['access_tok'])) ? sanitize_text_field($input['access_tok']) : '';;
        $valid['access_secret'] =  (isset($input['access_secret']) && !empty($input['access_secret'])) ? sanitize_text_field($input['access_secret']) : '';;

        $valid['consumer_key'] =  (isset($input['consumer_key']) && !empty($input['consumer_key'])) ? sanitize_text_field($input['consumer_key']) : '';;
        $valid['consumer_secret'] =  (isset($input['consumer_secret']) && !empty($input['consumer_secret'])) ? sanitize_text_field($input['consumer_secret']) : '';;
        
        $this->wp_twitter_feed();

        return $valid;
	 }

    function change( $data ) {
            $message = null;
            $type = null;

            if ( null != $data ) {

                if ( false === get_option( 'Twitter settings' ) ) {

                    add_option( 'Twitter settings', $data );
                    $type = 'updated';
                    $message = __( 'Successfully saved', 'my-text-domain' );

                } else {

                    update_option( 'Twitter settings', $data );
                    $type = 'updated';
                    $message = __( 'Successfully updated', 'my-text-domain' );

                }

            } else {

                $type = 'error';
                $message = __( 'Data can not be empty', 'my-text-domain' );

            }

            add_settings_error(
                'wp-twitter',
                esc_attr( 'settings_updated' ),
                $message,
                $type
            );

        }


    /**
     * Creates new cron schedule for twitter
     *
     * @since    1.0.0
     */
     public function wp_twitter_cron( $schedules ) {
        // add a 'weekly' schedule to the existing set
        $days = $this->wp_twitter_options['sched_days'];
        $hours = $this->wp_twitter_options['sched_hours'];
        $minutes = $this->wp_twitter_options['sched_minutes'];
        $seconds = $this->wp_twitter_options['sched_seconds'];

        $days = $days * DAY_IN_SECONDS;
        $hours = $hours * HOUR_IN_SECONDS;
        $minutes = $minutes * MINUTE_IN_SECONDS;

        $x = $days + $hours + $minutes + $seconds;

        $schedules['mrcl_twitter'] = array(
            'interval' => $x,
            'display' => __('Custom Twitter')
        );
        return $schedules;
    }


}
