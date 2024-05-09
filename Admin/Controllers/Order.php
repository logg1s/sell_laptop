<?php

class Order extends BaseController{
    public function __construct($param = ""){
        parent::__construct();
        require_once "./Views/Shared/Master.php";
        $order = $this->Model("Orders")->getOrder();
        $this->View("Order", [
            "order" => $order
        ]);
    }
}