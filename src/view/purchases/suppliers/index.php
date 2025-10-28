<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
 $userSyscategory = escape($user->data()->syscategory_id);
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
          <h3>Suppliers</h3>
          </div>
          <div class="row my-3">
            <div class="container">
              <?php
              $username = escape($user->data()->id);
              ?>
              <div class="col-md-12">
                <div class="row justify-content-between">
                  
                  <div class="col-md-2">
                                        
                                    </div>
                   <div class="col-md-7">
                     
                     
                      </div>
                      
                  
                    <div class="col-md-3">
                        <?php
                                if($userSyscategory == 1 || $userSyscategory == 2){
                        
                        ?>
                      <!-- Button trigger modal -->
                      <button class="farm-button py-1 ml-0" data-toggle="modal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Add Supplier</span>
                      </button>
                      <?php
                                }
                      ?>
                      <button class="farm-button-icon-button py-1 ml-0 current" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
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
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Supplier</p>
            <button type="button" class="bg-secondary px-2 border text-white current" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
    <form id="uploadForm" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 alert alert-warning warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-md-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="supplier_code">Supplier Code</label>
                <label class="form-control bg-light">SUP<?php echo $Rahma; ?></label><input type="hidden" id="supplier_code" name="supplier_code" class="form-control" value="SUP<?php echo $Rahma; ?>" class="form-control" />
              </div>
              <div class="form-group col-md-6">
              
                <label for="name">Supplier Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Supplier Name" />
                
              </div>
            </div>
           
            <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Cell Phone"/>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>
                
              </div>
            </div>
            
            <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="category">Supplier Type</label>
                <select class="form-control" id="category" name="category">
                      <option value=''>--Type--</option>
                      <option value="Agro-Proccessing">Agro-Proccessing</option>
                      <option value="Crop Planting">Crop Planting</option>
                      <option value="Livestock">Livestock</option>
                      <option value="Equipment & Tools">Equipment & Tools</option>
                </select>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address"></textarea>
                
              </div>
            </div>
            
             <div class="row">
                
              <div class="form-group col-md-6">
              
                <label for="state_id">State</label>
                <select class="form-control" id="state_id" name="state_id">
                      <option selected>--State--</option>
                      <?php
                 
                    $department = Db::getInstance()->query("SELECT id, name FROM `states` ORDER BY `id` ASC");
                    foreach ($department->results() as $department) {

                  ?>
                      <option value="<?php echo $department->id; ?>" title="<?php echo $department->name; ?>"><?php echo $department->name; ?></option>
                    <?php
                    }
                  
                  ?>
                </select>
                
              </div>
              <div class="form-group col-md-6">
              
                <label for="lga_id">LGA</label>
                <select class="form-control" id="lga_id" name="lga_id">
                      <option value="0" selected>--LGA--</option>
                </select>
                
              </div>
              
            </div>
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current" data-dismiss="modal">Close</button>
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
            
            let form = $('form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/purchases/suppliers/insert.php',
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
            url: "view/purchases/suppliers/select.php",
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
       
       	$("#state_id").change(function(){  
	    var id = $(this).find(":selected").val();
		var dataString = 'state_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/purchases/suppliers/getlga.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                var len = response.length;

                $("#lga_id").empty();
                
                    for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                
                    $("#lga_id").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
 	
    	$('.current').click(function (e) {
		
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/purchases/suppliers/",  
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
  

