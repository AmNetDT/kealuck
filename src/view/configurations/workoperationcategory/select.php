<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
?>



<div class="table-responsive data-font" style="height:100%;">
     
                <?php



                  $user = Db::getInstance()->query("SELECT * FROM workoperation_description ORDER BY id DESC");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="abdg" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th>S/No</th>
                          <th style="width:10%; ">Code</th>
                          <th style="width:60%; ">Description</td>
                          <th style="width:15%; ">No. of Workers</td>
                          <th style="width:15%; ">Cost Per Hour</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$i = 1;
                        foreach ($user->results() as $user) {

                        ?>
 
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $user->wop_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->no_of_workers; ?></td>
                            <td><?php echo $user->cost_per_hour; ?></td>
                            <td>
                                <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="edit_view" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit</button>
                                    </div>
                                  <form id="delrow" method="post">
                                      <input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>" />
                                      <input type="hidden" name="name" id="name" value="<?php echo $user->wop_code; ?>" />
                                      <button type="button" class="dropdown-item singledelete">
                                             <i class="fa fa-trash"></i>&nbsp; Delete</button>
                                  </form>
                                  </div>

                                </div>
                              </div>
                                </td>
                            
                            <!-- Modal -->

  
                          </tr>

 
                        <?php
                        $i++;
                        }
                        ?>

                      </tbody>
                    </table>
                  <?php
                  }
                 
                ?>
            </div>
          


  <?php
} else {
  $user->logout();
  Redirect::to('../../login/');
}


  ?>
   
	 <script>
	      $(document).ready(function(){
 
    	$('.edit_view').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/workoperationcategory/editview.php",
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

       //singledelete
	    
             $('.singledelete').on('click', function(){
       
                let form = $('#delrow')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/workoperationcategory/delete.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html('');  
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
	});
	 </script>