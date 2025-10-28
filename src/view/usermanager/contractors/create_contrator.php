<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>

 <script>
              image.onchange = evt => {
                  const [file] = image.files
                  if (file) {
                    blah.src = URL.createObjectURL(file);
                    
                }
              }  
                
          </script>
  
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4 justify-content-between">
                <div class="col-md-6">
                       <h3>Create Contractor</h3>     
                  </div>  
                   <div class="col-md-2">
                      
                    </div> 
                </div>
                 
         <?php

            $username_id = escape($user->data()->id);
          
            $userSyscategory = escape($user->data()->syscategory_id);
            ?>
             <form id="create_contrator" method="post" enctype="multipart/form-data">
                 
                 
                 <div class="row justify-content-end mb-3"> 
                    <div class="col-9">
                        
                        </div>
                    <div class="col-3 mx-0 px-0">
                          <button class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                            <span class="fa fa-chevron-left"></span>
                          </button> 
                          <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                            <span class="fa fa-save"> Save</span>
                          </button>
                          <button class="farm-button-icon-button py-1 ml-0 current_page" id="#">
                            <span class="fa fa-refresh"></span>
                          </button>
                         
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-12">
                     <div class="success_alert"></div>
                     <div class="warning_alert"></div>
                 </div>
              </div>
                 <div class="row">
                    <div class="form-group col-md-8">
                     <label for="name">Contractor</label>
                     <div class="input-group mb-2">
                     <div class="input-group-prepend">
                      <div class="input-group-text">Description</div>
                    </div>
                      <textarea class="form-control" name="name" id="name" rows="3"></textarea>
                     </div>
                 </div>
            <div class="form-group col-sm-4">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="contractor_code">Contractor  Code</label>
                <input type="hidden" id="contractor_code" name="contractor_code" value="CON<?php echo $Rahma; ?>" />
                <label class="bg-light form-control">CON<?php echo $Rahma; ?></label>
              </div>
             <div class="form-group col-md-4">
                <label for="category">Contractor Type</label>
                             <input type="text" name="category" value="" id="category" class="form-control"  />
              </div>
              <div class="form-group col-md-4">
                         <label for="bank">Acceptance Date</label>
                         <input type="date" name="acceptance_date" id="acceptance_date" class="form-control" value="" />
                     </div>
                <div class="form-group col-md-4">
                 <label for="phone">Phone</label>
                         <input type="phone" name="phone" id="phone" class="form-control" value=""/>
            </div> 
               <div class="form-group col-md-4">
                 <label for="email">Email</label>
                     <input type="text" name="email" value="" id="email" class="form-control"  />
             </div>
                   <div class="form-group col-md-4">
                <label for="address">Cantact Address</label>
                          <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                     
                     
                 </div>
                 <div class="row">
                    <div class="form-group col-md-4">
                         <label for="bank">Bank</label>
                         <input type="text" name="bank" id="bank" class="form-control" value="" />
                     </div>
                    <div class="form-group col-md-4">
                         <label for="bank_nameonaccount">Bank Acct. Title (Name on account)</label>
                         <input type="text" name="bank_nameonaccount" id="bank_nameonaccount" class="form-control" value=""  />
                     </div>
                    <div class="form-group col-md-4">
                         <label for="bank_account">Bank Acct. Number</label>
                         <input type="text" name="bank_account" id="bank_account" class="form-control" value=""  />
                     </div>
                </div>  
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username_id; ?>" />
                 
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
   $(document).ready(function(event) {
    
     
    $('.prev_page').click(function (e) {
		
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/contractors/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
          
           
    	$('.current_page').click(function (e) {
    	
    		var member_id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/usermanager/contractors/create_contrator.php",
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
 
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#create_contrator')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
                    
                    $.ajax({
        				url: 'view/usermanager/contractors/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#sload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
                
                
                
            });
       
       
   });
   
   </script>

