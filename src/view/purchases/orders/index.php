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
          <h3>Purchase Orders</h3>
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
                      <!-- Button trigger modal -->
                      <button class="farm-button py-1 ml-0" data-toggle="modal" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Add Purchase</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  </div>
                 

              

              <div id="userr"></div>
               <div id="load"></div>
            </div>
          </div>
      </div>


  <?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
 
 
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Purchase</p>
            <button type="button" class="bg-secondary px-2 border text-white editstaff_index" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
    <form id="purchase_order_form" method="post">
      <div class="modal-body">
          <div class="row">
              <diiv class="col-sm-12 p-2 success_alert"></diiv>
              <diiv class="col-sm-12 p-2 alert alert-warning warning_alert"></diiv>
          </div>
        <div class="row">
             
              <div class="form-group col-sm-6">
              <?php $Rahma = mt_rand(1000,9999); ?>
                <label for="purchase_code">Purchase Code</label>
                <input type="text" id="purchase_code" name="purchase_code" class="form-control" value="PUR<?php echo $Rahma; ?>" readonly />
              </div>
              <div class="form-group col-sm-6">
              
                <label for="date_time">Date &amp; Time</label>
                <input type="datetime-local" id="date_time" name="date_time" class="form-control" />
                
              </div>
            </div>
           
            <div class="row"> 
              <div class="form-group col-sm-6">
              
                <label for="type">Purchase Type</label>
                <input type="text" class="form-control" value="Standard - Purchase Order" disabled/>
                <input type="hidden" id="type" name="type" class="form-control" value="Standard - Purchase Order" />
                
              </div>
              <div class="form-group col-sm-6">
              
                <label for="expecteddate">Expected Date</label>
                <input type="datetime-local" class="form-control" id="expecteddate" name="expecteddate" />
                
             
              </div>
              <div class="form-group col-sm-6">
              
                <label for="supplier_id">Supplier Code</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                    <option value="">-- Select Supplier Code --</option>
                    <?php
                      $products = Db::getInstance()->query("SELECT * FROM `suppliers`");
                         if (!$products->count()) {
                             
                             echo '<h4 class="text-center my-5 py-5">No data to be displayed</h4>';
                             
                         }else{
                           
                                    foreach ($products->results() as $prod) {
                             ?>
                
                  <option value="<?php echo $prod->id; ?>"><?php echo $prod->supplier_code . ' ' . $prod->name; ?></option>
                  <?php
                          }
                                                             }
                      ?>
                </select>
              </div>  
              <div class="form-group col-sm-12">
                <label for="expecteddate">Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier"disabled />
                
              </div>
              
            </div>
            <div class="row">  
              <div class="form-group col-sm-12">
              
                <label for="note">Note</label>
                <textarea class="form-control" id="note" name="note"></textarea>
                
              </div>
            </div>
            
             <?php
                                
                                 $transact_yr = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
                                    foreach($transact_yr->results() as $transact_yr){
                            
                                ?>
                                <input type="hidden" name="transaction_year" value="<?php echo $transact_yr->year; ?>" />
                                    <?php
                                            }
                                        ?>
            <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
           
      </div>
      <div class="modal-footer">
        <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" data-dismiss="modal">Close</button>
      </div>
       </form>
       
    </div>
  </div>
</div>
  
  
  
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/purchases/orders/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showUsers(10, 1);
    });
 </script>
   
  <script>
   $(document).ready(function(event) {
       
       $('.success_alert').hide();
       $('.warning_alert').hide();
       
       
    $('.SaveStaff').on('click', function(){
            
            let form = $('#purchase_order_form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/purchases/orders/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $('#load').html(''); 
                              setTimeout(function(){// wait for 5 secs(2)
                                  $(document).ready(function() {
                                    showUsers(10, 1);
                                }); // then reload the page.(3)
                              }, 100); 
                              
                        },
                        error:function(data){
                            
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                            
                        }

             });

        });
    
   
    $("#supplier_id").change(function(){  
	    let id = $(this).find(":selected").val();
		let dataString = 'supplier_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/purchases/orders/getsupplier.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                let len = response.length;

                //$("#product_id").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let name = response[i]['name'];
                    
                  
                   $('#supplier').val(name);
                    //alert(description);
                
                }
				 	
			} 
		});
 	}) 
       
 	
    $('.editstaff_index').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/purchases/orders/",  
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
            url: "view/purchases/orders/select.php",
           
			data: {
			    
			    transaction_year : transaction_year
			},
            cache: false,
    		beforeSend: function() {
    		    
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
        
        
         evt.preventDefault();
        
      
      });
 
   
   event.preventDefault();
   });
  </script>
  

