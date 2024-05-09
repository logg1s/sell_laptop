<?php
class User extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        if($this->login__status){
            $data = $this->Model("Users")->getUser($this->login__user);
            $data["order"] = $this->Model("Orders")->getOrder($this->login__user);
            if($param == "Order")
            $this->View("Order", $data);
            else
            $this->View("User", $data);
        }
        else{
            header("location: http://" . str_replace("/index.php", "", $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']));
            exit();
        }
    }
}