<?php
include_once 'inc/register.php';
include_once 'inc/filter-woo.php';
//include_once 'payment/123PaymentGateway.php';
include_once 'payment/class-onepay.php';

//add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
//add_theme_support( 'wc-product-gallery-slider' );
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
remove_action('wp_head', 'wp_generator');
//add_action( 'admin_enqueue_scripts', 'rdsp_dequeue_script', 999 );
function rdsp_dequeue_script() {
     wp_dequeue_script( 'select2');
}
define('TEMPLATE_PATH',get_bloginfo('template_url'));
define('HOME_URL',get_home_url());
define('BlOG_NAME',get_bloginfo('blog_name'));
define('SLOGAN', get_bloginfo('description'));
define('VAT', 10);
register_nav_menu( 'primary', 'Top Menu' );
register_nav_menu( 'footer', 'Footter Menu' );

add_image_size( 'thumb-home',270,270,true);

function tk_add_scripts_styles(){
     wp_deregister_script('jquery');
     wp_enqueue_script('jquery',TEMPLATE_PATH.'/js/jquery-3.3.1.min.js');
     $vars = array(
         'SITE_URL'=> HOME_URL,
         'TEMPLATE_PATH'=> TEMPLATE_PATH,
         'CURRENCY_SYMBOL'=> get_woocommerce_currency_symbol(),
         'AJAX_URL'=> admin_url( 'admin-ajax.php' ),
         'SECURITY' => wp_create_nonce('ats-security-load')
      );

     if(is_user_logged_in()){
        $current_user = wp_get_current_user();
        $vars['UID'] = $current_user->ID;
     }
   
    wp_enqueue_script('tk-bootstrap-js',TEMPLATE_PATH.'/js/libs/bootstrap/bootstrap.min.js',array('jquery'));
    wp_enqueue_script('tk-slick-js',TEMPLATE_PATH.'/js/libs/slick.min.js',array('jquery'));
    wp_enqueue_script('tk-main-site',TEMPLATE_PATH.'/js/class.SiteMain.js',array('jquery'));
    wp_enqueue_script('tk-main',TEMPLATE_PATH.'/js/main.js',array('jquery','tk-main-site'));
    wp_enqueue_script('tk-validate',TEMPLATE_PATH.'/js/libs/jquery.validate.min.js',array('jquery','tk-main-site'));
    wp_localize_script('tk-main-vars','TK_VARS',$vars);
    wp_enqueue_style('tk-bootstrap', TEMPLATE_PATH . '/css/libs/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('tk-bootstrap-css', TEMPLATE_PATH . '/js/libs/font-awesome/css/font-awesome.min.css', array(), false, 'all');
    wp_enqueue_style('tk-main-css', TEMPLATE_PATH . '/css/all.css', array(), false, 'all');
    wp_enqueue_style('tk-style-css', TEMPLATE_PATH . '/css/style.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'tk_add_scripts_styles');

if( function_exists('acf_add_options_page') ) {

   acf_add_options_page(array(
    'page_title'  => 'Theme options',
    'menu_title' => 'Theme options',
    'menu_slug'  => 'theme-general-settings'
   ));

     acf_add_options_sub_page(array(
      'page_title'  => 'Footer',
      'menu_title' => 'Footer',
      'parent_slug' => 'theme-general-settings',
     ));
     //    acf_add_options_sub_page(array(
     //  'page_title'  => 'Contact',
     //  'menu_title' => 'Sale Products',
     //  'parent_slug' => 'theme-general-settings',
     // ));

}


function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


  function custom_excerpt_length( $length ) {
           return 10;
      }
 add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function my_login_logo() { ?>
    <style type="text/css">
        .wc-social-login{
            display:none !important;
        }
        #login h1 a {
            background-image: url("<?php
              echo TEMPLATE_PATH;
             ?>/images/logo.png") !important;
              width:112px;
              height:51px;
              background-size:100%;
              -webkit-background-size:100%;
        }
    </style>
<?php } ?>
<?php
add_action( 'login_enqueue_scripts', 'my_login_logo' );
 if(is_user_logged_in ()){
     global $current_user;
     get_currentuserinfo();
     if($current_user->ID != 1){
         include 'inc/remove.php';
     }
}

function tk_wp_select($field){
    echo '<select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '">';
    foreach ( $field['options'] as $key => $value ) {
        echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
    }
    echo '</select> ';
}

 function get_button_cart($product,$variation_id){
   echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" variation_id="%s">%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $class ) ? $class : 'btn-nod32' ),
            esc_attr( $variation_id ),
            esc_html( 'buy now' )
          );
 }


?>
