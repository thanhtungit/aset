<?php
 /*
   Template Name: Contact
 */
 ?>
<?php get_header(); ?>
<section class="nav-breadcrumbs clearfix">
	<div class="container">
		<div class="nav"><?php echo woocommerce_breadcrumb(); ?></div>
	</div>
</section>
<section class="clearfix page-contact">
	<div class="container">
	   <h1 class="title-woocommerce"><?php the_title() ?></h1>
	   <div class="row">
	   	   <div class="col-md-12">
	   	   	   <?php
       		 if(have_posts()){
	        	 		the_post();
	        	 		the_content();
       				 }
		 		?>
	   	   </div>
	   </div>
	  <div class="row">
		 <div class="col-md-4 float-left">
		 	
		 </div>
		 <div class="col-md-8 float-left">
		 	<?php echo do_shortcode('[contact-form-7 id="63" title="Contact form 1"]'); ?>
		 </div>
	   </div>
    </div>
</section>
<?php get_footer(); ?>
