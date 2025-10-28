<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();
if ($user->isLoggedIn()) {

?>

 
  
  
  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-md-6 offset-md-3">
        <div id="accounttile" class="container">
          
            

            <div class="jumbotron bg-white">
              
                <div class="col-md-12">
                <div class="row justify-content-between">
                    <div class="col-md-9">
                       <h3>Update Users Manager</h3>     
                    </div>
                   <div class="col-md-3">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/usermanager/users/" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                    </div> 
                </div>
                <div class="row mt-0 mb-3 pt-0">
                    <div class="col-md-12 alert alert-success m-0 resulter"></div>
                    <div class="col-md-12 alert alert-warning m-0 resulterError"></div>
                 </div>
         <?php

            $username_id = escape($user->data()->id);
            $departing = escape($user->data()->department_id);
            $userSyscategory = escape($user->data()->syscategory_id);

            $users = Db::getInstance()->query("SELECT 
            a.*, 
            b.location, b.id as location_id, 
            c.id as department_id, c.name as department, 
            d.id as jobtitle_id, d.name as jobtitle,
            CONCAT(e.firstname, ' ', e.lastname) as supervisor, e.id as supervisor_id,
            f.name as syscategory, f.id as syscategory_id
            FROM users a 
            Left Join worklocation b on a.worklocation_id = b.id
            Left Join departments c on a.department_id = c.id
            Left Join job_title d on a.jobtitle_id = d.id
            Left Join staff_record e on a.supervisor_id = e.id
            Left Join syscategory f on a.syscategory_id = f.id
            WHERE a.id = $member_id");
            foreach ($users->results() as $use) {

            ?>
             <form method="POST" autocomplete="off">
                 <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">User Id</div>
                        </div>
                         <input type="text" name="username" value="<?php echo $use->username; ?>" id="username" class="form-control" disabled />
                         </div>
                     </div>
                     </div>
                     <div class="col-md-6">
                           <div class="form-group">
                             <label for="department">Department</label>
                             <select class="form-control" name="department" id="department">
                                <option value="<?php echo $use->department_id; ?>"><?php echo $use->department; ?></option>
                                 <?php
                                    
                                    $department = Db::getInstance()->query("SELECT * FROM `departments` ORDER BY `id` DESC");
                                    foreach ($department->results() as $department) {
        
                                    ?>
                                     <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
                                 <?php
                                    }
                                    ?>
                             </select>
                           </div>
                         </div>
                 </div>
                 <div class="row">
             <div class="form-group col-md-6">
                <label for="supervisor">Supervisor</label>
                <select class="form-control" name="supervisor" id="supervisor">
                        <option value="<?php echo $use->supervisor_id; ?>"><?php echo $use->supervisor; ?></option>
                  <?php
                        $supervisor_id = $use->supervisor_id;
                      
                        $super = Db::getInstance()->query("SELECT CONCAT(firstname, ' ', lastname) AS supervisor, id 
                                            FROM `staff_record` WHERE `id`=$supervisor_id");
                        foreach ($super->results() as $superv) {
                  ?>
                        <option selected value="<?php echo $superv->id; ?>"><?php echo $superv->supervisor; ?></option>
                            
                  <?php
                          }
                    ?>
                </select>
              </div>
              <div class="col-md-6">
                       <div class="form-group">
                         <label for="job_title_id">Job Title</label>
                         <select class="form-control" name="job_title_id" id="job_title_id">
                             <option value="<?php echo $use->jobtitle_id; ?>"><?php echo $use->jobtitle; ?></option>
                             <?php
                                
                                $job_title = Db::getInstance()->query("SELECT * FROM `job_title` ORDER BY `id` DESC");
                                foreach ($job_title->results() as $job_titl) {
    
                                ?>
                                 <option value="<?php echo $job_titl->id; ?>"><?php echo $job_titl->name; ?></option>
                             <?php
                                }
                                ?>
                         </select>
                     </div>
                     </div>
              </div>
                 <div class="row">
                   <div class="form-group col-md-6">
              
                <label for="worklocation">Work Location</label>
                <select class="form-control" id="worklocation">
                 <option value="<?php echo $use->location_id; ?>"><?php echo $use->location; ?></option>
                     <?php
                 
                    $worklocation = Db::getInstance()->query("SELECT * FROM `worklocation` ORDER BY `id` ASC");
                    foreach ($worklocation->results() as $worklocat) {
                  ?>
                      <option value="<?php echo $worklocat->id; ?>"><?php echo $worklocat->location; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
              </div>
                     <div class="col-md-6">
                        <div class="form-group">
                         <label for="syscategory">Privilege</label>
                         <select class="form-control" name="syscategory" id="syscategory">
                            <option value="<?php echo $use->syscategory_id; ?>"><?php echo $use->syscategory; ?></option>
                                 <?php
                              
                                    $Syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` ORDER BY `id` ASC");
                                    foreach ($Syscategory->results() as $Syscategory) {
                                    ?>
                                     <option value="<?php echo $Syscategory->id; ?>"><?php echo $Syscategory->name; ?></option>
                                 <?php
                                    }
                                
                                ?>
                         </select>
                     </div>
                    </div> 
                     
                     
                 </div>
                  
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username_id; ?>" />
                 <input type="hidden" name="user_id" id="user_id" value="<?php echo $member_id; ?>" />
                 <div class="row">
                 <div class="col-md-12" id="submitButton">
                     <button type="button" id="save" class="btn btn-light mb-3">
                         <span class="fa fa-edit"> Update</span>
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
    $(document).ready(function(){
     $('.resulter').hide();
     $('.resulterError').hide();
    })
</script>

   <script>
 $(document).ready(function(event) {
     
     let department_loading_supervisor = $('#department').val();
     if(department_loading_supervisor != ""){
         
	    var id = $(this).find(":selected").val();
		var dataString = 'department_id='+ id;  
		 
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/users/getSupervisor.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
            
                var len = response.length;

                $("#supervisor").empty();
                
                    for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                
                    $("#supervisor").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 
     }
      $("#department").change(function(){  
	    var id = $(this).find(":selected").val();
		var dataString = 'department_id='+ id;  
		 
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/users/getSupervisor.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
            
                var len = response.length;

                $("#supervisor").empty();
                
                    for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                
                    $("#supervisor").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
     
     $("#save").click(function() {

         let id = $('#user_id').val();
         let username = $('#username').val();
         let syscategory = $('#syscategory').val();
         let department = $('#department').val();
         let supervisor = $('#supervisor').val();
         let worklocation = $('#worklocation').val();
         let job_title_id = $('#job_title_id').val();
         let added_by = $('#added_by').val();



         $.ajax({
             url: "view/usermanager/users/update.php",
             method: 'POST',
             data: {
                 
                 id: id,
                 username: username,
                 syscategory: syscategory,
                 department: department,
                 supervisor: supervisor,
                 worklocation: worklocation,
                 job_title_id:job_title_id,
                 added_by: added_by

             },
             success: function (data) {
    					    $('.resulter').html(data);
    					    $('.resulter').show();
    					    $('.resulter').slideDown();
                	   
    					},
    					error: function (){
    					    $('.resulterError').html(data);
    					    $('.resulter').show();
    					    $('.resulterError').slideDown();
    					}
         });

     });
     event.preventDefault();
 });
</script>
<script>
   $(document).ready(function(event) {
       
       
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

