<?php get_header(); ?>
<section class="nav-breadcrumbs clearfix">
	<div class="container">
		<div class="nav"><?php echo woocommerce_breadcrumb(); ?></div>
	</div>
</section>
<section class="clearfix">
	<div class="container">
		 <div class="row">
		<?php
        if(have_posts()){
        	 the_post();
        	 the_content();
        }
	 ?>
	    </div>
    </div>

</section>
<?php get_footer(); ?>