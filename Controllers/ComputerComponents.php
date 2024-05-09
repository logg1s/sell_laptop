<?php
class ComputerComponents extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        $this->View("Laptop", [
                "Product" => $this->Model("Products")->getProduct(1),
                "Manufacturer" => $this->Model("Products")->GetManufacturer()
            ]);
    }
}