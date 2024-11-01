<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsActivate
{

    public function default_options()
    {
        $options = [
            'mcisps_max_samples'             => '3',
            'mcisps_background_button_color' => '#2271b1',
            'mcisps_border_color'            => '#2271b1',
            'mcisps_border_width'            => '1',
            'mcisps_text_button_color'       => '#ffffff',
            'mcisps_no_variations'           => '0',
            'mcisps_delete_all_data'         => '0',
            'mcisps_text_button'             => 'Request a sample',
            'mcisps_text_button_max'         => '{max} Samples max.',
            'mcisps_product_categories'      => [],
            'mcisps_padding_top'             => '',
            'mcisps_padding_bottom'          => '',
            'mcisps_padding_left'            => '',
            'mcisps_padding_right'           => '',
            'mcisps_margin_top'              => '7',
            'mcisps_margin_bottom'           => '7',
            'mcisps_margin_left'             => '7',
            'mcisps_margin_right'            => '7',
            'mcisps_force_margin'            => '7',
            'mcisps_font_size'               => '',
            'mcisps_font_weight'             => '',
            'mcisps_default_price'           => '',
            'mcisps_default_values'          => '1', //Create flag to avoid convertion of old database in news installations
            'mcisps_hook_sample_btn' => 'woocommerce_after_add_to_cart_button',
        ];
        return $options;
    }

    public function create_default_options()
    {
        $options = $this->default_options();

        foreach ( $options as $option => $value ) {

            $option_exists = get_option( $option );

            if ( !$option_exists ) {
                add_option( $option, $value );
            }
        }
    }

    public function init()
    {
        if ( get_option( 'mcisps_default_values' ) != '1' && get_option( 'mcisps_version' ) != false ) {
            require_once MCISPS_PLUGIN_PATH . 'includes/convert_old_tables.php';
            new McispsConvertOldTables();
        }

        $this->create_default_options();

        update_option( 'mcisps_version', MCISPS_VERSION );
        flush_rewrite_rules();

    }
}
