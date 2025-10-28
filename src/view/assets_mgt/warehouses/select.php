<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$username = escape($user->data()->id);

   
?>

<div class="table-responsive data-font">
     
                <?php

                  $wl = Db::getInstance()->query("SELECT a.*, b.username, c.description as type
                  FROM worklocation a 
                  left join users b on a.added_by = b.id 
                  left join worklocation_type c on a.worklocation_type_id = c.id
                  order by id desc");

                  if (!$wl->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>

                    <table id="fatima" class="table table-hover table-bordered" style="font-size:0.8rem">
                      <thead>
                        <tr>
                          <th>S/No</th>
                          <th>Location</th>
                          <th>Type</th>
                          <th>Address</td>
                          <th style="width:2%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$i = 1;
                        foreach ($wl->results() as $wl) {

                        ?>

                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $wl->location; ?></td>
                            <td><?php echo $wl->type; ?></td>
                            <td><?php echo $wl->address; ?></td>
                            <td>
                                    
                                  <div class="dropdown">
                                      
                                    <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                      <i style="font-size:14px" class="fa">&#xf142;</i>
                                    </button>
                                    <div class="dropdown-menu">
                                      
                                                <div class="accounting_view" id="<?php echo $wl->id; ?>">
                                                    <button class="dropdown-item">
                                                         <i class="fa fa-search"></i>&nbsp; Details</button>
                            
                                                </div>
                                                
                                      </div>
                                      
                                      
                                  </div>
                                 
                                </td>
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
  Redirect::to('app.kealuck.com/login');
}


  ?>
   
	 <script>
	      $(document).ready(function(){
 
    		$('.accounting_view').click(function (e) {
		
        		let member_id = $(this).attr('id');
        		
        		//alert(member_id)
        		
        		$("#loader_httpFeed").show();
        		$.ajax({
        			type: "POST",
        			url: "view/assets_mgt/warehouses/editview.php",
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

	});
	 </script>