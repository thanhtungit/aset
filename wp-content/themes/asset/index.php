<?php get_header(); ?>
<section class="page home">
    <!--banner-->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h1 class="text-right text-md-center">Find ESET Products That Suit Your Needs</h1>
                    <a href="" class="btn-nod32 m-md-auto">find out more</a>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/EAV_Atlas_Balanced_Box_CMYK.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!--Tab products-->
    <div class="tab-products">
        <!--Controller-->
        <div class="tab-control">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="scroll-tab">
                    	<?php
							$cat_args = array(
							    'hide_empty' => $false,
							);
                    		$product_cats = get_terms( 'product_cat', $cat_args);
                    		$tab_products = '';
                    		 if($product_cats){	 ?>
	                        <ul class="nav nav-tabs">
	                        	<?php foreach ($product_cats as $key => $cat) {
	                        		     $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	   									 $image = wp_get_attachment_url( $thumbnail_id );
	   									 $active = ($key == 0) ? ' active':'';
	   									 $tab_products .='<div id="'.$cat->slug.'" class="container tab-pane '.$active.'">';
                                         $tab_products .= do_shortcode('[products limit="-1" columns="1" category="'.$cat->slug.'" ]');
                                         $tab_products .='</div>';
                                       
	                        		?>
		                            <li class="nav-item">
		                                <a class="nav-link <?php echo ($key == 0) ? 'active':''; ?>" data-toggle="tab" href="#<?php echo $cat->slug ?>">
		                                    <img src="<?php echo $image ?>" alt="<?php echo $cat->name; ?>">
		                                    <p><?php echo $cat->name; ?></p>
		                                </a>
		                            </li>
	                           <?php } ?>
	                        </ul>
	                       <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<?php echo $tab_products; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<?php get_footer(); ?>