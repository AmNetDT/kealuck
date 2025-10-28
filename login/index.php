<?php
require_once '../core/init.php';

$smsg;
$fmsg;

if (Input::exists()) {
    
  if (Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'username' => array('required' => true),
      'password' => array('required' => true)
    ));

    if ($validation->passed()) {

      $user = new User();
      $remember = (Input::get('remember') === 'on') ? true : false;
      $login = $user->login(Input::get('username'), Input::get('password'), $remember);

      if ($login) {
          
        Redirect::to('../src/console');
        
      } else {
          
        $fmsg = 'Sorry, check your login details.';
        
      }
    } else {

      foreach ($validation->errors() as $error) {
          
        $fmsg = $error . '<br/>';
        
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../src/assets/image/favicon.png" />
  <title>KEALUCK</title>
  <link href="../src/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../src/css/style.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <div class="row justify-content-center py-0 my-0">

      <div class="col-sm-3 pt-3 border radius">

        <div class="card-body px-4 mb-5 text-center">

          <img src="../src/assets/images/logo.jpg" alt="logo" class="logo" />

          <p class="login-card-description mt-2">
            Login to your account</p>
          <form method="POST" action="" autocomplete="off" class="mb-5">
            <div class="form-group">
              <label for="username" class="sr-only">User</label>
              <input type="text" name="username" id="UserId" class="form-control" placeholder="User" />
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Remember me
              </label>
              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
            </div>
            <div id="submitButton">
              <button type="submit" id="logB" class="btn btn-dark my-3">
                Login
              </button>



              <p><?php if (isset($fmsg)) {
                  
                    echo '<div class="alert alert-danger">' . $fmsg . '<div>';
                    
                  } else if (isset($smsg)) {
                      
                    echo '<div class="alert alert-success">' . $smsg . '</div>';
                    
                  } ?></p>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  </div>

  </div>
  <footer class="footer fixed-bottom text-center" style="background-color: #77bc54; color:#ffffff">
    &copy; &nbsp; KEALUCK <script>
      document.write(new Date().getFullYear());
    </script>
  </footer>

</body>

</html>