<?php
/*
Plugin Name: TheCartPress French Setup
Plugin URI: http://thecartpress.com
Description: TheCartPress French Setup
Version: 1.2
Author: TheCartPress team
Author URI: http://thecartpress.com
License: GPL
Parent: thecartpress
*/

/**
 * This file is part of TheCartPress-FrenchSetup.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define( 'TCP_FRENCH_FOLDER', dirname( __FILE__ ) . '/languages/' );

class TCPFrenchSetup {

	function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( &$this, 'admin_menu' ), 99 );
			//add_filter( 'mu_dropdown_languages', array( &$this, 'mu_dropdown_languages' ) , 10, 3 );
		}
		add_filter( 'locale', array( &$this, 'locale' ) );
		add_filter( 'load_textdomain_mofile', array( $this, 'load_textdomain_mofile' ), 10, 2 );
		//add_action( 'tcp_states_loading', array( $this, 'tcp_states_loading' ) );
	}

	function locale( $locale ) {
		return 'fr_FR';
	}

	/*function mu_dropdown_languages( $output, $lang_files, $current ) {
		$out = '<option value="es_ES"' . selected( $current, 'es_ES', false ) . '>Español</option>';
		return $out . $output;
	}*/

	function admin_menu() {
		global $thecartpress;
		if ( $thecartpress ) {
			$base = $thecartpress->get_base_tools();
			add_submenu_page( $base, 'Français', 'Français', 'tcp_edit_settings', dirname( __FILE__ ) . '/admin/france-configuration.php' );
		}
	}

	function load_textdomain_mofile( $moFile, $domain ) {
		if ( 'tcp' == substr( $domain, 0, 3 ) ) {
			$wplang = get_option( 'WPLANG', get_locale() );
			if ( strlen( $wplang ) == 0 ) $wplang = get_locale();
			$is_france = 'fr_' == substr( $wplang, 0, 3 );
			if ( ! $is_france && function_exists( 'tcp_get_current_language_iso' ) ) $is_france = 'fr' == tcp_get_current_language_iso();
			if ( $is_france ) {
				$new_mofile = TCP_FRENCH_FOLDER . $domain . '-' . $wplang . '.mo';
				if ( is_readable( $new_mofile ) ) return $new_mofile;
			}
		}
		return $moFile;
	}
}

new TCPFrenchSetup();
?>
