<?php get_header(); ?>
<section class="nav-breadcrumbs clearfix">
	<div class="container">
		<div class="nav"><?php echo woocommerce_breadcrumb(); ?></div>
	</div>
</section>
<section class="clearfix pageCompare">
	<div class="container">
		 <div class="row">
			 <div class="col-md-12">
				 <h1 class="title-woocommerce">Compare ESET's products</h1>
			 </div>
	   </div>
    </div>
		<div class="container-fluid nav-controller">
			<div class="container">
				<div class="row">
					<div class="col-12 colScroll">
						<?php
              $cat_args = array(
                  'hide_empty' => $false,
              );
                        $product_cats = get_terms( 'product_cat', $cat_args);
                        $tab_products = '';
                         if($product_cats){  ?>
                          <ul class="nav nav-tabs">
                            <?php foreach ($product_cats as $key => $cat) {
                                   $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                       $image = wp_get_attachment_url( $thumbnail_id );
                       $active = ($key == 0) ? ' active':'';
                       $tab_products .='<div id="'.$cat->slug.'" class="container tab-pane '.$active.'">';
                                        // $tab_products .= do_shortcode('[products limit="-1" columns="1" category="'.$cat->slug.'" ]');
                                      $products  = wc_get_products(array('category'=>array($cat->slug))); 
                                      $active = ($key == 0) ? 'active':'';
                                      if($products){
                                         $list .='<div class="tab-pane container '.$active.'" id="'.$cat->slug.'">';
                                        $list .='<div class="ListImage d-table"><div class="col1 colImage colImageFirst"><h5></h5></div>';
                                        $buy ='<div class="ListImage d-table mt-4 ListBtn"><div class="col1 colImage colImageFirst">
                                          <h5></h5>
                                        </div>';
                                         foreach ($products as $product) {
                                            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'thumbnail');

                                            $list .='<div class="colImage">
                                                 <img src="'.$thumbnail[0].'">
                                                  <span>'.$product->get_title().'</span>
                                                </div>
                                                ';
                                              $buy .='
                                  <div class="col2 colImage">
                                    <span>Award-winning antivirus<br/> for Windows</span>
                                    <div class="group-btn">
                                    <form method="post" action="">
                                      <button type="submit" class="woocommerce-Button button btn-cart btn-green">Buy now</button>
                                      <a href="#">Free trial</a>
                                       <input type="hidden" name="quantity" value="1" min="1" max="1"/>
            <input type="hidden" name="add-to-cart" value="'.absint( $product->get_id() ).'" />
        <input type="hidden" name="product_id" value="'.absint( $product->get_id() ).'" />
                                    </form>
                                    </div>
                                  </div>';
                 
                                         }
                   $buy .='</div>';
                   $list .='</div>';
                   $list .='<div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Free Support in Local Language</p>
            </div>
            <div class="col2 colImage">
              <span>✓</span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Banking and Payment Protection</p>
            </div>
            <div class="col2 colImage">
              <span>✓</span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Personal Firewall</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Antispam</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Network Attack Protection</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Botnet Protection</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Parental Control</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Webcam Protection</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Home Network Protection</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Anti-Theft</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Password Manager</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Secure Data</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Protection for Mobiles and Tablets</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Protection for Mac and Linux</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
          <div class="ListImage ListContent d-table">
            <div class="col1 colImage colImageFirst">
              <p>Multi-Device protection</p>
            </div>
            <div class="col2 colImage">
              <span></span>
            </div>
            <div class="col3 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span></span>
            </div>
            <div class="col4 colImage">
              <span>✓</span>
            </div>
          </div>
         ';
                   $list .= $buy;
                   $list .='</div>';

                                        
                                       }else{
                                          $list .='<div class="tab-pane container" id="'.$cat->slug.'">Updating</div>';
                                       }

                                      
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
		<div class="container mb-5">
			<div class="row">
				<div class="tab-content col-12 colScroll">
				  <?php echo $list; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
