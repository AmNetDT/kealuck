<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

$user = new User();
if ($user->isLoggedIn()) {
   

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
                  
                    $job_level = Db::getInstance()->query("SELECT * FROM job_level 
                    WHERE id = $member_id");
                    foreach ($job_level->results() as $job_level) {
              
                 
                   $name = $job_level->level;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Location: <?php echo $name; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations/joblevel/" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/configurations/joblevel" id="<?php echo $member_id ?>">
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
                          <div class="form-group col-sm-6">
                            <label for="name">Level</label>
                            <input type="text" id="level" name="level" class="form-control" value="<?php echo $job_level->level; ?>" />
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="basic">Basic</label>
                            <input type="text" id="basic" name="basic" class="form-control" value="<?php echo $job_level->basic_salary; ?>" />
                          </div>
                         </div>
                       <div class="row">
                        
                          <div class="form-group col-sm-6">
                            <label for="housing">Housing</label>
                            <input type="text" id="housing" name="housing" class="form-control" value="<?php echo $job_level->housing_allowance; ?>" />
                              </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="medical">Medical</label>
                            <input type="text" id="medical" name="medical" class="form-control" value="<?php echo $job_level->medical_allowance; ?>" />
                          </div>
                          
                         </div> 
                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label for="utility">Utility</label>
                            <input type="text" id="utility" name="utility" class="form-control" value="<?php echo $job_level->utility_allowance; ?>" />
                              </div>
                          <div class="form-group col-sm-6">
                            <label for="transport">Transport</label>
                            <input type="text" id="transport" name="transport" class="form-control" value="<?php echo $job_level->transport_allowance; ?>" />
                          </div>
                          </div>
                          <div class="row">
                              
                          <div class="form-group col-sm-6">
                            <label for="entertainment">Entertainment</label>
                            <input type="text" id="entertainment" name="entertainment" class="form-control" value="<?php echo $job_level->entertainment; ?>" />
                          </div>
                          </div>
                   
                    <input type="hidden" id="id" name="id" value="<?php echo $job_level->id; ?>" />
                  
                
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
   
       
        $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/joblevel/update.php',
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
       
         
       
    	$('.current_page').click(function (e) {
    		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/editjoblevel.php",
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
	<script>
   $(document).ready(function(event) {
       
       
    	$('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		
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