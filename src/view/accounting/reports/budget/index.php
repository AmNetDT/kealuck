<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
?>

  
  <div id="body_general">
    <div class="container-fluid p-0 bg-white">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
        <div id="accounttile" class="container-fluid m-0 bg-white">
            <div class="row m-3 mb-4">
                <h3>Budget </h3>
            </div>
             
              
                <div class="row justify-content-between mt-4 mb-4">
                  
                  <div class="col-sm-9">
                      
                               
                                    </div>
                  <div class="col-sm-3 text-right">
                      <!-- Button trigger modal -->
                      
                    <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" data-toggle="modal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Create Budget</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  
                </div>
                 <?php

                $user = Db::getInstance()->query("SELECT * FROM budget ORDER BY transaction_year DESC");

                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
        
            <div class="table-responsive py-5" style="height:100%">
             
                      <div class="row">
                          <diiv class="col-sm-12 p-2 success_alert editstaff_index"></diiv>
                          <diiv class="col-sm-12 p-2 warning_alert editstaff_index"></diiv>
                      </div>

                    <table id="selectuserabduganiu" class="table-hover table-bordered overflow-auto" style="overflow-x: scroll; height: 120%; width:100%; font-size:0.75em;">
                      <thead>
                         <tr> 
                              <th class="pl-3" style="width:80%;">Description</th>
                              <th class="pl-3" style="width:19%;">Status</th>
                              <th class="pl-3" style="width:2%">&nbsp;</th>
                            </tr>
                      </thead>
                      <tbody>
                      <?php
                        
                            $i = 1;
                            foreach ($user->results() as $user) {
                            $budget_id = $user->id;
                        ?>
                          <tr>
                            <td class="pl-3"><?php echo $user->transaction_year . ' ' .$user->description; ?></td>
                            
                            <?php
                            
                                    if(!empty($user->status) && $user->status === 'Approved'){
                            ?>
                            <td class="text-left pl-3 alert-success"><?php echo $user->status; ?></td>
                            <?php
                            
                                    }else{
                                        
                                    ?>
                            <td class="text-left pl-3 alert-warning"></td>
                            <?php
                                    } 
                                    ?>
                            <td id="<?php echo $user->id; ?>">
                             <div class="modal fade" id="duplicateModal<?php echo $user->id; ?>" tabindex="-1" aria-labelledby="duplicateModal" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Duplicate Budget</h5>
                                                    <button type="button" class="close editstaff_index" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    
                                                    <h3><?php echo $user->transaction_year . ' ' .$user->description; ?></h3>
                                                      
                                                   
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="farm-button-cancel py-1 ml-0 editstaff_index" data-dismiss="modal">Close</button>
                                                    <button type="button" id="<?php echo $user->id; ?>" title="<?php echo $user->description; ?>" class="farm-button py-1 ml-0 _duplicate">Duplicate</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                              <div class="dropdown pt-0">
                                  
                               <button class='btn btn-group dropright' type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu my-0">
                                   <div class="budget_details" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-eye"></i>&nbsp; View</button>

                                    </div>
                                    <?php
                                            $modifieddate = $user->modifieddate;
                                            $substring = substr($modifieddate, 0, 7);
                                            $current_year_month = date('Y-mm');
                                            $current_y_m = substr($current_year_month, 0, 7);
                                            
                                            if($user->transaction_year === date('Y') || $substring === $current_y_m){
                                    ?>
                                    <div class="dropdown-divider"></div>
                                   <div class="budget_update" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-pencil"></i>&nbsp; Edit</button>

                                    </div>
                                    <?php
                                        
                                            }
                                        
                                    ?>
                                    <div class="dropdown-divider"></div>
                                   
                                   <div class="budget_delete" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item py-0 my-0">
                                             <i class="fa fa-trash"></i>&nbsp; Delete</button>

                                    </div>
                                    
                                  </div>
                              </div>

                               
                             
                            </td>
                            <!-- Modal -->

  
                          </tr>
 
                        <?php
                        
                                
                            }
                            
                        ?>

                      </tbody>
                    </table>
                  
              </div>


       <?php
                            }
                    
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
 
 
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Create Budget</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
    <form id="create_budget_form" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
          </div>
        <div class="row">
                     <div class="form-group col-sm-6">
                            <label for="transaction_year">Transaction Year</label>
                                <select id="transaction_year" name="transaction_year" class="form-control farm-button-cancel">
                                    <option value="">--Select Budget Year--</option>
                                    <option value="<?php echo date('Y') + 1; ?>"><?php echo date('Y') + 1; ?></option>
                                <?php
                                
                                 $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                                    foreach($transact_year->results() as $transact_year){
                            
                                ?>
                                
                                    <option value="<?php echo $transact_year->year; ?>"><?php echo $transact_year->year; ?></option>
                                    <?php
                                            }
                                        ?>
                                </select>
                        </div>
                     </div>
        <div class="row">
             <div class="form-group col-sm-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
              
              
            </div>
            
            <input type="hidden" id="added_by" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
      </div>
       </form>
       
    </div>
  </div>
</div>
  
  
   
  <script>
   $(document).ready(function(event) {
       
       $('.success_alert').hide();
       $('.warning_alert').hide();
       
       
    $('.SaveStaff').on('click', function(){
            
            let form = $('#create_budget_form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/accounting/reports/budget/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $('#load').html(''); 
                              setTimeout(function(){// wait for 5 secs(2)
                                  $(document).ready(function() {
                                    showUsers(10, 1);
                                }); // then reload the page.(3)
                              }, 100); 
                              
                        },
                        error:function(data){
                            
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            
                        }

             });

        });
    
    $('._duplicate').on('click', function(){
            
            let ids = $(this).attr('id'); // You need to use standard javascript object here
            let description = $(this).attr('title');; 
            
            //  alert(ids);
            //  alert(description);
            
             $.ajax({
                 
                        url: 'view/accounting/reports/budget/insert-duplicate.php',
        				type: 'POST',
    			       	data: {
        				    
        				    ids : ids,
        				    description : description
        				    
        				},
                        success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $('#selectuserabduganiu').ajax.reload();
                              setTimeout(function(){// wait for 5 secs(2)
                                  $(document).ready(function() {
                                    showUsers(10, 1);
                                }); // then reload the page.(3)
                              }, 100); 
                              
                        },
                        error:function(data){
                            
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            
                        }

             });

        });  
     
	$('.prev_page').on('click', function (e) {
	
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/accounting/reports/",
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
          
    $('.editstaff_index').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/accounting/reports/budget/",  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	}); 
	
	$('.budget_details').click(function (e) {
        		
        		let member_id = $(this).attr('id');
                //alert(id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			cache: false, type: 'post', async: true,
        			url: "view/accounting/reports/budget/editorder.php",
        			data:{
        			    'member_id':member_id
        			},
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
        		e.preventDefault();
        	});  
        	
    $('.budget_update').click(function (e) {
        		
        		let member_id = $(this).attr('id');
                //alert(id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/accounting/reports/budget/editbudget.php",
        			data:{
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
        	
    
    $('.budget_delete').click(function (e) {
        		
        	  
        		let budget_id = $(this).attr('id');
                
                //alert(budget_id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/accounting/reports/budget/delete_budget.php",
        			data:{
        			  
        			    budget_id : budget_id
        			    
        			},
        			cache: false,
        			success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				           
                        },
                        error:function(data){
                            
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            
                        }
        		});
        		e.preventDefault();
        	});  
 	
   
   event.preventDefault();
   });
    
   
   
  </script>
  

