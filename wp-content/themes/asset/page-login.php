<?php
 /*
   Template Name: Login
 */
 ?>
<?php get_header(); ?>
<section class="nav-breadcrumbs clearfix">
	<div class="container">
		<div class="nav"><?php echo woocommerce_breadcrumb(); ?></div>
	</div>
</section>
<section class="clearfix">
	<div class="container">
	   <h1 class="page-title">Login or Create an Account </h1>
	  <div class="row">
		 <div class="col-md-6">
		 	<div class="box">
		 		<div class="box-header"><h3>New Customers</h3></div>
		 		<div class="box-content">
		 			<p>This is description</p>
		 			<a href="<?php echo HOME_URL ?>/register/" class="btn btn-primary">Create An Account</a>
		 		</div>
		 	</div>
		 </div>
		 <div class="col-md-6">
		 	<div class="box">
		 		<?php echo do_shortcode('[woocommerce_my_account]'); ?>
		 	</div>
		 </div>
	   </div>
    </div>
</section>
<?php get_footer(); ?>