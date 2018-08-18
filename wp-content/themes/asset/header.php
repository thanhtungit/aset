<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo TEMPLATE_PATH; ?>/assets/images/logo.png">
    <title><?php echo BlOG_NAME; ?><?php wp_title("-",true); ?></title>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1">
                <a href="<?php echo HOME_URL; ?>"><img src="<?php echo TEMPLATE_PATH ?>/images/logo.png" alt=""></a>
            </div>
            <div class="col-md-5">
                <ul class="menu-main">
                    <li class="has-children"><a href="">for home</a></li>
                    <li><a href="">contact us</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="fRight">
                    <div class="search-icon rCommon">
                        <img src="<?php echo TEMPLATE_PATH ?>/images/magnifying_glass.png" alt="">
                        <span>Search</span>
                    </div>
                    <div class="menu-icon rCommon">
                        <img src="<?php echo TEMPLATE_PATH ?>/images/Monotone.png" alt="">
                        <span>Menu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="nav-right">
    <div class="row-search">
        <div class="input">
            <input type="text" class="form-control" placeholder="Products, Download, Trial">
            <img src="<?php echo TEMPLATE_PATH ?>/images/icon - close.png" alt="" class="icon-close-menu">
        </div>
    </div>
    
    <?php
       wp_nav_menu( array(
            'theme_location' =>'primary',
             'container'=>'',
             'menu'=>'',
            'items_wrap'=>'<ul id="%1$s" class="%2$s row-item">%3$s</ul>'
        ) );
  ?>
</div>