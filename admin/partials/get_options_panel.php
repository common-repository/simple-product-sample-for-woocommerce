<?php
if ( !defined( 'ABSPATH' ) ) {exit;}

class McispsGetOptionsPanel
{
    private $options;
    private $button;

    public function __construct( $options )
    {
        $this->options = $options;

        require_once MCISPS_PLUGIN_PATH . 'public/templates/button.php';
        $this->button = new McispsButton();
    }

    // Add item tu WooCommerce menu and configuration page
    public function item_woocommerce_menu()
    {
        add_submenu_page(
            'woocommerce',
            'Simple Product Sample', // Page title
            'Simple Product Sample', // Menu title
            'edit_posts', // permissions
            'simple-product-sample', // slug
            [$this, 'get_options_panel'], // function that contains the configuration code
            75// position
        );
    }

    public function get_options_panel()
    {
        $saved = $this->save_options_panel();
        $this->reload_data();
        ?>

<?php if ( MCISPS_REAL_ENVIRONMENT == false ): ?>
<div class="dev_mode">
  <p>Development mode is active</p>
</div>
<?php endif;?>

<div class="mcisps_header">
  <h2 id="mcisps_title">
    <?php esc_html_e( 'SIMPLE PRODUCT SAMPLE - Options -', 'simple-product-sample' )?>
  </h2>

  <?php if ( !$this->options->auth_premium ): ?>
  <p class="mcisps_description"><?php esc_html_e( 'Do you want the PRO version? ', 'simple-product-sample' );?>
    <a href="https://mci-desarrollo.es/simple-product-sample-pro/?lang=en" target="_blank">
      <?php esc_html_e( 'Get a 30-day free trial here.', 'simple-product-sample' );?></a>
  </p>
  <?php endif;?>

  <p class="mcisps_description"><?php esc_html_e( 'Do you need changes in the plugin? Send us an email to', 'simple-product-sample' );?>
    <a href="mailto:soporte@mci-desarrollo.es">soporte@mci-desarrollo.es</a>
    <?php esc_html_e( 'and we will send you a quote.', 'simple-product-sample' );?>
  </p>

  <?php if ( !$this->options->auth_premium ): ?>
  <p><?php esc_html_e( 'Thanks for using our plugin. ', 'simple-product-sample' );?>
    <a href='https://wordpress.org/support/plugin/simple-product-sample-for-woocommerce/reviews/#new-post' target="_blank" rel="nofollow">
      <?php esc_html_e( 'You will be collaborating to maintain it if you value  ', 'simple-product-sample' );?><span class="stars">★ ★ ★ ★ ★</span>
    </a>
  </p>
  <?php endif;?>
</div>

<form action="" method="post" class="mcisps_form_options">

  <h3 class="mcisps_options_header">
    <?php esc_html_e( 'Button style', 'simple-product-sample' )?>
  </h3>

  <!-- Preview button -->
  <div class="mcisps_preview_btn_wrapper">
    <div class="mcisps_preview_background">
      <span class="mcisps_prebtn_label"><?php esc_html_e( 'Button Preview:', 'simple-product-sample' )?></span>
      <?php echo $this->button->get_preview_button(); ?>
    </div>
  </div>

  <table class="mcisps_options">
    <tbody>
      <!-- Background button color -->
      <tr>
        <th>
          <label for="background_button_color"><?php esc_html_e( 'Background button color', 'simple-product-sample' )?></label>
        </th>
        <td>
          <input type="color" name="background_button_color" id="background_button_color" value="<?php echo esc_attr( $this->options->background_button_color ) ?>">
        </td>
      </tr>
      <!-- Text button color -->
      <tr>
        <th>
          <label for="text_button_color" class="mcisps_label"><?php esc_html_e( 'Text button color', 'simple-product-sample' )?></label>
        </th>
        <td>
          <input type="color" class="col-6" name="text_button_color" id="text_button_color" value="<?php echo esc_attr( $this->options->text_button_color ) ?>">
        </td>
      </tr>
      <!-- Border color -->
      <tr>
        <th>
          <label for="border_color"><?php esc_html_e( 'Border color', 'simple-product-sample' )?></label>
        </th>
        <td>
          <input type="color" name="border_color" id="border_color" value="<?php echo esc_attr( $this->options->border_color ) ?>">
        </td>
      </tr>
      <!-- Border width -->
      <tr>
        <th>
          <label for="border_width"><?php esc_html_e( 'Border width', 'simple-product-sample' )?></label>
        </th>
        <td>
          <input type="number" name="border_width" id="border_width" min="0" value="<?php echo esc_attr( $this->options->border_width ) ?>">
          <span>px</span>

        </td>
      </tr>
      <!-- Button text -->
      <tr>
        <th>
          <label for="text_button"><?php esc_html_e( 'Button text', 'simple-product-sample' );?></label>
        </th>
        <td>
          <input type="text" name="text_button" id="text_button" class="mcisps_text_buttons" value="<?php if ( $this->options->text_button !== null && $this->options->text_button !== "" ) {
            echo esc_html( $this->options->text_button );
        } else {
            echo "Request a sample";
        }?>">
        </td>
      </tr>
      <tr>
        <th></th>
        <td colspan="2" class="mcisps_annotation<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Use {price} to display the price of the sample.', 'simple-product-sample' );
        $this->options->pro_version_text();?></td>
      </tr>

      <!-- Button text max-->
      <tr>
        <th>
          <label class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>" for="text_button_max"><?php esc_html_e( 'Button text (max.samples)', 'simple-product-sample' );
        $this->options->pro_version_text();?>
          </label>
        </th>
        <td>
          <input type="text" name="text_button_max" id="text_button_max" class="mcisps_text_buttons" value="<?php if ( $this->options->text_button_max !== null && $this->options->text_button_max !== "" ) {
            echo esc_html( $this->options->text_button_max );
        } else {
            echo '{max} Samples max.';
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
        </td>
      </tr>
      <tr>
        <th></th>
        <td colspan="2" class="mcisps_annotation <?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Use {max} to display the number of maximum samples.', 'simple-product-sample' );?>
      </tr>

      <!-- Premium options -->

      <!-- Font size -->
      <tr>
        <th>
          <label class=" <?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Font size', 'simple-product-sample' );
        $this->options->pro_version_text();?>
          </label>
        </th>
        <td>
          <div class="mcisps_pixels">
            <input type="number" name="font_size" id="font_size" value="<?php if ( $this->options->font_size !== null ) {
            echo esc_html( $this->options->font_size );
        } else {
            echo '';
        }?>" min="10" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
            <span colspan="2" class="mcisps_annotation<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Empty field for use default font size.', 'simple-product-sample' );?></span>
          </div>
        </td>
      </tr>
      <!-- Font weight -->
      <tr>
        <th>
          <label class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Font weight', 'simple-product-sample' );
        $this->options->pro_version_text();?>
          </label>
        </th>
        <td>
          <div class="mcisps_pixels">
            <input type="number" name="font_weight" id="font_weight" value="<?php if ( $this->options->font_weight !== null ) {
            echo esc_html( $this->options->font_weight );
        } else {
            echo '';
        }?>" min="100" max="900" step="100" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span colspan="2" class="mcisps_annotation<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( '(From 100 to 900 in steps of 100) Empty field for use default font weight.', 'simple-product-sample' );?></span>
          </div>
        </td>
      </tr>

      <!-- Padding -->
      <tr>
        <th></th>
        <td></td>
      </tr>
      <tr>
        <th>
          <label class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
            <?php esc_html_e( 'Padding:', 'simple-product-sample' );
        $this->options->pro_version_text();?>
          </label>
        </th>
        <td class="mcisps_inline_fields">
          <!-- Padding top -->
          <div class="mcisps_pixels">
            <label for="padding_top" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Top', 'simple-product-sample' );?>
            </label>
            <input type="number" name="padding_top" id="padding_top" value="<?php if ( $this->options->padding_top !== null ) {
            echo esc_html( $this->options->padding_top );
        } else {
            echo '';
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
          <!-- Padding bottom -->
          <div class="mcisps_pixels">
            <label for="padding_bottom" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Bottom', 'simple-product-sample' );?>
            </label>
            <input type="number" name="padding_bottom" id="padding_bottom" value="<?php if ( $this->options->padding_bottom !== null ) {
            echo esc_html( $this->options->padding_bottom );
        } else {
            echo '';
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
          <!-- Padding left -->
          <div class="mcisps_pixels">
            <label for="padding_left" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Left', 'simple-product-sample' );?>
            </label>
            <input type="number" name="padding_left" id="padding_left" value="<?php if ( $this->options->padding_left !== null ) {
            echo esc_html( $this->options->padding_left );
        } else {
            echo "";
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
          <!-- Padding right -->
          <div class="mcisps_pixels">
            <label for="padding_right" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Right', 'simple-product-sample' );?>
            </label>
            <input type="number" name="padding_right" id="padding_right" value="<?php if ( $this->options->padding_right !== null ) {
            echo esc_html( $this->options->padding_right );
        } else {
            echo "";
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>

        </td>
      </tr>
      <tr>
        <th></th>
        <td colspan="2" class="mcisps_annotation <?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Empty fields for use default padding.', 'simple-product-sample' );?></td>
      </tr>

      <!-- Margin -->
      <tr>
        <th>
          <label class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Margin:', 'simple-product-sample' );
        $this->options->pro_version_text();?>
          </label>
        </th>
        <td class="mcisps_inline_fields">
          <!-- Margin top -->
          <div class="mcisps_pixels">
            <label for="margin_top" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Top', 'simple-product-sample' );?>
            </label>
            <input type="number" name="margin_top" id="margin_top" value="<?php if ( $this->options->margin_top !== null ) {
            echo esc_html( $this->options->margin_top );
        } else {
            echo '';
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
          <!-- Margin bottom -->
          <div class="mcisps_pixels">
            <label for="margin_bottom" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Bottom', 'simple-product-sample' );?>
            </label>
            <input type="number" name="margin_bottom" id="margin_bottom" value="<?php if ( $this->options->margin_bottom !== null ) {
            echo esc_html( $this->options->margin_bottom );
        } else {
            echo '';
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
          <!-- Margin left -->
          <div class="mcisps_pixels">
            <label for="margin_left" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Left', 'simple-product-sample' );?>
            </label>
            <input type="number" name="margin_left" id="margin_left" value="<?php if ( $this->options->margin_left !== null ) {
            echo esc_html( $this->options->margin_left );
        } else {
            echo "";
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
          <!-- Margin right -->
          <div class="mcisps_pixels">
            <label for="margin_right" class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
              <?php esc_html_e( 'Right', 'simple-product-sample' );?>
            </label>
            <input type="number" name="margin_right" id="margin_right" value="<?php if ( $this->options->margin_right !== null ) {
            echo esc_html( $this->options->margin_right );
        } else {
            echo "";
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>

        </td>
      </tr>
      <tr>
        <th></th>
        <td colspan="2" class="mcisps_annotation<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Empty fields for use default margin.', 'simple-product-sample' );?></td>
      </tr>

      <!-- Force margin in quantity field & cart button -->
      <tr>
        <th class="label_force_margin">
          <label class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Force the margins on the product page so that the "Add to cart" button and the "quantity" field appear aligned. Match the margin of those fields to:', 'simple-product-sample' );
        $this->options->pro_version_text();?>
          </label>
        </th>
        <td class="mcisps_inline_fields">
          <div class="mcisps_pixels">
            <input type="number" name="force_margin" id="force_margin" value="<?php if ( $this->options->force_margin !== null ) {
            echo esc_html( $this->options->force_margin );
        } else {
            echo '';
        }?>" <?php echo !$this->options->auth_premium ? ' disabled' : ''; ?>>
            <span class="<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">px</span>
          </div>
        </td>
      </tr>
      <tr>
        <th></th>
        <td colspan="2" class="mcisps_annotation<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Empty field for use WooCommerce default margins.', 'simple-product-sample' );?></td>
      </tr>

      <!-- End premium options -->

    </tbody>
  </table>

  <hr>

  <h3 class="mcisps_options_header">
    <?php esc_html_e( 'General Options', 'simple-product-sample' )?>
  </h3>

  <table class="mcisps_options mcisps_checkboxes">
    <tr>
      <th>
        <label for="max_samples"><?php esc_html_e( 'Maximum number of samples per order', 'simple-product-sample' )?></label>
      </th>
      <td>
        <input type="number" name="max_samples" id="max_samples" max="1000" min="1" value="<?php if ( $this->options->max_samples !== null && $this->options->max_samples !== "" ) {
            echo esc_html( $this->options->max_samples );
        } else {
            echo "";
        }?>">
      </td>
    </tr>
    <tr>
      <th>
        <input type="checkbox" name="no_variations" id="no_variations" <?php if ( $this->options->no_variations != null && $this->options->no_variations == '1' ) {
            echo 'checked';
        }?>>
      </th>
      <td>
        <label for="no_variations"><?php esc_html_e( 'Avoid the user having to choose product variations. (Does not add the variations details to the order).', 'simple-product-sample' )?></label>
      </td>
    </tr>
    <tr>
      <th>
        <input type="checkbox" name="delete_all_data" id="delete_all_data" <?php if ( $this->options->delete_all_data != null && $this->options->delete_all_data == '1' ) {
            echo 'checked';
        }?>>
      </th>
      <td>
        <label for="delete_all_data"><?php esc_html_e( 'Remove all data on plugin uninstall.', 'simple-product-sample' )?></label>
      </td>
    </tr>

    </tbody>
  </table>

  <hr>
  <h3 class="mcisps_options_header">
    <?php esc_html_e( 'Prices', 'simple-product-sample' )?>
  </h3>
  <p class="mcisps_help_note"><b><?php esc_html_e( 'Set a sample price for each product at:', 'simple-product-sample' );?> </b>
    <?php esc_html_e( 'Products->Edit product page->Product data->Inventory->Simple Product Sample', 'simple-product-sample' );?>
  </p>

  <table class="mcisps_options mcisps_checkboxes">

    <!-- Default price -->
    <tr>
      <th>
        <label for="default_price" <?php echo !$this->options->auth_premium ? ' class="mcisps_no_auth"' : ''; ?>><?php esc_html_e( 'Default global sample price (When there is no individual price)', 'simple-product-sample' )?>
          <?php $this->options->pro_version_text();?>
        </label>
      </th>
      <td>
        <input type="number" name="default_price" id="default_price" <?php echo !$this->options->auth_premium ? 'disabled' : ''; ?> value="<?php if ( $this->options->default_price !== null ) {
            echo esc_html( $this->options->default_price );
        } else {
            echo "";
        }?>" step="0.01" min="0">
      </td>
    </tr>
    <tr>
      <th></th>
      <td colspan="2" class="mcisps_annotation<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>"><?php esc_html_e( 'Default price will be assigned to products that do not have an individual price selected. Set 0 for free.', 'simple-product-sample' );?></td>
    </tr>
  </table>

  <hr>

  <h3 class="mcisps_options_header">
    <?php esc_html_e( 'Show on specific products', 'simple-product-sample' )?>
  </h3>

  <p class="mcisps_help_note"><b><?php esc_html_e( 'Activate the sample on each product in:', 'simple-product-sample' );?> </b>
    <?php esc_html_e( 'Products->Edit product page->Product data->Inventory->Simple Product Sample', 'simple-product-sample' );?>
  </p>

  <hr>

  <h3 class="mcisps_options_header<?php echo !$this->options->auth_premium ? ' mcisps_no_auth' : ''; ?>">
    <?php esc_html_e( 'Show in products by category', 'simple-product-sample' )?>
    <?php $this->options->pro_version_text();?>
  </h3>

  <table class="mcisps_options">
    <tbody>

      <tr>
        <th>
          <label for="selected_categories" <?php echo !$this->options->auth_premium ? ' class="mcisps_no_auth"' : ''; ?>><?php esc_html_e( 'Show sample button in these product categories', 'simple-product-sample' ) . $this->options->pro_version_text();?>;
          </label>
        </th>
        <td>
          <select name="selected_categories[]" id="selected_categories" multiple="multiple" <?php echo !$this->options->auth_premium ? 'disabled' : ''; ?>>
            <?php
$categories = get_terms( 'product_cat', 'orderby=name&hide_empty=0' );
        foreach ( $categories as $category ) {
            $selected = '';
            if ( $this->options->selected_categories != null && in_array( $category->term_id, $this->options->selected_categories ) ) {
                $selected = 'selected';
            }
            echo '<option value="' . esc_attr( $category->term_id ) . '" ' . $selected . '>' . esc_html( $category->name ) . '</option>';
        }
        ?>
          </select>
          <label for="selected_categories" <?php echo !$this->options->auth_premium ? ' class="mcisps_no_auth"' : ''; ?>><?php esc_html_e( 'Use CTRL or Shift for multiple selection', 'simple-product-sample' )?></label>
        </td>

    </tbody>
  </table>

  <hr>

  <input type="hidden" name="mcisps_nonce" value="<?php echo wp_create_nonce( 'mcisps_nonce' ); ?>">
  <input type="submit" name="submit_update" class="mcisps button button-primary" value="<?php esc_attr_e( 'Save changes', 'simple-product-sample' );?>">

  <hr>
  <div id="mcisps_login" <?php if ( $this->options->auth_premium ) {echo ' class="background_green"';}?>>
    <?php if ( !$this->options->auth_premium ): ?>

    <div class="mcisps_input">
      <label for="code_key"><?php esc_html_e( 'License key', 'simple-product-sample' );?></label>
      <input type="password" name="mci_code_key" id="code_key" minlength="20" class="premium-password">
    </div>

    <input class="mcisps_btn" type="submit" name="submit_mcisps_activate" value="<?php esc_html_e( 'Activate PRO', 'simple-product-sample' );?>">

    <a href="https://mci-desarrollo.es/simple-product-sample-pro/?lang=en" target="_blank" class="mcisps_btn green">
      <?php esc_html_e( 'Get 30 days free trial Pro', 'simple-product-sample' );?></a>


    <?php else: ?>
    <b class="mcisps_success bold"><?php esc_html_e( '&#10687; PRO VERSION IS ACTIVE', 'simple-product-sample' );?></b>
    <?php if ( $this->options->auth_premium == '1' ): ?>
    <p class="success secondary_text deactivate_text"><?php esc_html_e( 'If you are no longer going to use the PRO options of the plugin in this WooCommerce installation, you can deactivate licenses to reduce the limit of your PRO plan so that you can use it on other websites. You can always reactivate it with your License Key.', 'simple-product-sample' );?>
      <input class="mcisps_btn" type="submit" name="mcisps_deactivate" id="mcisps_deactivate" value="<?php esc_html_e( 'Deactivate PRO license on this website', 'simple-product-sample' );?>">
    </p>
    <?php endif;?>
    <?php endif;?>
  </div>
  <hr>

</form>

<div id="mcisps_quick">

  <h3><?php esc_html_e( 'Quick start', 'simple-product-sample' )?></h3>

  <ol>
    <li><b><?php esc_html_e( 'Select your preferred options in this menu.', 'simple-product-sample' )?></b></li>
    <li>
      <b><?php esc_html_e( 'Select in each product if it has a sample and its price in:', 'simple-product-sample' )?></b>
      <p>- <?php esc_html_e( 'Products->Edit product page->Product data->Inventory->Simple Product Sample', 'simple-product-sample' )?> </p>
    </li>
    <li>
      <b><?php esc_html_e( 'If you have the Pro version you can also select by categories and set a global price for all samples.', 'simple-product-sample' )?></b>
  </ol>
</div>

<div class="mcisps_rate_pro">
  <?php if ( $this->options->auth_premium ): ?>
  <p>
    <a href='https://wordpress.org/support/plugin/simple-product-sample-for-woocommerce/reviews/#new-post' target="_blank" rel="nofollow">
      <?php esc_html_e( 'Rate our plugin  ', 'simple-product-sample' );?> <span class="stars">★ ★ ★ ★ ★</span>
    </a>
  </p>
  <?php endif;?>
</div>

<?php }

    public function save_options_panel()
    {
        require_once MCISPS_PLUGIN_PATH . 'admin/partials/save_options_panel.php';
        $options = new McispsSaveOptionsPanel();
        $options->init();
    }

    public function reload_data()
    {
        require_once MCISPS_PLUGIN_PATH . 'data/get_data.php';
        $options       = new McispsGetData();
        $this->options = $options;

        $this->button = new McispsButton();
    }

    public function init()
    {
        add_action( "admin_menu", [$this, 'item_woocommerce_menu'] );
    }

}