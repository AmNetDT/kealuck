<?php

require_once '../../core/init.php';


$member_id = $_POST['member_id'];
$budget_entry_id = $_POST['budget_entry_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
 
 
                  
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
                       <h3>Update Budget</h3>     
                    </div>
                   <div class="col-md-3">
                      <button class="farm-button-cancel py-1 ml-0 prev_page" id="<?php echo $member_id; ?>" >
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                    </div> 
                </div>
                <?php
                
                // Retrieve all monthly budget data for the given entry ID in one query
                    $budgetMonthsData = Db::getInstance()->query("SELECT bm.id, bm.month, bm.amount, bm.note FROM budget_month bm WHERE bm.budget_entry_id = $budget_entry_id");
                    $monthlyData = [];
                    if ($budgetMonthsData->count()) {
                        foreach ($budgetMonthsData->results() as $row) {
                            $monthlyData[$row->month] = ['id' => $row->id, 'amount' => $row->amount, 'note' => $row->note];
                        }
                    }
                    
                    $months = array(
                        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 
                        6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 
                        11 => 'November', 12 => 'December'
                    );
                    ?>
                   
                <form id="budget_entry_form" method="post">
                 <div class="form-group col-sm-12" id="amount_div">
        <table class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" style="width:5%">Month</th>
                    <th scope="col" style="width:25%">Amount</th>
                    <th scope="col" style="width:45%">Notes/Assumptions</th>
                    <th scope="col" style="width:25%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($months as $monthNumber => $monthName) {
                    $data = isset($monthlyData[$monthName]) ? $monthlyData[$monthName] : ['id' => '', 'amount' => 0, 'note' => ''];
                    $month_id = $data['id'];
                    ?>
                    
                    <tr data-month-id="<?php echo $month_id; ?>">
                        <th scope="row"><?php echo $monthName; ?></th>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₦</span>
                                </div>
                                <input type="number" class="form-control" name="amount" value="<?php echo $data['amount']; ?>">
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="note" value="<?php echo $data['note']; ?>">
                        </td>
                        <td>
                            <?php if ($month_id) : ?>
                            <button type="button" class="py-1 px-2 farm-button text-white mx-0 update-single-month" data-month-id="<?php echo $month_id; ?>">
                                    Update
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
                  <div class="row">
                      <div class="col-sm-12">
                  
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 prev_page" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                  </form>
                 
                  
                </div>
            
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
     
    $(document).on('click', '.update-single-month', function() {
    let button = $(this);
    let row = button.closest('tr'); // Find the parent row
    let month_id = button.data('month-id'); // Get month ID from the button
    //alert(month_id);

    let amount = row.find('input[name="amount"]').val();
    let note = row.find('input[name="note"]').val();

    let formData = {
        'month_id': month_id,
        'amount': amount,
        'note': note
    };

    // Show a loading state
    button.prop('disabled', true).text('Updating...');

    $.ajax({
        type: 'POST',
        url: 'view/accounting/reports/budget/update-budget-entry.php',
        data: formData,
        success: function(response) {
            // Check for success message from PHP script
            if (response.trim() === 'success') {
                
                button.text('Updated').addClass('btn-success').removeClass('btn-primary');
                
            } else {
                
                button.text('Failed').addClass('btn-danger').removeClass('btn-primary');
                
            }
        },
        error: function() {
            
            button.text('Error').addClass('btn-danger').removeClass('btn-primary');
            
        },
        complete: function() {
            // Re-enable the button after a delay
            setTimeout(function() {
                
                button.text('Update').removeClass('btn-success btn-danger').addClass('btn-primary').prop('disabled', false);
                
            }, 3000);
        }
    });
});
     
 </script>
