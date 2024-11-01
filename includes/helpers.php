<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsHelpers
{

    public function display_error( $message )
    {
        echo '<div class="error"><p><strong>' . esc_html( $message ) . '</strong></p></div>';
    }

}