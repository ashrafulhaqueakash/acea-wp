<?php
// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Helper library to as for a wp.org review.
 *
 * Review notice will be shown using WordPress admin notices after
 * a specified time of plugin/theme use.
 * This is mainly developed to reuse on my plugins but anyone can
 * use it as a library.
 *
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @copyright  Copyright (c) 2021, Joel James
 * @link       https://github.com/duckdev/wp-review-notice/
 * @package    DuckDev
 * @subpackage Pages
 */

// Should be called only by WordPress.
defined( 'WPINC' ) || die;

/**
 * Class Notice.
 *
 * Main class that handles review notice.
 *
 * @package DuckDev\Reviews
 */
class Notice {

    /**
     * Prefix for all options and keys.
     *
     * Override only when required.
     *
     * @var string $prefix
     *
     * @since 1.0.0
     */
    private $prefix = '';

    /**
     * Plugin name to show in review.
     *
     * @var string $name
     *
     * @since 1.0.0
     */
    private $name = '';

    /**
     * Plugin slug in https://wordpress.org/plugins/{slug}.
     *
     * @var string $slug
     *
     * @since 1.0.0
     */
    private $slug = '';

    /**
     * Minimum no. of days to show the notice after.
     *
     * Currently we support only days.
     *
     * @var int $days
     *
     * @since 1.0.0
     */
    private $days = 7;

    /**
     * WP admin page screen IOs to show notice in.
     *
     * If it's empty, we will show it on all pages.
     *
     * @var array $screens
     *
     * @since 1.0.0
     */
    private $screens = array();

    /**
     * Notice classes to set additional classes.
     *
     * By default we use WP info notice class.
     *
     * @var array $classes
     *
     * @since 1.0.0
     */
    private $classes = array( 'notice', 'notice-info' );

    /**
     * Actions link texts.
     *
     * Adding extra items to the array will not do anything.
     *
     * @var array $actions
     *
     * @since 1.0.2
     */
    private $action_labels = array();

    /**
     * Main message of the notice.
     *
     * @var string $message
     *
     * @since 1.0.2
     */
    private $message = '';

    /**
     * Minimum capability for the user to see and dismiss notice.
     *
     * @see   https://wordpress.org/support/article/roles-and-capabilities/
     *
     * @var string $cap
     *
     * @since 1.0.0
     */
    private $cap = 'manage_options';

    /**
     * Text domain for translations.
     *
     * @var string $domain
     *
     * @since 1.0.0
     */
    private $domain = '';

    /**
     * Create new notice instance with provided options.
     *
     * Do not use any hooks to run these functions because
     * we don't know in which hook and priority everyone is
     * going to initialize this notice.
     *
     * @param string $slug    WP.org slug for plugin.
     * @param string $name    Name of plugin.
     * @param array  $options Array of options (@see Notice::get()).
     *
     * @since  4.0.0
     * @access private
     *
     * @return void
     */
    private function __construct( $slug, $name, array $options ) {
        // Only for admin side.
        if ( is_admin() ) {
            // Setup options.
            $this->setup( $slug, $name, $options );

            add_action( 'admin_notices', [$this, 'render'] );
            // Process actions.
            $this->actions();
        }
    }

    /**
     * Create and get new notice instance.
     *
     * Use this to setup new plugin notice to avoid multiple instances
     * of same plugin notice.
     * If you provide wrong slug, please note we will still link to the
     * wrong wp.org plugin page for reviews.
     *
     * @param string $slug    WP.org slug for plugin.
     * @param string $name    Name of plugin.
     * @param array  $options {
     *                        Array of options.
     *
     * @type int     $days    No. of days after the notice is shown.
     * @type array   $screens WP screen IDs to show notice.
     *                        Leave empty to show in all pages (not recommended).
     * @type string  $cap     User capability to show notice.
     *                        Make sure to use proper capability for multisite.
     * @type array   $classes Additional class names for notice.
     * @type string  $domain  Text domain for translations.
     * @type string  $prefix  To override default option prefix.
     * }
     *
     * @since  1.0.0
     * @access public
     *
     * @return Notice
     */
    public static function get( $slug, $name, array $options ) {
        static $notices = array();

        // Create new instance if not already created.
        if ( !isset( $notices[$slug] ) || !$notices[$slug] instanceof Notice ) {
            $notices[$slug] = new self( $slug, $name, $options );
        }

        return $notices[$slug];
    }

    /**
     * Render the review notice.
     *
     * Review notice will be rendered only if all these conditions met:
     * > Current screen is an allowed screen (@since  1.0.0
     *
     * @access public
     *
     * @see    Noticee::is_capable())
     * > It's time to show the notice (@see Noticee::is_time())
     * > User has not dismissed the notice (@see Noticee::is_dismissed())
     *
     * @see    Noticee::in_screen())
     * > Current user has the required capability (@return void
     */
    public function render() {
        // Check conditions.
        if ( !$this->can_show() && !empty( $this->message ) ) {
            return;
        }
        ?>
        <div style="padding-bottom:15px;" id="duckdev-reviews-<?php echo esc_attr( $this->slug ); ?>" class="<?php echo esc_attr( $this->get_classes() ); ?>">
			<p>
				<?php echo $this->message; ?>
			</p>
			<?php if ( !empty( $this->action_labels['review'] ) ): ?>

					<a style="margin-right:10px; text-decoration:none" href="<?php echo esc_url( 'https://themeforest.net/downloads' ); ?>" target="_blank">
						→ <?php echo $this->action_labels['review']; ?>
					</a>

			<?php endif;?>
			<?php if ( !empty( $this->action_labels['later'] ) ): ?>

					<a style="margin-right:10px; text-decoration:none" href="<?php echo esc_url( add_query_arg( $this->key( 'action' ), 'dismiss' ) ); ?>">
						→ <?php echo $this->action_labels['later']; ?>
					</a>

			<?php endif;?>
			<?php if ( !empty( $this->action_labels['dismiss'] ) ): ?>

					<a style="margin-right:10px; text-decoration:none" href="<?php echo esc_url( add_query_arg( $this->key( 'action' ), 'dismiss' ) ); ?>">
						→ <?php echo $this->action_labels['dismiss']; ?>
					</a>

			<?php endif;?>
		</div>
		<?php

    }

    /**
     * Check if it's time to show the notice.
     *
     * Based on the day provided, we will check if the current
     * timestamp exceeded or reached the notice time.
     *
     * @since  1.0.0
     * @access protected
     * @uses   get_site_option()
     * @uses   update_site_option()
     *
     * @return bool
     */
    protected function is_time() {
        // Get the notice time.
        $time = get_site_option( $this->key( 'time' ) );

        // If not set, set now and bail.
        if ( empty( $time ) ) {
            $time = time() + ( $this->days * DAY_IN_SECONDS );
            // Set to future.
            update_site_option( $this->key( 'time' ), $time );

            // return false;
        }

        // Check if time passed or reached.
        return (int) $time <= time();
        // return true;
    }

    /**
     * Check if the notice is already dismissed.
     *
     * If a user has dismissed the notice, do not show
     * notice to the current user again.
     * We store the flag in current user's meta data.
     *
     * @since  1.0.0
     * @access protected
     * @uses   get_user_meta()
     *
     * @return bool
     */
    protected function is_dismissed() {
        // Get current user.
        $current_user = wp_get_current_user();

        // Check if current item is dismissed.
        return (bool) get_user_meta(
            $current_user->ID,
            $this->key( 'dismissed' ),
            true
        );
    }

    /**
     * Check if current user has the capability.
     *
     * Before showing and processing the notice actions,
     * current user should have the capability to do so.
     *
     * @since  1.0.0
     * @uses   current_user_can()
     * @access protected
     *
     * @return bool
     */
    protected function is_capable() {
        return current_user_can( $this->cap );
    }

    /**
     * Check if the current screen is allowed.
     *
     * Make sure the current page's screen ID is in
     * allowed IDs list before showing a notice.
     * If no screen ID is set, we will allow it in
     * all pages (not recommended).
     *
     * @since  1.0.0
     * @access protected
     * @uses   get_current_screen()
     *
     * @return bool
     */
    protected function in_screen() {
        // If not screen ID is set, show everywhere.
        if ( empty( $this->screens ) ) {
            return true;
        }

        // Get current screen.
        $screen = get_current_screen();

        // Check if current screen id is allowed.
        return !empty( $screen->id ) && in_array( $screen->id, $this->screens, true );
    }

    /**
     * Get the class names for notice div.
     *
     * Notice is using WordPress admin notices info notice styles.
     * You can pass additional class names to customize it for your
     * requirements in `classes` option when creating notice instance.
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_notices/
     *
     * @since  1.0.0
     * @access protected
     *
     * @return string
     */
    protected function get_classes() {
        // Required classes.
        $classes = array( 'notice', 'notice-info' );

        // Add extra classes.
        if ( !empty( $this->classes ) && is_array( $this->classes ) ) {
            $classes = array_merge( $classes, $this->classes );
            $classes = array_unique( $classes );
        }

        return implode( ' ', $classes );
    }

    /**
     * Get the default notice message for the review.
     *
     * This will be used only if the message is not passed through
     * options array. You can also use `duckdev_reviews_notice_message` filter to modify
     * the notice message.
     * NOTE: We will not escape anything. You should do it yourself if you are adding a
     * custom message.
     *
     * @since  1.0.2
     * @access protected
     *
     * @return string
     */
    protected function get_message() {
        // Get current user data.
        $current_user = wp_get_current_user();
        // Make sure we have name.
        $name = empty( $current_user->display_name ) ? __( 'friend', $this->domain ) : ucwords( $current_user->display_name );

        $message = sprintf(
            // translators: %1$s Current user's name, %2$s Plugin name, %3$d.
            __( 'Hey %1$s, <br> we noticed you\'ve been using %2$s for more than %3$d days – that’s awesome! Could you please do us a BIG favor and give it a 5-star rating on Themeforest? Just to help us spread the word and boost our motivation.', $this->domain ),
            esc_html( $name ),
            '<strong>' . esc_html( $this->name ) . '</strong>',
            (int) $this->days
        );

        /**
         * Filter to modify review notice message.
         *
         * @param string $message Notice message.
         * @param int    $days    Days to show review.
         *
         * @since 1.0.2
         */
        return apply_filters( 'duckdev_reviews_notice_message', $message, $this->days );
    }

    /**
     * Check if we can show the notice.
     *
     * > Current screen is an allowed screen (@since  1.0.0
     *
     * @access protected
     *
     * @see    Noticee::is_capable())
     * > It's time to show the notice (@see Noticee::is_time())
     * > User has not dismissed the notice (@see Noticee::is_dismissed())
     *
     * @see    Noticee::in_screen())
     * > Current user has the required capability (@return bool
     */
    protected function can_show() {
        return (
            $this->in_screen() &&
            $this->is_capable() &&
            $this->is_time() &&
            !$this->is_dismissed()
        );
    }

    /**
     * Process the notice actions.
     *
     * If current user is capable process actions.
     * > Later: Extend the time to show the notice.
     * > Dismiss: Hide the notice to current user.
     *
     * @since  1.0.0
     * @access protected
     *
     * @return void
     */
    protected function actions() {
        // Only if required.
        if ( !$this->in_screen() || !$this->is_capable() ) {
            return;
        }

        // Get the current review action.
        $action = filter_input( INPUT_GET, $this->key( 'action' ) );

        switch ( $action ) {
        case 'later':
            // Let's show after 2 times of days.
            $time = time() + ( $this->days * DAY_IN_SECONDS * 2 );
            update_site_option( $this->key( 'time' ), $time );
            break;
        case 'dismiss':
            // Do not show again to this user.
            update_user_meta(
                get_current_user_id(),
                $this->key( 'dismissed' ),
                true
            );
            break;
        }
    }

    /**
     * Setup notice options to initialize class.
     *
     * Make sure the required options are set before
     * initializing the class.
     *
     * @param string $slug    WP.org slug for plugin.
     * @param string $name    Name of plugin.
     * @param array  $options Array of options (@see Notice::get()).
     *
     * @since  1.0.0
     * @access private
     *
     * @return void
     */
    private function setup( $slug, $name, array $options ) {
        // Plugin name is required.
        if ( empty( $name ) || empty( $slug ) ) {
            return;
        }

        // Merge options.
        $options = wp_parse_args(
            $options,
            array(
                'days'          => 7,
                'screens'       => array(),
                'cap'           => 'manage_options',
                'classes'       => array(),
                'domain'        => 'duckdev',
                'action_labels' => array(),
            )
        );

        // Action button/link labels.
        $this->action_labels = wp_parse_args(
            (array) $options['action_labels'],
            array(
                'review'  => esc_html__( 'Ok, you deserve it', $this->domain ),
                'later'   => esc_html__( 'Nope, maybe later', $this->domain ),
                'dismiss' => esc_html__( 'I already did', $this->domain ),
            )
        );

        // Set options.
        $this->slug    = (string) $slug;
        $this->name    = (string) $name;
        $this->cap     = (string) $options['cap'];
        $this->days    = (int) $options['days'];
        $this->screens = (array) $options['screens'];
        $this->classes = (array) $options['classes'];
        $this->domain  = (string) $options['domain'];
        $this->prefix  = isset( $options['prefix'] ) ? (string) $options['prefix'] : str_replace( '-', '_', $this->slug );
        $this->message = empty( $options['message'] ) ? $this->get_message() : (string) $options['message'];
    }

    /**
     * Create key by prefixing option name.
     *
     * Use this to create proper key for options.
     *
     * @param string $key Key.
     *
     * @since  1.0.0
     * @access protected
     *
     * @return string
     */
    private function key( $key ) {
        return $this->prefix . '_reviews_' . $key;
    }
}

function coderlift_system_check() {
    $system = [
        [
            'name'    => 'php_version',
            'value'   => phpversion(),
            'title'   => __( 'PHP Version', 'fdth' ),
            'require' => '7.0.0',
        ],
        [
            'name'    => 'home_url',
            'value'   => home_url(),
            'title'   => __( 'Home_url', 'fdth' ),
            'require' => false,
        ],
        [
            'name'    => 'memory_limit',
            'value'   => ini_get( 'memory_limit' ),
            'title'   => __( 'Memory Limit', 'fdth' ),
            'require' => 256,
        ],
        [
            'name'    => 'post_max_size',
            'value'   => ini_get( 'post_max_size' ),
            'title'   => __( 'Post Max Size', 'fdth' ),
            'require' => 512,

        ],
        [
            'name'    => 'max_execution_time',
            'value'   => ini_get( 'max_execution_time' ),
            'title'   => __( 'Max Execution Time', 'fdth' ),
            'require' => 256,

        ],
        [
            'name'    => 'upload_max_filesize',
            'value'   => ini_get( 'upload_max_filesize' ),
            'title'   => __( 'Upload Max File Size', 'fdth' ),
            'require' => 256,

        ],
        [
            'name'    => 'max_input_time',
            'value'   => ini_get( 'max_input_time' ),
            'title'   => __( 'Max Input Time', 'fdth' ),
            'require' => 600,

        ],

    ];

    $has_error = false;
    echo '<ul>';
    foreach ( $system as $item ) {

        if ( 'upload_max_filesize' == $item['name'] || 'post_max_size' == $item['name'] || 'memory_limit' == $item['name'] ) {
            $compare = intval( rtrim( $item['value'], 'M' ) ) < $item['require'] ? $item['require'] : '';
        } else {
            $compare = intval( $item['value'] ) < $item['require'] ? $item['require'] : '';
        }

        $class = "";
        if ( $compare ) {
            $has_error = true;
            $class     = "failed";
        }

        printf( '<li class="%s"><span class="fdth-sys-title">%s :</span> <span class="fdth-sys-value">%s <strong class="">Require: %s</strong></span></li>', $class, $item['title'], $item['value'], $compare );
    }
    echo '</ul>';

    if ( $has_error ) {
        echo '<p class="fdth-system-notice-error"> <span>
        ' . esc_html__( 'Some requirement is not matching with your current system. It may cause some issue while setting up the theme and demos.', 'fdth' ) . '
        </span>

        To update this info, kindly contact with your hosting provider..
        </p>';
    }
}

function coderlift_th_enqueue_admin_script( $hook ) {

    // if ( 'appearance_page_one-click-demo-import' != $hook ) {
    //     return;
    // }
    // wp_enqueue_style( 'jquery-modal', 'https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/css/iziModal.min.css' );
    // wp_enqueue_script( 'jquery-modal', 'https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.6.1/js/iziModal.min.js', ['jquery'], '1.0' );

    wp_enqueue_style( 'google-fonts-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap' );
    wp_enqueue_style( 'fdth-theme-setup', get_theme_file_uri( 'lib/theme-setup/assets/admin/css/theme-setup.css' ) );

    wp_enqueue_script( 'donutty-jquery', get_theme_file_uri( 'lib/theme-setup/assets/admin/js/donutty-jquery.min.js' ), ['jquery'], '1.0' );
    wp_enqueue_script( 'fdth-theme-setup', get_theme_file_uri( 'lib/theme-setup/assets/admin/js/ocdi-main.js' ), ['ocdi-main-js'], '1.0' );
    wp_enqueue_script( 'fdth-main-js', get_theme_file_uri( 'lib/theme-setup/assets/admin/js/main.js' ), ['jquery'], '1.0' );
    wp_localize_script( 'fdth-main-js', 'fdth_vars', [
        'nonce'    => wp_create_nonce( 'fdth--nonce' ),
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ] );

    // $style = "
    // ";
    // wp_add_inline_style( 'jquery-modal', $style );
}
add_action( 'admin_enqueue_scripts', 'coderlift_th_enqueue_admin_script' );

function fdth_plugin_intro_text() {
    $admin_notices = '';
    $screen        = get_current_screen();

    if ( $screen->base !== 'appearance_page_one-click-demo-import' ) {
        return;
    }

    ob_start();
    ?>
    <div class="fdth-theme-setup-popup-wrap">
        <div class="fdth-theme-setup-popup">
            <div class="fdth-setup-welcome">
                <div class="fdth-setup-header">
                    <h3><?php echo esc_html__( 'Welcome to Theme Setup', 'fdth' ) ?></h3>
                    <p><?php echo esc_html__( 'For optimal results with our theme, be sure to follow the proper installation and setup procedures.', 'fdth' ) ?></p>
                </div>
                <div class="fdth-theme-sytem-info">
                <h4><?php echo esc_html__( 'System Info', 'fdth' ) ?></h4>
                    <?php coderlift_system_check()?>
                </div>
                <div class="fdth-setup-action">
                    <a class="fdth-start-import fdth-button" href=""><?php echo esc_html__( 'Setup Theme', 'fdth' ) ?></a>
                </div>

            </div>

            <div class="fdth-setup-progress" style="display: none;">
                <div class="fdth-setup-header">
                    <h3><?php echo esc_html__( 'Collecting Theme Data', 'fdth' ) ?></h3>
                    <p><?php echo __( 'This process may take up to 10 minutes depending on your internet speed and hosting performance. <span class="red">Do not close this tab or reload this page.</span>', 'fdth' ) ?></p>
                </div>

                <span class="fdth-setup-chart"  data-percent="99">
                    <span class="percent"></span>
                </span>
            </div>


            <div class="fdth-setup-success" >
                <div class="fdth-setup-header">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_811_819" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="80" height="80">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M40 75.8209C59.7833 75.8209 75.8209 59.7833 75.8209 40C75.8209 20.2167 59.7833 4.1791 40 4.1791C20.2167 4.1791 4.1791 20.2167 4.1791 40C4.1791 59.7833 20.2167 75.8209 40 75.8209ZM40 80C62.0914 80 80 62.0914 80 40C80 17.9086 62.0914 0 40 0C17.9086 0 0 17.9086 0 40C0 62.0914 17.9086 80 40 80Z" fill="#D8D8DF"/>
                        </mask>
                        <g mask="url(#mask0_811_819)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M40 75.8209C59.7833 75.8209 75.8209 59.7833 75.8209 40C75.8209 20.2167 59.7833 4.1791 40 4.1791C20.2167 4.1791 4.1791 20.2167 4.1791 40C4.1791 59.7833 20.2167 75.8209 40 75.8209ZM40 80C62.0914 80 80 62.0914 80 40C80 17.9086 62.0914 0 40 0C17.9086 0 0 17.9086 0 40C0 62.0914 17.9086 80 40 80Z" fill="#432CF3"/>
                        </g>
                        <path d="M28.4082 41.7413L35.3734 48.7065L52.7863 31.2935" stroke="#432CF3" stroke-width="4.1791" stroke-linecap="square" stroke-linejoin="round"/>
                    </svg>


                    <h3><?php echo esc_html__( 'Setup Successful', 'fdth' ) ?></h3>
                    <p><?php echo esc_html__( 'Now you can import any demo you want without any issue. Enjoy our theme!', 'fdth' ) ?></p>
                </div>
                <div class="fdth-setup-action">
                    <a class="fdth-button" href=""><?php echo esc_html__( 'Explore & Install Demos', 'fdth' ) ?></a>
                </div>
            </div>
            <div class="fdth-setup-error" >
                <div class="fdth-setup-header">
                    <svg width="83" height="74" viewBox="0 0 83 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.6116 58.3333L1.88372 57.3261H1.88372L3.6116 58.3333ZM79.3888 58.3333L81.1167 57.3261L79.3888 58.3333ZM49.0779 6.33333L47.3501 7.34052L49.0779 6.33333ZM33.9225 6.33333L35.6504 7.34052L33.9225 6.33333ZM43.5002 28V26H39.5002V28H43.5002ZM39.5002 36.6667V38.6667H43.5002V36.6667H39.5002ZM41.5002 52H39.5002V56H41.5002V52ZM41.544 56H43.544V52H41.544V56ZM47.3501 7.34052L77.6609 59.3405L81.1167 57.3261L50.8058 5.32615L47.3501 7.34052ZM71.8111 69.3333H11.1893V73.3333H71.8111V69.3333ZM5.33948 59.3405L35.6504 7.34052L32.1946 5.32615L1.88372 57.3261L5.33948 59.3405ZM11.1893 69.3333C5.96346 69.3333 2.76556 63.7562 5.33948 59.3405L1.88372 57.3261C-2.27811 64.466 2.94368 73.3333 11.1893 73.3333V69.3333ZM77.6609 59.3405C80.2349 63.7562 77.037 69.3333 71.8111 69.3333V73.3333C80.0567 73.3333 85.2785 64.466 81.1167 57.3261L77.6609 59.3405ZM50.8058 5.32615C46.6663 -1.77538 36.3341 -1.77538 32.1946 5.32615L35.6504 7.34052C38.2466 2.88649 44.7538 2.88649 47.3501 7.34052L50.8058 5.32615ZM39.5002 28V36.6667H43.5002V28H39.5002ZM41.5002 56H41.544V52H41.5002V56Z" fill="#FF3131"/>
                    </svg>


                    <h3><?php echo esc_html__( 'Setup Failed', 'fdth' ) ?></h3>
                    <p><?php echo esc_html__( 'There might be some issues while setting up the theme. You can try setting up again.', 'fdth' ) ?></p>
                </div>
                <div class="fdth-setup-action">
                    <a class="fdth-button" href=""><?php echo esc_html__( 'Try Theme Setup Again', 'fdth' ) ?></a>
                </div>
                <div class="fdth-info">
                    <p><?php echo esc_html__( 'If you think it’s a theme issue, kindly contact our support so that we can check and provide you a solution.', 'fdth' ) ?></p>
                    <a href=""><?php echo esc_html__( 'Contact Our Support', 'fdth' ) ?></a>
                </div>
            </div>

        </div>
    </div>
<?php
$admin_notices .= ob_get_clean();

    echo $admin_notices;
}

if ( !get_option( 'fdth_demo_disable', false ) && fdth_tala_check() ) {
    add_filter( 'admin_notices', 'fdth_plugin_intro_text' );
}

function fdth_demo_disable( $selected_import ) {
    if ( 'Initial Setup' == $selected_import['import_file_name'] ) {
        update_option( 'fdth_demo_disable', true );
    }
}

add_action( 'pt-ocdi/after_import', 'fdth_demo_disable' );

function fdth_tala() {
    $admin_notices = '';
    $screen        = get_current_screen();

    // if ( $screen->base !== 'appearance_page_one-click-demo-import' ) {
    //     return;
    // }
    $tala_key = get_option( 'fdth_tala_key', false ) ? get_option( 'fdth_tala_key', false ) : '';

    $is_activated_class = fdth_tala_check() ? 'tala-activated' : 'tala-deactivated';
    ob_start();
    ?>
    <div class="fdth-theme-setup-popup-wrap fdth-tala <?php echo esc_attr( $is_activated_class ); ?>">
        <div class="fdth-theme-setup-popup">
            <div class="fdth-setup-welcome">
                <div class="fdth-setup-header">
                    <h3><?php echo esc_html__( 'Get Full Access', 'fdth' ) ?></h3>
                    <p><?php echo esc_html__( 'Thanks for using our theme. To access the full feature of this theme, you need to activate using your Envato Purchase key.', 'fdth' ) ?></p>
                </div>
                <div class="fdth-tala-content">
                    <h3><?php echo esc_html__( 'Activate Theme', 'fdth' ) ?></h3>
                    <p><?php echo __( 'Go to Envato > Downloads & get your purchase key', 'fdth' ) ?></p>
                    <div class="fdth-tala-action">
                        <form action="#" class="fdth-tala-form">
                            <input name="tala_key" placeholder="<?php esc_html_e( 'Add purchase key', 'fdth' )?>" value="<?php echo $tala_key ?>" >
                            <button class="fdth-check-tala fdth-button" ><?php echo esc_html__( 'Activate', 'fdth' ) ?></button>
                        </form>
                    </div>
                    <div class="fdth-tala-footer">
                    <h3><?php echo esc_html__( 'How to find purchase key', 'fdth' ) ?></h3>
                <?php printf( __( '<p>Step 1: Go to <strong>“Downloads”</strong> from your Envato Menu.</p>

<p>Step 2: Find our theme and then you’ll see a green button called <strong>“Download”</strong> beside it.</p>

<p>Step 3: Click on the <strong>“Download”</strong> button. You’ll see options like the below image. Select and download any of that. You’ll find purchase key on the downloaded file.</p>
', 'acea' ) );?>
<img src="https://coderliftbd.com/demos/wp/acea/previews/envato-purchase-key.png" />
</div>
                </div>


            </div>

            <div class="fdth-setup-success" >
                <div class="fdth-setup-header">
                    <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="26.5" cy="26.5" r="26.5" fill="#15E280"/>
                        <path d="M18.1099 28.61L22.5502 33.0503L33.6509 21.9496" stroke="white" stroke-width="3" stroke-linecap="square" stroke-linejoin="round"/>
                    </svg>

                    <h3><?php echo esc_html__( 'Theme is activated', 'fdth' ) ?></h3>
                    <p><?php echo esc_html__( 'You have successfully activated this theme', 'fdth' ) ?></p>
                </div>
                <div class="fdth-setup-action">
                    <a class="fdth-button fdth-tala-deactivate" href=""><?php echo esc_html__( 'Deactivate', 'fdth' ) ?></a>
                    </br>
                    <a class="fdth-button" href="<?php echo admin_url( 'themes.php?page=one-click-demo-import' ) ?>"><?php echo esc_html__( 'Start Importing Demos', 'fdth' ) ?></a>

                    <!-- <h3><?php echo esc_html__( 'How to use our theme', 'fdth' ) ?></h3>
                    <iframe width="1280" height="720" src="https://www.youtube.com/embed/A1buvlF5r-M" title="How to Import Demo Data on Shadepro WordPress Theme" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>


            </div>
            <div class="fdth-setup-error" >
                <div class="fdth-setup-header">
                    <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="26.5" cy="26.5" r="26.5" fill="#FF3131"/>
                        <path d="M16.2671 31.9402L15.401 31.4402H15.401L16.2671 31.9402ZM35.4941 31.9402L36.3601 31.4402L35.4941 31.9402ZM27.8033 18.6194L26.9373 19.1194L27.8033 18.6194ZM23.9579 18.6194L24.8239 19.1194L23.9579 18.6194ZM26.8806 24.1697V23.1697H24.8806V24.1697H26.8806ZM24.8806 26.3899V27.3899H26.8806V26.3899H24.8806ZM25.8806 29.8302H24.8806V31.8302H25.8806V29.8302ZM25.8917 31.8302H26.8917V29.8302H25.8917V31.8302ZM26.9373 19.1194L34.6281 32.4402L36.3601 31.4402L28.6693 18.1194L26.9373 19.1194ZM33.5714 34.2705H18.1898V36.2705H33.5714V34.2705ZM17.1331 32.4402L24.8239 19.1194L23.0919 18.1194L15.401 31.4402L17.1331 32.4402ZM18.1898 34.2705C17.2505 34.2705 16.6635 33.2537 17.1331 32.4402L15.401 31.4402C14.1616 33.587 15.7109 36.2705 18.1898 36.2705V34.2705ZM34.6281 32.4402C35.0977 33.2537 34.5107 34.2705 33.5714 34.2705V36.2705C36.0503 36.2705 37.5996 33.587 36.3601 31.4402L34.6281 32.4402ZM28.6693 18.1194C27.4299 15.9726 24.3313 15.9726 23.0919 18.1194L24.8239 19.1194C25.2935 18.3059 26.4676 18.3059 26.9373 19.1194L28.6693 18.1194ZM24.8806 24.1697V26.3899H26.8806V24.1697H24.8806ZM25.8806 31.8302H25.8917V29.8302H25.8806V31.8302Z" fill="white"/>
                    </svg>
                    <h3><?php echo esc_html__( 'Purchase key is not valid', 'fdth' ) ?></h3>
                    <p><?php echo esc_html__( 'The key you have provided is not valid or doesn’t exists.', 'fdth' ) ?></p>
                </div>
                <div class="fdth-setup-action">
                    <a class="fdth-button" href=""><?php echo esc_html__( 'Try Again', 'fdth' ) ?></a>

                </div>


            </div>

        </div>
    </div>
<?php
$admin_notices .= ob_get_clean();

    echo $admin_notices;
}

// if ( !get_option( 'fdth_tala_disable', false ) ) {
//     add_filter( 'admin_notices', 'fdth_tala' );
// }

function fdth_tala_ajax() {
    check_ajax_referer( 'fdth--nonce', 'security' );
    $key = isset( $_POST['tala'] ) && !empty( $_POST['tala'] ) ? $_POST['tala'] : '';

    if ( $key ) {
        $is_valid = fdth_check_tala( $key );
        if ( true === $is_valid ) {
            update_option( 'fdth_tala_key', $key );
            update_option( 'fdth_tala_status', 'activated' );
            fdth_get_demo_files();

        }
        wp_send_json( fdth_check_tala( $key ) );
    }

    wp_send_json( false );
}

add_action( 'wp_ajax_fdth_tala_ajax', 'fdth_tala_ajax' );

function fdth_tala_deactivate() {
    check_ajax_referer( 'fdth--nonce', 'security' );

    fdth_check_tala_deactivate( get_option( 'fdth_tala_key', '' ) );
    delete_option( 'fdth_tala_key' );
    delete_option( 'fdth_tala_status' );
    delete_option( 'fdth_demo_files' );

    wp_send_json( true );

}

add_action( 'wp_ajax_fdth_tala_deactivate', 'fdth_tala_deactivate' );

function fdth_check_tala( $key ) {

    if ( !empty( $key ) ) {

        $code  = $key;
        $theme = wp_get_theme();
        // Surrounding whitespace can cause a 404 error, so trim it first
        $code = trim( $code );
        // Make sure the code looks valid before sending it to Envato
        if ( !preg_match( "/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code ) ) {
            $error = false;
        } else {
            $home_url = urlencode( home_url() );
            // Build the request
            $url = "https://tala.coderliftbd.com/wp-json/fdl/v2/envato?key={$code}&url={$home_url}&type=themecheck&theme=" . $theme->get( 'Name' );

            $response = wp_remote_get( $url );
            // $response_code = wp_remote_retrieve_response_code( $response );
            $response_body = wp_remote_retrieve_body( $response );
            $response      = json_decode( $response_body );
            // Send the request with warnings supressed
            return $response === true;

        }

    }
    return false;
}

function fdth_get_demo_files() {

    $key = get_option( 'fdth_tala_key', false );

    if ( !empty( $key ) ) {

        $code  = $key;
        $theme = wp_get_theme();
        // Surrounding whitespace can cause a 404 error, so trim it first
        $code = trim( $code );
        // Make sure the code looks valid before sending it to Envato
        if ( !preg_match( "/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code ) ) {
            $error = false;
        } else {
            $home_url = urlencode( home_url() );
            // Build the request
            $url = "https://tala.coderliftbd.com/wp-json/fdl/v2/envato?key={$code}&url={$home_url}&type=democheck&theme=" . $theme->get( 'Name' );

            $response = wp_remote_get( $url );
            // $response_code = wp_remote_retrieve_response_code( $response );
            $response_body = wp_remote_retrieve_body( $response );
            $response_body = json_decode( $response_body );
            // Send the request with warnings supressed

            return update_option( 'fdth_demo_files', json_decode( $response_body, true ) );

        }

    }
    return false;
}

function fdth_check_tala_deactivate( $key ) {

    if ( !empty( $key ) ) {

        $code  = $key;
        $theme = wp_get_theme();
        // Surrounding whitespace can cause a 404 error, so trim it first
        $code = trim( $code );
        // Make sure the code looks valid before sending it to Envato
        if ( !preg_match( "/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code ) ) {
            $error = false;
        } else {
            $home_url = urlencode( home_url() );
            // Build the request
            $url = "https://tala.coderliftbd.com/wp-json/fdl/v2/envato?key={$code}&url={$home_url}&type=themeDeactivate&theme=" . $theme->get( 'Name' );

            $response = wp_remote_get( $url );
            // $response_code = wp_remote_retrieve_response_code( $response );
            $response_body = wp_remote_retrieve_body( $response );
            $response      = json_decode( $response_body );
            // Send the request with warnings supressed
            return $response === true;

        }

    }
    return false;
}

function fdth_tala_check() {
    $license_activated = get_option( 'fdth_tala_status', false ) == 'activated' ? true : false;

    return $license_activated;
}

function fdth_add_menu( $parent_slug = '' ) {
    if ( !is_admin() ) {
        return;
    }
    global $submenu;
    if ( !empty( $parent_slug ) && function_exists( 'add_submenu_page' ) ) {
        add_submenu_page( $parent_slug, __( 'Theme Activation', 'fdth' ), __( 'Theme Activation', 'fdth' ), 'manage_options', 'fdth-activation', 'fdth_tala' );
    } else {
        add_menu_page( __( 'Theme Activation', 'fdth' ), __( 'Theme Activation', 'fdth' ), 'manage_options', 'fdth-activation', 'fdth_tala', '' );
    }

    $submenu['Acea'][] = array( 'Import Demo Data', 'manage_options', admin_url( 'themes.php?page=one-click-demo-import' ) );

}

function fdth_init() {
    if ( !is_admin() ) {
        return;
    }
    fdth_add_menu( 'Acea' );

}
add_action( 'admin_menu', 'fdth_init' );

// add_action( 'init', 'fdth_init' );

function fdth_redirect_ocdi() {
    // $screen = get_current_screen();
    if ( isset( $_GET['page'] ) && $_GET['page'] == 'one-click-demo-import' ) {
        wp_safe_redirect( admin_url( 'admin.php?page=fdth-activation' ) );
        die();
    }
}
if ( !fdth_tala_check() ) {
    add_action( 'init', 'fdth_redirect_ocdi' );
}

$notice = Notice::get(
    'aceaasdfadsf', // Plugin slug on wp.org (eg: hello-dolly).
    'Acea', // Plugin name (eg: Hello Dolly).
    [
        'days' => 3,
    ]
);

// $notice->render();
