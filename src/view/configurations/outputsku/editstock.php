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

    <div class="col-sm-7 offset-md-1">
        <div id="accounttile" class="container">
          <?php
                  
                    $users = Db::getInstance()->query("SELECT a.*, concat(d.firstname,' ',d.lastname) as added_by, b.title, b.id as tax_id
                    FROM products a
                    Left Join tax b on a.tax_id = b.id
                    Left Join users c on a.added_by = c.id
                    Left Join staff_record d on c.username = d.user_id
                    WHERE a.id = $member_id");
                    foreach ($users->results() as $stockQ) {
                
                 
                   $sku_code = $stockQ->sku_code;
                 ?>

          <div class="jumbotron bg-white">
              <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                    <div class="col-sm-8">
                       <h3>Update Stock Unit: <?php echo $sku_code; ?></h3> </h3>     
                    </div>
                   <div class="col-sm-4">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
            </div>
        </div>
                    <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
        
              <div class="row">
                <div class="col-sm-12">          
                 <form method="POST" autocomplete="off">
                     <div class="row">
                        
                      <div class="form-group col-sm-7">
                            <label for="sku_code">Stock Code</label>
                            <input type="text" id="sku_code" name="sku_code" class="form-control" value="<?php echo $sku_code; ?>" class="form-control" readonly/>
                          </div>
                        
                      <div class="form-group col-sm-5">
                        <label for="order_from">Order From</label>
                        <select class="form-control" id="order_from" name="order_from">
                          <option value="<?php echo $stockQ->order_from; ?>"><?php echo $stockQ->order_from; ?></option>
                          <option value="Internal">Internal</option>
                          <option value="External">External</option>
                          <option value="None">None</option>
                        </select>
                      </div>
                     </div>
                   
                    <div class="row">
                      
                      <div class="form-group col-sm-8">
                            <label for="description">Stock Description</label>
                          <input type="text" name="description" id="description" value="<?php echo $stockQ->description; ?>" class="form-control"  />
                          
                     </div>
                      <div class="form-group col-sm-4 product_type">
                        <label for="product_type">Product Type</label>
                        <select class="form-control" id="product_type" name="product_type">
                          <option value="<?php echo $stockQ->product_type; ?>"><?php echo $stockQ->product_type; ?></option>
                          <option value="Perishable Feedstock">Perishable Feedstock</option>
                          <option value="Finished Product">Finished Product</option>
                          <option value='Feedstock'>Feedstock</option>
                          <option value='ByProduct'>ByProduct</option>
                        </select>
                        
                      </div>
                     
                     </div>
                     
                    <div class="row">
                      <div class="form-group col-sm-4">
                        <label for="uom">Unit of Measure</label>
                        
                        <select class="form-control" id="uom" name="uom">
                          <option value="<?php echo $stockQ->uom; ?>"><?php echo $stockQ->uom; ?></option>
                          <option value="Piece">Piece</option>
                          <option value="Pack">Pack</option>
                          <option value="Carton">Carton</option>
                          <option value="Bag">Bag</option>
                          <option value="Weight">Weight</option>
                        </select>
                      
                      </div>
                      <div class="form-group col-sm-4 metric_units">
                        <label for="metric_units">Metric Units</label>
                        <select class="form-control" id="metric_units" name="metric_units">
                          <option value="<?php echo $stockQ->metric_units; ?>"><?php echo $stockQ->metric_units; ?></option>
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
                          <option value="<?php echo $stockQ->tax_id; ?>"><?php echo $stockQ->title; ?></option>
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
                          <input type="radio" id="customRadioInline1" name="product_category" value="<?php if($stockQ->product_category === 'Crop Planting'){ echo $stockQ->product_category;}else{echo 'Crop Planting';} ?>" 
                          class="custom-control-input" <?php if($stockQ->product_category === 'Crop Planting'){ echo 'checked'; } ?>>
                          <label class="custom-control-label" for="customRadioInline1">Crop Planting</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline2" name="product_category" value="<?php if($stockQ->product_category === 'Livestock'){ echo $stockQ->product_category;}else{echo 'Livestock';} ?>" 
                          class="custom-control-input" <?php if($stockQ->product_category === 'Livestock'){ echo 'checked'; } ?>>
                          <label class="custom-control-label" for="customRadioInline2">Livestock</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline3" name="product_category" value="<?php if($stockQ->product_category === 'Agro Process'){ echo $stockQ->product_category;}else{echo 'Agro Process';} ?>" 
                          class="custom-control-input" <?php if($stockQ->product_category === 'Agro Process'){ echo 'checked'; } ?>>
                          <label class="custom-control-label" for="customRadioInline3">Agro Process</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="cost_">Cost per Unit</label>
                          <input type="number" name="cost_" id="cost_" class="form-control" value="<?php echo $stockQ->cost_per_unit; ?>" />
                          
                     </div>
                        <div class="form-group col-sm-4">
                            <label for="tax_percent">Tax Percent (%)</label>
                          <input type="number" name="tax_percent" id="tax_percent" class="form-control" value="<?php echo $stockQ->tax_percent; ?>" readonly />
                          
                     </div>
                        <div class="form-group col-sm-4">
                             <label for="selling_price_default">Selling Price</label> 
                            <button type="button" class="btn-light border" id="tax_refresh"><span class="fa fa-refresh"></span></button>
                          <input type="number" name="selling_price_default" id="selling_price_default" class="form-control" value="<?php echo $stockQ->selling_price_default; ?>" readonly />
                          
                     </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="note">Note</label>
                          <textarea class="form-control" name="note" id="note" rows="3"><?php echo $stockQ->note; ?></textarea>
                     </div>
                    </div>
                    <input type="hidden" id="type" name="type" value="output" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                    <input type="hidden" id="id" name="id" value="<?php echo $stockQ->id; ?>" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                    
                    
                    
                    <hr class="my-4">
                    <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="username" class="form-control">Created by: <?php echo $stockQ->added_by; ?></label>
                         </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="creted_date" class="form-control">Date Created: <?php echo $stockQ->created_date; ?></label>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="modified_date" class="form-control">Modified: <?php echo $stockQ->modified_date; ?></label> 
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
        
         let external = $('#order_from option:selected').val();
            
            if(external === 'External'){
                
                $("#customRadioInline1").prop("disabled", true);
                $("#customRadioInline2").prop("disabled", true);
                $("#customRadioInline3").prop("checked", true);
                
            }
       
        $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/outputsku/update.php',
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
       
    	$('.current_page').click(function (e) {
    		
    		let id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/outputsku/editstock.php",
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
        
    	$('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/configurations/outputsku/index.php",
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