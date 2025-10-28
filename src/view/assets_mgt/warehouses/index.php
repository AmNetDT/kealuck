<?php

require_once '../../core/init.php';

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
      <div class="jumbotron pt-5 bg-white">
            <div class="row m-3 mb-4">
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Warehouses</h3>
            </div>
            <div class="col-sm-12">
                <div class="row justify-content-end mb-4">
                    
                   <div class="col-sm-11">
                      
                      </div>
                      
                  
                    <div class="col-sm-1">
                      
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>
                </div>
              </div>
              
                
         <div class="row">
            <div class="col-12">
            <div id="workview"></div>
               <div id="wload"></div> 
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
   function showWorkLocation(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/assets_mgt/warehouses/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#wload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#workview").html(html);
                $('#wload').html(''); 
            }
        });
    }
    
   
   $(document).ready(function(event) {
        showWorkLocation(4, 1);
        showLocation(4, 1);
        
        $('.success_alert').hide();
        $('.warning_alert').hide();
        
        $('.editstaff_index').click(function (e) {
		
		$.ajax({
			type: "POST",
			url: 'view/assets_mgt/warehouses/index.php',
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
  

  