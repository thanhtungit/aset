<?php 

function disable_dashboard_widgets() {  
    global $current_user;  
    get_currentuserinfo();

    if($current_user->user_level != 1){
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        //remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
        remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal');//since 3.8
        remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal');
        remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal');
    }
}  
add_action('admin_init', 'disable_dashboard_widgets',30);

function remove_menus()
{
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'plugins.php' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'edit-comments.php' ); 
    remove_menu_page( 'edit.php?post_type=acf-field-group' );
    remove_menu_page( 'itsec' );
    remove_menu_page( 'admin.php?page=wpcf-cpt' );
    remove_menu_page( 'wpcf-cpt' );
    remove_submenu_page( 'options-general.php', 'scporder-settings' );
    remove_submenu_page( 'options-general.php', 'tinymce-advanced' );
    remove_submenu_page( 'options-general.php', 'pagenavi' );
    remove_submenu_page( 'options-general.php', 'breadcrumb-navxt' );
    remove_submenu_page( 'gravityforms', 'gf_addons' );
    remove_submenu_page('options-general.php','options-permalink.php');
    remove_submenu_page('options-general.php','options-media.php');
    remove_submenu_page('options-general.php','options-discussion.php');
    remove_submenu_page('options-general.php','options-writing.php');
    remove_menu_page('ats-social-login');
} 
add_action( 'admin_menu', 'remove_menus',9999 );

add_action( 'admin_init', 'tk_remove_cpt_submenus' );
function tk_remove_cpt_submenus() 
{
   
    remove_submenu_page( 'woocommerce','dgwt_wcas_settings' );
    remove_submenu_page( 'woocommerce','br-product-filters' );
    remove_submenu_page( 'woocommerce','wc-status' );
    remove_submenu_page( 'woocommerce','wc-addons' );
}

add_action('admin_footer', 'my_admin_footer_function');
function my_admin_footer_function() {
   ?>
   <style>
     #toplevel_page_wpcf,
     #toplevel_page_themepunch-google-fonts,
     #toplevel_page_yit_plugin_panel,
     #toplevel_page_xoo_cp,
     #toplevel_page_dgwt_wcas_settings,
     #normal-sortables label.show_if_simple,
     #footer-left,
     #footer-upgrade,
     #wp-admin-bar-wp-logo,
     #wp-admin-bar-itsec_admin_bar_menu,
     .wpseo-tab-video-container,
     #toplevel_page_wpseo_dashboard,
     .wpseo-metabox-buy-premium,
     #pageanalysis,#_yst_is_cornerstone,
     #wpseo-focuskeyword-section label[for='_yst_is_cornerstone'],
     .wpseo-metabox-tab-content .wpseo-tab-add-keyword,
     .product_data_tabs .linked_product_options,
     .product_data_tabs .advanced_options,
     .product_data_tabs .shipping_options,
     #wp-admin-bar-wpseo-menu,
     #wpfooter,
     #toplevel_page_akeebabackupwp-akeebabackupwp{display:none !important;}
   </style>
   <?php 
}

function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');
/* hide supper admin */
add_action('pre_user_query','tk_pre_user_query');
function tk_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if ($user->ID!=1) {
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.ID<>1",$user_search->query_where);
  }
}
?>