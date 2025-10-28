<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

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
                <div id="accounttile" class="col-sm-12">
         <?php


            $users = Db::getInstance()->query("SELECT a.*, b.username, c.name as supplier,
                  a.supplier_id, c.supplier_code
                  FROM equipment a 
                  Left join users b on a.added_by = b.id 
                  Left Join staff_record d on b.username = d.user_id 
                  left join suppliers c on a.supplier_id = c.id
                  WHERE a.id = $member_id");
                  
            foreach ($users->results() as $use) {
                
                $purchase_code = $use->equipment_code;
                                        
                             
            ?>
              <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Equipment Received Note (ERN): <?php echo $purchase_code; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                      
                    </div> 
                </div>
                <div class="row justify-content-between mr-2">
                    <div class="col-sm-12 success_alert mr-0"></div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9 pl-5 mr-0">
                        <?php
                        
                            $labeltax = Db::getInstance()->query("SELECT SUM(qty) as gqty
                                                    FROM item_received 
                                                    WHERE equipment_id = $member_id");     
                        if($labeltax->count()){
                            foreach ($labeltax->results() as $labelta) {
                         
                        
                        $labelpur = Db::getInstance()->query("SELECT SUM(qty) as pqty
                                                    FROM equipment_order 
                                                    WHERE equipment_id = $member_id");   
                            foreach ($labelpur->results() as $labelpu) {
                                
                                
                                    $gqty = $labelta->gqty;
                                    $pqty = $labelpu->pqty;
                                    if($pqty != $gqty || empty($gqty)){
                        
                        ?>
                    <button type="button" class="farm-button-cancel py-1" data-toggle="modal" data-target="#ordermodal">
                        <span class="fa fa-save"> Update</span>
                      </button>
                      <?php
                                    }
                               }
                            }
                        }
                      
                      ?>
                </div>
                    <div class="col-sm-3 mr-0">
        
                      <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" lang="view/assets_mgt/equipment/editorder.php" id="#">
                        <span class="fa fa-chevron-left"></span>
                      </button>  
                      <button type="button" class="farm-button py-1 ml-0 view_invoice" id="<?php echo $member_id; ?>">
                        <span class="fa fa-print"> Supplier Invoice</span>
                      </button> 
                      <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                        <span class="fa fa-refresh"></span>
                      </button>
                      
                </div>
               </div>  
                <div class="row">
                      <div class="col-sm-12">
                     <div class="table-responsive data-font px-3" style="height: 120%;">
                  <div class="row justify-content-between my-5">
                                                       
                        <?php

                  $user = Db::getInstance()->query("SELECT *  
                  FROM item_received
                  WHERE equipment_id = $member_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Description</th>
                          <th style="text-align:right">Qty Received</th>
                          <th>Received Date</th>
                          <?php
                            
                                 if($pqty != $gqty || empty($gqty)){
                            
                            ?>
                          <th>&nbsp;</th>
                            <?php
                            
                                 }
                            
                            ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td style="text-align:right"><?php echo $user->qty; ?></td>
                            <td><?php echo $user->received_date; ?></td>
                            <?php
                            
                                 if($pqty != $gqty || empty($gqty)){
                            
                            ?>
                            <td>
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="singledelete" id="<?php echo $user->id; ?>" title="item_received" >
                                        <button class="dropdown-item">
                                             <i class="fa fa-trash"></i> &nbsp;Remove</button>

                                    </div>
                              </div>

                              </div> 
                             
                            </td>
                            <?php
                            
                                 }
                            
                            ?>

  
                          </tr>

 
                        <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td>&nbsp;</td>
                            <td colspan='2' style="text-align:right" class="alert alert-primary p-2 m-0">
                            <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(qty) as gqty
                                                                    FROM item_received 
                                                                    WHERE equipment_id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                      $labelpur = Db::getInstance()->query("SELECT SUM(qty) as pqty
                                                                FROM equipment_order 
                                                                WHERE equipment_id = $member_id");   
                                foreach ($labelpur->results() as $labelpu) {
                                    
                                    
                                    $pqty = $labelpu->pqty;
                                    
                                     $totalreceived = $labelta->gqty;
                               
                                     
                                     if($totalreceived != ''){
                            ?>
                                    
                            <div><b>Total Equipment Received</b> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $totalreceived; ?> of <?php echo $pqty; ?></div>
                            <?php
                                     }
                                 
                                     
                                
                        
                                 
                            ?>
                                    
                            
                            
                            </td>
                            <?php 
                            $gqty = $labelta->gqty;
                            
                            if($pqty != $gqty || empty($gqty)){
                            ?>
                            <td colspan='2' class="alert alert-warning p-2 m-0" style="text-align:center">Partially Received</td>
                            <?php
                            }else {
                                ?>
                            <td colspan='2' class="alert alert-success p-2 m-0" style="text-align:center">All items received completely.</td>
                            <?php
                            }
                            
                            ?>
                        </tr>
                        <?php
                                     }
                                 
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
                               <!-- Modal -->
<div class="modal fade" id="ordermodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Update Equipment Received Note (ERN): <?php echo $purchase_code; ?></p>
            <button type="button" class="bg-secondary px-2 border text-white current_page" data-dismiss="modal" aria-label="Close" id="<?php echo $member_id; ?>">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
                    <form id="receivedgood_form" method="post">
                            <div class="modal-body" id="rece_good_form">
                          
                                 <div class="row">
                                     <div class="col-sm-12">    
                                         <div class="row my-4">
                                            <div class="col-sm-12">
                                                 <div class="success_alert"></div>
                                                 <div class="warning_alert"></div>
                                             </div>
                                        </div>
                                         <div class="row">
                                         
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control description" id="descri" readonly/>
                                            
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="qty">Qty</label>
                                            <input type="number" class="form-control qty" id="qty" name="qty" class="qty" min="0" />
                                            
                                         
                                          </div>
                                          <div class="form-group col-sm-6">
                                          
                                            <label for="received_date">Received Date</label>
                                            <input type="datetime-local" class="form-control" id="received_date" name="received_date" />
                                            
                                          </div>  
                                          
                                          <input type="hidden" name="equipment_id" id="equipment_id" value="<?php echo $member_id; ?>"  />
                                </div>
                             </div>
                          </div>
                       </div>
                       
            <div class="modal-footer">
                <button type="button" class="farm-button py-1 ml-0 SaveGood" id="btnsave">
                    <span class="fa fa-save"> Save</span>
                  </button>
                <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current_page" data-dismiss="modal" id="<?php echo $member_id; ?>">Close</button>
              </div>
                     </form>
          
    </div>
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
         
      
     	$('.view_invoice').click(function (e) {
		
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/view.php",
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
     
    	$('.prev_page').click(function (e) {
		
    		let ed = $(this).attr('lang');
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/index.php",
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
          
       
    	$('.current_page').click(function (e) {
    		
    		let member_id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/itemreceived.php",
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



        $('.SaveGood').on('click', function(){
       
                let form = $('#receivedgood_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/assets_mgt/equipment/insertitemreceived.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#btnsave').hide();
                           
                           
                            $("#received_date").remove();
                            $("#description").remove();
                            $("#qty").remove();
                            $("#rece_good_form").remove();
                           
                            
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
       
       
        
            $('.singledelete').on('click', function(e){
                
                  if (confirm("Are you sure you want to remove this item?") == true) {
                      
                    	let tablename =   $(this).attr('title');
    		            let id =          $(this).attr('id');
    		            
                    $.ajax({
            
        				type: "POST",
        				url: 'view/assets_mgt/equipment/delete.php',
                		data: {
                		    tablename   : tablename,
                            id  : id
                		    
                		},
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
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