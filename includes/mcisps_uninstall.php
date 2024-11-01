<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class McispsUninstall
{
    public function __construct()
    {
        if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
            if ( get_option( 'mcisps_delete_all_data' ) == '1' ) {

                $this->delete_options();

            }
        }
    }

    public function delete_options()
    { // Delete all data from DB if delete_all_data option is set to 1

        if ( get_option( 'mcisps_delete_all_data' ) == '1' ) {

            delete_option( 'mcisps_max_samples' );
            delete_option( 'mcisps_no_variations' );
            delete_option( 'mcisps_background_button_color' );
            delete_option( 'mcisps_text_button_color' );
            delete_option( 'mcisps_border_color' );
            delete_option( 'mcisps_border_width' );
            delete_option( 'mcisps_version' );
            delete_option( 'mcisps_default_values' );
            delete_option( 'mcisps_delete_all_data' );
            delete_option( 'mcisps_text_button' );
            delete_option( 'mcisps_text_button_max' );
            delete_option( 'mcisps_selected_categories' );
            delete_option( 'mcisps_padding_top' );
            delete_option( 'mcisps_padding_bottom' );
            delete_option( 'mcisps_padding_left' );
            delete_option( 'mcisps_padding_right' );
            delete_option( 'mcisps_margin_top' );
            delete_option( 'mcisps_margin_bottom' );
            delete_option( 'mcisps_margin_left' );
            delete_option( 'mcisps_margin_right' );
            delete_option( 'mcisps_force_margin' );
            delete_option( 'mcisps_font_size' );
            delete_option( 'mcisps_font_weight' );
            delete_option( 'mcisps_default_price' );
            delete_option( 'mcisps_hook_sample_btn' );
            delete_option( 'mcisps_auth_premium' );
        }
    }

} //end class
