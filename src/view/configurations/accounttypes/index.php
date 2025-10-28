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
      <div class="jumbotron jumbotron-fluid pt-5 bg-white">
        <div id="accounttile" class="container">
          
          <div class="row m-3 mb-4">
                <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Account Types</h3>
            </div>
            
          <div class="row justify-content-end mb-4">
                   
                   <div class="col-7">
                      
                         <form>
                              <label class="mr-2">Sort by GL type</label>
                              <select id="title" name="title" class="farm-button-cancel py-1 pl-4 mt-2">
                                   <?php

                                      $title = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types order by title asc");
                    
                                      if (!$title->count()) {
                                       ?>
                                       <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                                       <?php
                                      } else {
                    
                                        foreach($title->results() as $tit){
                                            
                                    ?> 
                                <option value="<?php echo $tit->id; ?>"><?php echo $tit->title; ?></option>
                                    <?php
                                        
                                        }
                                      }  
                                    ?>
                              </select>
                          </form>
                          
                                 
                        </div>
                    
                   <div class="col-5">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button class="farm-button-cancel py-1 ml-0" id="add_button" data-toggle="modal" data-target="#addModal">
                        <span class="fa fa-plus"> Add New</span>
                      </button>
                      <button class="farm-button py-1 mx-0" id="add_button" data-toggle="modal" data-target="#addAccountModal">
                        <span class="fa fa-plus"> Add GL Type</span>
                      </button>
                      <button class="farm-button py-1 mx-0" id="add_button" data-toggle="modal" data-target="#addGroupModal">
                        <span class="fa fa-plus"> Add Group</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current">
                        <span class=" fa fa-refresh"></span>
                      </button>
                    </div>  
                  
                    
                </div>
          
          <div class="row">
              <div class="col-sm-12 m-0 success_alert current" id="success_alert"></div>
              <div class="col-sm-12 m-0 warning_alert current" id="warning_alert"></div>
          </div>      
          <div class="row">
                <div class="col-12">
                    <div id="chart"></div>
            		<div id="sload"></div>
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

<!-- Create Dept Modal !-->

  <div id="addModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
      
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add New</p>
            <button type="button" class="bg-secondary px-2 border text-white  current" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert current" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert current" id="warning_alert"></div>
                    
                  </div>
          <form id="chart_form" method="post" enctype="multipart/form-data">
        
          <div class="modal-body pt-0">
              <div class="row mt-0 mb-3 pt-0">
                  
                  </div>
            <div class="row">
               
              <div class="form-group col-sm-6">
                <label>GL Code</label>
                <input type="text" id="gl_code" name="gl_code" class="form-control" required />
              </div>
              <div class="form-group col-sm-6" id="category_div">
                <label>Account Category</label>
                <select class="form-control" id="category_id" name="category_id">
                  <option value="">--Choose--</option>
                  <?php
                  
                        $sqlQuery = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types");
                        if (!$sqlQuery->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                            foreach ($sqlQuery->results() as $accounttypes) { 
                  ?>
                  <option value="<?php echo $accounttypes->id; ?>"><?php echo $accounttypes->title; ?></option>
                  <?php
                            }
                      }
                  
                  ?>
                </select>
              </div>
              
              <div class="form-group col-6">
                <label>Description</label>
                <input type="text" name="description" id="description" class="form-control" required />
              </div>
              
              <div class="form-group col-sm-6" id="group_div">
                <label>Group</label>
                <select class="form-control" id="group_id" name="group_id" >
                </select>
              </div>
              
              <div class="form-group col-sm-6">
                <label>Debit</label>
                <input type="text" name="debit" id="debit" class="form-control" placeholder="0.00" />
              </div>
              
              <div class="form-group col-sm-6">
                <label>Credit</label>
                <input type="text" name="credit" id="credit" class="form-control" placeholder="0.00" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
             <input type="hidden" id="added_by" name="added_by" value="<?php echo $username; ?>" />
            <button type="button" class="py-1 px-2 border farm-color mx-0 Savechart">Add New</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current" data-dismiss="modal">Close</button>
          </div>
      </form>
        </div>
    </div>
  </div>
  
  <div id="addAccountModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add GL Type</p>
            <button type="button" class="bg-secondary px-2 border text-white  current" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert current" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert current" id="warning_alert"></div>
                    
                  </div>
          <form id="formAccountType" name="formAccountType" method="post" enctype="multipart/form-data">
        
          <div class="modal-body pt-0">
            <div class="row">
               
              <div class="form-group col-12">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required />
              </div>
              
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive data-font" style="height:100%;">
   

    <?php 
	$i = 1;
	
                $chart_of_accounts_types = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types");

                 if (!$chart_of_accounts_types->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                   ?>
                   
                   
                <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                    <thead>
                      <tr>
                        <th width="50">SN</th>
                        <th width="200">Title</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>

    
                   
                   
                   <?php
	foreach ($chart_of_accounts_types->results() as $department) { 

	?>
    
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td style="width:80%"><?php echo $department->title; ?></td>
                          <td style="width:10%">
                                  <div class="edit_view_gl" id="<?php echo $department->id; ?>">
                                        <button type="button" class="dropdown-item" data-dismiss="modal">
                                             <i class="fa fa-edit"></i></button>
                                    </div>
                          </td>
                        </tr>
   
    <?php
             }
             
             ?>
             
             </tbody>
                </table>
                
             <?php
                      }
    ?>
    
            </div> 
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="py-1 px-2 border farm-color mx-0 SaveAccountType">Add New</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current" data-dismiss="modal">Close</button>
          </div>
      </form>
        </div>
    </div>
  </div>
  
  
  <div id="addGroupModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="farm-color modal-header p-2">
            <p class="modal-title" id="staticBackdropLabel">Add Account Group</p>
            <button type="button" class="bg-secondary px-2 border text-white  current" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
              <div class="row mt-0 mb-3 pt-0">
                 
                    <div class="col-sm-12 success_alert current" id="success_alert"></div>
                    <div class="col-sm-12 warning_alert current" id="warning_alert"></div>
                    
                  </div>
          <form id="formAccountGroup" name="formAccountGroup" method="post" enctype="multipart/form-data">
        
          <div class="modal-body pt-0">
            <div class="row">
             
              <div class="form-group col-6">
                <label>Account Category</label>
                <select class="form-control" id="accounts_type_id" name="accounts_type_id">
                  <option value="">--Choose--</option>
                  <?php
                  
                        $sqlQuery = Db::getInstance()->query("SELECT * FROM chart_of_accounts_types WHERE id in (4, 10)");
                        if (!$sqlQuery->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                            foreach ($sqlQuery->results() as $accounttypes) { 
                  ?>
                  <option value="<?php echo $accounttypes->id; ?>"><?php echo $accounttypes->title; ?></option>
                  <?php
                            }
                      }
                  
                  ?>
                </select>
              </div>  
              <div class="form-group col-6">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required />
              </div>
            </div>
            

    

    <?php 
	$i = 1;
	
                $chart_of_accounts_types = Db::getInstance()->query("SELECT * FROM chart_of_accounts_group");

                 if (!$chart_of_accounts_types->count()) {
                        echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                      } else {
                   ?>
                   
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive data-font" style="height:100%;">
   
               
                   
                    <table id="deptview" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                    <thead>
                      <tr>
                        <th width="50">SN</th>
                        <th width="200">Group Name</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                   
                   <?php
	foreach ($chart_of_accounts_types->results() as $department) { 

	?>
    
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td style="width:80%"><?php echo $department->title; ?></td>
                          <td style="width:10%">
                                  <div class="edit_view" id="<?php echo $department->id; ?>">
                                        <button type="button" class="dropdown-item" data-dismiss="modal">
                                             <i class="fa fa-edit"></i></button>
                                    </div>
                          </td>
                        </tr>
   
    <?php
             }
             ?>
             
              </tbody>
                </table>
                   
                   </div> 
                </div>
            </div>
             <?php
                      }
    ?>
   
            
          </div>
          <div class="modal-footer">
            <button type="button" class="py-1 px-2 border farm-color mx-0 SaveAccountGroup">Add New</button>
            <button type="button" class="py-1 px-2 border bg-secondary text-white mx-0 current" data-dismiss="modal">Close</button>
          </div>
      </form>
        </div>
    </div>
  </div>

<script>
  	function showChart(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "view/configurations/accounttypes/select.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#sload').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#chart").html(html);
                $('#sload').html(''); 
            }
        });
    }
    $(document).ready(function() {
        showChart(10, 1);
    });
    
 </script>
 
  <script>
   $(document).ready(function(event) {
         
        $('#group_div').hide();
        
        $('.success_alert').hide();
        
        $('.warning_alert').hide();
       
        $('.edituser_view').click(function (e) {
		
		$("#loader_httpFeed").show();
		
		
		$.ajax({
			type: "POST",
			url: "view/configurations/index.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
	    
	    $('.edit_view_gl').click(function (e) {
            
            let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			data: {
			    
			    'id' : id
			    
			},
			url: "view/configurations/accounttypes/edit_acc_type.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	}); 
	    
        $('.edit_view').click(function (e) {
            
            let id = $(this).attr('id');
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			data: {
			    
			    'id' : id
			    
			},
			url: "view/configurations/accounttypes/edit_acc_group.php",
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
			}
		});
		e.preventDefault();
	});   
        
        $('.Savechart').on('click', function(){
       
                let form = $('#chart_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/accounttypes/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
            
        $('.SaveAccountType').on('click', function(){
       
                let form = $('#formAccountType')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/accounttypes/insertchart_of_accounts_types.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
        
        $('.SaveAccountGroup').on('click', function(){
       
                let form = $('#formAccountGroup')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/configurations/accounttypes/insertchart_of_accounts_group.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $('#wload').html(''); 
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
       
        $('.current').click(function (e) {
		
		//let id = $(this).attr('id');
	
		
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: 'view/configurations/accounttypes',
			cache: false,
			success: function (msg) {
				$("#contentbar_inner").html(msg);
				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});  
 
        $('#title').change(function(evt){ 
                    
            let title = $(this).find(":selected").val(); 
    	    
    
            $.ajax({
                type: "GET",
                url: "view/configurations/accounttypes/select.php",
               
    			data: {
    			    
    			    title : title
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
        			
                },
                success: function(html) {
                    $("#chart").html(html);
                    $('#sload').html(''); 
                }
            });
            
            
             evt.preventDefault();
            
           
          });
          
        $("#category_id").change(function(){  
           
	    let id = $(this).find(":selected").val(); // Assuming numerical value
        let dataString = 'category_id='+ id; 
            
            if (dataString === 'category_id=4' || dataString === 'category_id=10') {
                
                $('#group_div').show();
		//alert(dataString);
	
		$.ajax({
			url: 'view/configurations/accounttypes/getGroup.php',
            dataType: 'json',
			data: dataString,  
			cache: false,
			contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
			success:function(response){
                
                var len = response.length;

                $("#group_id").empty();
                
                  for( var i = 0; i<len; i++){
                   
                    let id     = response[i]['id'];
                    let title  = response[i]['title'];
                    
                  
                    //alert(location);
                   
                    $('#group_id').append("<option value='" + id + "'>" + title + "</option>");
                  
                  
                }
                   
            }
				 	
			
		});
		
            }else{
                
                $("#group_id").empty();
                $('#group_div').hide();
                
            }
 	})  
	
   
     
   event.preventDefault();
   });
  </script>
  

  