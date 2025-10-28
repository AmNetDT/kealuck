<?php

include('../../core/db.php');

If(empty($_POST['matric_no']) || empty($_POST['amount']) || empty($_POST['payment_type']) || empty($_POST['paid'])){

    echo "All field required";
 
}else{

$member_id = $_POST['member_id'];
$matric_no = $_POST['matric_no'];
$amount = $_POST['amount'];
$payment_type = $_POST['payment_type'];
$paid = $_POST['paid'];
$balance = $_POST['balance'];
$remark = $_POST['remark'];
$added_by = $_POST['added_by'];


$sql = $connection->prepare("INSERT INTO `payment`(`member_id`, `matric_no`, `payment_type`, `amount`, `paid`, `balance`, `remark`, `added_by`) VALUES (?,?,?,?,?,?,?,?)");
if ($sql->execute(array($member_id, $matric_no, $payment_type, $amount, $paid, $balance, $remark, $added_by))) {
    echo "Successfully added a new Payment";
} else {
    echo "Failed to add a new Payment";
}
}
// $sql = "UPDATE `payment` SET `matric_no`=?,`amount`=?,`payment_type`=?,`paid`=?,`balance`=?,`remark`=?,`added_by`=? WHERE id=$id";
// $sqli = $connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
// if ($sqli->execute(array($matric_no, $amount, $payment_type, $paid, $balance, $remark, $added_by))) {
//     echo "Payment Successfully";
// } else {
//     echo "Failed to update  Location";
// }
