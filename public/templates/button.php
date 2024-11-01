<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsButton
{
    private $options;

    public function __construct()
    {
        require_once MCISPS_PLUGIN_PATH . 'data/get_data.php';
        $options       = new McispsGetData();
        $this->options = $options;
    }

    public function button_classes()
    {
        $classes = 'class="sps_btn button"';
        return $classes;
    }

    public function button_max_classes()
    {
        $classes = 'class="sps_btn sps_max button"';
        return $classes;
    }

    public function button_preview_classes()
    {
        $classes = 'class="sps_btn button mcisps_preview_btn single_add_to_cart_button"';
        return $classes;
    }

    public function button_styles()
    {
        // Beginning of the button style
        $style = 'style="';

        //Text button color
        if ( $this->options->text_button_color !== null && !empty( $this->options->text_button_color ) ) {
            $style .= 'color:' . esc_attr( $this->options->text_button_color ) . ';';
        }
        //Background button color
        if ( $this->options->background_button_color !== null && !empty( $this->options->background_button_color ) ) {
            $style .= 'background-color:' . esc_attr( $this->options->background_button_color ) . ';';
        }
        //Padding top
        if ( $this->options->padding_top !== "" ) {
            $style .= 'padding-top:' . esc_attr( $this->options->padding_top ) . 'px;';
        }
        //Padding bottom
        if ( $this->options->padding_bottom !== "" ) {
            $style .= 'padding-bottom:' . esc_attr( $this->options->padding_bottom ) . 'px;';
        }
        //Padding left
        if ( $this->options->padding_left !== "" ) {
            $style .= 'padding-left:' . esc_attr( $this->options->padding_left ) . 'px;';
        }
        //Padding right
        if ( $this->options->padding_right !== "" ) {
            $style .= 'padding-right:' . esc_attr( $this->options->padding_right ) . 'px;';
        }
        //Margin top
        if ( $this->options->margin_top !== "" ) {
            $style .= 'margin-top:' . esc_attr( $this->options->margin_top ) . 'px;';
        }
        //Margin bottom
        if ( $this->options->margin_bottom !== "" ) {
            $style .= 'margin-bottom:' . esc_attr( $this->options->margin_bottom ) . 'px;';
        }
        //Margin left
        if ( $this->options->margin_left !== "" ) {
            $style .= 'margin-left:' . esc_attr( $this->options->margin_left ) . 'px;';
        }
        //Margin right
        if ( $this->options->margin_right !== "" ) {
            $style .= 'margin-right:' . esc_attr( $this->options->margin_right ) . 'px;';
        }
        //Font size
        if ( $this->options->font_size !== "" ) {
            $style .= 'font-size:' . esc_attr( $this->options->font_size ) . 'px;';
        }
        //Font weight
        if ( $this->options->font_weight !== "" ) {
            $style .= 'font-weight:' . esc_attr( $this->options->font_weight ) . ';';
        }
        //Border
        if ( $this->options->border_width == 0 || $this->options->border_width == "" ) {
            $style .= 'border:none;';
        } else {
            $style .= 'border:' . esc_attr( $this->options->border_width ) . 'px solid ' . esc_attr( $this->options->border_color ) . ';';
        }

        //End of the button style
        $style .= '"';

        return $style;
    }

    public function get_button()
    {
        $filtered_text_btn = $this->filter_text_button();
        $button            = '<button type="submit" name="add_sample" id="add_sample" ' . $this->button_classes() . ' ' . $this->button_styles() . '>' . esc_html( $filtered_text_btn ) . '</button>';

        return $button;
    }

    public function get_button_max()
    {
        $title_max_message = 'title="' . esc_attr( __( 'Maximum number of samples reached' ) ) . '"';
        $max_number        = $this->options->max_samples;

        if ( $this->options->auth_premium ) {

            $text_button_max = $this->options->text_button_max;
            $text_button_max = str_replace( '{max}', $max_number, $text_button_max );

            $button = '<div ' . $this->button_max_classes() . ' ' . $title_max_message . ' ' . $this->button_styles() . '>' . esc_html( $text_button_max ) . '</div>';
        } else {

            $text_button_max = sprintf( "%s Samples max.", $this->options->max_samples, "simple-product-sample" );
            $button          = '<div ' . $this->button_max_classes() . ' ' . $title_max_message . ' ' . $this->button_styles() . '>' . esc_html( $text_button_max ) . '</div>';
        }

        return $button;
    }

    public function get_preview_button()
    {
        $button = '<div class="mcisps_btn_bg_margins"><button id="mcisps_preview_btn" name="mcisps_preview_btn"' . $this->button_preview_classes() . ' ' . $this->button_styles() . '>' . esc_html( $this->options->text_button ) . '</button></div>';

        return $button;
    }

    public function filter_text_button()
    {
        if ( $this->options->auth_premium ) {

            $sample_price_formatted = $this->get_sample_price_formatted();
            $filtered_text_btn      = str_replace( '{price}', $sample_price_formatted, $this->options->text_button );

            return $filtered_text_btn;
        } else {
            return $this->options->text_button;
        }
    }

    public function get_sample_price_formatted()
    {
        global $product;

        if ( isset( $product ) ) {

            $product_id = $product->get_id();

            require_once MCISPS_PLUGIN_PATH . 'public/partials/sample_controller.php';
            $sample_controller = new McispsSampleController();
            $sample_price      = $sample_controller->select_cart_sample_price( $product_id );

            $sample_price_formatted = $this->build_price_currency( $sample_price );

            return $sample_price_formatted;
        } else {
            return '';
        }
    }

    public function build_price_currency( $number )
    {
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

            $currency_symbol    = get_woocommerce_currency_symbol();
            $currency_position  = get_option( 'woocommerce_currency_pos' );
            $decimal_separator  = get_option( 'woocommerce_price_decimal_sep' );
            $thousand_separator = get_option( 'woocommerce_price_thousand_sep' );
            $number_of_decimals = get_option( 'woocommerce_price_num_decimals' );

            $number = str_replace( ',', '.', $number );
            $number = round( $number, $number_of_decimals );
            $number = number_format( $number, $number_of_decimals, $decimal_separator, $thousand_separator );

            if ( $currency_position == 'left' ) {
                $number = $currency_symbol . $number;
            } elseif ( $currency_position == 'right' ) {
                $number = $number . $currency_symbol;
            } elseif ( $currency_position == 'left_space' ) {
                $number = $currency_symbol . ' ' . $number;
            } elseif ( $currency_position == 'right_space' ) {
                $number = $number . ' ' . $currency_symbol;
            } else {
                $number = $currency_symbol . $number;
            }

        } else {
            $number = round( $number, 2 );
            $number = number_format( $number, 2, '.', '' );
        }

        return sanitize_text_field( $number );
    }

    public function force_margin()
    {
        if ( is_product() ) {
            //Enqueue script
            wp_enqueue_script( 'mcisps_force_margin', MCISPS_PLUGIN_URL . 'public/js/force_margin.js', array( 'jquery' ), MCISPS_VERSION, true );

            //Get the force margin option and send it to the force_margin.js
            $force_margin = $this->options->force_margin;

            if ( $force_margin != "" ) {
                wp_add_inline_script( 'mcisps_force_margin', 'var force_margin = ' . $force_margin . ';', 'before' );
            } else {
                wp_add_inline_script( 'mcisps_force_margin', 'var force_margin = "";', 'before' );
            }
        }
    }
}