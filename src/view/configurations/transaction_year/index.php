<?php

require_once '../../core/init.php';


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
          

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Transaction Year</h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page">
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
                            <label for="year">Add Year</label>
                           <input type="number" id="year" name="year" class="form-control" placeholder="YYYY" />
                         </div>
                    
                          <div class="form-group col-sm-12">
                            <label for="trans_year">Transaction Years</label>
                            <select multiple class="form-control" id="trans_year" name="trans_year">
                                <?php
                  
                    $transaction_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                                    foreach ($transaction_year->results() as $trans) {
              
                 
                    ?>
                              <option><?php echo $trans->year; ?></option>
                              <?php
                                     }
                    ?>
                            </select>
                         </div>
                         <input type="hidden" id="ids" />
                         <div class="form-group col-sm-12">
                             <button type="button" class="btn-danger delete">
                         <i class="fa fa-trash-o" aria-hidden="true"></i> Delete <i id="yearlabel"></i>
                         </button>
                         </div>
                      
                     </div> 
                    </div>
                    
                
                </form>
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
        $('.success_alert').hide();
        $('.warning_alert').hide();
        $('.delete').hide();
        
        $("#trans_year").change(function(e){  
            
    	    const year = $(this).find(":selected").val();
    	    
        	const dataString = {
                year: year
            };
        
		
		$.ajax({
    			type: "POST",
    			url: 'view/configurations/transaction_year/gettransaction_year.php',
    			dataType: 'JSON',
    			data: dataString,
    			cache: false,
    			success: function (response) {
    			     
                 
                    $("#id").empty();
                    $("#yearlabel").empty();
                
                              
                                let id    = response.id;
                                let year = response.year;
                          
                                
                                 $('#ids').val(id);
                                 $('#yearlabel').val(year);
                                 $('.delete').show();
    				 	
    		 }
    	});
        		
	

            e.preventDefault(); 
     	});
     
     
     	$(".delete").on('click', function(){
     	    
     	     if (confirm("Are you sure you want to remove this item?") == true) {
     	         
     	    let ids = $('#ids').val();
     	    
     	  
     	    $.ajax({
        				url: 'view/configurations/transaction_year/delete.php',
        				data: {
                		    ids    : ids
                		    
                		},
                        type: 'POST',
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
     	    
                  } else {
                    return false;
                    
                  }
     	})
       
        $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/transaction_year/insert.php',
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
       
        $('.edituser_view').click(function (e) {
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/configurations/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
	
    	$('.current_page').click(function (e) {
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/transaction_year/",
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