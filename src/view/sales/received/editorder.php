<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

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
             <?php
 

            $users = Db::getInstance()->query("SELECT a.*, b.username, concat(d.firstname, ' ', d.lastname) as registered, 
            a.wo_code, c.location as inputs_warehouse, e.location as output_warehouse, d.image, a.type
            FROM workorders a 
            left join worklocation c on a.inputs_warehouse_id = c.id 
            left join worklocation e on a.output_warehouse_id = e.id
            Left join users b on a.added_by = b.id 
            Left Join staff_record d on b.username = d.user_id 
            WHERE a.id =  $member_id");
                  
            foreach ($users->results() as $use) {
                
                $wo_code = $use->wo_code;
                $output_warehouse_id    = $use->output_warehouse_id;  
                $output_warehouse       = $use->output_warehouse;              
                $added_by               = $use->added_by; 
                $status                 = $use->status; 
                $operation_type         = $use->type; 
            ?>
            
                <div class="row my-3 mb-4 justify-content-between">
                    <div class="col-sm-6">
                       <h3>Receive Status: <?php echo $wo_code; ?></h3>     
                    </div>  
                    <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                    <div class="col-sm-12 warning_alert mr-0"></div>
                </div>
                
                <div class="row justify-content-between">
                    <div class="col-sm-3">
                     <?php
                      $proceed = Db::getInstance()->query("SELECT * FROM proceed_status WHERE request_code = '$wo_code'");   
                                        foreach ($proceed->results() as $proceed) {
                                  ?>
                              <button type="button" class="farm-button-disabled py-1 ml-0">
                                <span class="fa fa-save"> <?php echo $proceed->status; ?></span>
                              </button> 
                              <?php
                                        }
                                 ?>
                    
                </div>
                    <div class="col-sm-6 px-0 mr-0">
                       
                    </div>
                    <div class="col-sm-3 px-0 mr-0">
            
                          <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                            <span class="fa fa-chevron-left"></span>
                          </button>  
                          <?php
                                                
                                if($status === "Completed"){
            
                            ?>
                             <button type="button" class="farm-button py-1 ml-0" id="<?php echo $member_id; ?>" data-toggle="modal" data-target="#addrevceiveditem">
                                <span class="fa fa-plus"> Add Stock Received</span>
                              </button>
                              <?php
                                }
                              ?>
                          <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                            <span class="fa fa-refresh"></span>
                          </button>
                             
                    </div>
               </div>  
                
                <div class="row justify-content-between my-2 mx-4">
                   
                   <div class="col-sm-3 px-2">
                      
                   </div>
                
                   <div class="col-sm-9">
                      
                     <?php
        
                          $user = Db::getInstance()->query("SELECT * FROM sales_stocks_received WHERE workorders_id = $member_id");
        
                          if (!$user->count()) {
                            
                          } else {
        
                        ?> 
                      <div class="card-header col-sm-12">
                            Sales Received Items Note
                          </div>
                      <div class="table-responsive data-font px-3">
                        <div class="row justify-content-between my-5">
                                                       
                        <?php

                  $user = Db::getInstance()->query("SELECT a.*, concat(d.firstname, ' ', d.lastname) as registered   
                  FROM sales_stocks_received a
                  Left join users b on a.added_by = b.id 
                  Left Join staff_record d on b.username = d.user_id
                  WHERE workorders_id = $member_id");

                  if (!$user->count()) {
                      
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Item Code</th>
                          <th>Received By</th>
                          <th>Qty Received</th>
                          <th>Received Date</th>
                          <th>Addition Info</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->item_code; ?></td>
                            <td><?php echo $user->registered; ?></td>
                            <td class="text-right"><?php echo $user->qty_received; ?></td>
                            <td><?php echo $user->received_date; ?></td>
                            <td><?php echo $user->additional_info; ?></td>
                            
                            <td>
                                <?php
                                                
                                if($username == $added_by && $status != "Completed"){
            
                            ?>
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="singledelete" id="<?php echo $user->id; ?>" title="good_received" >
                                        <button class="dropdown-item">
                                             <i class="fa fa-trash"></i> &nbsp;Remove</button>

                                    </div>
                              </div>

                              </div> 
                             <?php
                                }
                             ?>
                            </td>
                           

  
                          </tr>

 
                        <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td>&nbsp;</td>
                            <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(qty_received) as gqty
                                                                    FROM sales_stocks_received 
                                                                    WHERE workorders_id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                      $labelpur = Db::getInstance()->query("SELECT SUM(product_qty) as pqty
                                                                FROM workoutput 
                                                                WHERE workorders_id = $member_id");   
                                foreach ($labelpur->results() as $labelpu) {
                                    
                                    
                                    $pqty = $labelpu->pqty;
                                    
                                     $totalreceived = $labelta->gqty;
                               
                                     
                                     if($totalreceived != ''){
                            ?>
                            <td class="alert alert-primary p-2 m-0">
                            <b>Total Goods Received</b> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $totalreceived; ?> of <?php echo $pqty; ?>
                               
                            </td>
                             <?php
                                        if($totalreceived > $pqty){
                                            echo '<td class="alert alert-success p-2 m-0">Surplus</td>';
                                        }else if($totalreceived < $pqty){
                                            echo '<td class="alert alert-warning p-2 m-0">Deficit</td>';
                                        }else if($totalreceived === $pqty){
                                            
                                        }
                                ?>
                            <?php
                                     }
                                 
                                     
                                
                        
                                 
                            ?>
                                    
                            
                            
                            
                            
                        </tr>
                        <?php
                                     }
                                 
                                 }
                                }   
                                 
                            ?>
                      </tbody>
                    </table>
                  <?php
                  }
                
                ?>
                
              
                </div>
                     </div>
                     <?php
                          }
                        
                        ?>
                    </div>
           
                </div>
             
<!-- Create Received Stock Modal !-->

  <div id="addrevceiveditem" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <form id="SaveOutput" method="POST" autocomplete="off">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Received Stock Items</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
             
              
              <div class="row">
                <div class="col-sm-12">
                    
                  <div class="row mt-0 mb-3 pt-0">
                      
                    <div class="col-sm-12 m-0 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 m-0 warning_alert" id="warning_alert"></div>
                    
                  </div>
                  
                 
                    <div class="row">
                      <div class="form-group col-sm-12">
                            <label for="description">Stock name</label>
                            <select class="custom-select" id="product_id" name="product_id">
                                    <option selected>--Select--</option>
                                    <?php
                                      $products = Db::getInstance()->query("SELECT * FROM `workoutput` where workorders_id = $member_id");
                                         if (!$products->count()) {
                                             
                                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                             
                                         }else{
                                           
                                                    foreach ($products->results() as $prod) {
                                             ?>
                                        
                                          <option value="<?php echo $prod->id; ?>"><?php echo $prod->sku_code . $prod->description; ?></option>
                                          <?php
                                                  }
                                                                                     }
                                              ?>
                                        </select>
                            <input type="hidden" id="description" name="description" />
                     </div>
                     
                     </div>
                    <div class="row">
                    
                      <div class="form-group col-sm-4">
                            <label for="sku_inv_code">Inventory Code</label>
                            <input type="text" id="sku_inv_code" name="sku_inv_code" class="form-control" style='font-size:0.80em' readonly />
                          </div>
                      <div class="form-group col-sm-4">
                        <label for="storage_location">Storage Location</label>
                        <select class="form-control" id="storage_location" name="storage_location" style='font-size:0.85em' readonly>
                            
                          <option value="<?php echo $output_warehouse; ?>"><?php echo $output_warehouse; ?></option>
                         
                        </select>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="uom">Unit of Measure</label>
                        <input type="text" id="uom" name="uom" class="form-control" readonly />
                      
                      </div>
                      
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                        <label for="product_type">Product Type</label>
                        <input type="text" id="product_type" name="product_type" class="form-control" readonly />
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="product_category">Product Category</label>
                        <input type="text" id="product_category" name="product_category" class="form-control" readonly />
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="product_qty">Produced Qty.</label>
                        <input type="number" id="product_qty" name="product_qty" class="form-control" readonly />
                      </div>
                      
                    </div>
                    <div class="row">
                        
                      <div class="form-group col-sm-4">
                        <label for="total_revenue">Total Revenue </label>
                        <input type="number" id="total_revenue" name="total_revenue" class="form-control" style='font-size:0.85em' readonly />
                        <span style="font-size:0.80em">(Projected)</span>
                      </div>
                        <div class="form-group col-sm-4">
                            <label for="qty_received">Qty. Received</label>
                            <input type="text" id="qty_received" name="qty_received" class="form-control" />
                          
                      </div>
                        <div class="form-group col-sm-4">
                            <label for="received_date">Received Date</label>
                            <input type="datetime-local" id="received_date" name="received_date" class="form-control" />
                          
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="additional_info">Additional Info</label>
                          <textarea class="form-control" name="additional_info" id="additional_info" rows="3"></textarea>
                     </div>
                    </div>
                    <input type="hidden" id="workorders_id" name="workorders_id" value="<?php echo $member_id; ?>" />
                    <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    
                
                
                
              </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveOutput">
        <span class="fa fa-save"> Save</span></button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
      </div>
        </div>
      </form>
    </div>
  </div>
  
             <?php
             }
            ?>
            
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
      $(document).ready(function(event){
          
            $('.success_alert').hide();
            $('.warning_alert').hide();
            
            
        $('.SaveStatus').on('click', function(){
       
                let form = $('#status_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/sales/received/update.php',
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
    	
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/sales/received/editorder.php",
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
    
        $('.prev_page').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/sales/received/index.php",
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
        
        $('.SaveOutput').on('click', function(){
       
                let form = $('#SaveOutput')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/sales/received/insertreceivedstocks.php',
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
       
       
        $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id = $(this).attr('id');
    		            let purchase_id = $(this).attr('lang');
    		             
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/sales/received/delete.php',
                		data: {
                		    tablename   : tablename,
                            id  : id,
                            purchase_id  : purchase_id
                		    
                		},
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
                    
                    
                  } else {
                    return false;
                    
                  }
                
                
                e.preventDefault();
            });
         $("#product_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'product_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/sales/received/getoutputsku.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                //$("#product_id").empty();
                $('.tax_category').empty();
                
                    for( let i = 0; i<len; i++){
                   
                                                          
                    let sku_code                = response[i]['sku_code']
                    let uom                     = response[i]['uom']
                    let description             = response[i]['description']
                    let tax_category            = response[i]['tax_category']
                    let tax_percent             = response[i]['tax_percent']
                    let product_type            = response[i]['product_type']
                    let product_category        = response[i]['product_category']
                    let product_qty             = response[i]['product_qty']
                    let total_revenue           = response[i]['total_revenue']
                    let storage_location        = response[i]['storage_location']
                  
                  //alert(description)
                  
                   $('#sku_inv_code').val(sku_code);
                   $('#product_type').val(product_type);
                   $('#product_category').val(product_category);
                   $('#product_qty').val(product_qty);
                   $('.tax_category').append(tax_category);
                   $('#tax_category').val(tax_category);                   
                   $('#tax_percent').val(tax_percent);
                   $('#uom').val(uom);
                   $('#description').val(description);
                   $('#total_revenue').val(total_revenue);
                
                  }
    				 	
    			} 
    		});
     	}); 
    	
       event.preventDefault();
   });
   
   
   
   </script>

