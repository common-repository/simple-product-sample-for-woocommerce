<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsMasterPublic
{

    public function mcisps_enqueue_public_styles()
    {
        wp_enqueue_style( 'mcisps_public_styles', MCISPS_PLUGIN_URL . 'public/css/public_styles.css' );
    }

    public function sample_controller()
    {
        //Add button to product page & add to cart controller
        require_once MCISPS_PLUGIN_PATH . 'public/partials/sample_controller.php';
        $sample_controller = new McispsSampleController();
        $sample_controller->init();
    }

    public function init()
    {
        add_action( 'wp_enqueue_scripts', [$this, 'mcisps_enqueue_public_styles'] );

        $this->sample_controller();
    }

}
