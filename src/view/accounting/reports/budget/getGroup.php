<?php
require_once '../../core/init.php';

$category_id = 0;

if($_REQUEST['itemCategory']) {

  $category_id = $_REQUEST['itemCategory'];

  if($category_id > 0 && $category_id != null){

    $department = Db::getInstance()->query("SELECT * FROM `chart_of_accounts_group` WHERE `accounts_type_id` = $category_id ORDER BY id ASC");

    if (!$department->count()) {

      echo "<option value=''>No data to be displayed</option>";

    } else {

      foreach ($department->results() as $department) {

        echo "<option value='".$department->id."'>".$department->title."</option>";

      }
    }
  }
}
