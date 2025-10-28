<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
$transaction_year = $_POST['transaction_year']; 
//echo $member_id;

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
                <div id="accounttile2" class="col-sm-12">
       
                 <div class="row justify-content-between m-3">
                <div class="col-sm-8">
                           <div class="col-sm-12 success_alert mr-0">
                               <?php
                                        
                                        $chart_of_accounts = Db::getInstance()->query("SELECT * FROM chart_of_accounts WHERE id = $member_id");
                                        foreach ($chart_of_accounts->results() as $chart_of_accounts) {
                                            echo $chart_of_accounts->description ." (" .$chart_of_accounts->gl_code . ")";
                                        }
                               ?>
                           </div>
                  </div>
                    <div class="col-sm-4" >
                    <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button> 
                      
                    </div>
                </div>
                <div class="row m-3 justify-content-between">
                     
                           
                      <div class="col-sm-12">
                          <div class="row justify-content-between my-5">
                              <div class="card col-12" style="border-left:solid 1px #222222">
                                  <div class="card-header">
                                      <div class="col-11">
                                        Journal Entry
                                    </div>
                                      <div class="col-1 text-right">
                                          
                                      </div>
                                  </div>
                                  <div class="card-body">
                                      
                                      <?php
                                   

                  $user = Db::getInstance()->query("SELECT  b.journal_code, b.date_time, b.description, a.reference_no, a.due_date, a.debit, a.credit
				  FROM journal_entry a
                  left join journal b on a.journal_id = b.id 
                  left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                  WHERE a.subsidiary_ledger_id = $member_id
                  AND b.transaction_year = '$transaction_year'");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th></th>
                          <th>Date</th>
                          <th>Journal Vourcher</th>
                          <th style="width:30%">Description</th>
                          <th>Reference No</td>
                          <th>Due Date</td>
                          <th>Debit</th>
                          <th>Credit</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody> 
                        <?php
                        $i = 1;   
                        foreach ($user->results() as $user) {
                          
                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->date_time; ?></td>
                            <td><?php echo $user->journal_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->reference_no; ?></td>
                            <td><?php echo $user->due_date; ?></td>
                            <td class="text-right"><?php if($user->debit != '0.00'){$debit = $user->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit;}else{ ?><span class="text-secondary"><?php $debit = $user->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit; } ?></span></td>
                            <td class="text-right"><?php if($user->credit != '0.00'){$credit = $user->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit;}else{ ?><span class="text-secondary"><?php $credit = $user->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit; } ?></span></td>
                            
                          </tr>
                          
                           <?php
                            }
                      
                                 
                  $usertotal = Db::getInstance()->query("SELECT SUM(a.debit) as debit, SUM(a.credit) as credit
				  FROM journal_entry a
                  left join journal b on a.journal_id = b.id 
                  left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                  WHERE a.subsidiary_ledger_id = $member_id
                  AND b.transaction_year = '$transaction_year'
                  GROUP BY a.subsidiary_ledger_id");
                   if (!$usertotal->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {
                      foreach ($usertotal->results() as $usertotal) {
                          ?>
                           <tr>
                                <td colspan='6' class="bg-light pl-5" align="left">Total</td>
                            <td class="text-right"><?php if($usertotal->debit != '0.00'){$debit = $usertotal->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit;}else{ ?><span class="text-secondary"><?php $debit = $usertotal->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit; } ?></span></td>
                            <td class="text-right"><?php if($usertotal->credit != '0.00'){$credit = $usertotal->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit;}else{ ?><span class="text-secondary"><?php $credit = $usertotal->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit; } ?></span></td>
                            </tr>
                          <?php
                      }
                  }
                  ?>
                            
                            
                       
                      </tbody>
                    </table>
                  <?php
                  }
                                     
                ?>
                                  </div>
                                </div>
                          </div>
                    </div>
                 
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
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/reports/general_ledger/",
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
         

    
       event.preventDefault();
   });
   
   </script>
   
   