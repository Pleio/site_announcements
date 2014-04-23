<?php
/**
 * Overrule the default icon view for this entity
 *
 * @uses $vars['entity'] the entity to view the icon of
 * @uses $vars['size'] the size of the icon to view
 */

$entity = elgg_extract("entity", $vars);

if (empty($entity) || !elgg_instanceof($entity, "object", "site_announcement")) {
	return;
}

if (!empty($entity->announcement_type)) {
	echo elgg_view_icon($entity->announcement_type, "site-announcements-icon");
} else {
	echo elgg_view("output/img", array("src" => "_graphics/spacer.gif"));
}