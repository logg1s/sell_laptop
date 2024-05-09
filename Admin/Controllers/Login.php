<?php
class Login extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
    
        if (!empty($_SESSION['admin'])) {
            header("location: ./");
        } else
            $this->Show();
    }
    public function Show()
    {

        $this->View("Login");
    }
}
