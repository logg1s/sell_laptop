<?php
class About extends BaseController{
    public function __construct($param = ''){
        parent::__construct();
        if(method_exists($this, $param))
            $this->$param();
        else $this->View("Error");
    }
    public function Privacy(){
        $this->View("Privacy");
    }
    public function Introduction(){
        $this->View("Introduction");
    }
}   