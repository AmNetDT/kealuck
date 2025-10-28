<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>

     
                <?php



                  $user = Db::getInstance()->query("SELECT *
                  FROM worklocation_type
                  ORDER BY id DESC");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>
                
                <div id="reloaddata" class="table-responsive data-font" style="height:100%;">
                    <table id="hannat" class="table table-hover table-bordered" style="width:100%; font-size:0.8rem">
                      <thead>
                        <tr>
                          <th>S/No</th>
                          <th style="width:75%; ">Description</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$i = 1;
                        foreach ($user->results() as $user) {

                        ?>
 
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $user->description; ?></td>
                    <td>               
            <button type="button" class="btn-default px-1 border editmodal" title="<?php echo $user->description; ?>" 
            lang="<?php echo $user->id; ?>" id="editlocationType" data-target="#editlocationTypeModal" data-toggle="modal">
                <i class="fa fa-edit"></i></button>
                        </td>  
                            
  
                          </tr>

 
                        <?php
                        $i++;
                        }
                        ?>

                      </tbody>
                    </table>
                    
                </div>
                  <?php
                  }
                 
                ?>
            
            <!-- Modal -->
                                  
                    <div id="editlocationTypeModal" class="modal fade" data-backdrop="false">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h6 class="modal-title">Location Type</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                           <div class="modal-body" style="font-size:0.8rem">
                               
                                    <div class="row mt-0 mb-3 pt-0">
                                          
                                        <div class="col-sm-12 success_alert" id="success_alert"></div>
                                        <div class="col-sm-12 warning_alert" id="warning_alert"></div>
                                        
                                      </div>
                        
                                              
                                    <form id="locationtype" method="POST" autocomplete="off">
                                        <div class="form-group row">
                                            <div class="form-group col-sm-12">
                                                <label for="location">Location Type </label>
                                                 <div class="input-group mb-2">
                                                 <div class="input-group-prepend">
                                                  <div class="input-group-text">Description</div>
                                                </div>
                                                <textarea class="form-control" id="edescription" name="description"></textarea>
                                               
                                                <input type="hidden" id="elocation_id" name="location_id" />
                                                </div> 
                                              </div>
                                         </div>  
                                         
                                        <div class="form-group row">
                                            <button type="button" class="farm-button py-1 ml-0 Save">
                                                <span class="fa fa-save"> Save</span></button>
                                        </div>
                                    </form>
                                          
                                          
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
      $(document).ready(function(event){
 
        $('.success_alert').hide();
        $('.warning_alert').hide();
   
      
        $('.editmodal').click(function (evt) {
            
            $("#edescription").empty();
            $("#elocation_id").empty();
		
    		let location_id = $(this).attr('lang'); 
    		let description = $(this).attr('title');
    		
    		
            $('#edescription').val(description);
            $('#elocation_id').val(location_id);
            
            //alert(description)
           
           
           evt.preventDefault();
        })
       
        $('.Save').on('click', function(e){
       
                let location_id = $('#elocation_id').val();
                let description = $('#edescription').val();
                
               // alert(location_id)
           
                    $.ajax({
                        
        				url: 'view/configurations/worklocation/updatelocation_type.php',
        				data: {
        				    'id' : location_id,
        				    'description' : description
        				},
                        type: 'POST',
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                            $(document).ready(function(evet){
                                
                                showLocation(4, 1);
                                
                                evet.preventDefault();
            	            });
            	            $('#editlocationTypeModal').modal({
                              backdrop: false
                            });
            	            
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
              e.preventDefault();
            });
       
    	
                event.preventDefault();
        	});
	 </script>