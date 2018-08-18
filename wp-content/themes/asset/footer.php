 <section class="page home brands">
 	 <!--Brand-->
    <div class="brand">
        <h3 class="text-center">Brand Values</h3>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/brand_1.png" alt="">
                    <p>Courage</p>
                    <p>We don’t take the easy way. We constantly push boundaries and are determined to make a difference.</p>
                </div>
                <div class="col-md-3">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/integrity.png" alt="">
                    <p>Integrity</p>
                    <p>We encourage honesty and fairness in everything we do. We have an ethical approach to business.</p>
                </div>
                <div class="col-md-3">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/reliability.png" alt="">
                    <p>Reliability</p>
                    <p>People need to know they can count on us. We work hard to live up to our promises, and to build trust and rapport.</p>
                </div>
                <div class="col-md-3">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/brand_1.png" alt="">
                    <p>Passion</p>
                    <p>We’re passionate, driven and determined to make difference. We believe in ourselves and what we do.</p>
                </div>
            </div>
        </div>
    </div>
    <!--About-->
    <div class="about">
        <h3 class="text-center">Interesting facts about ESET</h3>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/Bitmap.png" alt="">
                    <p>ESET makes the only product to ever pass the magical threshold of 100 VB100 Awards by Virus Bulletin.</p>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/10101010.png" alt="">
                    <p>The first virus discovered by ESET's founders Peter Paško and Miroslav Trnka in 1987 was dubbed "Vienna".</p>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/egyptian.png" alt="">
                    <p>The company was named after the ancient Egyptian goddess and magical healer Eset.</p>
                </div>
            </div>
        </div>
    </div>
 </section>
 <footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 colFirst">
                <div class="company_logo">
                    <img src="<?php echo TEMPLATE_PATH ?>/images/logo_company.png" alt="">
                    <span>Company logo</span>
                </div>
                <img class="img-2" src="<?php echo TEMPLATE_PATH ?>/images/logo_2.png" alt="">
            </div>
            <div class="col-md-9">
                <?php
                       wp_nav_menu( array(
                            'theme_location' =>'primary',
                             'container'=>'',
                             'menu'=>'',
                            'items_wrap'=>'<ul id="%1$s" class="%2$s nav-footer">%3$s</ul>'
                        ) );
                      ?>
                <p>© 1992 - 2014 ESET, spol. s r.o. - All rights reserved. Trademarks used therein are trademarks or registered trademarks of ESET, spol. s r.o. or ESET North America. All other names and brands are registered trademarks of their respective companies.</p>
            </div>
        </div>
    </div>
</footer>
 <?php wp_footer(); ?>
 </body>
</html>