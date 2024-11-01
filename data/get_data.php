<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsGetData
{
    public $auth_premium;

    //Basic options
    public $max_samples;
    public $text_button;
    public $text_button_max;
    public $text_button_color;
    public $background_button_color;
    public $border_color;
    public $border_width;
    public $no_variations;
    public $padding_top;
    public $padding_bottom;
    public $padding_left;
    public $padding_right;
    public $margin_top;
    public $margin_bottom;
    public $margin_left;
    public $margin_right;
    public $force_margin;
    public $font_size;
    public $font_weight;
    public $default_price;
    public $hook_sample_btn;

    public $delete_all_data;
    public $default_values;

    //Premium options
    public $selected_categories;

    public function __construct()
    {

        $this->auth_premium = sanitize_text_field( get_option( 'mcisps_auth_premium' ) );
        //Load Basic options
        $this->max_samples             = sanitize_text_field( get_option( 'mcisps_max_samples' ) );
        $this->text_button             = sanitize_text_field( get_option( 'mcisps_text_button' ) );
        $this->text_button_color       = sanitize_hex_color( get_option( 'mcisps_text_button_color' ) );
        $this->border_color            = sanitize_hex_color( get_option( 'mcisps_border_color' ) );
        $this->border_width            = sanitize_text_field( get_option( 'mcisps_border_width' ) );
        $this->background_button_color = sanitize_hex_color( get_option( 'mcisps_background_button_color' ) );
        $this->no_variations           = sanitize_text_field( get_option( 'mcisps_no_variations' ) );
        $this->delete_all_data         = sanitize_text_field( get_option( 'mcisps_delete_all_data' ) );
        $this->default_values          = sanitize_text_field( get_option( 'mcisps_default_values' ) );
        $this->hook_sample_btn         = sanitize_text_field( get_option( 'mcisps_hook_sample_btn' ) );

        //Load Premium options
        if ( $this->auth_premium ) {

            $this->selected_categories = get_option( 'mcisps_selected_categories' );
            $this->padding_top         = sanitize_text_field( get_option( 'mcisps_padding_top' ) );
            $this->padding_bottom      = sanitize_text_field( get_option( 'mcisps_padding_bottom' ) );
            $this->padding_left        = sanitize_text_field( get_option( 'mcisps_padding_left' ) );
            $this->padding_right       = sanitize_text_field( get_option( 'mcisps_padding_right' ) );
            $this->margin_top          = sanitize_text_field( get_option( 'mcisps_margin_top' ) );
            $this->margin_bottom       = sanitize_text_field( get_option( 'mcisps_margin_bottom' ) );
            $this->margin_left         = sanitize_text_field( get_option( 'mcisps_margin_left' ) );
            $this->margin_right        = sanitize_text_field( get_option( 'mcisps_margin_right' ) );
            $this->force_margin        = sanitize_text_field( get_option( 'mcisps_force_margin' ) );
            $this->font_size           = sanitize_text_field( get_option( 'mcisps_font_size' ) );
            $this->font_weight         = sanitize_text_field( get_option( 'mcisps_font_weight' ) );
            $this->default_price       = sanitize_text_field( get_option( 'mcisps_default_price' ) );
            $this->text_button_max     = sanitize_text_field( get_option( 'mcisps_text_button_max' ) );

        } else {

            $this->auth_premium        = '0';
            $this->selected_categories = [];
            $this->padding_top         = '';
            $this->padding_bottom      = '';
            $this->padding_left        = '';
            $this->padding_right       = '';
            $this->margin_top          = '';
            $this->margin_bottom       = '';
            $this->margin_left         = '';
            $this->margin_right        = '';
            $this->force_margin        = '';
            $this->font_size           = '';
            $this->font_weight         = '';
            $this->default_price       = '';
            $this->text_button_max     = '{max} Samples max.';
        }
    }

    public function pro_version_text()
    {
        if ( !$this->auth_premium ) {
            echo " (" . esc_html__( 'PRO version', 'simple-product-sample' ) . ")";
        } else {
            return;
        }
    }
}
