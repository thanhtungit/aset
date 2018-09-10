<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class('product-item clearfix'); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	
	?>
	 <div class="col-img float-left">
          <?php echo woocommerce_template_loop_product_thumbnail(); ?>
         <a href="<?php echo HOME_URL; ?>/compare-product/">Compare Products</a>
        
    </div>
    <div class="col-content float-left">
        <a href="<?php echo get_permalink($product->id); ?>"><h4><?php echo $product->get_title(); ?></h4> </a>
        <?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ); ?>
    </div>
    <?php 
      $attributes = $product->get_available_variations();
	  if($attributes){
	  		 $fclass = (count($attributes) > 1) ? 'col-price-left' :'col-price-right';
       ?>
    <div class="col-price float-left">
    	<?php
    	    foreach ($attributes as $key => $attribute) {
    		  $name_variation = get_term_by('slug',$attribute['attributes']['attribute_pa_years'],'pa_years');
    		 ?>
    		 
    	   <form method="post" action="">
		        <div class="<?php echo $fclass; ?>">
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
	<?php
      }

	 // woocommerce_template_loop_add_to_cart();
	//do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>
