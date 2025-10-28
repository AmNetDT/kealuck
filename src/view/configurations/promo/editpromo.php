<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);     

?>

  
  
  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-sm-9 offset-md-1">
        <div id="accounttile" class="container">
          <?php
                  
                    $users = Db::getInstance()->query("SELECT a.*, concat(d.firstname,' ',d.lastname) as added_by
                    FROM promo a
                    Left Join users c on a.added_by = c.id
                    Left Join staff_record d on c.username = d.user_id
                    WHERE a.id = $member_id");
                    foreach ($users->results() as $stockQ) {
                
                 
                   $sku_code = $stockQ->voucher_code;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Voucher: <?php echo $sku_code; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations/promo/" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/configurations/promo" id="<?php echo $member_id ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
            </div>
        </div>
                    <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 alert alert-success m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 alert alert-warning m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
        
              <div class="row">
                <div class="col-sm-12">          
                 <form method="POST" autocomplete="off">
                     
              
              <?php $abdusalam = mt_rand(1000,9999); ?>
              
              <div class="row">
                <div class="col-sm-12">
                    
                 
                  
                 
                    <div class="row">
                      <div class="form-group col-sm-12">
                            <label for="description">Stock Unit</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="description" id="description" rows="3"><?php echo $stockQ->description; ?></textarea>
                           <input type="hidden" name="sku_code" value="<?php echo $sku_code; ?>" id="sku_code"  />
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
                          <option value="<?php echo $stockQ->wholesale; ?>"><?php echo $stockQ->wholesale; ?></option>
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
                          <option value='<?php echo $stockQ->status; ?>'><?php echo $stockQ->status; ?></option>
                          <option value="Input">Active</option>
                          <option value="Output">Inactive</option>
                        </select>
                      </div>
                         <div class="form-group col-sm-4">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" value="<?php echo $stockQ->amount; ?>" placeholder="0" />
                         </div>
                      
                      <div class="form-group col-sm-4">
                        <label for="valid_until">Valid Until</label>
                        <input type="date" id="valid_until" name="valid_until" value="<?php echo $stockQ->valid_until; ?>" class="form-control" placeholder="Valid Until" />
                         </div>
                      
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="note">Note</label>
                          <textarea class="form-control" name="note" id="note" rows="3"><?php echo $stockQ->note; ?></textarea>
                     </div>
                    </div>
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    <input type="hidden" id="id" name="id" value="<?php echo $member_id; ?>" />
                    
                
                
                
              </div>
            </div>
          
                
                </form>
              </div>
            </div>
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


<!-- Create Dept Modal !-->
  
<script>
    $(document).ready(function(event){
        $('.success_alert').hide();
        $('.warning_alert').hide();
   
       
        $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/promo/update.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
       
         
       
    	$('.current_page').click(function (e) {
    		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    	
    		//Pssing values to nextPage 
    		let rsData = "eQvmTfgfru";
    		let dataString = "rsData=" + rsData;
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/editpromo.php",
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

   
   event.preventDefault();
     });
	</script>
	<script>
   $(document).ready(function(event) {
       
       
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
       
   });
   
   </script>