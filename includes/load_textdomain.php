<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class McispsLoadTextdomain
{

    public $domain;

    public function __construct()
    {
        $this->domain = 'simple-product-sample';
    }

    public function load_user_languaje()
    {
        // Load User language from wp-content/languages/plugins/*.mo
        load_plugin_textdomain( 'simple-product-sample', false, ABSPATH . 'wp-content/languages' );
    }

    public function load_author_language()
    {
        // Load Author language from wp-content/plugins/simple-product-sample/languages/*.mo
        $locale = apply_filters( 'plugin_locale', determine_locale(), $this->domain );
        $mofile = MCISPS_PLUGIN_PATH . 'languages/simple-product-sample-' . $locale . '.mo';

        load_textdomain( $this->domain, $mofile );
    }

    public function init()
    {
        add_action( 'init', [$this, 'load_user_languaje'], 10 );
        add_action( 'init', [$this, 'load_author_language'], 15 );
    }

}