<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>


  
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron pt-5 bg-white">
            <div class="row m-3 mb-4">
          <h3>Employee Management</h3>
          </div>
          <div class="row my-3">
            <div class="container">
              <?php
              $username = escape($user->data()->id);
              $userSyscategory = escape($user->data()->syscategory_id);
              $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
              ?>
              <div class="col-md-12">
                <div class="row justify-content-between">
                  
                  <div class="col-md-2">
                                        
                                    </div>
                   <div class="col-md-7">
                      <!--<button class="farm-button" id="add_button" data-toggle="modal" data-target="#JobType" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Job Type</span>
                      </button>!-->
                     
                      </div>
                      
                  
                    <div class="col-md-3">
                      <button class="farm-button py-1 ml-3" id="add_button_" data-toggle="modal" data-target="#AddModal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Add User</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/usermanager/users/" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  </div>
                  </div>
                  

                </div>
                
              </div>

              <div id="userr"></div>
               <div id="load"></div>
            </div>
          </div>
        </div>


  <?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
     <!-- Add Crop Type Modal !-->

  <div id="AddModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
    <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">New User</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <form autocomplete="off">
          <div class="modal-body">
                <div class="row mt-0 mb-3 pt-0">
                    <div class="col-md-12 alert alert-success m-0" id="resulter"></div>
                    <div class="col-md-12 alert alert-warning m-0" id="resulterError"></div>
                 </div>
          <p class="login-card-description">
            Register a new user account</p>
          <?php


          $locating = escape($user->data()->department_id);
          $userSyscategory = escape($user->data()->syscategory_id);
          $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");


          ?>
          
            <div class="row">
              <div class="form-group col-md-6">
                  <label for="name">Username</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">User Id: </span>
                      </div>
                      <input type="text" class="form-control" id="username" value="<?php $randomid = mt_rand(100,999);
                            $randomidplus = mt_rand(100,999); echo $randomid.'-'.$randomidplus;  ?>"
                            class="form-control" aria-label="Username" aria-describedby="basic-addon1" disabled />
                    </div>
                
                
                
              </div>
             <div class="form-group col-md-6">
                <label for="department">Department</label>
                <select class="form-control" id="department">
                  <option selected>--Department--</option>
                  <?php
                 
                    $department = Db::getInstance()->query("SELECT * FROM `departments` ORDER BY `id` DESC");
                    foreach ($department->results() as $department) {

                  ?>
                      <option value="<?php echo $department->id; ?>" title="<?php echo $department->name; ?>"><?php echo $department->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
              </div>
            </div>
            
            <div class="row">
             <div class="form-group col-md-6">
                <label for="supervisor">Supervisor</label>
                <select class="form-control" id="supervisor">
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="jobtitle">Job Title</label>
                <select class="form-control" id="jobtitle">
                  <option selected>--Job Title--</option>
                  <?php
                
                    $department = Db::getInstance()->query("SELECT * FROM `job_title` ORDER BY `id` DESC");
                    foreach ($department->results() as $department) {

                  ?>
                      <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
              </div>
              </div>
            <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="worklocation">Work Location</label>
                <select class="form-control" id="worklocation">
                  <option selected>--Location--</option>
                  <?php
                 
                    $Syscategory = Db::getInstance()->query("SELECT * FROM `worklocation` ORDER BY `id` ASC");
                    foreach ($Syscategory->results() as $Syscategory) {
                  ?>
                      <option value="<?php echo $Syscategory->id; ?>"><?php echo $Syscategory->location; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
              
              </div>
              <div class="form-group col-md-6">
              
                <label for="syscategory">Privilege</label>
                <select class="form-control" id="syscategory">
                  <option selected>--Permission--</option>
                  <?php
               
                    $Syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` ORDER BY `id` ASC");
                    foreach ($Syscategory->results() as $Syscategory) {
                  ?>
                      <option value="<?php echo $Syscategory->id; ?>"><?php echo $Syscategory->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
              
                <input type="hidden" id="token" value="<?php echo Token::generate(); ?>" />
                <input type="hidden" id="added_by" value="<?php echo escape($user->data()->id); ?>" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="password"> Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" />
               </div>
               <div class="form-group col-md-6">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" />
              </div>
            </div>
            </div>
            
          <div class="modal-footer">
            <input type="button" id="create" class="py-1 px-2 border farm-color mx-0" value="Add User" />
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
    </div>
  </div>


 
  <script>
   $(document).ready(function(event) {
       
       
    	$('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(dataString);
		
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
       
        $("#department").change(function(){  
	    var id = $(this).find(":selected").val();
		var dataString = 'department_id='+ id;  
		 
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/users/getSupervisor.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
            
                var len = response.length;

                $("#supervisor").empty();
                
                    for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                
                    $("#supervisor").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
 	
    
    
       
     //End Create Dept Type Modal
    $('#resulter').hide();
    $('#resulterError').hide();
       	
    $('#create').on('click', function(){
     
      let username = $('#username').val();
      let syscategory = $('#syscategory').val();
      let usertypename = $('option:selected', '#department').attr('title');
      let jobtitle = $('#jobtitle').val();
      let department = $('#department').val();
      let supervisor = $('#supervisor').val();
      let worklocation = $('#worklocation').val();
      let password = $('#password').val();
      let confirm_password = $('#confirm_password').val();
      let token = $('#token').val();
      let added_by = $('#added_by').val();
   
   	 
   	  
   	  let result = usertypename.substr(0, 2);
   	  let re = result.toUpperCase();
   	  let res =  re+username;
   	 
   	//alert(syscategory);
   	      
   	        
      	    $.ajax({
    				url: 'view/usermanager/users/insert.php',
    				type: 'POST',
    				data: {
    					
    					  username: res,
                          syscategory: syscategory,
                          jobtitle: jobtitle,
                          department: department,
                          supervisor: supervisor,
                          worklocation: worklocation,
                          password: password,
                          confirm_password: confirm_password,
                          token: token,
                          added_by: added_by
    					
    				    },
    					cache: false,
    					beforeSend: function() {
    					    
    						$('#abdganiu').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    
    					},
    					success: function (data) {
    					    $('#resulter').html(data);
    					    $('#resulter').show();
    					    $('#resulter').slideDown();
                	        $('#load').html(''); 
                                  setTimeout(function(){// wait for 5 secs(2)
                                      $(document).ready(function() {
                                        showUsers(10, 1);
                                    }); // then reload the page.(3)
                                  }, 100); 
                           
    					},
    					error: function (){
    					    $('#resulterError').show();
    					    $('#resulterError').html(data);
    					    $('#resulterError').slideDown();
    					}
    			});
   	    
	});

   
   event.preventDefault();
   });
  </script>
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/usermanager/users/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showUsers(10, 1);
    });
 </script>
   
  <script>
   $(document).ready(function(event) {
       
       
    	$('.editstaff_index').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed,  
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
  

