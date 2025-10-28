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
                      <!--<button type="button" class="farm-button py-1 ml-0 SaveStaff">-->
                      <!--  <span class="fa fa-save"> Save</span>-->
                      <!--</button>-->
                      <!--<button class="farm-button-icon-button py-1 ml-0 current_page">-->
                      <!--  <span class="fa fa-refresh"></span>-->
                      <!--</button>-->
                    </div> 
                </div>
            <div class="row justify-content-between m-0">
                <div class="col-12">
                    <div class="jumbotron bg-white pb-2">
                      <h6 class="display-6">Rate</h6>
                      <div class="col-sm-12">
                      
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
                                      <th scope="col" class="text-right pr-3">Rate</th>
                                      <th scope="col">date</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                              
                                $transaction_year = Db::getInstance()->query("SELECT b.sign, b.name, a.rate, a.date_time FROM `currency_rate` a
                                                        left join currency b on a.currency_id = b.id order by a.id desc");
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
                                      <td class="text-right pr-3">
                                          <?php 
                                          
                                            $number = $trans->rate;
                                            $Trate = number_format($number);
                                            echo $Trate; 
                                            
                                          ?>
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
        $('.dete').hide(); 
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
    			url: 'view/configurations/transaction_year/gettransaction_year.php',
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
     
        $('.edituser_view').click(function (e) {
		
    		$("#loader_httpFeed").show();
    		$.ajax({
    			type: "POST",
    			url: "view/configurations/currecy_type/index.php",
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