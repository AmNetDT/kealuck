<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];
$supplier_list_id = $_POST['supplier_list_id'];

//echo $member_id . ' ' .$supplier_list_id;


$user = new User();
if ($user->isLoggedIn()) {

    $userSyscategory = escape($user->data()->syscategory_id);
?>

  
  
             
             
             
             
             
             
    <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="col-sm-6 offset-md-3">
        <div id="accounttile" class="container">
          <?php

            $username_id = escape($user->data()->id);

            $users = Db::getInstance()->query("SELECT a.*, b.sku_code, b.description, c.username, d.id as suppliers_id,
                                                e.id as currency_id, e.name as currency, e.sign
                                                FROM `supplier_price_list` a 
                                                LEFT JOIN suppliers d on a.supplier_id = d.id
                                                LEFT JOIN currency e on a.currency_id = e.id
                                                Left Join products b on a.product_id = b.id
                                                Left join users c on a.added_by = c.id
                                                WHERE a.id =$supplier_list_id");
            foreach ($users->results() as $use) {
                
                              
            ?>
            <div class="jumbotron bg-white">
              
                <div class="col-sm-12">
                <div class="row justify-content-between">
                    <div class="col-sm-9">
                        <h3><i class="fa fa-leaf p-1" aria-hidden="true"></i> Edit Supplier Price: <?php echo $use->sku_code; ?></h3>
                        </div>
                        <div class="col-sm-3">
                                     
                                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="<?php echo $use->suppliers_id; ?>">
                                        <span class="fa fa-chevron-left"></span> 
                                      </button>
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
                                     
                        </div>
                </div>
          <div class="row my-3">
            <div class="col-sm-12">
           
                   
                  <div class="row my-5">
                         
             <form id="uploadForm" method="post" enctype="multipart/form-data">
                 
                 <div class="row">
                    <div class="col-md-12">
                     <div class="success_alert"></div>
                     <div class="warning_alert"></div>
                 </div>
              </div>
              
        <div class="row">
             
              <div class="form-group col-sm-12">
              
                <label for="description">Description</label>
               <input type="text" id="description" name="description" class="form-control" value="<?php echo $use->description; ?>" disabled /> 
              </div>
            </div>
            
            <div class="row">
                
              <div class="form-group col-sm-6">
                  <label for="product_id">SKU Code</label>
                <select class="form-control" id="product_id" name="product_id">
                    <option value="<?php echo $use->product_id; ?>"><?php echo $use->sku_code; ?></option>
                  <?php
              $products = Db::getInstance()->query("SELECT * FROM `products` where type='input'");
                                                             if (!$products->count()) {
                                                                 
                                                                 echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                                 
                                                             }else{
                                                               
                                                                        foreach ($products->results() as $prod) {
                                                                 ?>
                
                  <option value="<?php echo $prod->id; ?>"><?php echo $prod->sku_code . ' '. $prod->description; ?></option>
                  <?php
                          }
                                                             }
                      ?>
                </select>
                
              </div> 
              <div class="form-group col-sm-6">
              
                <label for="uom">Unit of Measure</label>
                <input type="text" id="uom" name="uom" class="form-control" value="<?php echo $use->uom; ?>" readonly/>
                
              </div>
            </div>
            <div class="row">
               <div class="form-group col-sm-6">
              
                <label for="currency_id">Currency Type</label>
                <select class="form-control" id="currency_id" name="currency_id">
                    <option value="<?php echo $use->currency_id; ?>"><?php echo $use->sign . ' '. $use->currency; ?></option>  
                    <?php
                        
                        $currency = Db::getInstance()->query("SELECT * FROM `currency`");
                         if (!$currency->count()) {
                             
                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                             
                         }else{
                           
                                    foreach ($currency->results() as $currency) {
                                                                 ?>
                
                  <option value="<?php echo $currency->id; ?>"><?php echo $currency->sign . ' '. $currency->name; ?></option>
                  <?php
                          }
                                                             }
                      ?>
                </select>
              </div> 
              <div class="form-group col-sm-6">
              
                <label for="unit_cost">Unit Cost</label>
                <input type="text" id="unit_cost" name="unit_cost" class="form-control" value="<?php echo $use->unit_cost; ?>" readonly />
                
              </div>
              
              <div class="form-group col-sm-4" style="font-size:0.8rem">
              
                <label for="tier_qty">Tier Qty</label>
                <input type="text" id="tier_qty" name="tier_qty" class="form-control" value="<?php echo $use->tier_qty; ?>" />
                
              </div>
              <div class="form-group col-sm-4" style="font-size:0.8rem">
              
                <label for="order_qty">Order Qty</label>
                <input type="text" id="order_qty" name="order_qty" class="form-control" value="<?php echo $use->order_qty; ?>" />
                
              </div>
              <div class="form-group col-sm-4" style="font-size:0.8rem">
              
                <label for="shipping_days">Shipping Days</label>
                <input type="text" id="shipping_days" name="shipping_days" class="form-control" value="<?php echo $use->shipping_days; ?>" />
                
              </div>
            </div>
                 
                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username_id; ?>" />
                 <input type="hidden" name="id" id="id" value="<?php echo $use->id; ?>"  />
                 <input type="hidden" name="supplier_id" value="<?php echo $use->supplier_id; ?>" id="supplier_id" />
             </form>
         <?php }
            ?>
   
   
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
    $(document).ready(function(){
     $('.resulter').hide();
     $('.resulterError').hide();
    })
</script>

 
<script>
   $(document).ready(function(event) {
    
    
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/purchases/suppliers/updatesupplier_price.php',
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
       
        
    	$('.edituser_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
		
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/purchases/suppliers/view.php",
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
       
	        
        $("#product_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'product_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/purchases/suppliers/getsku.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                //$("#product_id").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let description = response[i]['description'];
                    let uom = response[i]['uom'];
                    let cost_per_unit = response[i]['cost_per_unit'];
                    
                  
                   $('#description').val(description);
                   $('#uom').val(uom);
                   $('#unit_cost').val(cost_per_unit);
                    //alert(description);
                
                }
				 	
			} 
		});
 	}) 
        
       
     event.preventDefault();   
   });
   
   </script>

