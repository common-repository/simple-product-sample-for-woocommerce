=== Simple Product Sample ===
Contributors: mcidesarrollo
Donate link: https://mci-desarrollo.es/
Tags: samples, order samples, product samples, product sample button, product sample
Requires at least: 4.6
Tested up to: 6.5
Stable tag: 2.4.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://mci-desarrollo.es/

Add a button to "Request sample" on the WooCommerce product page.
It is possible to activate the sample and configure its price for each product.

== Description ==

Add a button to "Request sample" on the WooCommerce product page.
The plugin allows:
- Activate the sample and configure its price for each product.
- Configure the maximum number of samples for each order.
- Customize the button's text.
- Customize the button's background, text, and border colors by viewing the changes in a button preview.

https://youtu.be/us54hfL7QXk

[Open the mini-tutorial video of the plugin](https://youtu.be/us54hfL7QXk)

== Installation ==

1. Install the plugin through the WordPress plugins screen directly or upload the "Simple Product Sample" plugin to the / wp-content / plugins /
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Configure the plugin options in WooCommerce->Simple Product Sample
4. Configure how you want to show the sample on each product and its price in: Products->Edit Product Page->Product data->Inventory->Simple Product Sample

== Screenshots ==

1. Product sample button in shop.

2. General configuration.

3. Product configuration.

== Changelog ==

= 2.4.0 =
* Compatibility with WordPress 6.5

= 2.3.6 =
* Make hook to add the sample button selectable.

= 2.3.5 =
* Fixed issue that duplicates the sample text when the update button of the WooCommerce shipping calculator was clicked on the cart page.

= 2.3.4 =
* Compatibility with WordPress 6.4

= 2.3.3 =
* Solved issue development mode.

= 2.3.2 =
* Compatibility with WordPress 6.3

= 2.3.1 =
* Compatibility with WordPress 6.2

= 2.3.0 =
* Fixed bug that caused failures in the maximum number of samples in products selected by category.

= 2.2.6 =
* Added url parameter language to the plugin link.

= 2.2.5 =
* Adedd link to mini-tutorial in plugin description.

= 2.2.4 =
* Solved bug on save text max.

= 2.2.3 =
* Solved bug with the button maximum.

= 2.2.2 =
* Compatible with WordPress 6.1.

= 2.2.1 =
* Changed the order of options on the settings page.
* Added option to use {price} to display the price in the button text.
* Added the option to customize the button text when the maximum number of samples has been reached.
* Minor bug fixes.


= 2.2.0 =
* Improvement in the way of displaying the button preview.
* Remove plugin prefix on pro license activation.
* New options to configure the button's margin and padding.
* New option to force margins for the "quantity" field and the "Add to cart" button.
* New option to set a default global sample price (when there is no individual price).
* New options to select font-size and font-weight for the sample button.
* New options to select border-color and border-width for the sample button.

= 2.1.0 =
* Added preview of the colors and text of the button to see the result in real time.

= 2.0.0 =
* Code refactoring improvements.
* Added Spanish language of the author.
* Authentication features for PRO version.
* Added "Button text" field in options menu to customize the button field.
* Added constant 'MCISPS_REAL_ENVIRONMENT' to develop works.
* Added the option to select products by categories in a multiselect menu for Pro version.

= 1.3.1 =
* Fixed a bug that caused an error when adding products with variations without selecting the variation.

= 1.3.0 =
* Refactoring to continue making the plugin more scalable in future versions.
* Deletion of old options table and use of options in the standard WordPress system for better integration.

= 1.2.9 =
* Tested compatibility with WordPress 6.0 and WooCommerce 6.5

= 1.2.8 =
* Make hover notice in button translatable

= 1.2.7 =
* Added hover notice in button when the maximum number has been reached.

= 1.2.6 =
* Replaced wc_add_notice by with wc_print_notice to correct problems displaying "Sample is added to cart".

= 1.2.5 =
* Improve page reload.

= 1.2.4 =
* Show "Added to Cart" notice before reloading the entire product.

= 1.2.3 =
* More CSS improvements.

= 1.2.2 =
* CSS standardization.

= 1.2.1 =
* CSS Corrections.

= 1.2.0 =
* Added option to choose a maximum number of samples.
* Added notice "Sample has been added to cart.".
* CSS improvements.

= 1.1.0 =
* Issue that caused the product to be added to the cart when a product's sample price field is empty.

= 1.0.9 =
* Tested in WordPress 5.8

= 1.0.8 =
* Tested in WordPress 5.6.2
* Custom development notice.
* Remove title translations.

= 1.0.7 =
* Fixed css styles bug.

= 1.0.6 =
* Fixed security bugs.

= 1.0.5 =
* Initial release