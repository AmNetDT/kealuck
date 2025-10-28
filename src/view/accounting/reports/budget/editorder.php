<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
 
 
                    $budget_entry_use = Db::getInstance()->query("SELECT a.*, concat(d.firstname, ' ', d.lastname) as registered  
                                                    FROM budget a
                                                    Left join users b on a.added_by = b.id 
                                                    Left Join staff_record d on b.username = d.user_id 
                                                    WHERE a.id = '$member_id'");
                                                    
                    if (!$budget_entry_use->count()) {
                        
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                        
                      } else {
                        
                        foreach ($budget_entry_use->results() as $budget_entry_use) {
                            
                            $budget_code = $budget_entry_use->budget_code;
                            $budget_id = $budget_entry_use->id;
                            
                            ?>
  
    <div id="body_general" class="mb-5">
    <div class="container-fluid p-0 mb-5 bg-white">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
        <div id="accounttile" class="container-fluid m-0 bg-white px-2">
            <div class="row m-3 mb-4">
                <div class="col-sm-12">
                    <h3>Budget Manager</h3>
                    <p><?php echo $budget_entry_use->transaction_year; ?> Budget <?php echo $budget_entry_use->description; ?></p>   
                </div>
            </div>
              
                
                <div class="row justify-content-between mx-2">
                    <div class="col-sm-3">
                         <?php
                         
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$budget_code'");     
                                 if($findtax->count()){
                                     foreach ($findtax->results() as $findta) {
                              ?>
                          <button type="button" class="farm-button-disabled py-1 ml-0">
                            <span class="fa fa-save"> Requested</span>
                          </button> 
                          <?php
                                     }
                                  }else{
                                        ?> 
                                        
                          <button type="button" class="farm-button-cancel py-1 ml-0 request_approval" id="<?php echo $member_id; ?>">
                            <span class="fa fa-save"> Request Approval</span>
                          </button>
                          
                          <?php
                                     
                                 }     
                                     ?>
                        
                    </div>
                    <div class="col-sm-4 px-0 mr-0">
                          
                         
                    </div>
                    <div class="col-sm-5 px-0 mr-0 text-right">
            
                     <button type="button" class="farm-button-cancel py-1 ml-0 prev_page">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <?php
                      
                      $modifieddate = $budget_entry_use->modifieddate;
                                            $substring = substr($modifieddate, 0, 7);
                                            $current_year_month = date('Y-mm');
                                            $current_y_m = substr($current_year_month, 0, 7);
                                            
                                            if($budget_entry_use->transaction_year === date('Y') || $substring === $current_y_m){
                                    ?>
                                
                                  <button type="button" class="farm-button py-1 ml-0 add_budget" id="<?php echo $member_id; ?>">
                                    <span class="fa fa-plus-square-o"> Add Budget</span>
                                  </button>
                                    <?php
                                            }
                                            ?>
                      
                      <button type="button" class="farm-button-icon-button py-1 ml-0 editstaff_index" id="<?php echo $member_id; ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                          
                    </div>
               </div>  
                <div class="row justify-content-between px-5 mt-3">
                 <div class="col-sm-4">
                     
                 </div>
                 <div class="col-sm-4">
                      <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Prepare by: </p>
                            <h5 class="mb-0 text-dark"><?php echo $budget_entry_use->registered; ?></h5>
                          </div>
                        </div>
                      </div>
                 </div>
                 <div class="col-sm-4">
                     <div class="card">
                        <div class="card-header p-3 pt-2">
                          <div class="text-end pt-1">
                            
                          </div>
                        </div>
                      </div>
                 </div>
                </div>
                 <div class="row justify-content-between my-2 mx-0 px-0">
                    <div class="col-sm-12">
                     <div class="success_alert"></div>
                     <div class="warning_alert"></div>
                 </div>
              </div>
                <div class="row justify-content-between my-2 mx-0 px-0">
                    
                    <div class="col-sm-12 table-responsive mx-0 px-0" style="height: 120%;">
                 
                    
                
                 <?php
                        
                        
                        try {
                            $result = Db::getInstance()->query("SELECT c.id as budget_entry_id, d.title as item_description, b.month, b.amount, b.budget_id   
                                                      FROM budget a 
                                                      LEFT JOIN budget_month b ON a.id = b.budget_id 
                                                      LEFT JOIN budget_entry c ON b.budget_entry_id = c.id 
                                                      Left JOIN chart_of_accounts_group d ON c.chart_of_accounts_group_id = d.id
                                                      WHERE d.accounts_type_id = 10 AND a.id = $member_id ORDER BY b.id ASC");
                        
                            if (!$result) {
                                throw new Exception("Query failed");
                            }
                        
                            $data = array();
                            $budgetEntryIds = array(); // Store budget_entry_ids in this array
                          
                          
                            if (!$result->count()) {
                                echo "No data to be displayed";
                            } else {
                                foreach ($result->results() as $row) {
                                    $data[$row->item_description][$row->month] = $row->amount;
                                    $budgetEntryIds[$row->item_description] = $row->budget_entry_id; // Store budget_entry_id
                                }
                            }
                                
                        
                            // Print the data in an HTML table
                            echo '<table class="table-hover table-bordered" style="width:100%; font-size:0.75em">';
                            echo "<thead>
                            <tr><th></th>
                            <th class='px-2'>January</th>
                            <th class='px-2'>February</th>
                            <th class='px-2'>March</th>
                            <th class='px-2'>April</th>
                            <th class='px-2'>May</th>
                            <th class='px-2'>June</th>
                            <th class='px-2'>July</th>
                            <th class='px-2'>August</th>
                            <th class='px-2'>September</th>
                            <th class='px-2'>October</th>
                            <th class='px-2'>November</th>
                            <th class='px-2'>December</th>
                            <th class='px-2 font-weight-bold'>Total</th>
                            </tr></thead><tbody>
                            <tr><td class='px-2 font-weight-bold'>Income</td><td colspan='13'></td></tr>
                            ";
                            foreach ($data as $item_description => $months) {
                                // Calculate the total for the current row using array_sum()
                                $totalCost = array_sum($months);
                                
                                echo "<tr class='row-month'>
                                <td class='px-2'>$item_description</td>";
                                
                                foreach ($months as $month => $amount) {
                                    // Format the total cost to two decimal places and display it
                                    $numbInCommaFormatamount = number_format($amount, 2);
                                    echo "<td class='text-right px-2 monthlyCost'>$numbInCommaFormatamount</td>";
                                }
                                
                                // Display the calculated total in the totalCostPerMonth column
                                $numberInCommaFormatamount = number_format($totalCost, 2);
                                echo "<td class='px-0 text-right font-weight-bold totalCostPerMonth1'>$numberInCommaFormatamount</td>";
                                
                                echo "<td class='px-0'>
                                <div class='dropdown pt-0'>
                                  
                                <button class='btn btn-group dropright' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-expanded='false'>
                                  <i style='font-size:14px' class='fa'>&#xf142;</i>
                                </button>
                                <div class='dropdown-menu my-0'>";
                                    
                                    $modifieddate = $budget_entry_use->modifieddate;
                                    $substring = substr($modifieddate, 0, 7);
                                    $current_year_month = date('Y-mm');
                                    $current_y_m = substr($current_year_month, 0, 7);
                                    
                                    if($budget_entry_use->transaction_year === date('Y') || $substring === $current_y_m){
                                        echo "<div class='budget_update' id='". $member_id ."' title='" . $budgetEntryIds[$item_description] . "'> 
                                            <button class='dropdown-item py-2 my-1'>
                                                 <i class='fa fa-search'></i>&nbsp; View/Edit</button>
                                                 </div>
                                                 <div class='dropdown-divider'></div>
                                            <div class='budget_delete' id='". $budgetEntryIds[$item_description] . "'> 
                                            <button class='dropdown-item py-2 my-1'>
                                                 <i class='fa fa-trash'></i>&nbsp; Delete</button>
                                                 </div>";
                                    }
                                    
                                echo "</div>
                              </div>
                            </td> 
                            </tr>";
                            }
                            echo "<tr class='bg-light total-row-month'>";
                            foreach ($data as $item_description => $months) {
                                foreach ($months as $month => $amount) {
                                    if (!isset($totalMonthlyIncome[$month])) {
                                        $totalMonthlyIncome[$month] = 0;
                                    }
                                    $totalMonthlyIncome[$month] += $amount;
                                }
                            }
                           
                        echo "<tr class='bg-light total-row-month'><td class='px-2 font-weight-bold'>Total Income</td>";
                        $totalIncomeSum = 0;
                        foreach ($totalMonthlyIncome as $month => $amount) {
                            $numbInCommaFormatamount = number_format($amount, 2);
                            echo "<td class='text-right px-2 monthlyCost'>$numbInCommaFormatamount</td>";
                            $totalIncomeSum += $amount;
                        }
                        $numbInCommaFormatTotal = number_format($totalIncomeSum, 2);
                        echo "<td class='px-0 text-right font-weight-bold totalCostPerMonth1'>$numbInCommaFormatTotal</td>";
                        echo "</tr>";
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                        
                        
                        try {
                             $result = Db::getInstance()->query("SELECT c.id as budget_entry_id, d.title as item_description, b.month, b.amount, b.budget_id   
                                                      FROM budget a 
                                                      LEFT JOIN budget_month b ON a.id = b.budget_id 
                                                      LEFT JOIN budget_entry c ON b.budget_entry_id = c.id 
                                                      Left JOIN chart_of_accounts_group d ON c.chart_of_accounts_group_id = d.id
                                                      WHERE d.accounts_type_id = 4 AND a.id = $member_id ORDER BY b.id ASC");
                        
                            if (!$result) {
                                throw new Exception("Query failed");
                            }
                        
                            $data = array();
                            $budgetEntryIds = array(); // Store budget_entry_ids in this array
                            
                            if (!$result->count()) {
                                echo "No data to be displayed";
                            } else {
                                foreach ($result->results() as $row) {
                                    $data[$row->item_description][$row->month] = $row->amount;
                                    $budgetEntryIds[$row->item_description] = $row->budget_entry_id; // Store budget_entry_id
                                }
                            }
                                
                        
                            // Print the data in an HTML table
                            echo "<tr><td class='py-3 colspan='14'></td></tr>";
                            echo "<tr><td colspan='14' class='px-2 font-weight-bold'>Expense</td></tr>";
                            foreach ($data as $item_description => $months) {
                                // Calculate the total for the current row using array_sum()
                                $totalCost = array_sum($months);
                                
                                echo "<tr><td class='px-2'>$item_description</td>";
                                
                                foreach ($months as $month => $amount) {
                                     $numbInCommaFormat = number_format($amount, 2);
                                    echo "<td class='text-right px-2 monthlyCost'>$numbInCommaFormat</td>";
                                }
                                
                                // Display the calculated total in the totalCostPerMonth column
                                $numberInCommaFormat = number_format($totalCost, 2);
                                echo "<td class='px-0 text-right font-weight-bold totalCostPerMonth2'>$numberInCommaFormat</td>";
                                            echo "<td class='px-0'>
                                            <div class='dropdown pt-0'>
                                           
                                            <button class='btn btn-group dropright' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-expanded='false'>
                                              <i style='font-size:14px' class='fa'>&#xf142;</i>
                                            </button>
                                            <div class='dropdown-menu my-0'>";
                                    
                                
                                            $modifieddate = $budget_entry_use->modifieddate;
                                            $substring = substr($modifieddate, 0, 7);
                                            $current_year_month = date('Y-mm');
                                            $current_y_m = substr($current_year_month, 0, 7);
                                            
                                            if($budget_entry_use->transaction_year === date('Y') || $substring === $current_y_m){
                                    
                                
                                               echo "<div class='budget_update' id='". $member_id ."' title='" . $budgetEntryIds[$item_description] . "'> 
                                                    <button class='dropdown-item py-2 my-1'>
                                                         <i class='fa fa-search'></i>&nbsp; View/Edit</button>
                                                         </div>
                                                         <div class='dropdown-divider'></div>
                                                    <div class='budget_delete' id='". $budgetEntryIds[$item_description] . "'> 
                                                    <button class='dropdown-item py-2 my-1'>
                                                         <i class='fa fa-trash'></i>&nbsp; Delete</button>
                                                         </div>";
                                    
                                            }
                                            
                                            
                                  echo "</div>
                              </div>
                            </td></tr>";
                            }
                            echo "<tr class='bg-light total-row-month'>";
                                            foreach ($data as $item_description => $months) {
                                                foreach ($months as $month => $amount) {
                                                    if (!isset($totalMonthlyExpense[$month])) {
                                                        $totalMonthlyExpense[$month] = 0;
                                                    }
                                                    $totalMonthlyExpense[$month] += $amount;
                                                }
                                            }
                                           echo "<tr class='bg-light total-row-month'><td class='px-2 font-weight-bold'>Total Expense</td>";
                                            $totalExpenseSum = 0;
                                            foreach ($totalMonthlyExpense as $month => $amount) {
                                                $numbInCommaFormatamount = number_format($amount, 2);
                                                echo "<td class='text-right px-2 monthlyCost'>$numbInCommaFormatamount</td>";
                                                $totalExpenseSum += $amount;
                                            }
                                            $numbInCommaFormatTotal = number_format($totalExpenseSum, 2);
                                            echo "<td class='px-0 text-right font-weight-bold totalCostPerMonth2'>$numbInCommaFormatTotal</td>";
                                            echo "</tr>";
                                                                                       echo "<tr class='font-weight-bold'>";
                                            echo "<td id='netProfit' class='px-2'>Net Profit</td>";
                                            $totalNetProfit = 0;
                                            for ($i = 1; $i <= 12; $i++) {
                                                $month = date('F', mktime(0, 0, 0, $i, 1));
                                                $netProfit = $totalMonthlyIncome[$month] - $totalMonthlyExpense[$month];
                                                $numbInCommaFormat = number_format($netProfit, 2);
                                                echo "<td class='text-right px-2 monthlyCost'>$numbInCommaFormat</td>";
                                                $totalNetProfit += $netProfit;
                                            }
                                            $numbInCommaFormatTotal = number_format($totalNetProfit, 2);
                                            echo "<td class='px-0 text-right font-weight-bold totalCostPerMonth'>$numbInCommaFormatTotal</td>";
                                            echo "</tr>
                                            </tbody></table>";
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                               
                                                
                     
                
                ?>
                  
                </div>
             
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
  $budget_entry_use->logout();
  Redirect::to('../../login/');
}

  ?>
   
 <script>
     
     
     $(document).ready(function(event){
         
          
	    $('.prev_page').on('click', function (e) {
	
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/accounting/reports/budget/",
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
	
        $('.editstaff_index').click(function (e) {
	
		let member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			data: {
			    'member_id' : member_id
			},
			url: "view/accounting/reports/budget/editorder.php",  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	}); 
	
	   
	    
	    $('.add_budget').on('click', function (e) {
	
		let member_id = $(this).attr('id');
		
		//alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/accounting/reports/budget/add-budget-entry.php",
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
	
        $('.budget_update').click(function (e) {
        		
        	    let member_id       = $(this).attr('id');
        		let budget_entry_id = $(this).attr('title');
                
                   // alert(budget_entry_id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/accounting/reports/budget/edit-budget-entry.php",
        			data:{
        			   
        			    member_id : member_id,
        			    budget_entry_id : budget_entry_id
        			    
        			},
        			cache: false,
        			success: function (msg) {
        				$("#contentbar_inner").html(msg);
        				$("#loader_httpFeed").hide();
        			}
        		});
        		e.preventDefault();
        	}); 
        	 
        $('.budget_delete').click(function (e) {
        		
        	  
        		let budget_entry_id = $(this).attr('id');
                
                //alert(budget_entry_id);
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/accounting/reports/budget/delete.php",
        			data:{
        			  
        			    budget_entry_id : budget_entry_id
        			    
        			},
        			cache: false,
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
 	
         event.preventDefault();
     })
     
 </script>
