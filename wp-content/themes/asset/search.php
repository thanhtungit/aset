<?php get_header(); ?>
<section class="nav-breadcrumbs clearfix">
    <div class="container">
        <div class="nav"><nav class="woocommerce-breadcrumb"><a href="<?php echo HOME_URL;?>">Home</a>&nbsp;/&nbsp;<span>&nbsp;Search Results</span></nav></div>
    </div>
</section>
<section class="page home">
    <!--Tab products-->
    <div class="tab-products">
        <!--Controller-->
        <div class="container">
              <h1 class="search-title">Search Results for '<?php echo get_search_query(); ?>'</h1>
            <div class="row">
                <div class="col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content">
                    	<?php
                            if(have_posts()){
                                while (have_posts()) {
                                    the_post();
                                   wc_get_template_part( 'content', 'product' );
                                }
                            }
                         ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<?php get_footer(); ?>