<?php
/**
 * Create / edit a site announcement
 *
 * @uses $vars['entity'] for the edit of an existing announcement
 */

elgg_push_context("site_announcements_edit");

$entity = elgg_extract("entity", $vars);

$hour_options = range(0, 23);
$mins_options = range(0, 59);
$type_options = array(
	"" => elgg_echo("site_announcements:type:general"),
	"info" => elgg_echo("site_announcements:type:info"),
	"attention" => elgg_echo("site_announcements:type:warning"),
);

$description = "";
if (!empty($entity)) {
	echo elgg_view("input/hidden", array("name" => "guid", "value" => $entity->getGUID()));
	
	$description = elgg_get_sticky_value("site_announcement_edit", "description", $entity->description);
	
	$startdate = elgg_get_sticky_value("site_announcement_edit", "startdate", $entity->startdate);
	$enddate = elgg_get_sticky_value("site_announcement_edit", "enddate", $entity->enddate);
	
	$announcement_type = elgg_get_sticky_value("site_announcement_edit", "announcement_type", $entity->announcement_type);
	$access_id = elgg_get_sticky_value("site_announcement_edit", "access_id", $entity->access_id);
} else {
	$startdate = time();
	$enddate = time() + (7 * 24 * 60 * 60);
	
	$announcement_type = elgg_get_sticky_value("site_announcement_edit", "announcement_type");
	$access_id = elgg_get_sticky_value("site_announcement_edit", "access_id", get_default_access());
}

$starthour = elgg_get_sticky_value("site_announcement_edit", "starthour", date("G", $startdate));
$startmins = elgg_get_sticky_value("site_announcement_edit", "startmins", date("i", $startdate));

$endhour = elgg_get_sticky_value("site_announcement_edit", "endhour", date("G", $enddate));
$endmins = elgg_get_sticky_value("site_announcement_edit", "endmins", date("i", $enddate));


// clear sticky form
elgg_clear_sticky_form("site_announcement_edit");

echo "<div>";
echo "<label for='site-announcements-edit-description'>" . elgg_echo("site_announcements:edit:text") . "</label>";
echo elgg_view("input/longtext", array("name" => "description", "value" => $description, "id" => "site-announcements-edit-description"));
echo "</div>";

echo "<div>";
echo "<label for='startdate'>" . elgg_echo("site_announcements:edit:startdate") . "</label>";
echo elgg_view("input/date", array("name" => "startdate", "value" => $startdate, "timestamp" => true, "class" => "mhs"));
echo "@";
echo elgg_view("input/dropdown", array("name" => "starthour", "value" => $starthour, "options" => $hour_options, "class" => "mls"));
echo ":";
echo elgg_view("input/dropdown", array("name" => "startmins", "value" => $startmins, "options" => $mins_options, "class" => "mls"));
echo "</div>";

echo "<div>";
echo "<label for='enddate'>" . elgg_echo("site_announcements:edit:enddate") . "</label>";
echo elgg_view("input/date", array("name" => "enddate", "value" => $enddate, "timestamp" => true, "class" => "mhs"));
echo "@";
echo elgg_view("input/dropdown", array("name" => "endhour", "value" => $endhour, "options" => $hour_options, "class" => "mls"));
echo ":";
echo elgg_view("input/dropdown", array("name" => "endmins", "value" => $endmins, "options" => $mins_options, "class" => "mls"));
echo "</div>";

echo "<div>";
echo "<label for='site-announcements-type'>" . elgg_echo("site_announcements:type") . "<label>";
echo elgg_view("input/dropdown", array("name" => "announcement_type", "value" => $announcement_type, "id" => "site-announcements-type", "options_values" => $type_options, "class" => "mls"));
echo "</div>";

echo "<div>";
echo "<label for='site-announcements-access-id'>" . elgg_echo("access") . "<label>";
echo elgg_view("input/access", array("name" => "access_id", "value" => $access_id, "id" => "site-announcements-access-id", "class" => "mls"));
echo "</div>";

echo "<div class='elgg-foot'>";
echo elgg_view("input/submit", array("value" => elgg_echo("save")));
echo "</div>";

elgg_pop_context();
