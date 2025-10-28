<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {


     

   $transact_ = date('Y');
    
   if(!empty($_REQUEST['transaction_year'])) {
        
     $transaction_year_month = $_REQUEST['transaction_year'];
       
?>
       



  <div class="table-responsive data-font" style="height: 120%;">
      <div class="row justify-content-between">
                    <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                    <div class="resulter1">
                     </div>                                      
    </div>
                <?php



                  $user = Db::getInstance()->query("SELECT * FROM sales
                                                    WHERE transaction_year = '$transaction_year_month'");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Sales Code</th>
                          <th>Payee</th>
                          <th>Date &amp; Time</th>
                          <th>Description</th>
                          <th>Warehouse</td>
                          <th>Type</th>
                          <th class="text-right pr-3">Amount</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->sales_code; ?></td>
                            <td><?php echo $user->payee_customers; ?></td>
                            <td><?php echo $user->date_time; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->warehouse; ?></td>
                            <td><?php echo $user->type; ?></td>
                            <td class="text-right pr-3"><?php 
                            
                                $number = $user->amount; 
                                $Total_Amount = number_format($number);
                                echo $Total_Amount; 

                            
                            ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="contractor_view" lang="view/sales/customers" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Customer Details</button>

                                    </div>
                                  <div class="dropdown-divider"></div>
                                    <div class="edituser_view" lang="view/sales/customers" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit Customer</button>

                                    </div>
                                  </div>
                              </div>

                               
                             
                            </td>
                            <!-- Modal -->

  
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

       



  <div class="table-responsive data-font" style="height: 120%;">
      <div class="row justify-content-between">
                    <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                    <div class="resulter1">
                     </div>                                      
    </div>
                <?php



                  $user = Db::getInstance()->query("SELECT * FROM sales
                                                    WHERE transaction_year = '$transact_'");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Sales Code</th>
                          <th>Payee</th>
                          <th>Date &amp; Time</th>
                          <th>Description</th>
                          <th>Warehouse</td>
                          <th>Type</th>
                          <th class="text-right pr-3">Amount</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->sales_code; ?></td>
                            <td><?php echo $user->payee_customers; ?></td>
                            <td><?php echo $user->date_time; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->warehouse; ?></td>
                            <td><?php echo $user->type; ?></td>
                            <td class="text-right pr-3"><?php 
                            
                                $number = $user->amount; 
                                $Total_Amount = number_format($number);
                                echo $Total_Amount; 

                            
                            ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="contractor_view" lang="view/sales/customers" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Customer Details</button>

                                    </div>
                                  <div class="dropdown-divider"></div>
                                    <div class="edituser_view" lang="view/sales/customers" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit Customer</button>

                                    </div>
                                  </div>
                              </div>

                               
                             
                            </td>
                            <!-- Modal -->

  
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


      $('.reload').click(function (e) {
		
		var ed = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
   // alert(ed);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});
	
       
       
    	$('.contractor_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var dataString = "rsData=" + id;
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			cache: false, type: 'post', async: true,
			url: ed + "/view.php",
			data:{
			    'id':id
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