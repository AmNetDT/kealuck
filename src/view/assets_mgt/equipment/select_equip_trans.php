<?php

require_once '../../core/init.php';

$member_id = 0;
$id = 0;

$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username_id = escape($user->data()->id);
    
    if(!empty($_REQUEST['member_id']) && !empty($_REQUEST['id'])) {
        
        $id = $_REQUEST['id'];
        $member_id = $_REQUEST['member_id'];
?>

       

       <div class="container-fluid">
                <?php

                  $user = Db::getInstance()->query("SELECT * FROM equipmenttransaction WHERE equipment_id = $member_id AND transaction_year= '$id'");

                  if (!$user->count()) {
                   ?>
                   <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                   <?php
                  } else {

                ?> 

                    <table class="table table-sm table-hover table-bordered" style="font-size:0.8em; width:100%;">
                      <thead>
                        <tr> 
                          <th style="width:12%">Date </th>
                          <th>Entry</th>
                          <th style="width:33%">Payee</th>
                          <th style="width:32%">Description</th>
                          <th>Type</th>
                          <th style="width:13%;" class="pl-3">Amount</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        foreach ($user->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $user->transaction_date; ?></td>
                            <td><?php echo $user->category; ?></td>
                            <td><?php echo $user->payee; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <?php
                                
                                    $type = $user->type; 
                                    if($type === 'Income'){
                                    
                                ?>
                            <td class="aler alert-success px-3"><?php echo $user->type; ?></td>
                            <td style="text-align:right"><?php
                            $number = $user->amount;
                                $Total_Amount = number_format($number);
                            echo $Total_Amount; ?>.00</td>
                            <td>
                                     <?php
                                     
                            $equipment_code_income = $user->id_code;
                            $findincome = Db::getInstance()->query("SELECT * FROM equipmenttransaction a 
                            LEFT JOIN sales b ON a.id_code = b.sales_code 
                            WHERE a.id_code ='$equipment_code_income' AND b.approval_status = 'Approved'"); 
                            
                            
                             if($findincome->count() == 1){
                                 
                                echo $equipment_code_income . ' Approved ';
                                
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
                                        <div class="singledelete" id="<?php echo $user->id; ?>" title='<?php echo $user->id_code; ?>' lang='sales'>
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
                                <?php
                                
                                    }else if($type === 'Expense'){
                                
                                ?>
                            <td class="aler alert-danger px-3"><?php echo $user->type; ?></td>
                            <td style="text-align:right"><?php $number = $user->amount;
                                $Total_Amount = number_format($number);
                            echo $Total_Amount; ?>.00</td>
                            <td>
                                     <?php
                                     
                            $equipment_code_expense_one = $user->id_code;
                            $findexpense = Db::getInstance()->query("SELECT * FROM equipmenttransaction a 
                            LEFT JOIN approval b ON a.id_code = b.request_code 
                            WHERE b.approval_status != 'Approved' AND a.id_code ='$equipment_code_expense_one'"); 
                            
                            
                             if($findexpense->count()){
                                 
                                    
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
                                        <div class="singledelete" id="<?php echo $user->id; ?>" title='<?php echo $user->id_code; ?>' lang='approval'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-trash"></i></button>
                    
                                        </div>
                                <?php
                                
                                    }
                                
                                ?>
                            </div>
                             
                                  <?php
                                  
                                
                             } else {
                                 
                                 echo $equipment_code_expense_one . ' Approved';
                                 
                             } 
                                 ?>
                            </td>
                                <?php
                                
                                    }
                                ?>
                            
                        

  
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
        
        $member_id = $_REQUEST['member_id'];
        $transact_ = $_REQUEST['transact_'];
?>

       

  <!-- End datatable !-->

       <div class="container-fluid">
                <?php

                  $user = Db::getInstance()->query("SELECT * FROM equipmenttransaction WHERE equipment_id = $member_id AND transaction_year= '$transact_'");

                  if (!$user->count()) {
                   ?>
                   <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                   <?php
                  } else {

                ?> 

                    <table class="table table-sm table-hover table-bordered" style="font-size:0.8em; width:100%;">
                      <thead>
                        <tr> 
                          <th style="width:12%">Date </th>
                          <th>Entry</th>
                          <th style="width:33%">Payee</th>
                          <th style="width:32%">Description</th>
                          <th>Type</th>
                          <th style="width:13%; text-align:right">Amount</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        foreach ($user->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $user->transaction_date; ?></td>
                            <td><?php echo $user->category; ?></td>
                            <td><?php echo $user->payee; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td style="text-align:right"><?php echo $user->amount; ?>.00</td>
                            <?php
                                
                                    $type = $user->type; 
                                    if($type === 'Income'){
                                    
                                ?>
                            <td class="aler alert-success px-3"><?php echo $user->type; ?></td>
                            <td>
                                     <?php
                            
                            $equipment_code_income_one = $user->id_code;
                            $findincome_one = Db::getInstance()->query("SELECT * FROM equipmenttransaction a 
                            LEFT JOIN sales b ON a.id_code = b.sales_code 
                            WHERE a.id_code ='$equipment_code_income_one' AND b.approval_status = 'Approved'"); 
                            
                            
                             if($findincome_one->count() == 1){
                                 
                                echo $equipment_code_income_one . ' Approved';
                                
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
                                        <div class="singledelete" id="<?php echo $user->id; ?>" title='<?php echo $user->id_code; ?>' lang='sales'>
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
                                <?php
                                
                                    }else if($type === 'Expense'){
                                
                                ?>
                            <td class="aler alert-danger px-3"><?php echo $user->type; ?></td>
                            <td>
                                     <?php
                                     
                            $equipment_code_expense = $user->id_code;
                            $findexpense = Db::getInstance()->query("SELECT * FROM equipmenttransaction a 
                            LEFT JOIN approval b ON a.id_code = b.request_code 
                            WHERE b.approval_status != 'Approved' AND a.id_code ='$equipment_code_expense'"); 
                            
                            
                             if($findexpense->count()){
                                 
                                    
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
                                        <div class="singledelete" id="<?php echo $user->id; ?>" title='<?php echo $user->id_code; ?>' lang='approval'>
                                            <button class="dropdown-item">
                                                 <i class="fa fa-trash"></i></button>
                    
                                        </div>
                                <?php
                                
                                    }
                                
                                ?>  
                            </div>
                             
                                  <?php
                                  
                                
                             } else {
                                 
                                 echo $equipment_code_expense . ' Approved';
                                 
                             } 
                                 ?>
                            </td>
                                <?php
                                
                                    }
                                ?>
                            
                        

  
  
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
        				url: 'view/assets_mgt/equipment/delete_transaction.php',
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