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
                <div id="accounttile2" class="col-sm-12">
       
                 <div class="row justify-content-between m-3">
                <div class="col-sm-8">
                           <div class="col-sm-12 success_alert mr-0">Subsidiary Ledger</div>
                  </div>
                    <div class="col-sm-4" >
                      
                    </div>
                </div>
                <div class="row m-3 justify-content-between">
                     
                           
                      <div class="col-sm-12">
                          <div class="row justify-content-between my-5">
                              <div class="card col-12" style="border-left:solid 1px #222222">
                                  <div class="card-header">
                                      <div class="col-11">
                                        Report
                                    </div>
                                      <div class="col-1 text-right">
                                          
                                      </div>
                                  </div>
                                  <?php
                                     

                  $journal = Db::getInstance()->query("SELECT a.journal_id,
                  c.gl_code, d.title as accounttype, c.id as subsidiary_ledger_id, c.description as subsidiary, 
                  b.description as voucher, d.title as accounttype
                  FROM journal b
                  left join journal_entry a on b.id = a.id 
                  left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                  left join chart_of_accounts_types d on c.category_id = d.id");

                  if (!$journal->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {
                        
                        foreach ($journal->results() as $journal) {
                    
                     
                ?> 
                                  <div class="card-body">
                                      
                                      <?php
                  $journal_id = $journal->journal_id;   


                  $user = Db::getInstance()->query("SELECT a.*, b.description as journal_description
                  FROM journal_entry a
                  left join journal b on a.journal_id = b.id 
                  WHERE a.journal_id = $journal_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {
    
                    
                     
                ?> 
                    <div class="card col-12" style="border-left:solid 1px #222222">
                                  <div class="card-header mb-0 alert alert-dark">
                                      <div class="col-11">
                                        <?php
                                                echo 'Account Type: ' . $journal->accounttype;
                                        ?>
                                    </div>
                                      <div class="col-1 text-right">
                                          
                                      </div>
                                  </div>
                                  <div class="card-header mt-0  alert alert-default">
                                      <div class="col-11">
                                        <?php
                                                echo 'Account ' . $journal->gl_code .' | ' . $journal->subsidiary;
                                        ?>
                                    </div>
                                      <div class="col-1 text-right">
                                          
                                      </div>
                                  </div>
                                  <div class="card-body">
                                      
                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th></th>
                          <th></th>
                          <th class="text-right">Debit</td>
                          <th class="text-right">Credit</td>
                          <th class="text-right">Debit</td>
                          <th class="text-right">Credit</td>
                        </tr>
                      </thead>
                      <tbody> 
                        <?php
                        $i = 1;   
                        foreach ($user->results() as $user) {
                          
                        ?>
                         
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->journal_description; ?></td>
                            <td class="text-right"><?php if($user->debit != '0.00'){echo $user->debit;}else{ echo '<span class="text-secondary">' . $user->debit . '</span>';} ?></td>
                            <td class="text-right"><?php if($user->credit != '0.00'){echo $user->credit;}else{ echo '<span class="text-secondary">' . $user->credit . '</span>';} ?></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                           
                          </tr>
                            
                       
                           <?php
                            }
                            
                            
                    
                  $usertot = Db::getInstance()->query("SELECT SUM(a.debit) as debit, SUM(a.credit) as credit
                  FROM journal_entry a
                  left join journal b on a.journal_id = b.id 
                  left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                  left join chart_of_accounts_types d on c.category_id = d.id
                  WHERE a.journal_id = $journal_id
                  GROUP BY a.journal_id");

                  if (!$usertot->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else { 
                  
                        foreach ($usertot->results() as $usertot) {
                            
                            ?>
                            <tr>
                                <td colspan="2" style="width:40%"></td>
                                <td class="text-right alert alert-dark"><?php if($usertot->debit != '0.00'){echo $usertot->debit;}else{ echo '<span class="text-secondary">' . $usertot->debit . '</span>';} ?></td>
                                <td class="text-right alert alert-dark"><?php if($usertot->credit != '0.00'){echo $usertot->credit;}else{ echo '<span class="text-secondary">' . $usertot->credit . '</span>';} ?></td>
                                <td class="text-right alert alert-dark"></td>
                                <td class="text-right alert alert-dark"></td>
                           </tr>
                  <?php }
                  }
                  
                        ?>
                          <tr>
                              <td colspan="8"></td>
                          </tr>
                           
                      </tbody>
                    </table>
                                    
                                    </div>
                            </div>
                  <?php
                        
                  }
                                     
                ?>
                                  </div>
                <?php
                  }
                  
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
    			url: "view/accounting/journal/",
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
   
   