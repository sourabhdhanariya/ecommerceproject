<?php
/**
 *  
 */

class LoginClass extends Database
{
    public function loginData($email, $password)
    {
        $iv = "1234567890123456";
        $encryptionKey = "sourabhdhanariya12354566ddjdjdj";
        $encryptedPassword = openssl_encrypt(
            $password,
            "aes-256-cbc",
            $encryptionKey,
            0,
            $iv
        );

        $query = "SELECT * FROM tb_user WHERE email='" . $email . "' AND password='" . $encryptedPassword . "'";
        $result = $this->mysqli->query($query);

        if ($result) {
            if ($result->num_rows == 1) {
                session_start();
                $_SESSION["email"] = $email;
                header("Location: dashboard.php");
                exit();
            } else {
                $emailError = "Invalid Credentials";
                $passwordError = "Invalid Credentials";
            }
        } else {
            echo "Query execution failed.";
        }
    }


}
?>