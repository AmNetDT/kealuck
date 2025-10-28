<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username_id = escape($user->data()->id);
$userSyscat = escape($user->data()->syscategory_id);
$privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscat");
 
    

   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
    
   if(!empty($_REQUEST['transaction_year'])) {
        
     $transaction_year_month = $_REQUEST['transaction_year'];
       
       


?>



  <div class="table-responsive data-font" style="height: 100%; width:100%">
      <div class="row justify-content-between">
                         <div class="col-sm-12 success_alert" id="success_alert"></div> 
                         <div class="warning_alert" id="warning_alert"></div>
        </div>
                <?php

              


                  $util = Db::getInstance()->query("SELECT a.*, f.approval_status, 
                  CONCAT(d.firstname, ' ', lastname) as registered, k.sign,
                  f.approval_status, g.reconcile, j.journal_id
                  FROM utilities a
                  LEFT JOIN users c on a.prepared = c.id 
                  LEFT JOIN staff_record d on c.username = d.user_id 
                  LEFT JOIN approval f on a.voucher_code = f.request_code
                  LEFT JOIN approval_records h on f.id = h.approval_id
                  LEFT JOIN journal g on h.id = g.approval_order_id
                  LEFT JOIN journal_entry j on g.id = j.journal_id
                  LEFT JOIN currency k on a.currency_id = k.id
                  WHERE a.transaction_year = '$transaction_year_month'
                  GROUP BY a.voucher_code, j.journal_id
                  ORDER BY a.id DESC");

                  if (!$util->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="utilitydatatable" class="table table-hover table-bordered" style="width:100%; font-size:0.75rem;">
                      <thead>
                        <tr>
                          <th style="width:1%;" class="text-center" >S/No</th>
                          <th style="width:7%;">Item Code</th>
                          <th style="width:40%;">Description</th>
                          <th style="width:15%;" class="text-right pr-3">Amount</th>
                          <th align="center">Authorised</th>
                          <th style="width:10%;" align="center">Approval</th>
                          <th style="width:9%;" align="center">Payment Status</th>
                          <th style="width:1%;">&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           $i = 1;
                        foreach ($util->results() as $util) {
                        
                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $util->voucher_code; ?></td>
                            <td><?php echo $util->description; ?></td>
                            <td class="text-right pr-3"><?php
                            
                                $number = $util->amount;
                                $Total_Amount = number_format($number);
                            
                            
                            echo $util->sign . ' ' . $Total_Amount; 
                            
                            ?></td>
                            <td class="text-center"><?php echo $util->authorised; ?></td>
                            <?php 
                                
                               
                                $approval_status = $util->approval_status;
                                
                                        if($approval_status === "Approved"){
                                            echo '<td class="alert-success" style="text-align:center">Approved</td>';
                                        }else if($approval_status === "Declined"){
                                            echo '<td class="alert-danger" style="text-align:center">Declined</td>';
                                        }else if($approval_status === "Pending"){
                                            echo '<td class="alert-primary" style="text-align:center">Pending</td>';
                                        }else{
                                            echo '<td class="alert-secondary" style="text-align:center">Not Approved</td>';
                                        }
                                       
                                        
                                        $reconcile = $util->reconcile; 
                                        if($reconcile === 'Posted'){
                                            echo '<td class="alert-success" style="text-align:center">Reconciled</td>';
                                        }else {
                                            echo '<td class="alert-danger" style="text-align:center">Pending</td>';
                                        }
                                
                                ?>
                               
                             <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:11px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                       <div class="view_voucher" id="<?php echo $util->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-search"></i>&nbsp; Item Details</button>
                    
                                        </div>
                                    <?php
                                            if($util->prepared === $username_id){
                                                $request_code = $util->voucher_code;
                                                
                                                 $approval = Db::getInstance()->query("SELECT * from approval where request_code = '$request_code'");
                                                 if (!$approval->count()) {
                                    ?>
                                      <div class="dropdown-divider"></div>
                                      <input type="hidden" id="ids" value="<?php echo $util->id; ?>" />
                                        <div id="<?php echo $util->id; ?>">
                                            <button class="dropdown-item delete">
                                                 <i class="fa fa-trash"></i>&nbsp; Delete Voucher</button>
                    
                                        </div>
                                    <?php
                                                 }
                                            }
                                    
                                    ?>
                                      </div>
                                  </div>
                                 
                                </td>
                            
                            <!-- Modal -->

  
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
      <div class="row justify-content-between">
                         <div class="col-sm-12 success_alert" id="success_alert"></div> 
                         <div class="warning_alert" id="warning_alert"></div>
        </div>
                <?php

              


                  $util = Db::getInstance()->query("SELECT a.*, f.approval_status, 
                  concat(d.firstname, ' ', lastname) as registered, k.sign,
                  f.approval_status, g.reconcile, j.journal_id
                  FROM utilities a
                  Left join users c on a.prepared = c.id 
                  Left Join staff_record d on c.username = d.user_id 
                  left join approval f on a.voucher_code = f.request_code
                  left join approval_records h on f.id = h.approval_id
                  left join journal g on h.id = g.approval_order_id
                  left join journal_entry j on g.id = j.journal_id
                  left join currency k on a.currency_id = k.id
                  where a.transaction_year = '$transact_'
                  GROUP BY a.voucher_code, j.journal_id
                  ORDER BY a.id DESC");

                  if (!$util->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="utilitydatatable" class="table table-hover table-bordered" style="width:200%; font-size:0.75rem;">
                      <thead>
                        <tr>
                          <th style="width:1%;" class="text-center" >S/No</th>
                          <th style="width:7%;">Item Code</th>
                          <th style="width:40%;">Description</th>
                          <th style="width:15%;" class="text-right pr-3" >Amount</th>
                          <th align="center">Authorised</th>
                          <th style="width:10%;" align="center">Approval</th>
                          <th style="width:9%;" align="center">Payment Status</th>
                          <th style="width:1%;">&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $i = 1;
                        foreach ($util->results() as $util) {
                        
                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $util->voucher_code; ?></td>
                            <td><?php echo $util->description; ?></td>
                            <td class="text-right pr-3"><?php 
                                
                                
                                $number = $util->amount;
                                $Total_Amount = number_format($number);
                            
                            
                            echo $util->sign . ' ' . $Total_Amount; 
                                
                            ?></td>
                            <td class="text-center"><?php echo $util->authorised; ?></td>
                            <?php 
                                
                               
                                $approval_status = $util->approval_status;
                                
                                        if($approval_status === "Approved"){
                                            echo '<td class="alert-success" style="text-align:center">Approved</td>';
                                        }else if($approval_status === "Declined"){
                                            echo '<td class="alert-danger" style="text-align:center">Declined</td>';
                                        }else if($approval_status === "Pending"){
                                            echo '<td class="alert-primary" style="text-align:center">Pending</td>';
                                        }else{
                                            echo '<td class="alert-secondary" style="text-align:center">Not Approved</td>';
                                        }
                                       
                                         
                                        $reconcile = $util->reconcile; 
                                        if($reconcile === 'Posted'){
                                            echo '<td class="alert-success" style="text-align:center">Reconciled</td>';
                                        }else {
                                            echo '<td class="alert-danger" style="text-align:center">Pending</td>';
                                        }
                                
                                ?>
                               
                             <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:11px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                       <div class="view_voucher" id="<?php echo $util->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-search"></i>&nbsp; Item Details</button>
                    
                                        </div>
                                    <?php
                                            if($util->prepared === $username_id){
                                                $request_code = $util->voucher_code;
                                                
                                                 $approval = Db::getInstance()->query("SELECT * from approval where request_code = '$request_code'");
                                                 if (!$approval->count()) {
                                    ?>
                                      <div class="dropdown-divider"></div>
                                      <input type="hidden" id="ids" value="<?php echo $util->id; ?>" />
                                        <div id="<?php echo $util->id; ?>">
                                            <button class="dropdown-item delete">
                                                 <i class="fa fa-trash"></i>&nbsp; Delete Voucher</button>
                    
                                        </div>
                                    <?php
                                                 }
                                            }
                                    
                                    ?>
                                      </div>
                                  </div>
                                 
                                </td>
                            
                            <!-- Modal -->

  
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
            
            	$(".delete").on('click', function(){
     	    
             	   if (confirm("Are you sure you want to remove this item?") == true) {
             	         
             	    let ids = $('#ids').val();
             	    
             	  
             	    $.ajax({
                				url: 'view/purchases/utility/delete.php',
                				data: {
                        		    ids    : ids
                        		    
                        		},
                                type: 'POST',
                                success:function(data){
                                    $(".success_alert").html(data);
                                    $(".success_alert").show();
                                }, 
                                error:function(data){
                                    $(".warning_alert").html(data);
                                    $(".warning_alert").show();
                                }
                            }); 
             	    
                          } else {
                            return false;
                            
                          }
             	})
             	
    	$('.view_voucher').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/utility/voucher.php",
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
  