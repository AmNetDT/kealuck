<?php

require_once '../../core/db.php';

$ptypes_id = $_POST['id'];
$name = $_POST['name'];
$added_by = $_POST['added_by'];




$sql = "UPDATE `payment_type` SET `name`=?, `added_by`=? WHERE id=$ptypes_id";
$sqli = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
if($sqli->execute(array($name, $added_by))){
	echo "Successfully updated Payment Title";
}else{
	echo "Failed to update Payment Title";
}
