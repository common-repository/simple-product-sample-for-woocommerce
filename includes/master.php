<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsMaster
{

    private $load_textdomain;
    private $admin;
    private $public;
    private $mcisps_check_premium;
    private $helpers;

    private function load_dependencies()
    {

        require_once MCISPS_PLUGIN_PATH . 'includes/load_textdomain.php';
        require_once MCISPS_PLUGIN_PATH . 'admin/master_admin.php';
        require_once MCISPS_PLUGIN_PATH . 'public/master_public.php';
        require_once MCISPS_PLUGIN_PATH . 'includes/check_premium/master_check_premium.php';
        require_once MCISPS_PLUGIN_PATH . 'includes/helpers.php';

    }

    private function load_instances()
    {
        $this->load_textdomain = new McispsLoadTextdomain;
        $this->load_textdomain->init();

        $this->mcisps_check_premium = new McispsCheckPremium();
        $this->mcisps_check_premium->init();

        $this->helpers = new McispsHelpers;

        $this->public = new McispsMasterPublic;
        $this->public->init();

        $this->admin = new McispsMasterAdmin;
        $this->admin->init();

    }

    public function init()
    {

        $this->load_dependencies();
        $this->load_instances();

    }

}
