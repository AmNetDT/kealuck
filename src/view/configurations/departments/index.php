<?php

require_once '../../core/init.php';

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
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
          <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Departments</h3>
            </div>
          <div class="row my-3">
            <div class="container">
            <div class="col-sm-12">
                <div class="row justify-content-end">
                   <div class="col-sm-9">
                      
                      </div>
                      
                  
                    <div class="col-sm-3">
                      <button class="farm-button-cancel py-1 ml-0 previous_page">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal" data-target="#staticBackdrop">
                        <span class="fa fa-plus"> Create Department</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              </div>
              
                <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 <div id="department"></div>
            		<div id="sload"></div>
            		
             


            </div>

          </div>
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


<!-- Create Dept Modal !-->

  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <form id="update_form" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">New Department</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pt-0">
              <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
            <div class="row">
              <div class="form-group col-sm-6">
                <label>Name</label>
                <input type="text" id="name" class="form-control" placeholder="Department Name" required />
              </div>
              <div class="form-group col-sm-6">
                <label>Location</label>
                <select class="form-control" id="location" name="location">
                    <option value="">-- Choose --</option>
                    <?php
                    
                             $us = Db::getInstance()->query("SELECT * FROM worklocation");

                              if (!$us->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($us->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->location; ?>"><?php echo $usr->location; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required/>
              </div>
              <div class="col-lg-6 form-group">
                <label>Phone</label>
                <input type="phone" name="phone" id="phone" class="form-control" placeholder="Contact Phone Nunmber" required/>
              </div>
            </div>
          </div>
          <div class="modal-footer">
             <input type="hidden" id="added_by" value="<?php echo $username ?>" />
            <button type="button" id="create" class="py-1 px-2 border farm-color mx-0">Add Department</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- End Create Dept Type Modal !-->
 

  <!-- End Create Job Type & Job Title Modal !-->
 
  <script>
  	function showDepartment(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/departments/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#department").html(html);
                $('#sload').html(''); 
            }
        });
    }
    
   $(document).ready(function(event) {
       
        showDepartment(10, 1);
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
       	
        $('.previous_page').click(function (e) {
		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/configurations/",
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
        		e.preventDefault();
        	});   
       
        $('#create').on('click', function(){
    
       var name = $('#name').val();
       var location = $('#location').val();
       var phone = $('#phone').val();
       var email = $('#email').val();
       var added_by = $('#added_by').val();
   	    
   	    if(name=="" || added_by=="" ){
   	        alert('All field requred');
   	    }else{    
   	        
       	    $.ajax({
    				url: 'view/configurations/departments/insert.php',
    				type: 'POST',
    				data: {
    					
    					 name: name,
                         location: location,
                         phone: phone,
                         email: email,
                         added_by: added_by
    					
    				    },
    					cache: false,
    					beforeSend: function() {
    					    
    						$('#abdganiu').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    
    					},
    					success: function (data) {
    					    
                            $(".success_alert").html(data);
                            $(".success_alert").show();
    					    
    					},
    					error: function (){
    					    
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            
    					}
    			});
   	    }
   	    return false;
	});

    	$('.editstaff_index').click(function (e) {
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/configurations/departments/",
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
  

  