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
            <div class="row mb-0">
            <div class="container">
          <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Approval Request</h3>
            </div>
            </div>
          
          <div class="row my-3">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-sm-6">
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
                    <div class="col-sm-6 text-right">
                      <button class="farm-button-cancel py-1 ml-0 index_view" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              <div class="row mt-0 mb-3 pt-0">
                      
                <div class="success_alert" id="success_alert"></div>
                <div class="warning_alert" id="warning_alert"></div>
                
              </div>
                
                <div id="sku"></div>
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
    <div class="modal-dialog modal-lg">
        <form id="stockInsert" method="POST" autocomplete="off">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">New Stock</p>
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
                      <div class="form-group col-sm-8">
                            <label for="description">Stock Unit</label>
                         <div class="input-group mb-2">
                         <div class="input-group-prepend">
                          <div class="input-group-text">Description</div>
                        </div>
                          <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                          
                         </div>
                     </div>
                      <div class="form-group col-sm-4">
                            <label for="sku_code">Stock Code</label>
                            <label class="form-control bg-light">SKU<?php echo $abdusalam; ?></label><input type="hidden" id="sku_code" name="sku_code" class="form-control" value="SKU<?php echo $abdusalam; ?>" class="form-control" />
                          </div>
                     </div>
                    <div class="row">
                      <div class="form-group col-sm-4">
                        <label for="uom">Unit of Measure</label>
                        
                        <select class="form-control" id="uom" name="uom">
                          <option value="">--Select--</option>
                          <option value="Piece">Piece</option>
                          <option value="Pack">Pack</option>
                          <option value="Carton">Carton</option>
                          <option value="Bag">Bag</option>
                          <option value="Weight">Weight</option>
                        </select>
                      
                      </div>
                     <div class="form-group col-sm-4">
                        <label for="uom">Type of Stock</label>
                        <select class="form-control" id="type_of_stock" name="type_of_stock">
                          <option value=''>--Select--</option>
                          <option value="Input">Input</option>
                          <option value="Output">Output</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="product_type">Product Type</label>
                        <select class="form-control" id="product_type" name="product_type">
                          <option value="">--Select--</option>
                          <option value="Product">Product</option>
                          <option value="Service">Service</option>
                          <option value="Fixed Asset">Fixed Asset</option>
                          <option value="Consumption Product">Consumption Product</option>
                          <option value="Variable Product">Variable Product</option>
                        </select>
                      </div>
                      </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="tax_category">Tax Category</label>
                        <select class="form-control" id="tax_category" name="tax_category">
                          <option value="">--Select--</option>
                          <option value="Default">Default</option>
                          <option value="Services">Services</option>
                          <option value="None">None</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="product_category">Product Category</label>
                        <select class="form-control" id="product_category" name="product_category">
                          <option value="">--Select--</option>
                          <option value="Retail">Crop Planting</option>
                          <option value="Distributor">Livestock</option>
                          <option value="Distributor">Agro Process</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="storage_location">Storage Location</label>
                        <select class="form-control" id="storage_location" name="storage_location">
                          <option value="">--Select--</option>
                            <!-- Work Location !-->
                            <?php 
                            
                                     $usslocation = Db::getInstance()->query("SELECT * FROM worklocation");
                                     
                                      if (!$usslocation->count()) {
                                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                      } else {
                                          foreach ($usslocation->results() as $usslocat) {
                            ?>
                          <option value="<?php echo $usslocat->location; ?>"><?php echo $usslocat->location; ?></option>
                          <?php
                     
                        }
                                      }
                        ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="selling_price_default">Selling Price (Default)</label>
                        <input type="text" id="uom" name="selling_price_default"  class="form-control" placeholder="Selling Price Default" />
                      </div>
                      </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label for="selling_price_type">Selling Price (Type)</label>
                        <select class="form-control" id="selling_price_type" name="selling_price_type">
                          <option value="">--Select--</option>
                          <option value="Default">Default</option>
                          <option value="Price Tiers">Price Tiers</option>
                          <option value="Volume Discount">Volume Discount</option>
                          <option value="Markup Margin">Markup Margin</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="back_order">Back Order</label>
                        <select class="form-control" id="back_order" name="back_order">
                          <option value="">--Select--</option>
                          <option value="Supplier">Supplier</option>
                          <option value="Bill of Materials">Bill of Materials</option>
                          <option value="Drop Shipping">Drop Shipping</option>
                          <option value="Multiple Suppliers">Multiple Suppliers</option>
                          <option value="Multiple Dropshippers">Multiple Dropshippers</option>
                          <option value="None">None</option>
                        </select>
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
  	function showStocks(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/approvals/bill_requests/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#sku").html(html);
                $('#sload').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showStocks(10, 1);
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
        				url: 'view/configurations/sku/insert.php',
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
                
            });
       
     	$('.index_view').click(function (e) {
		
		var ed = $(this).attr('lang');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/approvals/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
       
    	$('.current').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/approvals/bill_requests",
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
		    
            let transaction_year_month = $('#inputTransaction_year').val(); 
    	
	        	//alert(transaction_year_month)
	
            $.ajax({
                type: "GET",
                url: "view/approvals/bill_requests/select.php",
    			data: {
    			    
    			    transaction_year_month: transaction_year_month
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#sku").html(html);
                    $('#sload').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
      
      });
            
    
    
 
   
   event.preventDefault();
   });
  </script>
  

  