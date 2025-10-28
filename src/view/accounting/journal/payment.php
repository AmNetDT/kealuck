<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
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
                           <div class="col-sm-12 success_alert mr-0"></div>
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
                                   

                  $user = Db::getInstance()->query("SELECT a.*, b.approval_order_id,
                  c.gl_code, c.description, d.title as accounttype
                  FROM journal_entry a
                  left join journal b on a.journal_id = b.id 
                  left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                  left join chart_of_accounts_types d on c.category_id = d.id
                  WHERE a.journal_id = $member_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th></th>
                          <th>Account Description</th>
                          <th>Account</th>
                          <th>Subsidiary Ledger</th>
                          <th>Debit</td>
                          <th>Credit</td>
                          <th>Reference Number</th>
                          <th>Due Date</th>
                        </tr>
                      </thead>
                      <tbody> 
                        <?php
                        $i = 1;   
                        foreach ($user->results() as $user) {
                          
                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->accounttype; ?></td>
                            <td><?php echo $user->gl_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td style="text-align:right"><?php if($user->debit != '0.00'){ $number = $user->debit;
                                $formatted_number = number_format($number); echo $formatted_number;} ?></td>
                            <td style="text-align:right"><?php if($user->credit != '0.00'){ $number = $user->credit;
                                $formatted_number = number_format($number); echo $formatted_number;} ?></td>
                            <td><?php echo $user->reference_no; ?></td>
                            <td><?php echo $user->due_date; ?></td>
                            
                          </tr>
                          
                           <?php
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
   
   