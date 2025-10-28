<?php

include('../../core/db.php');
	
$name = $_POST['name'];
$added_by = $_POST['added_by'];




$sql = $connection->prepare("INSERT INTO `payment_type`(`name`, `added_by`) VALUES (?,?)");
if($sql->execute(array($name, $added_by))){
	echo "Successfully added a new Payment Title";
}else{
	echo "Failed to add a new Payment Title";
}
