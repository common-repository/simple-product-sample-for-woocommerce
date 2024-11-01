<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class McispsWcSaveProductFields
{

    public function save_custom_fields( $post_id )
    {
        // Custom Product Sample price
        $sample_price = sanitize_text_field( $_POST['_sample_price'] );
        update_post_meta( $post_id, '_sample_price', sanitize_text_field( $sample_price ) );

        // Custom Product Sample active checkbox
        $sample_active = sanitize_text_field( $_POST['_sample_active'] );
        update_post_meta( $post_id, '_sample_active', sanitize_text_field( $sample_active ) );
    }

    public function __construct( $post_id )
    {
        $this->save_custom_fields( $post_id );
    }

}