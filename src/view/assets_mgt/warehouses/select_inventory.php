<?php

require_once '../../core/init.php';

$member_id = 0;
$id = 0;
$transact_;

$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username_id = escape($user->data()->id);
    
    if(!empty($_REQUEST['member_id']) && !empty($_REQUEST['id'])) {
        
        $id         = $_REQUEST['id'];
        $member_id  = $_REQUEST['member_id'];
        
        //echo $id;
       // echo $member_id;
?>
       

       <div class="container-fluid">
           
                <?php
                        
                  $invent = Db::getInstance()->query("SELECT a.activity_date, SUM(a.total_qty_credit) AS total_qty_credit, SUM(a.total_qty_debit) AS total_qty_debit, 
                  SUM(a.total_qty_credit - a.total_qty_debit) AS balance,
                  b.sku_code, b.description, c.description as binname, a.added_by
                  FROM inventory a 
                  left join products b on a.products_id = b.id
                  left join bin c on a.bin_id = c.id
                  WHERE a.warehouse_id = $member_id AND a.transaction_year = '$id'
                  GROUP BY b.sku_code");

                  if (!$invent->count()) {
                   ?>
                   <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                   <?php
                  } else {
                        
                ?> 

                    <table class="table table-sm table-hover table-bordered" style="font-size:0.8em; width:120%;">
                      <thead>
                        <tr> 
                          <th>Code</th>
                          <th style="width:15%">Entry Date </th>
                          <th style="width:30%">Description</th>
                          <th style="width:15%">Debit</th>
                          <th style="width:15%">Credit</th>
                          <th style="width:13%; text-align:right">Bin</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        foreach ($invent->results() as $invent) {
                          
                        ?>
                          <tr>
                            <td><?php echo $invent->sku_code; ?></td>
                            <td><?php echo $invent->activity_date; ?></td></td>
                            <td><?php echo $invent->description; ?></td></td>
                            <td style="text-align:right"><?php echo $invent->total_qty_debit; ?></td>
                            <td style="text-align:right"><?php echo $invent->total_qty_credit; ?></td>
                            <td><?php echo $invent->binname; ?></td>
                            <td>
                                     <?php
                                     
                            $equipment_code_income = $invent->sku_code;
                            $findincome = Db::getInstance()->query("SELECT * FROM inventory a 
                            LEFT JOIN sales b ON a.id_code = b.sales_code 
                            WHERE a.id_code ='$equipment_code_income' AND b.approval_status = 'Approved'"); 
                            
                            
                             if($findincome->count() == 1){
                                 
                                echo $equipment_code_income . ' Approved ';
                                
                             } else {
                                 
                                     
                                 ?>
                                 
                                  
                            <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                              <?php
                                    
                                    $added = $invent->added_by;
                                    if($username_id == $added){
                              ?>
                              
                                        <div class="singledelete" id="<?php echo $invent->id; ?>" title='<?php echo $invent->id_code; ?>' lang='inventory'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-trash"></i></button>
                                        </div>
                                <?php
                                
                                    }
                                
                                ?>
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
          
    }else if(!empty($_REQUEST['member_id']) && !empty($_REQUEST['transact_'])) {
        
        $member_id = $_REQUEST['member_id'];
        $transact_ = $_REQUEST['transact_'];
?>

        <div class="container-fluid">
           
                <?php
                        
                  $invent = Db::getInstance()->query("SELECT a.activity_date, SUM(a.total_qty_credit) AS total_qty_credit, SUM(a.total_qty_debit) AS total_qty_debit, 
                  SUM(a.total_qty_credit - a.total_qty_debit) AS balance,
                  b.sku_code, b.description, c.description as binname, a.added_by
                  FROM inventory a 
                  left join products b on a.products_id = b.id
                  left join bin c on a.bin_id = c.id
                  WHERE a.warehouse_id = $member_id AND a.transaction_year = '$transact_'
                  GROUP BY b.sku_code");

                  if (!$invent->count()) {
                   ?>
                   <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                   <?php
                  } else {
                        
                ?> 

                    <table class="table table-sm table-hover table-bordered" style="font-size:0.8em; width:100%;">
                      <thead>
                        <tr> 
                          <th>Code</th>
                          <th style="width:15%">Entry Date </th>
                          <th style="width:30%">Description</th>
                          <th style="width:15%; text-align:right">Debit</th>
                          <th style="width:15%; text-align:right">Credit</th>
                          <th style="width:15%; text-align:right">Balance</th>
                          <th style="width:13%;">Bin</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        foreach ($invent->results() as $invent) {
                          
                        ?>
                          <tr>
                            <td><?php echo $invent->sku_code; ?></td>
                            <td><?php echo $invent->activity_date; ?></td></td>
                            <td><?php echo $invent->description; ?></td></td>
                            <td style="text-align:right"><?php echo $invent->total_qty_debit; ?></td>
                            <td style="text-align:right"><?php echo $invent->total_qty_credit; ?></td>
                            <td style="text-align:right"><?php echo $invent->balance; ?></td>
                            <td><?php echo $invent->binname; ?></td>
                            <td>
                                     <?php
                                     
                            $equipment_code_income = $invent->sku_code;
                            $findincome = Db::getInstance()->query("SELECT * FROM inventory a 
                            LEFT JOIN sales b ON a.id_code = b.sales_code 
                            WHERE a.id_code ='$equipment_code_income' AND b.approval_status = 'Approved'"); 
                            
                            
                             if($findincome->count() == 1){
                                 
                                echo $equipment_code_income . ' Approved ';
                                
                             } else {
                                 
                                     
                                 ?>
                                 
                                  
                            <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                              <?php
                                    
                                    $added = $invent->added_by;
                                    if($username_id == $added){
                              ?>
                              
                                        <div class="singledelete" id="<?php echo $invent->id; ?>" title='<?php echo $invent->id_code; ?>' lang='inventory'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-trash"></i></button>
                                        </div>
                                <?php
                                
                                    }
                                
                                ?>
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
          
    }
           
                        
} else {
  $user->logout();
  Redirect::to('../../login/'); 
}


  ?>
 
 <script>
     $(document).ready(function(){
         
        
       
      $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let table_name      =   $(this).attr('lang');
                    	let request_code    =   $(this).attr('title');
    		            let id              =   $(this).attr('id');
    		             
                    $.ajax({
            
        				type: "POST",
        				url: 'view/assets_mgt/warehouses/delete.php',
                		data: {
                		    
                		    table_name      :   table_name,
                		    request_code    :   request_code,
                            id              :   id
                		    
                		},
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
                
                    
                    
                  } else {
                    return false;
                    
                  }
                
                
                e.preventDefault();
            });
    
   
   event.preventDefault();
   });
  </script>