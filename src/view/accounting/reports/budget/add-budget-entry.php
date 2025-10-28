<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
 
 
                    $budget = Db::getInstance()->query("SELECT a.*, concat(d.firstname, ' ', d.lastname) as registered  
                                                    FROM budget a
                                                    Left join users b on a.added_by = b.id 
                                                    Left Join staff_record d on b.username = d.user_id 
                                                    WHERE a.id = $member_id");
                                                    
                    if (!$budget->count()) {
                        
                        echo "<h4 class='my-5 text-center'>No data to be displayed for budget</h4>";
                        
                      } else {
                        
                        foreach ($budget->results() as $budget) {
                            
                            $budget_code = $budget->budget_code;
                            $budget_id = $budget->id;
                            
                            ?>
  
   <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>
 
    <div class="col-md-9 offset-sm-1">
        <div id="accounttile" class="container">
          

            <div class="jumbotron bg-white">
              
                <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                       <h3>Add New Budget</h3>     
                    </div>
                   <div class="col-md-3">
                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>" >
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                    </div> 
                </div>
        
                   
                <form id="budget_entry_form" method="post">
                  <div class="row">
                      <div class="col-sm-12">
                        
                        <div class="row">
                         
                          <div class="form-group col-sm-6">
                            <label for="itemCategory">Item Category</label>
                            <select class="form-control" id="itemCategory" name="itemCategory">
                              <option value="">--Choose--</option>
                              <?php
                              
                                    $sqlQuery = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types WHERE id in (4,10)");
                                    if (!$sqlQuery->count()) {
                                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                  } else {
                                        foreach ($sqlQuery->results() as $accounttypes) { 
                              ?>
                              <option value="<?php echo $accounttypes->id; ?>"><?php echo $accounttypes->title; ?></option>
                              <?php
                                        }
                                  }
                               
                              ?>
                            </select>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="accounts_type_id">Item Description</label>
                            <select class="form-control" id="chart_of_accounts_group_id" name="chart_of_accounts_group_id">
                            </select>
                          </div>
                          <div class="form-group form-check form-check-inline col-sm-6">
                              <input class="form-check-input" type="checkbox" id="all_months" name="all_months">
                              <label class="form-check-label" for="all_months"style="font-size:0.80rem">Amount is not the same for each month</label></label>
                            </div>
                       
                          <div class="form-group col-sm-6" id="single_amount">
                          <label for="jan">Monthly Amount</label>
                            
                         <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">&#8358;</span>
                          </div>
                          <input type="number" class="form-control" id="month_amount" name="month_amount" placeholder="0" aria-label="amount" aria-describedby="amount">
                        </div>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Note</span>
                          </div>
                          <textarea class="form-control" id="note_month_amount" name="note_month_amount" aria-label="Note"></textarea>
                        </div>
                        </div> 
                        
                          <div class="form-group col-sm-12" id="amount_div">
                              <table class="table table-bordered" style="width:100%">
                                  <thead>
                                    <tr>
                                      <th scope="col" style="width:5%">Month</th>
                                      <th scope="col" style="width:30%">Amount</th>
                                      <th scope="col" style="width:65%">Notes/Assumptions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">Jan</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="jan-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="jan" name="jan" value="January" aria-label="jan-amount" aria-describedby="jan-amount">
                                          <input type="number" class="form-control" id="jan_amount" name="jan_amount" placeholder="0" aria-label="jan-amount" aria-describedby="jan-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="jan_note" name="jan_note" aria-label="jan_note" aria-describedby="jan_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Feb</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="feb-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="feb" name="feb" value="February" aria-label="feb" aria-describedby="feb">
                                          <input type="number" class="form-control" id="feb_amount" name="feb_amount"  placeholder="0" aria-label="feb-amount" aria-describedby="feb-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="feb_note" name="feb_note" aria-label="feb_note" aria-describedby="feb_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Mar</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="mar-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="mar" name="mar" value="March" aria-label="mar" aria-describedby="mar">
                                          <input type="number" class="form-control" id="mar_amount" name="mar_amount"  placeholder="0" aria-label="mar-amount" aria-describedby="mar-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="mar_note" name="mar_note" aria-label="mar_note" aria-describedby="mar_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Apr</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="apr-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="apr" name="apr" value="April" aria-label="apr" aria-describedby="apr">
                                          <input type="number" class="form-control" id="apr_amount" name="apr_amount" placeholder="0" aria-label="apr-amount" aria-describedby="apr-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="apr_note" name="apr_note" aria-label="apr_note" aria-describedby="apr_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">May</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="may-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="may" name="may" value="May" aria-label="may" aria-describedby="may">
                                          <input type="number" class="form-control" id="may_amount" name="may_amount" placeholder="0" aria-label="may-amount" aria-describedby="may-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="may_note" name="may_note" aria-label="may_note" aria-describedby="may_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Jun</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="jun-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="jun" name="jun" value="June" aria-label="jun" aria-describedby="jun">
                                          <input type="number" class="form-control" id="jun_amount" name="jun_amount" placeholder="0" aria-label="jun-amount" aria-describedby="jun-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="jun_note" name="jun_note" aria-label="jun_note" aria-describedby="jun_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Jul</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="jul-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="jul" name="jul" value="July" aria-label="jul" aria-describedby="jul">
                                          <input type="number" class="form-control" id="jul_amount" name="jul_amount" placeholder="0" aria-label="jul-amount" aria-describedby="jul-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="jul_note" name="jul_note" aria-label="jul_note" aria-describedby="jul_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Aug</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="aug-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="aug" name="aug" value="August" aria-label="aug" aria-describedby="aug">
                                          <input type="number" class="form-control" id="aug_amount" name="aug_amount" placeholder="0" aria-label="aug-amount" aria-describedby="aug-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="aug_note" name="aug_note" aria-label="aug_note" aria-describedby="aug_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Sep</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="sep-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="sep" name="sep" value="September" aria-label="sep" aria-describedby="sep">
                                          <input type="number" class="form-control" id="sep_amount" name="sep_amount" placeholder="0" aria-label="sep-amount" aria-describedby="sep-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="sep_note" name="sep_note" aria-label="sep_note" aria-describedby="sep_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Oct</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="oct-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="oct" name="oct" value="October" aria-label="oct" aria-describedby="oct">
                                          <input type="number" class="form-control" id="oct_amount" name="oct_amount" placeholder="0" aria-label="oct-amount" aria-describedby="oct-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="oct_note" name="oct_note" aria-label="oct_note" aria-describedby="oct_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Nov</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="nov-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="nov" name="nov" value="November" aria-label="nov" aria-describedby="nov">
                                          <input type="number" class="form-control" id="nov_amount" name="nov_amount" placeholder="0" aria-label="nov-amount" aria-describedby="nov-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="nov_note" name="nov_note" aria-label="nov_note" aria-describedby="nov_note"></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Dec</th>
                                      <td> <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="dec-addon1">&#8358;</span>
                                          </div>
                                          <input type="hidden" class="form-control" id="dec" name="dec" value="December" aria-label="dec" aria-describedby="dec">
                                          <input type="number" class="form-control" id="dec_amount" name="dec_amount" placeholder="0" aria-label="dec-amount" aria-describedby="dec-amount">
                                        </div></td>
                                      <td><input type="text" class="form-control" id="dec_note" name="dec_note" aria-label="dec_note" aria-describedby="dec_note"></td>
                                    </tr>
                                  </tbody>
                                </table>
                          </div>
                       
                          </div>
                        
                        <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                        <input type="hidden" name="budget_id" id="budget_id" value="<?php echo $budget_id; ?>" />
                       </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                    <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                                    <span class="fa fa-save"> Save</span>
                                                  </button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 prev_page" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                  <div class="row">
                          <div class="col-sm-12 p-2 success_alert"></div>
                          <div class="col-sm-12 p-2 warning_alert"></div>
                      </div>
                  </form>
                 
                  

                </div>
            
            </div>

           
            </div>
      </div>

    </div>
      <?php
        
                             }
                      }
      
      ?>
    
    
  <?php
            
} else {
  $user->logout();
  Redirect::to('../../login/');
}

  ?>
   
 <script>
     
     
     $(document).ready(function(event){
         
        $('#amount_div').hide();
        $('#single_amount').show();
        
         $("#all_months").change(function(){
         // let id = $(this).is(":checked") ? $(this).val() : null;
         
         if ($('#all_months').is(":checked")) {
              // checkbox is checked
              $('#amount_div').show();
              $('#single_amount').hide();
              
            }else{
                
              $('#amount_div').hide();
              $('#single_amount').show();
                 
            }
          
        });
          
	    $('.prev_page').on('click', function (e) {
	
		
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/accounting/reports/budget/editorder.php",
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

        $('.request_approval').click(function (e) {
    		
    		let ed = $(this).attr('lang');
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/reports/budget/request_approval.php",
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
	
       
	
	    $('.SaveStaff').on('click', function(){
            
            let form = $('#budget_entry_form')[0]; // You need to use standard javascript object here
            let formData = new FormData(form); 
             let note_month_amount = $('#note_month_amount').val();
                        let month_amount = $('#month_amount').val();
                       
                        
            //alert(formData);
           
              if ($('#all_months').is(':checked')) {
                        // Checkbox is checked
                         $.ajax({
                 
                        url: 'view/accounting/reports/budget/insert-budget-entry.php',
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
             
             
                    }else{
                        
                       
                        //alert('the amount is ' + month_amount + ' the note is ' +  note_month_amount);
                        
                        
                        $.ajax({
                 
                        url: 'view/accounting/reports/budget/insert-multiple-budget-entry.php',
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
                        
                    }
            
            

        });
	
	    $("#itemCategory").change(function(){
	        
          let id = $(this).find(":selected").val();
          let dataString = 'itemCategory='+ id;
          if (dataString === 'itemCategory=4' || dataString === 'itemCategory=10') {
              
            $.ajax({
              url: 'view/accounting/reports/budget/getGroup.php',
              data: dataString,
              success:function(response){
                  
                $("#chart_of_accounts_group_id").html(response);
                
              }
            });
            
          } else {
              
            $("#chart_of_accounts_group_id").empty();
            
          }
          
        });
        
        
        
 	
         event.preventDefault();
     })
     
     
     
 </script>
