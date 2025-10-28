<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
$userSyscategory = escape($user->data()->syscategory_id);
$privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

?>

       

  <div class="table-responsive data-font" style="height: 120%;">
      <div class="row justify-content-between">
                    <div class="col-md-12 alert alert-success pl-5 p-2 resulter"></div>
                    <div class="resulter1">
                     </div>                                      
    </div>
                <?php

                if ($userSyscategory == 1 || $userSyscategory == 2) {


                  $user = Db::getInstance()->query("SELECT * FROM users WHERE id !=$username");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Username</th>
                          <th>Type of User</th>
                          <th>Department</th>
                          <th>Supervisor</th>
                          <th>Designation</th>
                          <th>Reg. By</td>
                          <th>Created</th>
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
                            <td><?php echo $user->username; ?></td>
                            <td><?php

                                $sysId = $user->syscategory_id;
                                $syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id`=$sysId");
                                foreach ($syscategory->results() as $sysName) {
                                  print $sysName->name;
                                }
                                ?></td>
                            <td><?php

                                $departmentId = $user->department_id;
                                $departments = Db::getInstance()->query("SELECT * FROM `departments` WHERE `id`=$departmentId");
                                foreach ($departments->results() as $department) {
                                  echo $department->name;
                                }
                                ?></td>
                            <td><?php
                                    
                                    $supervisor_id = $user->supervisor_id;
                                    $supervisor = Db::getInstance()->query("SELECT CONCAT(firstname, ' ', lastname) AS supervisor, id FROM `staff_record` WHERE `id`=$supervisor_id");
                                    foreach ($supervisor->results() as $superv) {
                                    echo $superv->supervisor; 
                                    }
                                    
                            ?></td>
                            <td><?php

                                $jobtitle_id = $user->jobtitle_id;
                                $jobtitle = Db::getInstance()->query("SELECT * FROM `job_title` WHERE `id`=$jobtitle_id");
                                foreach ($jobtitle->results() as $jobtitle) {
                                  echo $jobtitle->name;
                                }
                                ?></td>
                            <td><?php
                                $added_id = $user->added_by;
                                $addedby = Db::getInstance()->query("SELECT * FROM `users` WHERE `id`=$added_id");
                                foreach ($addedby->results() as $added) {
                                  echo $added->username;
                                }
                                ?></td>
                            <td><?php echo $user->joined; ?></td>
                            <td>
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                
                                    <div class="edituser_view" lang="view/usermanager/users" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit User</button>

                                    </div>
                                    
                            <?php

                        if ($userSyscategory == 1) {

                        ?>
                                  <div class="dropdown-divider"></div>
                                    <div class="change_password_view" lang="view/usermanager/users" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Change Password</button>

                                    </div>
                                  </div>
                                  
 <?php
                        }
                            ?>
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

    //change_password_view
    
    	$('.change_password_view').click(function (e) {
		
		var ed = $(this).attr('lang');
		var id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/change_password.php",
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
	

        });
 </script>
	 