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
                    <h3>Settings & Configurations</h3>
                </div>
            </div>
            <div class="row">
                <div class="container">
                <div class="row justify-content-end">
                    <div class="row">
                         
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize"> Transaction Year</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <button class="farm-button py-1 ml-0 editstaff_index text-sm" lang="view/configurations/transaction_year" style="font-size:0.85rem">
                                <i class="fa fa-plus"></i> Initiate Transaction Year
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-2 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Employee KPI (Job Type &amp; Level)</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/configurations/jobtitle/">
                                <i class="fa fa-cube"></i>Job Types
                              </button>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/joblevel/">
                                <i class="fa fa-book"></i>Job Levels
                              </button> 
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize"> Employee Hub </p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <p class="mb-0"> Job Depts  &nbsp;</p>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/departments/">
                                <i class="fa fa-puzzle-piece"></i> Departments
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Geofencing Based</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <p class="mb-0"> </p>
                              
                              <button class="farm-button-icon-button py-1 ml-0 editstaff_index"  lang="view/configurations/bin/">
                                <span class="fa fa-plus"> Add Bin</span>
                              </button>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/worklocation/">
                                <i class="fa fa-map-marker"></i> Locations
                              </button>
                            </div>
                          </div>
                        </div>
                      
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Stock Names & Type</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <button class="farm-button-icon-button py-1 ml-0 editstaff_index" lang="view/configurations/sku">
                                <i class="fa fa-cube"></i> Input
                              </button>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/outputsku">
                                <i class="fa fa-cube"></i> Inventory 
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Customer's Reward Vouchers</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <button class="farm-button-icon-button ml-3 px-4 editstaff_index" lang="view/configurations/promo">
                                <i class="fa fa-gift"></i>Promo
                              </button>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Asset &amp; Procurement</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-end">
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/equipmenttype/">
                                <i class="fa fa-map-marker"></i> Equipment Types
                              </button>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize"> Operation, Cost &amp; Description</p>
                                <p class="mb-0" style="float-right"></p> 
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <p class="mb-0"> Contract Staff</p>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/workoperationcategory">
                                <i class="fa fa-user"></i> Work Type
                              </button>
                            </div>
                          </div>
                        </div>
                         <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Chart of Account</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <p class="mb-0"> A/c Types </p>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/accounttypes/">
                                <i class="fa fa-map-marker"></i> Accounts
                              </button>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize"> Currency Type</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                              <p class="mb-0">  </p>
                              <button class="farm-button py-1 ml-0 editstaff_index" lang="view/configurations/currecy_type/">
                                <i class="fa fa-map-marker"></i> Exchange List &amp; Rate
                              </button>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                          <div class="card">
                            <div class="card-header p-3 pt-2">
                              <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Tax Bills</p>
                                <p class="mb-0" style="float-right"></p>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 justify-content-between">
                                <p class="mb-0"> </p>
                              <button class="farm-button ml-3 px-3 editstaff_index" lang="view/configurations/tax">
                                <i class="fa fa-shopping-cart"></i> Taxation
                              </button> 
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>  
                 
                </div>
              </div>
            </div>
            <div class="row">
                <div class="container-fluid">
            
              
                
                            <div class="row mt-5 justify-content-center">
                                 Content here !
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


<!-- Job Position !-->


<div id="addJobPosition" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel"><i class="fa fa-cube"></i> Jobs</p>
            <button type="button" class="bg-secondary px-2 border text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              
                      <div class="row justify-content-between mt-1 mb-1">
                          <div class="col-7">
                              <h4>Job Titles</h4> 
                          </div>
                          <div class="col-5 right">
                                    <button id="btnaddjobtitle" class="farm-button py-0 px-1 ml-0" data-toggle="modal" data-target="#addjobtitle">Add Title</button>
                                   
                                    <button class="farm-button-blend py-0 px-1 ml-0 reloadJobTitle">
                                        <i class="fa fa-refresh"></i></button>
                                   
                                </div>
                      </div>
                  <hr class="my-2">
                
               <div id="jobtitleview"></div>
               <div id="loads"></div> 
                    
              
          </div>
          
        </div>
    </div>
  </div>
<div id="addjobtitle" class="modal fade" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Add Title</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
      <div class="modal-body" style="font-size:0.8rem">
        
                 <div class="john alert alert-success"></div>
                 <div class="johnerror alert alert-warning"></div>
                 
                     <div class="form-group row">
                        <div class="col-sm-12">
                                  <label class="sr-only" for="joba">Title</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">@</div>
                                    </div>
                                    <input type="text" class="form-control" id="fatima" placeholder="Job Title">
                                
                                  </div>
                                  
                        </div>
                      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="py-1 px-2 btn-secondary border" data-dismiss="modal">Close</button>
        <button type="button" id="addJobtitlebtn" class="py-1 px-2 border farm-color mx-0">Add</button>
      </div> 
      </form>
    </div>
  </div> 
</div>


<script>
	function showWorkOrder(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/workorders/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#workorders").html(html);
                $('#sload').html(''); 
            }
        });
    }
    function showTimeSheet(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/workorders/selecttimesheet.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#tsload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#timesheets").html(html);
                $('#tsload').html(''); 
            }
        });
    }
    function showJobTitle(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/jobs/selectJobTitle.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#loads').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#jobtitleview").html(html);
                $('#loads').html(''); 
            }
        });
    }
    $(document).ready(function() {
        
    });
    $(document).ready(function() {
        showTimeSheet(10, 1);
    });
    $(document).ready(function() {
        showWorkOrder(10, 1);
    });
    
    $('.timesheet').click('on', function(){
        showTimeSheet(10, 1);
    });
     $('.workorders').click('on', function(){
        showWorkOrder(10, 1);
    });
    $(document).ready(function(event){
    
        $("#type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
    
       
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
       
  
        $('.reloadJobTitle').on('click', function(){
          $(document).ready(function() {
                showJobTitle(4, 1);
            });
      });
      
        $('.reloadWorkLocation').on('click', function(){
           $(document).ready(function(){
                showWorkLocation(4, 1);
           });
      });

        $('.john').hide();
        $('.johnerror').hide();
    
        $('#addJobtitlebtn').on('click', function(){
            let fatima = $('#fatima').val();
            
            //alert(hanna);
            
            $.ajax({
    				url: 'view/configurations/jobs/insertjobtitle.php',
    				type: 'POST',
    				data: {
                                'fatima': fatima
                },
                cache: false,
                success:function(data){
                    $('.john').show();
                    $('.john').slideDown();
                    $('.john').html(data);
                    $('#load').html(''); 
                    setTimeout(function(){// wait for 5 secs(2)
                        $(document).ready(function() {
                                showJobTitle(4, 1);
                            }); // then reload the page.(3)
                    }, 100); 
                },
                error:function(data){
                    $('.johnerror').hide();
                    $('.johnerror').slideDown();
                    $('.johnerror').html(data);
                    $('#load').html(''); 
                }
            })
        });
        
        event.preventDefault();
  });
  </script>