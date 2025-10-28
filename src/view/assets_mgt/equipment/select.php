<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

    $userSyscategory = escape($user->data()->syscategory_id);
    $username = escape($user->data()->id);
?>

       


       
  <div class="table-responsive data-font">
      
                <?php



                  $user = Db::getInstance()->query("SELECT * FROM equipment ORDER BY id DESC");

                 
                    if (!$user->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                        
                        
                    ?> 
                    
                        <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:100%; font-size:0.8em;">
                          <thead>
                            <tr> 
                              <th>SN</th>
                              <th>Code</th>
                              <th>Description</th>
                              <th>Type</th>
                              <th>Brand</th>
                              <th>Modal</th>
                              <th>Plate No.</td>
                              <th>Serial No.</td>
                              <th>Last Service</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($user->results() as $user) {
                            
                            $equipment_code = $user->equipment_code;
                           
                                        
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $user->equipment_code; ?></td>
                                <td><?php echo $user->description; ?></td>
                                <td><?php echo $user->type; ?></td>
                                <td><?php echo $user->brand; ?></td>
                                <td><?php echo $user->model; ?></td>
                                <td><?php echo $user->plate_number; ?></td>
                                <td><?php echo $user->serial_number; ?></td>
                                <td>&nbsp;</td>
                                <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                        <div class="edituser_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-info-circle "></i>&nbsp; Details</button>
                    
                                        </div>
                                     <?php
                                     
                                 $findtax = Db::getInstance()->query("SELECT * FROM approval WHERE request_code = '$equipment_code' AND approval_status = 'Approved'");     
                                 if(!$findtax->count()){
                                     ?>
        <div class='dropdown-divider'></div>
        <div class='singledelete' id='<?php echo $user->id; ?>' title='equipment' >
            <button class='dropdown-item'><i class='fa fa-trash'></i>&nbsp; Remove</button></div>
                                     <?php
                                  }else{
                                        ?> 
                                      <div class="dropdown-divider"></div>
                                        <div class="accounting_view" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-university"></i>&nbsp; Accounting</button>
                    
                                        </div>
                                      <div class="dropdown-divider"></div>
                                        <div class="e_maintainance" id="<?php echo $user->id; ?>">
                                            <button class="dropdown-item">
                                                 <i class="fa fa-binoculars"></i>&nbsp; Maintainance</button>
                    
                                        </div>
                                        <?php
                                        
                                                }
                                        
                                        ?>
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
          
                        
} else {
  $user->logout();
  Redirect::to('../../login/'); 
}


  ?>
 <script>
     $(document).ready(function(){
         
    $('.e_maintainance').click(function (e) {
		
		let member_id = $(this).attr('id');
	
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/assets_mgt/maintenance/index.php",
			data: {
				member_id: member_id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});
 
	$('.edituser_view').click(function (e) {
		
		
		let member_id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/assets_mgt/equipment/editorder.php",
			data: {
				member_id : member_id
			},
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});

       
    	$('.accounting_view').click(function (e) {
		
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