<?php

require_once '../../core/init.php';

$member_id = $_POST['id'];
//echo $member_id;
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
                    FROM purchases a 
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
                        <h3><span style="font-size:0.9em"><?php echo $staff->purchase_code; ?></span></h3>
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

                  $user = Db::getInstance()->query("SELECT a.*, b.id as currency_id, b.sign 
                                                    FROM purchase_order a
                                                    LEFT JOIN currency b ON  a.currency_id = b.id
                                                    WHERE purchase_id = $member_id");

                  if (!$user->count()) {
                    echo "<div class='row justify-content-center'><h4 class='m-5'>No data to be displayed</h4></div>";
                  } else {

                ?> 

                    <table id="selectuserabduganiu" class="table table-sm table-hover table-bordered" style="width:120%; font-size:0.8em;">
                      <thead>
                        <tr> 
                          <th>SN</th>
                          <th>SKU Code</th>
                          <th>Description</th>
                          <th>Qty</th>
                          <th>Currency</th>
                          <th class="text-right pr-3">Units Cost</td>
                          <th class="text-right pr-3">Amount</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;   
                        foreach ($user->results() as $user) {
                          
                        ?> 
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->sku_code; ?></td>
                            <td><?php echo $user->description; ?></td>
                            <td><?php echo $user->qty; ?></td>
                            <td><?php echo $user->sign; ?></td>
                            <td class="text-right pr-3"><?php 
                            
                                    $unit_cost = $user->unit_cost;
                                    $Total_Ant = number_format($unit_cost);
                                    echo $Total_Ant; 

                            
                            ?></td>
                            <td class="text-right pr-3"><?php 
                            
                                $qty = $user->qty; 
                                $unitcost = $user->unit_cost;
                                $totalamount = $qty * $unitcost;
                            
                                $Total_At = number_format($totalamount);
                                echo $Total_At; 
                                 
                                 ?></td>
                          
                          </tr>
                           <?php
                            }
                        ?>
                          <?php
                            $landingCost = $user->purchase_id;
                            
                                 $userlandingCost = Db::getInstance()->query("SELECT a.id, a.cost FROM landing_cost a 
                                 left join purchases b on a.purchase_id = b.id
                                    WHERE a.purchase_id = $landingCost");
        
                          if ($userlandingCost->count()) {
                              
                              foreach ($userlandingCost->results() as $userlandingCost) {
                          ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td>Landing Cost</td>
                            <td colspan='4' style="text-align:right"><?php 
                            
                                    $unit_cot = $userlandingCost->cost;
                                    $Total_Amnt = number_format($unit_cot);
                                    echo $Total_Amnt; 
                                    
                             ?></td>
                            
                          </tr>
                        <?php
                            }
                          }
                        ?>
                            
                          <tr>
                            <td><b>Total</b></td>
                            <td colspan='6' style="text-align:right">
                                 <?php
                             $labeltax = Db::getInstance()->query("SELECT SUM(a.unit_cost * a.qty) as cost, c.discount, d.cost as landing_cost
                                                                    FROM purchase_order a 
                                                                    left join purchases b on a.purchase_id = b.id
                                                                    Left join purchase_discount c on b.purchase_code = c.item_code
                                                                    Left join landing_cost d on b.purchase_code = d.item_code
                                                                    WHERE a.purchase_id = $member_id");     
                             if($labeltax->count()){
                                 foreach ($labeltax->results() as $labelta) {
                                     
                                     $discount = $labelta->discount;
                                     $landing_cost = $labelta->landing_cost;
                                     $cost = $labelta->cost;
                                     
                                     if($discount != ''){
                          ?>
                                    <span>(include <?php echo $labelta->discount; ?>% discount on goods) </span>
                            <?php
                                     }
                                 
                                
                                    $amount = $discount / 100 * $cost / 1;
                                    $total_discount = $cost - $amount;
                                    $total_cost = $total_discount + $landing_cost;
                                
                                
                              ?>
                     
                            <h4 class="mb-0">NGN <?php 
                            
                            
                                   
                                    $Total_Amnts = number_format($total_cost);
                                    echo $Total_Amnts; 
                                 
                                 
                            ?></h4>
                             <?php
                                     
                                 }
                                }
                         
                      ?>
                            </td>
                        </tr>
                       
                          <tr class'mt-5 pt-5'>
                              <td><b>Amount in words:</b></td>
                            <td colspan="5">
                                <?php
                                        
                            				$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                            				echo "<h4 class='mb-0'>" . ucwords($f->format($total_cost)." Naira Only</h4>");
                                ?>
                            </td>
                             
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
