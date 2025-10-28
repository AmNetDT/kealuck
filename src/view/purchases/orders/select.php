<?php

require_once '../../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {

    $userSyscategory = escape($user->data()->syscategory_id);
    $username = escape($user->data()->id);
    
    
    
   if(!empty($_REQUEST['transaction_year'])) {
        
     $transaction_year_month = $_REQUEST['transaction_year'];
       
       
?>
      
  <div class="table-responsive data-font" style="height: 100%;">
      <div class="row justify-content-between">
                    <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                    <div class="resulter1">
                     </div>                                      
    </div>
                <?php



                  $user = Db::getInstance()->query("SELECT 
                                                    a.*, 
                                                    a.id AS purchase_id, 
                                                    b.name AS supplier, 
                                                    a.added_by, 
                                                    CONCAT(d.firstname, ' ', d.lastname) AS registered, 
                                                    f.amount, 
                                                    f.order_description, 
                                                    f.approval_status
                                                FROM 
                                                    purchases a
                                                LEFT JOIN 
                                                    suppliers b ON a.supplier_id = b.id 
                                                LEFT JOIN 
                                                    users c ON a.added_by = c.id 
                                                LEFT JOIN 
                                                    staff_record d ON c.username = d.user_id 
                                                LEFT JOIN 
                                                    approval f ON a.purchase_code = f.request_code
                                                WHERE 
                                                    a.transaction_year = '$transaction_year_month'
                                                ORDER BY a.id DESC");

                 
                    if (!$user->count()) {
                        
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                        
                      } else {
                        
                        
                    ?> 
                    
                        <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:150%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>SN</th>
                              <th>Purchase Code</th>
                              <th>Date &amp; Time</th>
                              <th>Description</th>
                              <th>Supplier</th>
                              <th class="text-center">Approval</td>
                              <th class="text-center">Received</th>
                              <th class="text-center">Status</td>
                              <th>Amount</td>
                              <th>Paid</td>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($user->results() as $user) {
                            
                            $purchase_code  = $user->purchase_code;
                            $member_id      = $user->purchase_id;
                            $status         = $user->approval_status;
                                
                            $labeltax = Db::getInstance()->query("SELECT SUM(qty) as gqty
                                                        FROM good_received 
                                                        WHERE purchase_id = $member_id");     
                            if($labeltax->count()){
                                foreach ($labeltax->results() as $labelta) {
                             
                            
                            $labelpur = Db::getInstance()->query("SELECT SUM(qty) as pqty
                                                        FROM purchase_order 
                                                        WHERE purchase_id = $member_id");   
                                foreach ($labelpur->results() as $labelpu) {
                                    
                                    
                                        $gqty = $labelta->gqty;
                                        $pqty = $labelpu->pqty;
                                        
                                        
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->purchase_code; ?></td>
                                <td><?php echo $user->date_time; ?></td>
                                <?php if(!empty($user->order_description)){ ?>
                                <td><?php echo $user->order_description; ?></td>
                                <?php 
                                     }else{
                                ?>
                                <td class='text-center'>---</td>
                                <?php    
                                         }
                                ?>
                                <td><?php echo $user->supplier; ?></td>
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
                                       
                                        if(empty($gqty)){
                                        ?>
                                            
                                        <td class="alert-danger" style="text-align:center">Not Received</td> 
                                        <?php
                                        } else if($pqty != $gqty){
                                        ?>
                                        
                                        <td class="alert-warning" style="text-align:center">Partial Received</td>
                                        
                                        <?php
                                        }else {
                                            ?>
                                        
                                        <td class="alert-success" style="text-align:center">Received Completely</td>
                                        
                                        <?php
                                        
                                                }
                                            
                                        ?> 
                                        
                                        </td>
                                <?php 
                                 if($approval_status == "Approved"){
                  $approval_records = Db::getInstance()->query("select a.request_code,
                                        sum(b.paid) as paid, a.amount
                                        from approval a
                                        left join approval_records b on a.id = b.approval_id
                                        left join journal c on b.id = c.approval_order_id
                                        where a.request_code = '$purchase_code'
                                        group by a.request_code");
                                 foreach ($approval_records->results() as $approv) {
                                
                                $paid = $approv->paid; 
                                $amount = $approv->amount;
                                
                                        if($paid === '' || $paid === null){
                                            echo '<td class="alert-secondary text-center">Unpaid</td>';
                                        }else if($paid > 0 &&  $paid != $amount){
                                            echo '<td class="alert-primary text-center">Partly Paid </td>';
                                        }else if($paid === $amount){
                                            echo '<td class="alert-success text-center">Paid</td>';
                                        }
                                        ?>
                                <td align="right"><?php  echo $amount; ?></td>
                                <td align="right"><?php  echo $paid; ?></td>
                                <?php
                                        }
                                 }else{
                                     ?>
                                <td class="alert-secondary text-center">Unpaid</td>
                                <td class="text-right">0</td>
                                <td class="text-right">0</td>
                                     <?php
                                 }
                                ?>
                                <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                      <div class="edituser_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Update Order</button>
                    
                                        </div>
                                       <div class="supplier_invoice" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-print"></i>&nbsp; Supplier Invoice</button>
                    
                                        </div>
                                         <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                          
                         
                                      <div class="dropdown-divider"></div>
                                      
                                        <div class="goodreceived" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Received Note</button>
                    
                                        </div>
                                         <?php
                                     }
                                  }
                                        ?> 
                                       
                                       
                                      </div>
                                  </div>
                                 
                                </td>
                              </tr>
                    
                    
                            <?php
                                        }
                                    }
                                 }
                                 
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
        
        
  <div class="table-responsive data-font" style="height: 100%;">
     
                <?php

                $transac_ = date('Y');

                  $user = Db::getInstance()->query("SELECT 
                                                    a.*, 
                                                    a.id AS purchase_id, 
                                                    b.name AS supplier, 
                                                    a.added_by, 
                                                    CONCAT(d.firstname, ' ', d.lastname) AS registered,
                                                    f.amount, 
                                                    f.order_description, 
                                                    f.approval_status
                                                FROM 
                                                    purchases a
                                                LEFT JOIN 
                                                    suppliers b ON a.supplier_id = b.id 
                                                LEFT JOIN 
                                                    users c ON a.added_by = c.id 
                                                LEFT JOIN 
                                                    staff_record d ON c.username = d.user_id 
                                                LEFT JOIN 
                                                    approval f ON a.purchase_code = f.request_code
                                                WHERE 
                                                    a.transaction_year = '$transac_'
                                                ORDER BY a.id DESC");

                 
                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                    
                        <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:150%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>SN</th>
                              <th>Purchase Code</th>
                              <th>Date &amp; Time</th>
                              <th>Description</th>
                              <th>Supplier</th>
                              <th class="text-center">Approval</td>
                              <th class="text-center">Received</th>
                              <th class="text-center">Status</td>
                              <th>Amount</td>
                              <th>Paid</td>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($user->results() as $user) {
                            
                            $purchase_code  = $user->purchase_code;
                            $member_id      = $user->purchase_id;
                            $status         = $user->approval_status;
                                
                            $labeltax = Db::getInstance()->query("SELECT SUM(qty) as gqty
                                                        FROM good_received 
                                                        WHERE purchase_id = $member_id");     
                            if($labeltax->count()){
                                foreach ($labeltax->results() as $labelta) {
                             
                            
                            $labelpur = Db::getInstance()->query("SELECT SUM(qty) as pqty
                                                        FROM purchase_order 
                                                        WHERE purchase_id = $member_id");   
                                foreach ($labelpur->results() as $labelpu) {
                                    
                                    
                                        $gqty = $labelta->gqty;
                                        $pqty = $labelpu->pqty;
                                        
                                        
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->purchase_code; ?></td>
                                <td><?php echo $user->date_time; ?></td>
                                <?php if(!empty($user->order_description)){ ?>
                                <td><?php echo $user->order_description; ?></td>
                                <?php 
                                     }else{
                                ?>
                                <td class='text-center'>---</td>
                                <?php    
                                         }
                                ?>
                                <td><?php echo $user->supplier; ?></td>
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
                                       
                                        if(empty($gqty)){
                                        ?>
                                            
                                        <td class="alert-danger" style="text-align:center">Not Received</td> 
                                        <?php
                                        } else if($pqty != $gqty){
                                        ?>
                                        
                                        <td class="alert-warning" style="text-align:center">Partial Received</td>
                                        
                                        <?php
                                        }else {
                                            ?>
                                        
                                        <td class="alert-success" style="text-align:center">Received Completely</td>
                                        
                                        <?php
                                        
                                                }
                                            
                                        ?> 
                                        
                                        </td>
                                <?php 
                                 if($approval_status == "Approved"){
                  $approval_records = Db::getInstance()->query("select a.request_code,
                                        sum(b.paid) as paid, a.amount
                                        from approval a
                                        left join approval_records b on a.id = b.approval_id
                                        left join journal c on b.id = c.approval_order_id
                                        where a.request_code = '$purchase_code'
                                        group by a.request_code");
                                 foreach ($approval_records->results() as $approv) {
                                
                                $paid = $approv->paid; 
                                $amount = $approv->amount;
                                
                                        if($paid === '' || $paid === null){
                                            echo '<td class="alert-secondary text-center">Unpaid</td>';
                                        }else if($paid > 0 &&  $paid != $amount){
                                            echo '<td class="alert-primary text-center">Partly Paid </td>';
                                        }else if($paid === $amount){
                                            echo '<td class="alert-success text-center">Paid</td>';
                                        }
                                        ?>
                                <td align="right"><?php  echo $amount; ?></td>
                                <td align="right"><?php  echo $paid; ?></td>
                                <?php
                                        }
                                 }else{
                                     ?>
                                <td class="alert-secondary text-center">Unpaid</td>
                                <td class="text-right">0</td>
                                <td class="text-right">0</td>
                                     <?php
                                 }
                                ?>
                                <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                      <div class="edituser_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Update Order</button>
                    
                                        </div>
                                       <div class="supplier_invoice" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-print"></i>&nbsp; Supplier Invoice</button>
                    
                                        </div>
                                         <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                          
                         
                                      <div class="dropdown-divider"></div>
                                      
                                        <div class="goodreceived" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Received Note</button>
                    
                                        </div>
                                         <?php
                                     }
                                  }
                                        ?> 
                                       
                                      </div>
                                  </div>
                                 
                                </td>
                              </tr>
                    
                    
                            <?php
                                        }
                                    }
                                 }
                                 
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
                    
}else{

  $user->logout();
  Redirect::to('../../login/');
  
}


  ?>
 <script>
     $(document).ready(function(){
          
         $('.resulter').hide();
         $('.resulter1').hide();
         
  
         
    $('.goodreceived').click(function (e) {
		
		let member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/purchases/orders/goodreceived.php",
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
			url: "view/purchases/orders/editorder.php",
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

       
    $('.supplier_invoice').click(function (e) {
		
		let id = $(this).attr('id');
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			cache: false, async: true,
			url: "view/purchases/orders/view.php",
			data:{
			    'id':id
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
  
  