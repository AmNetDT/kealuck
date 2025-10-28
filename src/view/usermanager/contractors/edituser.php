<?php

require_once '../../core/init.php';

$member = $_POST['id'];

$user = new User();
if ($user->isLoggedIn()) {

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
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-md-6">
                       <h3>Update Contractor</h3>     
                  </div>  
                   <div class="col-md-2">
                      
                    </div> 
                </div>
                 
         <?php

            $username = escape($user->data()->id);
           
            $userSyscategory = escape($user->data()->syscategory_id);

            $users = Db::getInstance()->query("SELECT a.*, b.id, b.username FROM contractors a left join users b on a.added_by = b.id WHERE a.id =$member");
            foreach ($users->results() as $use) {
                
            ?>
             <form id="contractorform" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                <div class="col-9">
                                   
                                    </div>
                                <div class="col-3 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member; ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member; ?>">
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
                        <div class="form-group col-sm-8">
                            <label for="name">Contractor</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="name" id="name" rows="3"><?php echo $use->name; ?></textarea>
                         </div>
                     </div>
                           <div class="form-group col-sm-4">
                             <label for="contractor_code">Contractor Code</label>
                         <label class="form-control"><?php echo $use->contractor_code; ?><label/>
                         <input type="hidden" name="contractor_code" value="<?php echo $use->contractor_code; ?>" id="contractor_code"  />
                           </div>
             <div class="form-group col-sm-4">
                <label for="category">Contrator Type</label>
                             <input type="text" name="category" value="<?php echo $use->category; ?>" id="category" class="form-control"  />
              </div>
              <div class="form-group col-sm-4">
                         <label for="bank">Acceptance Date</label>
                         <input type="date" name="acceptance_date" id="acceptance_date" class="form-control" value="<?php echo $use->acceptance_date; ?>" />
                     </div>
                <div class="form-group col-sm-4">
                 <label for="phone">Phone</label>
                         <input type="phone" name="phone" id="phone" class="form-control" value="<?php echo $use->phone; ?>" />
            </div> 
               <div class="form-group col-md-4">
                 <label for="email">Email</label>
                     <input type="text" name="email" value="<?php echo $use->email; ?>" id="email" class="form-control"  />
             </div>
                   <div class="form-group col-md-4">
                <label for="address">Cantact Address</label>
                          <textarea class="form-control" id="address" name="address" rows="3"><?php echo $use->address; ?></textarea>
                    </div>
                     
                     
                 </div>
                 <div class="row">
                    <div class="form-group col-md-4">
                         <label for="bank">Bank</label>
                         <input type="text" name="bank" id="bank" class="form-control" value="<?php echo $use->bank; ?>" />
                     </div>
                    <div class="form-group col-md-4">
                         <label for="bank_nameonaccount">Bank Acct. Title (Name on account)</label>
                         <input type="text" name="bank_nameonaccount" id="bank_nameonaccount" class="form-control" value="<?php echo $use->bank_nameonaccount; ?>"  />
                     </div>
                    <div class="form-group col-md-4">
                         <label for="bank_account">Bank Acct. Number</label>
                         <input type="text" name="bank_account" id="bank_account" class="form-control" value="<?php echo $use->bank_account; ?>"  />
                     </div>
                </div>  
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                 <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>"  />
                 
             </form>
         <?php }
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
   
<script>
    $(document).ready(function(){
     $('.resulter').hide();
     $('.resulterError').hide();
    })
</script>

 
<script>
   $(document).ready(function(event) {
    
     
    	$('.prev_page').click(function (e) {
    	    
		let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/contractors/view.php",
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
          
       
	    $('.current_page').click(function (e) {
		
		var id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/contractors/edituser.php",
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

        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#contractorform')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/usermanager/contractors/update.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $("#loader_httpFeed").hide();
                        },
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
				            $("#loader_httpFeed").hide();
                        }
                    }); 
                
            });
       
   });
   
   </script>

