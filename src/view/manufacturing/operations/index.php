<?php

require_once '../../core/init.php';

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
      <div class="jumbotron pt-5 bg-white">
            <div class="row m-3 mb-4">
          <h3>Work Orders</h3>
          </div>
              <?php
              $username = escape($user->data()->id);
              ?>
             
                <div class="row justify-content-between mt-3 mb-5">
                  
                    <div class="col-sm-9">
                                 
                      <form>
                              <label class="mr-2">Sort by transaction year</label>
                              <select id="inputTransaction_year" name="inputTransaction_year" class="farm-button-cancel py-1 pl-4 mt-2">
                                   <?php

                                      $transaction_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                    
                                      if (!$transaction_year->count()) {
                                       ?>
                                       <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                                       <?php
                                      } else {
                    
                                        foreach($transaction_year->results() as $year){
                                            
                                    ?> 
                                <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                                    <?php
                                        
                                        }
                                      }  
                                    ?>
                              </select>
                          </form>
                          
                                    
                                    </div>
                   
                    <div class="col-sm-3 text-right">
                      <!-- Button trigger modal -->
                      <button class="farm-button py-1 ml-0" data-toggle="modal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Add Work Order</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  
                  </div>
               
                  
              <div class="row">
                  <diiv class="col-sm-12 p-2 success_alert"></diiv>
                  <diiv class="col-sm-12 p-2 warning_alert"></diiv>
                </div>  
              <div id="userr"></div>
               <div id="load"></div>
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
            <p class="modal-title" id="staticBackdropLabel">Add Work Order</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
    <form id="work_order_form" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-sm-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="purchase_code">Work Order Code</label>
                <input type="text" id="wo_code" name="wo_code" class="form-control" value="WO<?php echo $Rahma; ?>" class="form-control" readonly />
              </div>
              <div class="form-group col-sm-6">
              
                <label for="date_time">Date &amp; Time</label>
                <input type="datetime-local" id="date_time" name="date_time" class="form-control" />
                <div class="invalid-feedback fetcheddate_time">
                        Please, provide a Date & Time.
                      </div>
              </div>
            </div>
           <div class="row"> 
              <div class="form-group col-sm-6">
              
                <label for="inputs_warehouse_location_type">Location Type (Input)</label>
                <select class="form-control" id="inputs_warehouse_location_type" name="inputs_warehouse_location_type">
                    <option value="">-- Choose --</option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM worklocation_type");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->id; ?>"><?php echo $usr->description; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              <div class="form-group col-sm-6">
              
                 <label for="output_warehouse_location_type">Location Type (Output)</label>
                <select class="form-control" id="output_warehouse_location_type" name="output_warehouse_location_type">
                    <option value="">-- Choose --</option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM worklocation_type");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->id; ?>"><?php echo $usr->description; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              
            </div>
            <div class="row"> 
              <div class="form-group col-sm-6">
              
                <label for="inputs_warehouse">Input Items Warehouse</label>
                <select class="form-control" id="inputs_warehouse" name="inputs_warehouse">
                </select>
                <div class="invalid-feedback fetchedinputs_warehouse">
                        Please, select an Input Items Warehouse.
                      </div>
              </div>
              <div class="form-group col-sm-6">
              
                <label for="output_warehouse">Output Items Warehouse</label>
                <select class="form-control" id="output_warehouse" name="output_warehouse">
                </select>
                <div class="invalid-feedback fetchedoutput_warehouse">
                        Please, select an Output Items Warehouse.
                      </div>
              </div>
              <div class="form-group col-sm-6">
              
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
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
                    <option value="">--Choose--</option>
                    <option value="Normal">Normal</option>
                    <option value="High">High</option>
                    <option value="Urgent">Urgent</option>
                </select>
              </div>
              <div class="form-group col-sm-6">
              
                <label for="deadline">Deadline</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" />
                <div class="invalid-feedback fetcheddeadline">
                        Please, provide a Deadline.
                      </div>
             
              </div>
              </div>
            <div class="row">  
              <div class="form-group col-sm-12">
              
                <label for="remark">Remark</label>
                <textarea class="form-control" id="remark" name="remark"></textarea>
                
              </div>
            </div>
            
             
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           <input type="hidden" name="status" id="status" value="Initiated" />
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0" data-dismiss="modal">Close</button>
      </div>
       </form>
       
    </div>
  </div>
</div>
  
  
  <script>
   $(document).ready(function(evt) {
       
       $('.success_alert').hide();
       $('.warning_alert').hide();
       $('.fetcheddate_time').hide();
       $('.fetchedoutput_warehouse').hide();
       $('.fetchedoutput_warehouse').hide();
       $('.fetcheddescription').hide();
       $('.fetcheddeadline').hide();
       
       $('.SaveStaff').on('click', function(){
            
            let date_time = $('#date_time').val();
            let inputs_warehouse = $('#inputs_warehouse').val();
            let output_warehouse = $('#output_warehouse').val();
            let description = $('#description').val();
            let operationtype =  $('input[name="operationtype"]:checked').val();
            let deadline = $('#deadline').val();
            
            //alert(inputs_warehouse);
            
            if(date_time===''){
            
                $('.fetcheddate_time').show();
                
            }else if(deadline===''){
                
                $('.fetcheddeadline').show();
                
            }else if(inputs_warehouse===''){
                
                $('.fetchedinputs_warehouse').show();
                
            }else if(output_warehouse===''){
                
                $('.fetchedoutput_warehouse').show();
                
            }else if(description===''){
                
                $('.fetcheddescription').show(); 
                
            }else{
                
            let form = $('#work_order_form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/manufacturing/operations/insert.php',
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
   evt.preventDefault();
   });
       
   
  
  </script>
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/manufacturing/operations/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showUsers(10, 1);
    });
 </script>
   
  <script>
   $(document).ready(function(event) {
       
      
    $("#inputs_warehouse_location_type").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'inputs_warehouse_location_type='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/manufacturing/operations/getinput.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
			success:function(response){
                
                let len = response.length;

                $("#inputs_warehouse").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let id = response[i]['id'];
                    let location = response[i]['location'];
                    
                  
                    //alert(location);
                 
                    $('#inputs_warehouse').append($('<option>', {
                            value: id,
                            text: location
                     }));
                  
                
                }
				 	
			} 
		});
 	}) 
       
 	$("#output_warehouse_location_type").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'output_warehouse_location_type='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/manufacturing/operations/getoutput.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
			success:function(response){
                
                let len = response.length;

                $("#output_warehouse").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let id = response[i]['id'];
                    let location = response[i]['location'];
                    
                  
                    //alert(location);
                 
                    $('#output_warehouse').append($('<option>', {
                            value: id,
                            text: location
                     }));
                  
                
                }
				 	
			} 
		});
 	}) 
 	
 	$('.current').click(function (e) {
		
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/manufacturing/operations',  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
 
    
	
    $('#inputTransaction_year').change(function(evt){ 
                
        let id = $(this).find(":selected").val(); 
	    
        let transaction_year = $('#inputTransaction_year').val(); 
	
        	//alert('welcome')

        $.ajax({
            type: "GET",
            url: "view/manufacturing/operations/select.php",
           
			data: {
			    
			    transaction_year : transaction_year
			},
            cache: false,
    		beforeSend: function() {
    		    
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
        
        
         evt.preventDefault();
        
      
      });
 
   
    
   event.preventDefault();
   });
  </script>
  

