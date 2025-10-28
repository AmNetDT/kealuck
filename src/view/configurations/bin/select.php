<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
?>

       

<div class="table-responsive data-font" style="height:100%;">
     
               <?php
                    
                                        
                                        $sqlQuery = Db::getInstance()->query("SELECT a.*, b.location as warehouse FROM bin a
                                        left join worklocation b on a.warehouse_id = b.id");
                                        
                                                         if (!$sqlQuery->count()) {
                                                             
                                                                echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                                
                                                              } else {
                                                                ?>
                                                                
                                           
                                        <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                                            <thead>
                                                              <tr>
                                                                <th style="width:10%">Code</th>
                                                                <th style="width:25%">Description</th>
                                                                <th style="width:25%">Warehouse</th>
                                                                <th style="width:10%">Max Capacity</th>
                                                                <th style="width:10%">Matric Type</th>
                                                                <th style="width:20%">Inventory</th>
                                                                <th>&nbsp;</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                        
                                            
                                        
                                            <?php 
                                        
                                        	                    foreach ($sqlQuery->results() as $department) { 
                                        
                                        	?>
                                            
                                                                <tr>
                                                                  <td><?php echo $department->bin_code; ?></td>
                                                                  <td><?php echo $department->description; ?></td>
                                                                  <td><?php echo $department->warehouse; ?></td>
                                                                  <td><?php echo $department->max_capacity; ?></td>
                                                                  <td><?php echo $department->metric_type; ?></td>
                                                                  <td>
                                                                      <?php
                                                                            $bin_id = $department->id;
                                                                            $max_capacity = $department->max_capacity;
                                                                            $bin = Db::getInstance()->query("SELECT SUM(total_qty_credit - total_qty_debit) as total FROM inventory WHERE bin_id = $bin_id");
                                                                            if (!$bin->count()) {
                                                                        ?>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar bg-white" role="progressbar">Empty bin</div>
                                                                                </div>
                                                                        <?php
                                                                            } else {
                                                                                foreach ($bin->results() as $depot_bin) {
                                                                                    $yss = $depot_bin->total;
                                                                        
                                                                                    // Ensure $yss is not null before using substr()
                                                                                    $new_string = $yss !== null ? substr($yss, 0, 3) : 0;
                                                                        ?>
                                                                                    <div class="progress">
                                                                                        <div class="progress-bar progress-bar-striped farm-button" role="progressbar" 
                                                                                        style="width:<?php echo ($depot_bin->total <= 0) ? 0 : $new_string; ?>%;" 
                                                                                        aria-valuenow="<?php echo ($depot_bin->total <= 0) ? 0 : $new_string; ?>" 
                                                                                        aria-valuemin="0" 
                                                                                        aria-valuemax="<?php echo $max_capacity; ?>"><?php echo ($depot_bin->total <= 0) ? 0 : $new_string; ?></div>
                                                                                    </div>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        ?>

                                                                  </td>
                                                                  <td>
                                                         <?php
                                                         
                                                $maintenance_cod = $department->id;
                                                $findincome = Db::getInstance()->query("SELECT * FROM inventory
                                                WHERE bin_id = $maintenance_cod"); 
                                                
                                                
                                                 if($findincome->count() == 1){
                                                     
                                                
                                                    
                                                 } else {
                                                     
                                                         
                                                     ?>
                                                     
                                                      
                                                <div class="btn-group dropleft">
                                                    <div class="singledelete" id='<?php echo $department->description; ?>' lang='<?php echo $department->id; ?>' >
                                                        <button class="dropdown-item">
                                                             <i class="fa fa-trash"></i></button>
                                
                                                    </div>
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
} else {
  $user->logout();
  Redirect::to('app.kealuck.com/login/');
}


  ?>
   
	 <script>
	      $(document).ready(function(){
 

       //singledelete
	    
             $('.singledelete').on('click', function(){
       
                 let id = $(this).attr('lang'); 
                 let name = $(this).attr('id'); 
                
                //alert(id);
                
              	 let confirmation = confirm("Are you sure you want to remove the item?");
	       
	       
	       if (confirmation) { 
	       
        
           
                    $.ajax({
                        url: 'view/configurations/bin/delete.php',
                        type: 'POST',
                        data:{
                          'id':id,
                          'name':name
                        },
                        cache: false,
                        success:function(data){
                        $(".success_alert").html(data);
                        $(".success_alert").show();
                        $('#wload').html('');  
                        }, 
                        error:function(data){
                        $(".warning_alert").html(data);
                        $(".warning_alert").show();
                        }
                    }); 
	       }
            });
	});
	 </script>