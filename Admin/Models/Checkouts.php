<?php
class Checkouts extends DB
{
    public function getItemOrder($username)
    {
        //product.id, product.title, product.price_out, product.thumbnail, cart.cart_num,
        $qr = "select *, price_out*cart_num total from product, cart, product_details where cart.product_id = product.id and product.id = product_details.product_id and cart.username = '$username' and checked = '1' order by cart_date desc";
        return $this->command($qr);
    }
    public function buy($id, $price, $num, $total_money, $username, $name, $email, $phone, $address, $note){
        $qr = "INSERT INTO `orders`(`order_id`, `product_id`, `price`, `num`, `total_money`, `order_date`, `status`, `username`, `fullname`, `email`, `phone_number`, `address`, `note`) VALUES (null,'$id','$price','$num','$total_money',default,default,'$username','$name','$email','$phone','$address','$note')";
        return $this->command($qr);
    }
}
