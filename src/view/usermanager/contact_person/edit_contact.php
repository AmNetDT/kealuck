<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

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
             <?php

            $username_id = escape($user->data()->id);
            $departing = escape($user->data()->department_id);
            $userSyscategory = escape($user->data()->syscategory_id);

            $users = Db::getInstance()->query("SELECT *
            FROM contact_person
            WHERE id = $member_id");
            foreach ($users->results() as $use) {
                
                              $customer_code = $use->contact_code;
            ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-md-6">
                       <h3>Update Contact: <?php echo $customer_code; ?></h3>     
                  </div>  
                   <div class="col-md-2">
                      
                    </div> 
                </div>
                 
             <form id="uploadForm" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/usermanager/contact_person" id="<?php echo $member_id ?>">
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
                        <div class="form-group col-md-12">
                            <label for="contact_person">Contact name</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="contact_person" id="contact_person" rows="3"><?php echo $use->contact_person; ?></textarea>
                           <input type="hidden" name="contact_code" value="<?php echo $customer_code; ?>" id="contact_code"  />
                           <input type="hidden" name="contact_type" value="<?php echo $use->contact_type; ?>" id="contact_type" />
                           <input type="hidden" name="foreign_id" value="<?php echo $use->foreign_id; ?>" id="foreign_id" />
                         </div>
                     </div>
                        
         
            
             
                <div class="form-group col-md-6">
                 <label for="contact_phone">Phone</label>
                         <input type="phone" name="contact_phone" id="contact_phone" class="form-control" value="<?php echo $use->contact_phone; ?>"/>
            </div> 
               <div class="form-group col-md-6">
                 <label for="contact_email">Email</label>
                     <input type="text" name="contact_email" value="<?php echo $use->contact_email; ?>" id="contact_email" class="form-control"  />
             </div>
                   <div class="form-group col-md-6">
                <label for="contact_position">Position</label>
                          <input type="phone" class="form-control" id="contact_position" name="contact_position" rows="3" value="<?php echo $use->contact_position; ?>" />
                    </div>
                     
                     
                   
                </div>  
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username_id; ?>" />
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
			url: ed + "/edit_contact.php",
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
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/usermanager/contact_person/update.php',
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
       
    
       
   });
   
   </script>

