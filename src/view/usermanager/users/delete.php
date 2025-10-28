<?php

require_once '../../core/db.php';



	$syscategory = $_POST['del'];
	$member_id = $_POST['member_id'];
	
		
			if($syscategory != 14){

		$del_a = "DELETE FROM `users` WHERE `username` = '$member_id'";
			if(mysqli_query($connection, $del_a)){
		  

			$del_b = "DELETE FROM `staff_record` WHERE `user_id` = '$member_id'";
				if(mysqli_query($connection, $del_b)){

				echo "User along with his/her staff records and payroll deleted successfully";
			  
			}
	
		}

		

			}/*else{

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

		
			}*/

		
		


		

