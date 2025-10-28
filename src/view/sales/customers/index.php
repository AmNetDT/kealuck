<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

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
          <h3>CRM</h3>
          </div>
          <div class="row my-3">
            
              <div class="col-sm-12">
                <div class="row justify-content-between">
                  
                   <div class="col-sm-9"> 
                      <button class="farm-button py-1 ml-0 editstaff_" lang="view/purchases/quotations" id="#">
                        <span class="fa fa-print"> Quotations</span>
                      </button> 
                      <button class="farm-button py-1 ml-0 editstaff_" lang="view/purchases/presales" id="#">
                        <span class="fa fa-print"> Presales Stage</span>
                      </button>
                      <button class="farm-button-cancel py-1 ml-0 editstaff_" lang="view/sales/tickets" id="#">
                        <span class="fa fa-save"> Tickets Management</span>
                      </button>
                     
                      </div>
                      
                  
                    <div class="col-sm-3">
                      <!-- Button trigger modal -->
                      <button class="farm-button py-1 ml-0" data-toggle="modal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Add Customer</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/sales/customers/" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
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
            <p class="modal-title" id="staticBackdropLabel">Add Customer</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
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
             
              <div class="form-group col-sm-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="customer_code">Customer Code</label>
                <label class="form-control bg-light">CUS<?php echo $Rahma; ?></label><input type="hidden" id="customer_code" name="customer_code" class="form-control" value="CUS<?php echo $Rahma; ?>" class="form-control" />
              </div>
              <div class="form-group col-sm-6">
              
                <label for="name">Customer Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Customer Name" />
                
              </div>
            </div>
           
            <div class="row">
                
              <div class="form-group col-sm-6">
              
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Cell Phone"/>
                
              </div>
              <div class="form-group col-sm-6">
              
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>
                
              </div>
            </div>
            
            <div class="row">
                
              <div class="form-group col-sm-6">
              
                <label for="category">Customer Type</label>
                <select class="form-control" id="category" name="category">
                      <option value=''>--Type--</option>
                      <option value="Retail">Retail</option>
                      <option value="Distributor">Distributor</option>
                      <option value="Internal">Internal</option>
                      <option value="Others">Others</option>
                </select>
                
              </div>
              <div class="form-group col-sm-6">
              
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address"></textarea>
                
              </div>
            </div>
            
             <div class="row">
                
              <div class="form-group col-sm-6">
              
                <label for="state_id">State</label>
                <select class="form-control" id="state_id" name="state_id">
                      <option selected>--State--</option>
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
              <div class="form-group col-sm-6">
              
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
       
       
        $('.SaveStaff').on('click', function(){
            
            let form = $('form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/sales/customers/insert.php',
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
            url: "view/sales/customers/select.php",
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
			url: 'view/sales/customers/getlga.php',
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
 	
    	$('.editstaff_index').click(function () {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed,  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
	});   
 
   
   event.preventDefault();
   });
  </script>
  

