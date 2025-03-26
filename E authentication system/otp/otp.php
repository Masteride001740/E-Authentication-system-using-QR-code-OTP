<?php 
session_start(); // Ensure session is started

// OTP verification logic
if (isset($_POST['verify'])) {
    $check_ot = $_POST['one'] . $_POST['two'] . $_POST['three'] . $_POST['four'] . $_POST['five'] . $_POST['six'];

    if ($_SESSION['otp'] == $check_ot) {
        // Redirect to the success page
        header("location:../demo/index.html");
        exit();
    } else {
        // OTP is incorrect
        $error_message = "Wrong OTP, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <title>Verify Account</title>
  </head>
  <body>
    <div class="container">
      <h2>Verify Your OTP</h2>
      <form method="post" name="otp-form">
        <p>We messaged you the six-digit code. <br/> Enter the code below to confirm your identity.</p>
        
        <?php
          // Display error message if OTP is incorrect
          if (isset($error_message)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . $error_message . '</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
          }
        ?>

        <div class="code-container">
          <input type="number" class="code" name="one" placeholder="0" min="0" max="9" required>
          <input type="number" class="code" name="two" placeholder="0" min="0" max="9" required>
          <input type="number" class="code" name="three" placeholder="0" min="0" max="9" required>
          <input type="number" class="code" name="four" placeholder="0" min="0" max="9" required>
          <input type="number" class="code" name="five" placeholder="0" min="0" max="9" required>
          <input type="number" class="code" name="six" placeholder="0" min="0" max="9" required>
        </div>
        
        <button class="button" type="submit" name="verify" style="margin-left:120px; margin-right: 120px; text-decoration: none;">Verify</button>
      </form>
    </div>

    <!-- Scripts -->
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
