<?php
global $acea;
$has_site_logo =   (!empty(acea_get_site_logo())) ? 'has-site-logo' : '';
?>
<header class="acea-header-area header-style-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="acea-header-wrap">
                    <div class="site-branding <?php echo esc_attr($has_site_logo)  ?>">
                        <a href="<?php echo esc_url(home_url()) ?>">
                            <?php
                            printf("%s", acea_get_site_logo());
                            ?>
                        </a>
                    </div><!-- .site-branding -->
                    <div class="acea-menu-wrap">
                        <div class="acea-main-menu-wrap navbar menu-style-inline justify-content-end">
                            <button class="navbar-toggler open-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" height="384pt" viewBox="0 -53 384 384" width="384pt"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path></svg></span>
                            </button>
                            <!-- end of Nav toggler -->
                            <div class="navbar-inner">
                                <div class="acea-mobile-menu"></div>
                                <div class="mobile-menu-logo">
                                    <span><?php echo esc_html__( 'menu', 'acea') ?></span>
                                </div>
                                <button class="navbar-toggler close-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" height="329pt" viewBox="0 0 329.26933 329" width="329pt"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"></path></svg></span>
                                </button>
                                <nav id="site-navigation" class="main-navigation ">
                                    <?php
                                    if (has_nav_menu('main-menu')) {
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'main-menu',
                                                'menu_class' => 'navbar-nav',
                                                'menu_id' => 'navbar-nav',
                                                'container_class' => 'acea-menu-container'
                                            )
                                        );
                                    }
                                    ?>
                                </nav><!-- #site-navigation -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>