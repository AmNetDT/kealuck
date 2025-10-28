<?php

require_once '../core/db.php';

	
	$table = $_POST['table'];
	$id = $_POST['_id'];
	
		$del = "DELETE FROM `$table` WHERE `id` = ?";
		$query = $connection->prepare($del, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		if ($query->execute(array($id))) {
			echo "Successfully Deleted";
		} else {
			echo "Failed to Delete";
		}


		

//Universal delete query