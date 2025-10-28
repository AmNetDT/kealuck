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
          <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Order Voucher</h3>
            </div>
                <div class="row justify-content-between mt-4 mb-3">
                   
                   <div class="col-sm-9">
                      
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
                      
                  
                    <div class="col-sm-3 text-right">
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal">
                        <span class="fa fa-plus"> Add Order Voucher</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page" >
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              
                
                 <div id="utility"></div>
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
        <form id="voucherInsert" method="POST" autocomplete="off">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Order Voucher</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
              
              
              
              <div class="row">
                <div class="col-sm-12">
                    
                  <div class="row">
                <div class="col-sm-12">
                    <div class="success_alert" id="success_alert"></div>
                    <div class="warning_alert" id="warning_alert"></div>
                 </div>   
                  </div>
                  
                 
                    <div class="row">
                      
                     
                      <div class="form-group col-6">
                            <label for="order_voucher_code">Order Voucher Code</label>
                            <input type="text" id="order_voucher_code" name="order_voucher_code" class="form-control" value="ORV<?php echo mt_rand(1000,9999); ?>" class="form-control" readonly />
                          </div>
                         <div class="form-group col-6">
                            <label for="customer_code">Customer Code</label>
                            <input type="text" id="customer_code" name="customer_code" class="form-control" class="form-control"  />
                          </div>
                  
                      
                      </div>
                    <input type="hidden" id="prepared" name="prepared" value="<?php echo $username; ?>" />
                    
                
              </div>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
        <span class="fa fa-save"> Save</span></button>
         <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal">Close</button>
      </div>
        </div>
      </form>
    </div>
  </div>

  <!-- End Create Dept Type Modal !-->
 
  <script>
  	function showVoucher(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/sales/order-voucher/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#utility").html(html);
                $('#sload').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showVoucher(10, 1);
    });
    
 </script>
  <script>
   $(document).ready(function(event) {
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
        $('.SaveStaff').on('click', function(){
       
                let form = $('#voucherInsert')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/sales/order-voucher/insertUtilities.php',
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
       
      
      	$('.current_page').click(function (e) {
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/sales/order-voucher/",
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
    	    
            let transaction_year = $('#inputTransaction_year').val(); 
    	
            	//alert('welcome')
    
            $.ajax({
                type: "GET",
                url: "view/sales/order-voucher/select.php",
               
    			data: {
    			    
    			    transaction_year : transaction_year
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#utility").html(html);
                    $('#sload').html(''); 
                }
            });
            
            
             evt.preventDefault();
            
          
          });
 
   
   
   event.preventDefault();
   });
  </script>
  

  