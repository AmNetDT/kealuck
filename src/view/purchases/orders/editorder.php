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
      <div class="jumbotron pt-5 bg-white">
             <?php


            $users = Db::getInstance()->query("SELECT a.*, b.username, c.name as supplier, e.approval_status, 
                  concat(d.firstname, ' ', d.lastname) as registered, a.supplier_id, c.supplier_code
                  FROM purchases a 
                  Left join users b on a.added_by = b.id 
                  Left join staff_record d on b.username = d.user_id 
                  left join suppliers c on a.supplier_id = c.id
                  left join approval e on a.purchase_code = e.request_code
                  WHERE a.id = $member_id");
                  
            foreach ($users->results() as $use) {
                
                $purchase_code  = $use->purchase_code;
                $supplier_id    = $use->supplier_id;               
                $added_by       = $use->added_by;           
                $purchase_id    = $use->id; 
                $status         = $use->approval_status;
            ?>
            
                <!-- Discount Modal !-->
                <div class="modal fade" data-backdrop="static" id="taxmodal" tabindex="-1">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                     <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Add Discount</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>" >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                          <div class="modal-body">
                              
                                    <div class="alert-warning mb-2 p-2 warning"></div>
                                   
                                         <div class="success_alert mb-1 p-2"></div>
                                         <div class="warning_alert mb-1 p-2"></div>
                                     
                                     
                             
                      <form id="discount_form" name="discount_form" method="post">
                            <div class="row justify-content-between my-3">
                            <div class="col-12">
                             <div class="input-group mb-3">
                              <input type="text" class="form-control" id="discount_" name="discount_" />
                              <div class="input-group-append">
                                <label class="input-group-text" for="discount_">% percent</label>
                              </div>
                            </div>
                            </div>
                            </div>
                            
                            <div class="row justify-content-between my-3">
                                        <div class="col-12">
                                        <label for="note">Additional Info.</label>
                                        <textarea class="form-control" id="additional_info" name="additional_info"></textarea>
                                    </div>
                                </div>
                            
                                <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id; ?>" />
                                <input type="hidden" name="item_code" id="item_code" value="<?php echo $purchase_code; ?>" />
                                
                      </form>
                          <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SaveDiscount">
                            <span class="fa fa-save"> Save</span></button>
                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                    </div>
              </div>
                </div>

        
                </div>
            
                <!-- Landing Cost Modal !-->
                <div class="modal fade" data-backdrop="static" id="addlandingcost" tabindex="-1">
             
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                     <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Add Landing Cost</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>" >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                          <div class="modal-body">
                              
                                    <div class="alert-warning mb-2 p-2 warning"></div>
                                   
                                         <div class="success_alert mb-1 p-2"></div>
                                         <div class="warning_alert mb-1 p-2"></div>
                                     
                                     
                            <form id="landing_form" name="landing_form" method="post">
                                <div class="row justify-content-between">
                                      
                                    <div class="col-12">
                                        <label for="landing_cost">Cost</label>
                                        <input type="number" name="landing_cost" id="landing_cost" class="form-control"/>
                                    </div>
                                    </div>
                                <div class="row justify-content-between my-3">
                                        <div class="col-12">
                                        <label for="note">Additional Info.</label>
                                        <textarea class="form-control" id="additional_info" name="additional_info"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id; ?>" />
                                <input type="hidden" name="item_code" id="item_code" value="<?php echo $purchase_code; ?>" />
                                <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $purchase_id; ?>" />
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SaveLanding">
                            <span class="fa fa-save"> Save</span></button>
                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                </div>
              </div>
            </div>
            
                <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Update Order: <?php echo $purchase_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                      
                    </div> 
                </div>
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-sm-3">
                         <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                          <button type="button" class="farm-button-disabled py-1 ml-0">
                            <span class="fa fa-save"> Requested</span>
                          </button> 
                          <?php
                                     }
                                  }else{
                                        ?> 
                          <button type="button" class="farm-button-cancel py-1 ml-0 request_approval" id="<?php echo $member_id; ?>">
                            <span class="fa fa-save"> Request Approval</span>
                          </button>
                          <?php
                                     
                                 }     
                                     ?>
                        
                    </div>
                    <div class="col-sm-4 px-0 mr-0">
                        <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                          
                          <?php
                                     }
                                  }else{
                                        ?> 
                          
                          <button type="button" class="farm-button-blend py-1 ml-0" data-toggle="modal" data-target="#ordermodal">
                            <span class="fa fa-save"> Edit Order</span>
                          </button>        
                          <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#additem">
                            <span class="fa fa-save"> Add Items</span>
                          </button> 
                          <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM purchase_discount WHERE item_code = '$purchase_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                                          
                                         <button type="button" class="farm-button-disabled py-1 ml-0 singledelete" id="<?php echo $findta->id; ?>" title="purchase_discount" >
                                            <span class="fa fa-trash"> Remove Discount </span>
                                          </button>
                                <?php
                                     }
                                    }else{
                             
                          ?>
                          <span id="refresh">
                          <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#taxmodal">
                            <span class="fa fa-save"> Add Discount</span>
                          </button>  
                          </span>
                             <?php
                                    }
                                     
                                 }     
                                     ?>
                    </div>
                    <div class="col-sm-5 px-0 mr-0 text-right">
            
                          <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" lang="view/purchases/orders" id="#">
                            <span class="fa fa-chevron-left"></span>
                          </button>  
                          <?php
                          
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
                                        
                                        if($status != "Approved"){
                                            
                                          echo "";
                                          
                                        }else if($status === "Approved" && $gqty != $pqty){
                          
                          ?>
                          <button type="button" class="farm-button py-1 ml-0 view_goodreceived" id="<?php echo $member_id; ?>">
                            <span class="fa fa-save"> Good Received Note (GRN)</span>
                          </button> 
                          <?php
                                        }else if( $gqty === $pqty ){
                            ?>
                          <button type="button" class="farm-button py-1 ml-0 view_goodreceived" id="<?php echo $member_id; ?>">
                            <span class="fa fa-save"> Received Note</span>
                          </button>         
                          <?php
                                        }
                                     }
                                }
                            }
                          
                          ?>
                          <button type="button" class="farm-button py-1 ml-0 view_invoice" lang="view/purchases/orders" id="<?php echo $member_id; ?>">
                            <span class="fa fa-print"> Supplier Invoice</span>
                          </button> 
                          <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                            <span class="fa fa-refresh"></span>
                          </button>
                          
                    </div>
               </div>  
                <div class="row justify-content-between mt-3">
                 <div class="col-sm-2">
                     
                 </div>
                 <div class="col-sm-5">
                      <div class="card">
                        <div class="card-header pt-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Prepare by: </p>
                            <h5 class="mb-0 text-dark"><?php echo $use->registered; ?></h5>
                          </div>
                        </div>
                      </div>
                 </div>
                 <div class="col-sm-5">
                     <div class="card">
                        <div class="card-header pt-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Amount 
                            <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.discount, d.cost as landing_cost
                                                                    FROM purchase_order a 
                                                                    left join purchases b on a.purchase_id = b.id
                                                                    Left join purchase_discount c on b.purchase_code = c.item_code
                                                                    Left join landing_cost d on b.purchase_code = d.item_code
                                                                    WHERE a.purchase_id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     $discount = $labelta->discount;
                                     $landing_cost = $labelta->landing_cost;
                                     $cost = $labelta->cost;
                                     
                                     if($discount != ''){
                          ?>
                                    <span>(include <?php echo $labelta->discount; ?>% discount on goods) </span>
                            <?php
                                     }
                                 
                                
                                    $amount = $discount / 100 * $cost / 1;
                                    $total_discount = $cost - $amount;
                                    $total_cost = $total_discount + $landing_cost;
                                
                                
                              ?>
                      </p>
                            <h4 class="mb-0">NGN <?php 
                            
                               
                                $Total_Amount = number_format($total_cost);
                                echo $Total_Amount; 

                            
                            
                            ?></h4>
                             <?php
                                     
                                 }
                                }
                         
                      ?>
                          </div>
                        </div>
                      </div>
                 </div>
                </div>
                <div class="row justify-content-between my-2">
                    
                    <?php
                            
                          
                                     
                          $useroperator = Db::getInstance()->query("SELECT * FROM landing_cost
                          WHERE purchase_id = '$purchase_id'");
        
                          if (!$useroperator->count()) {
                           
                                   
                            ?>
                            <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                 if($findtax->count()){
                              ?>
                              <div class='col-sm-3'></div>
                                     <?php
                                  }else{
                                      
                                        ?> 
                            <div class='col-sm-3'>
                                    <button class='farm-button-blend' data-toggle='modal' data-target='#addlandingcost'>Add Delivery Cost</button>
                                    </div>
                            
                            <?php
                                  }
                                    
                          } else {
                              
                            foreach ($useroperator->results() as $usoperator) {
                        ?> 
                   <div class="col-sm-2 px-2">
                       <div class="card">
                          <div class="card-header">
                            Landing Cost (Delivery)
                            
                          </div>
                          
                          <div class="card-body">
                            <div class="row justify-content-between">
                            <div class="col-8"><?php
                            
                                $numb = $usoperator->cost;
                                $Total_numb = number_format($numb);
                                 echo $Total_numb; 

                            ?></div>
                            <div class="col-4">
                            
                            <?php
                             $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                             if($findtax->count()){
                                 foreach ($findtax->results() as $findta) {
                          ?>
                                
                                    <?php
                                 }
                              }else{
                                  
                                    ?> 
                                      
                                     <button type="button" class="btn-secondary border py-1 ml-0 singledelete" id="<?php echo $usoperator->id; ?>" title="landing_cost" >
                                        <span class="fa fa-trash"></span>
                                      </button>
                            <?php
                                
                         
                                    }
                            ?>
                            </div>
                            </div>
                            <p class="card-text" style="font-size:0.8em"><b>Additional Info</b> 
                            <br /><?php echo $usoperator->additional_info; ?></p>
                            <hr />
                            
                          </div>
                        </div>
                   </div>
                    
                
                    
                    
         
                   <?php
                            }
                          }
                                  
                   ?>
                   <div class="col-sm-10">
              <div class="table-responsive data-font px-3" style="height: 120%;">
                  <div class="row justify-content-between">
                                                       
    
                <?php

                  $user = Db::getInstance()->query("SELECT a.*, b.id as currency_id, b.sign, c.location, d.description AS bin_name, e.sku_code AS inventory_code
                                                    FROM purchase_order a
                                                    LEFT JOIN currency b ON  a.currency_id = b.id
                                                    LEFT JOIN worklocation c ON a.warehouse_id = c.id
                                                    LEFT JOIN bin d ON a.bin_id = d.id
                                                    LEFT JOIN products e ON a.inventory_id = e.id
                                                    WHERE purchase_id =  $member_id");

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
                                          <th>Warehouse</th>
                                          <th>Bin</th>
                                          <th>Inventory Code</th>
                                          <th>Qty</th>
                                          <th>Currency</th>
                                          <th class="text-right pr-3">Units Cost</td>
                                          <th class="text-right pr-3">Amount</td>
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
                                            <td><?php echo $user->location; ?></td>
                                            <td><?php echo $user->bin_name; ?></td>
                                            <td><?php echo $user->inventory_code; ?></td>
                                            <td><?php echo $user->qty; ?></td>
                                            <td><?php echo $user->sign; ?></td>
                                            <td class="text-right pr-3"><?php 
                                            
                                                $num = $user->unit_cost;
                                                $Total_num = number_format($num);
                                                echo $Total_num; 
                                                
                                                ?></td>
                                            <td class="text-right pr-3"><?php 
                                                $qty = $user->qty; 
                                                $unitcost = $user->unit_cost;
                                                $totalamount = $qty * $unitcost;
                                                
                                                
                                                 $Total_Amnt = number_format($totalamount);
                                                echo $Total_Amnt;
                                            
                                                ?></td>
                                            <td>
                                                     <?php
                                             $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                             if($findtax->count()){
                                                 foreach ($findtax->results() as $findta) {
                                          ?>
                                                
                                                    <?php
                                                 }
                                              }else{
                                                    ?> 
                                                
                                              <div class="dropdown">
                                                  
                                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                                </button>
                                                
                                                <div class="dropdown-menu">
                                                  <div class="singledelete" id="<?php echo $user->id; ?>" title="purchase_order" >
                                                        <button class="dropdown-item">
                                                             <i class="fa fa-trash"></i> &nbsp;Remove</button>
                
                                                    </div>
                                                    
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
                                          <?php
                                            $landingCost = $user->purchase_id;
                                            
                                                 $userlandingCost = Db::getInstance()->query("SELECT a.id, a.cost FROM landing_cost a 
                                                 left join purchases b on a.purchase_id = b.id
                                                    WHERE a.purchase_id = $landingCost");
                        
                                          if ($userlandingCost->count()) {
                                              
                                              foreach ($userlandingCost->results() as $userlandingCost) {
                                          ?>
                                          <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td>Landing Cost</td>
                                            <td colspan='8' class="text-right pr-3"><?php 
                                            
                                            $totalamnt = $userlandingCost->cost;
                                             $Total_Amt = number_format($totalamnt);
                                             echo $Total_Amt;
                                         
                                            
                                            ?></td>
                                            
                                            <td>
                                                     <?php
                                             $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$purchase_code'");     
                                             if($findtax->count()){
                                                 foreach ($findtax->results() as $findta) {
                                          ?>
                                                
                                                    <?php
                                                 }
                                              }else{
                                                  
                                                    ?> 
                                                
                                              <div class="dropdown">
                                                  
                                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                                </button>
                                                
                                                <div class="dropdown-menu">
                                                  <div class="singledelete" id="<?php echo $userlandingCost->id; ?>" title="landing_cost" >
                                                        <button class="dropdown-item">
                                                             <i class="fa fa-trash"></i> &nbsp;Remove</button>
                
                                                    </div>
                                                    
                                                </div>
                
                                              </div>
                                             
                                                  <?php
                                                 
                                             }     
                                                 ?>
                                            </td>
                                          </tr>
                                        <?php
                                            }
                                          }
                                        ?>
                                            
                                          <tr>
                                            <td><b>Total</b></td>
                                            <td colspan='9' style="text-align:right">
                                                 <?php
                                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.discount, d.cost as landing_cost
                                                                                    FROM purchase_order a 
                                                                                    left join purchases b on a.purchase_id = b.id
                                                                                    Left join purchase_discount c on b.purchase_code = c.item_code
                                                                                    Left join landing_cost d on b.purchase_code = d.item_code
                                                                                    WHERE a.purchase_id = $member_id");     
                                             if($labeltax->count()){
                                                 foreach ($labeltax->results() as $labelta) {
                                                     
                                                     $discount = $labelta->discount;
                                                     $landing_cost = $labelta->landing_cost;
                                                     $cost = $labelta->cost;
                                                     
                                                     if($discount != ''){
                                          ?>
                                                    <span>(include <?php echo $labelta->discount; ?>% discount on goods) </span>
                                            <?php
                                                     }
                                                 
                                                
                                                    $amount = $discount / 100 * $cost / 1;
                                                    $total_discount = $cost - $amount;
                                                    $total_cost = $total_discount + $landing_cost;
                                                
                                                
                                              ?>
                                     
                                            <h4 class="mb-0">NGN <?php 
                                            
                                                
                                                $Ttotal_cost = number_format($total_cost);
                                                 echo $Ttotal_cost; 
                
                                         
                                            ?></h4>
                                             <?php
                                                     
                                                 }
                                                }
                                         
                                      ?>
                                            </td>
                                        </tr>
                                       
                                      </tbody>
                                    </table>
                  <?php
                  }
                
                ?>
              
                            
                </div>
             </div>
             </div>
                    <!-- Modal -->
                    <div class="modal fade" id="ordermodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Edit Purchase Order</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                    <form id="purchaseorder_form" method="post">
                     <div class="modal-body">
              
                     <div class="row">
                         <div class="col-sm-12">    
                             <div class="row my-4">
                                <div class="col-sm-12">
                                     <div class="success_alert"></div>
                                     <div class="warning_alert"></div>
                                 </div>
                            </div>
                             <div class="row">
                              <div class="form-group col-sm-6">
                                <label for="purchase_code">Purchase Code</label>
                                <input type="text" id="purchase_code" name="purchase_code" class="form-control" value="<?php echo $use->purchase_code; ?>" readonly />
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label for="date_time">Date &amp; Time</label>
                                <input type="datetime-local" id="date_time" name="date_time" class="form-control" value="<?php echo $use->date_time; ?>" />
                                
                              </div>
                              
                              <div class="form-group col-sm-6">
                              
                                <label for="type">Purchase Type</label>
                                <input type="text" class="form-control" value="<?php echo $use->type; ?>" disabled/>
                                <input type="hidden" id="type" name="type" class="form-control" value="Standard - Purchase Order" />
                                
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label for="expecteddate">Expected Date</label>
                                <input type="datetime-local" class="form-control" id="expecteddate" name="expecteddate" value="<?php echo $use->expecteddate; ?>" />
                                
                             
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label for="supplier_id">Supplier Code</label>
                                <select class="form-control" id="supplier_id" name="supplier_id">
                                    <option value="<?php echo $use->supplier_id; ?>" selected><?php echo $use->supplier_code; ?></option>
                                    <?php
                              $products = Db::getInstance()->query("SELECT * FROM `suppliers`");
                                 if (!$products->count()) {
                                     
                                     echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                     
                                 }else{
                                   
                                            foreach ($products->results() as $prod) {
                                     ?>
                                
                                  <option value="<?php echo $prod->id; ?>"><?php echo $prod->supplier_code; ?></option>
                                  <?php
                                          }
                                                                             }
                                      ?>
                                </select>
                              </div>  
                              <div class="form-group col-sm-6">
                                <label for="supplier">Supplier</label>
                                <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $use->supplier; ?>" disabled />
                                
                              </div>
                              <div class="form-group col-sm-12">
                              
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note" rows="3"><?php echo $use->note; ?></textarea>
                                
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label>Modified Date:<br /> <?php echo $use->modified_date; ?></label>
                                
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label>Created Date:<br /> <?php echo $use->created_date; ?></label>
                                
                              </div>
                    </div>
                         </div>
                      </div>
                    
            
            
                                <input type="hidden" name="purchase_code" id="purchase_code" value="<?php echo $purchase_code; ?>" />
                                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>"  />
                       </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                     </form>
                  
                </div>
              </div>
            </div>                  
            
                    <!-- Modal -->
                    <div class="modal fade" id="additem" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Add Item</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                    <form id="purchaseItem_form" method="post">
                            <div class="modal-body">
                          
                                 <div class="row">
                                     <div class="col-sm-12">    
                                         <div class="row my-4">
                                            <div class="col-sm-12">
                                                 <div class="success_alert"></div>
                                                 <div class="warning_alert"></div>
                                             </div>
                                        </div>
                                         <div class="row">
                                         
                                          
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="sku_code">SKU Code</label>
                                            <select class="form-control" id="sku_code" name="sku_code">
                                                <option value="">--Select SKU--</option>
                                                <?php
                                          $sku = $use->supplier_id;
                                          $products = Db::getInstance()->query("SELECT a.product_id, b.sku_code, b.description
                                          FROM `supplier_price_list` a 
                                          left join products b on a.product_id = b.id 
                                          WHERE a.supplier_id = $sku");
                                             if (!$products->count()) {
                                                 
                                                 echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                 
                                             }else{
                                               
                                                        foreach ($products->results() as $prod) {
                                                 ?>
                                            
                                              <option value="<?php echo $prod->sku_code; ?>"><?php echo $prod->sku_code . ' ' . $prod->description; ?></option>
                                              
                                              <?php
                                                      }
                                                                                         }
                                                  ?>
                                            </select> 
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" readonly />
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="inventory_code">Inventory Code</label>
                                            <input type="text" class="form-control" id="inventory_code" name="inventory_code" readonly />
                                            <input type="hidden" class="form-control" id="inventory_id" name="inventory_id" />
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="qty" id="metric_units"></label>
                                            <input type="number" class="form-control" id="qty" name="qty" />
                                            
                                         
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="currency_id">Currency Type</label>
                                            <select class="form-control" id="currency_id" name="currency_id">
                                                <?php
                                                    
                                                    $currency = Db::getInstance()->query("SELECT * FROM `currency`");
                                                     if (!$currency->count()) {
                                                         
                                                         echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                         
                                                     }else{
                                                       
                                                                foreach ($currency->results() as $currency) {
                                                                                             ?>
                                            
                                              <option value="<?php echo $currency->id; ?>"><?php echo $currency->sign . ' '. $currency->name; ?></option>
                                              <?php
                                                      }
                                                                                         }
                                                  ?>
                                            </select>
                                          </div> 
                                          
                                          <div class="form-group col-sm-6">
                                              </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="warehouse_id">Warehouse</label>
                                            <select class="form-control" id="warehouse_id" name="warehouse_id">
                                                <option value="">-- Choose --</option>
                                                <?php
                                                
                                                         $user = Db::getInstance()->query("SELECT * FROM worklocation");
                            
                                                          if (!$user->count()) {
                                                              
                                                            echo "<option value=''>No data to be displayed</option>";
                                                            
                                                          } else {
                                                              
                                                            foreach ($user->results() as $usr) {
                                                ?>
                                                <option value="<?php echo $usr->id; ?>"><?php echo $usr->location; ?></option>
                                                <?php
                                                
                                                            }
                                                          }    
                                                
                                                ?>
                                            </select>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                              
                                          <label for="bin_id">Bin</label>
                                            <select class="form-control" id="bin_id" name="bin_id">
                                                  <option value="0" selected>--Bin--</option>
                                            </select>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="unit_cost">Unit Cost</label>
                                            <input type="text" class="form-control" id="unit_cost" name="unit_cost" readonly />
                                            
                                          </div> 
                                          
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="total_revenue">Total Cost</label>
                                            <input type="text" class="form-control" id="total_revenue" name="total_revenue" disabled />
                                            
                                          </div> 
                                          
                                          <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $member_id; ?>"  />
                                </div>
                             </div>
                          </div>
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

                
             
            
        </div>
        
        <?php
             }
            ?>
   
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

        function refresh()
        { 
            $( "#refresh" ).load(window.location.href + " #refresh" );
        }
        
        $(document).ready(function(event){
        
            $('.resulter').hide();
            $('.resulterError').hide();
            $('.warning').hide();
         
         
            $("#sku_code").change(function () {
                let sku_code = $(this).val(); // Get selected value directly
                let dataString = { sku_code: sku_code }; // Use object notation for data
        
                $.ajax({ 
                    url: 'view/purchases/orders/getproduct.php',
                    dataType: 'json',
                    type: 'GET',
                    data: dataString,
                    cache: false,
                    success: function (response) {
                        if (response.length > 0) {
                            
                            $('#metric_units').empty();
                            
                            let product = response[0]; // Assuming only one product is returned
        
                            $('#unit_cost').val(product.cost_per_unit);
                            $('#description').val(product.description);
                            $('#metric_units').append(product.metric_units);
                            $('#inventory_code').val(product.inventory_code);
                            $('#inventory_id').val(product.inventory_id);
                            //alert(product.inventory_code)
                            
                        } else {
                            // Clear fields if no product is found
                            $('#unit_cost, #description, #metric_units, #inventory_code, #inventory_id').val('');
                        }
                    },
                    error: function () {
                        console.error("Error fetching product data.");
                    }
                });
            });

            $("#warehouse_id").change(function(){  
                
        	    let id = $(this).find(":selected").val();
        		let dataString = 'warehouse_id='+ id;  
        		
        		//alert(dataString);
        	
        		$.ajax({
        			url: 'view/purchases/orders/getbin.php',
                    dataType: 'json',
        			data: dataString,  
        			cache: false,
        			success:function(response){
                        
                         let len = response.length;
                         
                         $("#bin_id").empty();
                        
                            for( let i = 0; i<len; i++){
                           
                            let id          = response[i]['id'];
                            let description = response[i]['description'];
                            
                             $("#bin_id").append("<option value='"+id+"'>"+description+"</option>");
                        
                        }
        
                       
        				 	
        			} 
        		});
         	}) 
                   
            $("#supplier_id").change(function(){  
        	    let id = $(this).find(":selected").val();
        		let dataString = 'supplier_id='+ id;  
        		
        		//alert(dataString);
        	
        		$.ajax({
        			url: 'view/purchases/orders/getsupplier.php',
                    dataType: 'json',
        			data: dataString,  
        			cache: false,
        			success:function(response){
                        
                        let len = response.length;
        
                        $("#supplier").empty();
                        
                            for( let i = 0; i<len; i++){
                           
                            let name = response[i]['name'];
                            
                          
                           $('#supplier').val(name);
                            //alert(description);
                        
                          }
            				 	
            			} 
            		});
             	}) 
     	
     	    $('.view_goodreceived').click(function (e) {
		
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
     	
     	    $('.view_invoice').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/view.php",
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
     
    	    $('.prev_page').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/index.php",
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
          
    	    $('.current_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
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
    	
    	    $('.request_approval').click(function (e) {
    		
    		let ed = $(this).attr('lang');
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/orders/request_approval.php",
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

            $('.SaveStaff').on('click', function(){
       
                let form = $('#purchaseorder_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/purchases/orders/update.php',
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
            
            $('.SaveItem').on('click', function(){
       
                let form = $('#purchaseItem_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/purchases/orders/insertitem_order.php',
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
            
            $('.SaveLanding').on('click', function(){
                
                let landing_cost = $("#landing_cost").val();
                
                //alert(landing_cost)
                
                if(landing_cost === ''){
                    
                    
                    $(".warning").append("The fields cannot be empty");
                    $(".warning").show();
                    
                    
                }else{
                    
                    let form = $('#landing_form')[0]; // You need to use standard javascript object here
                    let formData = new FormData(form);  
                
                //alert(formData)
                    
                     $.ajax({
        				url: 'view/purchases/orders/insertlandingcost.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".warning").hide();
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                         
                        }, 
                        error:function(data){
                            $(".warning").hide();
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                    
                }
                
           
                   
                
            });
            
            $('.SaveDiscount').on('click', function(){
                
                 
                let discount_ = $("#discount_").val();
                
                //alert(landing_cost)
                
                if(discount_ === ''){
                    
                    
                    $(".warning").append("The fields cannot be empty");
                    $(".warning").show();
                    
                    
                }else{
       
                let form = $('#discount_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/purchases/orders/insertdiscount.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".warning").hide();
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $(document).ready(function(){
                                refresh();
                            });
                         
                        }, 
                        error:function(data){
                            $(".warning").hide();
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                }
            });
            
            $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id =          $(this).attr('id');
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/purchases/orders/delete.php',
                		data: {
                		    tablename   : tablename,
                            id  : id
                		    
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
            
            $("#qty").change(function(){  
                
                $('#qty').empty();
                $('#unit_cost').empty();
                $('#total_revenue').empty();
        	
        	let qty        = $('#qty').val();
            let unit_cost  = $('#unit_cost').val();
        
                if(unit_cost === ""){
                    
                    // alert("Selling price require")
                    
                }else{
                 		let total_revenue = qty * unit_cost;
                		
                	//	alert(total_revenue);
                	     $('#total_revenue').val(total_revenue);
                }
     	    });
    	
       event.preventDefault();
   });
   
   
   
   </script>

