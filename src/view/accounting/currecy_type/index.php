<?php

require_once '../../core/init.php';


$user = new User();
if ($user->isLoggedIn()) {
   

?>

  
  
<script src="Chart.js"></script>
  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-10">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>
        <!--  offset-md-3 !-->
        
       
         <div id="accounttile" class="container">
            <div class="row justify-content-between mt-5 mb-3">
                    <div class="col-8">
                        <h2>Currency</h2> 
                    </div>
                    <div class="col-4 text-right">
                      <button class="farm-button-cancel py-1 ml-0 edituser_view" id="#">
                        <span class="fa fa-chevron-left"></span> 
                      </button>
                      <button type="button" class="farm-button py-1 ml-0 SaveStaff">
                        <span class="fa fa-save"> Save</span>
                      </button>
                      <button class="farm-button-icon-button py-1 ml-0 current_page">
                        <span class="fa fa-refresh"></span>
                      </button>
                    </div> 
                </div>
            <div class="row justify-content-between m-0">
                <div class="col-6">
                      <div class="jumbotron bg-white pt-0">
                            <div class="col-sm-12">
                            
                              <div class="row mt-0 mb-3 pt-0">
                                  
                                <div class="col-sm-12 m-0 success_alert current_page" id="success_alert"></div>
                                <div class="col-sm-12 m-0 warning_alert current_page" id="warning_alert"></div>
                                
                              </div>
                                <p align="right">Rate at Naira Equivalent (NGN1.00)</p>
                                
                                <form id="currency_form" name="currency_form" method="POST" autocomplete="off">
                                <div class="row">
                                  <div class="form-group col-sm-12">
                                        <label for="year">Name</label>
                                       <input type="text" id="name" name="name" class="form-control" placeholder="Currency Name" />
                                     </div>
                                  <div class="form-group col-sm-12">
                                        <label for="year">Sign</label>
                                       <input type="text" id="sign" name="sign" class="form-control" placeholder="Currency Sign" />
                                     </div>
                                  <div class="form-group col-sm-10">
                                        <label for="year">Country</label>
                                       <input type="text" id="country" name="country" class="form-control" placeholder="Countries Applicable separated with comma if more than one" />
                                     </div>
                                  <div class="form-group col-sm-2">
                                        <label for="color">Colour</label>
                                       <input type="color" id="color" name="color" class="form-control" />
                                     </div>
                                
                                      <div class="farm-button-cancel form-group col-sm-12 mt-3 border">
                                        <label for="currency_type">Exchange List</label>
                                        <select multiple class="form-control" id="currency_type" name="currency_type">
                                            <?php
                              
                                $transaction_year = Db::getInstance()->query("SELECT * FROM currency order by id desc");
                                                foreach ($transaction_year->results() as $trans) {
                          
                             
                                ?>
                                          <option value="<?php echo $trans->id; ?>"><?php echo $trans->sign; ?> &nbsp; | &nbsp; <?php echo $trans->name; ?> &nbsp; | &nbsp; <?php echo $trans->country; ?></option>
                                          <?php
                                                 }
                                ?>
                                        </select>
                                     </div>
                                     <input type="hidden" id="ids" />
                                     
                                  
                                 </div> 
                                 </form>
                            </div>
                                
                          </div>
                        </div>
                     
                <div class="col-6 rate">
                    <div class="jumbotron bg-white pb-2">
                      <h6 class="display-6">Rate</h6>
                      <div class="col-sm-12">
                      <p class="lead m-3 text-right">
                        <button type="button" class="btn-sm farm-button view_click">View All</button>
                        <button type="button" class="btn-sm border update_click">Update</button>
                      </p>
                      
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
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                        <!-- https://www.w3schools.com/ai/ai_chartjs.asp !-->
                        <script>
                         <?php $xValues = Db::getInstance()->query("SELECT COUNT(*) as count FROM `currency_rate`");foreach ($xValues->results() as $xValues) {
                             $res = $xValues->count;
                            ?>
                             //var xValues = [100,200,300,400,500];
                              var xValues = [<?php $numbers = range(0, $res); echo $numbers[0]; foreach ($numbers as $number) {echo $number . ", ";} ?>];
                                   <?php } ?>
                               
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
                              text: "Currency Rate Chart"
                            },
                            legend: {
                                    display: false
                                }
                          }
                        });
                        
                        </script>
                         
                      </div>
                      <hr class="my-4">
                      <div class="row">
                          <div class="col-sm-12">
                              <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Type</th>
                                      <th scope="col">Sign</th>
                                      <th scope="col">Rate</th>
                                      <th scope="col">date</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                              
                                $transaction_year = Db::getInstance()->query("SELECT b.sign, b.name, a.rate, a.date_time 
                                                        FROM `currency_rate` a
                                                        LEFT JOIN currency b ON a.currency_id = b.id 
                                                        ORDER BY a.date_time DESC LIMIT 3");
                                    	$i = 1;
                                    	
                                                foreach ($transaction_year->results() as $trans) {
                          
                                ?>
                                    <tr>
                                      <td><?php echo $i++ ; ?></td>
                                      <td>
                                          <?php echo $trans->name; ?>
                                      </td>
                                      <td>
                                          <?php echo $trans->sign; ?>
                                      </td>
                                      <td>
                                          <?php echo $trans->rate; ?>
                                      </td>
                                      <td>
                                          <?php echo $trans->date_time; ?>
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
                  </div>
                <div class="col-6 update_view">
                    <div class="jumbotron bg-white">
                      <h4 class="display-5 mb-5">Rate</h4>
                      <div class="col-sm-12">
                              <div class="row mt-0 mb-3 pt-0">
                                  
                                <div class="col-sm-12 m-0 success_alert_rate current_page" id="success_alert"></div>
                                <div class="col-sm-12 m-0 warning_alert_rate current_page" id="warning_alert"></div>
                                
                              </div>
                    <form id="currency_rate" name="currency_rate" method="POST" autocomplete="off">
                                <div class="row">
                                  <div class="form-group col-sm-6">
                                        <label for="currency_id">Currency</label>
                                       <select class="form-control" id="currency_id" name="currency_id">
                                          <option>--Select Currency--</option>
                                        <?php
                              
                                            $currency = Db::getInstance()->query("SELECT * FROM `currency`");
                                
                                            foreach ($currency->results() as $currency) {
                          
                                            ?>
                                          <option value="<?php echo $currency->id; ?>"><?php echo $currency->sign . " " . $currency->name; ?></option>
                                        <?php
                                                }
                                        
                                        ?>
                                        </select>
                                     </div>
                                  <div class="form-group col-sm-6">
                                        <label for="year">Rate</label>
                                       <input type="text" id="rate" name="rate" class="form-control" placeholder="Current Rate" />
                                     </div>
                                     
                                  <div class="form-group col-sm-7">
                                        <label for="year">Date Time</label>
                                       <input type="datetime-local" id="date_time" name="date_time" class="form-control" placeholder="Current Rate" />
                                     </div>
                                  <div class="form-group col-sm-6">   
                                      <button type="button" class="farm-button py-1 ml-0 SaveCurrency" id="SaveCurrency">
                                        <span class="fa fa-save"> Update</span>
                                      </button>
                                     </div>
                                
                              
                                 </div> 
                                 </form>
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
  
<script>
    $(document).ready(function(event){
        
        
        $('.success_alert').hide();
        $('.warning_alert').hide();
        $('.delete').hide();
        $('.rate').show();
        $('.update_view').hide();
        
        $('.update_click').on('click', function(){
            $('.update_view').show();
            $('.rate').hide();
        });
        
        $("#trans_year").change(function(e){  
            
    	    const year = $(this).find(":selected").val();
    	    
        	const dataString = {
                year: year
            };
        
		
		$.ajax({
    			type: "POST",
    			url: 'view/accounting/transaction_year/gettransaction_year.php',
    			dataType: 'JSON',
    			data: dataString,
    			cache: false,
    			success: function (response) {
    			     
                 
                    $("#id").empty();
                    $("#yearlabel").empty();
                
                              
                                let id    = response.id;
                                let year = response.year;
                          
                                
                                 $('#ids').val(id);
                                 $('#yearlabel').val(year);
                                 $('.delete').show();
    				 	
    		 }
    	});
        		
	

            e.preventDefault(); 
     	});
     
        $("#currency_type").change(function(e){  
            
    	    const id = $(this).find(":selected").val();
    	    
        	const dataString = {
                id: id
            };
        
		
		$.ajax({
    			type: "POST",
    			url: 'view/accounting/currecy_type/getcurrency.php',
    			dataType: 'JSON',
    			data: dataString,
    			cache: false,
    			success: function (response) {
    			     
                 
                    $("#id").empty();
                    $("#currencylabel").empty();
                
                              
                                let id    = response.id;
                                let name = response.name;
                          
                                
                                 $('#ids').val(id);
                                 $('#currencylabel').val(name);
    				 	
    		 }
    	});
        		
	

            e.preventDefault(); 
     	});
     
     	$(".delete").on('click', function(){
     	    
     	     if (confirm("Are you sure you want to remove this item?") == true) {
     	         
     	    let ids = $('#ids').val();
     	    
     	  
     	    $.ajax({
        				url: 'view/accounting/transaction_year/delete.php',
        				data: {
                		    ids    : ids
                		    
                		},
                        type: 'POST',
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
     	    
                  } else {
                    return false;
                    
                  }
     	})
     
        $('.SaveStaff').on('click', function(){
       
                let form = $('#currency_form')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/accounting/currecy_type/insert.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert").html(data);
                            $(".success_alert").show();
                        }, 
                        error:function(data){
                            $(".warning_alert").html(data);
                            $(".warning_alert").show();
                        }
                    }); 
                
            });
        
        $('.SaveCurrency').on('click', function(){
       
                let form = $('#currency_rate')[0]; // You need to use standard javascript object here
                let formData = new FormData(form);  
                
                //alert(formData)
           
                    $.ajax({
        				url: 'view/accounting/currecy_type/insertcurrency_rate.php',
        				data: formData,
                        type: 'POST',
                        contentType: false,  // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function(data){
                            $(".success_alert_rate").html(data);
                            $(".success_alert_rate").show();
                        }, 
                        error:function(data){
                            $(".warning_alert_rate").html(data);
                            $(".warning_alert_rate").show();
                        }
                    }); 
                
            });   
            
        $('.edituser_view').click(function (e) {
		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/currecy_type/index.php",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});   
	
    	$('.current_page').click(function (e) {
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/currecy_type/",
    			cache: false,
    			success: function (msg) {
    				$("#contentbar_inner").html(msg);
    				$("#loader_httpFeed").hide();
    			}
    		});
    		e.preventDefault();
    	});
    	
    	
    	$('.view_click').click(function (e) {
    		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/accounting/currecy_type/view.php",
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