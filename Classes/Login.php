<?php
/**
 * Class DashboardClass
 *
 * @author sourabh dhanariya <kuamwatsourabh65@gmail.com>
 */
include './systemconfiguration.php';

class LoginClass extends Database
{
    /**
     *  string $email 
     *  string $password 
     */
    public function loginData(string $email, string $password)
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
              }
        } else {
            echo CATEGORI_QUERY;
        }
    }


}
?>