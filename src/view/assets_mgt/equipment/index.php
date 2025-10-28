<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);


 $username = escape($user->data()->id);
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
          <h3>Equipment</h3>
          </div>
          <div class="row my-3">
            <div class="container">
                <div class="row justify-content-between mt-4 mb-3">
                  
                  <div class="col-sm-9">
                      
                                    </div>
                  
                  
                    <div class="col-sm-3 text-right">
                      
                      <!-- Button trigger modal -->
                      <?php
                      
        
                         if ($userSyscategory == 1 || $userSyscategory == 2) {
                     
                      
                      ?>
                      <button class="farm-button py-1 ml-0" data-toggle="modal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Add Equipment</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                      <?php
                      
                         }else{
                      
                      ?>
                      <button class="farm-button-icon-button py-1 px-3 ml-0 editstaff_index" id="#">
                        Refresh <span class="fa fa-refresh"></span>
                      </button>
                      <?php
                        
                         }
                        
                      ?>
                  </div>
                  </div>
              
                  

                </div>
                
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Equipment</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
    <form id="equipment_form" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 alert alert-warning warning_alert"></diiv>
          </div>
          <div class="row">
             
              <div class="form-group col-sm-4">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="purchase_code">Equipment Code</label>
                <input type="text" id="equipment_code" 
                name="equipment_code" class="form-control" value="EQ<?php echo $Rahma; ?>" class="form-control" readonly />
              </div>
              <div class="form-group col-sm-4">
              
                <label for="date_aquired">Date Aquired</label>
                <input type="date" id="date_aquired" name="date_aquired" class="form-control" />
                
              </div>
              <div class="form-group col-sm-4">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" />
                </div>
            </div>
         
            <div class="row"> 
              <div class="form-group col-sm-4">
              
                <label for="type">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="">-- Choose --</option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM equipmenttype");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->title; ?>"><?php echo $usr->title; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
              <div class="form-group col-sm-4">
              
                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand" class="form-control" placeholder="Toyota, Caterpillar" />
                
              </div>
              <div class="form-group col-sm-4">
              
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model (eg. 2022)" />
                
             
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-4">
              
                <label for="plate_number">ID/Plate Number</label>
                <input type="text" class="form-control" id="plate_number" name="plate_number" />
                
              </div>  
              <div class="form-group col-sm-4">
                <label for="serial_number">Serial Number</label>
                <input type="text" class="form-control" id="serial_number" name="serial_number" />
                
              </div>
              <div class="form-group col-sm-4">
              
                <label for="engine">Engine</label>
                <input type="text" class="form-control" id="engine" name="engine" />
                
              </div>  
            </div>
            <div class="row">
              <div class="form-group col-sm-4">
                <label for="transmission">Transmission</label>
                <input type="text" class="form-control" id="transmission" name="transmission" />
                
              </div>
              
              <div class="form-group col-sm-4">
              
                <label for="track_usage">Track Usage</label>
                <select class="form-control" id="track_usage" name="track_usage">
                    <option value="">-- Choose --</option>
                    <option value="Hour">Hour</option>
                    <option value="Miles">Miles</option>
                    <option value="Kilometers">Kilometers</option>
                </select>
              </div>  
              <div class="form-group col-sm-4">
                <label for="leased_or_purchased">Acquire Type</label>
                <select class="form-control" id="leased_or_purchased" name="leased_or_purchased">
                    <option value="">-- Choose --</option>
                    <option value="Purchased">Purchased</option>
                    <option value="Lease">Lease</option>
                </select>
              </div>
            </div>
            <div class="row">   
              <div class="form-group col-sm-6">
              <label for="link_to_service_manual">Link To Service Manual</label>
              <div class="input-group-prepend">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">https://</span>
                  </div>
                  <input type="text" class="form-control" id="link_to_service_manual" name="link_to_service_manual" aria-describedby="basic-addon3">
                </div>
            </div>
              
              <div class="form-group col-sm-6">
              
                <label for="type">Supplier</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                    <option value="">-- Choose --</option>
                    <?php
                    
                             $user = Db::getInstance()->query("SELECT * FROM suppliers WHERE category ='Equipment & Tools'");

                              if (!$user->count()) {
                                echo "<option value=''>No data to be displayed</option>";
                              } else {
                                foreach ($user->results() as $usr) {
                    ?>
                    <option value="<?php echo $usr->id; ?>"><?php echo $usr->supplier_code . ',  '. $usr->name ; ?></option>
                    <?php
                    
                                }
                              }    
                    
                    ?>
                </select>
                
              </div>
            </div>
            <div class="row">  
              <div class="form-group col-sm-12">
              
                <label for="additional_info">Additional Info</label>
                <textarea class="form-control" id="additional_info" name="additional_info"></textarea>
                
              </div>
            </div>
            
            
             
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
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
   $(document).ready(function(evt) {
       $('.success_alert').hide();
       $('.warning_alert').hide();
       
       
        $('.SaveStaff').on('click', function(){
            
            let form = $('#equipment_form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/assets_mgt/equipment/insert.php',
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
   evt.preventDefault();
   });
       
   
  
  </script>
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/assets_mgt/equipment/select.php",
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
       
      
    $("#supplier_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'supplier_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/assets_mgt/equipment/getsupplier.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                //$("#product_id").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let name = response[i]['name'];
                    
                  
                   $('#supplier').val(name);
                    //alert(description);
                
                }
				 	 
			} 
		});
 	}) 
       
 	
    	$('.editstaff_index').click(function (e) {
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/assets_mgt/equipment/",  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
 
   
   event.preventDefault();
   });
  </script>
  

