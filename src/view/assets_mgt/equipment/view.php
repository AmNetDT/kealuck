<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];

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
        
             <?php

                    $staffa = Db::getInstance()->query("SELECT a.*, b.supplier_code, b.name as supplier_name, concat(d.firstname, ' ', lastname) as name 
                    FROM equipment a 
                    left join suppliers b on a.supplier_id = b.id
                    Left join users c on a.added_by = c.id
                    Left Join staff_record d on c.username = d.user_id
                    WHERE a.id = $member_id");

                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
                    ?>
             <div class="jumbotron jumbotron-fluid pt-5 bg-white">
                <div id="accounttile" class="col-sm-12">
                    <div class="row m-3 mb-4">
                        <h3><span style="font-size:0.9em"><?php echo $staff->equipment_code; ?></span></h3>
                    </div>
                    <div class="row my-3">
                      <div class="col-sm-12">
                        <div class="col-sm-12 mb-5">
                    
                    <script>
                        function printDiv() 
                            {
                            
                              var divToPrint=document.getElementById('DivIdToPrint');
                            
                              var newWin=window.open('','Print-Window');
                            
                              newWin.document.open();
                            
                              newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                            
                              newWin.document.close();
                            
                              setTimeout(function(){newWin.close();},10);
                            
                            }
                    </script>
                    <div class="row mt-4 justify-content-center" id="DivIdToPrint">
                        <div class="col-sm-10">
                            <div id='DivIdToPrint'></div>
                            <button type='button' id='btn' onclick='printDiv();' class="farm-button-blend py-1 mr-1"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                   
                            <div class="row border-bottom justify-content-center">
                                <div class="container my-4">
                                    <div class="card mb-3" style="width:100%;">
                                        
                                        
                            <div class="row mb-4" style="font-size:0.9em;">
                                <p class="mr-5">Supplier: <span class="badge badge-light badge-pill text-dark p-2 mr-5"> <?php echo $staff->supplier_name; ?></span></p>
                             </div>
                    <div class="row my-3 justify-content-center">
                    <div class="col-sm-10">
                        
                <?php

                  $user = Db::getInstance()->query("SELECT * FROM equipment_order WHERE equipment_id = $member_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table" style="width:100%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>Description</th>
                          <th>Qty</th>
                          <th style="text-align:right">Units Cost</td>
                          <th style="text-align:right">Amount</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->qty; ?></td>
                            <td style="text-align:right"><?php echo $user->unit_cost; ?></td>
                            <td style="text-align:right"><?php 
                                $qty = $user->qty; 
                                $unitcost = $user->unit_cost;
                                $totalamount = $qty * $unitcost;
                            echo $totalamount; ?>.00</td>
                           
  
                          </tr>

 
                        <?php
                        }
                        ?>
                        <tr class="border">
                            <td><b>Total</b></td>
                            <td colspan='5' style="text-align:right">
                                 <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.percentage
                            FROM equipment_order a 
                            left join equipments b on a.equipment_id = b.id
                            WHERE a.equipment_id = $member_id");     
                             if($labeltax->count()){
                                 
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                            $qty = $user->qty; 
                                            $unitcost = $user->unit_cost;
                                            $totalamount = $qty * $unitcost;
                                            
                                        
                              ?>
                      
                            
                            <span class="ml-5"><b>NGN <?php echo $totalamount; ?>.00</b></span>
                             <?php
                                     
                                 }
                                }
                         
                      ?>
                            
                        </tr>
                      </tbody>
                    </table>
                  <?php
                  }
                
                ?>
              
                                        </div>
                              </div>  
                            <div class="row mb-4" style="font-size:0.9em;">
                                <p class="mr-5">Registered by: <span class="badge badge-light badge-pill text-dark p-2"> <?php echo $staff->name; ?></span></p>
                            </div>
                                </div>
                            </div>
                    
                </div>
               </div>
              </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

