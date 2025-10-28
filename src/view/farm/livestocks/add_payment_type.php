 <?php

    require_once '../../core/init.php';

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

                 <p class="login-card-description mt-2">
                     Add Payment Title</p>
                 <form method="POST" autocomplete="off">
                     <div class="form-group">
                         <label for="name" class="sr-only">Payment Title</label>
                         <input type="text" name="name" value="" id="name" class="form-control" placeholder="Payment Type Name" />
                     </div>

                     <?php
                        $username = escape($user->data()->id);

                        ?>
                     <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                     <div id="submitButton">
                         <button type="button" id="save" class="btn btn-light">
                             <span class=" fa fa-save"> Save</span>
                         </button>
                     </div>
                 </form>
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
     $(document).ready(function(e) {
         $("#save").click(function() {

             var name = $('#name').val();
             var added_by = $('#added_by').val();

             if (name != '' && added_by != '') {
                 $.ajax({
                     url: "view/payments/add_payment_type_server.php",
                     method: 'POST',
                     data: {

                         'name': name,
                         'added_by': added_by

                     },
                     success: function(data) {

                         dalert.alert(data);
                         //dataTable.ajax.reload("index");

                     }
                 });
             } else {
                 dalert.alert("Payment type name is required");
             }
         });
         e.preventDefault();
     });
 </script>