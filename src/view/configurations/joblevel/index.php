<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
    

$username = escape($user->data()->id);
?>

  
    <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Job Level</h3>
            </div>
            <div class="col-sm-12">
                <div class="row justify-content-end mb-4">
                    <div class="edituser_view col-sm-2" lang="view/configurations">
                                       
                                    </div>
                   <div class="col-sm-7">
                      
                      </div>
                      
                  
                    <div class="col-sm-3">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addWorkModal" data-target="#staticBackdrop">
                        <span class="fa fa-plus">Add Level</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/configurations/joblevel">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              </div>
              
          <div class="row">
              <div class="col-sm-12 m-0 success_alert" id="success_alert"></div>
              <div class="col-sm-12 m-0 warning_alert" id="warning_alert"></div>
          </div>      
         <div class="row">
            <div class="col-12">
            <div id="workview"></div>
               <div id="wload"></div> 
        </div>
        </div>
        
            		
             
        </div>
      </div>
    </div>
  </div>

<!-- Create Work Location Modal !-->
<div id="addWorkModal" class="modal fade" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Add Level</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="locationInsert" method="POST" autocomplete="off">
       <div class="modal-body" style="font-size:0.8rem">
           
           <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
    
                 
                      <div class="row">
                        
                          <div class="form-group col-sm-6">
                            <label for="name">Level</label>
                            <input type="text" id="level" name="level" class="form-control" />
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="basic">Basic</label>
                            <input type="text" id="basic" name="basic" class="form-control" placeholder="0.0" />
                          </div>
                          </div>
                          
                       <div class="row">
                        
                          <div class="form-group col-sm-6">
                            <label for="housing">Housing</label>
                            <input type="text" id="housing" name="housing" class="form-control" placeholder="0.0" />
                              </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="transport">Transport</label>
                            <input type="text" id="transport" name="transport" class="form-control" placeholder="0.0" />
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="medical">Medical</label>
                            <input type="text" id="medical" name="medical" class="form-control" placeholder="0.0" />
                          </div>
                         </div> 
                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label for="utility">Utility</label>
                            <input type="text" id="utility" name="utility" class="form-control" placeholder="0.0" />
                              </div>
                          <div class="form-group col-sm-6">
                            <label for="entertainment">Entertainment</label>
                            <input type="text" id="entertainment" name="entertainment" class="form-control" placeholder="0.0" />
                          </div>
                          </div>
                        
                          
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0" data-dismiss="modal">Close</button>
      </div>
      </form>
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
   function showWorkLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/joblevel/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#wload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#workview").html(html);
                $('#wload').html(''); 
            }
        });
    }
    
   $(document).ready(function(event) {
        showWorkLocation(4, 1);
        
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
           
            
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
       
    
        
       
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#locationInsert')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/joblevel/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html(''); 
                                  setTimeout(function(){// wait for 5 secs(2)
                                       $(document).ready(function() {
                                        showWorkLocation(100, 1);
                                    }); // then reload the page.(3)
                                  }, 100); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
       
        $('.editstaff_index').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed,
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
  

  