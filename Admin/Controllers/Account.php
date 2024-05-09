<?php
class Account extends BaseController{
    public function __construct(){
        parent::__construct();
        require_once "./Views/Shared/Master.php";
      
        $user = $this->Model("Users")->GetInfo();
        $this->View("Account", [
            "user" => $user
        ]);
    }

}