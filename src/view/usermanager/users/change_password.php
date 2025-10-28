<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

$user = new User();
if ($user->isLoggedIn()) {

$username_id = escape($user->data()->id);

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
              
                <div class="col-md-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Change Password</h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/usermanager/users/" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/usermanager/users" id="<?php echo $member_id ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
                
              
               
                 <div class="row my-4">
                    <div class="col-sm-12">
                         <div class="success_alert"></div>
                         <div class="warning_alert"></div>
                     </div>
                </div>
                
             <form method="POST" autocomplete="off">
                 <div class="row">
                   
                 <div class="row">
                     
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="password">Password</label>
                         <input type="password" name="password" id="password" class="form-control" />
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="confirm_password">Confirm Password</label>
                         <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                     </div>
                     </div>
                </div>     
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username_id; ?>" />
                 <input type="hidden" name="id" id="id" value="<?php echo $member_id; ?>" />
                 <input type="hidden" name="token" id="token" value="<?php echo Token::generate() ?>" />
                 <div class="row">
                    <div class="col-md-12" id="submitButton">
                     <button type="button" id="save" class="btn btn-light mb-3">
                         <span class="fa fa-edit"> Update</span>
                     </button>
                 </div>
                </div>
                </div>
              </form>

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
 $(document).ready(function(event) {
        
        $('.wait_alert').hide();
        $('.success_alert').hide();
        $('.warning_alert').hide();
   
       
        $("#save").click(function() {

         let id = $('#id').val();
         let password = $('#password').val();
         let confirm_password = $('#confirm_password').val();
         let token = $('#token').val();
         let added_by = $('#added_by').val();



         $.ajax({
             url: "view/usermanager/users/update_password.php",
             method: 'POST',
             data: {
                 
                 id: id,
                 password: password,
                 confirm_password: confirm_password,
                 token: token,
                 added_by: added_by

             },
             beforeSend: function() {
                 
    					    $('.wait_alert').html('Please, wait...');
    					    $('.wait_alert').show();
    					    $('.wait_alert').slideDown();
    					    
             },
             success: function (data) {
    					    $(".success_alert").html(data);
                            $(".success_alert").show();
                	   
    					},
    					error: function (){
    					    $(".warning_alert").html(data);
                            $(".warning_alert").show();
    					}
         });

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
    			url: ed + "/change_password.php",
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
       
   });
   
   </script>

