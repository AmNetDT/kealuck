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
          
           <h4>Received</h4>
          <div class="row my-3">
              <div class="col-sm-12">
                <div class="row justify-content-between">
                  
                  <div class="col-sm-2">
                                        
                                    </div>
                   <div class="col-sm-7">
                      <!--<button class="farm-button" id="add_button" data-toggle="modal" data-target="#JobType" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Job Type</span>
                      </button>!-->
                     
                      </div> 
                      
                   
                    <div class="col-sm-3 text-right">
                      <button class="farm-button-icon-button py-1 ml-0 current" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  </div>
                  </div>
                  
                
              </div>
              <div class="row">
                  <diiv class="col-sm-12 p-2 success_alert"></diiv>
                  <diiv class="col-sm-12 p-2 warning_alert"></diiv>
                </div>  
              <div id="userr"></div>
               <div id="load"></div>
               
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
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/sales/received/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
    }
        
        $(document).ready(function(event) {
            showUsers(10, 1);
   
       
    	    $('.current').click(function (e) {
		
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/sales/received',  
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
  

