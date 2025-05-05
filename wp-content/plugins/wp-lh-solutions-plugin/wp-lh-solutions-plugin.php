<?php
/**
 * Lh Solutions Plugin
 *
 * @package           LH Wordpress plugins
 * @author            LEMON HIVE
 * @copyright         2019 
 * @license           Proprietary
 *
 * @wordpress-plugin
 * Plugin Name:       Lh Solutions Plugin
 * Plugin URI:        
 * Description:       Handle all custom necessary hooks, filters, and changes needed by the project.
 * Version:           1.0.2
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            LEMON HIVE
 * Author URI:        https://lemonhive.com/
 * Text Domain:       wp-lh-solutions-plugin
 * License:           Proprietary
 * License URI:       
 */

/**
 * URLs and paths
 */
define('LH_PLUGIN_VERSION', '1.0.2');
define('LH_PLUGIN_SLUG',    'wp-lh-solutions-plugin');
define('LH_PLUGIN_PATH',    plugin_dir_path(__FILE__));
define('LH_PLUGIN_FILE',    __FILE__);
define('LH_PLUGIN_URL',     plugins_url('/', __FILE__));
define('LH_ASSETS_PATH',    LH_PLUGIN_PATH . '/assets/dist' );
define('LH_ASSETS_URL',     plugins_url('assets/dist/', __FILE__));
define('LH_LOGO_SVG',       '<svg version="1.1" viewBox="-10 -10 71 70" xmlns="http://www.w3.org/2000/svg" style="background-color:#000"><defs><linearGradient id="a" x1="48.792%" x2="51.101%" y1="3.5629%" y2="91.647%"><stop stop-color="#FF5830" offset="0"/><stop stop-color="#FF1A57" offset="1"/></linearGradient></defs><g fill="none" fill-rule="evenodd"><g transform="translate(0)" fill-rule="nonzero"><path id="b" d="m45.402 49.768c3.335 0 4.6775-1.9 4.6775-4.355 0-2.825-1.7125-4.25-4.585-4.25-3.475 0-4.725 2.0375-4.725 4.3075 0 1.935 0.88 4.2975 4.6325 4.2975z" fill="url(#a)"/><polygon points="37.758 18.155 24.215 18.155 24.215 19.76 29.818 19.76 14.475 32.51 14.475 0 14.452 0 14.452 0 0 0 0 1.605 2.15 1.605 2.15 48.162 0 48.162 0 49.768 16.625 49.768 16.625 48.162 14.475 48.162 14.475 34.445 15.828 33.322 23.055 48.162 20.908 48.162 20.908 49.768 38.188 49.768 38.188 48.162 36.035 48.162 24.7 25.95 32.148 19.76 37.758 19.76" fill="#fff"/></g></g></svg>');

require_once('src/alias_functions.php');
// require_once('vendor/autoload.php');
require_once('src/autoload.php');

new \LH\Setup();