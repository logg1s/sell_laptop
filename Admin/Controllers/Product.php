<?php
class Product extends BaseController{
    public function __construct(){
        parent::__construct();
        require_once "./Views/Shared/Master.php";
        $product = $this->Model("Products")->getAllProduct();
        $category = $this->Model("Products")->getAllCategory();
        $supplier = $this->Model("Products")->getAllSupplier();
        $this->View("Product", [
            "product" => $product,
            "category" => $category,
            "supplier" => $supplier
        ]);
    }

}