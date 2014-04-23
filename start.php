<?php
/**
 * main file for this plugin
 */

require_once(dirname(__FILE__) . "/lib/hooks.php");

// register default Elgg events
elgg_register_event_handler("init", "system", "site_announcements_init");

/**
 * Gets called when the system initializes
 *
 * @return void
 */
function site_announcements_init() {
	
	// extend css
	elgg_extend_view("css/admin", "css/site_announcements/admin");
	
	// extends views
	elgg_extend_view("page/elements/body", "site_announcements/site", 400);
	
	// register plugin hooks
	elgg_register_plugin_hook_handler("register", "menu:page", "site_announcements_register_page_menu_hook");
	elgg_register_plugin_hook_handler("register", "menu:entity", "site_announcements_register_entity_menu_hook");
	
	// register actions
	elgg_register_action("site_announcements/edit", dirname(__FILE__) . "/actions/edit.php", "admin");
	elgg_register_action("site_announcements/delete", dirname(__FILE__) . "/actions/delete.php", "admin");
}