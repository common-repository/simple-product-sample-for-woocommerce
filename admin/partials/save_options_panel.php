<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsSaveOptionsPanel
{
    private $options;

    public function __construct()
    {
        $this->options = new McispsGetData();
    }

    public function save_form()
    {

        if ( isset( $_POST['submit_update'] ) ) {

            //Check nonce field and save data if it is valid
            if ( isset( $_POST['mcisps_nonce'] ) && wp_verify_nonce( $_POST['mcisps_nonce'], 'mcisps_nonce' ) ) {

                //Background button color
                if ( isset( $_POST['background_button_color'] ) && !empty( $_POST['background_button_color'] ) ) {
                    $background_button_color = sanitize_hex_color( $_POST['background_button_color'] );
                    update_option( 'mcisps_background_button_color', $background_button_color );
                } else {
                    $this->mcisps_save_error( 'The value of the Background button color field was not saved because it was empty. The previous color has been kept. Select a different new color to save it.' );
                }

                //Text button color
                if ( isset( $_POST['text_button_color'] ) && !empty( $_POST['text_button_color'] ) ) {
                    $text_button_color = sanitize_hex_color( $_POST['text_button_color'] );
                    update_option( 'mcisps_text_button_color', $text_button_color );
                } else {
                    $this->mcisps_save_error( 'The value of the Text button color field was not saved because it was empty. The previous color has been kept. Select a different new color to save it.' );
                }

                //Border color
                if ( isset( $_POST['border_color'] ) && !empty( $_POST['border_color'] ) ) {
                    $border_color = sanitize_hex_color( $_POST['border_color'] );
                    update_option( 'mcisps_border_color', $border_color );
                } else {
                    $this->mcisps_save_error( 'The value of the Border color field was not saved because it was empty. The previous color has been kept. Select a different new color to save it.' );
                }

                //Border width
                if ( isset( $_POST['border_width'] ) ) {
                    $border_width = sanitize_text_field( $_POST['border_width'] );
                    update_option( 'mcisps_border_width', $border_width );
                } else {
                    $this->mcisps_save_error( 'The value of the Border width field was not saved because it was empty. The previous value has been kept. Select a different new value to save it.' );
                }

                //Max samples
                if ( isset( $_POST['max_samples'] ) && !empty( $_POST['max_samples'] ) ) {
                    $max_samples = sanitize_text_field( $_POST['max_samples'] );
                    update_option( 'mcisps_max_samples', $max_samples );
                } else {
                    $this->mcisps_save_error( 'The value of the Maximum number of samples per order field was not saved because it was empty. The previous value has been kept. Type a different new number to save it.' );
                }
                //Text button
                if ( isset( $_POST['text_button'] ) && !empty( $_POST['text_button'] ) ) {
                    $text_button = sanitize_text_field( $_POST['text_button'] );
                    update_option( 'mcisps_text_button', $text_button );
                } else {
                    $this->mcisps_save_error( 'The value of the Text button field was not saved because it was empty. The previous value has been kept. Type a different new number to save it.' );
                }

                // PREMIUM OPTIONS ///////////////////////////////////////////////////////////////////

                if ( $this->options->auth_premium ) {

                    //Text button max
                    if ( isset( $_POST['text_button_max'] ) && !empty( $_POST['text_button_max'] ) ) {
                        $text_button_max = sanitize_text_field( $_POST['text_button_max'] );
                        update_option( 'mcisps_text_button_max', $text_button_max );
                    } else {
                        $this->mcisps_save_error( 'The value of the Text button max field was not saved because it was empty. The previous value has been kept. Type a different new number to save it.' );
                    }
                    //Padding top
                    if ( isset( $_POST['padding_top'] ) ) {
                        $padding_top = sanitize_text_field( $_POST['padding_top'] );
                        update_option( 'mcisps_padding_top', $padding_top );
                    } else {
                        update_option( 'mcisps_padding_top', '' );
                    }
                    //Padding bottom
                    if ( isset( $_POST['padding_bottom'] ) ) {
                        $padding_bottom = sanitize_text_field( $_POST['padding_bottom'] );
                        update_option( 'mcisps_padding_bottom', $padding_bottom );
                    } else {
                        update_option( 'mcisps_padding_bottom', '' );
                    }
                    //Padding left
                    if ( isset( $_POST['padding_left'] ) ) {
                        $padding_left = sanitize_text_field( $_POST['padding_left'] );
                        update_option( 'mcisps_padding_left', $padding_left );
                    } else {
                        update_option( 'mcisps_padding_left', '' );
                    }
                    //Padding right
                    if ( isset( $_POST['padding_right'] ) ) {
                        $padding_right = sanitize_text_field( $_POST['padding_right'] );
                        update_option( 'mcisps_padding_right', $padding_right );
                    } else {
                        update_option( 'mcisps_padding_right', '' );
                    }
                    //Margin top
                    if ( isset( $_POST['margin_top'] ) ) {
                        $margin_top = sanitize_text_field( $_POST['margin_top'] );
                        update_option( 'mcisps_margin_top', $margin_top );
                    } else {
                        update_option( 'mcisps_margin_top', '' );
                    }
                    //Margin bottom
                    if ( isset( $_POST['margin_bottom'] ) ) {
                        $margin_bottom = sanitize_text_field( $_POST['margin_bottom'] );
                        update_option( 'mcisps_margin_bottom', $margin_bottom );
                    } else {
                        update_option( 'mcisps_margin_bottom', '' );
                    }
                    //Margin left
                    if ( isset( $_POST['margin_left'] ) ) {
                        $margin_left = sanitize_text_field( $_POST['margin_left'] );
                        update_option( 'mcisps_margin_left', $margin_left );
                    } else {
                        update_option( 'mcisps_margin_left', '' );
                    }
                    //Margin right
                    if ( isset( $_POST['margin_right'] ) ) {
                        $margin_right = sanitize_text_field( $_POST['margin_right'] );
                        update_option( 'mcisps_margin_right', $margin_right );
                    } else {
                        update_option( 'mcisps_margin_right', '' );
                    }
                    //Force margin
                    if ( isset( $_POST['force_margin'] ) ) {
                        $force_margin = sanitize_text_field( $_POST['force_margin'] );
                        update_option( 'mcisps_force_margin', $force_margin );
                    } else {
                        update_option( 'mcisps_force_margin', '' );
                    }
                    //Default price
                    if ( isset( $_POST['default_price'] ) ) {
                        $default_price = sanitize_text_field( $_POST['default_price'] );
                        update_option( 'mcisps_default_price', $default_price );
                    } else {
                        update_option( 'mcisps_default_price', '' );
                    }
                    //Font size
                    if ( isset( $_POST['font_size'] ) ) {
                        $font_size = sanitize_text_field( $_POST['font_size'] );
                        update_option( 'mcisps_font_size', $font_size );
                    } else {
                        update_option( 'mcisps_font_size', '' );
                    }
                    //Font weight
                    if ( isset( $_POST['font_weight'] ) ) {
                        $font_weight = sanitize_text_field( $_POST['font_weight'] );
                        update_option( 'mcisps_font_weight', $font_weight );
                    } else {
                        update_option( 'mcisps_font_weight', '' );
                    }

                }

                // END PREMIUM OPTIONS ///////////////////////////////////////////////////////////////////

                //No variations checkbox
                if ( isset( $_POST['no_variations'] ) ) {
                    update_option( 'mcisps_no_variations', '1' );
                } else {
                    update_option( 'mcisps_no_variations', '0' );
                }

                //Delete all data checkbox
                if ( isset( $_POST['delete_all_data'] ) ) {
                    update_option( 'mcisps_delete_all_data', '1' );
                } else {
                    update_option( 'mcisps_delete_all_data', '0' );
                }

                //Selected categories
                if ( isset( $_POST['selected_categories'] ) ) {
                    $selected_categories = $_POST['selected_categories'];
                    update_option( 'mcisps_selected_categories', $selected_categories );
                } else {
                    update_option( 'mcisps_selected_categories', [] );
                }

                $this->updated_message();

            } else {

                $this->error_message();
            } // end if nonce

        } // end submit_update

        // Deactivate premium license if press button deactivate_license
        $this->deactivate_premium();
    }

    public function deactivate_premium()
    {
        if (  ( isset( $_POST['mcisps_nonce'] ) && wp_verify_nonce( $_POST['mcisps_nonce'], 'mcisps_nonce' ) ) &&
            $this->options->auth_premium && isset( $_POST['mcisps_deactivate'] ) ) {

            require_once MCISPS_PLUGIN_PATH . 'includes/check_premium/check_lemon.php';
            $license_lemon = new CheckLicenseLemonMcisps();
            $license_lemon->deactivate();
            update_option( 'mcisps_auth_premium', '0' );
        }
    }

    public function updated_message()
    {
        ?>
<div class="notice notice-success">
  <p><?php esc_html_e( 'Options have been saved.', 'simple-product-sample' );?></p>
</div>
<?php
}

    public function error_message()
    {
        ?>
<div class="notice notice-error">
  <p><?php esc_html_e( 'Error nonce saving options.', 'simple-product-sample' );?></p>
</div>
<?php
}

    public function mcisps_save_error( $text )
    {
        ?>
<div class="notice notice-error">
  <p><?php esc_html_e( $text, 'simple-product-sample' );?></p>
</div>
<?php
}

    public function init()
    {

        $this->save_form();
    }

}