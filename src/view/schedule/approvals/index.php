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
          
            <div class="row mb-0">
          <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Approval Records</h3>
            </div>
          
                <div class="row justify-content-between">
                    <div class="col-sm-6">
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
                    <div class="col-sm-6 text-right">
                      <button class="farm-button-cancel py-1 ml-0 index_view" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current">
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
  Redirect::to('../login/');
}


?>

 
  <script>
  	function showStocks(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/schedule/approvals/select.php",
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
        
       
     	$('.index_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/schedule/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
       
    	$('.current').click(function (e) {
		
		let id = $(this).attr('id');
	
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/schedule/approvals/",
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
		    
            let transaction_year_month = $('#inputTransaction_year').val(); 
    	
	        	//alert(transaction_year_month)
	
            $.ajax({
                type: "GET",
                url: "view/schedule/approvals/select.php",
    			data: {
    			    
    			    transaction_year_month: transaction_year_month
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#sku").html(html);
                    $('#sload').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
      
      });
            
    
    
 
   
   event.preventDefault();
   });
  </script>
  

  