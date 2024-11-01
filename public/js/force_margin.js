'use strict'

// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Force margin to force_margin value in .single_add_to_cart_button and .product .quantity
// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!isNaN(force_margin)) {
  mcisps_force_margin(force_margin);
}

function mcisps_force_margin(force_margin) {
  jQuery('.single_add_to_cart_button').css('margin', force_margin);
  jQuery('.product .quantity').css('margin', force_margin);
}






