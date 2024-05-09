<?php
class Users extends DB
{
    public function getUser($username)
    {
        $qr = "select * from user where username = '$username' and deleted='0'";
        return $this->command($qr)->fetch_assoc();
    }
    public function getEmail($email)
    {
        $qr = "select * from user where email = '$email'";
        return $this->command($qr)->fetch_assoc();
    }
    public function getAccessKey($accesskey)
    {
        $qr = "select * from user where accesskey = '$accesskey'";
        return $this->command($qr)->fetch_assoc();
    }
    public function Register($username, $name, $email, $password, $accesskey)
    {
        $user = $this->getUser($username);
        $em = $this->getEmail($email);
        $password = password_hash($password, PASSWORD_BCRYPT);
        if (empty($user) && empty($em)) {
            $qr = "insert into user(username, fullname, email, password, avatar, deleted, accesskey) values('$username', '$name', '$email', '$password', './Views/Shared/img/default.png', -1, '$accesskey')";
            return $this->command($qr);
        }
        return false;
    }
    public function Login($username)
    {
        $qr = "select * from user where (username = '$username' or email = '$username') and role_id = '1'";
        try{
            return $this->command($qr)->fetch_assoc();
        }
        catch(Exception){
            return false;
        }
    }
    public function UpdateInfo($username, $phone, $fullname,  $email, $address, $birthday)
    {
        $qr = "update user set username = '$phone', fullname = '$fullname', email = '$email', address = '$address', birthday = $birthday, updated_at = default where username = '$username'";
        $qr2 = "update cart set username = '$phone' where username = '$username'";
        $qr3 = "update orders set username = '$phone' where username = '$username'";
        try {
            return $this->command($qr) && $this->command($qr2) && $this->command($qr3);
        } catch (Exception) {
            return false;
        }
    }
    public function UpdatePassword($username, $password)
    {
        $qr = "update user set password = '$password', updated_at = default, accesskey = default where username = '$username'";
        try {
            return $this->command($qr);
        } catch (Exception) {
            return false;
        }
    }
    public function ForgotPassword($email, $accesskey)
    {
        $qr = "update user set accesskey = '$accesskey' where email = '$email'";
        try {
            $this->command($qr);
            return true;
        } catch (Exception) {
            echo false;
        }
    }
    public function VerifyAccount($accesskey){
        $qr = "update user set accesskey = default, deleted ='0' where accesskey='$accesskey'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception){
            return false;
        }
    }
    // public function ResetPassword($accesskey)
    // {
    //     $qr = "update user set pass";
    //     try {
    //         $this->command($qr);
    //         return true;
    //     } catch (Exception) {
    //         echo false;
    //     }
    // }
}
