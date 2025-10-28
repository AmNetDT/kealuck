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
                  
                    $users = Db::getInstance()->query("SELECT a.*, concat(d.firstname,' ', d.lastname) as added_by, e.sign, a.currency_id, 
                    b.sku_code AS inventory_code, b.id AS inventory_id
                    FROM products a
                    LEFT JOIN products b ON a.inventory_id = b.id
                    Left Join users c on a.added_by = c.id
                    Left Join staff_record d on c.username = d.user_id
                    Left Join currency e on a.currency_id = e.id
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
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" lang="view/configurations/sku/" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" lang="view/configurations/sku" id="<?php echo $member_id ?>">
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
                      <div class="form-group col-sm-8">
                            <label for="description">Stock Description</label>
                          <input type="text" name="description" id="description" value="<?php echo $stockQ->description; ?>" class="form-control" />
                          
                     </div>
                      <div class="form-group col-sm-4">
                            <label for="sku_code">Stock Code</label>
                            <input type="text" id="sku_code" name="sku_code" class="form-control" value="<?php echo $stockQ->sku_code; ?>" class="form-control" readonly />
                          </div>
                     </div>
                    <div class="row">
                      <div class="form-group col-sm-4 product_type">
                        <label for="product_type">Product Type</label>
                        <select class="form-control" id="product_type" name="product_type">
                          <option value="<?php echo $stockQ->product_type; ?>" selected><?php echo $stockQ->product_type; ?></option>
                          <option value="Perishable Feedstock">Perishable Feedstock</option>
                          <option value="Finished Product">Finished Product</option>
                          <option value='Feedstock'>Feedstock</option>
                          <option value='ByProduct'>ByProduct</option>
                        </select>
                        
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="product_category">Product Category</label>
                        <select class="form-control" id="product_category" name="product_category">
                          <option value="<?php echo $stockQ->product_category; ?>" selected><?php echo $stockQ->product_category; ?></option>
                          <option value="Crop Planting">Crop Planting</option>
                          <option value="Livestock">Livestock</option>
                          <option value="Agro Process">Agro Process</option>
                        </select>
                      </div>
                       <div class="form-group col-sm-4">
                        <label for="order_from">Order From</label>
                        <select class="form-control" id="order_from" name="order_from">
                          <option value="<?php echo $stockQ->order_from; ?>" selected><?php echo $stockQ->order_from; ?></option>
                          <option value="Supplier">Supplier</option>
                          <option value="Multiple Suppliers">Multiple Suppliers</option>
                          <option value="None">None</option>
                        </select>
                      </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-sm-3">
                        <label for="uom">Unit of Measure</label>
                        
                        <select class="form-control" id="uom" name="uom">
                          <option value="<?php echo $stockQ->uom; ?>" selected><?php echo $stockQ->uom; ?></option>
                          <option value="Piece">Piece</option>
                          <option value="Pack">Pack</option>
                          <option value="Carton">Carton</option>
                          <option value="Bag">Bag</option>
                          <option value="Weight">Weight</option>
                        </select>
                      
                      </div>
                      <div class="form-group col-sm-3 metric_units">
                        <label for="metric_units">Metric Units</label>
                        <select class="form-control" id="metric_units" name="metric_units">
                          <option value="<?php echo $stockQ->metric_units; ?>" selected><?php echo $stockQ->metric_units; ?></option>
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
                      <div class="form-group col-sm-2">
                        <label for="currency_id">Currency</label>
                        <select class="form-control" id="currency_id" name="currency_id">
                            <option value="<?php echo $stockQ->currency_id; ?>"><?php echo $stockQ->sign; ?></option>
                            <?php
                      
                                        $transaction_year = Db::getInstance()->query("SELECT * FROM currency order by id asc");
                                        foreach ($transaction_year->results() as $trans) {
                  
                            ?>
                                  <option value="<?php echo $trans->id; ?>"><?php echo $trans->sign; ?> | <?php echo $trans->name; ?></option>
                                  <?php
                                         }
                            ?>
                        </select>
                     </div>
                      <div class="form-group col-sm-4">
                        <label for="cost_per_unit">Cost per Unit</label>
                          <input type="number" name="cost_per_unit" id="cost_per_unit" value="<?php echo $stockQ->cost_per_unit; ?>" class="form-control" />
                          
                     </div>
                      </div>
                      <div class="row">
                          <div class="form-group col-sm-4">
                        <label for="inventory_id">Inventory Type</label>
                        <select class="form-control" id="inventory_id" name="inventory_id">
                          <option value="<?php echo $stockQ->inventory_id; ?>"><?php echo $stockQ->inventory_code; ?></option>
                        </select>
                        
                      </div>
                      <div class="form-group col-sm-8">
                        <label for="inventory_name">Inventory</label>
                          <input type="text" name="inventory_name" id="inventory_name" class="form-control" readonly/>
                      </div>
                      </div>
                     
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="note">Note</label>
                          <textarea class="form-control" name="note" id="note" rows="3"><?php echo $stockQ->note; ?></textarea>
                     </div>
                    </div>
                   
                    <div class="row">
                        <div class="form-group col-sm-4">
                        <label for="username" class="form-control">Created by: <?php echo $stockQ->added_by; ?></label>
                         </div>
                        </div> 
                        
                    <div class="row">     
                        <div class="form-group col-sm-6">
                        <label for="creted_date" class="form-control">Date Created: <?php echo $stockQ->created_date; ?></label>  
                        </div>
                        <div class="form-group col-sm-6">
                        <label for="modified_date" class="form-control">Modified: <?php echo $stockQ->modified_date; ?></label> 
                      </div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $stockQ->id; ?>" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    <input type="hidden" id="type" name="type" value="<?php echo $stockQ->type; ?>" />
                    
                
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
        				url: 'view/configurations/sku/update.php',
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
    			url: ed + "/editstock.php",
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
        
        
             
                $("#product_category").change(function () {
                    
                    let product_category = $(this).val(); // Get selected value directly
                    let dataString = { product_category: product_category }; // Use object notation for data
            
                    $.ajax({
                        url: 'view/configurations/sku/getInventory_type.php',
                        dataType: 'json',
                        type: 'GET',
                        data: dataString,
                        cache: false,
                        success: function (response) {
                            $("#inventory_id").empty(); // Clear dropdown options
                            $("#inventory_name").val(''); // Clear input field
            
                            if (response.length > 0) {
                                
                                let options = response.map(item => `<option value="${item.id}">${item.sku_code}</option>`).join('');
                                let descriptions = response.map(item => item.description).join(', ');
            
                                $("#inventory_id").append(options);
                                $("#inventory_name").val(descriptions);
                                
                            }
                        },
                        error: function () {
                            console.error("Error fetching inventory data.");
                        }
                    });
                    
                });

                $("#inventory_id").change(function () {
                    
                let inventory_id = $(this).val(); // Get selected value directly
                let dataString = { inventory_id: inventory_id }; // Use object for better readability
                
                $.ajax({
                    url: 'view/configurations/sku/getInventory_type.php',
                    dataType: 'json',
                    type: 'GET', // Explicitly defining request type
                    data: dataString,
                    cache: false,
                    success: function (response) {
                        $("#inventory_name").val(''); // Clear input before appending
        
                        if (response.length > 0) {
                            
                            let descriptions = response.map(item => item.description).join(', '); // Join descriptions
                            $("#inventory_name").val(descriptions);
                            
                        }
                    },
                    error: function () {
                        console.error("Error fetching inventory data.");
                    }
                });
                
            });
                       
            
       
    	$('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
	
		
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
       
   
   event.preventDefault();
     });
	</script>
