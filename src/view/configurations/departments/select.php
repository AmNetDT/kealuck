<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$sqlQuery = Db::getInstance()->query("SELECT a.*, b.username FROM departments a left join users b on a.added_by = b.id");


?>


<div class="table-responsive data-font">
  
                <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                    <thead>
                      <tr>
                        <th width="50">SN</th>
                        <th width="200">Dept Name</th>
                        <th width="250">Dept Address</th>
                        <th width="100">Phone</th>
                        <th width="150">Email</th>
                        <th width="100">Created By</th>
                        <th width="100">Created</th>
                        <th width="50">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>

    

                        <?php 
                    	$i = 1;
                    	foreach ($sqlQuery->results() as $department) { 
                    
                    	?>
                        
                        <tr>
                                              <td><?php echo $i; ?></td>
                                              <td><?php echo $department->name; ?></td>
                                              <td><?php echo $department->address; ?></td>
                                              <td><?php echo $department->phone; ?></td>
                                              <td><?php echo $department->email; ?></td>
                                              <td><?php echo $department->username; ?></td>
                                              <td><?php echo $department->created; ?></td>
                                              <td>
                                                    
                                                    <div class="dropdown">
                                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                      <div class="edituser_view" lang="view/configurations/departments" id="<?php echo $department->id; ?>">
                                                            <button class="dropdown-item">
                                                                 <i class="fa fa-edit"></i>&nbsp; Edit</button>
                                                        </div>
                                                        <?php
                                                            if($department->id != 11){
                                                        ?>
                                                          <a class="dropdown-item singledelete" href="javascript:void(0)" lang="<?php echo $department->id; ?>">
                                                          <i class="fa fa-trash"></i>&nbsp; Delete</a>
                                                       <?php
                                                            }
                                                        ?>
                                                      </div>
                    
                                                    </div>
                                                  
                                                 
                                                </td>
                                              
                                            </tr>
                       
                        <?php
                        $i++; }
                        ?>
                    </tbody>
                </table>
    </div> 

  <?php
}
  
  ?>
 
<script>

     $(document).ready(function(){
 
	  $('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		var member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/editdept.php",
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

    
      $('.singledelete').on('click', function(event){
            
	        let del = $(this).attr('lang');
	        
	        let confirmation = confirm("Are you sure you want to remove the item?");
	       
	       
	       if (confirmation) { 
	       
        
         
	        $.ajax({
	           	url: 'view/configurations/departments/delete.php',
			    type: 'POST',
	            data:{
	                  'del':del
	            },
	            cache: false,
	            success:function(data){
	                
                    $(".success_alert").html(data);
                    $(".success_alert").show();
                    
	            }
	        });
	        
	       }
	        event.preventDefault();
	    });
   
    

	});
        
 </script>
 