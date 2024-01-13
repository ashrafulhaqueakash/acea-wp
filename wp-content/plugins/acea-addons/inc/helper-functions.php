<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('acea_get_meta')) {
    function acea_get_meta($data)
    {
        global $wp_embed;
        $content = $wp_embed->autoembed($data);
        $content = $wp_embed->run_shortcode($content);
        $content = do_shortcode($content);
        $content = wpautop($content);
        return $content;
    }
}
if (!function_exists('acea_cpt_slug_and_id')) {
    function acea_cpt_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $cpt_posts = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
}
if (!function_exists('acea_cpt_taxonomy_slug_and_name')) {
    function acea_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
    {
        $taxonomyies = get_terms($taxonomy_name);
        if (true == $option_tag) {
            $cpt_terms = '';
            foreach ($taxonomyies as $category) {
                if (isset($category->slug) && isset($category->name)) {
                    $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
                }
            }
            return $cpt_terms;
        }
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms[$category->slug] = $category->name;
            }
        }
        return $cpt_terms;
    }
}
function acea_cpt_author_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $author_meta = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
    endwhile;
    wp_reset_postdata();
    return array_unique($author_meta);
}
function acea_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
{
    $taxonomyies = get_terms($taxonomy_name);
    if (true == $option_tag) {
        $cpt_terms = '';
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
            }
        }
        return $cpt_terms;
    }
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        if (isset($category->slug) && isset($category->name)) {
            $cpt_terms[$category->slug] = $category->name;
        }
    }
    return $cpt_terms;
}
function acea_cpt_taxonomy_id_and_name($taxonomy_name)
{
    $taxonomyies = get_terms($taxonomy_name);
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        $cpt_terms[$category->term_id] = $category->name;
    }
    return $cpt_terms;
}
function acea_cpt_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $cpt_posts = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}
function acea_get_meta_field_keys($post_type, $field_name, $fild_type = "choices")
{
    $the_query = new WP_Query(array(
        'posts_per_page' => 1,
        'post_type' => $post_type,
    ));
    $field_object = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $field_object = isset(get_field_object($field_name)[$fild_type]) ? get_field_object($field_name)[$fild_type] : false;
    endwhile;
    return $field_object;
    wp_reset_postdata();
}
/**
 * Checking post type enable or disabled
 */
function acea_check_cpt($opt_id)
{
    $acea = get_option('acea');
    if (isset($acea[$opt_id])) {
        if (true == $acea[$opt_id]) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}
/**
 * Post orderby list
 */
function acea_get_post_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    $orderby = apply_filters('acea_post_orderby', $orderby);
    return $orderby;
}
/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('acea_get_all_posts')) {
    function acea_get_all_posts($posttype)
    {
        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $post_list = array();
        if ($data = get_posts($args)) {
            foreach ($data as $key) {
                $post_list[$key->ID] = $key->post_title;
            }
        }
        return  $post_list;
    }
}
/* Acea contact form 7 */
if (!function_exists('acea_addons_is_cf7_activated')) {
    function acea_addons_is_cf7_activated()
    {
        return class_exists('WPCF7');
    }
}
if (!function_exists('acea_addons_get_cf7_forms')) {
    function acea_addons_get_cf7_forms()
    {
        $forms = get_posts([
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ]);
        if (!empty($forms)) {
            return wp_list_pluck($forms, 'post_title', 'ID');
        }
        return [];
    }
}
if (!function_exists('acea_addons_do_shortcode')) {
    function acea_addons_do_shortcode($tag, array $atts = array(), $content = null)
    {
        global $shortcode_tags;
        if (!isset($shortcode_tags[$tag])) {
            return false;
        }
        return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
    }
}
/* Acea Blog Post widget */
function acea_get_current_user_display_name()
{
    $user = wp_get_current_user();
    $name = 'user';
    if ($user->exists() && $user->display_name) {
        $name = $user->display_name;
    }
    return $name;
}
function acea_addons_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
{
    $taxonomyies = get_terms($taxonomy_name);
    if (true == $option_tag) {
        $cpt_terms = '';
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' . $category->name . '</option>';
            }
        }
        return $cpt_terms;
    }
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        if (isset($category->slug) && isset($category->name)) {
            $cpt_terms[$category->slug] = $category->name;
        }
    }
    return $cpt_terms;
}
function acea_addons_cpt_author_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ));
    $author_meta = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
    endwhile;
    wp_reset_postdata();
    return array_unique($author_meta);
}
function acea_addons_cpt_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type'      => $post_type,
    ));
    $cpt_posts = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}
if (!function_exists('acea_addons_comment_count')) :
    /**
     * Comment count
     */
    function acea_addons_comment_count($clabel = 'Comment', $icon = '')
    {
        if (post_password_required() || !(comments_open() || get_comments_number())) {
            return;
        }
        ob_start();
?>
        <span class="acea-addons-comment">
            <a href="<?php comments_link(); ?>">
                <span><?php echo $icon ?> <?php comments_number('0', '1', '%'); ?> <?php echo $clabel ?></span>
            </a>
        </span>
<?php
        return ob_get_clean();
    }
endif;
if (!function_exists('acea_addons_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function acea_addons_posted_by($label = 'by')
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('%s', 'post author', 'acea-addons'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );
        '<span class="byline"> ' . $label . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;
if (!function_exists('acea_addons_posted_date')) :
    /**
     * Prints HTML with meta information for the current date.
     */
    function acea_addons_posted_date($icon = '')
    {
        $date_html = sprintf('<span class="post-date"> %s %s</span>', $icon, get_the_date());
        return $date_html;
    }
endif;
if (!function_exists('acea_addons_posted_category')) :
    /**
     * Prints HTML with meta information for the current date.
     */
    function acea_addons_posted_category($icon = '')
    {
        $post_cat = get_the_terms(get_the_ID(), 'category');
        $post_cat = join(', ', wp_list_pluck($post_cat, 'name'));
        $post_category = sprintf('<span class="category-list"> %s %s</span>', $icon, $post_cat);
        return $post_category;
    }
endif;
if (!function_exists('acea_cpt_slug_and_id')) :
    function acea_cpt_slug_and_id($post_type)
    {
        $the_query = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));
        $cpt_posts = [];
        while ($the_query->have_posts()) : $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
endif;
if (!function_exists('acea_cpt_taxonomy_slug_and_name')) :
    function acea_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
    {
        $taxonomyies = get_terms($taxonomy_name);
        if (true == $option_tag) {
            $cpt_terms = '';
            foreach ($taxonomyies as $category) {
                if (isset($category->slug) && isset($category->name)) {
                    $cpt_terms .= '<option value="' . esc_attr($category->slug) . '">' .  $category->name . '</option>';
                }
            }
            return $cpt_terms;
        }
        $cpt_terms = [];
        foreach ($taxonomyies as $category) {
            if (isset($category->slug) && isset($category->name)) {
                $cpt_terms[$category->slug] = $category->name;
            }
        }
        return $cpt_terms;
    }
endif;

// function acea_addons_cpt_slug_and_id( $post_type ) {
//     $the_query = new WP_Query( array(
//         'posts_per_page' => -1,
//         'post_type'      => $post_type,
//     ) );
//     $cpt_posts = [];
//     while ( $the_query->have_posts() ): $the_query->the_post();
//         $cpt_posts[get_the_ID()] = get_the_title();
//     endwhile;
//     wp_reset_postdata();
//     return $cpt_posts;
// }
/**
 *
 * Implementing Feature in menu item
 *
 */
function acea_implement_menu_meta($classes, $item)
{
    // $class = get_field('hide_this_menu', $item) ? 'hide-label' : '';
    // $class .= get_field('is_it_title', $item) ? 'megamenu-heading' : '';
    $class = get_post_meta($item->ID, 'acea_select_megamenu', true) ? 'menu-item-has-children acea-megamenu-builder-parent acea-mega-menu' : '';
    $classes[] = $class;
    return $classes;
}
add_filter('nav_menu_css_class', 'acea_implement_menu_meta', 10, 2);
function acea_addons_megamenu_builder_integrations($item_output, $item, $depth, $args)
{
    $selected_megamenu = get_post_meta($item->ID, 'acea_select_megamenu', true);
    if (!empty($selected_megamenu)) {
        if (!array_key_exists('elementor-preview', $_GET)) {
            $custom_sub_menu_html = "   <ul class='acea-addons-megamenu-builder-content-wrap sub-menu'>
            <li>" . acea_addons_layout_content($selected_megamenu) . "</li>
        </ul>";
            // Append after <a> element of the menu item targeted
            $item_output .= $custom_sub_menu_html;
        }
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'acea_addons_megamenu_builder_integrations', 10, 4);
function acea_addons_layout_content($post_id)
{
    return Elementor\Plugin::instance()->frontend->get_builder_content($post_id, true);
}


/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if (!function_exists('acea_addons_get_all_pages')) {
    function acea_addons_get_all_pages($posttype = 'page')
    {
        $args = array(
            'post_type'      => $posttype,
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );

        $page_list = array();
        if ($data = get_posts($args)) {
            foreach ($data as $key) {
                $page_list[$key->ID] = $key->post_title;
            }
        }
        return $page_list;
    }
}

/*
 * Check user Login and call this function
 */
global $user;
if (empty($user->ID)) {
    add_action('elementor/init', 'acea_addons_ajax_login_init');
    add_action('elementor/init', 'acea_addons_ajax_register_init');
}

/*
 * wp_ajax_nopriv Function
 */
function acea_addons_ajax_login_init()
{
    add_action('wp_ajax_acea_addons_ajax_login', 'acea_addons_ajax_login');
    add_action('wp_ajax_nopriv_acea_addons_ajax_login', 'acea_addons_ajax_login');
}

/*
 * ajax login
 */
function acea_addons_ajax_login()
{

    check_ajax_referer('ajax-login-nonce', 'security');
    $user_data                     = array();
    $user_data['user_login']       = !empty($_POST['username']) ? $_POST['username'] : "";
    $user_data['user_password']    = !empty($_POST['password']) ? $_POST['password'] : "";
    $user_data['cf_user_password'] = !empty($_POST['cf_password']) ? $_POST['cf_password'] : "";

    $user_data['remember'] = true;
    $user_signon           = wp_signon($user_data, true);

    if (is_wp_error($user_signon)) {
        echo json_encode(['loggeauth' => false, 'message' => esc_html__('Invalid username or password!', 'fd-addons')]);
    } else {
        echo json_encode(['loggeauth' => true, 'message' => esc_html__('Login Successfully', 'fd-addons')]);
    }
    wp_die();
}


//portfolio loadmore

function acea_loadmore_callback()
{
    // maybe it isn't the best way to declare global $post variable, but it is simple and works perfectly!
    $nonce = (isset($_POST['nonce'])) ? $_POST['nonce'] : '';
    if(check_ajax_referer( 'acea_loadmore_callback', 'folio_nonce' )){
        $settings = (isset($_POST['portfolio_settings'])) ? $_POST['portfolio_settings']['settings'] : [];
        $paged = (isset($_POST['paged'])) ? $_POST['paged'] : '';
        include(__DIR__ . '/../widgets/portfolio/queries/portfolio-query.php');
        include(__DIR__ . '/../widgets/portfolio/contents/portfolio-content.php');
        wp_reset_postdata();
        wp_die( ' ' );
    }else{
        echo "something wrong";
        wp_die( ' ' );
    }
}
add_action('wp_ajax_acea_loadmore_callback', 'acea_loadmore_callback'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_acea_loadmore_callback', 'acea_loadmore_callback'); // wp_ajax_nopriv_{action}

/*
 * wp_ajax_nopriv Register Function
 */
function acea_addons_ajax_register_init()
{
    add_action('wp_ajax_nopriv_acea_addons_ajax_register', 'acea_addons_ajax_register');
}

/*
 * Ajax Register Call back
 */
function acea_addons_ajax_register()
{

    $user_data = array(
        'user_login'     => !empty($_POST['reg_name']) ? $_POST['reg_name'] : "",
        'user_pass'      => !empty($_POST['reg_password']) ? $_POST['reg_password'] : "",
        'cf_user_pass'   => !empty($_POST['cf_reg_password']) ? $_POST['cf_reg_password'] : "",
        'reg_checkbox'   => isset($_POST['reg_checkbox'])  && $_POST['reg_checkbox'] == 'true' ? true  : false,
        'user_email'     => !empty($_POST['reg_email']) ? $_POST['reg_email'] : "",
        'conform_reg_email'  => !empty($_POST['conform_reg_email']) ? $_POST['conform_reg_email'] : "",
        'user_url'       => !empty($_POST['reg_website']) ? $_POST['reg_website'] : "",
        'first_name'     => !empty($_POST['reg_fname']) ? $_POST['reg_fname'] : "",
        'last_name'      => !empty($_POST['reg_lname']) ? $_POST['reg_lname'] : "",
        'nickname'       => !empty($_POST['reg_nickname']) ? $_POST['reg_nickname'] : "",
        'description'    => !empty($_POST['reg_bio']) ? $_POST['reg_bio'] : "",
    );

    if (acea_addons_validation_data($user_data) !== true) {
        echo acea_addons_validation_data($user_data);
    } else {
        $register_user = wp_insert_user($user_data);
        if (is_wp_error($register_user)) {
            echo json_encode(['registerauth' => false, 'message' => esc_html__('Something is wrong please check again!', 'fd-addons')]);
        } else {
            echo json_encode(['registerauth' => true, 'message' => esc_html__('Successfully Register', 'fd-addons')]);
        }
    }
    wp_die();
}

// Register Data Validation
function acea_addons_validation_data($user_data)
{

    $data = '';

    if (empty($user_data['user_login']) || empty($_POST['reg_email']) || empty($_POST['conform_reg_email']) || empty($_POST['reg_password']) || empty($_POST['cf_reg_password'])) {
        return json_encode(['registerauth' => false, 'message' => esc_html__('Username, Password and E-Mail are required', 'fd-addons')]);
    }

    if (!empty($user_data['user_login'])) {

        if (4 > strlen($user_data['user_login'])) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Username too short. At least 4 characters is required', 'fd-addons')]);
        }

        if (username_exists($user_data['user_login'])) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Sorry, that username already exists!', 'fd-addons')]);
        }

        if (!validate_username($user_data['user_login'])) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Sorry, the username you entered is not valid', 'fd-addons')]);
        }
    }

    if (!empty($user_data['user_pass']) && !empty($user_data['cf_user_pass'])) {
        if (isset($user_data['user_pass']) && $user_data['user_pass'] != $user_data['cf_user_pass']) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('The passwords do not match.', 'fd-addons')]);
        }
    }



    if (!$user_data['reg_checkbox']) {
        return json_encode(['registerauth' => false, 'message' => esc_html__('You must accept our privacy policy and terms.', 'fd-addons')]);
    }

    if (!empty($user_data['user_pass'])) {
        if (5 > strlen($user_data['user_pass'])) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Password length must be greater than 5', 'fd-addons')]);
        }
    }

    if (!empty($user_data['user_email'])) {
        if (!is_email($user_data['user_email'])) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Email is not valid', 'fd-addons')]);
        }
        if (email_exists($user_data['user_email'])) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Email Already in Use', 'fd-addons')]);
        }
    }

    if (!empty($user_data['user_email']) && !empty($user_data['conform_reg_email'])) {
        if (isset($user_data['user_email']) && $user_data['user_email'] != $user_data['conform_reg_email']) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('The Email do not match.', 'fd-addons')]);
        }
    }







    if (!empty($user_data['user_url'])) {
        if (!filter_var($user_data['user_url'], FILTER_VALIDATE_URL)) {
            return json_encode(['registerauth' => false, 'message' => esc_html__('Website is not a valid URL', 'fd-addons')]);
        }
    }
    return true;
};



/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'acea_woocommerce_header_add_to_cart_fragment');

function acea_woocommerce_header_add_to_cart_fragment($fragments)
{

    ob_start();

?>
     <span class="cart-contents"><?php if ( !is_null(WC()->cart) ) {
         echo WC()->cart->get_cart_contents_count();
     } ?></span>

<?php
    $fragments['.cart-contents'] = ob_get_clean();
    return $fragments;
}
