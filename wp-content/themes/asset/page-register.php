<?php
 /*
   Template Name: Register
 */
 ?>
<?php get_header(); ?>
<section class="nav-breadcrumbs clearfix">
	<div class="container">
		<div class="nav"><?php echo woocommerce_breadcrumb(); ?></div>
	</div>
</section>
<section class="clearfix page-register">
	<div class="container">
	   <h1 class="title-woocommerce">Create an Account </h1>
	  <div class="row">
		 <div class="col-lg-8 col-md-12 col-12">
		 	<?php
		 	   wc_print_notices();
		 	?>
		 	<div class="row">
                <form method="post" class="woocommerce-form woocommerce-form-register register" id="formRegister">
                    <h2 class="title-small col-12">Personal Information</h2>
                    <?php do_action( 'woocommerce_register_form_start' ); ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first col-md-6 float-left m-0 pb-3">
                        <label for="reg_firstname"><?php esc_html_e( 'First Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <span class="woocommerce-input-wrapper"><input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="firstname" id="reg_firstname" autocomplete="firstname" value="<?php echo ( ! empty( $_POST['firstname'] ) ) ? esc_attr( wp_unslash( $_POST['firstname'] ) ) : ''; ?>" /></span>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last col-md-6 float-left m-0 pb-3">
                        <label for="reg_lastname"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <span class="woocommerce-input-wrapper"><input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="lastname" id="reg_lastname" autocomplete="lastname" value="<?php echo ( ! empty( $_POST['lastname'] ) ) ? esc_attr( wp_unslash( $_POST['lastname'] ) ) : ''; ?>" /></span>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide col-md-12 m-0">
                        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <span class="woocommerce-input-wrapper"><input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /></span>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide col-md-12 m-0 form-row-btn pt-3">
                        <label for="reg_sub" class="woocommerce-form__label woocommerce-form__label-for-checkbox inline ml-0">
                            <input type="checkbox" class="woocommerce-Input woocommerce-Input--text input-text" name="reg_sub" id="reg_sub" autocomplete="reg_sub" value="<?php echo ( ! empty( $_POST['reg_sub'] ) ) ? esc_attr( wp_unslash( $_POST['reg_sub'] ) ) : ''; ?>" /></span>
                            <span class="d-inline"><?php esc_html_e( 'Sign Up for Newsletter', 'woocommerce' ); ?></span>
                        </label>
                    </p>
                    <h2 class="title-small pl">Login Information</h2>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first col-md-6 float-left m-0 pb-3">
                        <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <span class="woocommerce-input-wrapper"><input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" /></span>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last col-md-6 m-0 pb-3">
                        <label for="reg_password"><?php esc_html_e( 'Confirm Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <span class="woocommerce-input-wrapper"><input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="repassword" id="reg_repassword" autocomplete="re-password" /></span>
                    </p>
                    <p class="txt-required pl pt-0">* Required Fields</p>

                    <p class="woocommerce-FormRow form-row m-0 group-btn">
                        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                        <a class="button alt" href="javascript:history.back()" title="back">Back</a>
                        <button type="submit" class="woocommerce-Button button btn-cart" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                    </p>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>

                </form>
            </div>
		 </div>
	   </div>
    </div>
</section>
<?php get_footer(); ?>
