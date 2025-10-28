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

    <div class="col-sm-6 offset-md-3">
        <div id="accounttile" class="container">
          <?php
                  
                    $equipmenttype = Db::getInstance()->query("SELECT * FROM equipmenttype 
                    WHERE id = $member_id");
                    foreach ($equipmenttype->results() as $account) {
              
                 
                   $name = $account->title;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Title: <?php echo $name; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
                
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 <form method="POST" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-sm-12">
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Equipment Type</div>
                        </div>
                           <input type="text" id="title" name="title" value="<?php echo $account->title; ?>" class="form-control" />
                         </div>
                     </div> 
                    </div>
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                  <input type="hidden" id="id" name="id" value="<?php echo $account->id;; ?>" />
                
                </form>
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


<!-- Create Dept Modal !-->
  
<script>
    $(document).ready(function(event){
        $('.success_alert').hide();
        $('.warning_alert').hide();
   
        $('.SaveStaff').on('click', function(e){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/equipmenttype/update.php',
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
              e.preventDefault();  
            });
       
       
    	$('.current_page').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/equipmenttype/editview.php",
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

       
    	$('.edituser_view').click(function (e) {
		
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/configurations/equipmenttype/index.php",
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