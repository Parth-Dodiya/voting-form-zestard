<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://the-gujarati.free.nf
 * @since      1.0.0
 *
 * @package    Voting_Form_Zestard
 * @subpackage Voting_Form_Zestard/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Voting_Form_Zestard
 * @subpackage Voting_Form_Zestard/includes
 * @author     Parth Dodiya <parthdodiya.dodiya@gmail.com>
 */
class Voting_Form_Zestard_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'voting-form-zestard',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
