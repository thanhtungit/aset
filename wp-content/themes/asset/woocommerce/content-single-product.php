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

<section class="product-item container">
    <div class="row">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
            <div class="col-12">
                <h1><?php echo woocommerce_template_single_title(); ?></h1>
            </div>
            <div class="col-lg-2 float-left col-img col-md-3 col-xs-4 col-sm-4 float-sm-none col-4 float-none">
                <?php  echo woocommerce_show_product_images() ?>
            </div>
            <div class="col-lg-10 offset-lg-2 col-md-9 offset-md-3 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-lg-7">
                        <?php echo the_content(); ?>
                    </div>
                    <div class="col-lg-5 col-md-9 group-buy">
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

                                        <a href="#">Free trial</a>
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
            </div>
        </div>
    </div>
</section>
<section class="award">
	<div class="container">
		<div class="row">
			<div class="col-12">
                <h3>Award-winning<br/> antivirus for Windows</h3>
                <img src="<?php echo TEMPLATE_PATH ?>/images/logo_3.png" alt="">
                <p>Essential defense against malware, built on ESET's trademark<br/> best balance of detection, speed and usability.</p>
            </div>
		</div>
	</div>
</section>
<section class="rate">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xs-12">
                <p>Built on record-breaking anti-malware technology</p>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
                <p>Built on record-breaking anti-malware technology</p>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
                <p>Built on record-breaking anti-malware technology</p>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
                <div class="star">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-half" aria-hidden="true"></i>
                </div>
                <span>4.5/5 on amazon.com</span>
            </div>
        </div>
    </div>
</section>
<section class="safer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>A safer internet for you to enjoy</h3>
                <p>Enjoy the internet, protected by the legendary ESET NOD32 Antivirus – for more than two decades, the<br/> favorite antimalware solution of IT experts and gamers</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-xs-12 box-item">
                <div class="box-item-inner">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/Group.png" alt="">
                    <h5>Enjoy a safer internet</h5>
                    <p>ESET NOD32 Antivirus reinforces its cutting-edge protection with Script-Based Attack Protection</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 box-item">
                <div class="box-item-inner">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/verified_user.png" alt="">
                    <h5>No more antivirus slowdowns</h5>
                    <p>Your computer performing at its best, with our super-efficient and fast antivirus</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 box-item">
                <div class="box-item-inner">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/game.png" alt="">
                    <h5>Enjoy gaming and viewing</h5>
                    <p>Play games and watch shows uninterrupted, with our special Gamer Mode</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 box-item">
                <div class="box-item-inner">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/money.png" alt="">
                    <h5>Stay safe from ransomware</h5>
                    <p>Blocks malware that tries to lock you out of your personal data and then asks you to pay a 'ransom' to unlock it</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 box-item">
                <div class="box-item-inner">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/magic.png" alt="">
                    <h5>Easy to use</h5>
                    <p>Enjoy optimized protection out of the box, or tweak your security with 150+ detailed settings</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 box-item">
                <div class="box-item-inner">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/phone.png" alt="">
                    <h5>Help when you need it</h5>
                    <p>Comes with free, industry-leading customer support, supplied locally in your language</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="slider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>See ESET security in action</h5>
                <div class="slick-slider">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/pJwAZ93Hyyc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/pJwAZ93Hyyc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="technical">
    <h3>Cutting-edge detection technology for your protection</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="box-item">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/tech_2.png" alt="">
                    <h5>Exploit Blocker</h5>
                    <p>Blocks attacks specifically designed to evade antivirus detection. Protects against attacks on web browsers, PDF readers and other applications, including Java-based software.</p>
                    <a href="">Learn more</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-item">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/tech_3.png" alt="">
                    <h5>ESET DNA Detections</h5>
                    <p>Makes it possible to detect thousands of related malware variants, including new or previously unknown ones.</p>
                    <a href="">Learn more</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-item">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/tech_1.png" alt="">
                    <h5>Script-Based Attack Protection NEW</h5>
                    <p>Detects malicious JavaScripts that can attack via your browser, and attacks by malicious scripts that try to exploit Windows PowerShell.</p>
                </div>
            </div>
        </div>
        <div class="row more_info">
            <div class="col-md-6">
                <h5>More info</h5>
                <ul class="list-unstyled d-inline">
                    <li><a href="">Product overview (PDF)</a></li>
                    <li><a href="">Compare Windows products</a></li>
                    <li><a href="">Windows 10 compatibility information</a></li>
                    <li><a href="">Convert your Username & Password to a License Key</a></li>
                    <li><a href="">ESET Unilicense</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>System requirements</h5>
                <p>ESET NOD32 Antivirus runs on any system with Microsoft® Windows® 10, 8.1, 8, 7, Vista, and Microsoft Windows Home Server 2011. Product requires an internet connection.</p>
            </div>
        </div>
    </div>
</section>
