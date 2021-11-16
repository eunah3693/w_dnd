<?php

$conn = mysqli_connect('127.0.0.1', 'root', '') or die('DB ERROR: 000');
mysqli_select_db($conn, 'dndlifecare') or die('DB ERROR: 001');
mysqli_set_charset($conn, 'utf8mb4');

// Load JSON Data
$_JSON = json_decode(file_get_contents("php://input"), 1);
// Table Structure
$device_tbl = array("uuid" => NULL, "fcm" => NULL, "os" => NULL, "user_id" => NULL);
$ret = insertOrUpdate($conn, $device_tbl, $_JSON);

// Rreturn JSON
die(json_encode($ret, 384));


function insertOrUpdate($conn, $table, $data) {
	// Mapping
	foreach ($table as $key => $val)
		$table[$key] = ($msd = $data[$key] ?? null) === null ? null : addslashes($msd);
		
	// Exception Remove
		foreach ($table as $key => $val)
		if($val === null)
			unset($table[$key]);
			
	// Make SQL Data
	$msd = array('field'=>array(), 'value'=>array());
	foreach ($table as $key => $val) {
		array_push($msd['field'], "`{$key}`");
		array_push($msd['value'], preg_match("/^([A-Z_]+\(.*?\))|NULL$/", $val) ? $val : "'$val'");
	}
	$msd['field'] = implode(', ', $msd['field']); $msd['value'] = implode(', ', $msd['value']);
	
	// Make SQL
	$sql = "INSERT INTO device_tbl({$msd['field']}) VALUES ({$msd['value']}) ON DUPLICATE KEY UPDATE ";
	$sql .= preg_replace("/([^, ]+)/", "$1 = VALUES($1)", $msd['field']);
	
	$ret['result'] = mysqli_query($conn, $sql);
	$ret['index'] = mysqli_insert_id($conn);
	$ret['affected'] = mysqli_affected_rows($conn);
	$ret['sql'] = $sql;
	
	if($ret['index'] > 0) {
		$sql = "SELECT {$msd['field']} FROM device_tbl WHERE idx = {$ret['index']};";
		$res = mysqli_query($conn, $sql);
		$ret['data'] = mysqli_fetch_all($res, MYSQLI_ASSOC)[0];
	}
	
	return $ret;
}