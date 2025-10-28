<?php
require_once '../../core/init.php';
$record = Db::getInstance();

$month_id = $_POST['month_id'];
$amount = $_POST['amount'];
$note = $_POST['note'];

try {
    if (isset($month_id)) {
        $sql = "UPDATE budget_month SET amount = ?, note = ? WHERE id = ?";
        Db::getInstance()->query($sql, array($amount, $note, $month_id));
        echo 'success';
        exit();
    } else {
        
        echo 'error: Missing month ID';
        exit();
    }
} catch (Exception $e) {
    
    echo 'error: ' . htmlspecialchars($e->getMessage());
    exit();
}
?>