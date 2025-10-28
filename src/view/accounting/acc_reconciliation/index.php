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
          <h3>Account Reconciliation</h3>
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
 
 
 
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/accounting/acc_reconciliation/select.php",
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
        
        
	
    $('#inputTransaction_year').change(function(evt){ 
                
        let transaction_year = $(this).find(":selected").val(); 
	    
	

        $.ajax({
            type: "GET",
            url: "view/accounting/acc_reconciliation/select.php",
           
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
 
    });
    
    
 </script>
  
  

