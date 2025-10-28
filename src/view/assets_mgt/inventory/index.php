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
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
            <div class="row m-3 mb-4">
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Inventory</h3>
            </div>
            <div class="col-sm-12">
                <div class="row justify-content-end mb-4">
                    
                   <div class="col-sm-8">
                      
                      </div>
                      
                  
                    <div class="col-sm-4">
                      
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
                </div>
              </div>
              
                
            <div id="workview"></div>
               <div id="wload"></div> 
      
      
             
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
   function showWorkLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/assets_mgt/inventory/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#wload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#workview").html(html);
                $('#wload').html(''); 
            }
        });
    }
    
    function showLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/assets_mgt/inventory/selectlocationtype.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#locationview").html(html);
                $('#load').html(''); 
            }
        });
    }
    
   $(document).ready(function(event) {
        showWorkLocation(4, 1);
        showLocation(4, 1);
        
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
         $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val(); 
		    
            let member_id = $('#inputTransaction_year').val(); 
    	
	        	//alert('welcome')
	
            $.ajax({
                type: "GET",
                url: "view/assets_mgt/inventory/select.php",
                //dataType: 'json',
    			data: {
    			    
    			    member_id: member_id
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#workview").html(html);
                    $('#wload').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
      
       });
            
       
   
   event.preventDefault();
   });
  </script>
  

  