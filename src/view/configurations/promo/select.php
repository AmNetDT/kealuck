<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

$sqlQuery = Db::getInstance()->query("SELECT a.*, b.username FROM promo a left join users b on a.added_by = b.id order by id desc");


if (!$sqlQuery->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>



<div class="table-responsive data-font" style="height: 100%;">
      
    
    <table id="selectuserabduganiu" class="table table-hover table-bordered" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Voucher Code</th>
                          <th>Wholesale</th>
                          <th>Status</th>
                          <th>Description</th>
                          <th>Amount</td>
                          <th>Valid Until</th>
                          <th>Note</th>
                          <th>Author</td>
                          <th>Modified</th>
                          <th>Created</th>
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
                            <td><?php echo $user->voucher_code; ?></td>
                            <td><?php echo $user->wholesale; ?></td>
                            <td><?php echo $user->status; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->amount; ?></td>
                            <td><?php echo $user->valid_until; ?></td>
                            <td><?php echo $user->note; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->modifieddate; ?></td>
                            <td><?php echo $user->createddate; ?></td>
                            <td>
                                
                              <div class="dropdown">
                                  
                                <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  <i style="font-size:14px" class="fa">&#xf142;</i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="editstock" lang="view/configurations/promo" id="<?php echo $user->id; ?>">
                                        <button class="dropdown-item">
                                             <i class="fa fa-edit"></i>&nbsp; View/Edit Voucher</button>

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
    	
    		//Pssing values to nextPage 
    		var rsData = "eQvmTfgfru";
    		var dataString = "rsData=" + rsData;
       // alert(ed);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: ed + "/editpromo.php",
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
 