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
       <div class="row mb-8">
 		 <div class="col-md-10 float-left" style="min-height: 350px;">
             <div class="box-content">
                 <p>Chúng tôi đang bán phần mềm  chống vi-rút cho máy tính, máy tính xách tay và điện thoại thông minh. cung cấp bảo vệ chống vi rút đẳng cấp thế giới, chúng tôi bán các phần mềm bảo mật cho phép các doanh nghiệp và người tiêu dùng ở hơn 200 quốc gia tận dụng tối đa thế giới kỹ thuật số mà không sợ vi-rút, phần mềm độc hại hoặc bất kỳ mối đe dọa nào
                 </p>
             </div>
 		 </div>
 	   </div>
    </div>
</section>
<?php get_footer(); ?>
