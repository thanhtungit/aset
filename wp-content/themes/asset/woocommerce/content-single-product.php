<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
  
}
    global $product;
    $attributes = $product->get_available_variations();

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="col-md-8 float-left">
		<h1><?php echo woocommerce_template_single_title(); ?></h1>
		<div class="thumb">
			<?php  echo woocommerce_show_product_images() ?>
		</div>
		<div class="content">
			<?php echo the_content(); ?>
		</div>
	</div>
	<div class="col-md-4 float-left">
		<div class="col-price float-left">
    	<?php
    	    foreach ($attributes as $key => $attribute) {
    		  $name_variation = get_term_by('slug',$attribute['attributes']['attribute_pa_years'],'pa_years');
    		 ?>
    		 
    	   <form method="post" action="">
		        <div class="col-price-left">
		        	<p>
		        	  <?php echo ($name_variation) ? $name_variation->name:'No Title'; ?>	
		        	</p>
		            <?php echo $attribute['price_html']; ?>
		            <button type="submit" class="add_to_cart_button btn-nod32" style="border:0;cursor:pointer;">buy now</button>
		           
		            <a href="#">Free trail</a>
		        </div>
		        <input type="hidden" name="quantity" value="1" min="1" max="1"/>
		        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
				<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
				<input type="hidden" name="variation_id" class="variation_id" value="<?php echo $attribute['variation_id']; ?>" />
			</form>
        <?php } ?>
        </div>
	</div>
</div>
<section class="award">
	<div class="container">
		<div class="row">
			Vào trong thư mực woocommerce/single-product/content-single-product.php để thêm phần nội dung này
		</div>
	</div>
</section>
