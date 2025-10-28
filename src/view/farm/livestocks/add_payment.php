<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];

$user = new User();
if ($user->isLoggedIn()) {

    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory);
    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
    if ($userSyscategory == 2 || $userSyscategory == 3) {
?>
        <div class="container m-0 p-0">
            <div class="jumbotron jumbotron-fluid bg-white m-0 p-0">
                <div id="accounttile" class="">

                    <div class="card-body text-center">
                        <p class="">
                            Add New Payment</p>
                        <form class="row" autocomplete="off">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- member_id !-->
                                    <input type="hidden" name="member_id" id="member_id" value="<?php echo $member_id; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="matric_no" class="sr-only"> Matric No.</label>
                                    <input type="text" name="matric_no" id="matric_no" class="form-control" placeholder="Matric No." />
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="sr-only"> Amount</label>
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" />
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="sr-only"> Balance</label>
                                    <input type="text" name="balance" id="balance" class="form-control" placeholder="Balance" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_type" class="sr-only"> Paymnet Title</label>
                                    <select class="form-control" name="payment_type" id="payment_type">
                                        <option value="" selected>--Paymnet Title--</option>
                                        <?php

                                        $payments = Db::getInstance()->query("SELECT * FROM `payment_type` ORDER BY `id` DESC");
                                        foreach ($payments->results() as $payments) {

                                        ?>
                                            <option value="<?php echo $payments->id; ?>"><?php echo $payments->name; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="paid" class="sr-only">Paid</label>
                                    <input type="text" name="paid" id="paid" class="form-control" placeholder="Paid" />
                                </div>
                                <div class="form-group">
                                    <label for="balance" class="sr-only">Remark</label>
                                    <textarea id="remark" name="remark" class="form-control" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="added_by" id="added_by" value="<?php echo escape($user->data()->id); ?>" />

                            </div>
                            <div id="submitButton">
                                <button type="button" id="save" class="btn btn-light">
                                    <span class="fa fa-save"> Save</span>
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    <?php

    }

} else {
    $user->logout();
    Redirect::to('../../login/');
}


?>

<script>
    $(document).ready(function(event) {
        $("#save").click(function() {

            let matric_no = $('#matric_no').val();
            let member_id = $('#member_id').val();
            let amount = $('#amount').val();
            let payment_type = $('#payment_type').val();
            let paid = $('#paid').val();
            let balance = $('#balance').val();
            let remark = $('#remark').val();
            let added_by = $('#added_by').val();


            $.ajax({
                url: "view/payments/add_payment_server.php",
                method: 'POST',
                data: {

                    'matric_no': matric_no,
                    'member_id': member_id,
                    'amount': amount,
                    'payment_type': payment_type,
                    'paid': paid,
                    'balance': balance,
                    'remark': remark,
                    'added_by': added_by

                },
                success: function(data) {

                    dalert.alert(data);

                },
                error: function(xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }

            });

        });
        event.preventDefault();
    });
</script>