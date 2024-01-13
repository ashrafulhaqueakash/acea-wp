<?php
// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class AceaCustomPosts {
    function __construct() {
        add_action( 'admin_menu', array( $this, 'acea_header_footer_menu' ) );
        // Header
        add_action( 'init', array( $this, 'acea_header' ) );
        add_action( 'init', array( $this, 'acea_footer' ) );
        add_action( 'init', array( $this, 'acea_megamenu' ) );

        if ( 1 == get_option( 'acea_testimonial', '1' ) ):
            // Testimonial
            if ( acea_check_cpt( 'testimonial' ) ) {
                add_action( 'init', array( $this, 'acea_testimonial' ) );
                add_action( 'init', array( $this, 'acea_testimonial_category' ) );
                add_action( 'init', array( $this, 'acea_testimonial_tags' ) );
            }
        endif;

        // service
        if ( 1 == get_option( 'acea_service', 1 ) ) {
            add_action( 'init', array( $this, 'acea_service' ) );
            add_action( 'init', array( $this, 'acea_service_category' ) );
            add_action( 'init', array( $this, 'acea_service_tags' ) );
        }

        // Job
        if ( 1 == get_option( 'acea_job', 1 ) ) {
            add_action( 'init', array( $this, 'acea_job' ) );
            add_action( 'init', array( $this, 'acea_job_category' ) );
            add_action( 'init', array( $this, 'acea_job_tags' ) );
        }

        // portfolio
        if ( 1 == get_option( 'portfolio', 1 ) ) {
            add_action('init', array($this, 'acea_portfolio'));
            add_action('init', array($this, 'acea_portfolio_category'));
            add_action('init', array($this, 'acea_portfolio_tags'));
        }

        // project
        if ( 1 == get_option( 'project', 1 ) ) {
            add_action('init', array($this, 'acea_project'));
            add_action('init', array($this, 'acea_project_category'));
            add_action('init', array($this, 'acea_project_tags'));
        }

    }
    public function acea_header_footer_menu() {
        global $menu, $submenu;
        add_menu_page(
            'Acea Options',
            'Acea Options',
            'read',
            'Acea',
            '',
            'dashicons-archive',
            40
        );
    }
    /**
     *
     * Acea Header Footer Post Type
     *
     */
    public function acea_header() {
        $labels = array(
            'name'               => _x( 'Header', 'post type general name', 'acea-hp' ),
            'singular_name'      => _x( 'Header', 'post type singular name', 'acea-hp' ),
            'menu_name'          => _x( 'Header', 'admin menu', 'acea-hp' ),
            'name_admin_bar'     => _x( 'Header', 'add new on admin bar', 'acea-hp' ),
            'add_new'            => __( 'Add New Header', 'acea-hp' ),
            'add_new_item'       => __( 'Add New Header', 'acea-hp' ),
            'new_item'           => __( 'New Header', 'acea-hp' ),
            'edit_item'          => __( 'Edit Header', 'acea-hp' ),
            'view_item'          => __( 'View Header', 'acea-hp' ),
            'all_items'          => __( 'All Headers', 'acea-hp' ),
            'search_items'       => __( 'Search Headers', 'acea-hp' ),
            'parent_item_colon'  => __( 'Parent :', 'acea-hp' ),
            'not_found'          => __( 'No Headers found.', 'acea-hp' ),
            'not_found_in_trash' => __( 'No Headers found in Trash.', 'acea-hp' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'acea-hp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'show_in_menu'       => 'Acea',
            'rewrite'            => array( 'slug' => 'header' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'acea_header', $args );
    }
    public function acea_footer() {
        $labels = array(
            'name'               => _x( 'Footer', 'post type general name', 'acea-hp' ),
            'singular_name'      => _x( 'Footer', 'post type singular name', 'acea-hp' ),
            'menu_name'          => _x( 'Footer', 'admin menu', 'acea-hp' ),
            'name_admin_bar'     => _x( 'Footer', 'add new on admin bar', 'acea-hp' ),
            'add_new'            => __( 'Add New Footer', 'acea-hp' ),
            'add_new_item'       => __( 'Add New Footer', 'acea-hp' ),
            'new_item'           => __( 'New Footer', 'acea-hp' ),
            'edit_item'          => __( 'Edit Footer', 'acea-hp' ),
            'view_item'          => __( 'View Footer', 'acea-hp' ),
            'all_items'          => __( 'All Footers', 'acea-hp' ),
            'search_items'       => __( 'Search Footers', 'acea-hp' ),
            'parent_item_colon'  => __( 'Parent :', 'acea-hp' ),
            'not_found'          => __( 'No Footers found.', 'acea-hp' ),
            'not_found_in_trash' => __( 'No Footers found in Trash.', 'acea-hp' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'acea-hp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'footer' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_menu'       => 'Acea',
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'acea_footer', $args );
    }
    public function acea_megamenu() {
        $labels = array(
            'name'               => _x( 'Mega Menu', 'post type general name', 'acea-hp' ),
            'singular_name'      => _x( 'Mega Menu', 'post type singular name', 'acea-hp' ),
            'menu_name'          => _x( 'Mega Menu', 'admin menu', 'acea-hp' ),
            'name_admin_bar'     => _x( 'Mega Menu', 'add new on admin bar', 'acea-hp' ),
            'add_new'            => __( 'Add New Mega Menu', 'acea-hp' ),
            'add_new_item'       => __( 'Add New Mega Menu', 'acea-hp' ),
            'new_item'           => __( 'New Mega Menu', 'acea-hp' ),
            'edit_item'          => __( 'Edit Mega Menu', 'acea-hp' ),
            'view_item'          => __( 'View Mega Menu', 'acea-hp' ),
            'all_items'          => __( 'All Mega Menus', 'acea-hp' ),
            'search_items'       => __( 'Search Mega Menus', 'acea-hp' ),
            'parent_item_colon'  => __( 'Parent :', 'acea-hp' ),
            'not_found'          => __( 'No Mega Menus found.', 'acea-hp' ),
            'not_found_in_trash' => __( 'No Mega Menus found in Trash.', 'acea-hp' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'acea-hp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'megamenu' ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_menu'       => 'Acea',
            'supports'           => array( 'title', 'elementor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'acea_megamenu', $args );
    }
    //Testimonial
    public function acea_testimonial() {
        $labels = array(
            'name'               => _x( 'Testimonial', 'post type general name', 'acea-hp' ),
            'singular_name'      => _x( 'Testimonial', 'post type singular name', 'acea-hp' ),
            'menu_name'          => _x( 'Testimonial', 'admin menu', 'acea-hp' ),
            'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'acea-hp' ),
            'add_new'            => __( 'Add New Testimonial', 'acea-hp' ),
            'add_new_item'       => __( 'Add New Testimonial', 'acea-hp' ),
            'new_item'           => __( 'New Testimonial', 'acea-hp' ),
            'edit_item'          => __( 'Edit Testimonial', 'acea-hp' ),
            'view_item'          => __( 'View Testimonial', 'acea-hp' ),
            'all_items'          => __( 'All Testimonial', 'acea-hp' ),
            'search_items'       => __( 'Search Testimonial', 'acea-hp' ),
            'parent_item_colon'  => __( 'Parent :', 'acea-hp' ),
            'not_found'          => __( 'No Testimonial found.', 'acea-hp' ),
            'not_found_in_trash' => __( 'No Testimonial found in Trash.', 'acea-hp' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'acea-hp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-testimonial',
            'rewrite'            => array( 'slug' => 'acea_testimonial', 'with_front' => true, 'pages' => true, 'feeds' => true ),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        );
        register_post_type( 'acea_testimonial', $args );
    }
    public function acea_testimonial_category() {
        $labels = array(
            'name'              => _x( 'Categories', 'taxonomy general name', 'acea-hp' ),
            'singular_name'     => _x( 'Category', 'taxonomy singular name', 'acea-hp' ),
            'search_items'      => __( 'Search Categories', 'acea-hp' ),
            'all_items'         => __( 'All Categories', 'acea-hp' ),
            'parent_item'       => __( 'Parent Category', 'acea-hp' ),
            'parent_item_colon' => __( 'Parent Category:', 'acea-hp' ),
            'edit_item'         => __( 'Edit Category', 'acea-hp' ),
            'update_item'       => __( 'Update Category', 'acea-hp' ),
            'add_new_item'      => __( 'Add New Category', 'acea-hp' ),
            'new_item_name'     => __( 'New Category Name', 'acea-hp' ),
            'menu_name'         => __( 'Category', 'acea-hp' ),
        );
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'portfolio-category' ),
        );
        register_taxonomy( 'testimonial_category', array( 'acea_testimonial' ), $args );
    }
    public function acea_testimonial_tags() {
        $labels = array(
            'name'              => _x( 'Tags', 'taxonomy general name', 'acea-hp' ),
            'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'acea-hp' ),
            'search_items'      => __( 'Search Tags', 'acea-hp' ),
            'all_items'         => __( 'All Tags', 'acea-hp' ),
            'parent_item'       => __( 'Parent Tag', 'acea-hp' ),
            'parent_item_colon' => __( 'Parent Tag:', 'acea-hp' ),
            'edit_item'         => __( 'Edit Tag', 'acea-hp' ),
            'update_item'       => __( 'Update Tag', 'acea-hp' ),
            'add_new_item'      => __( 'Add New Tag', 'acea-hp' ),
            'new_item_name'     => __( 'New Tag Name', 'acea-hp' ),
            'menu_name'         => __( 'Tag', 'acea-hp' ),
        );
        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'portfolio-tag' ),
        );
        register_taxonomy( 'testimonial_tag', array( 'acea_testimonial' ), $args );
    }
    public function acea_service() {
        $labels = array(
            'name'               => _x( 'Service', 'post type general name', 'acea-hp' ),
            'singular_name'      => _x( 'Service', 'post type singular name', 'acea-hp' ),
            'menu_name'          => _x( 'Service', 'admin menu', 'acea-hp' ),
            'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'acea-hp' ),
            'add_new'            => __( 'Add New Service', 'acea-hp' ),
            'add_new_item'       => __( 'Add New Service', 'acea-hp' ),
            'new_item'           => __( 'New Service', 'acea-hp' ),
            'edit_item'          => __( 'Edit Service', 'acea-hp' ),
            'view_item'          => __( 'View Service', 'acea-hp' ),
            'all_items'          => __( 'All Services', 'acea-hp' ),
            'search_items'       => __( 'Search Services', 'acea-hp' ),
            'parent_item_colon'  => __( 'Parent :', 'acea-hp' ),
            'not_found'          => __( 'No Services found.', 'acea-hp' ),
            'not_found_in_trash' => __( 'No Services found in Trash.', 'acea-hp' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'acea-hp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-megaphone',
            'rewrite'            => array( 'slug' => 'service', 'with_front' => true, 'pages' => true, 'feeds' => true ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'elementor', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        );
        register_post_type( 'acea-service', $args );
    }
    public function acea_service_category() {
        $labels = array(
            'name'              => _x( 'Categories', 'taxonomy general name', 'acea-hp' ),
            'singular_name'     => _x( 'Category', 'taxonomy singular name', 'acea-hp' ),
            'search_items'      => __( 'Search Categories', 'acea-hp' ),
            'all_items'         => __( 'All Categories', 'acea-hp' ),
            'parent_item'       => __( 'Parent Category', 'acea-hp' ),
            'parent_item_colon' => __( 'Parent Category:', 'acea-hp' ),
            'edit_item'         => __( 'Edit Category', 'acea-hp' ),
            'update_item'       => __( 'Update Category', 'acea-hp' ),
            'add_new_item'      => __( 'Add New Category', 'acea-hp' ),
            'new_item_name'     => __( 'New Category Name', 'acea-hp' ),
            'menu_name'         => __( 'Category', 'acea-hp' ),
        );
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'service-category' ),
        );
        register_taxonomy( 'service-category', array( 'acea-service' ), $args );
    }
    public function acea_service_tags() {
        $labels = array(
            'name'              => _x( 'Tags', 'taxonomy general name', 'acea-hp' ),
            'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'acea-hp' ),
            'search_items'      => __( 'Search Tags', 'acea-hp' ),
            'all_items'         => __( 'All Tags', 'acea-hp' ),
            'parent_item'       => __( 'Parent Tag', 'acea-hp' ),
            'parent_item_colon' => __( 'Parent Tag:', 'acea-hp' ),
            'edit_item'         => __( 'Edit Tag', 'acea-hp' ),
            'update_item'       => __( 'Update Tag', 'acea-hp' ),
            'add_new_item'      => __( 'Add New Tag', 'acea-hp' ),
            'new_item_name'     => __( 'New Tag Name', 'acea-hp' ),
            'menu_name'         => __( 'Tag', 'acea-hp' ),
        );
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'pf-tag' ),
        );
        register_taxonomy( 'service-tag', array( 'acea-service' ), $args );
    }


    /**
	 *
	 * Fastland Portfolio Post Type
	 *
	 */
	public function acea_portfolio()
	{
		$labels = array(
			'name'               => _x('Portfolio', 'post type general name', 'acea-hp'),
			'singular_name'      => _x('Portfolio', 'post type singular name', 'acea-hp'),
			'menu_name'          => _x('Portfolio', 'admin menu', 'acea-hp'),
			'name_admin_bar'     => _x('Portfolio', 'add new on admin bar', 'acea-hp'),
			'add_new'            => __('Add New Portfolio', 'acea-hp'),
			'add_new_item'       => __('Add New Portfolio', 'acea-hp'),
			'new_item'           => __('New Portfolio', 'acea-hp'),
			'edit_item'          => __('Edit Portfolio', 'acea-hp'),
			'view_item'          => __('View Portfolio', 'acea-hp'),
			'all_items'          => __('All Portfolios', 'acea-hp'),
			'search_items'       => __('Search Portfolios', 'acea-hp'),
			'parent_item_colon'  => __('Parent :', 'acea-hp'),
			'not_found'          => __('No Portfolios found.', 'acea-hp'),
			'not_found_in_trash' => __('No Portfolios found in Trash.', 'acea-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'acea-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'portfolio', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
		);
		register_post_type('portfolio', $args);
	}
	public function acea_portfolio_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'acea-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'acea-hp'),
			'search_items'      => __('Search Categories', 'acea-hp'),
			'all_items'         => __('All Categories', 'acea-hp'),
			'parent_item'       => __('Parent Category', 'acea-hp'),
			'parent_item_colon' => __('Parent Category:', 'acea-hp'),
			'edit_item'         => __('Edit Category', 'acea-hp'),
			'update_item'       => __('Update Category', 'acea-hp'),
			'add_new_item'      => __('Add New Category', 'acea-hp'),
			'new_item_name'     => __('New Category Name', 'acea-hp'),
			'menu_name'         => __('Category', 'acea-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'portfolio-category'),
		);
		register_taxonomy('portfolio-category', array('portfolio'), $args);
	}
	public function acea_portfolio_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'acea-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'acea-hp'),
			'search_items'      => __('Search Tags', 'acea-hp'),
			'all_items'         => __('All Tags', 'acea-hp'),
			'parent_item'       => __('Parent Tag', 'acea-hp'),
			'parent_item_colon' => __('Parent Tag:', 'acea-hp'),
			'edit_item'         => __('Edit Tag', 'acea-hp'),
			'update_item'       => __('Update Tag', 'acea-hp'),
			'add_new_item'      => __('Add New Tag', 'acea-hp'),
			'new_item_name'     => __('New Tag Name', 'acea-hp'),
			'menu_name'         => __('Tag', 'acea-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'portfolio-tag'),
		);
		register_taxonomy('portfolio-tag', array('portfolio'), $args);
	}

    /**
     *
     * Acea Job Post Type
     *
     */
    public function acea_job() {
        $labels = array(
            'name'               => _x( 'Job', 'post type general name', 'acea-hp' ),
            'singular_name'      => _x( 'Job', 'post type singular name', 'acea-hp' ),
            'menu_name'          => _x( 'Job', 'admin menu', 'acea-hp' ),
            'name_admin_bar'     => _x( 'Job', 'add new on admin bar', 'acea-hp' ),
            'add_new'            => __( 'Add New Job', 'acea-hp' ),
            'add_new_item'       => __( 'Add New Job', 'acea-hp' ),
            'new_item'           => __( 'New Job', 'acea-hp' ),
            'edit_item'          => __( 'Edit Job', 'acea-hp' ),
            'view_item'          => __( 'View Job', 'acea-hp' ),
            'all_items'          => __( 'All Jobs', 'acea-hp' ),
            'search_items'       => __( 'Search Jobs', 'acea-hp' ),
            'parent_item_colon'  => __( 'Parent :', 'acea-hp' ),
            'not_found'          => __( 'No Jobs found.', 'acea-hp' ),
            'not_found_in_trash' => __( 'No Jobs found in Trash.', 'acea-hp' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Description.', 'acea-hp' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'          => 'dashicons-id',
            'rewrite'            => array( 'slug' => 'job', 'with_front' => true, 'pages' => true, 'feeds' => true ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'elementor', 'editor', 'thumbnail', 'page-attributes' ),
        );
        register_post_type( 'job', $args );
    }
    public function acea_job_category() {
        $labels = array(
            'name'              => _x( 'Categories', 'taxonomy general name', 'acea-hp' ),
            'singular_name'     => _x( 'Category', 'taxonomy singular name', 'acea-hp' ),
            'search_items'      => __( 'Search Categories', 'acea-hp' ),
            'all_items'         => __( 'All Categories', 'acea-hp' ),
            'parent_item'       => __( 'Parent Category', 'acea-hp' ),
            'parent_item_colon' => __( 'Parent Category:', 'acea-hp' ),
            'edit_item'         => __( 'Edit Category', 'acea-hp' ),
            'update_item'       => __( 'Update Category', 'acea-hp' ),
            'add_new_item'      => __( 'Add New Category', 'acea-hp' ),
            'new_item_name'     => __( 'New Category Name', 'acea-hp' ),
            'menu_name'         => __( 'Category', 'acea-hp' ),
        );
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'job-category' ),
        );
        register_taxonomy( 'job-category', array( 'job' ), $args );
    }
    public function acea_job_tags() {
        $labels = array(
            'name'              => _x( 'Tags', 'taxonomy general name', 'acea-hp' ),
            'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'acea-hp' ),
            'search_items'      => __( 'Search Tags', 'acea-hp' ),
            'all_items'         => __( 'All Tags', 'acea-hp' ),
            'parent_item'       => __( 'Parent Tag', 'acea-hp' ),
            'parent_item_colon' => __( 'Parent Tag:', 'acea-hp' ),
            'edit_item'         => __( 'Edit Tag', 'acea-hp' ),
            'update_item'       => __( 'Update Tag', 'acea-hp' ),
            'add_new_item'      => __( 'Add New Tag', 'acea-hp' ),
            'new_item_name'     => __( 'New Tag Name', 'acea-hp' ),
            'menu_name'         => __( 'Tag', 'acea-hp' ),
        );
        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'job-tag' ),
        );
        register_taxonomy( 'job-tag', array( 'job' ), $args );
    }

    // project
    public function acea_project()
	{
		$labels = array(
			'name'               => _x('Project', 'post type general name', 'acea-hp'),
			'singular_name'      => _x('Project', 'post type singular name', 'acea-hp'),
			'menu_name'          => _x('Project', 'admin menu', 'acea-hp'),
			'name_admin_bar'     => _x('Project', 'add new on admin bar', 'acea-hp'),
			'add_new'            => __('Add New Project', 'acea-hp'),
			'add_new_item'       => __('Add New Project', 'acea-hp'),
			'new_item'           => __('New Project', 'acea-hp'),
			'edit_item'          => __('Edit Project', 'acea-hp'),
			'view_item'          => __('View Project', 'acea-hp'),
			'all_items'          => __('All Projects', 'acea-hp'),
			'search_items'       => __('Search Projects', 'acea-hp'),
			'parent_item_colon'  => __('Parent :', 'acea-hp'),
			'not_found'          => __('No Projects found.', 'acea-hp'),
			'not_found_in_trash' => __('No Projects found in Trash.', 'acea-hp')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'acea-hp'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'project', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
		);
		register_post_type('project', $args);
	}
	public function acea_project_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'acea-hp'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'acea-hp'),
			'search_items'      => __('Search Categories', 'acea-hp'),
			'all_items'         => __('All Categories', 'acea-hp'),
			'parent_item'       => __('Parent Category', 'acea-hp'),
			'parent_item_colon' => __('Parent Category:', 'acea-hp'),
			'edit_item'         => __('Edit Category', 'acea-hp'),
			'update_item'       => __('Update Category', 'acea-hp'),
			'add_new_item'      => __('Add New Category', 'acea-hp'),
			'new_item_name'     => __('New Category Name', 'acea-hp'),
			'menu_name'         => __('Category', 'acea-hp'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'project-category'),
		);
		register_taxonomy('project-category', array('project'), $args);
	}
	public function acea_project_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'acea-hp'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'acea-hp'),
			'search_items'      => __('Search Tags', 'acea-hp'),
			'all_items'         => __('All Tags', 'acea-hp'),
			'parent_item'       => __('Parent Tag', 'acea-hp'),
			'parent_item_colon' => __('Parent Tag:', 'acea-hp'),
			'edit_item'         => __('Edit Tag', 'acea-hp'),
			'update_item'       => __('Update Tag', 'acea-hp'),
			'add_new_item'      => __('Add New Tag', 'acea-hp'),
			'new_item_name'     => __('New Tag Name', 'acea-hp'),
			'menu_name'         => __('Tag', 'acea-hp'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'project-tag'),
		);
		register_taxonomy('project-tag', array('project'), $args);
	}


}
$aceaCcases_stydyInstance = new AceaCustomPosts;
