<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {




   $transact_ = date('Y');
    
  
  if(!empty($_REQUEST['transaction_year'])) {
        
     
        $transaction_year_month  = $_REQUEST['transaction_year'];


               


                  $user = Db::getInstance()->query("SELECT SUM(a.debit) as debit_amount,  SUM(a.credit) as credit_amount, a.journal_id,  
                                                    b.description, b.tag, b.date_time, b.journal_code
                                                    FROM journal_entry a, journal b
                                                   WHERE b.transaction_year = '$transaction_year_month'
                                                   AND  a.journal_id = b.id
                                                   GROUP BY a.journal_id");
 
                         
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
                            <td><?php echo $user->description; ?></td>
                            <td class="text-right"><?php $debit_ = $user->debit_amount;
                                $for_debit = number_format($debit_); echo $for_debit; ?></td>
                            <td class="text-right"><?php $creditit_ = $user->credit_amount;
                                $for_creditit = number_format($creditit_); echo $for_creditit; ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="item_view" id="<?php echo $user->journal_id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Item Details</button>

                                    </div>
                                  
                                  </div>
                              </div>

                               
                             
                            </td>
                          </tr>

 
                        <?php
                        }
                        ?>

                      </tbody>
                    </table>
                  
              </div>
            
  <?php
                      }
                     
                      
   }else{
       
               


                  $user = Db::getInstance()->query("SELECT SUM(a.debit) as debit_amount,  SUM(a.credit) as credit_amount, a.journal_id,  
                                                    b.description, b.tag, b.date_time, b.journal_code
                                                    FROM journal_entry a, journal b
                                                   WHERE b.transaction_year = '$transact_'
                                                   AND  a.journal_id = b.id
                                                   GROUP BY a.journal_id");

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
                            <td><?php echo $user->description; ?></td>
                            <td class="text-right"><?php $debit_ = $user->debit_amount;
                                $for_debit = number_format($debit_); echo $for_debit; ?></td>
                            <td class="text-right"><?php $creditit_ = $user->credit_amount;
                                $for_creditit = number_format($creditit_); echo $for_creditit; ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="item_view" id="<?php echo $user->journal_id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Item Details</button>

                                    </div>
                                  
                                  </div>
                              </div>

                               
                             
                            </td>
                          </tr>

 
                        <?php
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
         
 
        $('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		var member_id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edituser.php",
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

        $('.item_view').click(function (e) {
		
		let member_id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			cache: false, type: 'post', async: true,
			url: "view/accounting/journal/payment.php",
			data:{
			    'member_id':member_id
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