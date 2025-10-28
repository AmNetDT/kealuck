<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>


  <!-- Datatable !-->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <script>
    $(document).ready(function() {
      $('#abdusalaam').DataTable();
      $('#abd').DataTable();
    });
  </script>
  <!-- End datatable !-->



  <div id="body_general">
    <div id="accounttile">
      <div class="col-sm-12 col-sm-6">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="container">
      <div class="jumbotron jumbotron-fluid pt-3 bg-white">
        <div id="accounttile" class="container">
          <h3>Livestock Manager</h3>
          <div id="btn_c" style="text-align: right;">
            <?php

            $username = escape($user->data()->id);
            $userSyscategory = escape($user->data()->syscategory);
            //$privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

            ?>
            
            <button class="view_payment_type border">
              <span class="fa fa-search"> Livestock Type</span>
            </button>

          </div>
          <div class="row">
            <div class="col-sm-12 px-0">
              <div class="card">
                <div class="card-body">
                  <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <h6 class="card-title p-2">All Records</h6>
                  </div>


                  <?php
                  if ($userSyscategory == 2) {

                    $paymenta = Db::getInstance()->query("SELECT * FROM `payment` WHERE added_by = '$username' AND payment_type !=1 ORDER BY id DESC");
                    if (!$paymenta->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                  ?>

                      <div class="table-responsive data-font">
                        <table id="abdusalaam" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">SN</th>
                              <th scope="col">Created</th>
                              <th scope="col">Modified</th>
                              <th scope="col">Matric No.</th>
                              <th scope="col">Title</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Paid</th>
                              <th scope="col">Balance</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $i = 1;
                            foreach ($paymenta->results() as $payment) {

                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $payment->created; ?></td>
                                <td><?php echo $payment->modified; ?></td>
                                <td><?php echo $payment->matric_no; ?></td>
                                <td><?php
                                    $payment_type = $payment->payment_type;

                                    ?>

                                  <?php

                                  $paymentsty = Db::getInstance()->query("SELECT * FROM `payment_type` WHERE id = $payment_type");
                                  if (!$paymentsty->count()) {
                                    echo "Not specified";
                                  } else {
                                    foreach ($paymentsty->results() as $paymentst) {
                                      echo $paymentst->name;
                                    }
                                  }
                                  ?>

                                </td>
                                <td><?php echo $payment->amount; ?></td>
                                <td><?php echo $payment->paid; ?></td>
                                <td><?php echo $payment->balance; ?></td>
                                <td>
                                  <div id="<?php echo $payment->id ?>" land="<?php echo $payment->matric_no ?>" class="edit_payment" style="float:left;">
                                    <button class="btn btn-default border">
                                      <span class="fa fa-edit"></span>
                                    </button>
                                  </div>
                                </td>
                              </tr>
                            <?php
                            }
                            ?>

                          </tbody>
                        </table>

                        <table class="table table-hover table-bordered mt-2" style="width:100%">
                          <tbody>
                            <tr>
                              <td style="width:55%">&nbsp;</td>
                              <td><strong>Total</strong></td>
                              <td>
                                Amount: &nbsp;
                                <?php

                                $totalpaymenta = Db::getInstance()->query("SELECT sum(amount) as total FROM `payment` WHERE added_by = '$username' AND payment_type !=1");
                                if (!$totalpaymenta->count()) {
                                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                } else {
                                  foreach ($totalpaymenta->results() as $totalpayment) {
                                    echo $totalpayment->total;
                                  }
                                }

                                ?>
                              </td>
                              <td>
                                Paid: &nbsp;
                                <?php

                                $totalpaymenta = Db::getInstance()->query("SELECT sum(paid) as total FROM `payment` WHERE added_by = '$username' AND payment_type !=1");
                                if (!$totalpaymenta->count()) {
                                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                } else {
                                  foreach ($totalpaymenta->results() as $totalpayment) {
                                    echo $totalpayment->total;
                                  }
                                }

                                ?>
                              </td>
                              <td>
                                Balance: &nbsp;
                                <?php

                                $totalpaymenta = Db::getInstance()->query("SELECT sum(balance) as total FROM `payment` WHERE added_by = '$username' AND payment_type !=1");
                                if (!$totalpaymenta->count()) {
                                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                } else {
                                  foreach ($totalpaymenta->results() as $totalpayment) {
                                    echo $totalpayment->total;
                                  }
                                }

                                ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    <?php
                    }
                  } else {

                    $paymenta = Db::getInstance()->query("SELECT * FROM `payment` WHERE payment_type !=1 ORDER BY id DESC");
                    if (!$paymenta->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                    ?>
                      <div class="table-responsive data-font">
                        <table id="abd" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">SN</th>
                              <th scope="col">Created</th>
                              <th scope="col">Modified</th>
                              <th scope="col">Matric No.</th>
                              <th scope="col">Campus</th>
                              <th scope="col">Title</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Paid</th>
                              <th scope="col">Balance</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $i = 1;
                            foreach ($paymenta->results() as $payment) {

                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $payment->created; ?></td>
                                <td><?php echo $payment->modified; ?></td>
                                <td><?php echo $payment->matric_no; ?></td>
                                <td>
                                  <?php
                                  //echo $payment->added_by;
                                  $campu = $payment->added_by;
                                  $cmpuspay = Db::getInstance()->query("SELECT l.name AS campusname FROM `users` AS u, `locations` AS l WHERE u.username = '$campu' AND l.id=u.location");
                                  foreach ($cmpuspay->results() as $campuspa) {

                                    echo $campuspa->campusname;
                                  }

                                  ?>
                                </td>
                                <td><?php
                                    $payment_type = $payment->payment_type;

                                    ?>

                                  <?php

                                  $paymentsty = Db::getInstance()->query("SELECT * FROM `payment_type` WHERE id = $payment_type");
                                  if (!$paymentsty->count()) {
                                    echo "<h4 class='my-5 text-center'>Not available</h4>";
                                  } else {
                                    foreach ($paymentsty->results() as $paymentst) {
                                      echo $paymentst->name;
                                    }
                                  }
                                  ?>

                                </td>
                                <td><?php echo $payment->amount; ?></td>
                                <td><?php echo $payment->paid; ?></td>
                                <td><?php echo $payment->balance; ?></td>
                              </tr>

                            <?php
                            }
                            ?>
                          </tbody>
                        </table>
                        <table class="table table-hover table-bordered mt-2" style="width:100%">
                          <tbody>
                            <tr>
                              <td style="width:60%">&nbsp;</td>
                              <td><strong>Total</strong></td>
                              <td>
                                Amount: &nbsp;
                                <?php

                                $totalpaymenta = Db::getInstance()->query("SELECT sum(amount) as total FROM `payment` WHERE payment_type !=1");
                                if (!$totalpaymenta->count()) {
                                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                } else {
                                  foreach ($totalpaymenta->results() as $totalpayment) {
                                    echo $totalpayment->total;
                                  }
                                }

                                ?>
                              </td>
                              <td>
                                Paid: &nbsp;
                                <?php

                                $totalpaymenta = Db::getInstance()->query("SELECT sum(paid) as total FROM `payment` WHERE payment_type !=1");
                                if (!$totalpaymenta->count()) {
                                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                } else {
                                  foreach ($totalpaymenta->results() as $totalpayment) {
                                    echo $totalpayment->total;
                                  }
                                }

                                ?>
                              </td>
                              <td>
                                Balance: &nbsp;
                                <?php

                                $totalpaymenta = Db::getInstance()->query("SELECT sum(balance) as total FROM `payment` WHERE payment_type !=1");
                                if (!$totalpaymenta->count()) {
                                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                } else {
                                  foreach ($totalpaymenta->results() as $totalpayment) {
                                    echo $totalpayment->total;
                                  }
                                }

                                ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                  <?php
                    }
                  }
                  ?>
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

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>