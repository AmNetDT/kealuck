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
                  
                    $users = Db::getInstance()->query("SELECT a.id, a.accounts_type_id, a.title as group_title, b.title as account_type 
                                                        FROM chart_of_accounts_group a 
                                                        LEFT JOIN chart_of_accounts_types b ON a.accounts_type_id = b.id
                                                        WHERE a.id = $member_id");
                                
                                foreach ($users->results() as $stockQ) {
              
                 
                   $name = $stockQ->title;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Account Group: <br /><?php echo $name; ?></h3> </h3>     
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
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 <form method="POST" autocomplete="off" id="formAccountGroupUpdate">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Account Category</label>
                            <select class="form-control" id="accounts_type_id" name="accounts_type_id">
                              <option value="<?php echo $stockQ->accounts_type_id; ?>"><?php echo $stockQ->account_type; ?></option>
                              <?php
                              
                                    $sqlQuery = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types WHERE id in (4, 10)");
                                    if (!$sqlQuery->count()) {
                                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                  } else {
                                        foreach ($sqlQuery->results() as $accounttypes) { 
                              ?>
                              <option value="<?php echo $accounttypes->id; ?>"><?php echo $accounttypes->title; ?></option>
                              <?php
                                        }
                                  }
                              
                              ?>
                            </select>
                          </div>  
                      <div class="form-group col-6">
                            <label for="title">Title</label>
                           <input type="text" id="title" name="title" value="<?php echo $stockQ->group_title; ?>" class="form-control" />
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
       
                let form = $('#formAccountGroupUpdate')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/accounttypes/updatechart_of_accounts_group.php',
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
    			url: "view/configurations/accounttypes/edit_acc_group.php",
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
		
	
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/configurations/accounttypes/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		event.preventDefault();
	});   
       
   });
   
   </script>