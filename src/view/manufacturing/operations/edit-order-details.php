<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$member_id = $_POST['member_id'];
$username = escape($user->data()->id);
             
             
?>

  
       
  
  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-sm-6 offset-md-3">
        <div id="accounttile" class="container">
          
            

            <div class="jumbotron bg-white">
              
                <div class="col-sm-12">
                <div class="row justify-content-between">
                    <div class="col-sm-9">
                        <h3><i class="fa fa-edit p-1" aria-hidden="true"></i> Update Work Order</h3>
                        </div>
                        <div class="col-sm-3">
                              <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>">
                                <span class="fa fa-chevron-left"></span> 
                              </button>
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                   <div class="row mt-0 mb-3 pt-0">
                     
                        <div class="col-sm-12 p-0 m-0 success_alert" id="success_alert"></div>
                        <div class="col-sm-12 p-0 m-0 warning_alert" id="warning_alert"></div>
                    
                  </div> 
                  <div class="row my-5">
                <?php
 

                        $users = Db::getInstance()->query("SELECT a.*, b.username, concat(d.firstname, ' ', d.lastname) as registered, 
                        a.wo_code, c.location as inputs_warehouse, e.location as output_warehouse, d.image
                        FROM workorders a 
                        left join worklocation c on a.inputs_warehouse_id = c.id 
                        left join worklocation e on a.output_warehouse_id = e.id
                        Left join users b on a.added_by = b.id 
                        Left Join staff_record d on b.username = d.user_id 
                        WHERE a.id =  $member_id");
                              
                        foreach ($users->results() as $use) {
                            
                        ?>
                       
                     <form id="Update-order-details-form" method="post">
                      <div class="modal-body">
                        <div class="row">
                             
                              <div class="form-group col-sm-6">
                                <label for="purchase_code">Work Order Code: <?php echo $use->wo_code; ?></label>
                                <input type="text" id="wo_code" name="wo_code" class="form-control" value="<?php echo $use->wo_code; ?>" class="form-control" readonly />
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label for="date_time">Date &amp; Time</label>
                                <input type="datetime-local" id="date_time" name="date_time" class="form-control" value="<?php echo $use->date_time; ?>" />
                                <div class="invalid-feedback fetcheddate_time">
                                        Please, provide a Date & Time.
                                      </div>
                              </div> 
                            </div>  
                            <div class="row"> 
                              <div class="form-group col-sm-6">
                              
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"><?php echo $use->description; ?></textarea>
                                <div class="invalid-feedback fetcheddescription">
                                        Order Description is needed.
                                      </div>
                              </div>
                              <div class="form-group col-sm-6">
                              
                                    <p>Operation Type</p>
                                    <div class="col-sm-12 ml-0 pl-0 mb-0">
                                      <div class="form-group mb-1 pb-0">
                                        <input class="form-control operationtype" type="radio" name="operationtype" id="gridRadios1" value="Internal" checked />
                                        <label for="gridRadios1" style="font-size: 0.85em;">
                                          Internal - Work Order
                                        </label>
                                      </div>
                                      <div class="form-group mb-1 pb-0">
                                        <input class="form-control operationtype" type="radio" name="operationtype" id="gridRadios2" value="External" />
                                        <label for="gridRadios2" style="font-size: 0.85em;">
                                          External - Work Order
                                        </label>
                                      </div>
                                    </div>
                              </div>  
                            </div>
                            <div class="row"> 
                              <div class="form-group col-sm-6">
                                  <label for="priority">Priority</label>
                                <select class="form-control" id="priority" name="priority">
                                    <option value="<?php echo $use->priority; ?>"><?php echo $use->priority; ?></option>
                                    <option value="Normal">Normal</option>
                                    <option value="High">High</option>
                                    <option value="Urgent">Urgent</option>
                                </select>
                              </div>
                              <div class="form-group col-sm-6">
                              
                                <label for="deadline">Deadline</label>
                                <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="<?php echo $use->deadline; ?>" />
                                <div class="invalid-feedback fetcheddeadline">
                                        Please, provide a Deadline.
                                      </div>
                             
                              </div>
                              </div>
                            <div class="row">  
                              <div class="form-group col-sm-12">
                              
                                <label for="remark">Remark</label>
                                <textarea class="form-control" id="remark" name="remark"><?php echo $use->remark; ?></textarea>
                                
                              </div>
                            </div>
                            
                            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" /> 
                            <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>" />
                           
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="farm-button py-1 ml-0 Update-order-details">
                                                        <span class="fa fa-save"> Save</span>
                                                      </button>
                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 prev_page">Cancel</button>
                      </div>
                       </form>
                  
                  <?php
                  
                        } 
                  
                  ?>
                  </div>
                  
            </div>
          </div>
        </div>
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
   $(document).ready(function(event) {
       
       
       	$('.prev_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/",
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
        
       
      
         
 	    $('.Update-order-details').on('click', function(){
            
            let date_time = $('#date_time').val()
            let description = $('#description').val();
            let operationtype =  $('input[name="operationtype"]:checked').val();
            let deadline = $('#deadline').val();
            
            //alert(inputs_warehouse);
            
            if(date_time===''){
            
                $('.fetcheddate_time').show();
                
            }else if(deadline===''){
                
                $('.fetcheddeadline').show();
                
            }else if(description===''){
                
                $('.fetcheddescription').show();
                
            }else{
                
            let form = $('#Update-order-details-form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/manufacturing/operations/update.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $('#load').html(''); 
                                  $(document).ready(function() {
                                    showUsers(10, 1);
                                }); // then reload the page.(3)
                           
                              
                        },
                        error:function(data){
                            
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            
                        }

             });
                
            }
        });
        
             
   
   event.preventDefault();
   });
  </script>
  



