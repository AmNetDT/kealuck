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
                    <h3>Reports</h3>
                </div>
            </div>
            
                <div class="row justify-content-end">
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">General &amp; Ledger</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 view_index" lang="view/accounting/reports/general_ledger/" id="#">
                                   General Ledger
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Subsidiary &amp; Ledger</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 view_index" lang="view/accounting/reports/subsidiary_ledger/" id="#">
                                    Subsidiary Ledger
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Trial &amp; Balance</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/general_ledger/" id="#">
                                   Trial Balance
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Balance &amp; Sheet</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/subsidiary_ledger/" id="#">
                                    Balance Sheet
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Income Statement</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/general_ledger/" id="#">
                                     Income Statement
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Income, Expense &amp; Profit</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/subsidiary_ledger/" id="#">
                                   Income, Expense &amp; Profit
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Tax Preparation</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/general_ledger/" id="#">
                                   Tax Preparation 
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Invoices Report</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/subsidiary_ledger/" id="#"> 
                                    Invoices Report
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Payment Due Date</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/general_ledger/" id="#">
                                  Payment Due Date
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Gross Balance</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 " lang="view/accounting/reports/subsidiary_ledger/" id="#">
                                    Gross Balance
                                  </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Budget</p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer">
                                 <div class="row justify-content-end">
                                  <button class="farm-button py-1 ml-0 view_index" lang="view/accounting/reports/budget/" id="#">
                                    Budget Overview
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
		
		let ed = $(this).attr('lang');
		
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
	
	
 </script>

  