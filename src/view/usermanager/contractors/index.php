<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

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
          <h3>Contractors Management</h3>
          </div>
          <div class="row my-3">
            <div class="container">
              <?php
              $username = escape($user->data()->id);
              $userSyscategory = escape($user->data()->syscategory_id);
              $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
              ?>
              <div class="col-md-12">
                <div class="row justify-content-between">
                  
                  <div class="col-md-2">
                                        
                                    </div>
                   <div class="col-md-7">
                      <!--<button class="farm-button" id="add_button" data-toggle="modal" data-target="#JobType" data-target="#staticBackdrop">
                        <span class="fa fa-plus-square-o"> Job Type</span>
                      </button>!-->
                     
                      </div>
                      
                  
                    <div class="col-md-3">
                      <button class="farm-button py-1 ml-0 insert_form" lang="view/usermanager/contractors/create_contrator.php" id="#">
                        <span class="fa fa-plus-square-o"> Add Contractor</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/usermanager/contractors/" id="#">
                        <span class="fa fa-refresh"></span>
                      </button>
                  </div>
                  </div>
                  </div>
                  

                </div>
                
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
   $(document).ready(function(event) {
       
       
    	$('.insert_form').click(function (e) {
		
		var ed = $(this).attr('lang');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(dataString);
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: ed + "/insert_form.php",
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
  <script>
  	function showUsers(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/usermanager/contractors/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#userr").html(html);
                $('#load').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showUsers(10, 1);
    });
 </script>
   
  <script>
   $(document).ready(function(event) {
       
       
    	$('.editstaff_index').click(function (e) {
		
		let ed = $(this).attr('lang');
		let id = $(this).attr('id');
	
		//Pssing values to nextPage 
		var rsData = "eQvmTfgfru";
		var dataString = "rsData=" + rsData;
        //alert(id);
		
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
  

