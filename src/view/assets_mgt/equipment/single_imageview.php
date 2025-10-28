<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();
if ($user->isLoggedIn()) {
$username = escape($user->data()->id);

?>

  
  
  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
              <?php
                             $labeltax = Db::getInstance()->query("SELECT b.photoUrl, a.description, a.id as equipment_id
                                                                    FROM equipment a 
                                                                    left join equipmentphoto b on a.id = b.equipment_id
                                                                    WHERE b.id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                   
                              ?>
            <div class="row my-3 mb-4 justify-content-between">
                <div class="col-sm-6">
                       <h3>Image Viewer: <?php  echo $labelta->description; ?></h3>     
                  </div>  
                   <div class="col-sm-2">
                          <button type="button" class="farm-button-cancel py-1 ml-0 prev_page" id="<?php  echo $labelta->equipment_id; ?>">
                            <span class="fa fa-chevron-left"></span>
                          </button> 
                          <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member_id; ?>">
                            <span class="fa fa-refresh"></span>
                          </button>
                    </div> 
                </div>
               <div class="row my-3 mb-4 justify-content-between">
                <div class="container">
                       <img class="img-fluid" src='view/assets_mgt/equipment/<?php echo $labelta->photoUrl; ?>' alt='' />   
                  </div> 
                </div>


                </div>
            
            </div>

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
    $(document).ready(function(event){
         
        
    	$('.prev_page').click(function (e) {
		
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/editorder.php",
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
          
       
    	$('.current_page').click(function (e) {
    	    
    		let member_id = $(this).attr('id');
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/assets_mgt/equipment/single_imageview.php",
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

        
    	
       event.preventDefault();
   });
   
   </script>

