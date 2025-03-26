<?php
session_start();
$mobile = $_SESSION["mobile_no"];

if (isset($_POST['login_otp'])) {
    $err = "";
    $ses = "";
    $otp = rand(111111, 999999);

    $_SESSION['otp'] = $otp;

    if (preg_match("/^\d+\.?\d*$/", $mobile) && strlen($mobile) == 10) {
        $fields = array(
            "variables_values" => "$otp",
            "route" => "otp",
            "numbers" => "$mobile",
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: VB2pPK3jjKoVCluVaZMKhC8dDZPNdCttlkCPAGh2TDzZXL5SlED7roZHWnFo",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $_SESSION['error'] = "cURL Error #:" . $err;
        } else {
            $data = json_decode($response);
            $sts = $data->return;
            if ($sts == false) {
                $_SESSION['error'] = "OTP Not Sent";
            } else {
                $_SESSION['success'] = "Your OTP has been sent!";
            }
        }
    } else {
        $_SESSION['error'] = "Invalid Mobile Number";
    }

    header('location:../otp/otp.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
   <link rel="stylesheet" href="./style.css">
</head>

<body>

   <form action="" method="post" class="form bg-glass">
      <h1>Login</h1>

      <!-- Display Success or Error Messages -->
      <?php
      if (isset($_SESSION['error'])) {
          echo '<div class="message error">' . $_SESSION['error'] . '</div>';
          unset($_SESSION['error']); // Clear the session error message after displaying it
      }
      if (isset($_SESSION['success'])) {
          echo '<div class="message success">' . $_SESSION['success'] . '</div>';
          unset($_SESSION['success']); // Clear the session success message after displaying it
      }
      ?>

      <a href="../qr code/qr.php" class="button" style="margin-left:165px; margin-right: 155px; text-decoration: none;">Login with QR</a>
      <button class="button" style="margin-left:165px; margin-right: 120px; text-decoration: none;" type="submit" name="login_otp">Login with OTP</button>
      
   </form>

</body>

</html>
