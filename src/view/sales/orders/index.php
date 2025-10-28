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
          <h3>Sales Order</h3>
          </div>
          <div class="row my-3">
              <div class="col-sm-12">
                <div class="row justify-content-between">
                   <div class="col-sm-11"> 
                   
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
                    <div class="col-sm-1">
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  </div>
                  
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
   $(document).ready(function(evt) {
       $('.success_alert').hide();
       $('.warning_alert').hide();
       
       
        $('.SaveStaff').on('click', function(){
            
            let form = $('form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
            
            //alert(formData);
            
             $.ajax({
                 
                        url: 'view/sales/orders/insert.php',
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
   evt.preventDefault();
   });
       
   
  
  </script>
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/sales/orders/select.php",
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
       
       	$("#state_id").change(function(){  
	    var id = $(this).find(":selected").val();
		var dataString = 'state_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/sales/getlga.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
                
                var len = response.length;

                $("#lga_id").empty();
                
                    for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                
                    $("#lga_id").append("<option value='"+id+"'>"+name+"</option>");
                }
				 	
			} 
		});
 	}) 
 	
    	$('.editstaff_index').click(function () {
		
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/sales/orders/",  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
	});   
 
        
    $('#inputTransaction_year').change(function(evt){ 
                
        let id = $(this).find(":selected").val(); 
	    
        let transaction_year = $('#inputTransaction_year').val(); 
	
        	//alert('welcome')

        $.ajax({
            type: "GET",
            url: "view/sales/orders/select.php",
           
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
  

