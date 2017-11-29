<?php
/**
 * groups-vc.php
*
* Copyright (c) 2017 Antonio Blanco (eggemplo)
*
* This code is released under the GNU General Public License.
* See COPYRIGHT.txt and LICENSE.txt.
*
* This code is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* This header and all notices must be kept intact.
*
* @author Antonio Blanco
* @package groups-vc
* @since groups-vc 1.0.0
*
* Plugin Name: Groups Visual Composer
* Plugin URI: http://www.itthinx.com/plugins/groups
* Description: Integrates Groups with Visual Composer
* Version: 1.0.0
* Author: eggemplo
* Author URI: http://www.eggemplo.com
* Donate-Link: http://www.eggemplo.com
* Text Domain: groups-vc
* Domain Path: /languages
* License: GPLv3
*/
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
class GroupsVC_Plugin {

	private static $notices = array();

	public static function init() {

		add_action( 'init', array( __CLASS__, 'wp_init' ) );

	}

	public static function wp_init() {
		global $wpdb;

		if ( function_exists( 'vc_add_param' ) ) {
			$group_table = _groups_get_tablename( 'group' );
			$_groups = $wpdb->get_results( "SELECT * FROM $group_table" );
			$group_ids = array( '-' => '' );
			foreach( $_groups as $_group ) {
				$group_ids[$_group->name] = $_group->group_id;
			}

			vc_add_param("vc_row", array(
					"type" => "dropdown",
					"group" => "Groups",
					"class" => "",
					"heading" => "Group restriction",
					"param_name" => "ix_groups",
					"value" => $group_ids
			));
		}
	}
}
GroupsVC_Plugin::init();
