<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/email.css" />
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
          <a href="#">
            <li>Home</li>
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
          <a href="https://erikterwan.com/" target="_blank">
            <li>Show me more</li>
          </a>
        </ul>
      </div>
      <!-- logo -->
      <div class="logo">
        <img src="your-logo.png" alt="Logo" />
      </div>

      <!-- login & cart -->
      <div id="rightnav">
        <a href="#"> Login/Register </a>
        <a href="#"> Cart </a>
      </div>
    </nav>
    <?php
      session_start();
      $to = "f32ee@localhost";
      $subject = "Your Food Catering Order Details";
      $message = "Dear [First Name] [Last Name],\n\n".
      "Thank you for choosing our catering services for your event. We're excited to confirm your order and provide you with the necessary details:\n\n".
      "Order Details:\n".
      "- Delivery Time: [Delivery Time]\n".
      "- Delivery Address: [Delivery Address]\n".
      "- Total Cost: [Total Cost]\n\n".
      
      "Contact Information:\n".
      "- Phone: [Phone Number]\n".
      "- Address: [Address]\n".
      "- Unit: [Unit (if applicable)]\n".
      "- Postal Code: [Postal Code]\n\n".

      "List of Items Ordered:\n".
      "- [List of food items or menu details]\n\n".
      
      "We are committed to ensuring your event is a success with our delicious and freshly prepared food. If you have any specific requests or changes to the order, please let us know as soon as possible.\n\n".
      
      "Please note that our team will arrive at the specified delivery time with your order to the provided delivery address. If there are any updates or changes regarding the delivery, we will inform you promptly.\n\n".
      
      "If you have any further inquiries or need assistance, feel free to reach out to our customer service team at +65 9876 5432.\n\n".
      
      "We appreciate your trust in our catering services and look forward to serving you.\n\n".
      
      "Best Regards,\n".
      "Yunan Catering";

      // Additional headers
      $headers = "From: f31ee@localhost\r\n";
      $headers .= "Reply-To: f31ee@localhost\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion();

      // Attempt to send the email
      if (mail($to, $subject, $message, $headers, "-f31ee@localhost")) {
          echo "<div class='confirmation-content'>
                  <span>WE MUST SAY.</span>
                  <span>YOU'VE A GREAT CHOICE OF TASTE!</span>
                  <img src='./assets/deliverybear.gif' class='delivery-image'>
                  <span>YOUR ORDER WAS COMPLETED SUCESSFULLY</span>
                  <span>A EMAIL RECEIPT INCLUDING THE DETAILS ABOUT YOUR ORDER HAS BEEN SENT TO THE EMAIL PROVIDED</span>
                  <button type='button' style='margin-top: 10px;'><a href='index.html' class='no-style'>Continue Browsing</a></button>
                </div>";
      } else {
          echo "Email sending failed";
      }
    ?>

    
    
        
  </body>
</html>

