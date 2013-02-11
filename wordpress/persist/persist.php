<?php
/**
 * WordPress persist API
 *
 */

function get_persist( $persist_name ) {
	global $wpdb;

	$persist = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}persist WHERE persist_name = '%s' LIMIT 1", $persist_name), ARRAY_A);
	if (!$persist) return false;

	if (strtotime($persist['persist_expire']) < time()){
		delete_persist($persist_name);
		return false;
	}	

	$value = $persist['persist_value'];
	if ($persist['serialized']){
		$value = unserialize($value);
	}

	return $value;
}

function set_persist( $persist_name, $value, $expiration = 0, $group = '' ) {
	global $wpdb;

	delete_persist($persist_name);

	$serialized = 0;
	if (is_array($value)){
		$value = serialize($value);
		$serialized = 1;
	}

	$expiration = date('Y-m-d H:i:s', time() + intval($expiration));

	$insert = array(
		'persist_name' => $persist_name,
		'persist_group' => $group,
		'persist_value' => $value,
		'persist_expire' => $expiration,
		'serialized' => $serialized
	);

	$result = $wpdb->insert( "{$wpdb->prefix}persist", $insert, array('%s', '%s', '%s', '%s', '%d'));
	
	return $result;
}

function delete_persist( $persist_name ) {
	global $wpdb;

	$result = $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}persist WHERE persist_name = '%s' LIMIT 1", $persist_name));
	
	return $result;
}

function delete_persist_group( $group ) {
	global $wpdb;

	$result = $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}persist WHERE persist_group = '%s' LIMIT 1", $group));
	
	return $result;
}

?>
