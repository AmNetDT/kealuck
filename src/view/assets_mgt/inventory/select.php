<?php

require_once '../../core/init.php';


$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username_id = escape($user->data()->id);



   $transact_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc limit 1");
   foreach($transact_year->results() as $transact_)
   $transact_ = $transact_->year;
    
   if(!empty($_REQUEST['member_id'])) {
        
     
        $member_id  = $_REQUEST['member_id'];
?>

        
  
    
       <div class="container-fluid">
               <?php

                    
                    $sqlQuery = Db::getInstance()->query("SELECT  a.id as inv_id, a.products_id, c.location, b.cost_per_unit,
                                                            b.sku_code, b.description, b.uom, b.metric_units, b.product_category, SUM(a.total_qty_credit - a.total_qty_debit) as quantity
                                                            FROM inventory a
                                                            LEFT JOIN products b on a.products_id = b.id 
                                                            LEFT JOIN worklocation c on a.warehouse_id = c.id
                                                            where a.transaction_year = '$member_id'
                                                            GROUP BY products_id");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                            
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>UoM</th>
                                            <th>Metric</th>
                                            <th>Category</th>
                                            <th>Warehouse</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($sqlQuery->results() as $inventory) { 
                    
                    	?>
                        
                                            <tr>
                                              <td><?php echo $inventory->sku_code; ?></td>
                                              <td><?php echo $inventory->description; ?></td>
                                              <td><?php echo $inventory->quantity; ?></td>
                                              <td><?php echo $inventory->cost_per_unit; ?></td>
                                              <td><?php echo $inventory->uom; ?></td>
                                              <td><?php echo $inventory->metric_units; ?></td>
                                              <td><?php echo $inventory->product_category; ?></td>
                                              <td><?php echo $inventory->location; ?></td>
                                              <td>
                                       
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                        <div class="edituser_view" id="<?php echo $inventory->inv_id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-info-circle "></i>&nbsp; Details</button>
                    
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

             <?php
                                          }
             
             ?>
            </div>


  <?php
          
    }else{
        
         

?>


        
       <div class="container-fluid">
                <?php

                    
                    $sqlQuery = Db::getInstance()->query("SELECT a.id as inv_id, a.products_id, c.location, b.cost_per_unit,
                                                            b.sku_code, b.description, b.uom, b.metric_units, b.product_category, SUM(a.total_qty_credit - a.total_qty_debit) as quantity
                                                            FROM inventory a
                                                            LEFT JOIN products b on a.products_id = b.id 
                                                            LEFT JOIN worklocation c on a.warehouse_id = c.id
                                                            where a.transaction_year = '$transact_'
                                                            GROUP BY products_id");
                    
                                     if (!$sqlQuery->count()) {
                                         
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                            
                                          } else {
                                            ?>
                                            
                       
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                                        <thead>
                                          <tr>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>UoM</th>
                                            <th>Metric</th>
                                            <th>Category</th>
                                            <th>Warehouse</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    
                        
                    
                        <?php 
                    
                    	                    foreach ($sqlQuery->results() as $inventory) { 
                    
                    	?>
                        
                                            <tr>
                                              <td><?php echo $inventory->sku_code; ?></td>
                                              <td><?php echo $inventory->description; ?></td>
                                              <td><?php echo $inventory->quantity; ?></td>
                                              <td><?php echo $inventory->cost_per_unit; ?></td>
                                              <td><?php echo $inventory->uom; ?></td>
                                              <td><?php echo $inventory->metric_units; ?></td>
                                              <td><?php echo $inventory->product_category; ?></td>
                                              <td><?php echo $inventory->location; ?></td>
                                              <td>
                                       
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                        <div class="edituser_view" id="<?php echo $inventory->inv_id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-info-circle "></i>&nbsp; Details</button>
                    
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
        <?php
                  }
                
                ?>
                            
                                </div>

        
            
  <?php
          
    }
                        
} else {
  $user->logout();
  Redirect::to('../../login/'); 
}


  ?>
 
	 <script>
     $(document).ready(function(event){
 
   
	
      $('.singledelete').on('click', function(e){
            
	        let del = $(this).attr('lang');
	        let title = $(this).attr('title');
	        //alert(del)
	        let confirmation = confirm("Are you sure you want to remove the item?");
	       
	       
	       if (confirmation) { 
	       
        
         
	        $.ajax({
	           	url: 'view/assets_mgt/maintenance/delete.php',
			    type: 'POST',
	            data:{
	                  del     :   del,
	                  title   :   title
	            },
	            cache: false,
	            success:function(data){
	                $(".success_alert").html(data);
                    $(".success_alert").show();
	            }
	        });
	        
	       }
	        e.preventDefault();
	    });

    event.preventDefault();
	});
        
 </script>
 