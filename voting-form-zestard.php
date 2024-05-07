<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://the-gujarati.free.nf
 * @since             1.0.0
 * @package           Voting_Form_Zestard
 *
 * @wordpress-plugin
 * Plugin Name:       Voting Form
 * Plugin URI:        https://https://www.zestard.com/
 * Description:       Test plugin created for Zestard Technologies for Interview test purpose.
 * Version:           1.0.0
 * Author:            Parth Dodiya
 * Author URI:        https://the-gujarati.free.nf/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       voting-form-zestard
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VOTING_FORM_ZESTARD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-voting-form-zestard-activator.php
 */
function activate_voting_form_zestard() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-voting-form-zestard-activator.php';
	Voting_Form_Zestard_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-voting-form-zestard-deactivator.php
 */
function deactivate_voting_form_zestard() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-voting-form-zestard-deactivator.php';
	Voting_Form_Zestard_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_voting_form_zestard' );
register_deactivation_hook( __FILE__, 'deactivate_voting_form_zestard' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-voting-form-zestard.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_voting_form_zestard() {

	$plugin = new Voting_Form_Zestard();
	$plugin->run();

}
run_voting_form_zestard();
