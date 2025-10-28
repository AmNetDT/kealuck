<?php

require_once '../../core/init.php';

$member = $_POST['id'];
//echo $member;
$user = new User();
if ($user->isLoggedIn()) {

?>

    <div id="body_general">

        <div id="accounttile">
            <div class="col-sm-12 col-sm-6">
                <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
            </div>
        </div>
        
        <div class="container">
             <?php

                    $staffa = Db::getInstance()->query("SELECT CONCAT(sr.firstname,' ', sr.othername,' ',sr.lastname) as staffname, sr.user_id, sr.id, sr.image
                    FROM  staff_record sr 
                    LEFT JOIN users u ON u.username = sr.user_id
                    WHERE sr.id = $member");

                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
                    ?>
            <script>
              image.onchange = evt => {
                  const [file] = image.files
                  if (file) {
                    blah.src = URL.createObjectURL(file);
                    
                }
              }  
                
          </script>
                   <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="jumbotron jumbotron-fluid pt-3 bg-white">
                <div id="accounttile" class="container">
                    <div class="row mt-2">
                        <div class="container">
                            <div class="col-sm-12">
                               <div class="row justify-content-between"> 
                                <div class="col-7">
                                    <h3 style="line-height:1.0em"><?php echo $staff->staffname ?><br/><span style="font-size:0.9rem;"><?php echo $staff->user_id; ?></span></h3>
                                </div>
                                <div class="col-5 pl-0"> 
                                      <button class="farm-button-cancel py-1 ml-0 editstaff" id="<?php echo $member; ?>">
                                        <span class="fa fa-chevron-left"></span>
                                      </button> 
                                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                                        <span class="fa fa-save"> Save</span>
                                      </button>
                                      <button type="button" class="farm-button-icon-button py-1 ml-0 current_page" id="<?php echo $member; ?>">
                                        <span class="fa fa-refresh"></span>
                                      </button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="col-sm-12">
                             <div class="row justify-content-between mb-3"> 
                                <div class="col-3">
                                    <div class="col-sm-12 p-0" style="font-size:0.9rem">   
                                        <div class="image-upload">
                                            <label for="image">
                                                <?php if (!empty($staff->image)) {
                                                    echo '<img id="blah" src="view/usermanager/staff/' . $staff->image . '" class="img-thumbnail border" alt=""><p style="text-align:center">';
                                                } else {
                                                    echo '<img id="blah" class="img-thumbnail border" src="view/usermanager/staff/add_user_icon.jpg" alt="" />';
                                                } ?>
                                                </label>
                                                <input accept="image/*" id="image" name="image" type="file" class="d-none" />
                                                
                                                <input type="hidden" value="<?php echo $member; ?>" id="user_id" name="user_id" />
                                                <input type="hidden" value="<?php echo $staff->id; ?>" id="id" name="id" />
                                            </div>
                                        </div>
                                        <p >Click the picture to update it.</p>
                                    </div>
                                    <div class="col-9">
                                         <div class="row my-5">
                                            <div class="col-sm-12">
                                                 <div class="success_alert"></div>
                                                 <div class="warning_alert"></div>
                                             </div>
                                        </div>
                                    </div>
                             </div>
                            </div>
                    
                            
                </div>
               </div>
              </div>
            </div>
                  </form>
            <?php
                     } 
                    }
                    ?>
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
     
    $('.success_alert').hide();
    $('.warning_alert').hide();
         
       $('.SaveStaff').on('click', function(){
       
                let form = $('#uploadForm')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/usermanager/staff/update_picture.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
				            $("#loader_httpFeed").hide();
                        },
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
				            $("#loader_httpFeed").hide();
                        }
                    }); 
                
            });
            
       
   
       
    	$('.current_page').click(function () {
    		
    		let id = $(this).attr('id');
    	
            //alert(dataString);
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/usermanager/staff/edit_picture.php",
    			data: {
    				id : id
    			},
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    	});
    	
    	
       
      	$('.editstaff').click(function (e) {
		
		let id = $(this).attr('id');
	
		$("#loader_httpFeed").show();
		$.ajax({
			type: "POST",
			url: "view/usermanager/staff/view.php",
			data:{
			    id : id
			},
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
