<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

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
             <?php

            $username_id = escape($user->data()->id);
            $departing = escape($user->data()->department_id);
            $userSyscategory = escape($user->data()->syscategory_id);

            $users = Db::getInstance()->query("SELECT a.*, 
            b.id as users_id, b.username, 
            c.id as states_id, c.name as state, 
            d.id as lga_id, d.name as lga  
            FROM 
            customers a 
            left join users b on a.added_by = b.id
            left join states c on a.state_id = c.id
            left join lga d on a.lga_id = d.id
            WHERE a.id = $member_id");
            foreach ($users->results() as $use) {
                
                              $customer_code = $use->customer_code;
            ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-md-6">
                       <h3>Update Customer: <?php echo $customer_code; ?></h3>     
                  </div>  
                   <div class="col-md-2">
                      
                    </div> 
                </div>
                 
        
            
             <form id="uploadForm" method="post" enctype="multipart/form-data">
                 
                 
                             <div class="row justify-content-end mb-3"> 
                                
                                <div class="col-3 mx-0 px-0">
                                      <button class="farm-button-cancel py-1 ml-0 prev_page" lang="view/sales/customers" id="<?php echo $member_id ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
                                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/sales/customers" id="<?php echo $member_id ?>">
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
                        <div class="form-group col-md-9">
                            <label for="name">Customer</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="name" id="name" rows="3"><?php echo $use->name; ?></textarea>
                           <input type="hidden" name="customer_code" value="<?php echo $customer_code; ?>" id="customer_code"  />
                         </div>
                     </div>
                           
             <div class="form-group col-md-3">
                <label for="category">Customer Type</label>
                <select class="form-control" id="category" name="category">
                      <option value='<?php echo $use->category; ?>'><?php echo $use->category; ?></option>
                      <option value="Retail">Retail</option>
                      <option value="Distributor">Distributor</option>
                      <option value="Internal">Internal</option>
                      <option value="Others">Others</option>
                </select>
              </div>
                <div class="form-group col-md-6">
                 <label for="phone">Phone</label>
                         <input type="phone" name="phone" id="phone" class="form-control" value="<?php echo $use->phone; ?>"/>
            </div> 
               <div class="form-group col-md-6">
                 <label for="email">Email</label>
                     <input type="text" name="email" value="<?php echo $use->email; ?>" id="email" class="form-control"  />
             </div>
                   <div class="form-group col-md-6">
                <label for="address">Cantact Address</label>
                          <textarea class="form-control" id="address" name="address" rows="3"><?php echo $use->address; ?></textarea>
                    </div>
                     
                     
                    <div class="form-group col-md-3">
              
                <label for="state_id">State</label>
                <select class="form-control" id="state_id" name="state_id">
                      <option value='<?php echo $use->state_id; ?>'><?php echo $use->state; ?></option>
                      <?php
                 
                    $department = Db::getInstance()->query("SELECT id, name FROM `states` ORDER BY `name` ASC");
                    foreach ($department->results() as $department) {

                  ?>
                      <option value="<?php echo $department->id; ?>" title="<?php echo $department->name; ?>"><?php echo $department->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
                
              </div>
              <div class="form-group col-md-3">
              
                <label for="lga_id">LGA</label>
                <select class="form-control" id="lga_id" name="lga_id">
                      <option value='<?php echo $use->lga_id; ?>'><?php echo $use->lga; ?></option>
                </select>
                
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
    
        	$("#state_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'state_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/sales/customers/getlga.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                $("#lga_id").empty();
                
                    for( let i = 0; i<len; i++){
                    let id = response[i]['id'];
                    let name = response[i]['name'];
                
                    $("#lga_id").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
     
    	$('.prev_page').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/view.php",
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
		
		let ed = $(this).attr('lang');
		let member_id = $(this).attr('id');
	
		//Pssing values to nextPage 
		let rsData = "eQvmTfgfru";
		let dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edituser.php",
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
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/sales/customers/update.php',
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

