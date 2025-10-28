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

                    $staffa = Db::getInstance()->query("SELECT a.`id` as cont_id, a.`contractor_code`, a.`name`, a.`email`, a.`category`, a.`address`, a.`phone`, a.`bank`, 
                    a.`bank_nameonaccount`, a.`bank_account`, a.`acceptance_date`, a.`image`, a.`added_by`, 
                    a.`modify_date`, a.`creation_date`, b.`id`, b.`username` 
                    FROM contractors a left join users b on a.`added_by` = b.`id` 
                    WHERE a.`id` =  $member_id");

                    if ($staffa->count()) { 
                        foreach ($staffa->results() as $staff) {
                    ?>
            <div class="jumbotron jumbotron-fluid pt-5 bg-white">
       
            <div class="row">
                <div class="container py-3">
                    <h3><?php echo $staff->name ?> -  <span style="font-size:0.9em"><?php echo $staff->contractor_code ?></span></h3>
        <div class="row mt-4">
            <div class="container">
                <div class="col-md-12">
                <div class="row justify-content-end mb-3">
                    <div class="col-4 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" lang="view/usermanager/contractors/" id="#">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0" data-toggle="modal" data-target="#contact_person_modal">
                                        <span class="fa fa-save"> Add Contact Person</span>
                                      </button> 
                                      <button class="farm-button-icon-button py-1 ml-0 editstaff_view" lang="view/usermanager/contractors" id="<?php echo $member_id; ?>">
                                        <span class="fa fa-pencil"> Update</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/usermanager/contractors" id="<?php echo $member_id; ?>">
                                        <span class="fa fa-refresh"></span>
                                      </button>
                    </div>
                    
                </div>
              </div>
                   
                            <div class="row border-bottom justify-content-center">
                                <div class="container my-4">
                                    <div class="card mb-3" style="width:100%; font-size:0.8em;">
                                        <div class="row">
                                                <div class="col-sm-1">
                                                    <?php if (!empty($staff->image)) {
                                                        echo '<img src="view/usermanager/contractors/' . $staff->image . '" class="card-img" alt="">';
                                                    } else {
                                                        echo '<img class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="" />';
                                                    } ?>
                                                </div>
                                                <div class="col-sm-3" style="width:100%; font-size:0.8em;">
                                                   
                                                        <ul class="list-group">
                                                            
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Contractor Code <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->contractor_code; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Description <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->name; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Email<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Contrator Type <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->category; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Cantact Address <span class="text-dark p-2"> <?php echo $staff->address; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Telephone<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->phone; ?></span></li>
                                                          
                                                          
                                                        </ul>
    
                                                       
                                                    </div>
                                            <div class="col-sm-8">
                                                
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button active" id="banking-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="banking" aria-selected="true">Bank Details</a>
                                                  </li>
                                                  <li class="nav-item" role="presentation">
                                                    <a class="nav-link farm-tab-button" id="contact_details-tab" data-toggle="tab" href="#contact_details" role="tab" aria-controls="contact_details" aria-selected="false">Contact Person</a>
                                                  </li>
                                                  </ul>
                                               <div class="tab-content" id="myTabContent">
                                                   
                                                  <div class="tab-pane fade show active p-3" id="banking" role="tabpanel" aria-labelledby="banking-tab">
                                                       <div style="font-size:0.9rem; float:left; width:100%;">
                                                   
                                                        <ul class="list-group">
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Bank Name <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->bank; ?></span></li>
                                                          <li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">Acct. Name<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->bank_nameonaccount; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Acct. Number<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->bank_account; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Acceptance Date<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->acceptance_date; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Reg. By<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->username; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Last updated<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->modify_date; ?></span>Email<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->email; ?></span></li>
                                                          <li class="list-group-item d-flex justify-content-between align-items-center">Creation Date<span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->creation_date; ?></span></li>
                                                     </ul>
                                                       
                                                    </div>
                                                  </div>
                                                  <div class="tab-pane fade show p-3" id="contact_details" role="tabpanel" aria-labelledby="contact_details-tab">
                                                       <!-- Contact Person Data Here !-->
                                                       
                                                       
                                                   
                                                         <div class="table-responsive data-font" style="height: 100%;">
                                                            <div class="row justify-content-between">
                                                                <div class="col-sm-12 success_alert"></div>                                      
                                                             </div>
                                                   <?php
                                                         $staffa = Db::getInstance()->query("SELECT * FROM `contact_person` 
                                                            WHERE foreign_id = $member_id and contact_type = 'Contractor'");
                                                             if (!$staffa->count()) {
                                                                 
                                                                 echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                                 
                                                             }else{
                                                   
                                                   ?>
                                                        
                                                            <table id="selectcontactpersons" class="table table-hover table-bordered" style="font-size:0.8rem; width:100%;">
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
                                                     
                                                     
                                                    
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="contact_person_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                                            <label class="form-control">Contractor</label>
                                                                            <input type="hidden" name="contact_type" id="contact_type" value="Contractor" />
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
<?php

} else {
    $user->logout();
    Redirect::to('../../login/');
}


?>

<script>
    $(document).ready(function (){
        $(".resulter").hide();
        $(".resulterError").hide();
    })
</script>

<script>
    $(document).ready(function (event){
         $('.success_alert').hide();
         $('.warning_alert').hide();
        
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
       
    	$('.prev_page').click(function (e) {
		
		let ed = $(this).attr('lang');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
          
       
	    $('.current_page').click(function (e) {
		
		var ed = $(this).attr('lang');
		var id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
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
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edituser.php",
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
   
   
   event.preventDefault();
   });
  </script>

