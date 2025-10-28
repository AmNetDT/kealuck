<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) { 



   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
    
   if(!empty($_REQUEST['transaction_year_month'])) {
        
     
        $transaction_year_month  = $_REQUEST['transaction_year_month'];

        $sqlQuery = Db::getInstance()->query("select a.request_code, a.*, b.approval_id,
                                        sum(b.paid) as total_paid, c.sign
                                        from approval a
                                        left join approval_records b on a.id = b.approval_id
                                        left join currency c on a.currency_id = c.id
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
                          <th>Remark Status</th>
                          <th>Approve Date</th>
                          <th style="text-align:right">Amount</td>
                          <th style="text-align:right">Paid</td>
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
                            <?php  
                            
                                $approval_status = $user->approval_status;
                                
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
                            <td><?php echo $user->approval_date; ?></td>
                            <td style="text-align:right"><?php 
                            $number = $user->amount;
                            $Total_Amount = number_format($number);
                            echo $user->sign . ' ' . $Total_Amount; ?></td>
                            <td style="text-align:right"><?php
                            $total_paid = $user->total_paid;
                            $Total_Amount = number_format($total_paid); 
                            echo '&#x20A6;' . $Total_Amount; ?></td>
                            <td>
                                
                             <div class="dropup">
                                  
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
        
     
      

        $sqlQuery = Db::getInstance()->query("Select a.request_code, a.*, b.approval_id,
                                        sum(b.paid) as total_paid, c.sign
                                        from approval a
                                        left join approval_records b on a.id = b.approval_id
                                        left join currency c on a.currency_id = c.id
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
                          <th>Remark Status</th>
                          <th>Approve Date</th>
                          <th style="text-align:right">Amount</td>
                          <th style="text-align:right">Paid</td>
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
                            <?php  
                            
                                $approval_status = $user->approval_status;
                                
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
                            <td><?php echo $user->approval_date; ?></td>
                            <td style="text-align:right"><?php echo $user->sign . ' '. $user->amount; ?></td>
                            <td style="text-align:right"><?php echo $user->total_paid; ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
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
    			url: "view/approvals/bill_requests/approval.php",
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
 