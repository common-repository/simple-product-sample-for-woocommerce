<?php
if (!defined('ABSPATH')) {
    exit;
}

function mcisps_display_error($message)
{
    echo '<div class="error"><p><strong>' . esc_html($message) . '</strong></p></div>';
}
