<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
$userSyscategory = escape($user->data()->syscategory_id);
$username = escape($user->data()->username);
?>


  <div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron pt-5 bg-white">
          <h3>Staff</h3>
          <h6 class="card-title p-2">Staff Records</h6>

          <div class="row">
              
             
              </div>
              <div id="staff"></div>
               <div id="load"></div>
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
  	function showStaff(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/usermanager/staff/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#staff").html(html);
                $('#load').html(''); 
            }
        });
    }
    
    $(document).ready(function() {
        showStaff(10, 1);
    });
    
   
    
    
 </script>
<script>
   $(document).ready(function(event) {
       
       
    	$('.editstaff_index').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed,
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
 
        