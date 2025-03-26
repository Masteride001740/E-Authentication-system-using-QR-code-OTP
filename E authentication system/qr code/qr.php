<?php
session_start();

// Check if the user is already logged in (assuming you have a session for that)
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>QR code</title>
   
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
   <link rel="stylesheet" href="./style.css">
</head>

<body>
   <form action="" class="form bg-glass">
      <h1>Verify Your QR</h1>
      <p>We messaged you the QR code <br/> Point the QR code to the webcam for authentication.</p>

      <style>
        #preview {
            width: 500px;
            height: 500px;
            margin: -50px auto;
        }
      </style>

      <video id="preview"></video>
      
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
      <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
      <script type="text/javascript">
         var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
         
         scanner.addListener('scan', function(content) {
            console.log(content);
            
            if (content) {
                alert("Successfully logged in!!");
                window.location.href = "../demo/index.html";
            }
         });

         Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);

                $('[name="options"]').on('change', function() {
                    if ($(this).val() == 1) {
                        if (cameras[0] != "") {
                            scanner.start(cameras[0]);
                        } else {
                            alert('No Front camera found!');
                        }
                    } else if ($(this).val() == 2) {
                        if (cameras[1] != "") {
                            scanner.start(cameras[1]);
                        } else {
                            alert('No Back camera found!');
                        }
                    }
                });
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
         }).catch(function(e) {
            console.error(e);
            alert(e);
         });
      </script>

<?php

// Database connection
$mysql = mysqli_connect("localhost", "root", "", "auth");

// Check if connection is successful
if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT mobile FROM `register` LIMIT 1"; // Get just one mobile number (no need for loop)
$result = mysqli_query($mysql, $sql);

// Check if the query executed successfully
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $mobile = $row['mobile'];

    $service_plan_id = "a11ff293a2c64243bd34c7665acae766";
    $bearer_token = "ef011448a1744a92bb0469dedcad6991";

    // Your phone number for the API
    $send_from = "+447520651126";
    // Format the recipient phone number
    $recipient_phone_numbers = "+91" . $mobile;
    $message = "http://surl.li/bxlib";

    // Prepare the recipient phone numbers array
    if (stristr($recipient_phone_numbers, ',')) {
        $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
    } else {
        $recipient_phone_numbers = [$recipient_phone_numbers];
    }

    // Prepare the JSON payload
    $content = [
        'to' => array_values($recipient_phone_numbers),
        'from' => $send_from,
        'body' => $message
    ];

    $data = json_encode($content);

    // Send SMS via the API using cURL
    $ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$service_plan_id}/batches");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
    curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    if ($result === false) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        echo "SMS sent successfully!";
    }

    curl_close($ch);

} else {
    echo "No mobile number found!";
}

// Close the database connection
mysqli_close($mysql);
?>

   </form>
</body>

</html>
