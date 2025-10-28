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
          <h3>Input Stocks</h3>
          </div>
              
                <div class="row justify-content-between mt-4 mb-3">
                  
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


<?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>


<!-- Create SkU Modal !-->

  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">New Stock</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
              
              <?php $abdusalam = mt_rand(1000,9999); ?>
              
              <div class="row">
                <div class="col-sm-12">
                    
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 
                <form id="stockInsert" method="POST" autocomplete="off">
                    <div class="row">
                      <div class="form-group col-sm-8">
                            <label for="description">Stock Description</label>
                          <input type="text" name="description" id="description" class="form-control" />
                          
                     </div>
                      <div class="form-group col-sm-4">
                            <label for="sku_code">Stock Code</label>
                            <input type="text" id="sku_code" name="sku_code" class="form-control" value="SKU<?php echo $abdusalam; ?>" class="form-control" readonly />
                          </div>
                     </div>
                    <div class="row">
                      <div class="form-group col-sm-4 product_type">
                        <label for="product_type">Product Type</label>
                        <select class="form-control" id="product_type" name="product_type">
                          <option value="">--Select--</option>
                          <option value="Perishable Feedstock">Perishable Feedstock</option>
                          <option value="Finished Product">Finished Product</option>
                          <option value='Feedstock'>Feedstock</option>
                          <option value='ByProduct'>ByProduct</option>
                        </select>
                        
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="product_category">Product Category</label>
                        <select class="form-control" id="product_category" name="product_category">
                          <option value="">--Select--</option>
                          <option value="Crop Planting">Crop Planting</option>
                          <option value="Livestock">Livestock</option>
                          <option value="Agro Process">Agro Process</option>
                        </select>
                      </div>
                       <div class="form-group col-sm-4">
                        <label for="order_from">Order From</label>
                        <select class="form-control" id="order_from" name="order_from">
                          <option value="">--Select--</option>
                          <option value="Supplier">Supplier</option>
                          <option value="Multiple Suppliers">Multiple Suppliers</option>
                          <option value="None">None</option>
                        </select>
                      </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-sm-3">
                        <label for="uom">UoM</label>
                        
                        <select class="form-control" id="uom" name="uom">
                          <option value="">--Select--</option>
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
                      <div class="form-group col-sm-3">
                        <label for="currency_id">Currency</label>
                        <select class="form-control" id="currency_id" name="currency_id">
                            <option value="">--Choose Currency--</option>
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
                      <div class="form-group col-sm-3">
                        <label for="cost_per_unit">Unit Cost</label>
                          <input type="number" name="cost_per_unit" id="cost_per_unit" class="form-control" />
                          
                     </div>
                      <div class="form-group col-sm-4">
                        <label for="inventory_id">Inventory Type</label>
                        <select class="form-control" id="inventory_id" name="inventory_id">
                          <option value="">--Select--</option>
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
                          <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                     </div>
                    </div>
                    <input type="hidden" id="type" name="type" value="input" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                </form>
                
                
              </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
      </div>
        </div>
      
    </div>
  </div>

  <!-- End Create Dept Type Modal !-->
 
  <script>
  	function showStocks(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/sku/select.php",
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
                
                
                $('#title').change(function(evt){ 
                    
                let title = $(this).find(":selected").val(); 
                
                
                    $.ajax({
                    type: "GET",
                    url: "view/configurations/sku/select.php",
                    
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
                
                
                $('.editstaff_index').click(function (e) {
                
                $("#loader_httpFeed").show();
                    $.ajax({
                    type: "POST",
                    url: "view/configurations/sku",
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
                       

             
                   
                  
                event.preventDefault();
   });
  </script>
  

  