<?php
class Carts extends DB
{
	public function getCart($username){
		$qr = "select * from product, product_details, cart where cart.product_id = product.id and product.id = product_details.product_id and cart.username = '$username' order by cart_date desc";
		return $this->command($qr) ?? false;
	}
	public function getNumProduct($id){
		return $this->command("select num from product where id = '$id'")->fetch_assoc();
	}
	public function getMoney($id){
		return $this->command("select price_out from product where id = '$id'")->fetch_assoc();
	}
	public function updateCartNum($id, $num, $username){
		$prod_num = $this->getNumProduct($id);
		$money = $this->getMoney($id);

		if($num <= $prod_num["num"]){
			$qr = "update cart set cart_num = '$num' where product_id = '$id' and username = '$username'";

		//return money
			return $this->command($qr) ? $money['price_out'] * $num: false;
		}
		return false;
	}
	public function updateCartCheckbox($id, $checked, $username){
		$qr = "update cart set checked = '$checked' where username = '$username' and product_id = '$id'";
		return $this->command($qr)->fetch_assoc();
	}
	public function deleteCart($id, $username){
		$qr= "delete from cart where product_id ='$id' and username='$username'";
		return $this->command($qr) ?? false;
	}
	public function addCart($id, $num, $username){
		$data = $this->check($id, $username);
		$prod_num = $this->getNumProduct($id)["num"] ?? 0;
		$cart_num = $this->getcartnumid($id,$username)["cart_num"] ?? 0;
		if($num + $cart_num <= $prod_num){
		if(!$data->{"num_rows"}){
				$qr = "insert into cart value('$username', '$id', '$num', default, default)";
				return $this->command($qr) ?? false;
			}
			else{
				$qr = "update cart set cart_num = cart_num + '$num' where product_id = '$id' and username = '$username'";
			}
			return $this->command($qr) ?? false;
		}
		else return false;
	}
	public function check($id, $username){
		$qr = "select * from cart where product_id = '$id' and username = '$username'";
		return $this->command($qr) ?? false;
	}
	public function checkbox($id, $username){
		$qr = "select checked from cart where username = '$username' and product_id = '$id'";
		return $this->command($qr)->fetch_assoc();
	}
	public function getcartnum($username){
		$qr = "SELECT sum(cart_num) FROM cart where username = '$username'";
		return $this->command($qr)->fetch_assoc();
	}
	public function getcartnumid($id, $username){
		$qr = "SELECT cart_num FROM cart where username = '$username' and product_id = '$id'";
		return $this->command($qr)->fetch_assoc();
	}
}