<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/customise.css" />
    <script type="text/javaScript" src="./js/customise.js"></script>
  </head>

  <body>
    <nav class="navbar container">
        <!-- hamburger -->
        <div id="menuToggle" class="left-menu">
            <!-- hamburger -->
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>

            <!-- menu inside hamburger -->
            <ul id="menu">
                <a href="./menu.php">
                    <li>Menu</li>
                </a>
                <a href="#">
                    <li>About</li>
                </a>
                <a href="#">
                    <li>Info</li>
                </a>
                <a href="#">
                    <li>Contact</li>
                </a>
                <a href="#" target="_blank">
                    <li>Show me more</li>
                </a>
            </ul>
        </div>
        <!-- logo -->
        <div class="logo">
            <a href="./index.php">
                <img src="images/logo.png" alt="Logo">
            </a>
        </div>

        <!-- login & cart -->
        <div id="rightnav">
            <a href="#"> Login/Register </a>
            <a href="#"> Cart </a>
        </div>
    </nav>
    
    <?php
      $to = "f32ee@localhost";
      $subject = "Test Email";
      $message = "This is a test email message.";

      // Additional headers
      $headers = "From: f31ee@localhost\r\n";
      $headers .= "Reply-To: f31ee@localhost\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion();

      // Attempt to send the email
      if (mail($to, $subject, $message, $headers, "-f31ee@localhost")) {
          echo "Email sent successfully";
      } else {
          echo "Email sending failed";
      }
    ?>
        
  </body>
</html>

