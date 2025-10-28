<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory_id);
?>

  
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
             <?php
 

            $users = Db::getInstance()->query("SELECT a.*, b.username, concat(d.firstname, ' ', d.lastname) as registered, 
            a.wo_code, c.location as inputs_warehouse, e.location as output_warehouse, d.image
            FROM workorders a 
            left join worklocation c on a.inputs_warehouse_id = c.id 
            left join worklocation e on a.output_warehouse_id = e.id
            Left join users b on a.added_by = b.id 
            Left Join staff_record d on b.username = d.user_id 
            WHERE a.id =  $member_id");
                  
            foreach ($users->results() as $use) {
                
                $wo_code = $use->wo_code;
                $output_warehouse_id    = $use->output_warehouse_id;  
                $output_warehouse       = $use->output_warehouse;              
                             
            ?>
            
                <div class="row my-3 mb-4 justify-content-between">
                    <div class="col-sm-6">
                       <h3>Update Order: <?php echo $wo_code; ?></h3>     
                    </div>  
                    <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                    <div class="col-sm-12 warning_alert mr-0"></div>
                </div>
                
                <div class="row justify-content-between mx-4">
                    
                    <div class="col-sm-5">
                     <?php
                    
                                     $findtax = Db::getInstance()->query("SELECT * FROM proceed WHERE request_code = '$wo_code'");     
                                     if($findtax->count()){
                                         
                                        $findtax = Db::getInstance()->query("SELECT * FROM proceed WHERE request_code = '$wo_code'");  
                                        foreach ($proceed->results() as $proceed) {
                                  ?>
                                  
                                      <button type="button" class="farm-button-disabled py-1 ml-0">
                                        <span class="fa fa-save"> <?php echo $proceed->proceed_status; ?></span>
                                      </button> 
                                      
                                  <?php
                                        }
                                  
                        
                                 
                                      }else{
                                          
                              ?>
                      <button type="button" class="farm-button-cancel py-1 ml-0" data-toggle="modal" data-target="#proceeds_status">
                        <i class="fa fa-hourglass-start text-danger"></i> Status
                      </button> 
                      
                            <?php
                                        }
                    
                                 ?>
                    
                    </div>
                    <div class="col-sm-4 px-0 mr-0">
                       
                    </div>
                    <div class="col-sm-3 text-right">
            
                          <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                            <span class="fa fa-chevron-left"></span>
                          </button>  
                          <?php
                                        $proceed = Db::getInstance()->query("SELECT * FROM workorders WHERE wo_code = '$wo_code' AND status = 'Completed'");   
                                        if($findtax->count()){
                                 
                                        }else{
                                            
                                             ?>
                          <button type="button" class="farm-button py-1 ml-0 add-output-item" id="<?php echo $member_id; ?>">
                            <span class="fa fa-save"> Add Output Items</span>
                          </button>
                          <?php 
                                        }
                          ?>
                          <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                            <span class="fa fa-refresh"></span>
                          </button>
                             
                    </div>
               </div>  
                <div class="row justify-content-between px-5 mt-3">
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            <h6 class="mb-0 text-dark" style="font-size:0.85em">
                          <b>Inputs Warehouse</b> &emsp;&emsp;|&emsp;&emsp; <?php echo $use->inputs_warehouse; ?> 
                         </h6> 
                         <h6 class="mb-0 text-dark" style="font-size:0.8em">
                          <b>Outputs Warehouse</b>&emsp;&emsp;|&emsp;&emsp; <?php echo $use->output_warehouse; ?> 
                         &emsp;&emsp;&emsp;
                        
                          </h6>
                          
                            </div>
                        </div>
                      </div>
                 </div>
                    <div class="col-sm-3">
                      <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Prepare by: </p>
                            <h5 class="mb-0 text-dark"><?php echo $use->registered; ?></h5>
                          </div>
                        </div>
                      </div>
                 </div>
                    <div class="col-sm-3">
                     <div class="card">
                        <div class="card-header p-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Amount 
                            <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, d.percentage
                                                                    FROM workorders_orders a 
                                                                    left join workorders b on a.workorders_id = b.id
                                                                    Left join tax_order d on a.purchase_code = d.item_code
                                                                    WHERE b.id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     $tax = $labelta->percentage;
                                     
                                     if($tax != ''){
                          ?>
                                    <span>(include tax) <?php echo $labelta->percentage; ?>%</span>
                            <?php
                                     }
                                 
                                $cost = $labelta->cost;
                                //Work Operator Cost
                               $operator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                                foreach ($operator->results() as $operate) {
                                    $operate_cost = $operate->estimated_cost;
                                    
                                    
                                $amount = $tax / 100 * $cost / 1;
                                $workorders_utility = Db::getInstance()->query("SELECT SUM(amount) as amount FROM workorders_utility WHERE workorders_id = $member_id");
                                foreach ($workorders_utility->results() as $workorders_util) {
                                $workorders_ut = $workorders_util->amount;
                                $total_cost = $cost + $amount + $workorders_ut + $operate_cost;
                                
                              ?>
                                    &nbsp;<span class="text-success">NGN <?php echo $total_cost; ?>.00</span>
                             <?php
                                    }
                                 }
                                }
                             }
                      ?>
                      </p>
                          </div>
                        </div>
                      </div>
                 </div>
                </div>
                <div class="row justify-content-between my-2 mx-4">
                   
                   <div class="col-sm-3 px-2">
                       <div class="card">
                            <?php
        
                          $useroperator = Db::getInstance()->query("SELECT * FROM workoperation
                          WHERE workorders_id = $member_id");
        
                          if (!$useroperator->count()) {
                              
                            echo "";
                            
                          } else {
                            foreach ($useroperator->results() as $usoperator) {
                        ?> 
                          <div class="card-header">
                            Work Operations <?php echo $usoperator->wop_code; ?>
                          </div>
                          
                          <div class="card-body">
                            <h5 class="card-title my-2"><?php echo $usoperator->description; ?></h5>
                            <p class="card-text" style="font-size:0.8em"><b>Cost Per Hour:</b> <?php echo $usoperator->cost_per_hour; ?> 
                            <br /> <b>Duration</b> <?php echo $usoperator->duration_in_hour; ?> hr(s)
                            <br / > <b>Estimated Cost:</b> NGN <?php echo $usoperator->estimated_cost; ?> 
                            <br /> <b>Assigned:</b> <?php echo $usoperator->assign_to; ?>  </p>
                            <p class="card-text" style="font-size:0.8em"><b>Additional Info</b> <br /><?php echo $usoperator->additional_info; ?></p>
                            <hr />
                           
                          </div>
                          <?php
                                
                                }
                            }
                          
                          
                          ?>
                        </div>
                   </div>
                
                   <div class="col-sm-9">
                       
                      <!-- Purchase order Table !-->  
                      <div class="card-header col-sm-12">
                            <div class="col-9">Input Items (Purchases Order)</div>
                            <div class="col-3">
                                
                                </div>
                          </div>
                      <div class="table-responsive data-font px-3">
                          <div class="row justify-content-between">
                                                               
            
                        <?php
        
                          $user = Db::getInstance()->query("SELECT * FROM workorders_orders WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                          } else {
        
                        ?> 
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                              <thead>
                                <tr> 
                                  <th>SN</th>
                                  <th>SKU Code</th>
                                  <th>Description</th>
                                  <th>Qty</th>
                                  <th style="text-align:right">Units Cost</td>
                                  <th style="text-align:right">Amount</td>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 1;
                                foreach ($user->results() as $user) {
        
                                ?>
                                  <tr>  
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $user->item_code; ?></td>
                                    <td><?php echo $user->description; ?></td>
                                    <td><?php echo $user->qty; ?></td>
                                    <td style="text-align:right"><?php echo $user->unit_cost; ?></td>
                                    <td style="text-align:right"><?php 
                                        $qty = $user->qty; 
                                        $unitcost = $user->unit_cost;
                                        $totalamount = $qty * $unitcost;
                                    echo $totalamount; ?>.00</td>
                                 
          
                                  </tr>
        
         
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>&nbsp;</td> 
                                    <td><b>Total</b></td>
                                    <td colspan='4' style="text-align:right">
                                         <?php
                                     $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, d.percentage
                                                                            FROM workorders_orders a 
                                                                            left join workorders b on a.workorders_id = b.id
                                                                            Left join tax_order d on a.purchase_code = d.item_code
                                                                            WHERE a.workorders_id = $member_id");     
                                     if($findtax->count()){
                                         foreach ($labeltax->results() as $labelta) {
                                             
                                             $tax = $labelta->percentage;
                                             
                                             if($tax != ''){
                                  ?>
                                            
                                    <span class="mr-5">(include tax) <?php echo $labelta->percentage; ?>%</span>
                                    <?php
                                             }
                                         
                                        $cost = $labelta->cost;
                                        
                                        $amount = $tax / 100 * $cost / 1;
                                        $total_cost = $cost + $amount;
                                      ?>
                              
                                    
                                    <span class="ml-5"><b>NGN <?php echo $total_cost; ?>.00</b></span>
                                     <?php
                                             
                                         }
                                        }
                                 
                              ?>
                                 <td>&nbsp;</td>  
                                </tr>
                              </tbody>
                            </table>
                          
                          <?php
                          }
                        
                        ?>
                      
                                    
                        </div>
                     </div>
                     
                      <!-- Utility Table !-->  
                    <div class="card-header col-sm-12">
                            <div class="col-9">Utility Bills</div>
                            <div class="col-3">
                                
                                </div>
                          </div>
                      <div class="table-responsive data-font px-3">
                          <div class="row justify-content-between">
                                                               
            
                        <?php
        
                          $user = Db::getInstance()->query("SELECT * FROM workorders_utility WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                          } else {
        
                        ?> 
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                              <thead>
                                <tr> 
                                  <th>SN</th>
                                  <th>Voucher Code</th>
                                  <th>Description</th>
                                  <th style="text-align:right">Amount</td>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 1;
                                foreach ($user->results() as $user) {
        
                                ?>
                                  <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $user->varchar_code; ?></td>
                                    <td><?php echo $user->description; ?></td>
                                    <td style="text-align:right"><?php echo $user->amount; ?></td>
                                   
                                  </tr>
        
         
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><b>Total</b></td>
                                    <td colspan='2' style="text-align:right">
                                         <?php
                                     $labeltax = Db::getInstance()->query("SELECT sum(amount) as amount
                                                                            FROM workorders_utility
                                                                            WHERE workorders_id = $member_id");     
                                     if($findtax->count()){
                                         foreach ($labeltax->results() as $labelta) {
                                  
                                         
                                        $cost = $labelta->amount;
                                      ?>
                              
                                    
                                    <span class="ml-5"><b>NGN <?php echo $cost; ?></b></span>
                                     <?php
                                             
                                         }
                                        }
                                 
                              ?>
                                 <td>&nbsp;</td>   
                                </tr>
                              </tbody>
                            </table>
                          <?php
                          }
                             
                        ?>
                      
                                    
                        </div>
                     </div>
                      
                      <!-- Purchase order Table !-->  
                      <div class="card-header col-sm-12">
                            Output Items (Sales Order)
                          </div>
                      <div class="table-responsive data-font px-3">
                          <div class="row justify-content-between">
                                                               
            
                        <?php
        
                          $user = Db::getInstance()->query("SELECT * FROM workoutput WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed.</h4></div>";
                          } else {
        
                        ?> 
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                              <thead>
                                <tr> 
                                  <th>SN</th>
                                  <th>SKU Code</th>
                                  <th>Description</th>
                                  <th>Qty</th>
                                  <th style="text-align:right">Amount</td>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 1;
                                foreach ($user->results() as $user) {
        
                                ?>
                                  <tr>  
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $user->sku_code; ?></td>
                                    <td><?php echo $user->description; ?></td>
                                    <td><?php echo $user->product_qty; ?></td>
                                    <td style="text-align:right"><?php  echo $user->total_revenue; ?></td>
                                    <td style="text-align:right">
                                        
                                    </td>
          
                                  </tr>
        
         
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>&nbsp;</td> 
                                    <td><b>Total Revenue</b></td>
                                    <td colspan='4' style="text-align:right">
                                         <?php
                                     $labeltax = Db::getInstance()->query("SELECT SUM(total_revenue) as cost FROM workoutput 
                                                                            WHERE workorders_id = $member_id");     
                                    
                                         foreach ($labeltax->results() as $labelta) {
                                             
                                            
                                  ?>
                                    
                                    <span class="ml-5"><b>NGN <?php echo $labelta->cost; ?>.00</b></span>
                                     <?php
                                             
                                         }
                              ?>
                                 <td>&nbsp;</td>  
                                </tr>
                              </tbody>
                            </table>
                          
                          <?php
                          }
                        
                        ?>
                      
                                    
                        </div>
                     </div>
                     
                     
                     <!-- Purchase order Table !--> 
                     <?php
        
                          $user = Db::getInstance()->query("SELECT * FROM sales_stocks_received WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                            
                          } else {
        
                        ?> 
                      <div class="card-header col-sm-12">
                            Sales Received Items Note
                          </div>
                      <div class="table-responsive data-font px-3">
                        <div class="row justify-content-between my-5">
                                                       
                        <?php

                  $user = Db::getInstance()->query("SELECT a.*, concat(d.firstname, ' ', d.lastname) as registered   
                  FROM sales_stocks_received a
                  Left join users b on a.added_by = b.id 
                  Left Join staff_record d on b.username = d.user_id
                  WHERE workorders_id = $member_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Item Code</th>
                          <th>Received By</th>
                          <th>Qty Received</th>
                          <th>Received Date</th>
                          <th>Addition Info</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->item_code; ?></td>
                            <td><?php echo $user->registered; ?></td>
                            <td class="text-right"><?php echo $user->qty_received; ?></td>
                            <td><?php echo $user->received_date; ?></td>
                            <td><?php echo $user->additional_info; ?></td>
                            <?php
                            
                                 if($pqty != $gqty || empty($gqty)){
                            
                            ?>
                            <td>
                              
                             
                            </td>
                            <?php
                            
                                 }
                            
                            ?>

  
                          </tr>

 
                        <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td>&nbsp;</td>
                            <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(qty_received) as gqty
                                                                    FROM sales_stocks_received 
                                                                    WHERE workorders_id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                      $labelpur = Db::getInstance()->query("SELECT SUM(product_qty) as pqty
                                                                FROM workoutput 
                                                                WHERE workorders_id = $member_id");   
                                foreach ($labelpur->results() as $labelpu) {
                                    
                                    
                                    $pqty = $labelpu->pqty;
                                    
                                     $totalreceived = $labelta->gqty;
                               
                                     
                                     if($totalreceived != ''){
                            ?>
                            <td class="alert alert-primary p-2 m-0">
                            <b>Total Goods Received</b> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $totalreceived; ?> of <?php echo $pqty; ?>
                               
                            </td>
                             <?php
                                        if($totalreceived > $pqty){
                                            echo '<td class="alert alert-success p-2 m-0">Surplus</td>';
                                        }else if($totalreceived < $pqty){
                                            echo '<td class="alert alert-warning p-2 m-0">Deficit</td>';
                                        }else if($totalreceived === $pqty){
                                            
                                        }
                                ?>
                            <?php
                                     }
                                 
                                     
                                
                        
                                 
                            ?>
                                    
                            
                            
                        </tr>
                        <?php
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
                     </div>
                     <?php
                          }
                        
                        ?>
                    </div>
           
                </div>
             
<!-- Create Received Stock Modal !-->

            <div class="modal fade" id="proceeds_status" data-backdrop="static" data-keyboard="false" 
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Status</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                    
                        <div class="modal-body">
                        <div class="row justify-content-between mr-2">
                            <div class="col-sm-12 success_alert mr-0"></div>
                            <div class="col-sm-12 warning_alert mr-0"></div>
                        </div>
                        <form id="status_form" name='status_form' method="post">
                          <div class="row">
                             
                              <div class="form-group col-sm-12 my-0 py-0">
                                <label for="status_">  Level </label>
                                  <select class="custom-select" id="status_" name="status_">
                                    <option value="<?php echo $use->status ?>"><?php echo $use->status ?></option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="On-hold">On-hold</option>
                                    <option value="Aborted">Aborted</option>
                                    <option value="Completed">Completed</option>
                                    </select>
                                <div class="invalid-feedback fetchone">
                                        Please, select one option.
                                      </div>
                              </div>
                            </div> 
                            <input type="hidden" id="workorders_id" name="workorders_id" value="<?php echo $member_id; ?>" class="form-control" />
                        </form>
                       </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SaveStatus">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                  
                </div>
              </div>
            </div> 
           
             <?php
             }
            ?>
            
        </div>
      </div>
    </div>
    </div>
    
  <?php
            
} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
  <script>
      $(document).ready(function(event){
          
            $('.success_alert').hide();
            $('.warning_alert').hide();
            
            
        $('.SaveStatus').on('click', function(){
       
                let form = $('#status_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/schedule/proceeds/update.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                         
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
            
    	$('.current_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
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
    
        $('.prev_page').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/schedule/proceeds/index.php",
    			data: {
    				'id': id
    			},
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
        
        $('.add-output-item').click(function (e) {
		
    		let member_id = $(this).attr('id');
    	
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/add-output-item.php",
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
       
       
        $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id = $(this).attr('id');
    		            let purchase_id = $(this).attr('lang');
    		             
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/schedule/proceeds/delete.php',
                		data: {
                		    tablename   : tablename,
                            id  : id,
                            purchase_id  : purchase_id
                		    
                		},
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
                
                
                e.preventDefault();
            });
         $("#product_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'product_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/schedule/proceeds/getoutputsku.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                //$("#product_id").empty();
                $('.tax_category').empty();
                
                    for( let i = 0; i<len; i++){
                   
                                                          
                    let sku_code                = response[i]['sku_code']
                    let uom                     = response[i]['uom']
                    let description             = response[i]['description']
                    let tax_category            = response[i]['tax_category']
                    let tax_percent             = response[i]['tax_percent']
                    let product_type            = response[i]['product_type']
                    let product_category        = response[i]['product_category']
                    let product_qty             = response[i]['product_qty']
                    let selling_price_type      = response[i]['selling_price_type']
                    let selling_price_default   = response[i]['selling_price_default']
                    let total_revenue           = response[i]['total_revenue']
                    let storage_location        = response[i]['storage_location']
                  
                  //alert(description)
                  
                   $('#sku_inv_code').val(sku_code);
                   $('#product_type').val(product_type);
                   $('#product_category').val(product_category);
                   $('#product_qty').val(product_qty);
                   $('.tax_category').append(tax_category);
                   $('#tax_category').val(tax_category);                   
                   $('#tax_percent').val(tax_percent);
                   $('#uom').val(uom);
                   $('#description').val(description);
                   $('#selling_price_type').val(selling_price_type);
                   $('#selling_price_default').val(selling_price_default);
                   $('#total_revenue').val(total_revenue);
                
                  }
    				 	
    			} 
    		});
     	}); 
    	
       event.preventDefault();
   });
   
   
   
   </script>

