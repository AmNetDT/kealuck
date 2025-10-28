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
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
          <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Promo Voucher</h3>
            </div>
          <div class="row my-3">
            <div class="container">
            <div class="col-sm-12 mb-5">
                <div class="row justify-content-end">
                    <div class="col-sm-2">
                                        
                                    </div>
                   <div class="col-sm-7">
                      
                      </div>
                      
                  
                    <div class="col-sm-3">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal" data-target="#staticBackdrop">
                        <span class="fa fa-plus"> Add Voucher</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/configurations/promo">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              </div>
              <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
                
                 <div id="promotion"></div>
            		<div id="sload"></div>
            		
             


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


<!-- Create SkU Modal !-->

  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <form id="stockInsert" method="POST" autocomplete="off">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">New Voucher</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
              
              <?php $abdusalam = mt_rand(1000,9999); ?>
              
              <div class="row">
                <div class="col-sm-12">
                    
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 
                    <div class="row">
                      <div class="form-group col-sm-12">
                            <label for="description">Stock Unit</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                          
                         </div>
                     </div>
                      
                     </div>
                    <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="voucher_code">Voucher Code</label>
                        <label class="form-control bg-light">PROM<?php echo $abdusalam; ?></label><input type="hidden" id="voucher_code" name="voucher_code" class="form-control" value="PROM<?php echo $abdusalam; ?>" class="form-control" />
                      </div>
                      <div class="form-group col-sm-8">
                        <label for="wholesale">Wholesale</label>
                        
                        <select class="form-control" id="wholesale" name="wholesale">
                          <option value="">--Select--</option>
                          <option value="Piece">Wholesale/Retail Warehouse</option>
                          <option value="Pack">Manufacturing Warehouse</option>
                          <option value="Piece">Raw Material/Feedstock Warehouse</option>
                          <option value="Pack">Waste Management Warehouse</option>
                          <option value="Piece">Finished Good Warehouse</option>
                        </select>
                     
                      </div>
                     <div class="form-group col-sm-4">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                          <option value=''>--Select--</option>
                          <option value="Input">Active</option>
                          <option value="Output">Inactive</option>
                        </select>
                      </div>
                         <div class="form-group col-sm-4">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" placeholder="0" />
                         </div>
                      
                      <div class="form-group col-sm-4">
                        <label for="valid_until">Valid Until</label>
                        <input type="date" id="valid_until" name="valid_until" class="form-control" placeholder="Valid Until" />
                         </div>
                      
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="note">Note</label>
                          <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                     </div>
                    </div>
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                
                
                
              </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0" data-dismiss="modal">Close</button>
      </div>
        </div>
      </form>
    </div>
  </div>

  <!-- End Create Dept Type Modal !-->
 
  <script>
  	function showPromo(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/promo/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#promotion").html(html);
                $('#sload').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showPromo(10, 1);
    });
    
 </script>
  <script>
   $(document).ready(function(event) {
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#stockInsert')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/promo/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $(document).ready(function() {
                                showPromo(10, 1);
                            });
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
       
       
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
       
      
    
       
    	$('.editstaff_index').click(function (e) {
		
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
		e.preventDefault();
	});   
       
      
    
    
 
   
   event.preventDefault();
   });
  </script>
  

  