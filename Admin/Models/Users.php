<?php
class Users extends DB
{
    public function getAllUser($limit = ""){
        $qr = "select * from user where role_id = '1' order by created_at desc $limit";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function getUser($username)
    {
        $qr = "select * from user where role_id in ('1', '2') and username = '$username'";
        return $this->command($qr)->fetch_assoc();
    }
    public function getUserToChangePassword($username)
    {
        $qr = "select password from user where username = '$username'";
        return $this->command($qr)->fetch_assoc();
    }
    public function getEmail($email)
    {
        $qr = "select * from user where email = '$email'";
        return $this->command($qr)->fetch_assoc();
    }
    public function Register($username, $name, $email, $password)
    {
        $user = $this->getUser($username);
        $em = $this->getEmail($email);
        $password = password_hash($password, PASSWORD_BCRYPT);
        if (empty($user) && empty($em)) {
            $qr = "insert into user(username, fullname, email, password, avatar) values('$username', '$name', '$email', '$password', './Views/Shared/img/default.png')";
            return $this->command($qr)->fetch_assoc();
        }
        return false;
    }
    public function Login($username)
    {
        $qr = "select * from user where (username = '$username' or email = '$username') and role_id in ('0', '2')";
        return $this->command($qr)->fetch_assoc();
    }
    public function UpdateInfo($username, $phone, $fullname,  $email, $address, $birthday){
        $qr = "update user set username = '$phone', fullname = '$fullname', email = '$email', address = '$address', birthday = '$birthday', updated_at = default where username = '$username'";
        $qr2 = "update cart set username = '$phone' where username = '$username'";
        $qr3 = "update orders set username = '$phone' where username = '$username'";
        try{
            return $this->command($qr) && $this->command($qr2) && $this->command($qr3);
        }
        catch(Exception){
            return false;
        }
    }
    public function UpdatePassword($username, $password){
        $qr = "update user set password = '$password' where username = '$username'";
        
        try{
            $this->command("update user set updated_at = default where username = '$username'");
            return $this->command($qr);
        }
        catch(Exception){
            return false;
        }
    }
    public function GetInfo(){
        $qr = "SELECT fullname, user.username, email, address, birthday, created_at, role_id, deleted, avatar, COALESCE(A.datetime, '') AS datetime FROM user LEFT JOIN (SELECT username, MAX(datetime) datetime FROM web_usage GROUP BY username) AS A ON user.username = A.username WHERE role_id NOT IN ('0') ORDER BY created_at DESC";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function create($username, $password, $role_id, $fullname, $email, $address, $birthday){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $qr = "insert into user (username, password, role_id, created_at, fullname, email, address, birthday) values('$username', '$password', '$role_id', default, $fullname, $email, $address, $birthday)";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function edit($username, $role_id, $fullname, $email, $address, $birthday, $username_new){
        $qr = "update user set username = '$username_new', role_id = '$role_id', fullname = $fullname, email = $email, address = $address, birthday = $birthday where username = '$username'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    public function banunban($username, $ban){
        $qr ="update user set deleted = '$ban' where username = '$username'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception $e){
            return $e;
        }
    }
    public function reset($username){
        $password = password_hash("1", PASSWORD_BCRYPT);
        $qr ="update user set password = '$password' where username = '$username'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    public function delete($username){
        $qr ="delete from user where username = '$username'";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    public function deleteall(){
        $qr = "delete from user where username not in ('admin')";
        try{
            $this->command($qr);
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    public function UpdateAvatar($username, $path){
        $qr = "update user set avatar = '$path' where username = '$username'";
        try{
            $this->command($qr);
            $this->command("update user set updated_at = default where username = '$username'");
            return true;
        }
        catch(Exception){
            return false;
        }
    }
}
