<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) { 



   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = date('Y');
    
   if(!empty($_REQUEST['transaction_year_month'])) {
        
     
        $transaction_year_month  = $_REQUEST['transaction_year_month'];

        $sqlQuery = Db::getInstance()->query("Select a.request_code, a.*, b.proceed_id
                                        from proceed a
                                        left join proceed_records b on a.id = b.proceed_id
                                        WHERE a.transaction_year = '$transaction_year_month'
                                        group by a.request_code
                                        order by a.id desc");



                if (!$sqlQuery->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                
                <div class="table-responsive data-font" style="height: 100%;">
      
    
                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Request Code</th>
                          <th>Request Date</th>
                          <th>Estimated Qty</th>
                          <th>Actual Qty</th>
                          <th>Status</th>
                          <th>Remark's Date</th>
                          <th style="text-align:right">Production Cost</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        $i = 1;
                        foreach ($sqlQuery->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->request_code; ?></td>
                            <td><?php echo $user->request_date; ?></td>
                            <td><?php echo $user->estimated_qty; ?></td>
                            <td><?php echo $user->actual_qty; ?></td>
                            <?php  
                            
                                $approval_status = $user->proceed_status;
                                
                                        if($approval_status == "Completed"){
                                            echo '<td class="alert-success" style="text-align:center">Completed</td>';
                                        }else if($approval_status == "Partially Received"){
                                            echo '<td class="alert-warning" style="text-align:center">Partially Received</td>';
                                        }else if($approval_status == "Pending"){
                                            echo '<td class="alert-primary" style="text-align:center">Pending</td>';
                                        }else{
                                            echo '<td class="alert-secondary" style="text-align:center">Not Received</td>';
                                        }
                            
                            ?>
                            <td><?php echo $user->remark_date; ?></td>
                            <td style="text-align:right"><?php 
                            $number = $user->production_cost;
                            $Total_Amount = number_format($number ?? 0, 2);
                            echo $user->sign . ' ' . $Total_Amount; ?></td>
                            <td>
                                
                              <div class="dropUp">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="approval_edit" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Remark</button>

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
 
 </div>
 
 <?php
                      }
            }else{
        
     
      

        $sqlQuery = Db::getInstance()->query("Select a.request_code, a.*, b.proceed_id
                                        from proceed a
                                        left join proceed_records b on a.id = b.proceed_id
                                        WHERE a.transaction_year = '$transact_'
                                        group by a.request_code
                                        order by a.id desc");



                if (!$sqlQuery->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                <div class="table-responsive data-font" style="height: 100%;">
                     <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Request Code</th>
                          <th>Request Date</th>
                          <th>Estimated Qty</th>
                          <th>Actual Qty</th>
                          <th>Status</th>
                          <th>Remark's Date</th>
                          <th style="text-align:right">Production Cost</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        $i = 1;
                        foreach ($sqlQuery->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->request_code; ?></td>
                            <td><?php echo $user->request_date; ?></td>
                            <td><?php echo $user->estimated_qty; ?></td>
                            <td><?php echo $user->actual_qty; ?></td>
                            <?php  
                            
                                $approval_status = $user->proceed_status;
                                
                                        if($approval_status == "Approved"){
                                            echo '<td class="alert-success" style="text-align:center">Approved</td>';
                                        }else if($approval_status == "Declined"){
                                            echo '<td class="alert-danger" style="text-align:center">Declined</td>';
                                        }else if($approval_status == "Pending"){
                                            echo '<td class="alert-primary" style="text-align:center">Pending</td>';
                                        }else{
                                            echo '<td class="alert-secondary" style="text-align:center">Not Approved</td>';
                                        }
                            
                            ?>
                            <td><?php echo $user->remark_date; ?></td>
                            <td style="text-align:right"><?php 
                            $number = $user->production_cost;
                            $Total_Amount = number_format($number ?? 0, 2);
                            echo $user->sign . ' ' . $Total_Amount; ?></td>
                            <td>
                                
                              <div class="dropUp">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="approval_edit" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Remark</button>

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
 
 </div>
 
 <?php
                      }
            }
        
         
 ?>

  <?php
                      
} else {
  $user->logout();
  Redirect::to('../../login/');
}

?>

	 <script>
        $(document).ready(function(){
 
    	$('.approval_edit').click(function (e) {
    		
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

         
	});
        
 </script>
 