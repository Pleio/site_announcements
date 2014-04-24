<?php
/**
 * edit an announcement
 */

$guid = (int) get_input("guid");
$entity = false;
if (!empty($guid)) {
	$entity = get_entity($guid);
	if (empty($entity) || !elgg_instanceof($entity, "object", SITE_ANNOUNCEMENT_SUBTYPE)) {
		unset($entity);
	}
}

echo elgg_view_form("site_announcements/edit", array("id" => "site-announcements-edit-form"), array("entity" => $entity));