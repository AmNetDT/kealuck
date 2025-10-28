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
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Tax</h3>
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
                        <span class="fa fa-plus">Add Tax</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/configurations/tax">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              </div>
              
          <div class="row">
              <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
              <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
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
        <h6 class="modal-title">Add Tax</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="Inserttax" method="POST" autocomplete="off">
       <div class="modal-body" style="font-size:0.8rem">
           
           <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
    
                 
                     
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
                           <input type="text" id="rebate" name="rebate" value="<?php echo $stockQ->rebate; ?>" class="form-control" placeholder="0.0%" />
                         </div>
                      <div class="form-group col-sm-8">
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
            url: "view/configurations/tax/select.php",
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
        
           
            
         	$('.edituser_view').click(function () {
    		
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
    	});   
       
    
        
       
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#Inserttax')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/tax/insert.php',
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
       
        $('.editstaff_index').click(function () {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(id);
		
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
	});  
 
   
   event.preventDefault();
   });
  </script>
  

  