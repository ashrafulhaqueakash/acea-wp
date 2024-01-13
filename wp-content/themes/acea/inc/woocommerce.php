<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package acea
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function acea_wc_setup() {
    add_theme_support(
        'woocommerce',
        array(
            'thumbnail_image_width' => 255,
            'single_image_width'    => 492,
            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'default_columns' => 3,
                'min_columns'     => 1,
                'max_columns'     => 6,
            ),
        )
    );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'acea_wc_setup' );

function acea_default_catalog_orderby( $sort_by ) {
    return 'date';
}
add_filter( 'woocommerce_default_catalog_orderby', 'acea_default_catalog_orderby' );

/**
 * Change number of products that are displayed per page (shop page)
 */

function shop_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value aceaed on Options –> Reading
    // Return the number of products you wanna show per page.
    $cols = 9;
    return $cols;
}
add_filter( 'loop_shop_per_page', 'shop_loop_shop_per_page', 20 );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function acea_wc_scripts() {
    wp_enqueue_style( 'acea-woocommerce-style', get_theme_file_uri( '/assets/css/acea-woocommerce.css' ), array( 'woocommerce-general' ) );
    wp_enqueue_style( 'acea-woocommerce-default', get_theme_file_uri( '/assets/css/acea-woocommerce-default.css' ), array( 'acea-woocommerce-style' ) );
}
add_action( 'wp_enqueue_scripts', 'acea_wc_scripts', 8 );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function acea_wc_active_body_class( $classes ) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter( 'body_class', 'acea_wc_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function wc_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => 4,
        'columns'        => 4,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wc_related_products_args' );

/**
 * Remove the breadcrumbs
 */
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'woo_remove_wc_breadcrumbs' );

/**
 * Remove default WooCommerce title.
 */
add_filter( 'woocommerce_show_page_title', 'hide_shop_page_title' );

function hide_shop_page_title( $title ) {
    $title = false;
    return $title;
}

// OPTION VARIABLE

// $shop_page = acea_redux_data('shop_style');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );

//

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function woocommerce_result_count() {?>
	<div class="rst-shop-cart">
		<div class="cart-content">
			<span class="acea-shop-cart"><?php _e( 'Cart:', 'acea' );?></span>
			<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>">
				<?php echo sprintf( _n( ' - %d item', '%d items', WC()->cart->get_cart_contents_count(), 'acea' ), WC()->cart->get_cart_contents_count() ); ?>
			</a>


		</div>

		<div class="crt-btn">
			<a href="<?php echo wc_get_cart_url(); ?>"><button><?php _e( 'Go to cart', 'acea' )?></button></a>
		</div>

	</div>
	<?php }
add_action( 'our-content', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'our-content', 'woocommerce_catalog_ordering', 30 );

if ( !function_exists( 'acea_wc_wrapper_before' ) ) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function acea_wc_wrapper_before() {

        if ( is_active_sidebar( 'product-sidebar' ) ) {
            $column_class = ' col-xl-9 col-lg-8 col-md-12 woo-has-sidebar';
        } else {
            $column_class = 'col-12';
        }

        ?>


		<div class="acea-woocommerce-page">


				<div class="row justify-content-center">
					<?php if ( is_product() ): ?>
						<div class="col-md-12">
						<?php else: ?>
							<?php if ( is_active_sidebar( 'product-sidebar' ) ):

            // $shop_sidebar_style = acea_redux_data('shop_sidebar_style');
            $shoppage_order = 'order-2';
            ?>
									<div class="col-xl-3 col-lg-4 col-md-10 <?php echo esc_attr( $shoppage_order ); ?>">
										<div class="acea-sidebar-wrap">
											<?php dynamic_sidebar( 'product-sidebar' );?>
										</div>
									</div>
								<?php endif;?>



							<div class="<?php echo esc_attr( $column_class ); ?> acea-shop-items-wrap">
							<?php endif;?>
							<!-- <main id="primary" class="site-main"> -->
						<?php

}
}
add_action( 'woocommerce_before_main_content', 'acea_wc_wrapper_before' );

if ( !function_exists( 'acea_wc_wrapper_after' ) ) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function acea_wc_wrapper_after() {
        ?>
							<!-- </main> -->
							<!-- #main -->

						</div>
                     </div>
				</div>

			<?php
}
}
add_action( 'woocommerce_after_main_content', 'acea_wc_wrapper_after', 10 );
/**
 * Removing the woocommerce sidebar.
 *
 */
function disable_woo_commerce_sidebar() {
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'init', 'disable_woo_commerce_sidebar' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *

 */

if ( !function_exists( 'acea_wc_cart_link_fragment' ) ) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function acea_wc_cart_link_fragment( $fragments ) {
        ob_start();
        acea_wc_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'acea_wc_cart_link_fragment' );

if ( !function_exists( 'acea_wc_cart_link' ) ) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function acea_wc_cart_link() {
        ?>
				<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'acea' );?>">
					<?php
$item_count_text = sprintf(

            _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'acea' ),
            WC()->cart->get_cart_contents_count()
        );
        ?>
					<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
				</a>
			<?php
}
}

if ( !function_exists( 'acea_wc_header_cart' ) ) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function acea_wc_header_cart() {
        if ( is_cart() ) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
				<ul id="site-header-cart" class="site-header-cart">
					<li class="<?php echo esc_attr( $class ); ?>">
						<?php acea_wc_cart_link();?>
					</li>
					<li>
						<?php
$instance = array(
            'title' => '',
        );

        the_widget( 'WC_Widget_Cart', $instance );
        ?>
					</li>
				</ul>
				<?php
}
}

/**
 * Adding price prefix.
 */
function acea_rrp_sale_price_html( $price, $product ) {
    if ( $product->is_on_sale() ):
        $has_sale_text = array(
            '<del aria-hidden="true">' => '<del><span class="price-prefix">' . esc_html__( 'List Price:', 'acea' ) . '</span> ',
            '<ins>'                    => '<br/> <ins> <span class="price-prefix">' . esc_html__( 'Price:', 'acea' ) . '</span> ',
        );
        $return_string = str_replace( array_keys( $has_sale_text ), array_values( $has_sale_text ), $price );
    else:
        $return_string = '<span class="price-prefix">' . esc_html__( 'Price:', 'acea' ) . '</span>' . $price;
    endif;
    return $return_string;
}
add_filter( 'woocommerce_get_price_html', 'acea_rrp_sale_price_html', 100, 2 );

add_action( 'woocommerce_before_add_to_cart_quantity', 'acea_before_qty_add' );
function acea_before_qty_add() {
    echo '<div class="qty-label">' . esc_html__( 'Quantity:', 'acea' ) . ' </div>';
}

// Change the product description title
add_filter( 'woocommerce_product_description_heading', 'acea_change_product_description_heading' );
function acea_change_product_description_heading() {
    return __( '', 'acea' );
}

// Change the additional information title tab

if ( !function_exists( 'acea_rename_additional_info_tab' ) ) {
    function acea_rename_additional_info_tab( $tabs ) {

        $tabs['additional_information']['title'] = 'Specification';

        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'acea_rename_additional_info_tab' );

// wrapping up woo related products
function acea_move_related_products_before_tabs() {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
   
}
add_action( 'init', 'acea_move_related_products_before_tabs' );

if ( !function_exists( 'acea_wc_related_product_wrapper_before' ) ) {
    /**
     * related product wrapping
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function acea_wc_related_product_wrapper_before() {
        global $product;

        if ( $product ) {

            $related_count = count( wc_get_related_products( $product->get_id() ) );
        } else {
            $related_count = 0;
        }

        if ( is_product() && 0 != $related_count ) {
            ?>
					<div class="acea-woo-related-product-area">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<?php
woocommerce_output_related_products();
            ?>
								</div>
							</div>
						</div>
					</div>
				<?php
}
    }
}
add_action( 'woocommerce_after_main_content', 'acea_wc_related_product_wrapper_before', 40 );

if ( !function_exists( 'acea_wc_checkout_order_details_wrapper_start' ) ) {
    /**
     * related product wrapping
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function acea_wc_checkout_order_details_wrapper_start() {

        ?>
				<div class="acea-wc-order-details-wrapp">

				<?php

    }
}
add_action( 'woocommerce_checkout_after_customer_details', 'acea_wc_checkout_order_details_wrapper_start', 40 );

if ( !function_exists( 'acea_wc_checkout_order_details_wrapper_end' ) ) {
    /**
     * related product wrapping
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function acea_wc_checkout_order_details_wrapper_end() {

        ?>
				</div>

			<?php

    }
}
add_action( 'woocommerce_review_order_before_payment', 'acea_wc_checkout_order_details_wrapper_end' );

/**
 * Woo Paginations..
 * @since 1.0.0
 */
add_filter( 'woocommerce_pagination_args', 'acea_woo_pagination' );
function acea_woo_pagination( $args ) {

    $args['prev_text'] = '<i class="fa fa-angle-left"></i>';
    $args['next_text'] = '<i class="fa fa-angle-right"></i>';

    return $args;
}

add_filter( 'woocommerce_default_address_fields', 'acea_override_address_fields' );
function acea_override_address_fields( $address_fields ) {
    $address_fields['first_name']['placeholder'] = 'i.e. John';
    $address_fields['last_name']['placeholder']  = 'i.e. Doe';
    $address_fields['address_1']['placeholder']  = 'i.e. 1336 Ross Street';
    $address_fields['state']['placeholder']      = 'i.e. Virginia';
    $address_fields['postcode']['placeholder']   = 'i.e. 20170';
    $address_fields['city']['placeholder']       = 'i.e. Collinsville';
    $address_fields['phone']['placeholder']      = 'i.e. 818-406-0507';
    $address_fields['email']['placeholder']      = 'i.e. john@email.com';
    return $address_fields;
}

add_filter( 'acea_page_title', 'acea_woo_title_order_received', 10, 2 );

function acea_woo_title_order_received( $title ) {
    if ( function_exists( 'is_order_received_page' ) && is_order_received_page() ) {
        $title = '<div class="acea-order-success-icon"><img src="' . get_theme_file_uri( '/assets/img/order-success.png' ) . '" alt="' . esc_attr__( 'order success', 'acea' ) . '" /></div>';
        $title .= "Order Successful";
        return $title;
    }
    return $title;
}

// Add a second password field to the checkout page in WC 3.x.
add_filter( 'woocommerce_checkout_fields', 'wc_add_confirm_password_checkout', 10, 1 );
function wc_add_confirm_password_checkout( $checkout_fields ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {
        $checkout_fields['account']['account_password2'] = array(
            'type'        => 'password',
            'label'       => __( 'Confirm password', 'acea' ),
            'required'    => true,
            'placeholder' => _x( 'Confirm Password', 'placeholder', 'acea' ),
        );
    }

    return $checkout_fields;
}

// Check the password and confirm password fields match before allow checkout to proceed.
add_action( 'woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2 );
function wc_check_confirm_password_matches_checkout( $posted ) {
    $checkout = WC()->checkout;
    if ( !is_user_logged_in() && ( $checkout->must_create_account || !empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_password2'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'acea' ), 'error' );
        }
    }
}

// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.
add_filter( 'woocommerce_registration_errors', 'registration_errors_validation', 10, 3 );
function registration_errors_validation( $reg_errors, $sanitized_user_login, $user_email ) {
    global $woocommerce;
    extract( $_POST );
    if ( strcmp( $password, $password2 ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'acea' ) );
    }
    if ( !isset( $_POST['terms'] ) ) {
        return new WP_Error( 'registration-error', __( 'Terms and condition are not checked!', 'acea' ) );
    }

    return $reg_errors;
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
    ?>
			<p class="form-row form-row-wide">
				<label for="reg_password2"><?php _e( 'Confirm Password', 'acea' );?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password2" placeholder="<?php echo esc_attr( "********" ) ?>" id="reg_password2" value="<?php if ( !empty( $_POST['password2'] ) ) {
        echo esc_attr( $_POST['password2'] );
    }
    ?>" />
			</p>
			<?php

    if ( wc_get_page_id( 'terms' ) > 0 ) {
        ?>
				<p class="form-row terms wc-terms-and-conditions">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
						<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true );?> id="terms" />
						<span><?php printf( __( 'I agree to the <a href="%s" target="_blank" class="woocommerce-terms-and-conditions-link">Terms & conditions</a>', 'acea' ), esc_url( wc_get_page_permalink( 'terms' ) ) );?></span>
					</label>
					<input type="hidden" name="terms-field" value="1" />
				</p>
		<?php
}
}

/**
 * Shop/archives: wrap the product image/thumbnail in a div.
 *
 * The product image itself is hooked in at priority 10 using woocommerce_template_loop_product_thumbnail(),
 * so priority 9 and 11 are used to open and close the div.
 */
add_action( 'woocommerce_before_shop_loop_item_title', function () {
    echo '<div class="product-thumb-wrapper">';
}, 9 );
add_action( 'woocommerce_before_shop_loop_item_title', function () {
    echo '</div>';
}, 11 );

add_filter( 'woocommerce_sale_flash', 'acea_custom_replace_sale_text' );
function acea_custom_replace_sale_text( $html ) {
    return str_replace( __( 'Sale!', 'acea' ), __( 'Sale', 'acea' ), $html );
}

/* Wishlist show on shop main page */

if ( defined( 'YITH_WCWL' ) && !function_exists( 'yith_wcwl_add_wishlist_to_loop' ) ) {
    function yith_wcwl_add_wishlist_to_loop() {
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
    add_action( 'woocommerce_after_shop_loop_item', 'yith_wcwl_add_wishlist_to_loop', 15 );
}

/* Discount offer shop main page */

add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {

    if ( $product->is_type( 'variable' ) ) {
        $percentages = array();
        $prices      = $product->get_variation_prices();
        foreach ( $prices['price'] as $key => $price ) {
            if ( $prices['regular_price'][$key] !== $price ) {
                $percentages[] = round( 100 - ( floatval( $prices['sale_price'][$key] ) / floatval( $prices['regular_price'][$key] ) * 100 ) );
            }
        }
        $percentage = max( $percentages ) . '%';
    } elseif ( $product->is_type( 'grouped' ) ) {
        $percentages  = array();
        $children_ids = $product->get_children();
        foreach ( $children_ids as $child_id ) {
            $child_product = wc_get_product( $child_id );

            $regular_price = (float) $child_product->get_regular_price();
            $sale_price    = (float) $child_product->get_sale_price();

            if ( $sale_price != 0 || !empty( $sale_price ) ) {
                $percentages[] = round( 100 - ( $sale_price / $regular_price * 100 ) );
            }
        }
        $percentage = max( $percentages ) . '%';
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        if ( $sale_price != 0 || !empty( $sale_price ) ) {
            $percentage = round( 100 - ( $sale_price / $regular_price * 100 ) ) . '%';
        } else {
            return $html;
        }
    }
    return '<span class="onsale">' . $percentage . ' ' . esc_html__( 'Off', 'acea' ) . '</span>';
}
