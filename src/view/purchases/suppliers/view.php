<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];
//echo $member_id;
$user = new User();
if ($user->isLoggedIn()) {

$userSyscategory = escape($user->data()->syscategory_id);
$username = escape($user->data()->id);

?>

  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div> 
        </div>
             <?php

                    $staffa = Db::getInstance()->query("SELECT a.`id`, a.`supplier_code`, a.`name`, a.`phone`, a.`email`, a.`category`, a.`address`,  
                                    b.name as state, c.name as lga, d.username as added_by  
                                    FROM `suppliers` a 
                                    Left Join `states` b on a.state_id = b.id
                                    Left Join lga c on a.lga_id = c.id 
                                    Left Join users d on a.added_by = d.id
                                    WHERE a.id = $member_id");

                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
                    ?>
            <div class="jumbotron jumbotron-fluid pt-5 bg-white">
            <div class="row">
                <div class="container py-3">
                    <div class="row border-bottom justify-content-between">
                    <div class="col-sm-8">
                        <h5><?php echo $staff->name ?> -  <span style="font-size:0.9em"><?php echo $staff->supplier_code ?></span>
                         <?php
        
                                             if ($userSyscategory == 1 || $userSyscategory == 2) {
                                                 
                                    ?>
                                          <button class="farm-button-icon-button py-1 ml-0 editstaff_view" lang="view/purchases/suppliers" id="<?php echo $staff->id; ?>">
                                            <span class="fa fa-pencil"></span> Update
                                          </button>
                                          <?php
                                             }
                                      ?>
                        </h5>
                    </div>
                    <div class="col-sm-4 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" lang="view/purchases/suppliers" id="#">
                                        <span class="fa fa-chevron-left"></span>
                                      </button>  
                                      <?php
        
                                             if ($userSyscategory == 1 || $userSyscategory == 2) {
                                                 
                                    ?>
                                      <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#shipping_modal">
                                        <span class="fa fa-plus"> Supplier Price</span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#contact_person_modal">
                                        <span class="fa fa-plus"> Contact Person</span>
                                      </button> 
                                      <?php
                                             }
                                      ?>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                                        <span class="fa fa-refresh"></span>
                                      </button>
                    </div>
                    </div>
                    <div class="row mt-4">
                        <div class="container">
                            
                   
                            <div class="row border-bottom justify-content-center">
                                <div class="container my-4">
                                    <div class="card mb-3" style="width:100%;">
                                        <div class="row">
                                                
                                                <div class="col-sm-4" style="width:100%; font-size:0.9em;">
                                                   <div class="col-sm-12">
                                                        <ul class="list-group">
                                                            
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Supplier Code <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->supplier_code; ?></span></li>
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Description <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->name; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Phone<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->phone; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Email <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Category<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->category; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Address<span class="text-dark p-2"> <?php echo $staff->address; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">State<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->state; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">LGA.<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->lga; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Supplier created by<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->added_by; ?></span></li>
                                                          
                                                        </ul>
                                                    </div>
                                                       
                                                    </div>
                                            <div class="col-sm-8">
                                                
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button active" id="supplier-tab" data-toggle="tab" href="#supplier" role="tab" aria-controls="supplier" aria-selected="true">Supplier Price</a>
                                                  </li>
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Person</a>
                                                  </li>
                                                </ul>
                                               <div class="tab-content" id="myTabContent">
                                                 
                                                  <div class="tab-pane fade show active p-3" id="supplier" role="tabpanel" aria-labelledby="supplier-tab">
                                                        
                                                        
                                                        <div class="table-responsive data-font" style="height: 100%;">
                                                            <div class="row justify-content-between">
                                                                <div class="col-sm-12 success_alert"></div>   
                                                                <div class="resulter1"></div>                                      
                                                            </div>
                                                    <?php

                

                                                          $uss = Db::getInstance()->query("SELECT a.*, b.sku_code, b.description, c.username, d.sign, d.name as currency
                                                                                            FROM `supplier_price_list` a 
                                                                                            Left Join products b on a.product_id = b.id
                                                                                            Left join users c on a.added_by = c.id
                                                                                            Left Join currency d on a.currency_id = d.id
                                                                                            WHERE a.`supplier_id` = $member_id");
                                        
                                                          if (!$uss->count()) {
                                                              
                                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                            
                                                          } else {
                                                                    
                                                        ?>
                                                            <table id="selectshipping" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                                                              <thead>
                                                                <tr> 
                                                                  <th>SN</th>
                                                                  <th>SKU Code</th>
                                                                  <th>Description</th>
                                                                  <th>Currency</th>
                                                                  <th>Unit Cost</th>
                                                                  <th>UoM</th>
                                                                  <th>Shipping</th>
                                                                  <th>&nbsp;</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($uss->results() as $users) {
                                        
                                                                ?>
                                        
                                                                  <tr>
                                                                    <td><?php echo $i++; ?></td>
                                                                    <td><?php echo $users->sku_code; ?></td>
                                                                    <td><?php echo $users->description; ?></td>
                                                                    <td><?php echo $users->sign . ' ' . $users->currency; ?></td>
                                                                    <td><?php echo $users->unit_cost; ?></td>
                                                                    <td><?php echo $users->uom; ?></td>
                                                                    <td><?php echo $users->shipping_days; ?></td>
                                                                    <td>
                                                                        
                                                                     
                                        
                                                                        <!-- Default dropup button -->
                                                                        <div class="btn-group dropright">
                                                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                              <i style="font-size:14px" class="fa">&#xf142;</i>
                                                                            </button>
                                                                        
                                                                        <div class="dropdown-menu">
                                                                          <?php
        
                                                                                     if ($userSyscategory == 1 || $userSyscategory == 2) {
                                                                                         
                                                                            ?>
                                                                            <div class="editshipping_view" lang="view/purchases/suppliers" id="<?php echo $users->id; ?>" title="<?php echo $member_id; ?>">
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-edit"></i>&nbsp; Edit SKU Price</button>
                                        
                                                                            </div>
                                                                            
                                                                            <div class="singledelete" id="<?php echo $users->id; ?>" title="supplier_price_list" >
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-trash"></i> &nbsp; Remove</button>
                                        
                                                                            </div>
                                                                            <?php 
                                                                                    }else{
                                                                               ?>
                                                                            <div class="editshipping_view" lang="view/purchases/suppliers" id="<?php echo $users->id; ?>" title="<?php echo $member_id; ?>">
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-edit"></i>&nbsp; View SKU</button>
                                        
                                                                            </div>
                                                                            <?php 
                                                                                    }
                                                                                ?>
                                                                          </div>
                                                                      </div>
                                                                     
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
                                                        
                                                        
                                                    </div>   
                                                  <div class="tab-pane fade p-3" id="contact" role="tabpanel" aria-labelledby="home-tab">
                                                       <!-- Contact Person Data Here !-->
                                                       
                                                       
                                                   
                                                         <div class="table-responsive data-font" style="height: 100%;">
                                                            <div class="row justify-content-between">
                                                                <div class="col-sm-12 success_alert"></div>                                      
                                                             </div>
                                                   <?php
                                                         $staffa = Db::getInstance()->query("SELECT * FROM `contact_person` 
                                                            WHERE foreign_id = $member_id and contact_type = 'Supplier'");
                                                             if (!$staffa->count()) {
                                                                 
                                                                 echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                                 
                                                             }else{
                                                   
                                                   ?>
                                                        
                                                            <table id="selectcontactpersons" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                                                              <thead>
                                                                <tr> 
                                                                  <th>SN</th>
                                                                  <th>Contact Person</th>
                                                                  <th>Cell Phone</th>
                                                                  <th>Email</th>
                                                                  <th>Position</td>
                                                                  <th>&nbsp;</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                    <?php
                                                                    
                                                                        $i = 1; 
                                                                        foreach ($staffa->results() as $staff) {
                                                                    
                                                                    ?>
                                                                    
                                                                  <tr>
                                                                    <td><?php echo $i++; ?></td>
                                                                    <td><?php echo $staff->contact_person; ?></td>
                                                                    <td><?php echo $staff->contact_phone; ?></td>
                                                                    <td><?php echo $staff->contact_email; ?></td>
                                                                    <td><?php echo $staff->contact_position; ?></td>
                                                                    <td>
                                                                        
                                                                        <!-- Default dropup button -->
                                                                        <div class="btn-group dropright">
                                                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                              <i style="font-size:14px" class="fa">&#xf142;</i>
                                                                            </button>
                                                                        <div class="dropdown-menu">
                                                                         
                                                                            <div class="edit_contact" lang="view/usermanager/contact_person" id="<?php echo $staff->id; ?>">
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-edit"></i>&nbsp; View/Edit Contact</button>
                                        
                                                                            </div>
                                                                            <div class="singledelete" id="<?php echo $staff->id; ?>" title="contact_person" >
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-trash"></i> &nbsp; Remove</button>
                                        
                                                                            </div>
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
                    }
                    ?>
        </div>
    </div>
        </div>
    </div>
    
    <!-- Modal shipping_modal -->
<div class="modal fade" id="shipping_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="shipping_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Supplier Price</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
     
    <form id="hanna" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-sm-12">
              
                <label for="description">Description</label>
               <input type="text" id="description" name="description" class="form-control" disabled/> 
              </div>
            </div>
            
            <div class="row">
                
              <div class="form-group col-sm-6">
                  <label for="product_id">SKU Code</label>
                <select class="form-control" id="product_id" name="product_id">
                    <option value="">--Select--</option>
                  <?php
              $products = Db::getInstance()->query("SELECT * FROM `products` where type='input'");
                                                             if (!$products->count()) {
                                                                 
                                                                 echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                                 
                                                             }else{
                                                               
                                                                        foreach ($products->results() as $prod) {
                                                                 ?>
                
                  <option value="<?php echo $prod->id; ?>"><?php echo $prod->sku_code . ' '. $prod->description; ?></option>
                  <?php
                          }
                                                             }
                      ?>
                </select>
                
              </div> 
              <div class="form-group col-sm-6">
              
                <label for="uom">Unit of Measure</label>
                <input type="text" id="uom" name="uom" class="form-control" readonly/>
                
              </div>
            </div>
            <div class="row">
            
              <div class="form-group col-sm-6">
              
                <label for="currency_id">Currency Type</label>
                <select class="form-control" id="currency_id" name="currency_id">
                    <option value="">--Select--</option>  
                    <?php
                        
                        $currency = Db::getInstance()->query("SELECT * FROM `currency`");
                         if (!$currency->count()) {
                             
                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                             
                         }else{
                           
                                    foreach ($currency->results() as $currency) {
                                                                 ?>
                
                  <option value="<?php echo $currency->id; ?>"><?php echo $currency->id; ?> <?php echo $currency->sign . ' '. $currency->name; ?></option>
                  <?php
                          }
                                                             }
                      ?>
                </select>
              </div>
              <div class="form-group col-sm-6">
              
                <label for="unit_cost">Unit Cost</label>
                <input type="text" id="unit_cost" name="unit_cost" class="form-control" placeholder="0.0" readonly />
                
              </div>
              
              <div class="form-group col-sm-4" style="font-size:0.8rem">
              
                <label for="tier_qty">Tier Qty</label>
                <input type="text" id="tier_qty" name="tier_qty" class="form-control" placeholder="0"/>
                
              </div>
              <div class="form-group col-sm-4" style="font-size:0.8rem">
              
                <label for="order_qty">Order Qty</label>
                <input type="text" id="order_qty" name="order_qty" class="form-control" placeholder="0"/>
                
              </div>
              <div class="form-group col-sm-4" style="font-size:0.8rem">
              
                <label for="shipping_days">Shipping Days</label>
                <input type="text" id="shipping_days" name="shipping_days" class="form-control" placeholder="0"/>
                
              </div>
            </div>
            <div class="row">
                
              <!--<div class="form-group col-sm-6">-->
              
              <!--  <label for="discount">Discount</label>-->
              <!--  <input type="text" id="discount" name="discount" class="form-control" placeholder="0.00"/>-->
              <!--</div>-->
              <!--<div class="form-group col-sm-6">-->
              
              <!--  <label for="total_amount">Total Amount</label>-->
              <!--  <input type="text" id="total_amount" name="total_amount" class="form-control" placeholder="0.00" readonly />-->
              <!--</div>-->
            </div>
            
            <input type="hidden" name="supplier_id" id="supplier_id" value="<?php echo $member_id; ?>" />
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveSupplier_price">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
      </div>
       </form>
    </div>
  </div>
</div>
    
                                       
<!-- Modal contact_person -->
<div class="modal fade" id="contact_person_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="contact_person_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Contact Person</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
     
    <form id="contactform" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-sm-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="customer_code">Contact Code</label>
                <label class="form-control bg-light">CON<?php echo $Rahma; ?></label><input type="hidden" id="contact_code" name="contact_code" class="form-control" value="CUS<?php echo $Rahma; ?>" />
              </div>
              <div class="form-group col-sm-6">
              
                <label for="name">Contact Name</label>
                <input type="text" id="contact_person" name="contact_person" class="form-control" placeholder="Contact person name" />
              </div>
            </div>
           
            <div class="row">
                
              <div class="form-group col-sm-6">
              
                <label for="contact_phone">Cell Phone</label>
                <input type="phone" id="contact_phone" name="contact_phone" class="form-control" placeholder="Cell Phone"/>
                
              </div>
              <div class="form-group col-sm-6">
              
                <label for="contact_email">Email</label>
                <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"/>
                
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-sm-6"> 
              
                <label for="contact_position">Position</label>
                <input type="text" id="contact_position" name="contact_position" class="form-control" placeholder="Contact Designation"/>
                
              </div>  
              <div class="form-group col-sm-6">
              
                <label for="contact_type">Contact Type</label>
                <label class="form-control">Supplier</label>
                <input type="hidden" name="contact_type" id="contact_type" value="Supplier" />
              </div>
              </div>
            
            <div class="row">
              <div class="form-group col-sm-12">
              
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address"></textarea>
                
              </div>
            </div>
         
            <input type="hidden" name="foreign_id" id="foreign_id" value="<?php echo $member_id; ?>" />
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0" data-dismiss="modal">Close</button>
      </div>
       </form>
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
   $(document).ready(function(evt) {
       
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
         
        $(".resulter").hide();
        $(".resulterError").hide();
       
        $('.SaveStaff').on('click', function(){
            
            let form = $('#contactform')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/usermanager/contact_person/insert.php',
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
        
        
        $('.SaveSupplier_price').on('click', function(){
            let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
             $.ajax({
                 
                        url: 'view/purchases/suppliers/insertsupplier_price.php',
        				data: formData,
    					cache: false,
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
      
   evt.preventDefault();
   });
       
   
  
  </script>
  


<script>
    $(document).ready(function(event) {
        
        
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
		
		let id = $(this).attr('id'); 
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/purchases/suppliers/view.php",
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
	
       
       	$('.editstaff_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edituser.php",
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
   
   
   	    $('.edit_contact').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edit_contact.php",
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
   
   
   	    $('.editshipping_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let supplier_list_id = $(this).attr('id');
		let id = $(this).attr('title');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edit_supplier_price.php",
			data: {
				'supplier_list_id': supplier_list_id,
				'id' : id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});
   
    
        $("#product_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'product_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/purchases/suppliers/getsku.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                //$("#product_id").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let description = response[i]['description'];
                    let uom = response[i]['uom'];
                    let cost_per_unit = response[i]['cost_per_unit'];
                    
                  
                   $('#description').val(description);
                   $('#uom').val(uom);
                   $('#unit_cost').val(cost_per_unit);
                    //alert(description);
                
                }
				 	
			} 
		});
 	}) 
 	
 	     $('.singledelete').on('click', function(e){
                
              if (confirm("Are you sure you want to remove this item?") == true) {
                  
                	let tablename =   $(this).attr('title');
		            let id =          $(this).attr('id');
		            
		           // alert(tablename + ' ' + id)
		            
                $.ajax({
        
    				type: "POST",
    				url: 'view/purchases/suppliers/delete.php',
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

