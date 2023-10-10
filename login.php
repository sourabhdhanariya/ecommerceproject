<?php
include 'function.php';
session_start(); 
$email = '';
$password = '';
$emailError = '';
$passwordError = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $database = new Database();
    $database->handleLogin($email, $password);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
    <meta name="keywords" content="free dashboard template, free admin, free bootstrap template, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        
.size{
  
  font-size: inherit;
}

    </style>
    <!-- Style.css -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">



</head>
<body class="fix-menu    bg-primary common-img-bg"  >
        <!-- Pre-loader start -->
    <!-- Pre-loader end -->
  
<section class=" p-fixed d-flex text-center login ">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form id="first_form" class="md-float-material" method="post" action="">

                          
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                <img src="assets/images/logo-dark.png" alt="logo.png">
                            </div>
                                    </div>
                                </div>
                                <hr/>



                                <div class="form-group row p-l-10 p-r-10">
    <label for="usernameemail">Email address</label>
    <input type="text" name="email" id="email" class="form-control" aria-describedby="emailHelp" placeholder="Your Email Address">
    <div class="text-danger size float-left emailNotificationMessage"><?php echo $emailError; ?></div>

</div>

<div class="form-group row p-l-10 p-r-10">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    <div class="text-danger size float-left passwordNotificationMessage"><?php echo $passwordError; ?></div>
  
</div>

                  

                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">log in</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                
                                    </div>
                                    <div class="col-md-2">
                                        <img src="assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    
    <script>
        
$(document).ready(function() {
        $('#first_form').validate({
            rules: {
                email: {
                    required: true,
                    checkEmail: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    checkPassword: true
                },
            },
            messages: {
                usernameemail: {
                    required: 'Please enter an email address',
                
                },
                password: {
                    required: 'Please enter a password',
                    minlength: 'Password must be at least 8 characters long',
                    checkPassword: 'Password must contain at least one special character and one uppercase letter'
                },
            },
        });

  // Custom validation method to check password
  $.validator.addMethod('checkEmail', function(value) {
            

            // Check for at least one special character
            var Email = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
            if (!Email.test(value)) {
                return false;
            }

          
            return true;
        }, 'Please valid emailadresss');
        
       

        // Custom validation method to check password
        $.validator.addMethod('checkPassword', function(value) {
            // Minimum length check
            if (value.length < 8) {
                return false;
            }

            // Check for at least one special character
            var specialCharacter = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;
            if (!specialCharacter.test(value)) {
                return false;
            }

            // Check for at least one uppercase letter
            var uppercaseCharacter = /[A-Z]/;
            if (!uppercaseCharacter.test(value)) {
                return false;
            }

            return true;
        }, 'Password must contain at least one special character and one uppercase letter');
        
    });
    
    </script>
   <script>
    document.addEventListener("DOMContentLoaded", function() {
        var emailInput = document.getElementById("email");
        var passwordInput = document.getElementById("password");

        var emailNotificationMessage = document.querySelector(".emailNotificationMessage");
        var passwordNotificationMessage = document.querySelector(".passwordNotificationMessage");

        emailInput.addEventListener("input", function() {
            if (emailInput.value.length === 0) {
                emailNotificationMessage.innerHTML = "Invalid Credentials";
                setTimeout(function() {
                    emailNotificationMessage.innerHTML = "";
                }, 1000); // 2 seconds delay
            } else {
                emailNotificationMessage.innerHTML = "";
            }
        });

        passwordInput.addEventListener("input", function() {
            if (passwordInput.value.length === 0) {
                passwordNotificationMessage.innerHTML = "Invalid Credentials";
                setTimeout(function() {
                    passwordNotificationMessage.innerHTML = "";
                }, 1000); // 2 seconds delay
            } else {
                passwordNotificationMessage.innerHTML = "";
            }
        });
    });
</script>

</body>

</html>
