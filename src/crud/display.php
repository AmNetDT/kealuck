<?php
require_once '../../core/init.php';

$member_id = $_POST['username'];
$syscategory = $_POST['syscategory'];
$user = new User();
