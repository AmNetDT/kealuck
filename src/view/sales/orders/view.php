<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];
//echo $member_id;
$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);

?>
<!-- Datatable !-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <script>
    $(document).ready(function() {
      $('#selectcontactpersons').DataTable();
      $('#selectshipping').DataTable();
    });
  </script>
  <!-- End datatable !-->
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div> 
        </div>
             <?php

                    $staffa = Db::getInstance()->query("SELECT a.`id`, a.`customer_code`, a.`name`, a.`phone`, a.`email`, a.`category`, a.`address`,  
                                    b.name as state, c.name as lga, d.username as added_by  
                                    FROM `customers` a 
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
                    <div class="col-8">
                        <h3><?php echo $staff->name ?> -  <span style="font-size:0.9em"><?php echo $staff->customer_code ?></span>
                         
                                          <button style="font-size:0.6em" class="farm-button-icon-button py-1 ml-0 editstaff_view" lang="view/sales/customers" id="<?php echo $staff->id; ?>">
                                            <span class="fa fa-pencil"></span>
                                          </button>
                                           <!--<button class="farm-button-cancel py-1 ml-0 editstaff_" lang="view/purchases/orders" id="<?php echo $staff->id; ?>">
                                            <span class="fa fa-save"> Tickets Management</span>
                                          </button> 
                                         <button class="farm-button py-1 ml-0 editstaff_" lang="view/purchases/orders" id="<?php echo $staff->id; ?>">
                                            <span class="fa fa-print"> Supplier Invoice</span>
                                          </button> !-->
                        </h3>
                    </div>
                    <div class="col-4 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" lang="view/sales/customers" id="#">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#contact_person_modal">
                                        <span class="fa fa-save"> Add Contact Person</span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#shipping_modal">
                                        <span class="fa fa-save"> Add Shipping</span>
                                      </button>  
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/sales/customers" id="<?php echo $member_id; ?>">
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
                                                
                                                <div class="col-md-4" style="width:100%; font-size:0.9em;">
                                                   <div class="col-md-12">
                                                        <ul class="list-group">
                                                            
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Customer Code <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->customer_code; ?></span></li>
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Description <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->name; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Phone<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->phone; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Email <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Category<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->category; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Address<span class="text-dark p-2"> <?php echo $staff->address; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">State<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->state; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">LGA.<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->lga; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Customer created by<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->added_by; ?></span></li>
                                                          
                                                        </ul>
                                                    </div>
                                                       
                                                    </div>
                                            <div class="col-md-8">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Contact Person</a>
                                                  </li>
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="next_kin" aria-selected="false">Shipping</a>
                                                  </li>
                                                  </ul>
                                               <div class="tab-content" id="myTabContent">
                                                  <div class="tab-pane fade show active p-3" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                       <!-- Contact Person Data Here !-->
                                                       
                                                       
                                                    <div style="font-size:0.9rem; float:left; width:100%;">
                                                   
                                                         <div class="table-responsive data-font" style="height: 120%;">
                                                            <div class="row justify-content-between">
                                                                <div class="col-sm-12 success_alert"></div>                                      
                                                             </div>
                                                   <?php
                                                         $staffa = Db::getInstance()->query("SELECT * FROM `contact_person` 
                                                            WHERE foreign_id = $member_id and contact_type = 'Customer'");
                                                             if (!$staffa->count()) {
                                                                 
                                                                 echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                                 
                                                             }else{
                                                   
                                                   ?>
                                                        
                                                            <table id="selectcontactpersons" class="table table-hover table-bordered">
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
                                                                        
                                                                      <div class="dropdown">
                                                                          
                                                                        <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                                          <i style="font-size:14px" class="fa">&#xf142;</i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                         
                                                                            <div class="edit_contact" lang="view/usermanager/contact_person" id="<?php echo $staff->id; ?>">
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-edit"></i>&nbsp; View/Edit Contact</button>
                                        
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
     
    <form id="uploadForm" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 alert alert-warning warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-md-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="customer_code">Contact Code</label>
                <label class="form-control bg-light">CON<?php echo $Rahma; ?></label><input type="hidden" id="contact_code" name="contact_code" class="form-control" value="CUS<?php echo $Rahma; ?>" />
              </div>
              <div class="form-group col-md-6">
              
                <label for="name">Contact Name</label>
                <input type="text" id="contact_person" name="contact_person" class="form-control" placeholder="Contact person name" />
                
              </div>
            </div>
           
            <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="contact_phone">Cell Phone</label>
                <input type="phone" id="contact_phone" name="contact_phone" class="form-control" placeholder="Cell Phone"/>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="contact_email">Email</label>
                <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"/>
                
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-md-6">
              
                <label for="contact_position">Position</label>
                <input type="text" id="contact_position" name="contact_position" class="form-control" placeholder="Contact Designation"/>
                
              </div>  
              <div class="form-group col-md-6">
              
                <label for="contact_type">Contact Type</label>
                <label class="form-control">Customer</label>
                <input type="hidden" name="contact_type" id="contact_type" value="Customer" />
              </div>
              </div>
            
            <div class="row">
              <div class="form-group col-md-12">
              
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
                         
                                                       
                                                  </div>
                                                 
                                                  <div class="tab-pane fade show p-3" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                                        
                                                        
                                                        <div class="table-responsive data-font" style="height: 120%;">
                                                            <div class="row justify-content-between">
                                                                <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                                                                <div class="resulter1">
                                                                 </div>                                      
    </div>
                                                    <?php

                                                       


                                                          $users = Db::getInstance()->query("SELECT a.`id` as ship_id, a.`ship_code`, a.`ship_name`, a.`ship_phone`, a.`ship_status`, a.`ship_address`, a.`ship_contact_person`,
                                    b.name as ship_state, c.name as ship_lga, d.username as added_by  
                                    FROM `cus_shipping` a 
                                    Left Join `states` b on a.ship_state_id = b.id
                                    Left Join lga c on a.ship_lga_id = c.id 
                                    Left Join users d on a.added_by = d.id
                                    WHERE a.`customer_id` = $member_id");
                                        
                                                          if (!$users->count()) {
                                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                          } else {
                                        
                                                        ?>
                                                            <table id="selectshipping" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                                                              <thead>
                                                                <tr> 
                                                                  <th>SN</th>
                                                                  <th>Shipping Code</th>
                                                                  <th>Name</th>
                                                                  <th>Status</th>
                                                                  <th>Address</th>
                                                                  <th>Phone</td>
                                                                  <th>State</th>
                                                                  <th>LGA.</th>
                                                                  <th>Contact Person</td>
                                                                  <th>&nbsp;</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($users->results() as $users) {
                                        
                                                                ?>
                                        
                                                                  <tr>
                                                                    <td><?php echo $i++; ?></td>
                                                                    <td><?php echo $users->ship_code; ?></td>
                                                                    <td><?php echo $users->ship_name; ?></td>
                                                                    <td><?php echo $users->ship_status; ?></td>
                                                                    <td><?php echo $users->ship_address; ?></td>
                                                                    <td><?php echo $users->ship_phone; ?></td>
                                                                    <td><?php echo $users->ship_state ?></td>
                                                                    <td><?php echo $users->ship_lga ?></td>
                                                                    <td><?php echo $users->ship_contact_person ?></td>
                                                                    <td>
                                                                        
                                                                     
                                        
                                                                       <div class="dropdown">
                                                                          
                                                                        <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                                          <i style="font-size:14px" class="fa">&#xf142;</i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                         
                                                                            <div class="editshipping_view" lang="view/usermanager/shipping" id="<?php echo $users->ship_id; ?>">
                                                                                <button class="dropdown-item">
                                                                                     <i class="fa fa-edit"></i>&nbsp; Edit Shipping</button>
                                        
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
            <p class="modal-title" id="staticBackdropLabel">Add Shipping</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
     
    <form id="hanna" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 alert alert-warning warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-md-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="ship_code">Shipping Code</label>
                <label class="form-control bg-light">SHI<?php echo $Rahma; ?></label><input type="hidden" id="ship_code" name="ship_code" class="form-control" value="SHI<?php echo $Rahma; ?>" />
              </div>
              <div class="form-group col-md-6">
              
                <label for="name">Shipping Name</label>
                <input type="text" id="ship_name" name="ship_name" class="form-control" placeholder="Shipping person name" />
                
              </div>
            </div>
           
            <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="ship_phone">Cell Phone</label>
                <input type="phone" id="ship_phone" name="ship_phone" class="form-control" placeholder="Shipping person phone"/>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="ship_contact_person">Contact Person</label>
                <input type="text" id="ship_contact_person" name="ship_contact_person" class="form-control" placeholder="Contact Person"/>
                
              </div>
            </div>
            
            <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="ship_address">Address</label>
                <textarea class="form-control" id="ship_address" name="ship_address"></textarea>
                
              </div>
            </div>
            
             <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="ship_state_id">State</label>
                <select class="form-control" id="ship_state_id" name="ship_state_id">
                      <option selected>--State--</option>
                      <?php
                 
                    $department = Db::getInstance()->query("SELECT id, name FROM `states` ORDER BY `name` ASC");
                    foreach ($department->results() as $department) {

                  ?>
                      <option value="<?php echo $department->id; ?>" title="<?php echo $department->name; ?>"><?php echo $department->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="ship_lga_id">LGA</label>
                <select class="form-control" id="ship_lga_id" name="ship_lga_id">
                      <option value="0" selected>--LGA--</option>
                </select>
                
              </div>
              
            </div>
            
            
         
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $member_id; ?>" />
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveShipping">
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
            
            let form = $('form')[0]; // You need to use standard javascript object here
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
        
        
        $('.SaveShipping').on('click', function(){
          
            
            
          let form = $('#hanna')[0]; // You need to use standard javascript object here
          let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/usermanager/shipping/insert.php',
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
        
        $("#ship_state_id").change(function(){  
	    var id = $(this).find(":selected").val();
		var dataString = 'state_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/sales/customers/getlga.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                var len = response.length;

                $("#ship_lga_id").empty();
                
                    for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                
                    $("#ship_lga_id").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
        
   evt.preventDefault();
   });
       
   
  
  </script>
  


<script>
    $(document).ready(function(event) {
        
        
    	$('.prev_page').click(function (e) {
		
		let ed = $(this).attr('lang');
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/index.php",
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
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
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

       
       
    	$('.editstaff_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let member_id = $(this).attr('id');
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
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
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
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
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edit_shipping.php",
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
   
   
	
   event.preventDefault();
   });
  </script>

