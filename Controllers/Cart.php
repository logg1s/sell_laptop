<?php
class Cart extends BaseController{
    public function __construct($param = ""){
    	parent::__construct();
        if(empty($this->login__user)){
        	$this->View("Error");
        	exit();
        }
        $cart = $this->Model("Carts")->getCart($this->login__user);
        $this->View("Cart", $cart
        );
    }
}