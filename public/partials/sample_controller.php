<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsSampleController
{
    private $options;
    private $button;

    public $max_samples;
    public $samples_in_cart;

    public function __construct()
    {
        require_once MCISPS_PLUGIN_PATH . 'data/get_data.php';
        $this->options = new McispsGetData();

        $this->max_samples = $this->options->max_samples;

        require_once MCISPS_PLUGIN_PATH . 'public/templates/button.php';
        $this->button = new McispsButton();
    }

    public function get_samples_in_cart( $cart )
    {
        $cart_items = $cart->get_cart();

        $samples_sum = 0;

        foreach ( $cart_items as $item_value ) {
            if ( isset( $item_value['_sample_active'] ) ) {
                $samples_sum += $item_value['quantity'];
            }
        }
        $this->samples_in_cart = $samples_sum;
        return $this->samples_in_cart;
    }

    public function mcisps_add_button()
    {
        global $woocommerce;
        global $product;

        $id_product = $product->get_id( $product );

        if ( get_post_meta( $id_product, '_sample_active', true ) == 'yes' || $this->in_selected_categories( $product ) ) {

            if ( isset( $_POST['add_sample'] ) ) {

                if ( $product->is_type( 'variable' ) ) {

                    //Get $available_variations in this product
                    $available_variations = $product->get_available_variations(); //get all child variations
                    $variation_id         = $available_variations[0]['variation_id'];
                    $variations_terms     = $product->get_variation_attributes(); // get all attributes by variations

                    $quantity                   = sanitize_text_field( $_POST['quantity'] );
                    $passed_validation_variable = $this->get_samples_in_cart( $woocommerce->cart ) <= $this->max_samples ? 'sample_true' : 'sample_false';

                    if ( $passed_validation_variable == 'sample_true' ) {
                        $woocommerce->cart->add_to_cart();
                        //The notice is shown automatically when adding the variable product / sample
                    } else {
                        wc_add_notice( sprintf( 'You have reached the maximum of %s samples.', sanitize_text_field( $this->max_samples ), 'simple-product-sample' ), 'error' );
                    }
                } else {

                    $quantity                 = sanitize_text_field( $_POST['quantity'] );
                    $passed_validation_simple = $this->get_samples_in_cart( $woocommerce->cart ) <= $this->max_samples ? 'sample_true' : 'sample_false';

                    if ( $passed_validation_simple == 'sample_true' ) {

                        //The product is added in mcisps_add_product_and_notice_in_single

                    } else {
                        wc_add_notice( sprintf( 'You have reached the maximum of %s samples.', sanitize_text_field( $this->max_samples ), 'simple-product-sample' ), 'error' );
                    }
                }
            } // end submit button $_POST['add_sample']

            $quantity = 1;

            $passed_validation_btn = $this->get_samples_in_cart( $woocommerce->cart ) <= $this->max_samples ? 'sample_true' : 'sample_false';

            // Check if validation add_to_cart is passed and add button
            if (  ( $product->is_type( 'variable' ) && $passed_validation_btn == 'sample_true' ) || ( $product->is_type( 'simple' ) && $passed_validation_btn == 'sample_true' ) ) {

                echo $this->button->get_button();
                $this->button->force_margin();

            } else {

                echo $this->button->get_button_max();
                $this->button->force_margin();

            }
        } //end if sample_active
    }

    public function in_selected_categories( $product )
    {
        $product_cats_id = $product->get_category_ids( $product );

        //Check if the product categories are in the selected categories
        $in_selected_cats = false;

        foreach ( $product_cats_id as $cat_id ) {
            if ( in_array( $cat_id, $this->options->selected_categories ) ) {
                $in_selected_cats = true;
            }
        }
        return $in_selected_cats;
    }

    ///////////// Add product & Display sample added to cart message for simple products /////////////////////////////////
    public function mcisps_add_product_and_notice_in_single()
    {
        global $woocommerce;
        global $product;
        $id_product = $product->get_id( $product );

        if ( isset( $_POST['add_sample'] ) ) {
            if ( $product->is_type( 'simple' ) ) {

                $quantity                 = 1;
                $passed_validation_simple = $this->get_samples_in_cart( $woocommerce->cart ) <= $this->max_samples ? 'sample_true' : 'sample_false';

                if ( $passed_validation_simple == 'sample_true' ) {

                    $woocommerce->cart->add_to_cart( $id_product );

                    //echo '<script type="text/javascript">window.location.href="' . get_permalink() . '"</script>'; //reload page manually

                    wc_print_notice( sprintf( 'Sample has been added to cart. <a href="' . wc_get_cart_url() . '" class="mcisps_show_cart">' . __( 'Show Cart', 'simple-product-sample' ) . '</a>', 'simple-product-sample' ) ); //The notice is added manually
                }
            }
        }
    }

///////////// Edit sample added to cart message for variable products /////////////////////////////////
    public function mcisps_add_to_cart_message_html( $message )
    {
        $message = sprintf( "Sample has been added to cart.", "simple-product-sample" );
        return $message;
    }

///////// CONVERT THE VARIABLE PRODUCT IN SIMPLE IF THE BOX IS CHECKED ///////////////////////////////////

    public function mcisps_convert_in_simple( $product_type, $product )
    {
        $no_variations = $this->options->no_variations;

        if ( $no_variations == 1 ) {
            $product_type = 'simple';
        }

        return $product_type;
    }

//////////// DISPLAY ERROR MESSAGE CART AND BLOCK ORDER IF IS GREATER THAN MAX //////////////////////////
    public function mcisps_check_cart_quantities()
    {
        global $woocommerce;
        //Get max_samples_quantity if exists. If not exists set a default value
        if ( $this->max_samples !== null ) {
            $max_samples_quantity = $this->max_samples;
        } else {
            $max_samples_quantity = '3';
        }

        $passed_validation_cart = $this->get_samples_in_cart( $woocommerce->cart ) <= $this->max_samples ? 'sample_true' : 'sample_false';

        if ( $passed_validation_cart == 'sample_false' ) {
            wc_add_notice( sprintf( __( 'You have exceeded the maximum number of samples. Reduce to a maximum of %s samples, please.', 'simple-product-sample' ), $max_samples_quantity, 'simple-product-sample' ), 'error' );

            //Redirect to cart page with javascript and set a transient to avoid infinite loop.
            if ( !get_transient( 'mcisps_redirect' ) ) {
                set_transient( 'mcisps_redirect', 'yes', 3 );
                echo '<script type="text/javascript">window.location.href="' . wc_get_cart_url() . '"</script>';
            }
        }
    }

/////////////////////// MODIFY PRODUCT SAMPLE DATA IN CART ///////////////////////////////////////////////
    ///////////////////// ADD CUSTOM DATA FIELDS TO CART ITEM ////////////////////////////////////////////////
    public function mcisps_add_cart_item_data( $cart_item_data, $product_id, $variation_id )
    {
        global $woocommerce;

        $quantity          = 1;
        $passed_validation = $this->get_samples_in_cart( $woocommerce->cart ) <= $this->max_samples ? 'sample_true' : 'sample_false';

        if ( isset( $_POST['add_sample'] ) && $passed_validation == 'sample_true' ) {
            $cart_item_data['_sample_price']  = $this->select_cart_sample_price( $product_id );
            $cart_item_data['_sample_active'] = get_post_meta( $product_id, '_sample_active', true );
        }
        return $cart_item_data;
    }

    public function select_cart_sample_price( $product_id )
    {
        $sample_price  = get_post_meta( $product_id, '_sample_price', true );
        $default_price = $this->options->default_price;

        if ( $sample_price != '' ) {
            $price = $sample_price;
        } else {
            if ( $default_price != '' ) {
                $price = $default_price;
            } else {
                $price = 0;
            }
        }
        return $price;
    }

///////////////////// REPLACE PRICE AND PRODUCT NAME IN CART ///////////////////////////////////////////////
    public function mcisps_before_calculate_totals( $cart_item )
    {
        if ( is_admin() && !defined( 'DOING_AJAX' ) ) {
            return;
        }

        // Iterate through each cart item
        $samples_sum = 0;

        foreach ( $cart_item->get_cart() as $key => $value ) {

            // Check if product from cart is a sample (This value is saved in the cart item data)
            if ( isset( $value['_sample_active'] ) ) {

                $product_id = $value['data']->get_id();

                // If is a variable product, get the parent id for use this price
                if ( $value['data']->get_type() == 'variation' ) {
                    $product_id = $value['data']->get_parent_id();
                }

                $price = $this->select_cart_sample_price( $product_id );
                $value['data']->set_price( $price );

                $sample_name = __( 'SAMPLE', 'simple-product-sample' );
                $sample_name .= ': ' . $value['data']->get_name();

                $value['data']->set_name( $sample_name );
            }
        }
    }

    public function delete_duplicated_sample_text( $cart_item )
    {
        if ( is_admin() && !defined( 'DOING_AJAX' ) ) {
            return;
        }
        foreach ( $cart_item->get_cart() as $key => $value ) {

            if ( isset( $value['_sample_active'] ) ) {

                $duplicated_text_english = 'SAMPLE: SAMPLE: ';
                $value['data']->set_name( str_replace( $duplicated_text_english, 'SAMPLE: ', $value['data']->get_name() ) );

                $duplicated_text_spanish = 'MUESTRA: MUESTRA: ';
                $value['data']->set_name( str_replace( $duplicated_text_spanish, 'MUESTRA: ', $value['data']->get_name() ) );
            }
        }
    }

    public function init()
    {
        $hook = $this->options->hook_sample_btn ? $this->options->hook_sample_btn : 'woocommerce_after_add_to_cart_button';

        add_action( $hook, [$this, 'mcisps_add_button'], 10 );
        add_action( 'woocommerce_before_single_product_summary', [$this, 'mcisps_add_product_and_notice_in_single'], 10 );

        if ( isset( $_POST['add_sample'] ) ) {
            add_filter( "woocommerce_add_to_cart_handler", [$this, 'mcisps_convert_in_simple'], 10, 2 );
            add_filter( 'wc_add_to_cart_message_html', [$this, 'mcisps_add_to_cart_message_html'], 10, 1 );
        }

        add_action( 'woocommerce_check_cart_items', [$this, 'mcisps_check_cart_quantities'] ); // Block order if is greater than max
        add_filter( 'woocommerce_add_cart_item_data', [$this, 'mcisps_add_cart_item_data'], 10, 3 );

        add_action( 'woocommerce_before_calculate_totals', [$this, 'get_samples_in_cart'], 1, 1 ); // Count samples quantity in cart
        add_action( 'woocommerce_before_calculate_totals', [$this, 'mcisps_before_calculate_totals'], 10, 1 );
        add_action( 'woocommerce_before_calculate_totals', [$this, 'delete_duplicated_sample_text'], 10, 1 ); // Delete duplicated sample text in cart when shipping calculator is used (ajax)

    }

}
