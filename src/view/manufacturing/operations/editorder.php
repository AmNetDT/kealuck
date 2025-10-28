<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
?>

  
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid px-0 pt-5 bg-white">
        <div id="accounttile" class="container  px-0">
             <?php
 

            $users = Db::getInstance()->query("SELECT a.*, b.username, concat(d.firstname, ' ', d.lastname) as registered, 
            a.wo_code, c.location, d.image, a.id as workorders_id
            FROM workorders a 
            left join workorders_orders f on a.id = f.workorders_id
            left join worklocation c on a.inputs_warehouse_id = c.id 
            left join worklocation e on a.output_warehouse_id = e.id
            Left join users b on a.added_by = b.id 
            Left Join staff_record d on b.username = d.user_id 
            WHERE a.id =  $member_id");
                  
            foreach ($users->results() as $use) {
                
          
                $added_by               = $use->added_by;  
                $operation_type         = $use->type;
                $workorders_id          = $use->workorders_id;
                
               
            ?>
         
  
                <div class="row my-3 mb-4 justify-content-between">
                    <div class="col-sm-6">
                       <h3>Update Order: <?php echo $use->wo_code; ?></h3>     
                    </div>  
                    <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                    <div class="col-sm-12 warning_alert mr-0"></div>
                </div>
                
                 
                   
                    <div class="row justify-content-between">
                            <div class="col-sm-3">
                             <?php
                                     $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");     
                                     if($proceed->count()){
                                         
                                        
                                        foreach ($proceed->results() as $proceed) {
                                  ?>
                              <button type="button" class="farm-button-disabled py-1 ml-0">
                                <span class="fa fa-save"> <?php echo $proceed->proceed_status; ?></span>
                              </button> 
                              <?php
                                        }
                                        
                                      }else{
                                          
                                            ?> 
                              <button type="button" class="farm-button-cancel py-1 ml-0 request_proceed" id="<?php echo $member_id; ?>">
                                <span class="fa fa-save"> Save Proceed</span>
                              </button>
                              <?php
                                         
                                     }     
                                         ?>
                            
                        </div>
                            <div class="col-sm-6 px-0 mr-0">
                             <?php
                                     $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");   
                                     if(!$proceed->count()){
                                     
                                
                                        if($operation_type != "External"){
                
                                        
                                  ?>
                                  <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#addinputitem">
                                    <span class="fa fa-save"> Add Input Items</span>
                                  </button> 
                                  <?php
                                  
                                        }
                                  ?>
                                  
                                     <button type="button" class="farm-button py-1 ml-0 add-output-item" id="<?php echo $member_id; ?>">
                                        <span class="fa fa-save"> Add Output Items</span>
                                      </button>
                               <?php
                                         
                                        
                                     }
                               ?>
                            </div>
                            
                            <div class="col-sm-3 px-0 mr-0">
                                  <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                                    <span class="fa fa-chevron-left"></span>
                                  </button> 
                                 <?php
                                     $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");     
                                     if(!$proceed->count()){
                                         
                                     }else{
                                         
                                         ?> 
                                     <button type="button" class="farm-button py-1 ml-0 view_goodreceived" id="<?php echo $member_id; ?>">
                                        <span class="fa fa-save"> Sales Received</span>
                                      </button>
                                  <?php
                                  
                                     }
                                     
                                     ?>
                                  <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                                    <span class="fa fa-refresh"></span>
                                  </button>
                                  
                                     
                            </div>
                        </div>
                      
                 
                <div class="row justify-content-between  mx-0 px-0 mt-3">
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            <h6 class="mb-0 text-dark" style="font-size:0.85em">
                          <b>Inputs Warehouse</b> &emsp;&emsp;|&emsp;&emsp; <?php echo $use->location; ?> 
                         </h6> 
                         <h6 class="mb-0 text-dark" style="font-size:0.8em">
                          <b>Outputs Warehouse</b>&emsp;&emsp;|&emsp;&emsp; <?php echo $use->location; ?> 
                         &emsp;&emsp;&emsp;
                         <?php
                                    $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");     
                                     if(!$proceed->count()){
                            
                            ?>
                         <button type="button" class="farm-button-disabled border edit_input_output_warehouse" id="<?php echo $member_id; ?>" style="float:right;">
                                   <span class="fa fa-edit"></span></button>
                                    <?php
                                            }
                                    ?>
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
                            if($operation_type === 'Internal'){
                                
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost
                                                                    FROM workorders_orders a 
                                                                    left join workorders b on a.workorders_id = b.id
                                                                    WHERE b.id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                 
                                $cost = $labelta->cost;
                                //Work Operator Cost
                                $operator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                                foreach ($operator->results() as $operate) {
                                $operate_cost = $operate->estimated_cost;
                                    
                                    
                                $workorders_utility = Db::getInstance()->query("SELECT SUM(amount) as amount FROM workorders_utility WHERE workorders_id = $member_id");
                                foreach ($workorders_utility->results() as $workorders_util) {
                                $workorders_ut = $workorders_util->amount;
                                $total_cost = $cost + $workorders_ut + $operate_cost;
                                
                              ?>
                                    &nbsp;<span class="text-dark">NGN <?php echo $total_cost; ?>.00</span>
                             <?php
                                    }
                                 }
                                }
                             }
                             
                            }else{
                                 
                             $labeltax = Db::getInstance()->query("SELECT total_revenue as cost
                                                                    FROM workoutput a 
                                                                    left join workorders b on a.workorders_id = b.id
                                                                    WHERE b.id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     
                                $cost = $labelta->cost;
                                //Work Operator Cost
                               $operator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                                foreach ($operator->results() as $operate) {
                                    $operate_cost = $operate->estimated_cost;
                                    
                                    
                                $total_cost = $cost + $operate_cost;
                                
                              ?>
                                    &nbsp;<span class="text-dark">NGN <?php echo $total_cost; ?>.00</span>
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
                <div class="row justify-content-between my-2 mx-0 px-0">
                    <?php
                                $useroperator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                                if (!$useroperator->count()) {
                                      $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");     
                                     if(!$proceed->count()){
                    ?>
                    <div class="col-sm-3">
                    <button type="button" class="farm-button-blend add-operator" lang="<?php echo $member_id ?>" >
                                   <span class="fa fa-plus"></span> Add Operator</button>
                                   </div>
                    <?php
                                     }
                                }
                    ?>
                   <?php
                                    
                            $useroperator = Db::getInstance()->query("SELECT * FROM workoperation WHERE workorders_id = $member_id");
                            
                           
                            if ($useroperator->count()) {
                              foreach ($useroperator->results() as $usoperator) {
                            ?> 
                            <div class="col-sm-3 px-2">
                            <div class="card">
                            
                            <div class="card-header">
                              Work Operations <?php echo $usoperator->wop_code; ?>
                            </div>
                            
                            <div class="card-body">
                              <h5 class="card-title my-2"><?php echo $usoperator->description; ?></h5>
                              <p class="card-text" style="font-size:0.9em"><b>Cost Per Hour:</b> <?php echo $usoperator->cost_per_hour; ?> 
                              <br /> <b>Duration</b> <?php echo $usoperator->duration_in_hour; ?> hr(s)
                              <br / > <b>Estimated Cost:</b> NGN <?php echo $usoperator->estimated_cost; ?> 
                              <br /> <b>Assigned:</b> <?php echo $usoperator->assign_to; ?>  </p>
                              <?php
                                      if(!empty($usoperator->additional_info)){
                              ?>
                              <p class="card-text" style="font-size:0.9em"><b>Additional Info</b> <br /><?php echo $usoperator->additional_info; ?></p>
                              <?php
                              
                                      }
                              
                              ?>
                              <hr />
                              <?php
                                      $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id"); 
                                     if(!$proceed->count()){
                              
                              ?>
                             
                              <button type="button" class="farm-button-disabled border edit-operation" id="<?php echo $usoperator->id; ?>" lang="<?php echo $member_id; ?>">
                                         <span class="fa fa-edit"></span> Edit</button>
                              <button type="button" class="btn-danger border singledelete" lang="id" title="workoperation" id="<?php echo $usoperator->id; ?>">
                                        <span class="fa fa-close"></span></button>
                              <?php
                                      }
                              ?>
                            </div>
                            
                            </div>
                            </div>
                            
                            
                            <?php
                              }
                            }
                            
                            ?>
                   <div class="col-sm-9">
                       
                      <!-- Purchase order Table !-->  
                      <?php
                                   
        
                                        if($operation_type != "External"){
                                            //this is to identify the external order from the internal order (Database table `workorders_orders`)
                    
                        
                          $us = Db::getInstance()->query("SELECT * FROM workorders_orders WHERE workorders_id = $member_id");
        
                          if (!$us->count()) {
                            
                          } else {
        
                    
                
                        ?> 
                      <div class="card-header col-sm-12">
                          <div class="col-8">Input Items (Purchases Order) 
                          </div>
                            <div class="col-4">
                                <?php
                                     $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");     
                                     if(!$proceed->count()){
                            
                            ?>
                                <button type="button" class="farm-button-disabled border" 
                                style="float:right; font-size:0.9em" data-toggle="modal" data-target="#edit_input_warehouse">
                                    <span class="fa fa-close text-danger"></span> Cancel</button>
                                    <?php
                                            }
                                    ?>
                                </div>
                          </div>
                         
                      <div class="table-responsive data-font px-3">
                          <div class="row justify-content-between">
                                                               
            
                        
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.9em;">
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
                                
                                $using = Db::getInstance()->query("SELECT * FROM workorders_orders WHERE workorders_id = $member_id");
                                foreach ($using->results() as $using) {
        
                                ?>
                                  <tr>  
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $using->item_code; ?></td>
                                    <td><?php echo $using->description; ?></td>
                                    <td><?php echo $using->qty; ?></td>
                                    <td style="text-align:right"><?php echo $using->unit_cost; ?></td>
                                    <td style="text-align:right"><?php 
                                        $qty = $using->qty; 
                                        $unitcost = $using->unit_cost;
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
                                     $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost
                                                                            FROM workorders_orders a 
                                                                            left join workorders b on a.workorders_id = b.id
                                                                            WHERE a.workorders_id = $member_id");     
                                     if($labeltax->count()){
                                         foreach ($labeltax->results() as $labelta) {
                                             
                                           
                                         
                                        $total_cost = $labelta->cost;
                                        
                                        
                                      ?>
                              
                                    
                                    <span class="ml-5"><b>NGN <?php echo $total_cost; ?></b></span>
                                     <?php
                                             
                                         }
                                        }
                                 
                              ?>
                                 <td>&nbsp;</td>  
                                </tr>
                              </tbody>
                            </table>
                          
                      
                                    
                        </div>
                     </div>
                     
                      <!-- Utility Table !-->  
                      
                        <?php
                          }
                          
                          
                          $user = Db::getInstance()->query("SELECT * FROM workorders_utility WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                            
                          } else {
        
                        ?> 
                        <div class="card-header col-sm-12">
                            <div class="col-9">Utility Bills</div>
                            <div class="col-3">
                                <?php
                                    $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");   
                                     if(!$proceed->count()){
                            
                            ?>
                                <button type="button" class="farm-button-disabled border" 
                                style="float:right; font-size:0.85em" data-toggle="modal" data-target="#edit_utility">
                                    <span class="fa fa-close text-danger"></span> Cancel</button>
                                <?php
                                    }
                                ?>
                                </div>
                          </div>
                        <div class="table-responsive data-font px-3">
                          <div class="row justify-content-between">
                                                               
            
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                              <thead>
                                <tr> 
                                  <th>SN</th>
                                  <th>Code</th>
                                  <th>Description</th>
                                  <th style="text-align:right">Amount</td>
                                  <th>&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 1;
                                
                                $user = Db::getInstance()->query("SELECT * FROM workorders_utility WHERE workorders_id = $member_id");
                                foreach ($user->results() as $user) {
        
                                ?>
                                  <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $user->varchar_code; ?></td>
                                    <td><?php echo $user->description; ?></td>
                                    <td style="text-align:right"><?php echo $user->amount; ?></td>
                                    <td></td>
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
                                     if($labeltax->count()){
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
                         
                      
                                    
                        </div>
                     </div>
                       <?php
                              }
                                       
                                       //this is to identify the external order from the internal order
                                                                             }
                        
                                
                          
                         
                          
        
                          $user = Db::getInstance()->query("SELECT * FROM workoutput WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                           
                          } else {
        
                        ?> 
                      <div class="card-header col-sm-12">
                          <div class="col-9">
                          <?php
                                if($operation_type === 'Internal'){
                                    echo 'Output Items (Sales Order)';
                                }else{
                                    echo 'External Production (Sales Order)';
                                }
                          ?>
                            </div>
                          </div>
                      <div class="table-responsive data-font px-3">
                          <div class="row justify-content-between">
                                                               
            
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
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
                                         <?php
                                                
                                                $proceed = Db::getInstance()->query("SELECT * FROM proceed WHERE item_id = $workorders_id");     
                                     if(!$proceed->count()){
                            
                                            ?>
                                        <button type="button" class="farm-button-disabled border singledelete" lang="id"
                                        title="workoutput" id="<?php echo $user->id; ?>"
                                        style="float:right;"><span class="fa fa-trash"></span></button>
                                        <?php
                                                }
                                        ?>
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
                                            
                                    
                              
                                    
                                    <span class="ml-5"><b>NGN <?php echo $labelta->cost; ?></b></span>
                                     <?php
                                             
                                         }
                              ?>
                                 <td>&nbsp;</td>  
                                </tr>
                              </tbody>
                            </table>
                          
                                    
                        </div>
                     </div>
                       <?php
                          }
                       ?>
                      
                    </div>
           
                </div>
            
            <div class="modal fade" id="addinputitem" data-backdrop="static" data-keyboard="false" 
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Add Item</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                    <form id="purchaseItem_form" method="post">
                        <div class="modal-body">
                        <div class="row justify-content-between mr-2">
                            <div class="col-sm-12 success_alert mr-0"></div>
                            <div class="col-sm-12 warning_alert mr-0"></div>
                        </div>
                          <div class="row">
                             
                              <div class="form-group col-sm-12 my-0 py-0">
                                <label for="table">  Item Code </label>
                                  <select class="custom-select" id="table" name="table">
                                    <option selected>--Select--</option>
                                    <option value="purchases">Purchase Order</option>
                                    <option value="utilities">Utility Bill</option>
                                    </select>
                                <div class="invalid-feedback fetchone">
                                        Please, provide an Item Code.
                                      </div>
                              </div>
                            </div> 
                          <div class="row">
                             
                              <div class="form-group col-sm-12 my-0 py-0">
                                <label for="item_code">  Item Code </label>
                                <input type="text" id="item_code" name="item_code" class="form-control" />
                                <div class="invalid-feedback fetchone">
                                        Please, provide an Item Code.
                                      </div>
                              </div>
                            </div> 
                            <input type="hidden" id="workorders_id" name="workorders_id" value="<?php echo $member_id; ?>" class="form-control" />
                       </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SaveItem">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                     </form>
                  
                </div>
              </div>
            </div>   
            
            
            <!-- Edit Input Items !-->
            
            <div class="modal fade" id="edit_input_warehouse" data-backdrop="static" data-keyboard="false" 
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Delete Input Items</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                          
                    <div class="modal-body">
                        <div class="row">
                              <diiv class="col-sm-12 p-2 success_alert"></diiv>
                              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
                          </div>
                          <div class="row"> 
                            <div class="col-12">
                                 <?php
                                     $workorders_orders = Db::getInstance()->query("SELECT distinct purchase_code, purchase_id
                                                                            FROM workorders_orders
                                                                            WHERE workorders_id = $member_id");     
                                     if($workorders_orders->count()){
                                         foreach ($workorders_orders->results() as $workorders) {
                                  
                                         
                                      ?>
                                      
                                    <div class="alert-secondary p-1 m-1"><?php echo $workorders->purchase_code; ?> 
                                        <button type="button" class="farm-button-disabled border singledelete" lang="purchase_id"
                                        title="workorders_orders" id="<?php echo $workorders->purchase_id; ?>"
                                        style="float:right;"><span class="fa fa-trash"></span></button>
                                    </div>
                                    
                              <?php
                                         }
                                     }
                                         ?>
                             </div>
                          </div>
                    </div>
                </div>
              </div>
            </div>
            
            
            <!-- Edit Utilities Items !-->
            
            <div class="modal fade" id="edit_utility" data-backdrop="static" data-keyboard="false" 
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Delete Utility</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                          
                    <div class="modal-body">
                        <div class="row">
                              <diiv class="col-sm-12 p-2 success_alert"></diiv>
                              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
                          </div>
                          <div class="row"> 
                            <div class="col-12">
                                 <?php
                                     $workorders_utility = Db::getInstance()->query("SELECT distinct varchar_code, utility_id
                                                                            FROM workorders_utility
                                                                            WHERE workorders_id = $member_id");     
                                     if($workorders_utility->count()){
                                         foreach ($workorders_utility->results() as $workorders_) {
                                  
                                         
                                      ?>
                                      
                                    <div class="alert-secondary p-1 m-1"><?php echo $workorders_->varchar_code; ?> 
                                        <button type="button" class="farm-button-disabled border singledelete" lang="utility_id"
                                        title="workorders_utility" id="<?php echo $workorders_->utility_id; ?>"
                                        style="float:right;"><span class="fa fa-trash"></span></button>
                                    </div>
                                    
                              <?php
                                         }
                                     }
                                         ?>
                             </div>
                          </div>
                    </div>
                </div>
              </div>
            </div>

            
        </div>
      </div>
    </div>
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
          
            $('.success_alert').hide();
            $('.warning_alert').hide();
          
        $('.request_proceed').on('click',function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(member_id);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/request_proceed.php",
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
		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/index.php",
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
    	
    	$('.current_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
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
    	
    	$('.edit_input_output_warehouse').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/edit-input-output-location.php",
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
    	
    	$('.edit-operation').click(function (e) {
    	
    		let _id = $(this).attr('id');
    		let member_id = $(this).attr('lang');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/edit-operator.php",
    			data: {
    				'member_id': member_id,
    				'_id': _id
    			},
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});
    	
 	    $('.add-operator').click(function (e) {
 	        
 	        let member_id = $(this).attr('lang');
		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/add-operator.php",
    			data: {
    			
    				member_id: member_id
    			},
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});  
      	
     	
        $('.view_goodreceived').click(function (e) {
		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/sales_stocks_received.php",
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
     	
    	$('.view_invoice').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/view.php",
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
        
        $('.SaveItem').on('click', function(){
       
                let form = $('#purchaseItem_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/manufacturing/operations/insertitem_order.php',
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
       
   
        $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id = $(this).attr('id');
    		            let purchase_id = $(this).attr('lang');
    		             
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/manufacturing/operations/delete.php',
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
            
        
    	
       event.preventDefault();
   });
   
   
   
   </script>

