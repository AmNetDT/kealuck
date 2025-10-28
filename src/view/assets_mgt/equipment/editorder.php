<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
?>
    
        <script>
            $(document).ready(function(){
        
               $('.details_click_view').show();
               $('.photo_click_view').hide();
               
               $('.photo_click').on('click', function(){
                   
                    $('.details_click_view').hide();
                    $('.photo_click_view').show();
                   
               })
               
               $('.details_click').on('click', function(){
                   
                    $('.photo_click_view').hide();
                    $('.details_click_view').show();
                    $('.details_click_view').css("opacity", 5);
                   
               })
            })
        </script>                    
                    
                    
  
  
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


            $users = Db::getInstance()->query("SELECT a.*, b.username, c.name as supplier, e.approval_status,
                  concat(d.firstname, ' ', d.lastname) as registered, a.supplier_id, c.supplier_code
                  FROM equipment a 
                  Left join users b on a.added_by = b.id 
                  Left join staff_record d on b.username = d.user_id 
                  left join suppliers c on a.supplier_id = c.id
                  left join approval e on a.equipment_code = e.request_code
                  WHERE a.id = $member_id");
                  
            foreach ($users->results() as $use) {
                
                $equipment_code = $use->equipment_code;
                $description = $use->description;
                $supplier_id    = $use->supplier_id;               
                $added_by       = $use->added_by;           
                $equipment_id   = $use->id; 
                $status         = $use->approval_status;
                $brand          = $use->brand;
                $model          = $use->model;
                $engine         = $use->engine;
                $transmission   = $use->transmission;
                $track_usage    = $use->track_usage;
                $link_to_service_manual = $use->link_to_service_manual;
                $leased_or_purchased    = $use->leased_or_purchased;
                $date_aquired           = $use->date_aquired;
                $purchase_price         = $use->purchase_price;
            ?>
            
            
             <!-- Modal Equipment Details -->
            <div class="modal fade" id="ordermodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  
                  <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Edit Equipment Details</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                    <form id="equipment_form" method="post">
                     <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert current_page"></diiv>
              <diiv class="col-sm-12 p-2 warning_alert current_page"></diiv>
          </div>
          <div class="row">
             
              <div class="form-group col-sm-4">
                <label for="equipment_code">Equipment Code</label>
                <input type="text" id="equipment_code" name="equipment_code" class="form-control" value="<?php echo $equipment_code; ?>" 
                class="form-control" readonly />
              </div>
              <div class="form-group col-sm-4">
              
                <label for="date_aquired">Date Aquired</label>
                <input type="date" id="date_aquired" name="date_aquired" value="<?php echo $use->date_aquired; ?>" class="form-control" />
                
              </div>
              <div class="form-group col-sm-4">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" value="<?php echo $use->description; ?>" class="form-control" />
                </div>
            </div>
         
            <div class="row"> 
              <div class="form-group col-sm-4">
              
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="<?php echo $use->type; ?>"><?php echo $use->type; ?></option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM equipmenttype");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->title; ?>"><?php echo $usr->title; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              <div class="form-group col-sm-4">
              
                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand" class="form-control" value="<?php echo $use->brand; ?>" placeholder="Toyota, Caterpillar" />
                
              </div>
              <div class="form-group col-sm-4">
              
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="<?php echo $use->model; ?>" placeholder="Model (eg. 2022)" />
                
             
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-4">
              
                <label for="plate_number">ID/Plate Number</label>
                <input type="text" class="form-control" id="plate_number" name="plate_number" value="<?php echo $use->plate_number; ?>" />
                
              </div>  
              <div class="form-group col-sm-4">
                <label for="serial_number">Serial Number</label>
                <input type="text" class="form-control" id="serial_number" name="serial_number" value="<?php echo $use->serial_number; ?>" />
                
              </div>
              <div class="form-group col-sm-4">
              
                <label for="engine">Engine</label>
                <input type="text" class="form-control" id="engine" name="engine" value="<?php echo $use->engine; ?>" />
                
              </div>  
            </div>
            <div class="row">
              <div class="form-group col-sm-4">
                <label for="transmission">Transmission</label>
                <input type="text" class="form-control" id="transmission" name="transmission" value="<?php echo $use->transmission; ?>" />
                
              </div>
              
              <div class="form-group col-sm-4">
              
                <label for="track_usage">Track Usage</label>
                <select class="form-control" id="track_usage" name="track_usage">
                    <option value="<?php echo $use->track_usage; ?>"><?php echo $use->track_usage; ?></option>
                    <option value="Hour">Hour</option>
                    <option value="Miles">Miles</option>
                    <option value="Kilometers">Kilometers</option>
                </select>
              </div>  
              <div class="form-group col-sm-4">
                <label for="leased_or_purchased">Acquire Type</label>
                <select class="form-control" id="leased_or_purchased" name="leased_or_purchased">
                    <option value="<?php echo $use->leased_or_purchased; ?>"><?php echo $use->leased_or_purchased; ?></option>
                    <option value="Purchased">Purchased</option>
                    <option value="Lease">Lease</option>
                </select>
              </div>
            </div>
            <div class="row">   
              <div class="form-group col-sm-6">
              <label for="link_to_service_manual">Link To Service Manual</label>
              <div class="input-group-prepend">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">https://</span>
                  </div>
                  <input type="text" class="form-control" id="link_to_service_manual" name="link_to_service_manual" value="<?php echo $use->link_to_service_manual; ?>" aria-describedby="basic-addon3">
                </div>
            </div>
              
              <div class="form-group col-sm-6">
              
                <label for="type">Supplier</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                     <?php
                            $supplier_id = $use->supplier_id;
                            
                             $usersupplier_id = Db::getInstance()->query("SELECT * FROM suppliers WHERE id = $supplier_id");
                             foreach ($usersupplier_id->results() as $usersupp) {
                                 $usersname = $usersupp->name;
                                 $userssupplier_id = $usersupp->id;
                                 $userscode = $usersupp->supplier_code;
                             ?>
                    <option value="<?php echo $userssupplier_id; ?>"><?php echo $usersname . ' ' . $userscode; ?></option>
                    <?php
                             }
                    ?>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM suppliers WHERE category ='Equipment & Tools'");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->id; ?>"><?php echo $usr->supplier_code . ',  '. $usr->name ; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
            </div>
            <div class="row">  
              <div class="form-group col-sm-12">
              
                <label for="additional_info">Additional Info</label>
                <textarea class="form-control" id="additional_info" name="additional_info"><?php echo $use->additional_info; ?></textarea>
                
              </div>
            </div>
            
            
             
            <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>" />
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SaveEquip">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                     </form>
                  
                </div>
              </div>
            </div>                  
            
            <!-- Purchase Price !-->
            <div class="modal fade" data-backdrop="static" id="addpurchasemodal" tabindex="-1">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                     <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Add Purchase Item</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>" >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                          <div class="modal-body">
                              
                                   
                                         <div class="success_alert mb-1 p-2 current_page"></div>
                                         <div class="warning_alert mb-1 p-2 current_page"></div>
                                     
                                     
                             
                      <form id="purchase_price_form" name="purchase_price_form" method="post">
                          <div class="row justify-content-between my-3">
             
                              <div class="form-group col-sm-12">
                                <label for="serial_no">Item serial number</label>
                                <input type="text" id="serial_no" name="serial_no" class="form-control" class="form-control"  />
                              </div>
                              <div class="form-group col-sm-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                <label for="qty">Quantity</label>
                                <input type="text" id="qty" name="qty" class="form-control" class="form-control" />
                              </div>
                              <div class="form-group col-sm-6">
                                <label for="currency_id">Currency</label>
                                <select class="form-control" id="currency_id" name="currency_id">
                                    <option value="">--Choose Currency--</option>
                                    <?php
                              
                                                $transaction_year = Db::getInstance()->query("SELECT * FROM currency order by id asc");
                                                foreach ($transaction_year->results() as $trans) {
                          
                                    ?>
                                          <option value="<?php echo $trans->id; ?>"><?php echo $trans->sign; ?> | <?php echo $trans->name; ?></option>
                                          <?php
                                                 }
                                    ?>
                                </select>
                              </div>
                            </div>
                         
                            <div class="row justify-content-between my-3">
                            <div class="col-12">
                             <div class="input-group mb-3">
                              <div class="input-group-append">
                                <label class="input-group-text" for="unit_cost">Amount</label>
                              </div>
                              <input type="text" class="form-control" id="unit_cost" name="unit_cost" />
                              
                            </div>
                            </div>
                            </div>
                            <input type="hidden" name="equipment_id" id="equipment_id" value="<?php echo $equipment_id; ?>" />
                      </form>
                          <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SavePurchasePrice">
                            <span class="fa fa-save"> Save</span></button>
                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                    </div>
              </div>
                </div>

        
                </div>
            
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
                              
                                   
                                         <div class="success_alert mb-1 p-2 current_page"></div>
                                         <div class="warning_alert mb-1 p-2 current_page"></div>
                                     
                                     
                             
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
                                <input type="hidden" name="item_code" id="item_code" value="<?php echo $equipment_code; ?>" />
                                
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
                                   
                                         <div class="success_alert mb-1 p-2 current_page"></div>
                                         <div class="warning_alert mb-1 p-2 current_page"></div>
                                     
                                     
                            <form id="landing_form" name="landing_form" method="post">
                                <div class="row justify-content-between">
                                   <div class="form-group col-6">
                                        <label for="currency_id">Currency</label>
                                        <select class="form-control" id="currency_id" name="currency_id">
                                            <option value="">--Choose Currency--</option>
                                            <?php
                                      
                                                        $transaction_year = Db::getInstance()->query("SELECT * FROM currency order by id asc");
                                                        foreach ($transaction_year->results() as $trans) {
                                  
                                            ?>
                                                  <option value="<?php echo $trans->id; ?>"><?php echo $trans->sign; ?> | <?php echo $trans->name; ?></option>
                                                  <?php
                                                         }
                                            ?>
                                        </select>
                                      </div>   
                                    <div class="col-6">
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
                                <input type="hidden" name="item_code" id="item_code" value="<?php echo $equipment_code; ?>" />
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
            
            <!-- Photo Modal !-->
            <div class="modal fade" data-backdrop="static" id="addphotomodal" tabindex="-1">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                     <div class="farm-color modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">Add Photo</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>" >
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                          <div class="modal-body">
                              
                                   
                                         <div class="success_alert mb-1 p-2 current_page"></div>
                                         <div class="warning_alert mb-1 p-2 current_page"></div>
                                     
                                     
                            <form id="photo_form" name="photo_form" method="post" enctype="multipart/form-data">
                                <div class="row justify-content-between">
                                      
                                    <div class="col-12">
                                        <label for="image">Photo</label>
                                        <input type="file" name="image" id="image" class="form-control"/>
                                    </div>
                                    </div>
                                
                                <input type="hidden" name="equipment_id" id="equipment_id" value="<?php echo $member_id; ?>" />
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 SavePhoto">
                            <span class="fa fa-save"> Save</span></button>
                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                          </div>
                </div>
              </div>
            </div>
            
                <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Update Order: <?php echo $equipment_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0 current_page"></div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-sm-3">
                         <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$equipment_code'");     
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
                    <div class="col-sm-5 px-0 mr-0">
                        <?php
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$equipment_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                                            echo "";
                                     }
                                  }else{
                                        ?> 
                          
                          <button type="button" class="farm-button-blend py-1 ml-0" data-toggle="modal" data-target="#ordermodal">
                            <span class="fa fa-save"> Edit Details</span>
                          </button> 
                          <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#addpurchasemodal">
                            <span class="fa fa-save"> Add Purchase Item</span>
                          </button> 
                           
                            <?php   
                            
                                 $findtax = Db::getInstance()->query("SELECT * FROM purchase_discount WHERE item_code = '$equipment_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                                          
                                         <button type="button" class="farm-button-disabled py-1 ml-0 singledelete" id="<?php echo $findta->id; ?>" title="purchase_discount" >
                                            <span class="fa fa-trash"></span> Discount
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
                    <div class="col-sm-4 px-0 mr-0 text-right">
            
                          <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                            <span class="fa fa-chevron-left"></span>
                          </button>  
                         
                          <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                            <span class="fa fa-refresh"></span>
                          </button>
                          
                    </div>
               </div>  
                <div class="row justify-content-between px-5 mt-3">
                 <div class="col-sm-4">
                     
                 </div>
                 <div class="col-sm-4">
                      <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Equipment detail updated by: </p>
                            <h5 class="mb-0 text-dark"><?php echo $use->registered; ?></h5>
                          </div>
                        </div>
                      </div>
                 </div>
                 <div class="col-sm-4">
                     <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Amount 
                            <?php
                              $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.discount, d.cost as landing_cost, e.sign
                                                                    FROM equipment_order a 
                                                                    left join equipment b on a.equipment_id = b.id
                                                                    Left join purchase_discount c on b.equipment_code = c.item_code
                                                                    Left join landing_cost d on b.equipment_code = d.item_code
                                                                    Left join currency e on a.currency_id = e.id
                                                                    WHERE b.id = $member_id");     
                             
                      
                                if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     $discount = $labelta->discount;
                                     $landing_cost = $labelta->landing_cost;
                                     $cost = $labelta->cost;
                                     
                                     if($discount != ''){
                          ?>
                                    <span>(include <?php echo $labelta->discount; ?>% discount) </span>
                            <?php
                                     }
                                 
                                
                                    $amount = $discount / 100 * $cost / 1;
                                    $total_discount = $cost - $amount;
                                    $total_cost = $total_discount + $landing_cost;
                                
                                
                              ?>
                      </p>
                            <h4 class="mb-0"><?php echo $labelta->sign . ' ' . $total_cost; ?>.00</h4>
                             <?php
                                     
                                 }
                                }
                         
                      ?>
                          </div>
                        </div>
                      </div>
                 </div>
                </div>
                
            <div class="row justify-content-between">
                    
                    <div class="col-sm-2 m-0 p-0 pr-3">
                        <?php
                            
                          
                                     
                          $tphoto = Db::getInstance()->query("SELECT * FROM equipmentphoto WHERE equipment_id = $member_id order by id asc limit 1");
        
                          if (!$tphoto->count()) {
                           
                                    if($username == $added_by){
                            ?>
                            <div class='col-sm-12'><button class='btn btn-default' data-toggle='modal' data-target='#addphotomodal'>Add Photo</button></div>
                            <hr class="my-1" />
                            <?php
                                    }
                          } else {
                              
                            foreach ($tphoto->results() as $tphot) {
                        ?> 
                   
                    <div class="row justify-content-between">
                       <div class="card">
                          <div class="card-header">
                            Eqiupment Photo
                            
                          </div>
                          
                          <div class="card-body pl-0">
                           <img class="img-thumbnail" src="view/assets_mgt/equipment/<?php echo $tphot->photoUrl; ?>" alt="" />
                          </div>
                        
                        </div>
                   </div>
                   <?php
                            }
                          }
                   
                          
                                     
                          $useroperator = Db::getInstance()->query("SELECT a.*, e.sign FROM landing_cost a
                                                                    Left join currency e on a.currency_id = e.id
                                                                    WHERE item_code = '$equipment_code'");
        
                          if (!$useroperator->count()) {
                           
                                    if($username == $added_by){
                            ?>
                            <div class='col-sm-12'>
                                <button class='btn btn-default' data-toggle='modal' data-target='#addlandingcost'>Add Landing Cost</button>
                            </div>
                            <?php
                                    }
                          } else {
                              
                            foreach ($useroperator->results() as $usoperator) {
                        ?> 
                   
                          <div class="card-header">
                            Landing Cost (Delivery)
                            
                          </div>
                          
                            <div class="container-fluid ml-1 px-0">
                                <span style="float:left"><?php echo $labelta->sign . ' ' .  $usoperator->cost; ?></span>
                            
                            <?php
                                    if($username == $added_by && $status != "Approved"){
                            
                          ?>
                                      
                                     <button class="border ml-2 singledelete" id="<?php echo $usoperator->id; ?>" title="landing_cost" >
                                        <span class="fa fa-trash"></span>
                                      </button>
                                      
                            <?php
                                
                         
                                    }
                            ?>
                            </div>
                            
                            <p class="card-text" style="font-size:0.8em"><b>Additional Info</b> <br /><?php echo $usoperator->additional_info; ?></p>
                            <hr />
                            
                          
         
                   <?php
                            }
                          }
                   
                   ?>
                   </div>
                    <div class="col-sm-10 m-0 p-0">
                       
                      <div class="col-sm-12 m-0 p-0">
                          <div class="row">
                            <div class="col-sm-2 m-0 p-0">
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><button type="button" class="btn py-1 details_click" />Details</button></li>
                                  <li class="list-group-item"><button type="button" class="btn py-1 photo_click" />Photo</button></li>
                                </ul>
                            </div>
                            <div class="col-sm-8 m-0 p-0 details_click_view">
                                <div class="row justify-content-between my-3">
                                        <div class="col-8 text-capitalize text-weight-bold">
                                          <h4 class="bg-light border p-3"><?php echo $description; ?></h4>
                                        </div>
                                        <div class="col-4 text-capitalize">
                                          <p>Brand: <span class="text-secondary"><?php echo $brand; ?></span><br />Model: <span class="text-secondary"><?php echo $model; ?></span></p>
                                        </div>
                               </div>
                                <div class="row justify-content-between my-4">
                <?php

                  $user = Db::getInstance()->query("SELECT * FROM equipment_order WHERE equipment_id = $member_id");

                  if (!$user->count()) {
                   ?>
                   <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                   <?php
                  } else {

                ?> 

                    <table class="table table-sm table-hover table-bordered" style="font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Serial number</th>
                          <th style="width:30%">Description</th>
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
                            <td><?php echo $user->serial_no; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->qty; ?></td>
                            <td style="text-align:right"><?php echo $user->unit_cost; ?></td>
                            <td style="text-align:right"><?php 
                                $qty = $user->qty; 
                                $unitcost = $user->unit_cost;
                                $totalamount = $qty * $unitcost;
                            echo $totalamount; ?>.00</td>
                            <td>
                                     <?php
                             $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$equipment_code'");     
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
                                  <div class="singledelete" id="<?php echo $user->id; ?>" title="equipment_order" >
                                        <button class="dropdown-item">
                                             <i class="fa fa-trash"></i> &nbsp;Remove</button>

                                    </div>
                                    
                                </div>

                              </div>
                             
                                  <?php
                                 
                             }     
                                 ?>
                            </td>
                            <!-- Modal -->

  
                          </tr>

 
                        <?php
                        }
                        ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td colspan='5' style="text-align:right">
                                 <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.percentage, e.sign
                                                                    FROM equipment_order a 
                                                                    left join equipment b on a.equipment_id = b.id
                                                                    Left join tax_order c on b.equipment_code = c.item_code
                                                                    Left join currency e on a.currency_id = e.id
                                                                    WHERE a.equipment_id = $member_id");     
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
                      
                            
                            <span class="ml-5"><b><?php echo $labelta->sign . ' ' . $total_cost; ?>.00</b></span>
                             <?php
                                     
                                 }
                                }
                         
                      ?>
                            
                        </tr>
                      </tbody>
                    </table>
                  <?php
                  }
                
                ?>
                            
                                </div>
                                
                               <div class="row justify-content-between border-bottom">
                                        <div class="col-4 text-capitalize">
                                          <p>Track Usage: <span class="text-secondary"><?php echo $track_usage; ?></span></p>
                                        </div>
                                        <div class="col-4 text-capitalize">
                                          <p>Engine: <span class="text-secondary"><?php echo $engine; ?></span></p>
                                        </div>
                                        <div class="col-4 text-capitalize">
                                          Transmission: <span class="text-secondary"><?php echo $transmission; ?></span></p>
                                        </div>
                               </div>
                               
                               <div class="row justify-content-between border-bottom">
                                        <div class="col-4">
                                          <p>Leased/Purchased: <span class="text-secondary"><?php echo $leased_or_purchased; ?></span></p>
                                        </div>
                                        <div class="col-4 text-capitalize">
                                          <p>Purchase Price: <span class="text-secondary"><?php echo $purchase_price; ?></span></p>
                                        </div>
                                        <div class="col-4 text-capitalize">
                                           <p>Aquired Date: <span class="text-secondary"><?php echo $date_aquired; ?></span></p>
                                        </div>
                               </div>
                               
                               <div class="row justify-content-between border-bottom">
                                        <div class="col-12">
                                          <p>Link to service manual: <span class="text-secondary"><?php echo $link_to_service_manual; ?></span></p>
                                        </div>
                               </div>
                            </div>
                            <div class="col-sm-8 m-0 p-0 photo_click_view">
                                <div class="row justify-content-between my-3">
                                        <div class="col-8 text-capitalize text-weight-bold">
                                            
                                            <div class="row bg-light border p-3 justify-content-between">
                                                
                                                <div class="col-8">
                                                    <h3><?php echo $description; ?></h3>
                                                </div>
                                                <div class="col-4">
                                                      <button type="button" class="btn farm-button-cancel border p-1" data-toggle='modal' data-target="#addphotomodal" />Add Photo</button>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col-4 text-capitalize">
                                          <p>Brand: <span class="text-secondary"><?php echo $brand; ?></span><br />Model: <span class="text-secondary"><?php echo $model; ?></span></p>
                                        </div>
                               </div>
                               <div class="row">
                                   <p style="font-size:0.75em">The image filename should not contain a space.</p>
                               </div>
                                <div class="row my-3">
                                    
                                                      
                                    <?php
                                            $equipmentphoto = Db::getInstance()->query("SELECT * FROM equipmentphoto WHERE equipment_id = $member_id");
                            
                                              if ($equipmentphoto->count()) {
                                                  
                                                  foreach ($equipmentphoto->results() as $equipphoto) {
                                    ?>
                                          
                                           
                                           <div class="col-2">
                                                <div class="row m-0 p-0" style="height:100px;">
                                                    <img class="img-thumbnail" src="view/assets_mgt/equipment/<?php echo $equipphoto->photoUrl; ?>" alt="" />
                                                </div> 
                                                
                                                <div class="row justify-content-center">
                                                 <div class="col-sm-6">
                                                     <button type="button" class="border singleview" id="<?php echo $equipphoto->id; ?>" title="View Photo">
                                                        <span class="fa fa-search"></span> 
                                                      </button>
                                                  </div>
                                                      <div class="col-sm-6">
                                                      <button type="button" class="border singledelete" id="<?php echo $equipphoto->id; ?>" title="Delete Photo">
                                                        <span class="fa fa-trash"></span> 
                                                      </button>
                                                  </div>
                                                </div>
                                             </div>  
                                    <?php
                                                  }
                                              }else{
                                                  
                                                  echo "No photo added.";
                                              
                                                  
                                              }
                                        
                                    ?>
                               </div>
                            </div>
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
  Redirect::to('app.kealuck.com/login');
}

  ?>
   
<script>

        function refresh()
        { 
            $( "#refresh" ).load(window.location.href + " #refresh" );
        }
        
        $(document).ready(function(event){
        
           
            $('.success_alert').hide();
            $('.warning_alert').hide();
               
            $('.SavePhoto').on('click', function(){
       
                let form = $('#photo_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/insert_photo.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $("#loader_httpFeed").hide();
                        },
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
				            $("#loader_httpFeed").hide();
                        }
                    }); 
                
            });
           
            $("#supplier_id").change(function(){  
        	    let id = $(this).find(":selected").val();
        		let dataString = 'supplier_id='+ id;  
        		
        		//alert(dataString);
        	
        		$.ajax({
        			url: 'view/assets_mgt/equipment/getsupplier.php',
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
             	}); 
     	
     	  
        	
     	    $('.singleview').on('click', function (e) {
		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/single_imageview.php",
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
    			url: "view/assets_mgt/equipment/index.php",
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
    			url: "view/assets_mgt/equipment/editorder.php",
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
    			url: "view/assets_mgt/equipment/request_approval.php",
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

            $('.SaveEquip').on('click', function(){
       
                let form = $('#equipment_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/update.php',
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
        				url: 'view/assets_mgt/equipment/insertlandingcost.php',
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
        				url: 'view/assets_mgt/equipment/insertdiscount.php',
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
            
            $('.SavePurchasePrice').on('click', function(){
                
                 
                let purchase_price = $("#purchase_price").val();
                
                //alert(landing_cost)
                
                if(purchase_price === ''){
                    
                    
                    $(".warning").append("The fields cannot be empty");
                    $(".warning").show();
                    
                    
                }else{
       
                let form = $('#purchase_price_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/insertitem_order.php',
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
            
            $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id =          $(this).attr('id');
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/assets_mgt/equipment/delete.php',
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
            
            
   event.preventDefault();
   });
       
   
  
  </script>
