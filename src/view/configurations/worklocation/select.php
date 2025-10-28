<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);
?>

       


<div class="table-responsive data-font" style="height:100%;">
     
                <?php



                  $user = Db::getInstance()->query("SELECT a.*, b.username, c.description as type
                  FROM worklocation a 
                  left join users b on a.added_by = b.id 
                  left join worklocation_type c on a.worklocation_type_id = c.id
                  order by id desc");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="fatima" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th>S/No</th>
                          <th>Location</th>
                          <th>Type</th>
                          <th>Address</td>
                          <th>Longitude</td>
                          <th>Latitude</td>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $user->location; ?></td>
                            <td><?php echo $user->type; ?></td>
                            <td><?php echo $user->address; ?></td>
                            <td><?php echo $user->longitude; ?></td>
                            <td><?php echo $user->latitude; ?></td>
                            <td>
                                <div class="dropdown">
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="edit_" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; Edit</button>
                                    </div>
                                 
                                  </div>

                                </div>
                              </div>
                                </td>
                            
                            <!-- Modal -->

  
                          </tr>

 
                        <?php
                        $i++;
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
 
    	$('.edit_').click(function (e) {
    		
    		let id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/worklocation/editlocation.php",
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