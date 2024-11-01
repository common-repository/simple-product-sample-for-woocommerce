'use strict'

/////////////////////////////////////////////////////////////////////////////////////////////
// Show message confirmation in simple-product-sample plugin settings page
/////////////////////////////////////////////////////////////////////////////////////////////
mcisps_deactivate_confirm();

function mcisps_deactivate_confirm() {

  if (window.location.href.indexOf('admin.php?page=simple-product-sample') > -1) {

    // Listen button click event and show a confirmation message for delete registration
    let mcisps_deactivate_btn = document.getElementById('mcisps_deactivate');
    let mcisps_deactivate_confirm = 'Are you sure you want to deactivate the plugin pro? You will need the license code to activate it again.';
    if (mcisps_deactivate_btn) {

      mcisps_confirm(mcisps_deactivate_btn, mcisps_deactivate_confirm);

    }
  }
}

function mcisps_confirm(button, message) {
  button.addEventListener('click', function (event) {
    if (confirm(message)) {
      return true;
    } else {
      event.preventDefault();
    }
  });
}