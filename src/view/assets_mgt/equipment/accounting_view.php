<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory_id);
    $user_id = escape($user->data()->username);
   
   
   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
   
   
?>
    <form>
      <input type="hidden" value="<?php echo $transact_; ?>" id="trans">
      <input type="hidden" value="<?php echo $member_id; ?>" id="member_id">
  </form>
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
             <?php


            $users = Db::getInstance()->query("SELECT a.*, b.username, c.name as supplier, e.approval_status,
                  concat(d.firstname, ' ', d.lastname) as registered, a.supplier_id, c.supplier_code
                  FROM equipment a 
                  Left join users b on a.added_by = b.id 
                  Left join staff_record d on b.username = d.user_id 
                  left join suppliers c on a.supplier_id = c.id
                  left join approval e on a.equipment_code = e.request_code
                  WHERE a.id = $member_id");
                  
            foreach ($users->results() as $use) {
                
                $equipment_code = $use->equipment_code;
                $description    = $use->description;
                $supplier_id    = $use->supplier_id;       
                $brand          = $use->brand;
                $model          = $use->model;
            ?>
            
            
             
                <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Accounting: <?php echo $equipment_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                      
                    </div> 
                </div>
              
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-sm-3">
                        
                          <button type="button" class="farm-button-blend py-1 ml-0" data-toggle="modal" data-target="#addtransactionmodal">
                            <span class="fa fa-save"> Record a Transaction</span>
                          </button> 
                          <button type="button" class="farm-button py-1 ml-0">
                            <span class="fa fa-print"></span>
                          </button>
                        
                    </div>
                    <div class="col-sm-5 px-0 mr-0">
                      
                      <div class="row justify-content-between">
                        <div class="col-8 text-capitalize text-weight-bold">
                          <h3 class="bg-light border p-3"><?php echo $description; ?></h3>
                        </div>
                        <div class="col-4 text-capitalize">
                            <?php if($brand != ''){ ?>
                          <p>Brand: <span class="text-secondary"><?php echo $brand; ?></span>
                            <?php 
                                
                            }
                             if($model != ''){
                                 
                             ?>
                          <br />Model: <span class="text-secondary"><?php echo $model; ?></span>
                            <?php 
                                
                            }?>
                            </p>
                        </div>
                      </div>     
                    </div>
                    <div class="col-sm-4 px-0 mr-0 text-right">
            
                          <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                            <span class="fa fa-chevron-left"></span>
                          </button>
                          <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                            <span class="fa fa-refresh"></span>
                          </button> 
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
               </div>  
              
                
            <div class="row justify-content-between">
                    
                   
                       
                      <div class="col-sm-12 m-0 p-0">
                          <div class="row">
                            <div class="col-sm-2 m-0 p-0">
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item d-flex justify-content-between align-items-center details_click" style="cursor:pointer">
                                    Transactions
                                  </li>

                                </ul>
                            </div>
                            <div class="col-sm-10 transactions_click_view">
                                
                                <div id="userr"></div>
                                <div id="load"></div>
                                
                            </div>
                          
                             
                          </div>
                       
                      </div>
                
                
            </div>
                
             <?php
             }
            ?>
            
        </div>
      </div>
    </div>
    </div>
           <!-- Modal Equipment Details -->
            <div class="modal fade" id="addtransactionmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  
                  <div class="modal-header p-2">
                        <p class="modal-title" id="staticBackdropLabel">New Transaction</p>
                        <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  
                    
                     <?php
                     
                         if ($userSyscategory == 1) {
                     
                     ?>
                     <form id="equipment_form_one" method="post">
                        <div class="modal-body m-3">
                        <div class="form-row">
                          <div class="col-sm-12 p-2 success_alert"></div>
                          <div class="col-sm-12 p-2 warning_alert"></div>
                        </div>
                        <div class="form-row">
                          <label for="type">Type</label>
                          <div class="form-group col-sm-12">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="type" id="customer_click" value="Income">
                              <label class="form-check-label" for="customer_click">Income</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="type" id="payee_click" value="Expense">
                              <label class="form-check-label" for="payee_click">Expense</label>
                            </div>
                          </div>
                          </div>
                       
                        <div class="form-row">
                          <div class="form-group col-sm-12" id="payee_view">
                  
                            <label for="payee">Payee</label>
                             <input list="browsers" name="payee_contractors" id="payee_contractors" class="form-control">
                                <datalist id="browsers">
                                <?php
                        
                                     $contractors = Db::getInstance()->query("SELECT * FROM contractors");
                                        foreach($contractors->results() as $contractors){
                                
                                    ?>
                                <option value="<?php echo $contractors->name .' | ' . $contractors->contractor_code; ?>">
                                <?php
                                        }
                                    ?>
                            </datalist>
                            
                          </div> 
                          </div> 
                        <div class="form-row">
                          <div class="form-group col-sm-12" id="customer_view">
                  
                            <label for="payee">Customer</label>
                             <input list="browse" name="payee_customers" id="payee_customers" class="form-control">
                                <datalist id="browse">
                                <?php
                        
                                     $customers = Db::getInstance()->query("SELECT * FROM customers");
                                        foreach($customers->results() as $customers){
                                
                                    ?>
                                <option value="<?php echo $customers->name .' | ' . $customers->customer_code; ?>">
                                <?php
                                        }
                                    ?>
                            </datalist>
                            
                          </div> 
                      </div>
                        <div class="form-row"> 
                          <div class="form-group col-sm-6">
                          
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" />
                            
                            
                          </div>
                          <div class="form-group col-sm-6">
                          
                            <label for="transaction_date">Transaction Date</label>
                            <input type="datetime-local" id="transaction_date" name="transaction_date" class="form-control" />
                            
                          </div>
                        </div>
                            <div class="form-row"> 
                              <div class="form-group col-sm-4">
                                <label for="payment_type">Payment Type</label>
                                
                                         <input list="paymet_t" name="payment_type" id="payment_type" class="form-control payment_type">
                                            <datalist id="paymet_t">
                                                <option value="Cash">
                                                <option value="Cheque">
                                                <option value="Bank Transfer">
                                                <option value="Bank Deposit">
                                            </datalist>
                              </div>
                              
               
                          <div class="form-group col-sm-8 cheque_number">
                            <label for="cheque_number">Cheque Number</label>
                            <input type="text" class="form-control" id="cheque_number" name="cheque_number" />
                            
                          </div>
                          <div class="form-group col-sm-4">
                            <label for="transaction_year">Transaction Year</label>
                                <select id="transaction_year" name="transaction_year" class="form-control farm-button-cancel">
                                    <option selected>...Select...</option>
                                <?php
                                
                                 $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                                    foreach($transact_year->results() as $transact_year){
                            
                                ?>
                                
                                    <option value="<?php echo $transact_year->year; ?>"><?php echo $transact_year->year; ?></option>
                                    <?php
                                            }
                                        ?>
                                </select>
                        </div>
                        </div> 
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                          </div>
                          
                        </div>
            
                                <input type="hidden" name="category" id="category" value="Manual">
                                <?php $Rahma = mt_rand(100,999); ?>
                                <input type="hidden" name="ex_code" id="ex_code" value="EXP-<?php echo $Rahma; ?>">
                                <input type="hidden" name="in_code" id="in_code" value="INC-<?php echo $Rahma; ?>">
                                <input type="hidden" name="equipment_id" id="equipment_id" value="<?php echo $member_id; ?>" />
                                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                <input type="hidden" name="equipment_code" id="equipment_code" value="<?php echo $equipment_code; ?>" />
                              
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 Save_acc_trans_one">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                        </div>
                        </form>
                      <?php
                      
                        }else if ($userSyscategory == 4 ) {
                             
                    ?>
                    <form id="equipment_form_two" method="post">
                     <div class="modal-body m-3">
                      <div class="row">
                          <diiv class="col-sm-12 p-2 success_alert"></diiv>
                          <diiv class="col-sm-12 p-2 warning_alert"></diiv>
                      </div>
                      
                        <div class="form-row">
                          
                    <input type="hidden" name="type" id="type" value="Income" />
                        
                      </div>
                        <div class="form-row">
                      <div class="form-group col-sm-12">
              
                        <label for="payee">Customer</label>
                        <input list="browsers" name="payee_customers" id="payee_customers" class="form-control">
                            <datalist id="browsers">
                            <?php
                    
                                 $customers = Db::getInstance()->query("SELECT * FROM customers");
                                    foreach($customers->results() as $customers){
                            
                                ?>
                            <option value="<?php echo $customers->name .' | ' . $customers->customer_code; ?>">
                            <?php
                            
                                    }
                                    
                                ?>
                        </datalist>
                
                        </div> 
                    </div>
                        <div class="form-row"> 
              <div class="form-group col-sm-6">
              
                <label for="amount">Amount</label>
               <input type="text" id="amount" name="amount" class="form-control" />
                
                
              </div>
              <div class="form-group col-sm-6">
              
                <label for="transaction_date">Transaction Date</label>
                <input type="datetime-local" id="transaction_date" name="transaction_date" class="form-control" />
                
              </div>
            </div>
            <div class="form-row"> 
              <div class="form-group col-sm-4">
                <label for="payment_type">Payment Type</label>
                
                         <input list="payment_t" name="payment_type" id="payment_type" class="form-control payment_type">
                            <datalist id="payment_t">
                                <option value="Cash">
                                <option value="Cheque">
                                <option value="Bank Transfer">
                                <option value="Bank Deposit">
                            </datalist>
              </div>
              
              
              <div class="form-group col-sm-8 cheque_number">
                <label for="cheque_number">Cheque Number</label>
                <input type="text" class="form-control" id="cheque_number" name="cheque_number" />
                
              </div>
              
            </div>
                        <div class="form-row">
              <div class="form-group col-sm-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
              
            </div>
              
                                <?php
                                
                                 $transact_yr = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
                                    foreach($transact_yr->results() as $transact_yr){
                            
                                ?>
                                <input type="hidden" name="transaction_year" value="<?php echo $transact_yr->year; ?>" />
                                    <?php
                                            }
                                        ?>
                            
                        
                                <input type="hidden" name="category" id="category" value="Manual">
                                <?php $Rahma = mt_rand(100,999); ?>
                                <input type="hidden" name="ex_code" id="ex_code" value="EXP-<?php echo $Rahma; ?>">
                                <input type="hidden" name="in_code" id="in_code" value="INC-<?php echo $Rahma; ?>">
                                <input type="hidden" name="equipment_id" id="equipment_id" value="<?php echo $member_id; ?>" />
                                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                <input type="hidden" name="equipment_code" id="equipment_code" value="<?php echo $equipment_code; ?>" />
                              
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 Save_acc_trans_two">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                        </div>
                      </form>
                        <?php
                                
                            
                        }else {
                             
                    ?>
                    <form id="equipment_form_three" method="post">
                        <div class="modal-body m-3">
                          <div class="row">
                              <diiv class="col-sm-12 p-2 success_alert"></diiv>
                              <diiv class="col-sm-12 p-2 warning_alert"></diiv>
                          </div>
                    <div class="form-row">
                          
                    <input type="hidden" name="type" id="type" value="Expense">
                        
                      </div>
                      <div class="form-row">
                      <div class="form-group col-sm-12">
              
                        <label for="payee">Payee</label>
                         <input list="browsers" name="payee_contractors" id="payee_contractors" class="form-control">
                            <datalist id="browsers">
                            <?php
                    
                                 $contractors = Db::getInstance()->query("SELECT * FROM contractors");
                                    foreach($contractors->results() as $contractors){
                            
                                ?>
                            <option value="<?php echo $contractors->name .' | ' . $contractors->contractor_code; ?>">
                            <?php
                                    }
                                ?>
                        </datalist>
                        
                      </div> 
                      </div> 
                    
                    <div class="form-row"> 
              <div class="form-group col-sm-6">
              
                <label for="amount">Amount</label>
               <input type="text" id="amount" name="amount" class="form-control" />
                
                
              </div>
              <div class="form-group col-sm-6">
              
                <label for="transaction_date">Transaction Date</label>
                <input type="datetime-local" id="transaction_date" name="transaction_date" class="form-control" />
                
              </div>
            </div>
            <div class="form-row"> 
              <div class="form-group col-sm-4">
                <label for="payment_type">Payment Type</label>
                
                         <input list="payment_ty" name="payment_type" id="payment_type" class="form-control payment_type">
                            <datalist id="payment_ty">
                                <option value="Cash">
                                <option value="Cheque">
                                <option value="Bank Transfer">
                                <option value="Bank Deposit">
                            </datalist>
              </div>
               
              <div class="form-group col-sm-8 cheque_number">
                <label for="cheque_number">Cheque Number</label>
                <input type="text" class="form-control" id="cheque_number" name="cheque_number" />
                
              </div>
              
            </div>
                    <div class="form-row">
              <div class="form-group col-sm-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
              
            </div>
              
                                <?php
                                
                                 $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
                                    foreach($transact_year->results() as $transact_year){
                            
                                ?>
                                <input type="hidden" name="transaction_year" value="<?php echo $transact_year->year; ?>" />
                                    <?php
                                            }
                                        ?>
                            
                                
                                <input type="hidden" name="category" id="category" value="Manual">
                                <?php $Rahma = mt_rand(100,999); ?>
                                <input type="hidden" name="ex_code" id="ex_code" value="EXP-<?php echo $Rahma; ?>">
                                <input type="hidden" name="in_code" id="in_code" value="INC-<?php echo $Rahma; ?>">
                                <input type="hidden" name="equipment_id" id="equipment_id" value="<?php echo $member_id; ?>" />
                                <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                              
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="farm-button py-1 ml-0 Save_acc_trans_three ">
                                <span class="fa fa-save"> Save</span>
                              </button>
                            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
                        </div>
                      </form>
                        <?php
                                            }
                                        ?>
                            
            
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
        
            
            $('.success_alert').hide();
            $('.warning_alert').hide();
            $('.cheque_number').hide();
            
            $('.transactions_click_view').show();
            $('.cashflow_click_view').hide();
            $('#customer_view').hide();
            $('#payee_view').hide();
            
            $('.pls_click').on('click', function(){
            
                $('.transactions_click_view').hide();
                $('.cashflow_click_view').hide();
            
            })
            
            $('.details_click').on('click', function(){
            
                $('.cashflow_click_view').hide();
                $('.transactions_click_view').show();
                $('.transactions_click_view').css("opacity", 5);
            
            })
            
            
            $('input[name="type"]').change(function() {
                
                if ($(this).val() === 'Income') {
                    
                  $('#customer_view').show();
                  $('#payee_view').hide();
                  
                } 
              });
            
            $('input[name="type"]').change(function() {
                
                if ($(this).val() === 'Expense') {
                    
                  $('#customer_view').hide();
                  $('#payee_view').show();
                  
                } 
              });

            
    	    $('.prev_page').click(function (e) {
	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/index.php",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
          
    	    $('.current_page').click(function (e) {
    	
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/accounting_view.php",
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
    			url: "view/assets_mgt/equipment/request_approval.php",
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

            $('.Save_acc_trans_one').on('click', function(){
       
                let form = $('#equipment_form_one')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/insert_transaction.php',
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
                
            });
            $('.Save_acc_trans_two').on('click', function(){
       
                let form = $('#equipment_form_two')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/insert_transaction.php',
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
                
            });
            $('.Save_acc_trans_three').on('click', function(){
       
                let form = $('#equipment_form_three')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/insert_transaction.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $(document).ready(function(event){
                                
                                $('#addtransactionmodal').modal('hide');
                                
                                event.preventDefault();
                            });
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
            
            $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val();
            let member_id = <?php echo $member_id ?>; 
		
	        //	alert(dataString)
	
            $.ajax({
                type: "GET",
                url: "view/assets_mgt/equipment/select_equip_trans.php",
                //dataType: 'json',
    			data: {
    			    id: id,
    			    member_id: member_id
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#userr").html(html);
                    $('#load').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
      
       });
       
       
       $("#payment_type").on("change", function() {
       
           let cheque = $('#payment_type').val();
            
            if(cheque === 'Cheque'){
                
                $('.cheque_number').show();
                
            }
          
        });
             
        
       event.preventDefault();
       });
       
        
        $(document).ready(function(evt){ 
        let member_id = $('#member_id').val(); 
		let transact_ = $('#trans').val(); 
		
		
	//	alert(dataString)
	
        $.ajax({
            type: "POST",
            url: "view/assets_mgt/equipment/select_equip_trans.php",
            //dataType: 'json',
			data: {
			    member_id: member_id,
			    transact_: transact_
			},
            cache: false,
    		beforeSend: function() {
    		    
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
        
        
         evt.preventDefault();
        
      
       });
  </script>
