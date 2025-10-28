<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {


            
               $ttitleSQL = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types order by title asc limit 1");
               foreach($ttitleSQL->results() as $ttitleRES)
               $ttitleRESOURCES = $ttitleRES->id;
                
                       if(!empty($_REQUEST['title'])) {
                        $title_cat  = $_REQUEST['title'];


                                        $sqlQuery = Db::getInstance()->query("SELECT a.*, b.title as category, a.category_id 
                                        FROM chart_of_accounts a
                                        Left Join chart_of_accounts_types b on a.category_id = b.id
                                        WHERE a.category_id = $title_cat");

                 if (!$sqlQuery->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        ?>
            <div class="table-responsive data-font" style="height:100%;">
   
                <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                    <thead>
                      <tr>
                        <th width="50">SN</th>
                        <th width="200">GL Code</th>
                        <th width="250">Description</th>
                        <th width="100" align="right">Debit</th>
                        <th width="100" align="right">Credit</th>
                      </tr>
                    </thead>
                    <tbody>

    

    <?php 
	$i = 1;
	foreach ($sqlQuery->results() as $department) { 

	?>
    
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $department->gl_code; ?></td>
                          <td><?php echo $department->description; ?></td>
                          <td align="right"><?php echo $department->debit; ?></td>
                          <td align="right"><?php echo $department->credit; ?></td>
                        </tr>
   
    <?php
             }
    ?>
    </tbody>
                </table>
            </div> 

  <?php
                      }
            }else{
                
                
                                        $sqlQuery = Db::getInstance()->query("SELECT a.*, b.title as category, a.category_id 
                                        FROM chart_of_accounts a
                                        Left Join chart_of_accounts_types b on a.category_id = b.id
                                        WHERE a.category_id = $ttitleRESOURCES");

                 if (!$sqlQuery->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        ?>
            <div class="table-responsive data-font" style="height:100%;">
   
                <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                    <thead>
                      <tr>
                        <th width="50">SN</th>
                        <th width="200">GL Code</th>
                        <th width="250">Description</th>
                        <th width="100" align="right">Debit</th>
                        <th width="100" align="right">Credit</th>
                      </tr>
                    </thead>
                    <tbody>

    

    <?php 
	$i = 1;
	foreach ($sqlQuery->results() as $department) { 

	?>
    
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $department->gl_code; ?></td>
                          <td><?php echo $department->description; ?></td>
                          <td align="right"><?php echo $department->debit; ?></td>
                          <td align="right"><?php echo $department->credit; ?></td>
                        </tr>
   
    <?php
             }
    ?>
    </tbody>
                </table>
            </div> 

  <?php
                      }  
            }
} else {
  $user->logout();
  Redirect::to('../../login/');
}

?>
 
