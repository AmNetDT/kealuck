<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

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
                  
                    $woperations = Db::getInstance()->query("SELECT * FROM workoperation_description 
                    WHERE id = $member_id");
                    foreach ($woperations->results() as $wop) {
              
                    $wop_code = $wop->wop_code;
                   
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Operation: <?php echo $wop_code; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations/workoperationcategory/" id="#">
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
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 <form id="locationInsert" method="POST" autocomplete="off">
     
                      <div class="row">
                        
                          <div class="col-sm-4">
                          <label for="wop_code">WOp Code</label>
                              <input type="text" class="form-control" id="wop_code" name="wop_code" value="<?php echo $wop->wop_code; ?>"
                                    class="form-control" readonly />
                          
                        </div>
                        <div class="col-sm-4">
                          <label for="no_of_workers">No. of Workers</label>
                              <input type="text" class="form-control" id="no_of_workers" value="<?php echo $wop->no_of_workers; ?>" name="no_of_workers" />
                            
                        </div>
                        <div class="col-sm-4">
                          <label for="cost_per_hour">Cost (Per Hour)</label>
                              <input type="text" class="form-control" id="cost_per_hour" value="<?php echo $wop->cost_per_hour; ?>" name="cost_per_hour" />
                         
                        </div>
                          </div>
                          <div class="row">
                          <div class="form-group col-sm-12">
                            <label for="description">Operation</label>
                             <div class="input-group mb-2">
                             <div class="input-group-prepend">
                              <div class="input-group-text">Description</div>
                            </div>
                            <textarea class="form-control" name="description" id="description" rows="3"><?php echo $wop->description; ?></textarea>
                               
                            </div> 
                          </div>
                          <input type="hidden" name="id" id="id" value="<?php echo $wop->id; ?>" />
                      </div>
                  
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
        				url: 'view/configurations/workoperationcategory/update.php',
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
    		
    	
    		let id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/workoperationcategory/editview.php",
    			data: {
    				'member_id': id  
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