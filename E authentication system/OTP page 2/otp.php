<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Verify Account</title>
  </head>
  <body>
    <form method="post" action="sendsms.php">
      <div class="container">
        <h2>Verify Your OTP</h2>
        <p>We messaged you the six-digit code <br /> Enter the code below to confirm your identity.</p>
        <div class="code-container">
          <input type="text" class="code" placeholder="0" inputmode="numeric" maxlength="1" required />
          <input type="text" class="code" placeholder="0" inputmode="numeric" maxlength="1" required />
          <input type="text" class="code" placeholder="0" inputmode="numeric" maxlength="1" required />
          <input type="text" class="code" placeholder="0" inputmode="numeric" maxlength="1" required />
          <input type="text" class="code" placeholder="0" inputmode="numeric" maxlength="1" required />
          <input type="text" class="code" placeholder="0" inputmode="numeric" maxlength="1" required />
        </div>
        <!-- Submit Button -->
        <button type="submit" class="button" style="margin-left:120px; margin-right: 120px;">Verify</button>
      </div>
    </form>
    <script src="script.js"></script>
  </body>
</html>
