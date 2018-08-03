<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mrcarllister.co.uk
 * @since      1.0.0
 *
 * @package    Wp_Twitter
 * @subpackage Wp_Twitter/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

        <div id="poststuff">

            <div id="post-body" class="metabox-holder columns-2">

                <!-- main content -->
                <div id="post-body-content">
                    <form method="post" name="cleanup_options" action="options.php" autocomplete="off">

                    <?php
                    //Grab all options      
                    $options = get_option($this->plugin_name);
                    // Cleanup

                    $sched_days = $options['sched_days'];
                    $sched_hours = $options['sched_hours'];
                    $sched_minutes = $options['sched_minutes'];
                    $sched_seconds = $options['sched_seconds'];


                    $access_tok = $options['access_tok'];
                    $access_secret = $options['access_secret'];

                    $consumer_key = $options['consumer_key'];
                    $consumer_secret = $options['consumer_secret'];


                    

                        settings_fields( $this->plugin_name );
                        do_settings_sections( $this->plugin_name );
                    ?>
                    
                    <h2 class="nav-tab-wrapper">Set cron job schedule</h2>

                    <!-- remove some meta and generators from the <head> -->
                    <fieldset>
                        <legend class="screen-reader-text"><span><?php _e('Set cron job schedule', $this->plugin_name);?></span></legend>
                            <label for="<?php echo $this->plugin_name;?>-sched_days">
                                <span><?php esc_attr_e( 'Days', $this->plugin_name ); ?></span>
                                <input type="text" class="small-text" id="<?php echo $this->plugin_name;?>-sched_days" name="<?php echo $this->plugin_name;?>[sched_days]" value="<?php if(!empty($sched_days)) echo $sched_days;?>"/>
                            </label>

                            <label for="<?php echo $this->plugin_name;?>-sched_hours">
                                <span><?php esc_attr_e( 'Hours', $this->plugin_name ); ?></span>
                                <input type="text" class="small-text" id="<?php echo $this->plugin_name;?>-sched_hours" name="<?php echo $this->plugin_name;?>[sched_hours]" value="<?php if(!empty($sched_hours)) echo $sched_hours;?>"/>
                            </label>

                            <label for="<?php echo $this->plugin_name;?>-sched_minutes">
                                <span><?php esc_attr_e( 'Minutes', $this->plugin_name ); ?></span>
                                <input type="text" class="small-text" id="<?php echo $this->plugin_name;?>-sched_minutes" name="<?php echo $this->plugin_name;?>[sched_minutes]" value="<?php if(!empty($sched_minutes)) echo $sched_minutes;?>"/>
                            </label>

                            <label for="<?php echo $this->plugin_name;?>-sched_seconds">
                                <span><?php esc_attr_e( 'Seconds', $this->plugin_name ); ?></span>
                                <input type="text" class="small-text" id="<?php echo $this->plugin_name;?>-sched_seconds" name="<?php echo $this->plugin_name;?>[sched_seconds]" value="<?php if(!empty($sched_seconds)) echo $sched_seconds;?>"/>
                            </label>

                    </fieldset>

                    <h2 class="nav-tab-wrapper">Tokens, keys and secrets</h2>

                    <!-- remove injected CSS from comments widgets -->
                    <fieldset>

                        <span><?php esc_attr_e( 'Access token', $this->plugin_name ); ?></span>
                        <input type="password" style="visibility: hidden">
                        <input type="<?= ($access_tok ? 'password' : 'text');?>" class="large-text" id="<?php echo $this->plugin_name;?>-access_tok" name="<?php echo $this->plugin_name;?>[access_tok]" value="<?php if(!empty($access_tok)) echo $access_tok;?>"/>

                        <span><?php esc_attr_e( 'Access token secret', $this->plugin_name ); ?></span>
                        <input type="<?= ($access_secret ? 'password' : 'text');?>" class="large-text" id="<?php echo $this->plugin_name;?>-access_secret" name="<?php echo $this->plugin_name;?>[access_secret]" value="<?php if(!empty($access_secret)) echo $access_secret;?>"/>


                        <span><?php esc_attr_e( 'Consumer key', $this->plugin_name ); ?></span>
                        <input type="<?= ($consumer_key ? 'password' : 'text');?>" class="large-text" id="<?php echo $this->plugin_name;?>-consumer_key" name="<?php echo $this->plugin_name;?>[consumer_key]" value="<?php if(!empty($consumer_key)) echo $consumer_key;?>"/>

                        <span><?php esc_attr_e( 'Consumer secret', $this->plugin_name ); ?></span>
                        <input type="<?= ($consumer_secret ? 'password' : 'text');?>" class="large-text" id="<?php echo $this->plugin_name;?>-consumer_secret" name="<?php echo $this->plugin_name;?>[consumer_secret]" value="<?php if(!empty($consumer_secret)) echo $consumer_secret;?>"/>

                    </fieldset>

                    

                    <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

    
                    
                 </form>
                        
                <!-- .meta-box-sortables .ui-sortable -->

            </div>
            <!-- post-body-content -->

            <!-- sidebar -->
            <div id="postbox-container-1" class="postbox-container">

            
                <!-- .meta-box-sortables -->

            </div>
            <!-- #postbox-container-1 .postbox-container -->

        </div>
        <!-- #post-body .metabox-holder .columns-2 -->

        <br class="clear">
    </div>
            <!-- #poststuff -->
</div>
