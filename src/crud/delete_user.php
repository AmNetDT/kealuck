<?php

require_once '../core/db.php';


	$syscategory = $_POST['syscategory'];
	$member_id = $_POST['member_id'];
	
		
			if($syscategory != 5){

		$del_user = "DELETE FROM `users` WHERE `username` = ?";
		$query = $connection->prepare($del_user);
		if($query->execute(array($member_id))){

			$del = "DELETE FROM `staff_record` WHERE `member_id` = ?";
			$query = $connection->prepare($del);
			if ($query->execute(array($member_id))) {

				echo "Staff deleted successfully";
			}
	
		}

		

			}else{

//Delete User Login details
	$del_user = "DELETE FROM `users` WHERE `username` = ?";
	$query = $connection->prepare($del_user);
	if ($query->execute(array($member_id))) {

//Delete User Student record
		$del = "DELETE FROM `students_record` WHERE `member_id` = ?";
		$query = $connection->prepare($del);
		if ($query->execute(array($member_id))) {

//Delete User Payment record			
			$del = "DELETE FROM `payment` WHERE `member_id` = ?";
			$query = $connection->prepare($del);
			if ($query->execute(array($member_id))) {

			echo "Student deleted successfully";
			}
		}
	}

		
			}

		
		


		

