'use strict'

if (window.location.href.indexOf('admin.php?page=simple-product-sample') > -1) {

  mcisps_change_css_property('padding_top', 'paddingTop', 'px');
  mcisps_change_css_property('padding_bottom', 'paddingBottom', 'px');
  mcisps_change_css_property('padding_left', 'paddingLeft', 'px');
  mcisps_change_css_property('padding_right', 'paddingRight', 'px');
  mcisps_change_css_property('margin_top', 'marginTop', 'px');
  mcisps_change_css_property('margin_bottom', 'marginBottom', 'px');
  mcisps_change_css_property('margin_left', 'marginLeft', 'px');
  mcisps_change_css_property('margin_right', 'marginRight', 'px');
  mcisps_change_css_property('font_size', 'fontSize', 'px');

  mcisps_change_css_property('font_weight', 'fontWeight');
  mcisps_change_css_property('background_button_color', 'backgroundColor');
  mcisps_change_css_property('text_button_color', 'color');

  mcisps_text();
  mcisps_border_style();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to change CSS properties + px text in the preview button
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// @param {string} input_id - id of the input (i.e. padding_top)
// @param {string} css_property - css property to change (i.e. paddingTop)
// @param {string} add_px - add px to the value (i.e. 'px')

function mcisps_change_css_property(input_id, css_property, add_px = "") {

  let preview_btn = document.getElementById('mcisps_preview_btn');
  let input = document.getElementById(input_id);

  if (preview_btn && input) {

    input.addEventListener('change', function (event) {
      preview_btn.style[css_property] = event.target.value + add_px;
      if (event.target.value == "") {
        preview_btn.style[css_property] = '';
      }
    });
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to change CSS properties in border style in the preview button
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mcisps_border_style() {

  let preview_btn = document.getElementById('mcisps_preview_btn');
  let input_width = document.getElementById('border_width');
  let input_color = document.getElementById('border_color');

  if (preview_btn && (input_width || input_color)) {

    input_width.addEventListener('change', function (event) {

      let width = event.target.value;
      if (width == "") {
        preview_btn.style.border = 'none';
      } else {
        preview_btn.style.border = width + 'px solid ' + input_color.value;
      }
    });

    input_color.addEventListener('change', function (event) {
      let color = event.target.value;
      if (input_width == "") {
        preview_btn.style.border = 'none';
      } else {
        preview_btn.style.border = input_width.value + 'px solid ' + color;
      }
    });
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Change the text in mcisps_preview_btn button while write when the mcisps_text_button is changed in the input
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mcisps_text() {

  let mcisps_preview_btn = document.getElementById('mcisps_preview_btn');
  let mcisps_text_input = document.getElementById('text_button');

  if (mcisps_preview_btn && mcisps_text_input) {

    mcisps_text_input.addEventListener('keyup', function (event) {
      mcisps_preview_btn.innerHTML = event.target.value;
    });
  }
}