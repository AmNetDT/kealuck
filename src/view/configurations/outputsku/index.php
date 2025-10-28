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
          <h3>Inventory Types</h3>
          </div>
              
                <div class="row justify-content-between mt-4 mb-5">
                  
                  <div class="col-sm-9">
                      
                         <form>
                              <label class="mr-2">Sort by Product Category</label>
                              <select id="title" name="title" class="farm-button-cancel py-1 pl-4 mt-2">
                                <option value="">--Select--</option>
                                <option value="Crop Planting">Crop Planting</option>
                                <option value="Livestock">Livestock</option>
                                <option value="Agro Process">Agro Process</option>
                              </select>
                          </form>
                          
                                 
                        </div>
                  
                      
                  
                    <div class="col-sm-3 text-right">
                      <!-- Button trigger modal -->
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal" data-target="#staticBackdrop">
                        <span class="fa fa-plus"> Add Stock</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index">
                        <span class=" fa fa-refresh"></span>
                      </button>
                  </div>
                  </div>
                 

              

                         <div id="sku"></div>
            	    	<div id="sload"></div>
            </div>
          </div>
      </div>


<!-- Create SkU Modal !-->

  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <form id="stockInsert" method="POST" autocomplete="off">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">New Stock</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
              
              <?php 
              
              $abdusalam    = mt_rand(10,99); 
              $rahma        = mt_rand(10,99); 
              $fatima       = mt_rand(10,99); 
              $hanna        = mt_rand(10,99); 
              ?>
              
              <div class="row">
                <div class="col-sm-12">
                    
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                    <div class="row">
                        
                      <div class="form-group col-sm-7">
                            <label for="sku_code">Stock Code</label>
                            <input type="text" id="sku_code" name="sku_code" class="form-control" value="SKU<?php echo $hanna . $fatima; ?>INVENT<?php echo $abdusalam . $rahma; ?>" class="form-control" readonly/>
                          </div>
                        
                      <div class="form-group col-sm-5">
                        <label for="order_from">Order From</label>
                        <select class="form-control" id="order_from" name="order_from">
                          <option value="">--Select--</option>
                          <option value="Internal">Internal</option>
                          <option value="External">External</option>
                          <option value="None">None</option>
                        </select>
                      </div>
                     </div>
                    <div class="row">
                      
                      <div class="form-group col-sm-8">
                            <label for="description">Stock Description</label>
                          <input type="text" name="description" id="description" class="form-control" />
                          
                     </div>
                      <div class="form-group col-sm-4 product_type">
                        <label for="product_type">Variety</label>
                        <input list="product_type_list" name="product_type" id="product_type" class="form-control">
                        <datalist id="product_type_list">
                            <option value="Perishable Feedstock"> 
                            <option value="Finished Product"> 
                            <option value='Feedstock'>
                            <option value='ByProduct'>
                        </datalist>
                      </div>
                     
                     </div>
                    <div class="row">
                      <div class="form-group col-sm-4">
                        <label for="uom">Package Type</label>
                        <input list="uom_list" name="uom" id="uom" class="form-control">
                        <datalist id="uom_list">
                          <option value="Sachet">
                          <option value="Dozen">
                          <option value="Pack">
                          <option value="Carton">
                          <option value="Bag">
                        </datalist>
                      
                      </div>
                      <div class="form-group col-sm-4 metric_units">
                        <label for="metric_units">Metric Type</label>
                        <select class="form-control" id="metric_units" name="metric_units">
                          <option value="">--Select--</option>
                          <option value="bales">bales</option>
                          <option value="barrels">barrels</option>
                          <option value="bunches">bunches</option>
                          <option value="bushes">bushes</option>
                          <option value="dozen">dozen</option>
                          <option value="grams">grams</option>
                          <option value="head">head</option>
                          <option value="kilograms">kilograms</option>
                          <option value="kilolitre">kilolitre</option>
                          <option value="litre">litre</option>
                          <option value="millilitre">millilitre</option>
                          <option value="quantity">quantity</option>
                          <option value="tonnes">tonnes</option>
                        </select>
                        
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="tax_category">Tax Category</label>
                        <select class="form-control" id="tax_category" name="tax_category">
                            <option selected>--Select--</option>
                            <?php
                              $products = Db::getInstance()->query("SELECT * FROM `tax`");
                                 if (!$products->count()) {
                                     
                                     echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                     
                                 }else{
                                   
                                            foreach ($products->results() as $prod) {
                                     ?>
                                
                                <option value="<?php echo $prod->id; ?>"><?php echo $prod->title; ?></option>
                                
                            <?php
                                  }
                                                                     }
                              ?>
                        </select>
                      </div>
                      </div>
                    <div class="row">
                        
                    <label for="product_category" class="px-3">Product Category</label>
                      <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline1" name="product_category" value="Crop Planting" class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline1">Crop Planting</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline2" name="product_category" value="Livestock" class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline2">Livestock</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline3" name="product_category" value="Agro Process" class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline3">Agro Process</label>
                        </div>
                      </div>
                    
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="cost_">Cost per Unit</label>
                          <input type="number" name="cost_" id="cost_" class="form-control" />
                          
                     </div>
                        <div class="form-group col-sm-4">
                            <label for="tax_percent">Tax Percent (%)</label>
                          <input type="number" name="tax_percent" id="tax_percent" class="form-control" readonly />
                          
                     </div>
                        <div class="form-group col-sm-4">
                             <label for="selling_price_default">Selling Price</label> 
                            <button type="button" class="btn-light border" id="tax_refresh"><span class="fa fa-refresh"></span></button>
                          <input type="number" name="selling_price_default" id="selling_price_default" class="form-control" readonly />
                          
                     </div>
                    </div>
                    
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="note">Note</label>
                          <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                     </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="cost_" style="font-size:0.8em">Alert When Less Than</label>
                          <input type="number" name="alert" id="alert" class="form-control" />
                          
                     </div>
                    </div>
                    
                    <input type="hidden" id="type" name="type" value="output" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
              </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
      </div>
        </div>
      </form>
    </div>
  </div>

<?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>


 
  <script>
  	function showStocks(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/outputsku/select.php",
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
        
       
        $('.edituser_view').click(function (e) {
		
		
        		$("#loader_httpFeed").show();
        		
        		$.ajax({
        			type: "POST",
        			url: "view/configurations/index.php",
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
        		
        		e.preventDefault();
        	});    
       
       
    	$('.editstaff_index').click(function (e) {
		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/outputsku/",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
       
       
        $('#title').change(function(evt){ 
                
        let title = $(this).find(":selected").val(); 
	    

        $.ajax({
            type: "GET",
            url: "view/configurations/outputsku/select.php",
           
			data: {
			    
			    title : title
			},
            cache: false,
    		beforeSend: function() {
    		    
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#sku").html(html);
                $('#sload').html(''); 
            }
        });
        
        
         evt.preventDefault();
        
      
      });
        
        $("#tax_category").on('change', function(){  
	    
	        let id = $(this).find(":selected").val();
		    let dataString = 'tax_category='+ id;  
		
		//alert(dataString);
	
		    $.ajax({
			url: 'view/configurations/outputsku/gettax.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                 let len = response.length;

                    $("#tax_percent").empty();
                
                    for( let i = 0; i<len; i++){
                        
                         let tax_percent = response[i]['percentage']
                        
                         $('#tax_percent').val(tax_percent);
                    }
    				 	
    			} 
    		});
     	}); 
     	
        $("#cost_").change(function(){  
        	
        	let tax_percent = $('#tax_percent').val();
            let cost_       = $('#cost_').val();
            let cost_num    = parseInt(cost_);
        
                if(cost_ === ""){
                    
                        alert("Unit Cost require")
                    
                }else{
                 		let total_rev = tax_percent / 100 * cost_num / 1 ;
                		let total_revenue = cost_num + total_rev;
                		
                		//alert(cost_);
                	  $('#selling_price_default').val(total_revenue);
                }
     	});
     	
     	$("#tax_refresh").on('click', function(){  
        	
        	let tax_percent = $('#tax_percent').val();
            let cost_       = $('#cost_').val();
            let cost_num    = parseInt(cost_);
        
                if(cost_ === ""){
                    
                        alert("Unit Cost require")
                    
                }else{
                 		let total_rev = tax_percent / 100 * cost_num / 1 ;
                		let total_revenue = cost_num + total_rev;
                		
                		//alert(cost_);
                	  $('#selling_price_default').val(total_revenue);
                }
     	});
        
        $("#order_from").on("change", function() {
       
          
           let external = $('#order_from option:selected').val();
            
            if(external === 'External'){
                
                
                $("#customRadioInline1").prop("disabled", true);
                $("#customRadioInline2").prop("disabled", true);
                $("#customRadioInline3").prop("checked", true);
                $("#uom").prop("readonly", true);
                $("#uom option[value='Weight']").prop("selected", true);
                
            }else if(external === 'Internal'){
                
                
                $("#customRadioInline1").prop("disabled", false);
                $("#customRadioInline2").prop("disabled", false);
                $("#customRadioInline3").prop("checked", false);
                $("#uom").prop("disabled", false);
                $("#uom option[value='Weight']").prop("selected", false);
                
                
            }
          
        });
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#stockInsert')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/outputsku/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $("#sku").html(html);
                            $('#sload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
       
        
     	
   event.preventDefault();
   });
  </script>
  

  