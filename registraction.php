<?php
include 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $iv = '1234567890123456';  // IV should be exactly 16 bytes long
  
    // Replace 'your_encryption_key' with your actual encryption key
    $encryptionKey = 'sourabhdhanariya12354566ddjdjdj';
    $encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $encryptionKey, 0, $iv);

    $user = new User($email, $encryptedPassword);

    $query = "INSERT INTO tb_user (email, password) VALUES ('" . $user->getEmail() . "', '" . $user->getPassword() . "')";
    $database->executeQuery($query);

    echo 'User registered successfully!';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label>Email:</label><br>
        <input type="email" name="email"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
