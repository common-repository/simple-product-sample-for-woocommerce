<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsMasterAdmin
{

    private $options;

    public function __construct()
    {
        if ( is_admin() ) {
            require_once MCISPS_PLUGIN_PATH . 'data/get_data.php';
            $options       = new McispsGetData();
            $this->options = $options;
        }

    }

    public function mcisps_enqueue_admin_styles()
    {
        if ( is_admin() ) {
            wp_enqueue_style( 'mcisps_admin_style', MCISPS_PLUGIN_URL . 'admin/css/admin_styles.css' );
            wp_enqueue_script( 'mcisps_main_admin', MCISPS_PLUGIN_URL . 'admin/js/main_admin.js', array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'mcisps_preview_btn', MCISPS_PLUGIN_URL . 'admin/js/preview_btn.js', array( 'jquery' ), '1.0.0', true );
        }
    }

    public function add_plugin_page_settings_link( $links )
    {
        // Add Settings link to the plugins page
        $links[] = '<a href="' . get_admin_url() . 'admin.php?page=simple-product-sample' . '">' . __( 'Settings', 'simple-product-sample' ) . '</a>';

        return $links;
    }

    public function mcisps_check_woocommerce()
    {
        // Check if WooCommerce is active and if not, show an error message in the admin panel
        if ( is_admin() ) {
            if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                add_action( 'admin_notices', [$this, 'mcisps_wc_not_active_message'] );

                if ( is_plugin_active( plugin_basename( dirname( __FILE__, 2 ) ) . '/simple-product-sample.php' ) ) {
                }
            }
        }
    }

    // Messages in the admin panel
    public function mcisps_wc_not_active_message()
    {?>
<div class="notice notice-error">
  <p><?php esc_html_e( '"Simple Product Sample" plugin requires WooCommerce to be installed and active. Please install and activate WooCommerce first.', 'simple-product-sample' );?></p>
</div>
<?php
}

    public function wc_product_create_custom_fields()
    {
        if ( is_admin() ) {
            require_once MCISPS_PLUGIN_PATH . 'admin/partials/wc_create_product_fields.php';
            new McispsWcCreateProductFields();
        }
    }

    public function wc_save_product_fields( $post_id )
    {
        if ( is_admin() ) {
            require_once MCISPS_PLUGIN_PATH . 'admin/partials/wc_save_product_fields.php';
            new McispsWcSaveProductFields( $post_id );
        }
    }

    public function get_options_panel( $options )
    {
        if ( is_admin() ) {

            require_once MCISPS_PLUGIN_PATH . 'admin/partials/get_options_panel.php';
            $options_panel = new McispsGetOptionsPanel( $options );
            $options_panel->init();
        }
    }

    public function init()
    {
        add_action( 'admin_enqueue_scripts', [$this, 'mcisps_enqueue_admin_styles'] );
        add_filter( 'plugin_action_links_' . MCISPS_PLUGIN_BASE_URL, [$this, 'add_plugin_page_settings_link'] );
        add_action( 'admin_init', [$this, 'mcisps_check_woocommerce'] );
        add_action( 'woocommerce_product_options_inventory_product_data', [$this, 'wc_product_create_custom_fields'] );
        add_action( 'woocommerce_process_product_meta', [$this, 'wc_save_product_fields'] );
        $this->get_options_panel( $this->options );
    }

}