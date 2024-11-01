<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class McispsWcCreateProductFields
{

    // Add custom fields to product page
    public function wc_product_custom_fields()
    {
        global $woocommerce, $post;

        echo '<div class="product_custom_field">';
        echo '<h4>Simple Product Sample</h4>';

        //Custom Product Checkbox
        woocommerce_wp_checkbox(
            array(
                'id'    => '_sample_active',
                'label' => __( 'Sample active', 'simple-product-sample' ),
            )
        );

        //Custom Product Sample price
        woocommerce_wp_text_input(
            array(
                'desc_tip'    => 'true',
                'description' => __( 'Set 0 for free sample. (In the PRO version, if the field is empty, the default price of the plugin will be used).', 'simple-product-sample' ),
                'id'          => '_sample_price',
                'label'       => __( 'Sample price', 'simple-product-sample' ),
                'data_type'   => 'price',
            )
        );

        echo '</div>';
    }

    public function __construct()
    {

        $this->wc_product_custom_fields();

    }

}