    
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