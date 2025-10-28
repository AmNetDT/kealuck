<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

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
                  
                    $accounttypes = Db::getInstance()->query("SELECT a.*, b.id as category_id, b.title as account_type, 
                    c.id as group_id, c.title as group_title 
                    FROM chart_of_accounts a
                    LEFT JOIN chart_of_accounts_types b ON a.category_id = b.id
                    LEFT JOIN chart_of_accounts_group c ON b.id = c.accounts_type_id
                    WHERE a.id = $member_id
                    LIMIT 1");
                    foreach ($accounttypes->results() as $account) {
              
                 
                   $name = $account->account_type;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Account Title: <?php echo $name; ?></h3> </h3>     
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
                        <div class="form-group col-sm-6">
                <label>GL Code</label>
                <input type="text" id="gl_code" name="gl_code" class="form-control" value="<?php echo $account->gl_code; ?>" readonly />
              </div>
              <div class="form-group col-sm-6" id="category_div">
                <label>Account Category</label>
                <select class="form-control" id="category_id" name="category_id">
                  <option value="<?php echo $account->category_id; ?>"><?php echo $account->account_type; ?></option>
                  <?php
                  
                        $sqlQuery = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types");
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
                  
                    <label>Description</label>
                   <input type="text" id="description" name="description" value="<?php echo $account->description; ?>" class="form-control" />
             </div> 
                     
              <div class="form-group col-sm-6" id="group_div">
                <label>Group</label>
                <select class="form-control" id="group_id" name="group_id" >
                    <option value="<?php echo $account->group_id; ?>"><?php echo $account->group_title; ?></option>
                </select>
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
        				url: 'view/configurations/accounttypes/update.php',
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
    		
    		let id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/accounttypes/editview.php",
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
		e.preventDefault();
	});  
	
	      
        $("#category_id").change(function(){  
           
    	    let id = $(this).find(":selected").val(); // Assuming numerical value
            let dataString = 'category_id='+ id; 
                
            if (dataString === 'category_id=4' || dataString === 'category_id=7' || dataString === 'category_id=10') {
                
                $('#group_div').show();
	        	//alert(dataString);
        	
        		$.ajax({
        			url: 'view/configurations/accounttypes/getGroup.php',
                    dataType: 'json',
        			data: dataString,  
        			cache: false,
        			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS
        			success:function(response){
                        
                        var len = response.length;
        
                        $("#group_id").empty();
                        
                          for( var i = 0; i<len; i++){
                           
                            let id     = response[i]['id'];
                            let title  = response[i]['title'];
                            
                          
                            //alert(location);
                           
                            $('#group_id').append("<option value='" + id + "'>" + title + "</option>");
                          
                          
                        }
                           
                    }
        				 	
        			
        		});
        		
                    }else{
                        
                        $("#group_id").empty();
                        $('#group_div').hide();
                        
                    }
         	})  
        	
           
	
      event.preventDefault();
   });
   
   </script>