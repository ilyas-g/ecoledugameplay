<?php 
/**
 * AJAX handler to store the state of dismissible notices.
 */
function blogdata_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

add_action( 'wp_ajax_blogdata_dismissed_notice_handler', 'blogdata_ajax_notice_handler' );

function blogdata_deprecated_hook_admin_notice() {
    // Check if it's been dismissed...
    if ( ! get_option('dismissed-get_started', FALSE ) ) {
        // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
        // and added "data-notice" attribute in order to track multiple / different notices
        // multiple dismissible notice states ?>
            <div class="blogdata-notice-started updated notice notice-get-started-class is-dismissible" data-notice="get_started">
            <div class="blogdata-notice clearfix">
                <div class="blogdata-notice-content">
                    
                    <div class="blogdata-notice_text">
                    <div class="blogdata-hello">
                        <?php esc_html_e( 'Hello, ', 'blogdata' ); 
                        $current_user = wp_get_current_user();
                        echo esc_html( $current_user->display_name );
                        ?>
                        <img draggable="false" role="img" class="emoji" alt="👋🏻" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f44b-1f3fb.svg">                
                    </div>
                    <h1><?php
                            $theme_info = wp_get_theme();
                            printf( esc_html__('Welcome to %1$s', 'blogdata'), esc_html( $theme_info->Name ), esc_html( $theme_info->Version ) ); ?>
                    </h1>
                    
                    <p>
                    <?php
                        echo wp_kses_post( sprintf(
                            __(
                                'Thank you for choosing %1$s theme. To take full advantage of the complete features of the theme, click Get Started and install and activate the %2$s plugin, then use the demo importer and install the %3$s demo according to your need.',
                                'blogdata'
                            ),
                            esc_html($theme_info->Name),
                            '<a href="https://wordpress.org/plugins/ansar-import" target="_blank">' . esc_html__('Ansar Import', 'blogdata') . '</a>',
                            esc_html($theme_info->Name)
                        ) );
                        ?>
                    </p>

                    <div class="panel-column-6">
                        <div class="blogdata-notice-buttons">
                            <a class="blogdata-btn-get-started button button-primary button-hero blogdata-button-padding" href="#" data-name="" data-slug=""><span aria-hidden="true" class="dashicons dashicons-images-alt"></span><?php esc_html_e( 'Get Started', 'blogdata' ) ?></a>
                            <a class="blogdata-btn-get-started-customize button button-secondary button-hero blogdata-button-padding" href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>" data-name="" data-slug=""><span aria-hidden="true" class="dashicons dashicons-welcome-widgets-menus"></span><?php esc_html_e( 'Customize Site', 'blogdata' ) ?></a>
                        </div>
                        <div class="blogdata-notice-links">
                            <div class="blogdata-demos blogdata-notice-link">
                                <span aria-hidden="true" class="dashicons dashicons-images-alt"></span>
                                <a class="blogdata-demos" href="<?php echo esc_url('https://demos.themeansar.com/blogdata-demos')?>" data-name="" data-slug=""><?php esc_html_e( 'View Demos', 'blogdata' ) ?></a>
                            </div>
                            <div class="blogdata-documentation blogdata-notice-link">
                                <span aria-hidden="true" class="dashicons dashicons-list-view"></span>
                                <a class="blogdata-documentation" href="<?php echo esc_url('https://docs.themeansar.com/docs/blogdata-lite/')?>" data-name="" data-slug=""><?php esc_html_e( 'View Documentation', 'blogdata' ) ?></a>
                            </div>
                            <div class="blogdata-support blogdata-notice-link">
                                <span aria-hidden="true" class="dashicons dashicons-format-chat"></span>
                                <a class="blogdata-support" href="<?php echo esc_url('https://themeansar.ticksy.com/')?>" data-name="" data-slug=""><?php esc_html_e( 'Support', 'blogdata' ) ?></a>
                            </div>
                            <div class="blogdata-videos blogdata-notice-link">
                                <span aria-hidden="true" class="dashicons dashicons-video-alt3"></span>
                                <a class="blogdata-videos" href="<?php echo esc_url('https://www.youtube.com/watch?v=pLlN5K7ESZw&list=PLWpTqYqS4j-wUPeadc_pjVIcxXPCBtD0q')?>" data-name="" data-slug=""><?php esc_html_e( 'Video Tutorials', 'blogdata' ) ?></a>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="blogdata-notice_image">
                    <?php 
                    $image_url = get_theme_file_uri( '/images/customize.webp' );
                    // Check if the file exists
                    if ( file_exists( get_theme_file_path( '/images/customize.webp' ) ) ) { ?>
                        <img class="blogdata-screenshot" src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Blogdata', 'blogdata' ); ?>" />
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'blogdata_deprecated_hook_admin_notice' );

/* Plugin Install */

add_action( 'wp_ajax_install_act_plugin', 'blogdata_admin_info_install_plugin' );

function blogdata_admin_info_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/ansar-import' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'ansar-import' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'ansar-import/ansar-import.php' );
    }
}