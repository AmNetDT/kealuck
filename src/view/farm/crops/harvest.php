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
      <div class="jumbotron bg-white">
            <div class="row mb-4">
                <h3><i class="fa fa-line-chart p-1" aria-hidden="true"></i> Harvest Operations and Logistics</h3>
                </div>
        
               <div class="row justify-content-between mt-3 mb-5 mx-0 px-0">
                  
                    <div class="col-sm-3 mx-0 px-0">
                            <form>
                              <label class="mr-1">Sort by Planting History</label>
                              <select id="inputTransaction_year" name="inputTransaction_year" class="farm-button-cancel py-1 pl-4 mt-2">
                                   <?php

                                      $transaction_year = Db::getInstance()->query("SELECT * FROM transaction_year order by year desc");
                    
                                      if (!$transaction_year->count()) {
                                       ?>
                                       <div class='row'><h3 class='m-5' style="text-align:center">No item to be displayed</h3></div>
                                       <?php
                                      } else {
                    
                                        foreach($transaction_year->results() as $year){
                                            
                                    ?> 
                                <option value="<?php echo $year->year; ?>"><?php echo $year->year; ?></option>
                                    <?php
                                        
                                        }
                                      }  
                                    ?>
                              </select>
                          </form>
                          </div>
                          <div class="col-sm-3 mx-0 px-0 text-right">
                              <button type="button" class="farm-button-icon-button py-1 ml-0 current_page">
                                <span class="fa fa-refresh"></span>
                              </button>
                        </div>
                    </div>
          <div class="row my-3">
            <div class="col-sm-8">
                      
                      <p class="lead m-3 text-left">
                           <?php
                              
                                $legend = Db::getInstance()->query("SELECT * FROM `currency`");
                                                foreach ($legend->results() as $legend) {
                          
                                ?>
                        <span class="badge badge-pill text-dark" style="border:solid 2px <?php echo $legend->color; ?>; font-size:0.52em;"><?php echo $legend->name; ?></span>
                        <?php
                                                }
                        ?>
                      </p>
                      <?php
                            
                            $date_time = date("Y");
                            //echo $date_time;
                            
                            //$date_month = date('Y-m');
                      
                      ?>
                      
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                        <canvas id="myChart" style="width:100%;"></canvas>
                        <!-- https://www.w3schools.com/ai/ai_chartjs.asp !-->
                        <script>
                         <?php $xValues = Db::getInstance()->query("SELECT * FROM `currency_rate` a
                                                                            Left join `currency` b on a.currency_id = b.id
                                                                            WHERE a.date_time like '$date_time%'");?>
                             //var xValues = [100,200,300,400,500];
                            var xValues = [<?php foreach ($xValues->results() as $xValues) {$res = $xValues->date_time; ?><?php echo '"' . $res . '",' ?><?php } ?>];
                                   
                               
                            new Chart("myChart", {
                              type: "line", 
                              data: { 
                                labels: xValues,
                                datasets: [
                                <?php
                                
                                $currency_lable = Db::getInstance()->query("SELECT * FROM `currency_rate` a
                                                                            Left join `currency` b on a.currency_id = b.id
                                                                            WHERE a.date_time like '$date_time%'");
                                    //a.*, b.*, MAX(a.rate) as max_rate, MIN(a.rate) as min_rate 
                                    	
                                                foreach ($currency_lable->results() as $currency_lable) {
                          
                                ?>
                                    { 
                                    
                                  data: [<?php echo $currency_lable->rate; ?>],
                                  borderColor: "#666666",
                                  backgroundColor: "<?php echo $currency_lable->color; ?>",
                                  fill: true
                                },
                                <?php
                            }
                                    ?>
                                ]
                              },
                          options: {
                            title: {
                              display: true,
                              text: "Duration Volume Chart"
                            },
                            legend: {
                                    display: false
                                }
                          }
                        });
                        
                        </script>
                         
                      </div>
            <div class="col-sm-4">
                              <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Crop Type</th>
                                      <th scope="col">Item Code</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                              
                                $transaction_year = Db::getInstance()->query("SELECT b.crop_image, b.crop_name, b.crop_code 
                                                                                FROM `harvest_details` a
                                                                                LEFT JOIN crop_type b on a.crop_type_id = b.id
                                                                                GROUP BY b.crop_image, b.crop_name, b.crop_code");
                              
                                    	
                                                foreach ($transaction_year->results() as $trans) {
                          
                                ?>
                                    <tr>
                                      <td>
                                             <?php if (empty($crop_type->crop_image)) {
                                            
                                                        //re-shape an image with jQuery -- --- Check the script and the style on index page
                                                        echo '<img class="image_resizing mr-1 pr-0" src="view/farm/crops/upload/placeholder.png" alt="Placeholder"><canvas class="canvas p-0 m-0"></canvas>';
                                                        
                                                    } else {
                                                        
                                                        echo '<img class="image_resizing mr-1 pr-0" src="view/farm/crops/' . $crop_type->crop_image . '" alt="Real Image"><canvas class="canvas p-0 m-0"></canvas>';
                                                        
                                                    } ?>
                                      </td>
                                      <td>
                                          <?php echo $trans->crop_name; ?>
                                      </td>
                                      <td>
                                          <?php echo $trans->crop_code; ?>
                                      </td>
                                      <td>
                                          <div class="dropup">
                                            <button class="btn btn-default dropleft" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                              <i style="font-size:14px" class="fa">&#xf142;</i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="crop_planting" id="<?php echo $crop_type->id; ?>">
                                            <button class="dropdown-item" class="dropdown-item">
                                            <i class="fa fa-plus"></i>&nbsp; Crop Planting</button>
                                            </div>
                                            <div class="crop_update" id="<?php echo $crop_type->id; ?>">
                                            <button class="dropdown-item py-0 my-0">
                                                 <i class="fa fa-pencil"></i>&nbsp; Edit Crop</button>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <div class="crop_delete" id="<?php echo $crop_type->id; ?>">
                                                <button class="dropdown-item py-0 my-0">
                                                     <i class="fa fa-trash"></i>&nbsp; Delete</button>
                                            </div>
                                             
            
                                            </div>
                                          </div>
                                      </td>
                                    </tr>
                                    <?php 
                                                }
                                                ?>
                                  </tbody>
                                </table>
                          </div>
                      
                      <hr class="my-4">
                      <div class="row">
                          
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

<!-- Add the evo-calendar.js for.. obviously, functionality! -->
<script src="js/evo-calendar.min.js"></script>

 <script>
   $(document).ready(function(event) {
       
        
        $('#inputTransaction_year').change(function(evt){ 
                
            let id = $(this).find(":selected").val(); 
		    
            let transaction_year_month = $('#inputTransaction_year').val(); 
    	
	        	//alert('welcome')
	
            $.ajax({
                type: "GET",
                url: "view/farm/crops/harvest.php",
               
    			data: {
    			    
    			    transaction_year_month: transaction_year_month
    			},
                cache: false,
        		beforeSend: function() {
        		    
                    $('#load').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
				    $("#loader_httpFeed").show();
        			
                },
                success: function(html) {
                    $("#department").html(html);
                    $('#sload').html(''); 
				    $("#loader_httpFeed").hide();
                }
            });
        
        
         evt.preventDefault();
        
      
      });
      
            
        $('.current_page').click(function (e) {
    		
    	
    		//alert(id)
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/farm/crops/harvest.php",
    		
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