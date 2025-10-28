<?php

require_once '../core/init.php';

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
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
       
            <div class="row">
                <div class="container py-3">
                    <h3>Requests &amp; Approvals</h3>
                </div>
            </div>
            
                <div class="row justify-content-end">
                <div class="container">
                        <div class="col-md-6 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Purchase &amp; Utility</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                    <div class="col-sm-5 mr-auto">
                                  <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-3% </span>than last month</p>
                                    </div>
                                    <div class="col-sm-7 mr-auto p-auto">
                                  <button class="farm-button-icon-button py-1 ml-0 view_index">
                                    <i class="fa fa-shopping-cart"></i> Bills Request
                                  </button>
                                  </div>
                              </div>
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
 
      $('.view_index').click(function (e) {
		
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/approvals/bill_requests/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});  
	
	
 </script>

  