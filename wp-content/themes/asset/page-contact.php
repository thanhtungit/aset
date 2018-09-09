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
	   <div class="row row-maps">
	   	   <div class="col-md-12">
	   	   	   <?php
       		 if(have_posts()){
	        	 		the_post();
	        	 		the_content();
       				 }
		 		?>
	   	   </div>
	   </div>
	  <div class="row mb-4">
		 <div class="col-md-4 float-left">
            <div class="box-content">
                <h5 class="title-small">Vietnam Office</h5>
                <p><strong>Esetvin Vietnam</strong><br/>
                    <strong>Address:</strong> 3rd Floor, Khai Hoan building, 83B Hoang Sa Street, Da Kao Ward, Dist 1, Ho Chi Minh City, Vietnam<br/>
                    <strong>Tel:</strong> +84 8 39111248 , +84 8 39111247
                </p>
            </div>
             <div class="box-content">
                 <h5 class="title-small">Enquiry</h5>
                 <p><strong>Sales Email:</strong><a href="mailto: sales@esetvin.com"> sales@esetvin.com</a><br/>
                     <strong>Web:</strong><a href="http://www.esetvin.com" target="_blank"> http://www.esetvin.com</a><br/>
                 </p>
             </div>
             <div class="box-content">
                 <h5 class="title-small">Online Support</h5>
                 <p><a href="">Online Knowledgebase  (ENG)</a>
                 </p>
             </div>
             <div class="box-content">
                 <h5 class="title-small">Technical Support</h5>
                 <p><strong>Email:</strong><a href="mailto: support@esetvin.com"> support@esetvin.com</a> or<br/>
                     <strong>Support Tel:</strong>+84 8 39 111248, +84 8 39 111247 9:00am-6:00pm<br/>
                     (Monday - Friday except Saturday, Sunday and Public Holidays)
                 </p>
             </div>
		 </div>
		 <div class="col-md-8 float-left">
		 	<?php echo do_shortcode('[contact-form-7 id="63" title="Contact form 1"]'); ?>
		 </div>
	   </div>
    </div>
</section>
<?php get_footer(); ?>
