<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

    $userSyscategory = escape($user->data()->syscategory_id);

?>

       

  <div class="table-responsive data-font" style="height: 120%;">
      <div class="row justify-content-between">
                    <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                    <div class="resulter1">
                     </div>                                      
    </div>
                <?php

               


                  $user = Db::getInstance()->query("SELECT * FROM suppliers order by id desc");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Supplier Code</th>
                          <th>Supplier Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Category</td>
                          <th>Debit</th>
                          <th>Credit</th>
                          <th>Balance</td>
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
                            <td><?php echo $user->supplier_code; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->category; ?></td>
                            <td><?php  ?></td>
                            <td><?php ?></td>
                            <td><?php ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                   <div class="contractor_view" lang="view/purchases/suppliers" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Supplier Details</button>

                                    </div>
                                    <?php
        
                                             if ($userSyscategory == 1 || $userSyscategory == 2) {
                                                 
                                    ?>
                                  <div class="dropdown-divider"></div>
                                    <div class="edituser_view" lang="view/purchases/suppliers" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit Supplier</button>

                                    </div>
                                    <?php
                                             }
                                  ?>
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
     $(document).ready(function(){
          
         $('.resulter').hide();
         $('.resulter1').hide();
         
     })
 </script>  
 <script>
     $(document).ready(function(){
         
  
 
	$('.edituser_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		var member_id = $(this).attr('id');
	
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


       
    	$('.contractor_view').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
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