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
                        <h3><i class="fa fa-edit p-1" aria-hidden="true"></i> Output Items</h3>
                        </div>
                        <div class="col-sm-3">
                              <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>">
                                <span class="fa fa-chevron-left"></span> 
                              </button>
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                  <div class="row my-5">
                <form id="output_form" method="POST" autocomplete="off">
        <div class="modal-content">
        
          <div class="modal-body p-4">
              <div class="row mt-4">
                     
                        <div class="col-sm-12 p-0 m-0 success_alert" id="success_alert"></div>
                        <div class="col-sm-12 p-0 m-0 warning_alert" id="warning_alert"></div>
                    
                  </div> 
              
              <div class="row">
                <div class="col-sm-12">
                    
                 
                    <div class="row">
                      <div class="form-group col-sm-6">
                            <label for="product_id">Stock name</label>
                            <select class="custom-select" id="product_id" name="product_id">
                                    <option selected>--Select--</option>
                                    <?php
                                      $products = Db::getInstance()->query("SELECT * FROM `products` 
                                      WHERE type = 'output' 
                                      AND product_category='Agro Process'");
                                         if (!$products->count()) {
                                             
                                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                             
                                         }else{
                                           
                                                    foreach ($products->results() as $prod) {
                                             ?>
                                        
                                          <option value="<?php echo $prod->id; ?>"><?php echo $prod->description; ?></option>
                                          <?php
                                                  }
                                                                                     }
                                              ?>
                                        </select>
                            <input type="hidden" id="description" name="description"  />
                     </div>
                      <div class="form-group col-sm-6">
                            <label for="sku_inv_code">Stock Code</label>
                            <input type="text" id="sku_inv_code" name="sku_inv_code" class="form-control" style='font-size:0.80em' readonly />
                          </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-4">
                        <label for="uom">Unit of Measure</label>
                        <input type="text" id="uom" name="uom" class="form-control" readonly />
                      
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="product_type">Product Type</label>
                        <input type="text" id="product_type" name="product_type" class="form-control" readonly />
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="product_category">Product Category</label>
                        <select class="form-control" id="product_category" name="product_category" style='font-size:0.85em' readonly>
                          <option value="Agro-Proccessing">Agro-Proccessing</option>
                        </select>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-5">
                        <label for="selling_price_default">Price <span style="font-size:0.75em">(Default)</span></label>
                        <input type="text" id="selling_price_default" name="selling_price_default" class="form-control" readonly />
                      </div>
                      <div class="form-group col-sm-7">
                        <label for="product_qty">Metric Units.</label>
                        <div class="input-group mb-3">
                        <input type="number" id="product_qty" name="product_qty" class="form-control" placeholder="0"  aria-label="Amount (to the nearest dollar)">
                          <div class="input-group-append">
                            <span class="input-group-text" id="metric_units"></span>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                        
                      <div class="form-group col-sm-2">
                        <label for="currency_id">Currency</label>
                        <div class="input-group mb-3">
                        <input type="hidden" id="currency_id" name="currency_id" class="form-control" >
                        <input type="text" id="currency_sign" name="currency_sign" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group col-sm-10">
                        <label for="total_revenue">Total Revenue </label>
                        <input type="number" id="total_revenue" name="total_revenue" class="form-control" placeholder="0.00" style='font-size:0.85em' readonly />
                        <span style="font-size:0.80em">(Projected)</span>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="additional_info">Additional Info</label>
                          <textarea class="form-control" name="additional_info" id="additional_info" rows="3"></textarea>
                     </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                        <label for="storage_location">Storage Location</label>
                        <select class="form-control" id="storage_location" name="storage_location" style='font-size:0.85em' readonly>
                            <?php
                            $worklocation = Db::getInstance()->query("SELECT * FROM `worklocation`");
                            if (!$worklocation->count()) {
                                             
                                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                             
                                         }else{
                                           
                                                    foreach ($worklocation->results() as $worklocation) {
                                             ?>
                            ?>
                          <option value="<?php echo $worklocation->id; ?>"><?php echo $worklocation->location; ?></option>
                         <?php
                         
                                                    }
                                         }
                         ?>
                        </select>
                      </div>
                    </div>
                    <input type="hidden" id="workorders_id" name="workorders_id" value="<?php echo $member_id; ?>" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                
                
                
              </div>
            </div>
            
          </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaffOutput">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 prev_page" id="<?php echo $member_id; ?>" data-dismiss="modal">Cancel</button>
      </div>
        </div>
      </form>
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
    			url: "view/manufacturing/operations/editorder.php",
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
         
        $("#product_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'product_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/manufacturing/operations/getoutputsku.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                $("#metric_units").empty();
                
                    for( let i = 0; i<len; i++){
                   
                   
                    let sku_inv_code            = response[i]['sku_code']
                    let product_type            = response[i]['product_type']
                    let uom                     = response[i]['uom']
                    let description             = response[i]['description']
                    let selling_price_default   = response[i]['selling_price_default']
                    let metric_units            = response[i]['metric_units']
                    let currency_sign           = response[i]['currency_sign']
                    let currency_id             = response[i]['currency_id']
                  
                  //alert(description)
                  
                   $('#sku_inv_code').val(sku_inv_code);
                   $('#product_type').val(product_type);
                   $('#uom').val(uom);
                   $('#description').val(description);
                   $('#selling_price_default').val(selling_price_default);
                   $('#metric_units').append(metric_units);
                   $('#currency_id').val(currency_id);
                   $('#currency_sign').val(currency_sign);
                   
                  }
    				 	
    			} 
    		});
     	}); 
     	
     	 $("#product_qty").change(function(){  
        	
        	let product_qty             = $('#product_qty').val();
            let selling_price_default   = $('#selling_price_default').val();
        
                if(selling_price_default === ""){
                    
                    // alert("Selling price require")
                    
                }else{
                 		let total_revenue = product_qty * selling_price_default;
                		
                	//	alert(total_revenue);
                	     $('#total_revenue').val(total_revenue);
                }
     	});
        
        $("#selling_price_default").change(function(){  
        	
        	let product_qty             = $('#product_qty').val();
            let selling_price_default   = $('#selling_price_default').val();
        
                if(selling_price_default === ""){
                    
                    alert("Selling price require")
                    
                }else{
                 		let total_revenue = product_qty * selling_price_default;
                		
                	//	alert(total_revenue);
                	     $('#total_revenue').val(total_revenue);
                }
     	});
     	
        $('.SaveStaffOutput').on('click', function(){
            let form = $('#output_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/manufacturing/operations/insert-output.php',
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
        })    
   
   event.preventDefault();
   });
  </script>
  



