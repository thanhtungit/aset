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
<section class="clearfix loginPage">
	<div class="container">
	   <h1 class="title-woocommerce">Login or Create an Account </h1>
	  <div class="row">
		 <div class="col-md-6">
		 	<div class="box shadowBox">
		 		<div class="box-header"><h3>New Customers</h3></div>
		 		<div class="box-content">
		 			<p>This is description</p>
		 			<a href="<?php echo HOME_URL ?>/register/" class="btn-cart">Create An Account</a>
		 		</div>
		 	</div>
		 </div>
		 <div class="col-md-6">
		 	<div class="box shadowBox">
		 		<?php echo do_shortcode('[woocommerce_my_account]'); ?>
		 	</div>
		 </div>
	   </div>
    </div>
</section>
<?php get_footer(); ?>
