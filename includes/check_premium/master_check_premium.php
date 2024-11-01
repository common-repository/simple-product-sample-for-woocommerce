<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsCheckPremium
{

    public function check_master()
    {

        require_once MCISPS_PLUGIN_PATH . 'includes/check_premium/check_lemon.php';
        $check_license_lemon = new CheckLicenseLemonMcisps;

        //Execute only if pages are admin.php?page=plugin_slug or plugins.php & activate/deactivate $mcisps_auth_premium authorization
        global $pagenow;

        if (
            ( isset( $_GET['page'] ) && $_GET['page'] == 'simple-product-sample' && $pagenow == 'admin.php' ) ||
            $pagenow == 'plugins.php'
        ) {
            //Execute convert_pay_to_users if button is pressed
            if (
                isset( $_POST['submit_mcisps_activate'] ) && isset( $_POST['mci_code_key'] ) && strlen( $_POST['mci_code_key'] ) > 18 &&
                !empty( $_POST['mci_code_key'] )
            ) {

                // Activate in Lemon
                if ( $check_license_lemon->instance_exists() !== true ) {
                    $check_license_lemon->activate( sanitize_text_field( $_POST['mci_code_key'] ) );
                }

                if ( $check_license_lemon->validate() ) {
                    update_option( 'mcisps_auth_premium', '1' );
                    printf( '<div class="notice notice-success is-dismissible mcisps_notice"><p>' .
                        __( 'The PRO plugin is activated. ', 'simple-product-sample' ) .
                        '</p></div>' );
                } else {
                    update_option( 'mcisps_auth_premium', '0' );
                    printf( '<div class="notice notice-error is-dismissible mcisps_notice"><p>' .
                        __( 'The PRO plugin is disabled. ', 'simple-product-sample' ) .
                        '</p></div>' );
                }
            }

            $check_license_lemon = $check_license_lemon->validate();

            // Check LemonAPI and deactivate 'mcisps_auth_premium' if none are valid
            if ( $check_license_lemon == false
                && $check_license_lemon != 'server_error'
            ) {
                update_option( 'mcisps_auth_premium', '0' );
            }
        }
    }

    // End check_master function

    public function init()
    {
        add_action( 'admin_init', array( $this, 'check_master' ) );
    }
}