<?php
/*
Plugin Name: Acea Addons For Elementor
Plugin URI: https://coderlifts.com/
Description: The Acea is an Elementor helping plugin that will make your designing work easier.
Our specialities are custom CSS, Nested section, Creative Buttons.
Version: 1.0.6
Author: Coderlift
Author URI: https://coderlifts.com/
License: GPLv2 or later
Text Domain: acea-addons
 */
if (!defined('ABSPATH')) {
	exit;
}
//Set plugin version constant.
define('ACEA_VERSION', '1.0.3');
/* Set constant path to the plugin directory. */
define('ACEA_WIDGET', trailingslashit(plugin_dir_path(__FILE__)));
// Plugin Function Folder Path
define('ACEA_WIDGET_INC', plugin_dir_path(__FILE__) . 'inc/');
// Plugin Extensions Folder Path
define('ACEA_WIDGET_EXTENSIONS', plugin_dir_path(__FILE__) . 'extensions/');
// Plugin Widget Folder Path
define('ACEA_WIDGET_DIR', plugin_dir_path(__FILE__) . 'widgets/');
// Assets Folder URL
define('ACEA_ASSETS_PUBLIC', plugins_url('assets/frontend/', __FILE__));
define('ACEA_ASSETS_ADMIN', plugins_url('assets/admin/', __FILE__));
// Assets Folder URL
define('ACEA_ASSETS_VERDOR', plugins_url('assets/vendor', __FILE__));
require_once(ACEA_WIDGET_INC . 'elementor-extender.php');
require_once(ACEA_WIDGET_INC . 'admin-column.php');
require_once(ACEA_WIDGET_INC . 'nav-metabox.php');
require_once(ACEA_WIDGET_INC . 'meta-box.php');
require_once(ACEA_WIDGET_INC . 'job-meta-box.php');
require_once(ACEA_WIDGET_INC . 'service-meta-box.php');
require_once(ACEA_WIDGET_INC . 'portfolio-meta-box.php');
// require_once(ACEA_WIDGET_INC . 'acf.php');
require_once(ACEA_WIDGET_INC . 'customizer.php');
require_once(ACEA_WIDGET_INC . 'helper-functions.php');
require_once(ACEA_WIDGET_INC . 'custom-post-types.php');
require_once(ACEA_WIDGET_INC . 'Classes/Acea_Nav_Walker.php');
require_once(ACEA_WIDGET . 'base.php');
require_once(ACEA_WIDGET . 'traits/acea-button-murkup.php');
require_once(ACEA_WIDGET . 'traits/acea-inline-button-murkup.php');
require_once(ACEA_WIDGET_INC . 'Classes/cross.php');
/**
 * Custom Widgets
 */
require_once(ACEA_WIDGET_INC . 'widgets/class-acea-contacts.php');
require_once(ACEA_WIDGET_INC . 'widgets/class-acea-about.php');
require_once(ACEA_WIDGET_INC . 'widgets/class-acea-recentpost.php');
/*
* Import themify icons list.
*/
require_once(ACEA_WIDGET_INC . 'widgets/themify-icons.php');
require_once(ACEA_WIDGET_INC . 'modules/svg-support/svg-support.php');

