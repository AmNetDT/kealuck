<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();
if ($user->isLoggedIn()) {
    
    $username = escape($user->data()->id);

?>

  
  
  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-md-6 offset-md-3">
        <div id="accounttile" class="container">
          

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-between">
                    <div class="col-md-9">
                       <h3>Update Departments</h3>     
                    </div>
                   <div class="col-md-3">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations/departments/" id="#">
                        <span class="fa fa-chevron-left"></span> Previous
                      </button>
                    </div> 
                </div>
                
                  <div class="row mt-0 mb-3 pt-0">
                    <div class="col-md-12 alert alert-success m-0" id="resulte"></div>
                    <div class="col-md-12 alert alert-warning m-0" id="resulterErro"></div>
                  </div>
                  <?php
                  $users = Db::getInstance()->query("SELECT * FROM departments WHERE id=$member_id");
            foreach ($users->results() as $department) {
                
                ?>
                 <form method="POST" autocomplete="off">
                    <div class="row">
              <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" id="uname" value="<?php echo $department->name; ?>" class="form-control" placeholder="Department Name" />
              </div>
              <div class="form-group col-md-6">
                <label>Location</label>
                <select class="form-control" id="ulocation" name="ulocation">
                    <option value="<?php echo $department->address; ?>"><?php echo $department->address; ?></option>
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
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="text" id="uemail" value="<?php echo $department->email; ?>" class="form-control" placeholder="Email Address" />
              </div>
              <div class="col-lg-6 form-group">
                <label>Phone</label>
                <input type="text" id="uphone" value="<?php echo $department->phone; ?>" class="form-control" placeholder="Contact Phone Nunmber" />
              </div>
            </div>
                    <hr class="my-4">
                    <input type="hidden" id="uids" value="<?php echo $department->id; ?>" />
                    <input type="hidden" id="uadded_by" value="<?php echo $username; ?>" />
                    
                    <button type="button" id="save" class="btn btn-light mb-3">
                         <span class="fa fa-edit"> Update</span>
                     </button>
                
                </form>
                <?php
                }
                ?>
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
  
<script>
    $(document).ready(function(event){
        $('#resulte').hide();
        $('#resulterErro').hide();
   
         
        $('#save').click(function() {
            
               var name = $('#uname').val();
               var location = $('#ulocation').val();
               var phone = $('#uphone').val();
               var email = $('#uemail').val();
               var added_by =  $('#uadded_by').val();
               var ids =  $('#uids').val();
               
               
               
                if(name=="" || added_by=="" ){
                alert('Fill in the fields');
                }else{
                  $.ajax({
            				url: 'view/configurations/departments/update.php',
            				type: 'POST',
            				data: {
            				    name : name,
            				    location:location,
            				    phone:phone,
            				    email:email,
            				    added_by:added_by,
            				    ids:ids
            				},
                			success: function (data) {
    					    $('#resulte').html(data);
    					    $('#resulte').show();
    					    $('#resulte').slideDown();
                                  
                			},
        					error: function (){
        					    $('#resulterErro').slideDown();
        					    $('#resulterErro').html(data);
        					}
    
   
            });
                }
        });
   
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
	
    event.preventDefault();   
   });
   
   </script>