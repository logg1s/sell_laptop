<?php
class EditAccount extends BaseController{
    public function __construct(){
        parent::__construct();
        require_once "./Views/Shared/Master.php";
      
        $this->View("EditAccount");
    }
}