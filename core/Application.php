<?php
class Application
{
    protected $controller = "Home";
    protected $param = "";
    
    public function __construct()
    {
        $url = explode("/", $_GET["url"] ?? "Home");

        // $this->param = array_slice($url, 2);

        $controller_path = "./Controllers/$url[0].php";
        if (file_exists($controller_path))
            $this->controller = $url[0];
        else {
            $this->controller = new BaseController();
            $this->controller->View("Error");
            exit();
        }
        require_once "./Controllers/$this->controller.php";


        if (isset($url[1]))
                $this->param = $url[1];

        $this->controller = new $this->controller($this->param);

        // call_user_func_array([$this->controller, $this->action], $this->param);
    }
}
