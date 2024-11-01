<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsConvertOldTables
{
    public function __construct()
    {
        $this->mcisps_set_default_values();
    }

    public function mcisps_set_default_values()
    {
        // Create default values if mcisps_default_values option is not set
        if ( !get_option( 'mcisps_default_values' ) ) {

            // Set max_samples to default value if not set or set to stored value if set in DB
            if ( get_option( 'mcisps_max_samples' ) == null || get_option( 'mcisps_max_samples' ) == "" ) {
                if ( $this->get_mcisps_option_from_db( 'max_samples' ) != null ) {
                    update_option( 'mcisps_max_samples', $this->get_mcisps_option_from_db( 'max_samples' ) );
                } else {
                    update_option( 'mcisps_max_samples', '3' );
                }
            }
            // Set no_variations to default value if not set or set to stored value if set in DB
            if ( get_option( 'mcisps_no_variations' ) == null || get_option( 'mcisps_no_variations' ) == "" ) {
                if ( $this->get_mcisps_option_from_db( 'no_variations' ) != null ) {
                    update_option( 'mcisps_no_variations', $this->get_mcisps_option_from_db( 'no_variations' ) );
                } else {
                    update_option( 'mcisps_no_variations', '0' );
                }
            }
            // Delete table mcisps_options if it exists
            if ( $this->mcisps_options_db_table_exists() ) {
                global $wpdb;
                $tabla_mcisps_options = sanitize_text_field( $wpdb->prefix ) . 'mcisps_options';
                $wpdb->query( "DROP TABLE $tabla_mcisps_options" );
            }

            // Set mcisps_default_values option to 1 to avoid set default values in next plugin activation
            add_option( 'mcisps_default_values', true );
        } // end if default values
    }

    //Check if table exists in database
    public function mcisps_options_db_table_exists()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mcisps_options';
        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
            return false;
        } else {
            return true;
        }
    }

    public function get_mcisps_option_from_db( $option )
    {
        if ( $this->mcisps_options_db_table_exists() ) {

            global $wpdb;
            $tabla_mcisps_options = sanitize_text_field( $wpdb->prefix ) . 'mcisps_options';

            $sql        = $wpdb->prepare( "SELECT mcisps_value FROM $tabla_mcisps_options WHERE mcisps_option = %s", $option );
            $get_option = $wpdb->get_results( $sql );

            if ( count( $get_option ) > 0 ) {
                $get_option = sanitize_text_field( $get_option[0]->mcisps_value );
                return $get_option;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

} //end class