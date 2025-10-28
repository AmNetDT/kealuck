<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);

?>




 <div class="table-responsive data-font">
                <?php

                $staffa = Db::getInstance()->query("SELECT DISTINCT sr.user_id as user_id, CONCAT(sr.firstname,' ', sr.othername,' ',sr.lastname) as staffname, sr.id as id,
                    sr.firstname, sr.othername, sr.lastname, sr.email, sr.phone, sr.image, sr.date_of_birth, sr.next_of_kin as next_of_kin, 
                    sr.next_of_kin_phone as next_of_kin_phone,
                    sr.address as staff_address, sr.next_of_kin_address as next_of_kin_address, sr.next_of_kin_email as next_of_kin_email,
                    sr.gross_salary as gross_salary, sr.working_hours as working_hours, sr.work_mobile as work_mobile, sr.work_email as work_email, sr.gender as gender, 
                    sr.marital_status as marital_status, sr.bank_name as bank_name, sr.bank_acc as bank_acc, sr.edu_school as edu_school, 
                    sr.edu_field_of_study as edu_field_of_study, 
                    sr.edu_certificate_level as edu_certificate_level, sr.edu_date as edu_date, sr.address as address, sr.emergency_contact_name as emergency_contact_name, 
                    sr.emergency_phone as emergency_phone, sr.nationality as nationality, sr.national_identification_no as national_identification_no, sr.passport_no as passport_no,
                    sy.name as syscategory, wl.location as worklocation,
                    jt.name as jobtitle, d.name as department, 
                    u.supervisor_id,
                    sg.guarantor_fullname as guarantor_fullname, sg.guarantor_address as guarantor_address, sg.guarantor_phone as guarantor_phone, 
                    sg.guarantor_email as guarantor_email, sg.guarantor_occupation as guarantor_occupation, sg.relation_to_emp as relation_to_emp, 
                    sg.guarantor_image as guarantor_image
                    FROM  staff_record sr 
                    LEFT JOIN users u ON u.username = sr.user_id
                    LEFT JOIN job_title jt ON u.jobtitle_id = jt.id
                    LEFT JOIN departments d ON u.department_id = d.id
                    LEFT JOIN worklocation wl ON u.worklocation_id = wl.id
                    LEFT JOIN staff_guarantor sg ON sr.user_id = sg.user_id
                    LEFT JOIN syscategory sy ON sy.id = u.syscategory_id");

                if (!$staffa->count()) {
                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                } else {

                ?>
                  <table id="staffselectview" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                    <thead>
                      <tr>
                        <th width="20">SN</th>
                        <th width="150">Employee ID</th>
                        <th width="180">Full name</th>
                        <th width="180">Department</th>
                        <th width="160">Job Title</th>
                        <th width="160">Supervisor</th>
                        <th width="140">Location</th>
                        <th width="30">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach ($staffa->results() as $staff) {

                      ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php 
                                      echo $staff->user_id;
                          ?></td>
                          <td><?php echo $staff->staffname ?></td>
                          <td><?php 
                          
                          echo $staff->department;
                          
                          ?></td>
                          <td><?php 
                          
                          echo $staff->jobtitle;
                          
                          
                          ?></td>
                          <td><?php 
                          
                          $supervisor_id = $staff->supervisor_id;
                          $sup = Db::getInstance()->query("SELECT CONCAT(firstname,' ',lastname) as staffn FROM staff_record WHERE id = $supervisor_id");
                          foreach($sup->results() as $supe){
                             echo $supe->staffn;
                              
                          }
                          ?></td>
                          <td><?php 
                          
                          echo $staff->worklocation;
                          
                          ?></td>
                          <td>
                                <input type="hidden" id="kollu" value="<?php echo $staff->id; ?>"/>
                                <div class="dropup">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="editstaff_view" id="<?php echo $staff->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-search"></i>&nbsp; Details</button>

                                    </div>
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
   $(document).ready(function(event) {
       
       
    	$('.editstaff_view').click(function (e) {
		
		let id = $(this).attr('id');
		
        //alert(id);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/staff/view.php",
			data:{
			    id : id
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
	 