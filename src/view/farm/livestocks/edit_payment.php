 <?php

    require_once '../../core/init.php';
    $payment_id = $_POST['id'];
    $user = new User();
    if ($user->isLoggedIn()) {

    ?>
     <div class="row m-0 p-0">
         <div class="container">
             <div class="card" style="max-width: 100%;">
                 <div class="row no-gutters">
                     <h6>Payment Titles</h6>

                     <div class="col-sm-12">

                         <?php

                            $ptype = Db::getInstance()->query("SELECT * FROM payment WHERE id=$payment_id");
                            foreach ($ptype->results() as $ptypes) {

                            ?>
                             <form class="row" method="POST" autocomplete="off">
                                 <div class="col-sm-6">
                                     <div class="form-group">
                                         <label for="matric_no" class="sr-only">Matric No.</label>
                                         <input type="text" name="matric_no" placeholder="Matric No." value="<?php echo $ptypes->matric_no; ?>" id="matric_no" class="form-control" />
                                     </div>
                                     <div class="form-group">
                                         <label for="name" class="sr-only">Payment Type</label>
                                         <select class="form-control" name="payment_type" id="payment_type">
                                             <?php
                                                $previous = $ptypes->payment_type;
                                                $paymts = Db::getInstance()->query("SELECT * FROM `payment_type` WHERE id=$previous");
                                                foreach ($paymts->results() as $pay) {
                                                ?>
                                                 <option value="<?php echo $pay->id; ?>"><?php echo $pay->name; ?></option>
                                             <?php
                                                }
                                                ?>

                                             <?php

                                                $payments = Db::getInstance()->query("SELECT * FROM `payment_type` ORDER BY `id` DESC");
                                                foreach ($payments->results() as $payment) {
                                                ?>
                                                 <option value="<?php echo $payment->id; ?>"><?php echo $payment->name; ?></option>
                                             <?php
                                                }
                                                ?>
                                         </select>
                                     </div>
                                     <div class="form-group">
                                         <label for="amount" class="sr-only">Amount</label>
                                         <input type="text" name="amount" placeholder="Amount" value="<?php echo $ptypes->amount; ?>" id="amount" class="form-control" />
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="form-group">
                                         <label for="paid" class="sr-only">Paid</label>
                                         <input type="text" name="paid" placeholder="Paid" value="<?php echo $ptypes->paid; ?>" id="paid" class="form-control" />
                                     </div>
                                     <div class="form-group">
                                         <label for="balance" class="sr-only">Balance</label>
                                         <input type="text" name="balance" value="<?php echo $ptypes->balance; ?>" id="balance" class="form-control" />
                                     </div>
                                     <div class="form-group">
                                         <label for="remark" class="sr-only">Remark</label>
                                         <textarea id="remark" class="remark" style="width:100%" rows="5" class="form-control"><?php echo $ptypes->remark; ?></textarea>
                                     </div>
                                 </div>
                                 <?php
                                    $username = escape($user->data()->id);

                                    ?>

                                 <input type="hidden" name="member_id" id="member_id" value="<?php echo $ptypes->member_id; ?>" />
                                 <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                 <input type="hidden" name="payment_id" id="payment_id" value="<?php echo $payment_id; ?>" />
                                 <div id="submitButton col-md-12">
                                     <button type="button" id="save" class="btn btn-light px-5 mb-3">
                                         <span class="fa fa-edit"></span> Update
                                     </button>
                                 </div>
                             <?php } ?>
                             </form>
                     </div>
                 </div>
                 <div class="mt-3 mb-0 text-right">
                     <button class='myPop-close btn-danger'><span class='fa fa-times text-white'></span> Close</button>
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
     $(document).ready(function(event) {
         $("#save").click(function() {

             let payment_id = $('#payment_id').val();
             let member_id = $('#member_id').val();
             let matric_no = $('#matric_no').val();
             let payment_type = $('#payment_type').val();
             let amount = $('#amount').val();
             let paid = $('#paid').val();
             let balance = $('#balance').val();
             let remark = $('#remark').val();
             let added_by = $('#added_by').val();

             if (matric_no != '' && added_by != '') {
                 $.ajax({
                     url: "view/payments/edit_payment_server.php",
                     method: 'POST',
                     data: {
                         'payment_id': payment_id,
                         'member_id': member_id,
                         'matric_no': matric_no,
                         'payment_type': payment_type,
                         'amount': amount,
                         'paid': paid,
                         'balance': balance,
                         'remark': remark,
                         'added_by': added_by

                     },
                     success: function(data) {

                         dalert.alert(data);
                         //dataTable.ajax.reload();

                     }
                 });
             } else {
                 dalert.alert("Payment Title is required");
             }
         });
         event.preventDefault();
     });
 </script>