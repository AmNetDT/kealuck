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
                  
                    $users = Db::getInstance()->query("SELECT * FROM tax 
                    WHERE id = $member_id");
                    foreach ($users->results() as $stockQ) {
              
                 
                   $name = $stockQ->title;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Tax: <?php echo $name; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations/tax/" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/configurations/tax" id="<?php echo $member_id ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
                
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 <form method="POST" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-sm-4">
                            <label for="title">Title</label>
                           <input type="text" id="title" name="title" value="<?php echo $stockQ->title; ?>" class="form-control" placeholder="Title" />
                         </div>
                    
                      <div class="form-group col-sm-4">
                            <label for="type">Type</label>
                           <input type="text" id="type" name="type" value="<?php echo $stockQ->type; ?>" class="form-control" placeholder="Type" />
                         </div>
                    
                      <div class="form-group col-sm-4">
                            <label for="percentage">Percentage %</label>
                           <input type="text" id="percentage" name="percentage" value="<?php echo $stockQ->percentage; ?>" class="form-control" placeholder="0.0%" />
                         </div>
                    
                      <div class="form-group col-sm-4">
                            <label for="rebate">Rebate</label>
                           <input type="text" id="rebate" name="rebate" value="<?php echo $stockQ->rebate; ?>" class="form-control" placeholder="Rebate" />
                         </div>
                      <div class="form-group col-sm-4">
                            <label for="receiver">Receiver</label>
                           <input type="text" id="receiver" name="receiver" value="<?php echo $stockQ->receiver; ?>" class="form-control" placeholder="Receiver" />
                         </div>
                    
                      <div class="form-group col-sm-12">
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Note</div>
                        </div>
                          <textarea class="form-control" name="note" id="note" rows="3"><?php echo $stockQ->note; ?></textarea>
                         </div>
                     </div> 
                    </div>
                   
                    <input type="hidden" id="id" name="id" value="<?php echo $stockQ->id; ?>" />
                    
                
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
        				url: 'view/configurations/tax/update.php',
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
    	
    		//Pssing values to nextPage 
    		let rsData = "eQvmTfgfru";
    		let dataString = "rsData=" + rsData;
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/edittax.php",
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