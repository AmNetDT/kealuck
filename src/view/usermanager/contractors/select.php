<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$userSyscategory = escape($user->data()->syscategory_id);
$privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

?>

       
<!-- Datatable !-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <script>
    $(document).ready(function() {
      $('#selectuserabduganiu').DataTable();
    });
  </script>
  <!-- End datatable !-->


  <div class="table-responsive data-font" style="height: 120%;">
      <div class="row justify-content-between">
                    <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                    <div class="resulter1">
                     </div>                                      
    </div>
                <?php

                if ($userSyscategory == 1 || $userSyscategory == 2) {


                  $user = Db::getInstance()->query("SELECT * FROM contractors order by id desc");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Code</th>
                          <th>Contractor</th>
                          <th>Email</th>
                          <th>Category</th>
                          <th>Phone</td>
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
                            <td><?php echo $user->contractor_code; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->category; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="contractor_view" lang="view/usermanager/contractors" id="<?php echo $user->id; ?>">
                                  <button class="dropdown-item" id="">
                                    <i class="fa fa-search"></i>&nbsp; Contractor Details</button>
                                    
                                      
                                  </div>
                                  
                                  <div class="dropdown-divider"></div>
                                    <div class="editcontractor" lang="view/usermanager/contractors" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit Contractor</button>

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
         
  
 
	$('.editcontractor').click(function (e) {
		
		var ed = $(this).attr('lang');
		var id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/edituser.php",
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
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
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