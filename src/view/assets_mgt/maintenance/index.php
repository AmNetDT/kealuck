 <?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();


   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
   
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory_id);
    
    
?>


  <form>
      <input type="hidden" value="<?php echo $transact_; ?>" id="trans">
      <input type="hidden" value="<?php echo $member_id; ?>" id="member_id">
  </form>
    
   <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
          <h3>Maintenance</h3>
          </div>
              
                <div class="row justify-content-end">
                    <div class="col-sm-10">
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
                              <input type="hidden" value="<?php echo $transact_; ?>" id="trans">
                              <input type="hidden" value="<?php echo $member_id; ?>" id="member_id">
                          </form>
                    </div>
                    <div class="col-sm-2">
                      <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                            <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal">
                        <span class="fa fa-plus"> Add New</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" id="<?php echo $member_id; ?>">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                    
                </div>
         
              <div class="col-sm-12 m-0 p-0">
                          <div class="row">
                            <div class="col-sm-12 transactions_click_view">
                              <div class="col-sm-12 success_alert editstaff_index"  id="<?php echo $member_id; ?>"></div>
                              <div class="col-sm-12 warning_alert editstaff_index"  id="<?php echo $member_id; ?>"></div>
                                <div id="userr"></div>
                                <div id="load"></div>
                           
                            </div>
            </div>
          </div>
        </div>
      </div>

  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add New</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
          <form id="maintenance_form" method="post">
        
          <div class="modal-body pt-0">
              <div class="row">
                  
               
              <div class="form-group col-sm-6">
                <label>Maintenance Date</label>
                <input type="date" id="maintenance_date" name="maintenance_date" class="form-control" />
              </div>
              <?php
              
                        if($userSyscategory == 1){
              
              ?>
              <div class="form-group col-sm-6">
              <label class="mr-2">Select Transaction Year</label>
                  <select id="inputTransaction_year" name="inputTransaction_year" class="form-control farm-button-cancel">
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
                 <input type="hidden" name="transaction_year" id="transaction_year" />
                 </div>
                 <?php
                 
                        }else{
                            
                         $transaction_yr = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1"); 
                         foreach($transaction_yr->results() as $transaction_yr){
                             
                             
                         ?> 
                <input type="hidden" name="inputTransaction_year" id="inputTransaction_year" />         
                <input type="hidden" name="transaction_year" id="transaction_year" value="<?php echo $transaction_yr->year; ?>" />
                         
                <?php           
                         }
                        }
                 ?>
              
              <div class="form-group col-sm-12">
                <label for="service_description">Description</label>
                 <textarea class="form-control" id="service_description" name="service_description" rows="3"></textarea>
              </div>
              <div class="form-group col-sm-6">
                <label for="service_performed_by">Service Performed By</label>
                 <input list="browsers" name="service_performed_by" id="service_performed_by" class="form-control">
                    <datalist id="browsers">
                    <?php
            
                         $contractors = Db::getInstance()->query("SELECT * FROM contractors");
                            foreach($contractors->results() as $contractors){
                    
                        ?>
                    <option value="<?php echo $contractors->name .' | ' . $contractors->contractor_code; ?>">
                    <?php
                            }
                        ?>
                </datalist>
              </div>
              <div class="form-group col-sm-6">
                <label for="services_cost">Services Cost</label>
                <input type="text" name="services_cost" id="services_cost" class="form-control" placeholder="0.00" />
              </div>
              
            </div>
          </div>
          <div class="modal-footer">
                <?php $Rahma = mt_rand(100,999); ?>
             <input type="hidden" name="maintenance_code" id="maintenance_code" value="MAI-<?php echo $Rahma; ?>">
             <input type="hidden" id="equipment_id" name="equipment_id" value="<?php echo $member_id; ?>" />
             <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
            <button type="button" class="py-1 px-2 border farm-color mx-0 savemaintenance">Add New</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
          
          </div>
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
           
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
       
       	
        $('.savemaintenance').on('click', function(e){
        
                    let form = $('#maintenance_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
       	        
       	        //alert(formData);
       	        
    			
    			$.ajax({
        				url: 'view/assets_mgt/maintenance/insert.php',
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
                        
       	    e.preventDefault();
    	});

    	$('.editstaff_index').click(function (e) {
		
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/assets_mgt/maintenance/index.php',
			data: {
			    
			    member_id: member_id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
       
        $('.prev_page').click(function (e) {
	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/index.php",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
          
 
    	$('.edituser_view').click(function (e) {
    		
    		var member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/maintenance/editdept.php",
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

          $('.singledelete').on('click', function(e){
                
    	        let del = $(this).attr('lang');
    	        
    	        let confirmation = confirm("Are you sure you want to remove the item?");
    	       
    	       
    	       if (confirmation) { 
    	       
            
             
    	        $.ajax({
    	           	url: 'view/assets_mgt/equipment/maintenance/delete.php',
    			    type: 'POST',
    	            data:{
    	                  'del':del
    	            },
    	            cache: false,
    	            success:function(data){
    	                $(".success_alert").html(data);
                        $(".success_alert").show();
                        $('#sload').html(''); 
    	            }
    	        });
    	        
    	       }
    	        e.preventDefault();
    	    });

              $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val(); 
		    
            let member_id = $('#member_id').val(); 
    		let transact_ = $('#trans').val(); 
	        //	alert(dataString)
	
            $.ajax({
                type: "GET",
                url: "view/assets_mgt/maintenance/select.php",
                //dataType: 'json',
    			data: {
    			    id: id,
    			    member_id: member_id,
    			    transact_: transact_
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
	
    $(document).ready(function(evt){ 
        let member_id = $('#member_id').val(); 
		let transact_ = $('#trans').val(); 
		
		
		//alert(member_id)
	
        $.ajax({
            type: "POST",
            url: "view/assets_mgt/maintenance/select.php",
            //dataType: 'json',
			data: {
			    member_id: member_id,
			    transact_: transact_
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
 </script>
 

  