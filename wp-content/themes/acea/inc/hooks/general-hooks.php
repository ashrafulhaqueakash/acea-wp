<?php
/**
 * Page Start
 *
 * @since 1.0.0
 */
if (!function_exists('acea_page_wrap_start')) :
    function acea_page_wrap_start()
    {
        $page_attr = array(
            'class' => array('site', 'logisitco_page_wrap'),
            'id' => 'page'
        );
        $page_attr = apply_filters('acea_page_attr', $page_attr);
        echo '<div ' . acea_set_attributes($page_attr) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<a class="skip-link screen-reader-text" href="#content">' . esc_html__('Skip to content', 'acea') . '</a>';
    }
endif;
/**
 * Page End
 *
 * @since 1.0.0
 */
if (!function_exists('acea_page_wrap_end')) :
    function acea_page_wrap_end()
    {
        echo '</div><!-- #page -->';
    }
endif;
/**
 * Content wrap start
 *
 * @since 1.0.0
 */
if (!function_exists('acea_content_start')) :
    function acea_content_start()
    {
        echo '<div id="content" class="site-content">';
    }
endif;
/**
 * Content wrap end
 *
 * @since 1.0.0
 */
if (!function_exists('acea_content_end')) :
    function acea_content_end()
    {
        echo '</div><!-- #content -->';
    }
endif;
/**
 * Content wrap start
 *
 * @since 1.0.0
 */
if (!function_exists('acea_content_inner_start')) :
    function acea_content_inner_start()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;
        echo '<div class="container">';
        echo '<div class="row blog-content-row justify-content-center">';
    }
endif;
/**
 * Content wrap end
 *
 * @since 1.0.0
 */
if (!function_exists('acea_content_inner_end')) :
    function acea_content_inner_end()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;
        echo '</div> <!-- .container -->';
        echo '</div> <!-- .row -->';
    }
endif;
/**
 * Custom hooks functions are define about general section.
 *
 * @package Acea
 * @since 1.0.0
 */
/**
 * Header section wrap
 *
 * @since 1.0.0
 */
if (!function_exists('acea_header_wrap')) :
    function acea_header_wrap()
    {
?>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 d-flex align-items-center">
            <div class="site-branding">
                <?php acea_logo_wrap(); ?>
            </div><!-- .site-branding -->
            <button id="menu-toggle" class="menu-toggle"><?php _e('Menu', 'acea'); ?></button>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 d-flex align-items-center justify-content-end">
            <div class="acea-nav-wrap acea-nav-wrap-2 acea-nav-wrap-3 acea-nav-wrap-4">
                <div id="site-header-menu" class="site-header-menu">
                    <?php
                    $nav_attr = array(
                        'id' => 'site-navigation',
                        'class' => array(
                            'main-navigation',
                            'acea-menu',
                            'acea-menu-4',
                            'acea-responsive-menu',
                            'main-navigation'
                        ),
                        'aria-label' => esc_attr__('Top Menu', 'acea')
                    );
                    $nav_attr = apply_filters('acea_nav_attr', $nav_attr);
                    ?>
                    <nav <?php echo acea_set_attributes($nav_attr); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            ?>>
                        <?php do_action('acea_nav_before'); ?>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'main-menu',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ));
                        ?>
                        <?php do_action('acea_nav_after'); ?>
                    </nav><!-- #site-navigation -->
                    <button class="screen-reader-text acea-menu-close"><i class="ti-close"></i></button>
                </div>
            </div>
        </div> <!-- .col-lg-9 -->
        <?php
    }
endif;
/**
 * Header section start
 *
 * @since 1.0.0
 */
if (!function_exists('acea_header_start')) :
    function acea_header_start()
    {
        echo '<header id="masthead" class="site-header">';
        echo '<div class="container">';
        echo '<div class="row">';
    }
endif;
/**
 * Header section end
 *
 * @since 1.0.0
 */
if (!function_exists('acea_header_end')) :
    function acea_header_end()
    {
        echo '</div><!-- .row -->';
        echo '</div><!-- .container -->';
        echo '</header><!-- .side-header -->';
    }
endif;
/**
 * Header banner section start
 *
 * @since 1.0.0
 */
if (!function_exists('acea_banner_section_start')) :
    function acea_banner_section_start()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;
        global $aceaObj;
        $breadcrumb_attr = apply_filters('acea_breadcrumb_class', $aceaObj->acea_breadcrumb_bridge());
    }
endif;
/**
 * Header banner title
 *
 * @since 1.0.0
 */
if (!function_exists('acea_banner_title')) :
    function acea_banner_title()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;
        /* $breadcrumb = new Acea_BreadCrumb();
        echo wp_kses_post($breadcrumb->init()); */
    }
endif;
/**
 * Header banner section end
 *
 * @since 1.0.0
 */
if (!function_exists('acea_banner_section_end')) :
    function acea_banner_section_end()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer'))
            return;
    }
endif;


/**
 * Page Wrapper
 *
 * @since 1.0.0
 */
add_action('acea_before_page', 'acea_page_wrap_start');
add_action('acea_after_page', 'acea_page_wrap_end');
/**
 * Main content wrapper
 *
 * @since 1.0.0
 */
add_action('acea_content_start', 'acea_content_start', 10);
add_action('acea_content_start', 'acea_content_inner_start', 20);
add_action('acea_content_end', 'acea_content_inner_end', 10);
add_action('acea_content_end', 'acea_content_end', 20);
/**
 * Managed functions for Header section hooking
 *
 * @since 1.0.0
 */
add_action('acea_header_section', 'acea_header_settings', 10);
/**
 * Managed functions for top banner hook
 *
 * @since 1.0.0
 */
add_action('acea_banner_section', 'acea_banner_section_start', 10);
add_action('acea_banner_section', 'acea_banner_title', 20);
add_action('acea_banner_section', 'acea_banner_section_end', 30);
/**
 * Managed functions for footer area hook
 *
 * @since 1.0.0
 */
add_action('acea_footer_before', 'acea_footer_settings');