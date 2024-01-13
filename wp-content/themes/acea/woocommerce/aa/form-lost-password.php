<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<p class="woocommerce-lost-password-message"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Enter your email to get reset link', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	
	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label for="user_login"><?php esc_html_e( 'Email', 'woocommerce' ); ?></label>
		<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php esc_html_e('i.e. john@mail.com', 'woocommerce')?>" type="text" name="user_login" id="user_login" autocomplete="username" />
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Send Reset Link', 'woocommerce' ); ?>"><?php esc_html_e( 'Send Reset Link', 'woocommerce' ); ?></button>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
<?php

    $login_page_link = get_page_by_path( 'login') != null ? get_the_permalink( get_page_by_path( 'login')) : get_permalink( get_option('woocommerce_myaccount_page_id') );
?>
<p class="woocommerce-back-to-login-message"><?php echo apply_filters( 'stor_lost_pass_back_to_login_message', sprintf('<a href="%s">%s</a>', $login_page_link, __('Rememered the password? Sign in now', 'woocommerce') ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
<?php
do_action( 'woocommerce_after_lost_password_form' );
