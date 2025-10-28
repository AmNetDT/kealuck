<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
 $userSyscategory = escape($user->data()->syscategory_id);
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
   
?>


  
  
       

   <!-- Add journal Modal !-->

  <div id="add_journal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <form method="post" id="post_form">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Journal</p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row justify-content-between">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="form-group col-md-5 pr-0">
                    <label>Account Type</label>
                    <select class="form-control" id="account_type" name="account_type">
                        <option value="">-- Select --</option>
                                <?php
                  
                    $transaction_year = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types order by title asc");
                                    foreach ($transaction_year->results() as $trans) {
              
                 
                    ?>
                              <option value="<?php echo $trans->id; ?>"><?php echo $trans->title; ?></option>
                              <?php
                                     }
                    ?>
                            </select>
                  </div>
                  <div class="form-group col-md-7 px-0">
                    <label for="subsidiary_ledger_id">Subsidiary Ledger <span id="coa" style="font-size:0.75em"></span></label>
                    <select class="form-control" id="subsidiary_ledger_id" name="subsidiary_ledger_id">
                        </select>
                  </div>
                </div>
                <div class="row">
                  <div class="card mx-1">
                  <div class="card-header">
                    
                               <div class="col-6 pl-0">
                                    <label>Debit</label>
                                </div>
                    <input type="number" name="debit" id="debit" class="form-control"  /> 
                        
                  </div>
                  <div class="card-header">
                    
                               <div class="col-6 pl-0">
                                    <label>Credit</label>
                                </div>
                    <input type="number" name="credit" id="credit" class="form-control"  /> 
                        
                  </div>
                  
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card" style="border-left:solid 1px #222222">
                <div class="row">
                  <div class="col-md-9 m-3">
                        <label>Reference No</label>
                    <input type="text" name="reference_no" id="reference_no" class="form-control" />
                    </div>
                  <div class="col-md-9 m-3">
                        <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="form-control" />
                    </div>
                   </div>
                </div>
              </div>
            </div>
            
            <?php
                    $approval_journal_entry = Db::getInstance()->query("SELECT * FROM journal WHERE approval_order_id = $member_id");
                        foreach ($approval_journal_entry->results() as $approval) {
            ?>
                <input type="hidden" value="<?php echo $approval->id; ?>" name="journal_id" id ="journal_id" />
                <?php
                        }
                ?>
                <input type="hidden" value="<?php echo $username; ?>" name="added_by" id ="added_by" />
          </div>
          <div class="modal-footer">
            <button type="button" class="py-1 px-2 border farm-color text-white mx-0 post_save"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Post</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" id="<?php echo $member_id; ?>" data-dismiss="modal"> Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
       

             
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div> 
        </div>
        
            
             <div class="jumbotron jumbotron-fluid pt-5 bg-white">
                <div id="accounttile2" class="col-sm-12">
                    
         <?php


            $approval = Db::getInstance()->query("SELECT a.*, a.id as approval_id, a.request_code, concat(d.firstname,' ', d.lastname) as staffname, 
                  c.username, e.paid, e.total_amount, e.id as approval_order_id, f.sign, f.name, f.id as currency_id
                  FROM approval a 
                  Left join users c on a.request_by = c.id 
                  Left Join staff_record d on c.username = d.user_id 
                  Left join approval_records e on a.id = approval_id
                  left Join currency f on a.currency_id = f.id
                  WHERE e.id = $member_id");
                  
            foreach ($approval->results() as $use) {
                
                             
            ?>
            <div class="row justify-content-between m-3">
                <div class="col-sm-8">
                           <div class="col-sm-12 success_alert mr-0"></div>
                  </div>
                    <div class="col-sm-4" >
                    <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button> 
                      <?php
                              
                              $approval_journal_entry = Db::getInstance()->query("SELECT * FROM journal WHERE approval_order_id = $member_id");
                              if (!$approval_journal_entry->count()){
                               
                                          
                                             if ($userSyscategory == 1) {

                    
                                          ?>
                                
                                <button class="farm-button py-1 ml-0" id="journal_voucher_btn" data-target="#journal_voucher" data-toggle="modal">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Journal &nbsp;
                                  </button>
                                   <?php
                                             }
                                } else  if ($approval_journal_entry->count()){
                            
                              
                                      $reconcile = Db::getInstance()->query("SELECT * FROM journal WHERE approval_order_id = $member_id");
                                      foreach ($reconcile->results() as $reconcile) {
                                          if(empty($reconcile->reconcile)){
                                      ?>
                                    <button class="farm-button py-1 ml-0" id="add_journal_voucher_btn_100" data-target="#add_journal" data-toggle="modal">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Add Journal &nbsp;
                                      </button>
                                 
                                   <button class="farm-button py-1 ml-0 save_reconcile" id="add_save_btn_100">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i> Save &nbsp;
                                      </button>
                                    <form method="post"id="form_reconcile" name="form_reconcile">
                                        <?php
                                             $journal_id =  $reconcile->id;
                                          
                                             $journal_entry_bal = Db::getInstance()->query("SELECT SUM(debit) as debit, SUM(credit) as credit, journal_id FROM journal_entry WHERE journal_id = $journal_id");
                                             foreach ($journal_entry_bal->results() as $reconcil) {
                                                 
                                        ?>
                                                <input type="hidden" value="<?php echo $reconcil->debit; ?>" id="debit_save" name="debit" />
                                                <input type="hidden" value="<?php echo $reconcil->credit; ?>" id="credit_save" name="credit" />
                                                <input type="hidden" value="Posted" id="reconcile" name="reconcile" />
                                                <input type="hidden" value="<?php echo $reconcil->journal_id; ?>" id="id" name="id" />
                                        <?php
                                             }
                                             ?>
                                       
                                
                                   </form>  
                         <?php      
                                          }
                                      }
                         
                                }
                         
                         ?>
                      
                    </div>
                </div>
           
                
               
               
              
                <div class="row m-3 justify-content-between">
                     
                            <!-- Create  Modal !-->
                            
                              <div id="journal_voucher" class="modal fade" data-backdrop="static">
                                <div class="modal-dialog modal-lg">
                                  <form method="post"id="form_journal" name="form_journal">
                                    <div class="modal-content">
                                      <div class="farm-color modal-header p-2">
                                        <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Journal</p>
                                        <button type="button" class="bg-secondary px-2 border text-white current_page" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="row justify-content-between my-3">
                                                <div class="col-sm-12 success_alert mr-0"></div>
                                            </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="row">
                                              <div class="form-group col-md-5">
                                              <?php $Rahma = mt_rand(1000,9999); ?>
                                                <label>Journal Code</label>
                                                <input type="text" name="journal_code" id="journal_code" value="JV<?php echo $Rahma; ?>" class="form-control" readonly />
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group col-md-12">
                                                <label>Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" readonly ><?php echo $use->order_description; ?> - <?php echo $use->request_code; ?></textarea>
                                                <input type="hidden" id="approval_order_id" name="approval_order_id" value="<?php echo $use->approval_order_id; ?>" />
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="card" style="border-left:solid 1px #222222">
                                              <div class="card-header">
                                                
                                                           <div class="col-4 pl-0">
                                                                <label for="currency">Currency</label>
                                                            </div>           
                                                           <div class="col-8">
                                                             
                                                                <select class="form-control" id="currency" name="currency">
                                                                    <option value="">--Choose Currency--</option>
                                                                            <?php
                                                              
                                                                $transaction_year = Db::getInstance()->query("SELECT * FROM currency order by id asc");
                                                                                foreach ($transaction_year->results() as $trans) {
                                                          
                                                             
                                                                ?>
                                                                          <option value="<?php echo $trans->id; ?>"><?php echo $trans->sign; ?> | <?php echo $trans->name; ?></option>
                                                                          <?php
                                                                                 }
                                                                ?>
                                                                        </select>
                                                          </div>  
                                                    
                                              </div>
                                              
                                            <div class="row">
                                              <div class="col-md-4 m-3">
                                                    <label>Tag</label>
                                                <input type="text" name="tag" id="tag" class="form-control" />
                                                </div>
                                               </div>
                                            </div>
                                          </div>
                                        </div>
                            
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="py-1 px-2 border farm-color text-white mx-0 Save_post"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Post</button>
                                        <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div> 
                           
                          
                            <div class="col-sm-3">
                                
                                 <h2>Reconcilation</h2>
                              <div class="card z-index-2 ">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                  <div class="bg-gradient-primary shadow-primary py-3 pe-1">
                                    <div class="chart">
                                      <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                    </div>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <h4 class="mb-0 "><?php echo $use->order_description; ?></h4>
                                   <hr class="dark horizontal">
                                   <p><span class="text-sm text-danger"><b>Item Code:</b></span><br /><?php echo $use->request_code; ?></p>
                                  <h4><span class="text-sm text-danger"><b>Total Amount:</b></span><br /><span class="badge badge-secondary"><?php echo $use->name; ?></span> <?php $amount = $use->amount; $Total_ = number_format($amount); echo $use->sign . ' ' . $Total_; ?> </h4>
                                  
                                  <hr class="dark horizontal">
                                  <h3><span class="text-sm text-info"><b>Previous Bal:</b></span><br /> NGN <?php 
                                $numb = $use->total_amount;
                                $Total_Amt = number_format($numb);
                            echo $Total_Amt; ?></h3></td>
                                  
                                  <h3><span class="text-sm text-info"><b>Amount Approved:</b></span><br /> NGN <?php 
                                $numb = $use->paid;
                                $Total_Amt = number_format($numb);
                            echo $Total_Amt; ?></h3>
                                  <hr class="dark horizontal">
                                  <h4 class="mb-0">Request Remarks</h4>
                                  <p class="text-sm text-dark"><?php echo $use->order_remarks; ?></p>
                                  <hr class="dark horizontal">
                                  <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">Prepared by &nbsp;&nbsp;</i>
                                    <p class="mb-0 text-sm text-uppercase"> <?php echo $use->staffname; ?> </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                     <?php
                            
                            $approval_order_id = $member_id;
                                    $approval_order_journal = Db::getInstance()->query("SELECT * FROM journal where approval_order_id = $approval_order_id");
                                     if (!$approval_order_journal->count()) {
                                          echo "<div class='col-sm-9'><div class='row justify-content-between my-5'><h4 class='m-5'>No Journal added yet</h4></div></div>";
                                     }else{
                     
                     ?>
                      <div class="col-sm-9">
                          <div class="row justify-content-between my-5">
                              <div class="card col-12" style="border-left:solid 1px #222222">
                                  <div class="card-header">
                                      <div class="col-11">
                                        Journal Entry
                                    </div>
                                      <div class="col-1 text-right">
                                          <button type="button" class="bg-default border py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                                            <span class="fa fa-refresh"></span>
                                          </button>
                                      </div>
                                  </div>
                                  <div class="card-body">
                                      <div class="row justify-content-between">
                                            <div class="col-sm-12 success_delete_alert mr-0 current_page" id="<?php echo $member_id; ?>"></div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-sm-12 warning_delete_alert mr-0"></div>
                                        </div>
                                      <?php
                                   

                  $user = Db::getInstance()->query("SELECT a.*, b.approval_order_id,
                  c.gl_code, c.description, d.title as accounttype
                  FROM journal_entry a
                  left join journal b on a.journal_id = b.id 
                  left join chart_of_accounts c on a.subsidiary_ledger_id = c.id
                  left join chart_of_accounts_types d on c.category_id = d.id
                  WHERE b.approval_order_id = $member_id");

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
                            <td style="text-align:right"><?php $debit = $user->debit; $debit_Amt = number_format($debit); echo $debit_Amt; ?></td>
                            <td style="text-align:right"><?php $credit = $user->credit; $credit_Amt = number_format($credit); echo $credit_Amt; ?></td>
                            <td><?php echo $user->reference_no; ?></td>
                            <td><?php echo $user->due_date; ?></td>
                            <?php
                                    $reconcile = Db::getInstance()->query("SELECT * FROM journal WHERE approval_order_id = $member_id");
                                      foreach ($reconcile->results() as $reconcile) {
                                          if(empty($reconcile->reconcile)){
                                     
                            ?>
                            <td>
                                <?php
                                    
                                      $id_delete = $user->id;
                                      
                                      $reconcile = Db::getInstance()->query("SELECT * FROM journal_entry WHERE id = $id_delete");
                                      foreach ($reconcile->results() as $reconcile) {
                                          if(empty($reconcile->reconcile)){
                                      ?>
                                                <span class="singledelete" id="<?php echo $id_delete; ?>" title="journal_entry"><i class='fa fa-trash'></i></span>
                                      <?php
                                              }
                                          }
                                      ?>
                            </td>
                            <?php
                                          }
                                      }
                            ?>
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
                    <?php
                        
                                     }
                    
                    ?>
                </div>
            

                <?php
             }
            ?>
                
                
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
        
     
        $('.resulter').hide();
        $('.resulterError').hide();
        $('.btnRemark').hide();
        
        $('.Save_post').on('click', function(){
            
            let date_time = $('#date_time').val();
            let currency = $('#currency').val();
            
            if(date_time === '' || currency === ''){
                
                
                        $(".success_alert").html('<div class="alert alert-danger"> Date or Currency cannot be empty</div>');
                        $(".success_alert").show();
                      
                
                    
            }else{
                  
                  
                  
                    let form = $('#form_journal')[0]; // You need to use standard javascript object here
                    let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/accounting/acc_reconciliation/insert.php',
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
                    
                      
            }
       
            
                
            });
    
        $('.post_save').on('click', function(){
            
            let account_type    = $('#account_type').val();
            let currency        = $('#currency').val();
            let due_date        = $('#due_date').val();
            let debit           = $('#debit').val();
            let credit          = $('#credit').val();
            
          
            if(account_type === '' || due_date === ''){
                
                
                        $(".success_alert").html('<div class="alert alert-danger"> Account Type or Due Date cannot be empty</div>');
                        $(".success_alert").show();
                      
            }else if(debit === '' && credit === ''){   
                    
                
                        $(".success_alert").html('<div class="alert alert-danger"> Debit and Credit cannot be empty</div>');
                        $(".success_alert").show();
                      
            }else{
                  
            
       
                let form = $('#post_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
           
                    $.ajax({
        				url: 'view/accounting/acc_reconciliation/insert_post.php',
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
                 }
                
            });
        
    
    	$('.prev_page').on('click', function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/acc_reconciliation/",
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
          
       
    	$('.current_page').on('click', function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/acc_reconciliation/payment.php",
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

    	
        $('.save_reconcile').on('click', function(){
            
            let debit = $('#debit_save').val();
            let credit = $('#credit_save').val();
            
            if(debit != credit || debit === '' || credit=== ''){
                
                            //alert('The Debit and Credit entry must be the same total')
                            $(".success_alert").html('<div class="alert alert-dismissible alert-danger">The Debit and Credit entry cannot be emptied and must be the same total value<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $(".success_alert").show();
                    
            }else{
               
       
                let form = $('#form_reconcile')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
            
                    $.ajax({
        				url: 'view/accounting/acc_reconciliation/update.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $("#add_journal_voucher_btn_100").hide();
                            $("#add_save_btn_100").hide();
                            $(".singledelete").hide();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                    
                    }
                });

        
        $("#account_type").change(function(){  
             
	    let id = $(this).find(":selected").val();
		let dataString = 'account_type='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/accounting/acc_reconciliation/getaccount_type.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
			success:function(response){
                
                let len = response.length;

                $("#subsidiary_ledger_id").empty();
                //$("#coa").empty();
                
                    for( let i = 0; i<len; i++){
                   
                    let id = response[i]['id'];
                    //let gl_code = response[i]['gl_code'];
                    let description = response[i]['description'];
                    
                  
                    //alert(location);
                    //$('#coa').append(gl_code);
                    $('#subsidiary_ledger_id').append($('<option>', {
                            value: id,
                            text: description
                     }));
                  
                
                }
				 	
			} 
		});
 	}) 
        
        
        $("#subsidiary_ledger_id").change(function(){  
             
	    let id = $(this).find(":selected").val();
		let dataString = 'subsidiary_ledger_id='+ id;  
		
		//alert(dataString);
	
		$.ajax({
			url: 'view/accounting/acc_reconciliation/getacc_description.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
			success:function(response){
                
                let len = response.length;

                $("#coa").empty();
                
                    for( let i = 0; i<len; i++){
                   
                   
                    let gl_code = response[i]['gl_code'];
                    
                  
                    //alert(location);
                    $('#coa').append(gl_code);
                  
                
                }
				 	
			} 
		});
 	}) 


        $('.singledelete').on('click', function(e){
                
              if (confirm("Are you sure you want to remove this item?") == true) {
                  
                	let tablename =   $(this).attr('title');
		            let id =          $(this).attr('id');
		            
                $.ajax({
        
    				type: "POST",
    				url: 'view/accounting/acc_reconciliation/delete.php',
            		data: {
            		    tablename   : tablename,
                        id  : id
            		    
            		},
                    success:function(data){
                        $(".success_delete_alert").html(data);
                        $(".success_delete_alert").show();
                    }, 
                    error:function(data){
                        $(".warning_delete_alert").html(data);
                        $(".warning_delete_alert").show();
                    }
                }); 
            
                
                
              } else {
                return false;
                
              }
            
            
            e.preventDefault();
        });


    
       event.preventDefault();
   });
   
   </script>
   
   