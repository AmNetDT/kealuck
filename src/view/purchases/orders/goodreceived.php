<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

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
        
            
             
         <?php


            $users = Db::getInstance()->query("SELECT a.*, b.username, c.name as supplier,
                  a.supplier_id, c.supplier_code
                  FROM purchases a 
                  Left join users b on a.added_by = b.id 
                  Left Join staff_record d on b.username = d.user_id 
                  left join suppliers c on a.supplier_id = c.id
                  WHERE a.id = $member_id");
                  
            foreach ($users->results() as $use) {
                
                $purchase_code = $use->purchase_code;
                                        
                             
            ?>
            <div class="jumbotron pt-5 bg-white">
                <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Good Received Note (GRN): <?php echo $purchase_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                      
                    </div> 
                </div>
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9 pl-5 mr-0">
                        <?php
                        
                            $labeltax = Db::getInstance()->query("SELECT SUM(qty) as gqty
                                                    FROM good_received 
                                                    WHERE purchase_id = $member_id");     
                            if($labeltax->count()){
                                foreach ($labeltax->results() as $labelta) {
                             
                            
                            $labelpur = Db::getInstance()->query("SELECT SUM(qty) as pqty
                                                        FROM purchase_order 
                                                        WHERE purchase_id = $member_id");   
                                foreach ($labelpur->results() as $labelpu) {
                                    
                                    
                                        $gqty = $labelta->gqty;
                                        $pqty = $labelpu->pqty;
                                        if($pqty != $gqty || empty($gqty)){
                            
                            ?>
                            
                        <button type="button" class="farm-button-cancel py-1" data-toggle="modal" data-target="#ordermodal">
                            <span class="fa fa-save"> Update</span>
                          </button>
                          
                          <?php
                                        }
                                   }
                                }
                            }
                      
                      ?>
                </div>
                    <div class="col-sm-3 mr-0">
        
                      <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" lang="view/purchases/orders" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>  
                      <button type="button" class="farm-button py-1 ml-0 view_invoice" lang="view/purchases/orders" id="<?php echo $member_id; ?>">
                        <span class="fa fa-print"> Supplier Invoice</span>
                      </button> 
                      <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                      
                </div>
               </div>  
                <div class="row">
                    <div class="col-sm-12">
                     <div class="table-responsive data-font px-3" style="height: 120%;">
                        <div class="row justify-content-between my-5">
                                                       
                        <?php

                          $user = Db::getInstance()->query("SELECT a.*, b.sku_code  
                          FROM good_received a 
                          LEFT JOIN products b ON a.inventory_id = b.id
                          WHERE purchase_id = $member_id");
        
                          if (!$user->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                          } else {
        
                        ?> 
        
                            <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                              <thead>
                                <tr> 
                                  <th>SN</th>
                                  <th>SKU Code</th>
                                  <th>Inventory Code</th>
                                  <th>Description</th>
                                  <th style="text-align:right">Qty Received</th>
                                  <th>Received Date</th>
                                  <?php
                                    
                                         if($pqty != $gqty || empty($gqty)){
                                    
                                    ?>
                                  <th>&nbsp;</th>
                                    <?php
                                    
                                         }
                                    
                                    ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $i = 1;
                                foreach ($user->results() as $user) {
        
                                ?>
                                  <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $user->sku_code; ?></td>
                                    <td><?php echo $user->inventory_code; ?></td>
                                    <td><?php echo $user->description; ?></td>
                                    <td style="text-align:right"><?php echo $user->qty; ?></td>
                                    <td><?php echo $user->received_date; ?></td>
                                    <?php
                                    
                                         if($pqty != $gqty || empty($gqty)){
                                    
                                    ?>
                                    <td>
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
                                     
                                    </td>
                                    <?php
                                    
                                         }
                                    
                                    ?>
                                  </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td>&nbsp;</td>
                                    <td colspan='2' style="text-align:right" class="alert alert-primary p-2 m-0">
                                    <?php
                                     $labeltax = Db::getInstance()->query("SELECT SUM(qty) as gqty
                                                                            FROM good_received 
                                                                            WHERE purchase_id = $member_id");     
                                     if($labeltax->count()){
                                         foreach ($labeltax->results() as $labelta) {
                                              $labelpur = Db::getInstance()->query("SELECT SUM(qty) as pqty
                                                                        FROM purchase_order 
                                                                        WHERE purchase_id = $member_id");   
                                        foreach ($labelpur->results() as $labelpu) {
                                            
                                            
                                            $pqty = $labelpu->pqty;
                                            
                                             $totalreceived = $labelta->gqty;
                                       
                                             
                                             if($totalreceived != ''){
                                    ?>
                                            
                                    <div><b>Total Goods Received</b> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $totalreceived; ?> of <?php echo $pqty; ?></div>
                                    <?php
                                             }
                                        
                                    ?>
                                    </td>
                                    <?php 
                                    $gqty = $labelta->gqty;
                                    
                                    if($pqty != $gqty || empty($gqty)){
                                    ?>
                                    <td colspan='2' class="alert alert-warning p-2 m-0" style="text-align:center">Partially Received</td>
                                    <?php
                                    }else {
                                        ?>
                                    <td colspan='2' class="alert alert-success p-2 m-0" style="text-align:center">All items received completely.</td>
                                    <?php
                                    }
                                    
                                  
                                             }
                                         }
                                        }   
                                         
                                    ?>
                                     </tr>
                              </tbody>
                            </table>
                          <?php
                          }
                        
                        ?>
                
              
                </div>
             </div>
                               <!-- Modal -->
                    <div class="modal fade" id="ordermodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          
                          <div class="farm-color modal-header p-2">
                                <p class="modal-title" id="staticBackdropLabel">Update Good Received Note (GRN): <?php echo $purchase_code; ?></p>
                                <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                        <form id="receivedgood_form" method="post">
                                                <div class="modal-body" id="rece_good_form">
                                              
                                                     <div class="row">
                                                         <div class="col-sm-12">    
                                                             <div class="row my-4">
                                                                <div class="col-sm-12">
                                                                     <div class="success_alert"></div>
                                                                     <div class="warning_alert"></div>
                                                                 </div>
                                                            </div>
                                                             <div class="row">
                                                             
                                          
                                                                  <div class="form-group col-sm-6">
                                                                  
                                                                    <label for="sku_code">SKU Code</label>
                                                                    <select class="form-control" id="sku_code" name="sku_code" lang="<?php echo $member_id; ?>">
                                                                        <option value="">--Select SKU--</option>
                                                                        <?php
                                                                        
                                                                      $sku = $use->supplier_id;
                                                                      $products = Db::getInstance()->query("SELECT *
                                                                      FROM `purchase_order`
                                                                      WHERE purchase_id = $member_id");
                                                                     if (!$products->count()) {
                                                                         
                                                                         echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                                                                         
                                                                     }else{
                                                                       
                                                                                foreach ($products->results() as $prod) {
                                                                         ?>
                                                                    
                                                                      <option value="<?php echo $prod->sku_code; ?>"><?php echo $prod->sku_code; ?></option>
                                                                      
                                                                      <?php
                                                                              }
                                                                     }  
                                                                          ?>
                                                                    </select> 
                                                                    
                                                                  </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="description">SKU Description</label>
                                            <input type="text" class="form-control description" id="description" name="description" readonly/>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="inventory_code">Inventory Code</label>
                                            <input type="text" class="form-control inventory_code" id="inventory_code" name="inventory_code" readonly/>
                                            <input type="hidden" id="inventory_id" name="inventory_id" readonly/>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="inventory_type">Inventory Type</label>
                                            <input type="text" class="form-control inventory_type" id="inventory_type" name="inventory_type" readonly/>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="description">Warehouse</label>
                                            <input type="text" class="form-control warehouse" id="warehouse" name="warehouse" readonly/>
                                            <input type="hidden" id="warehouse_id" name="warehouse_id" />
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="bin_description">Bin</label>
                                            <input type="text" class="form-control bin" id="bin_description" name="bin_description" readonly/>
                                            <input type="hidden" id="bin_id" name="bin_id" readonly/>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="qty">Qty</label>
                                            <input type="number" class="form-control qty" id="qty" name="qty" class="qty" min="0" readonly/>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="received_date">Received Date</label>
                                            <input type="datetime-local" class="form-control" id="received_date" name="received_date" />
                                            
                                          </div>  
                                          
                                          <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $member_id; ?>"  />
                                </div>
                             </div>
                          </div>
                       </div> 
                       
            <div class="modal-footer">
                <button type="button" class="farm-button py-1 ml-0 SaveGood" id="btnsave">
                    <span class="fa fa-save"> Save</span>
                  </button>
                <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
              </div>
                     </form>
               
    </div>
  </div>
</div>
                
                  </div>
                </div>
                 </div>
                <?php
             }
            ?>
                
                
           
            
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
        
     
        $('.resulter').hide();
        $('.resulterError').hide();
         
        $("#sku_code").change(function(e){  
	    const id = $(this).find(":selected").val();
	    const purchase_id= $(this).attr('lang')
	    
    	const dataString = {
            sku_code: id,
            purchase_id : purchase_id
        };
        
		
		$.ajax({
		    
    			type: "POST",
    			url: 'view/purchases/orders/getpurchase_order.php',
    			dataType: 'JSON',
    			data: dataString,
    			cache: false,
    			success: function (response) {
    			     
               
                
                 
                    $(".sku_code").empty();
                    $(".description").empty();
                    $(".qty").empty();
                    $(".inventory_code").empty();
                    $(".inventory_id").empty();
                    $(".warehouse_id").empty();  
                    $(".warehouse_description").empty();
                    $(".bin_id").empty();
                    $(".bin_description").empty();
                
                   
                              
                                let sku_code                = response.sku_code;
                                let description             = response.description;
                                let qty                     = response.qty;
                                let inventory_code          = response.inventory_code;
                                let inventory_id            = response.inventory_id;
                                let warehouse_id            = response.warehouse_id;
                                let warehouse_description   = response.warehouse_description;
                                let bin_id                  = response.bin_id;
                                let bin_description         = response.bin_description;
                          
                                
                                 $('.sku_code').val(sku_code);
                                 $('.description').val(description);
                                 $('.qty').val(qty);
                                 $('.qty').attr("max", qty);
                                 $('.inventory_code').val(inventory_code);
                                 $('.inventory_id').val(inventory_id);
                                 $('.warehouse_id').val(warehouse_id);
                                 $('.warehouse_description').val(warehouse_description);
                                 $('.bin_id').val(bin_id);
                                 $('.bin_description').val(bin_description);
               
                                
                       
    				 	
    		 }
    	});
        		
	

            e.preventDefault(); 
     	}) 
         
         
     	
     	$('.view_invoice').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/view.php",
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
     
    	$('.prev_page').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/index.php",
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
          
       
    	$('.current_page').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/purchases/orders/goodreceived.php",
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



        $('.SaveGood').on('click', function(){
       
                let form = $('#receivedgood_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/purchases/orders/insertgoodreceived.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#btnsave').hide();
                           
                            $("#sku_code").empty();
                            $("#sku_code").remove();
                            $("#received_date").remove();
                            $("#description").remove();
                            $("#qty").remove();
                            $("#rece_good_form").remove();
                           
                            
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
    		            let id =          $(this).attr('id');
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/purchases/orders/delete.php',
                		data: {
                		    tablename   : tablename,
                            id  : id
                		    
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
    	
    	
       event.preventDefault();
   });
   
   
   
   </script>