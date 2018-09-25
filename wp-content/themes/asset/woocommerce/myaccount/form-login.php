<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="col-12">
    <h1 class="title-woocommerce">Login or Create an Account </h1>
</div>

     <div class="col-md-6 float-left">
            <div class="box shadowBox">
                <div class="box-header"><h3>New Customers</h3></div>
                <div class="box-content">
                    <p>This is description</p>
                    <a href="<?php echo HOME_URL ?>/register/" class="btn-cart">Create An Account</a>
                </div>
            </div>
         </div>
    <div class="col-md-6 float-left">
            <div class="box shadowBox">
        <?php wc_print_notices(); ?>

        <?php do_action( 'woocommerce_before_customer_login_form' ); ?>

        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

        <div class="u-columns col2-set" id="customer_login">
        	<div class="u-column1 col-md-12 col-lg-6 float-left">

        <?php endif; ?>

        		<div class="formLogin">
                    <form class="woocommerce-form woocommerce-form-login login" method="post">
                        <div class="box-header">
                            <h3>Registered Customers</h3>
                        </div>

                        <div class="box-content">
                            <p>Already registered? Please log in below:</p>

                            <?php do_action( 'woocommerce_login_form_start' ); ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <span class="woocommerce-input-wrapper"><input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?></span>
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <span class="woocommerce-input-wrapper"><input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" /></span>
                            </p>

                            <?php do_action( 'woocommerce_login_form' ); ?>

                            <p class="woocommerce-LostPassword lost_password">
                                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                                <span class="notification">* Required Fields</span>
                            </p>

                            <p class="form-row form-row-btn form-row-wide">
                                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                <button type="submit" class="woocommerce-Button button btn-cart" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox d-inline">
                                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span class="d-inline"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                                </label>
                            </p>
                        </div>

                        <?php do_action( 'woocommerce_login_form_end' ); ?>

                    </form>
                </div>

        <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    </div>
</div>
