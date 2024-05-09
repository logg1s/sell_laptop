<?php
class Laptop extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        $this->View("Laptop", [
                "Product" => $this->Model("Products")->getProduct(1),
                "Manufacturer" => $this->Model("Products")->GetManufacturerLaptop(),
                "GetCheck" => $param
            ]);
    }
}