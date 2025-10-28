<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

    $userSyscategory = escape($user->data()->syscategory_id);
    $username = escape($user->data()->id);
?>


       
  <div class="table-responsive data-font" style="height: 120%;">
                                        

                <?php



                  $user = Db::getInstance()->query("SELECT a.*, b.username, a.id as workorders_id,
                  concat(d.firstname, ' ', d.lastname) as registered, a.wo_code
                  FROM workorders a 
                  Left join users b on a.added_by = b.id 
                  Left Join staff_record d on b.username = d.user_id 
                  order by a.id desc");

                 
                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                       
                    ?> 
                     
                        <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>SN</th>
                              <th>Item Code</th>
                              <th>Proceed Type</th>
                              <th>Request Date</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Estimated Qty.</th>
                              <th>Actual Qty.</th>
                              <th>Remark Date</th>
                              <th style="text-align:right">Production Cost</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($user->results() as $user) {
                            
                                $wo_code =  $user->wo_code;
                                $level = $user->status; 
                                $workorders_id = $user->id; 
                                 
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->wo_code; ?></td>
                                <td><?php echo $user->type; ?></td>
                                <td><?php echo $user->date_time; ?></td>
                                <td><?php echo $user->description; ?></td>
                                <?php 
                                
                                        if($level==='Initiated'){
                                          echo '<td class="alert-success text-center">Initiated</td>'; 
                                        }else if($level==='In Progress'){
                                          echo '<td class="alert-primary text-center">In Progress</td>';   
                                        }else if($level==='On-hold'){
                                          echo '<td class="alert-warning text-center">On-hold</td>';   
                                        }else if($level==='Aborted'){
                                          echo '<td class="alert-danger text-center">Aborted</td>';   
                                        }else if($level==='Completed'){
                                          echo '<td class="alert-dark text-center">Completed</td>';   
                                        }
                                        
                                        
                                ?>
                                <td class="text-right"><?php  
                                            $workoutput = Db::getInstance()->query("SELECT SUM(product_qty) AS product_qty
                                              FROM workoutput 
                                              WHERE workorders_id = $workorders_id");
                                              if (!$workoutput->count()) {
                                                echo 0;
                                              } else {
                                                
                                                foreach ($workoutput->results() as $workout) {
                                                echo $workout->product_qty;
                                                }
                                              }
                                ?></td>
                                <td class="text-right"><?php  
                                            $workoutput = Db::getInstance()->query("SELECT SUM(qty_received) AS qty_received
                                              FROM sales_stocks_received 
                                              WHERE workorders_id = $workorders_id");
                                              if (!$workoutput->count()) {
                                                echo 0;
                                              } else {
                                                
                                                foreach ($workoutput->results() as $workout) {
                                                echo $workout->qty_received;
                                                }
                                              }
                                ?></td>
                                <td><?php echo $user->deadline; ?></td>
                                <td><?php  
                                            $workoutpu = Db::getInstance()->query("SELECT amount
                                              FROM proceed 
                                              WHERE request_code = '$wo_code'");
                                              if (!$workoutpu->count()) {
                                                echo 0;
                                              } else {
                                                
                                                foreach ($workoutpu->results() as $workou) {
                                                echo $workou->amount;
                                                }
                                              }
                                ?></td>
                                <td>
                                   
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                        <div class="edituser_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-search"></i>&nbsp; View Order</button>
                    
                                        </div>
                                      
                                        
                                      </div>
                                  </div>
                                 
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
  Redirect::to('../../login/');
}


  ?>
 <script>
     $(document).ready(function(){
          
         $('.resulter').hide();
         $('.resulter1').hide();
         
     })
 </script>  
 <script>
     $(document).ready(function(){
    
	$('.edituser_view').click(function (e) {
		
		
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/schedule/proceeds/editorder.php",
			data: {
				'member_id': member_id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});

 
   event.preventDefault();
   });
  </script>