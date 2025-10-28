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
          
            

            <div class="jumbotron bg-white">
              
                <div class="col-sm-12">
                <div class="row justify-content-between">
                    <div class="col-sm-9">
                       <h3>Edit Budget</h3>     
                    </div>
                   <div class="col-sm-3">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-12 success_alert"></div>
                    <div class="col-sm-12 warning_alert"></div>
                 </div>
         <?php


            $users = Db::getInstance()->query("SELECT * FROM budget
            WHERE id = $member_id");
            
            foreach ($users->results() as $use) {

            ?>
             <form method="POST" autocomplete="off" id="edit_budget_form" name="edit_budget_form">
                 <div class="row">
                     <div class="form-group col-sm-6">
                            <label for="transaction_year">Transaction Year</label>
                                <select id="transaction_year" name="transaction_year" class="form-control farm-button-cancel">
                                    <option value="<?php echo $use->transaction_year; ?>"><?php echo $use->transaction_year; ?></option>
                                    <option value="<?php echo date('Y') + 1; ?>"><?php echo date('Y') + 1; ?></option>
                                <?php
                                
                                 $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                                    foreach($transact_year->results() as $transact_year){
                            
                                ?>
                                
                                    <option value="<?php echo $transact_year->year; ?>"><?php echo $transact_year->year; ?></option>
                                    <?php
                                            }
                                        ?>
                                </select>
                        </div>
                     </div>
                     
                 <div class="row">
                     <div class="col-sm-12">
                           <div class="form-group">
                             <label for="department">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?php echo $use->description; ?></textarea>
                                
                           </div>
                         </div>
                 </div>
                 <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>" /> 
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                 <div class="row">
                 <div class="col-sm-12" id="submitButton">
                     <button type="button" id="save" class="btn btn-light mb-3 edit_budget">
                         <span class="fa fa-edit"> Edit</span>
                     </button>
                 </div>
                </div>
             </form>
         <?php }
            ?>
   


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
   


  <script>
   $(document).ready(function(event) {
       
        $('.edit_budget').on('click', function(){
            
            let form = $('#edit_budget_form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/accounting/reports/budget/update.php',
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
        
    	$('.edituser_view').click(function () {
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/accounting/reports/budget/",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		
	});   
      
      event.preventDefault(); 
   });
   
   </script>
   
  

