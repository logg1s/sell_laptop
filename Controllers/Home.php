<?php
class Home extends BaseController{
    public function __construct($param = ""){
        parent::__construct();
        $this->Show();
    }
    public function Show(){
        $this->View("Home",
        [
            "Laptop" => $this->Model("Products")->getProduct(1),
            "Linhkien" => $this->Model("Products")->getProduct(2),
            "avatar" => $this->Model("Users")->getUser($this->login__user)["avatar"] ?? "",
            "fullname" => $this->Model("Users")->getUser($this->login__user)["fullname"] ?? "",
            "hot" => $this->Model("Products")->getHot()
    ]);
    }
}