<?php
class Login extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        if ($this->login__status) {
            header("location: ./");
        } else

            $this->View("Login");
    }
}
