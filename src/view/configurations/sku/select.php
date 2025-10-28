<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {



if(!empty($_REQUEST['title'])) {
                        $title_cat  = $_REQUEST['title'];
                        
$sqlQuery = Db::getInstance()->query("SELECT * FROM products 
                                     WHERE type = 'input' AND product_category ='$title_cat'
                                     ORDER BY id DESC");


?>


<div class="table-responsive data-font" style="height: 100%;">
      
    
                    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>SKU Code</th>
                          <th>Description</th>
                          <th>UoM</th>
                          <th>Product Type</th>
                          <th>Product Category</th>
                          <th>Order From</th>
                          <th>Metric</th>
                          <th>Cost per Unit</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($sqlQuery->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->sku_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->uom; ?></td>
                            <td><?php echo $user->product_type; ?></td>
                            <td><?php echo $user->product_category; ?></td>
                            <td><?php echo $user->order_from; ?></td>
                            <td><?php echo $user->metric_units; ?></td>
                            <td><?php echo $user->cost_per_unit; ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="editstock" lang="view/configurations/sku" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit</button>

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
        
    }else{
        
        $sqlQuery = Db::getInstance()->query("SELECT * FROM products 
                                     WHERE type = 'input'
                                     ORDER BY id DESC");
        if(!$sqlQuery->count()){
                echo "<div class='row justify-content-center m-5'><h3>No data to display</h3></div>";
        }else{
            ?>
            
        <div class="table-responsive data-font">
          
        
            <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>SN</th>
                              <th>SKU Code</th>
                              <th>Description</th>
                              <th>UoM</th>
                              <th>Product Type</th>
                              <th>Product Category</th>
                              <th>Order From</th>
                              <th>Metric</th>
                              <th>Cost per Unit</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($sqlQuery->results() as $user) {
    
                            ?>
    
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->sku_code; ?></td>
                                <td><?php echo $user->description; ?></td>
                                <td><?php echo $user->uom; ?></td>
                                <td><?php echo $user->product_type; ?></td>
                                <td><?php echo $user->product_category; ?></td>
                                <td><?php echo $user->order_from; ?></td>
                                <td><?php echo $user->metric_units; ?></td>
                                <td><?php echo $user->cost_per_unit; ?></td>
                                <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="editstock" lang="view/configurations/sku" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-edit"></i>&nbsp; Edit</button>
    
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
 
    	$('.editstock').click(function (e) {
    		
    		var ed = $(this).attr('lang');
    		var id = $(this).attr('id');
    	
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/editstock.php",
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

        
	    
	});
        
 </script>
 