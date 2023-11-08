<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/login.css" />
    <script type="text/javaScript" src="./js/login.js"></script>
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
                <a href="./index.php">
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

        <div id="rightnav">
            <!-- <a href="#"> Cart </a> -->
        </div>

    </nav>
    <?php
        include "./php/dbconnect.php";
        session_start();

        if(isset($_POST["type"])){
            if ($_POST["type"] == "login"){
                // Protect against SQL injection
                $email = $dbcnx->real_escape_string($_POST['email']);
                $password = $dbcnx->real_escape_string($_POST['password']);
                $password = md5($password);
                
                $sql = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
                $result = $dbcnx->query($sql);
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Found a matching user
                        // Do something with the user data
                        $userDetails = array(
                            "firstName" => $row['firstName'],
                            "lastName" => $row['lastName'],
                            "email" => $row['email'],
                            "Phone" => $row['phone'],
                            "Address" => $row['address'],
                            "Unit" => $row['unit'],
                            "Postal" => $row['postalCode']
                        );
                        $_SESSION['deliveryDetails'] = $userDetails;
                        $_SESSION['login'] = true;
                        header("Location: index.php");
                    }
                } else {
                    echo "<div class='response-content'>
                            <h2>Login Failed</h2>
                            <img src='./assets/error.png' class='response-image'>
                            <span>Invalid Email or Password</span>
                            <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='login.php' class='no-style'>Back</a></button>
                            </div>";
                }

                
            }else if ($_POST["type"] == "register"){
                $firstName = $dbcnx->real_escape_string($_POST['firstName']);
                $lastName = $dbcnx->real_escape_string($_POST['lastName']);
                $email = $dbcnx->real_escape_string($_POST['email']);
                $password = $dbcnx->real_escape_string($_POST['password']);
                $password = md5($password);
                $phone = $dbcnx->real_escape_string($_POST['phone']);
                $address = $dbcnx->real_escape_string($_POST['address']);
                $unit = $dbcnx->real_escape_string($_POST['unit']);
                $postalCode = $dbcnx->real_escape_string($_POST['postal']);
                $member = 'Member';

                // Check for existing email
                $sql_check = "SELECT * FROM Users WHERE email = '$email'";
                $result_check = $dbcnx->query($sql_check);

                if ($result_check->num_rows > 0) {
                    // Email already exists
                    echo "<div class='response-content'>
                        <h2>Register Failed</h2>
                        <img src='./assets/error.png' class='response-image'>
                        <span>Email already exists, please use a different email</span>
                        <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='login.php' class='no-style'>Back</a></button>
                        </div>";
                } else {
                    // Email is unique, proceed with insertion
                    $sql_insert = "INSERT INTO Users (firstName, lastName, email, password, phone, address, unit, postalCode, userType) VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$address', '$unit', '$postalCode', '$member')";

                    if ($dbcnx->query($sql_insert) === TRUE) {
                        echo "<div class='response-content'>
                            <h2>Account Created</h2>
                            <img src='./assets/success.png' class='response-image'>
                            <span>Please login with your email and password</span>
                            <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='login.php' class='no-style'>Login Page</a></button>
                            </div>";
                    } else {
                        echo "<div class='response-content'>
                        <h2>Register Failed</h2>
                        <img src='./assets/error.png' class='response-image'>
                        <span>Error occured in Database. Please try again.</span>
                        <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='login.php' class='no-style'>Back</a></button>
                        </div>";
                    }
                }
            };
        }else{
            echo "<div class='loginRegister'>
                    <div id='loginForm'>
                        <h2>Login</h2>
                        <form name='loginForm'
                            action='./login.php'
                            method='post'>
                            <table class='loginRegisterTable'>
                                <tr>
                                    <td><input type='email' name='email' placeholder='Email' style='width: 95%;' required></td>
                                </tr>
                                <tr>
                                    <td><input type='password' name='password' placeholder='Password' style='width: 95%;' required></td>
                                </tr>
                                <tr>
                                    <td><button class='orderBtn buttonRight'>Login</button></td>
                                </tr>
                                <tr>
                                    <td><p>Don't have an account? <a href='#' onclick='showRegisterForm()'>Register</a></p></td>
                                </tr>
                                <input name='type' value='login' hidden>
                            </table>
                        </form>
                    </div>
                    <div id='registerForm' style='display: none;'>
                        <h2>Register</h2>
                        <form name='registerForm'
                            action='./login.php'
                            method='post'>
                            <table class='loginRegisterTable'>                       
                                <tr>
                                    <td><input type='text' name='firstName' placeholder='First Name' required></td>
                                    <td><input type='text' name='lastName' placeholder='Last Name' required></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><input type='email' name='email' placeholder='Email' style='width: 95%;' required></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><input type='password' name='password' placeholder='Password' style='width: 95%;' required></td>
                                </tr>
                                <tr>
                                    <td><input type='text' name='unit' placeholder='Unit' required></td>
                                    <td><input type='text' name='postal' placeholder='Postal Code' required></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><input type='tel' pattern='[0-9]{8}' name='phone' placeholder='Phone' style='width: 95%;' required></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><input type='text' name='address' placeholder='Address' style='width: 95%;' required></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><button class='orderBtn buttonRight'>Register</button></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><p>Already have an account? <a href='#' onclick='showLoginForm()'>Login</a></p></td>
                                </tr>
                                <input name='type' value='register' hidden>
                            </table>
                        </form>
                    </div>
                </div>";
        }
    ?>

    


    <footer class="container">
        <div class="footer-column">
            <h4>Account</h4>
            <ul>
                <li><a href="#"> Manage Account</a></li>
                <li><a href="#">Orders</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Catering</h4>
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="#">What's New</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Company</h4>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Media Post</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Term & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Reviews</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Newsletter</h4>
            <form action="" method="post" style="color: #fffcf8c0; font-size: 12px;">
                <label for="email" style="color: #fffcf8c0;">Email*</label><br>
                <input type="email" name="email" id="email" placeholder="Email">
                <p style="color: #fffcf8c0; margin-top: 0%; margin-bottom: .5rem;">Subscribe for the latest menu
                    launches and updates</p>

                <input type="checkbox" name="consent" id="consent">
                <label for="consent">I consent to recieve marketing communications from Yunnan Catering</label>
                <br><br>

                <input type="submit" value="Submit" class="orderBtn">
            </form>
        </div>
        <div class="footer-column">
            <ul class="itemsFlex logo">
                <li><a href="#"><img src="./images/Facebook.png" alt="Facebook logo" height="40"></a></li>
                <li><a href="#"><img src="./images/Instagram.png" alt="Facebook logo" height="40"></a></li>
                <li><img src="./images/halal logo.png" alt="Facebook logo" height="40"></li>
            </ul>
        </div>

    </footer>
</body>

</html>