<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {




   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
    
  
  if(!empty($_REQUEST['transaction_year'])) {
        
     
        $transaction_year_month  = $_REQUEST['transaction_year'];


               


                  $user = Db::getInstance()->query("SELECT b.journal_code, b.tag, b.description, a.debit, a.credit, b.date_time, c.gl_code, a.account_type, b.transaction_year
                                                    FROM journal_entry a 
                                                    LEFT JOIN journal b on a.journal_id = b.id
                                                    left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                                                    left join chart_of_accounts_types d on c.category_id = d.id
                                                    WHERE b.transaction_year = '$transaction_year_month'");

                         
                        
                         
                   if (!$user->count()) {
                            
                        
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                        
                        
                        
                      } else {
                        
                        
                    ?> 
                <div class="table-responsive data-font" style="height: 100%;">
      
    
                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Journal Code</th>                        
                          <th>Tag</th>
                          <th>Date</th>  
                          <th>Account</th>
                          <th>Description</th> 
                          <th class="text-right">Debit</th>
                          <th class="text-right">Credit</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++ ; ?></td>
                            <td><?php echo $user->journal_code; ?></td>
                            <td><?php echo $user->tag; ?></td>
                            <td><?php 
                            
                                    $original_string = $user->date_time;
                                    $substring3 = substr($original_string, 0, 10);
                                    echo $substring3; // Output: Hello
                                     
                            ?></td>
                            <td><?php echo $user->gl_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td class="text-right"><?php if($user->debit != '0.00'){$debit = $user->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit;}else{ ?><span class="text-secondary"><?php $debit = $user->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit; } ?></span></td>
                            <td class="text-right"><?php if($user->credit != '0.00'){$credit = $user->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit;}else{ ?><span class="text-secondary"><?php $credit = $user->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit; } ?></span></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="item_view" id="<?php echo $user->subsidiary_ledger_id; ?>" title="<?php echo $user->transaction_year; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; GL - <?php echo $user->gl_code; ?></button>

                                    </div>
                                  
                                  </div>
                              </div>

                               
                             
                            </td>
                          </tr>

 
                        <?php
                        }
                        
                              
                                         
                          $usertotal = Db::getInstance()->query("SELECT  SUM(a.debit) as debit, SUM(a.credit) as credit
                                                    FROM journal_entry a 
                                                    LEFT JOIN journal b on a.journal_id = b.id
                                                    left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                                                    left join chart_of_accounts_types d on c.category_id = d.id
                                                    WHERE b.transaction_year = '$transaction_year_month'
                                                    GROUP BY b.transaction_year");
                           if (!$usertotal->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                          } else {
                              foreach ($usertotal->results() as $usertotal) {
                                  ?>
                                   <tr>
                                        <td colspan='6' class="bg-light pl-5" align="left">Total</td>
                                        <td style="text-align:right"><?php if($usertotal->debit != '0.00'){echo $usertotal->debit;}else{ echo '<span class="text-secondary">' . $usertotal->debit . '</span>';} ?></td>
                                        <td style="text-align:right"><?php if($usertotal->credit != '0.00'){echo $usertotal->credit;}else{ echo '<span class="text-secondary">' . $usertotal->credit . '</span>';} ?></td>
                                    </tr>
                                  <?php
                              }
                          }
                          ?>
                            
                      </tbody>
                    </table>
                  
              </div>
            
  <?php
                      }
                     
                      
   }else{
       
               


                  $user = Db::getInstance()->query("SELECT b.journal_code, b.tag, b.description, a.debit, a.credit, b.date_time, c.gl_code, a.account_type, a.subsidiary_ledger_id, b.transaction_year 
                                                    FROM journal_entry a 
                                                    LEFT JOIN journal b on a.journal_id = b.id
                                                    left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                                                    left join chart_of_accounts_types d on c.category_id = d.id
                                                    WHERE b.transaction_year = '$transact_'");

                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                <div class="table-responsive data-font" style="height: 100%;">
      
    
                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Journal Voucher</th>                        
                          <th>Tag</th>
                          <th>Date</th>  
                          <th>Account</th>
                          <th>Description</th> 
                          <th class="text-right">Debit</th>
                          <th class="text-right">Credit</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++ ; ?></td>
                            <td><?php echo $user->journal_code; ?></td>
                            <td><?php echo $user->tag; ?></td>
                            <td><?php 
                            
                                    $original_string = $user->date_time;
                                    $substring3 = substr($original_string, 0, 10);
                                    echo $substring3; // Output: Hello
                                     
                            ?></td>
                            <td><?php echo $user->gl_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td class="text-right"><?php if($user->debit != '0.00'){$debit = $user->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit;}else{ ?><span class="text-secondary"><?php $debit = $user->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit; } ?></span></td>
                            <td class="text-right"><?php if($user->credit != '0.00'){$credit = $user->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit;}else{ ?><span class="text-secondary"><?php $credit = $user->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit; } ?></span></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="item_view" id="<?php echo $user->subsidiary_ledger_id; ?>" title="<?php echo $user->transaction_year; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; GL - <?php echo $user->gl_code; ?></button>

                                    </div>
                                  
                                  </div>
                              </div>

                               
                             
                            </td>
                          </tr>

 
                        <?php
                        }
                        
                              
                                         
                          $usertotal = Db::getInstance()->query("SELECT  SUM(a.debit) as debit, SUM(a.credit) as credit
                                                    FROM journal_entry a 
                                                    LEFT JOIN journal b on a.journal_id = b.id
                                                    left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                                                    left join chart_of_accounts_types d on c.category_id = d.id
                                                    WHERE b.transaction_year = '$transact_'
                                                    GROUP BY b.transaction_year");
                           if (!$usertotal->count()) {
                            echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                          } else {
                              foreach ($usertotal->results() as $usertotal) {
                                  ?>
                                   <tr>
                                        <td colspan='6' class="bg-light pl-5" align="left">Total</td>
                                        
                                        <td style="text-align:right"><?php if($usertotal->debit != '0.00'){$debit = $usertotal->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit;}else{ ?><span class="text-secondary"><?php $debit = $usertotal->debit;
                                $formatted_debit = number_format($debit); echo $formatted_debit; } ?></span></td>
                                        <td style="text-align:right"><?php if($usertotal->credit != '0.00'){$credit = $usertotal->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit;}else{ ?><span class="text-secondary"><?php $debit = $usertotal->credit;
                                $formatted_credit = number_format($credit); echo $formatted_credit; } ?></span></td>
                                
                                    </tr>
                                  <?php
                              }
                          }
                          ?>
                      </tbody>
                    </table>
                  
              </div>
            
  <?php
                      }
                      
   }
  
  
  
  
} else {
  $user->logout();
  Redirect::to('../../login/');
}


  ?>
 <script>
     $(document).ready(function(){
          
         $('.resulter').hide();
         $('.resulter1').hide();
         

        $('.item_view').click(function (e) {
		
		let member_id = $(this).attr('id');
		let transaction_year = $(this).attr('title');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			cache: false, type: 'post', async: true,
			url: "view/accounting/reports/general_ledger/payment.php",
			data:{
			    'member_id':member_id,
			    'transaction_year': transaction_year
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