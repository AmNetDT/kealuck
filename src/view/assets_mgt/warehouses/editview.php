<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;

$user = new User();
if ($user->isLoggedIn()) {
    $username = escape($user->data()->id);
    
        $userSyscategory = escape($user->data()->syscategory_id);
       
        $transact_ = date('Y');
       
       
?>
     
   
   <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron pt-5 bg-white">
            <div class="row m-3 mb-4">
          <h3>Warehouses</h3>
          </div>
              
                <div class="row justify-content-end">
                    <div class="col-sm-8">
                        <form>
                              <label class="mr-2">Sort by transaction year</label>
                              <select id="inputTransaction_year_one" name="inputTransaction_year" class="farm-button-cancel py-1 pl-4 mt-2 inputTransaction_year">
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
                              <input type="hidden" value="<?php echo $transact_; ?>" id="trans">
                              <input type="hidden" value="<?php echo $member_id; ?>" id="member_id">
                          </form>
                    </div>
                    <div class="col-sm-4">
                      <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>
                      <button class="farm-button py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModalInventory">
                        <span class="fa fa-plus"> Add Inventory</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" id="<?php echo $member_id; ?>">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                    
                </div>
         
                <div class="col-sm-12 m-0 p-0">
                          <div class="row">
                            <div class="col-sm-1 m-0 p-0">
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item d-flex justify-content-between align-items-center inventory_click" style="cursor:pointer">
                                    Inventory  
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center bin_click" style="cursor:pointer">
                                    Bin  
                                  </li>

                                </ul>
                            </div>
                            <div class="col-sm-11 transactions_click_view">
                
                                <div id="load_inv"></div>
                                <div id="load"></div>
                           
                            </div>
                            <div class="col-sm-10 bin_click_view">
                
                                <div class="container-fluid">
                                   <?php
                    
                                        
                                        $sqlQuery = Db::getInstance()->query("SELECT * FROM bin WHERE warehouse_id = $member_id");
                                        
                                                         if (!$sqlQuery->count()) {
                                                             
                                                                echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                                
                                                              } else {
                                                                ?>
                                                                
                                           
                                        <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                                            <thead>
                                                              <tr>
                                                                <th style="width:10%">Code</th>
                                                                <th style="width:30%">Description</th>
                                                                <th style="width:10%">Max Capacity</th>
                                                                <th style="width:10%">Matric Type</th>
                                                                <th style="width:40%">Inventory</th>
                                                                <th>&nbsp;</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                        
                                            
                                        
                                            <?php 
                                        
                                        	                    foreach ($sqlQuery->results() as $department) { 
                                        
                                        	?>
                                            
                                                                <tr>
                                                                  <td><?php echo $department->bin_code; ?></td>
                                                                  <td><?php echo $department->description; ?></td>
                                                                  <td><?php echo $department->max_capacity; ?></td>
                                                                  <td><?php echo $department->metric_type; ?></td>
                                                                  <td>
                                                                      <?php
                                                                                
                                                                                $bin_id = $department->id;
                                                                                $max_capacity = $department->max_capacity;
                                                                                $bin = Db::getInstance()->query("SELECT SUM(total_qty_credit - total_qty_debit) as total FROM inventory WHERE bin_id = $bin_id");
                                                                                if (!$bin->count()) {
                                                             
                                                                                ?>
                                                                                
                                                                                
                                                                    <div class="progress">
                                                                      <div class="progress-bar bg-white" role="progressbar">Empty bin</div>
                                                                    </div>
                                                                    
                                                                                <?php
                                                                                
                                                                              } else {
                                                                                  foreach ($bin->results() as $depot_bin) { 
                                                                                      $yss = $depot_bin->total; 
                                                                                      $new_string = substr($yss, 0, 3);
                                                                      ?>
                                                                    <div class="progress">
                                                                      <div class="progress-bar progress-bar-striped farm-button" role="progressbar" 
                                                                      style="width:<?php if($depot_bin->total <= 0 ){ echo 0; }else{ echo($new_string); } ?>%;" 
                                                                      aria-valuenow="<?php if($depot_bin->total <= 0 ){ echo 0; }else{ echo($new_string); } ?>" 
                                                                      aria-valuemin="0" 
                                                                      aria-valuemax="<?php echo $max_capacity; ?>"><?php if($depot_bin->total <= 0 ){ echo 0; }else{ echo($new_string); } ?></div>
                                                                    </div>
                                                                    <?php
                                                                              }
                                                                        }
                                                                    ?>
                                                                  </td>
                                                                  <td>
                                                         <?php
                                                         
                                                $maintenance_cod = $department->id;
                                                $findincome = Db::getInstance()->query("SELECT * FROM inventory
                                                WHERE bin_id = $maintenance_cod"); 
                                                
                                                
                                                 if($findincome->count() == 1){
                                                     
                                                
                                                    
                                                 } else {
                                                     
                                                         
                                                     ?>
                                                     
                                                      
                                                <div class="btn-group dropleft">
                                                    <div class="singledelete" lang='<?php echo $department->id; ?>' title='bin'>
                                                        <button class="dropdown-item">
                                                             <i class="fa fa-trash"></i></button>
                                
                                                    </div>
                                                </div>
                                                 
                                                      <?php
                                                      
                                                     
                                                 } 
                                                     ?>
                                                </td>
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
        
    <!-- Bin !-->
      <div id="addModal" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
          
            <div class="modal-content">
              <div class="farm-color modal-header p-2">
                <p class="modal-title" id="staticBackdropLabel">Add New Bin</p>
                <button type="button" class="bg-secondary px-2 border text-white editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
                  <div class="row mt-0 mb-3 pt-0">
                     
                        <div class="col-sm-12 success_alert" id="success_alert"></div>
                        <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                        
                      </div>
              <form id="bin_form" method="post">
            
              <div class="modal-body pt-0">
                  <div class="row">
                      
                  <div class="form-group col-sm-4">
                  <?php $Rahma = mt_rand(100,999); ?>
                    <label for="bin_code">Bin Code</label>
                    <input type="text" id="bin_code" name="bin_code" class="form-control" value="BIN<?php echo $Rahma; ?>" readonly />
                  </div>
                
                  
                      <div class="form-group col-sm-8">
                        <label for="description">Description</label>
                         <input type="text"class="form-control" id="description" name="description" rows="3" />
                      </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-sm-4 metric_units">
                            <label for="metric_units">Metric Type</label>
                            <select class="form-control" id="metric_type" name="metric_type">
                              <option value="">--Select--</option>
                              <option value="bales">bales</option>
                              <option value="barrels">barrels</option>
                              <option value="bunches">bunches</option>
                              <option value="bushes">bushes</option>
                              <option value="dozen">dozen</option>
                              <option value="grams">grams</option>
                              <option value="head">head</option>
                              <option value="kilograms">kilograms</option>
                              <option value="kilolitre">kilolitre</option>
                              <option value="litre">litre</option>
                              <option value="millilitre">millilitre</option>
                              <option value="quantity">quantity</option>
                              <option value="tonnes">tonnes</option>
                            </select>
                            
                          </div>
                  <div class="form-group col-sm-4">
                    <label for="max_capacity">Max Capacity</label>
                    <input type="number" name="max_capacity" id="max_capacity" class="form-control" placeholder="0.00" />
                  </div>
                  
                </div>
              </div>
              <div class="modal-footer">
                  
                 <input type="hidden" id="warehouse_id" name="warehouse_id" value="<?php echo $member_id; ?>" />
                 <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                <button type="button" class="py-1 px-2 border farm-color mx-0 savebin">Add New</button>
                <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
              
              </div>
          </form>
            </div>
        </div>
      </div>
      
      
      <!-- Inventory !-->
      <div id="addModalInventory" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
          
            <div class="modal-content">
              <div class="farm-color modal-header p-2">
                <p class="modal-title" id="staticBackdropLabel">Add Inventory</p>
                <button type="button" class="bg-secondary px-2 border text-white editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                    
                </div>
                <form id="warehouses_form" method="post">
            
                  <div class="modal-body pt-0">
                        <div class="row">
                     
                            <div class="form-group col-sm-8">
                            <label for="inventory">Inventory</label>
                                <select class="form-control" id="products_id" name="products_id">
                                  <option value="">--Select--</option>
                                  <?php
                            
                                     $user = Db::getInstance()->query("SELECT * FROM products where type = 'output'");
        
                                      if (!$user->count()) {
                                        echo "<option value=''>No data to be displayed</option>";
                                      } else {
                                        foreach ($user->results() as $usr) {
                            ?>
                            <option value="<?php echo $usr->id; ?>"><?php echo $usr->sku_code . ' | ' . $usr->description; ?></option>
                            <?php
                            
                                        }
                                      }    
                            
                            ?>
                                </select>
                                
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="max_capacity">Max Capacity</label>
                                <input type="number" name="total_qty_credit" id="max_capacity_credit" class="form-control" placeholder="0.00" />
                                <input type="hidden" name="total_qty_debit" id="max_capacity_debit" />
                              </div>
                      
                        </div>
                        <div class="row">
                          
                          <div class="form-group col-sm-6">
                            <label for="bin_code">Activities Date</label>
                            <input type="datetime-local" id="activity_date" name="activity_date" class="form-control" value=""  />
                          </div>
                            <?php
                          
                                    if($userSyscategory == 1){
                          
                          ?>
                          <div class="form-group col-sm-6">
                          <label class="mr-2">Select Transaction Year</label>
                              <select id="inputTransaction_year_two" name="inputTransaction_year" class="form-control farm-button-cancel inputTransaction_year">
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
                             <input type="hidden" name="transaction_year" id="transaction_year" />
                             </div>
                             <?php
                             
                                    }else{
                                        
                                     $transaction_yr = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1"); 
                                     foreach($transaction_yr->results() as $transaction_yr){
                                         
                                         
                                     ?> 
                            <input type="hidden" name="transaction_year" id="transaction_year" value="<?php echo $transaction_yr->year; ?>" />      
                            <input type="hidden" name="inputTransaction_year" id="inputTransaction_year" />
                                     
                            <?php           
                                     }
                                    }
                             ?>
                      
                      
                        </div>
                        <div class="row">
                             <div class="form-group col-sm-6">
                                <label for="bin_id">Bin</label>
                                    <select class="form-control" id="bin_id" name="bin_id">
                                      <option value="">--Select--</option>
                                      <?php
                                
                                         $user = Db::getInstance()->query("SELECT * FROM bin where warehouse_id = $member_id");
            
                                          if (!$user->count()) {
                                            echo "<option value=''>No data to be displayed</option>";
                                          } else {
                                            foreach ($user->results() as $usr) {
                                ?>
                                <option value="<?php echo $usr->id; ?>"><?php echo $usr->bin_code . ' | ' . $usr->description; ?></option>
                                <?php
                                
                                            }
                                          }    
                                
                                ?>
                                    </select>
                              </div>
                              <div class="form-group col-sm-6">
                                    <label for="source">Source</label>
                                    <select class="form-control" id="source" name="source">
                                      <option value="">--Select--</option>
                                      <option value="Agro-processing">Agro-processing</option>
                                      <option value="Crop Planting">Crop Planting</option>
                                      <option value="Livestock">Livestock</option>
                                      <option value="Backorder">Backorder</option>
                                    </select>
                                  </div>
                         </div>
                        <div class="row">
                          <div class="form-group col-sm-12">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                         </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                      
                     <input type="hidden" id="warehouse_id" name="warehouse_id" value="<?php echo $member_id; ?>" />
                     <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
                    <button type="button" class="py-1 px-2 border farm-color mx-0 saveinv">Add New</button>
                    <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 editstaff_index" id="<?php echo $member_id; ?>" data-dismiss="modal">Close</button>
                  
                  </div>
                  
              </form>
            </div>
        </div>
      </div>

<?php


    
}else {
  $user->logout();
  Redirect::to('app.kealuck.com/login');
}

  ?>


 
  <script>
  function showInventory(perPageCount, pageNumber) {
      
        $.ajax({
            type: "GET",
            url: "view/assets_mgt/warehouses/select_inventory.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#load_inv").html(html);
                $('#load').html(''); 
            }
        });
    }
    
  
  
   $(document).ready(function(event) {
        showInventory(10, 1);
        
       //alert(<?php echo $member_id ?>);
       
        $('.success_alert').hide();
        $('.warning_alert').hide();
        $('.bin_click_view').hide();
         
        $('.transactions_click_view').show();
           
        $('.inventory_click').on('click', function(){
               
                $('.bin_click_view').hide();
                $('.transactions_click_view').show();
               
           })
           
        $('.bin_click').on('click', function(){
               
                $('.transactions_click_view').hide();
                $('.bin_click_view').show();
               
           })
       
        $('.saveinv').on('click', function(e){
        
                    let form = $('#warehouses_form')[0]; // You need to use standard javascript object here 
                    let formData = new FormData(form); 
       	        
       	        //alert(formData);
       	        
    			
    			$.ajax({
        				url: 'view/assets_mgt/warehouses/insert_inventory.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#sload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                        
       	    e.preventDefault();
    	});

    	$('.editstaff_index').click(function (e) {
		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: 'view/assets_mgt/warehouses/editview.php',
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
       
        $('.prev_page').click(function (e) {
	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/warehouses/index.php",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
          
        $('.singledelete').on('click', function(e){
                
    	        let id      = $(this).attr('lang');
    	        let table   = $(this).attr('title');
    	        
    	        let confirmation = confirm("Are you sure you want to remove the item?");
    	       
    	       
    	       if (confirmation) { 
    	       
             
    	        $.ajax({
    	           	url: 'view/assets_mgt/warehouses/delete.php',
    			    type: 'POST',
    	            data:{
    	                
    	                  id    :   id,
    	                  table :   table
    	                  
    	            },
    	            cache: false,
    	            success:function(data){
    	                $(".success_alert").html(data);
                        $(".success_alert").show();
                        $('#sload').html(''); 
    	            }
    	        });
    	        
    	       }
    	        e.preventDefault();
    	    });

        $('.inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val();
            let member_id = <?php echo $member_id ?>; 
	        	
	        	//alert(member_id)
	
            $.ajax({
                type: "GET",
                url: "view/assets_mgt/warehouses/select_inventory.php",
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
                    $("#load_inv").html(html);
                    $('#load').html(''); 
                }
            });
        
        
         evt.preventDefault();
        
       });


    event.preventDefault();
	});
	
    $(document).ready(function(evt){ 
        
        let member_id = <?php echo $member_id; ?>; 
		let transact_ = <?php echo $transact_; ?>; 
		
		
	//	alert(dataString)
	
        $.ajax({
            type: "POST",
            url: "view/assets_mgt/warehouses/select_inventory.php",
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
                $("#load_inv").html(html);
                $('#load').html(''); 
            }
        });
        
        
         evt.preventDefault();
        
      
       });
 </script>
 

  