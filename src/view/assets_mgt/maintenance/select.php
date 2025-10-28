<?php

require_once '../../core/init.php';

$id = 0;

$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username_id = escape($user->data()->id);
    
   if(!empty($_REQUEST['member_id']) && !empty($_REQUEST['id'])) {
        
        $id         = $_REQUEST['id'];
        $member_id  = $_REQUEST['member_id'];
       
?>

       <div class="container-fluid">
               <?php

                    
                    $sqlQuery = Db::getInstance()->query("SELECT * FROM maintenance WHERE equipment_id = $member_id AND transaction_year= '$id'");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                            
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Code</th>
                                            <th>Entry Date</th>
                                            <th style="width:30%">Description</th>
                                            <th style="width:30%">Service Performed By</th>
                                            <th>Services Cost</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($sqlQuery->results() as $department) { 
                    
                    	?>
                        
                                            <tr>
                                              <td><?php echo $department->maintenance_code; ?></td>
                                              <td><?php echo $department->maintenance_date; ?></td>
                                              <td><?php echo $department->service_description; ?></td>
                                              <td><?php echo $department->service_performed_by; ?></td>
                                              <td><?php echo $department->services_cost; ?></td>
                                              <td>
                                     <?php
                                     
                            $maintenance_code = $department->maintenance_code;
                            $findincome = Db::getInstance()->query("SELECT * FROM maintenance a 
                            LEFT JOIN approval b ON a.maintenance_code = b.request_code 
                            WHERE a.maintenance_code ='$maintenance_code' AND b.approval_status = 'Approved'"); 
                            
                            
                             if($findincome->count() == 1){
                                 
                                echo $maintenance_code . ' Approved ';
                                
                             } else {
                                 
                                     
                                 ?>
                                 
                                  
                            <div class="btn-group dropleft">
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i style="font-size:12px" class="fa">&#xf142;</i>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item btn btn-default">
                                       &nbsp; Not yet approved
                                                 </button>
                              </div>
                              <?php
                                    
                                    $added = $user->added_by;
                                    if($username_id == $added){
                                        
                              ?>
                              <div class="dropdown-divider"></div>
                                        <div class="singledelete" lang='<?php echo $department->id; ?>' title='<?php echo $department->maintenance_code; ?>'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-trash"></i></button>
                    
                                        </div>
                                <?php
                                
                                    }
                                
                                ?>
                            </div>
                             
                                  <?php
                                  
                                 
                             } 
                                 ?>
                            </td>
                                            </tr>
                       
                        <?php
                                 }
                                         
                        ?>
                        </tbody>
                    </table>

             <?php
                                          }
             
             ?>
            </div>


  <?php
          
    }else{
        
         
        $member_id = $_POST['member_id'];
        $transact_ = $_POST['transact_'];

?>


        
       <div class="container-fluid">
                <?php

                  $user = Db::getInstance()->query("SELECT * FROM maintenance WHERE equipment_id = $member_id AND transaction_year= '$transact_'");

                  if (!$user->count()) {
                   ?>
                   <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                   <?php
                  } else {

                ?> 

                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Code</th>
                                            <th>Maintenance Date</th>
                                            <th style="width:30%">Description</th>
                                            <th style="width:30%">Service Performed By</th>
                                            <th>Services Cost</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	foreach ($user->results() as $department) { 
                    
                    	?>
                        
                                            <tr>
                                              <td><?php echo $department->maintenance_code; ?></td>
                                              <td><?php echo $department->maintenance_date; ?></td>
                                              <td><?php echo $department->service_description; ?></td>
                                              <td><?php echo $department->service_performed_by; ?></td>
                                              <td><?php echo $department->services_cost; ?></td>
                                              <td>
                                     <?php
                                     
                            $maintenance_cod = $department->maintenance_code;
                            $findincome = Db::getInstance()->query("SELECT * FROM equipmenttransaction a 
                            LEFT JOIN sales b ON a.id_code = b.sales_code 
                            WHERE a.id_code ='$maintenance_cod' AND b.approval_status = 'Approved'"); 
                            
                            
                             if($findincome->count() == 1){
                                 
                                echo $maintenance_cod . ' Approved ';
                                
                             } else {
                                 
                                     
                                 ?>
                                 
                                  
                            <div class="btn-group dropleft">
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i style="font-size:12px" class="fa">&#xf142;</i>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item btn btn-default">
                                       &nbsp; Not yet approved
                                                 </button>
                              </div>
                              <?php
                                    
                                    $added = $department->added_by;
                                    if($username_id == $added){
                                        
                              ?>
                              <div class="dropdown-divider"></div>
                                        <div class="singledelete" lang='<?php echo $department->id; ?>' title='<?php echo $department->maintenance_code; ?>'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-trash"></i></button>
                    
                                        </div>
                                <?php
                                
                                    }
                                
                                ?>
                            </div>
                             
                                  <?php
                                  
                                 
                             } 
                                 ?>
                            </td>
                                              
                                            </tr>
                       
                        <?php
                                 }
                                         
                        ?>
                        </tbody>
                    </table>
        <?php
                  }
                
                ?>
                            
                                </div>

        
            
  <?php
          
    }
                        
} else {
  $user->logout();
  Redirect::to('../../login/'); 
}


  ?>
 
	 <script>
     $(document).ready(function(event){
 
   
	
      $('.singledelete').on('click', function(e){
            
	        let del = $(this).attr('lang');
	        let title = $(this).attr('title');
	        //alert(del)
	        let confirmation = confirm("Are you sure you want to remove the item?");
	       
	       
	       if (confirmation) { 
	       
        
         
	        $.ajax({
	           	url: 'view/assets_mgt/maintenance/delete.php',
			    type: 'POST',
	            data:{
	                  del     :   del,
	                  title   :   title
	            },
	            cache: false,
	            success:function(data){
	                $(".success_alert").html(data);
                    $(".success_alert").show();
	            }
	        });
	        
	       }
	        e.preventDefault();
	    });

    event.preventDefault();
	});
        
 </script>
 