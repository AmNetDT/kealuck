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
                <div id="accounttile" class="col-sm-12">
         <?php


            $users = Db::getInstance()->query("SELECT a.*, b.username, c.*, e.supplier_id
                  FROM workorders a 
                  left join workorders_orders c on a.id = c.workorders_id
                  left join purchases e on c.purchase_id = e.id
                  Left join users b on a.added_by = b.id 
                  Left join staff_record d on b.username = d.user_id
                  WHERE a.id = $member_id");
                  
            foreach ($users->results() as $use) {
                
                $purchase_code = $use->purchase_code;
                                        
                             
            ?>
              <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Sales Stock Received Note (SSRN): <?php echo $purchase_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                      
                    </div> 
                </div>
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9 pl-5 mr-0">
                        
                </div>
                    <div class="col-sm-3 mr-0">
        
                      <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>">
                        <span class="fa fa-chevron-left"></span>
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

                  $user = Db::getInstance()->query("SELECT a.*, concat(d.firstname, ' ', d.lastname) as registered   
                  FROM sales_stocks_received a
                  Left join users b on a.added_by = b.id 
                  Left Join staff_record d on b.username = d.user_id
                  WHERE workorders_id = $member_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
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
                                          
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control description" id="descri" disabled/>
                                            <input type="hidden" id="description" name="description" class="form-control description" />
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="qty">Qty</label>
                                            <input type="number" class="form-control qty" id="qty" name="qty" class="qty" min="0" />
                                            
                                         
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
    			url: 'view/manufacturing/operations/getpurchase_order.php',
    			dataType: 'JSON',
    			data: dataString,
    			cache: false,
    			success: function (response) {
    			     
               
                
                 
                    $(".sku_code").empty();
                    $(".description").empty();
                    $(".qty").empty();
                
                   
                              
                                let sku_code    = response.sku_code;
                                let description = response.description;
                                let qty         = response.qty;
                          
                                
                                 $('.sku_code').val(sku_code);
                                 $('.description').val(description);
                                 $('.qty').val(qty);
                                 $('.qty').attr("max", qty);
               
                                
                       
    				 	
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
    		
    		let member_id = $(this).attr('id');
    		
    		//alert(member_id)
    		
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
          
       
    	$('.current_page').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/manufacturing/operations/sales_stocks_received.php",
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
        				url: 'view/manufacturing/operations/insertgoodreceived.php',
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
        				url: 'view/manufacturing/operations/delete.php',
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