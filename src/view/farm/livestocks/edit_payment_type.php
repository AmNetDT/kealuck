 <?php

    require_once '../../core/init.php';
    $payment_type_id = $_POST['id'];
    $user = new User();
    if ($user->isLoggedIn()) {

    ?>
     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
     <html xmlns="http://www.w3.org/1999/xhtml">

     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <title>Untitled Document</title>
     </head>

     <body>
         <div class="container">

             <div class="px-3 text-center">

                 <?php

                    $ptype = Db::getInstance()->query("SELECT * FROM payment_type WHERE id=$payment_type_id");
                    foreach ($ptype->results() as $ptypes) {

                    ?>
                     <form method="POST" autocomplete="off">
                         <div class="form-group">
                             <label for="name" class="sr-only">Payment Title</label>
                             <input type="text" name="name" value="<?php echo $ptypes->name; ?>" id="name" class="form-control" />
                         </div>

                         <?php
                            $username = escape($user->data()->id);

                            ?>
                         <input type="hidden" name="id" id="ptypes_id" value="<?php echo $ptypes->id; ?>" />
                         <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                         <div id="submitButton">
                             <button type="button" id="save" class="btn btn-primary px-5 mb-3">
                                 Update
                             </button>
                         </div>
                     <?php } ?>
                     </form>
             </div>
             <div class="mt-3 mb-0 text-right">
                 <button class='myPop-close btn-danger'><span class='fa fa-times text-white'></span> Close</button>
             </div>
         </div>




     </body>
     </form>

     </html>
 <?php

    } else {
        $user->logout();
        Redirect::to('../../login/');
    }


    ?>
 <script>
     $(document).ready(function(event) {
         $("#save").click(function() {

             var id = $('#ptypes_id').val();
             var name = $('#name').val();
             var added_by = $('#added_by').val();

             if (name != '' && added_by != '') {
                 $.ajax({
                     url: "view/payments/edit_payment_type_server.php",
                     method: 'POST',
                     data: {
                         'id': id,
                         'name': name,
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