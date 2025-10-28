<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

    $userSyscategory = escape($user->data()->syscategory_id);
    $username = escape($user->data()->id);

    
   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
    
   if(!empty($_REQUEST['transaction_year'])) {
        
     $transaction_year_month = $_REQUEST['transaction_year'];
        
                     
        ?>
  <div class="table-responsive data-font" style="height: 120%;">
                                        

                <?php



                  $user = Db::getInstance()->query("SELECT a.*, b.username, a.id as workorders_id,
                  concat(d.firstname, ' ', d.lastname) as registered, a.wo_code, c.proceed_status
                  FROM workorders a 
                  Left join users b on a.added_by = b.id 
                  Left join proceed c on a.id = c.item_id
                  Left Join staff_record d on b.username = d.user_id 
                  where a.transaction_year = '$transaction_year_month'
                  order by a.id desc");

                 
                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                       
                    ?> 
                    
                        <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>#</th>
                              <th>WO Code</th>
                              <th>Operation Type</th>
                              <th>Date &amp; Time</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Estimated Qty.</th>
                              <th>Actual Qty.</th>
                              <th>Deadline</th>
                              <th style="text-align:right">Estimated Cost</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($user->results() as $user) {
                            
                            
                                $level = $user->proceed_status; 
                                $workorders_id = $user->id; 
                                 
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->wo_code; ?></td>
                                <td><?php echo $user->type; ?></td>
                                <td><?php echo $user->date_time; ?></td>
                                <td><?php echo $user->description; ?></td>
                                <?php 
                                
                                        if($level==='' || empty($level)){
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
                                            $workoutpu = Db::getInstance()->query("SELECT cost_production
                                              FROM proceed 
                                              WHERE item_id = $workorders_id");
                                              if (!$workoutpu->count()) {
                                                echo "NGN0.00";
                                              } else {
                                                
                                                foreach ($workoutpu->results() as $workou) {
                                                echo "NGN" . $workou->cost_production;
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
                                        <div class="dropdown-divider"></div>
                                        <div class="editorder_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Edit Order</button>
                    
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
       
                        
   }else{
       
            
                     
        ?>
  <div class="table-responsive data-font" style="height: 120%;">
                                        

                <?php



                  $user = Db::getInstance()->query("SELECT a.*, b.username, a.id as workorders_id,
                  concat(d.firstname, ' ', d.lastname) as registered, a.wo_code, c.proceed_status
                  FROM workorders a 
                  Left join users b on a.added_by = b.id 
                  Left join proceed c on a.id = c.item_id
                  Left Join staff_record d on b.username = d.user_id 
                  where a.transaction_year = '$transact_'
                  order by a.id desc");

                 
                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                       
                    ?> 
                    
                        <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>#</th>
                              <th>WO Code</th>
                              <th>Operation Type</th>
                              <th>Date &amp; Time</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Estimated Qty.</th>
                              <th>Actual Qty.</th>
                              <th>Deadline</th>
                              <th style="text-align:right">Estimated Cost</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($user->results() as $user) {
                            
                              
                                $level = $user->proceed_status; 
                                $workorders_id = $user->id; 
                                 
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->wo_code; ?></td>
                                <td><?php echo $user->type; ?></td>
                                <td><?php echo $user->date_time; ?></td>
                                <td><?php echo $user->description; ?></td>
                                <?php 
                                echo $level;
                                        if($level==='' || empty($level)){
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
                            
                                            $workoutpu = Db::getInstance()->query("SELECT cost_production
                                              FROM proceed 
                                              WHERE item_id = $workorders_id");
                                              if (!$workoutpu->count()) {
                                                echo "NGN0.00";
                                              } else {
                                                
                                                foreach ($workoutpu->results() as $workou) {
                                                echo "NGN" . $workou->cost_production;
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
                                        <div class="dropdown-divider"></div>
                                        <div class="editorder_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Edit Order</button>
                    
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
       
                        
       
   }
     
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
         
    $('.goodreceived').click(function (e) {
		
		let member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/manufacturing/operations/goodreceived.php",
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
 
	    $('.edituser_view').click(function (e) {
		
		
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/manufacturing/operations/editorder.php",
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
	
		$('.editorder_view').click(function (e) {
		
		
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/manufacturing/operations/edit-order-details.php",
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