<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {
    $userSyscategory = escape($user->data()->syscategory);
    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

?>
    <!-- Datatable !-->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <script>
        $(document).ready(function() {
            $('#ganiu').DataTable();
        });
    </script>
    <!-- End datatable !-->


    <div class="row m-0 p-0">
        <div class="container">
            <div class="card" style="max-width: 100%;">
                <div class="row no-gutters">
                    <h6>Payment Titles</h6>

                    <div class="col-sm-12">
                        <?php

                        $username = escape($user->data()->username);
                        $userSyscategory = escape($user->data()->syscategory);
                        $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

                        if ($userSyscategory == 1 ||  $userSyscategory == 3) {

                        ?>
                            <div style="float:right;">

                                <button class="add_paymenttype border">
                                    <span class="fa fa-plus"> Add Payment Title</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive data-font">
                                    <table id="ganiu" class="table table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/No.</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Created</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $ptype = Db::getInstance()->query("SELECT * FROM `payment_type`");

                                            if ($ptype->count()) {
                                                foreach ($ptype->results() as $ptyp) {

                                            ?>

                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $ptyp->name; ?></td>
                                                        <td><?php echo $ptyp->added_by; ?></td>
                                                        <td><?php echo $ptyp->created; ?></td>
                                                        <td>
                                                            <div style="float:left;">
                                                                <button id="<?php echo $ptyp->id; ?>" class="edit_payment_type btn btn-default border">
                                                                    <span class="fa fa-edit"></span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                            <?php

                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        <?php
                        } else {
                        ?>

                            <div class="card-body">
                                <div class="table-responsive data-font">
                                    <table id="ganiu" class="table table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">S/No.</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $ptype = Db::getInstance()->query("SELECT * FROM `payment_type`");

                                            if ($ptype->count()) {
                                                foreach ($ptype->results() as $ptyp) {

                                            ?>

                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $ptyp->name; ?></td>
                                                        <td><?php echo $ptyp->added_by; ?></td>
                                                        <td><?php echo $ptyp->created; ?></td>
                                                       
                                                    </tr>

                                            <?php

                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        <?php
                        }
                        ?>
                        <div class="mt-3 mb-0 text-right">
                            <button class='myPop-close btn-danger'><span class='fa fa-times text-white'></span> Close</button>
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