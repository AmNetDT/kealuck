<?php

require_once '../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>


  
  
  <link rel="stylesheet" type="text/css" href="css/evo-calendar.min.css" />
  
  <!-- End datatable !-->
<div id="body_general">
    <div class="container-fluid p-0 bg-success">
        <div id="accounttile">
          <div class="col-sm-12 col-sm-6">
            <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
          </div>
        </div>
      <div class="jumbotron pt-5 bg-white">
       
            <div class="row my-4">
                  <div class="col-sm-12">
                    <h3>Goal Settings</h3>
                </div>
            </div>
                <div class="row justify-content-between">
                 
                   <div class="col-sm-6">
                      
                      <button class="farm-button-cancel py-1 ml-0 editstaff_view">
                        <span class="fa fa-check-circle-o"> Proceeds</span>
                      </button>
                      <button class="farm-button py-1 ml-0 approved_view">
                        <span class="fa fa-search"> Approved</span>
                      </button>
                    </div>
                    <div class="col-sm-6">
                      <div class="row justify-content-end pr-3">
                        <div style="float:left">
                          <button class="farm-button py-1 mx-1" id="add_button" data-toggle="modal" data-target="#guarantormodal">
                            <span class="fa fa-user-plus"> Goals</span>
                          </button>
                          <button class="farm-button-cancel py-1 mx-0" id="add_button" data-toggle="modal" data-target="#seasonmodal" data-target="#staticBackdrop">
                            <span class="fa fa-dollar"> Meetings</span>
                          </button>
                          
                          <button class="farm-button-icon-button py-1 ml-0 current" id="#">
                            <span class="fa fa-refresh"></span>
                          </button>
                        </div>
                        
                        
                        
                      </div>
                    </div>
             
                </div>
                <div class="row justify-content-between">
                    
              <div class="row my-4">
                  <div class="col-sm-12">
                        <h6>All Events</h6>
                    </div>
              </div>

                <!-- Column -->
                <!-- Add the evo-calendar.css for styling -->

                <div id="evoCalendar"></div>
                <!-- Add the evo-calendar.js for.. obviously, functionality! -->

                <script>
                  //See the documentation https://github.com/edlynvillegas/evo-calendar
                  $(document).ready(function() {
                    $("#calendar").evoCalendar();

                    $("#evoCalendar").evoCalendar({
                      calendarEvents: [{
                          id: 'bHay68s', // Event's ID (required)
                          name: "Harvest Crop", // Event name (required)
                          date: "February/06/2022", // Event date (required)
                          type: "Harvest", // Event type (required)
                          everyYear: false // Same event every year (optional)
                        },
                        {
                          name: "Vacation Leave",
                          badge: "02/13 - 02/15", // Event badge (optional)
                          date: ["February/16/2022", "February/17/2022"], // Date range
                          description: "Vacation leave for 3 days.", // Event description (optional)
                          type: "event",
                          color: "#63d867" // Event custom color (optional)
                        }
                      ]
                    });
                  })
                </script>
                
                
         
                </div>
             
        </div>
      </div>
</div>

<?php

} else {
  $user->logout();
  Redirect::to('../login/');
}


?>
<script>
    $(document).ready(function(){
        $('.current').click(function (e) {
		
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/schedule/',  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
	
	    $('.editstaff_view').click(function (e) {
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/schedule/proceeds',  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	}); 
	
	    $('.approved_view').click(function (e) {
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/schedule/approvals',  
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	}); 
	
	
    })
    
    
</script>
<script src="js/evo-calendar.min.js"></script>




