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
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Payroll</h3>
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
                    <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#createPayroll">
                        <span class="fa fa-plus"> Create Payroll</span>
                      </button>
                    <button class="farm-button-cancel py-1 ml-0" id="add_button" data-toggle="modal" data-target="#removePayroll">
                        <span class="fa fa-trash"> Remove Staff Payroll</span>
                      </button>
                      <button type="button" class="farm-button-icon-button py-1 ml-0 current_page">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div>
                    
                </div>
            
                <div id="payrollview"></div>
                <div id="pload"></div> 
            
      
             
      </div>
    </div>
  </div>
<div id="createPayroll" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-md">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Create Payroll</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
              <form id="staff_to_payroll_form" method="post">
            
                    <div class="modal-body pt-0">
                      <div class="row">
                        <div class="col-sm-12">
                                
                            <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                  <input type="month" class="form-control" id="transaction_year_month" name="transaction_year_month">
                                  <label for="transaction_year_month" class="py-2">
                                    Select Month
                                  </label>
                                  
                                  <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                </div>
                             </div>
                         </div>
                    </div>
                  </div>
                    
                  <div class="modal-footer">
                    <button type="button" class="py-1 px-2 border farm-color mx-0 savestaff_to_payroll">Add</button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" aria-label="Close">Close</button>
                  
                  </div>
          </form>
        </div>
    </div>
  </div>
  
<div id="removePayroll" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-md">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Remove Staff from Payroll</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                  </div>
                <form id="removestaff_to_payroll_form" method="post">
            
                    <div class="modal-body pt-0">
                      <div class="row">
                        <div class="col-sm-12">
                                
                            <div class="row my-3">
                                 <div class="form-group col-sm-12">
                                <label for="removestaff" class="py-2">
                                   Search
                                  </label>
                                  <input type="text" class="form-control" id="removestaff" name="removestaff" placeholder="Type the Staff Code, e.g ES-011-01" />
                                  <input type="hidden" class="form-control" id="_id" name="_id" />
                                  
                                </div>
                             </div>
                             <div class="row my-3">
                                 <div class="alert alert-success col-sm-12" id="alert_resu">
                                     <p id="resu"></p>
                                 </div>
                                 <div class="alert alert-danger col-sm-12" id="resu_alert">
                                     <p id="paraID"></p>
                                </div>
                             </div>
                         </div>
                        </div>
                  </div>
                    
                  <div class="modal-footer">
                      
                    <button type="button" class="py-1 px-2 border alert-danger mx-0 removestaff_to_payroll">Remove</button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" aria-label="Close">Close</button>
                  
                  </div>
                </form>
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
  
   function showPayroll(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/usermanager/payroll/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#pload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#payrollview").html(html);
                $('#pload').html(''); 
            }
        });
    }
    
   $(document).ready(function(event) {
        showPayroll(4, 1);
        
        
        
        
        $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val(); 
		    
            let transaction_year_month = $('#inputTransaction_year').val(); 
    	
	        	//alert('welcome')
	
            $.ajax({
                type: "GET",
                url: "view/usermanager/payroll/select.php",
               
    			data: {
    			    
    			    transaction_year_month: transaction_year_month
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#payrollview").html(html);
                    $('#pload').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
      
      });
            
        $('.current_page').click(function (e) {
    		
    	
    		//alert(id)
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/usermanager/payroll/index.php",
    		
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});
    	
    	$('.savestaff_to_payroll').on('click', function(e){
    	     
    	     //let transaction_year_month = $('#transaction_year_month').val();
    	     
        
                    let form = $('#staff_to_payroll_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                  // alert(transaction_year_month);
                   
        		
        		$.ajax({
        				url: 'view/usermanager/payroll/insert.php',
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
                        
               e.preventDefault();
        });
        
        $('.removestaff_to_payroll').on('click', function(e){
    	     
    	     //let transaction_year_month = $('#transaction_year_month').val();
    	     
        
                    let form = $('#removestaff_to_payroll_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
                   
                  // alert(transaction_year_month);
                   
        		
        		$.ajax({
        				url: 'view/usermanager/payroll/delete.php',
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
                        
               e.preventDefault();
        });
       
        $("#alert_resu").hide();
        $(".removestaff_to_payroll").hide();
        $("#resu_alert").hide();
        
        
        $("#removestaff").change(function(){  
	    let id = $("#removestaff").val();
		let dataString = 'removestaff='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/usermanager/payroll/getstaff.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			success:function(response){
              // alert(response.user_id) 
               	 let len = response.length;
                
                
                     
                    $("#alert_resu").hide();
                    $(".removestaff_to_payroll").hide();
                    $("#resu_alert").hide();
                    $("#resu").empty();
                    $("#user_id").empty();
                    $("#_id").empty();
                
                
                    for( let i = 0; i<len; i++){
                   
                   
                    let firstname           = response[i]['firstname']
                    let othername           = response[i]['othername']
                    let lastname            = response[i]['lastname']
                    let user_id             = response[i]['user_id']
                    let _id                 = response[i]['_id']
                    
                    let resu = user_id + ', ' + firstname + ' ' + othername + ' ' + lastname
                    
                  
                 // alert(resu)
                  if(resu !=+ ''){
                      
                      $("#alert_resu").show();
                      $(".removestaff_to_payroll").show();
                      $('#resu').append(resu);
                      $('#_id').val(_id);
                      
                  }else{
                      
                      $("#alert_resu").hide();
                      $(".removestaff_to_payroll").hide();
                      $('#resu_alert').show();
                      $('#paraID').append('Not Available');
                    }
                  }
    				 
    			} 
    		});

     	}); 
   
        event.preventDefault();
   });
   
  </script>
  

  