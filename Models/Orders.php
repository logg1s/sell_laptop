<?php
class Orders extends DB
{
    public function getOrder($username)
    {
        $qr = "select p.title, p.id, p.thumbnail, o.num, o.total_money, o.order_date, o.status, o.finish_date, o.fullname, o.phone_number, o.address, o.note, o.payment_method from orders o, product p where o.username = '$username' and o.product_id = p.id order by o.order_date desc";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
   public function updateOrder($id, $username, $status, $datetime){
        $qr = "update orders set status ='$status' where product_id = '$id' and username ='$username' and order_date = '$datetime'";
        return $this->command($qr);
   }

   public function getOrderTime($id, $username, $datetime){
    $qr = "select p.title, p.id, p.thumbnail, o.num, o.total_money, o.order_date, o.status, o.fullname, o.phone_number, o.address, o.note from orders o, product p where o.username = '$username' and o.product_id = p.id and p.id = '$id' and o.order_date = '$datetime' order by o.order_date desc";
    return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
   }
   public function getPaymentId($payment_id){
    $qr = "select * from orders where payment_id = '$payment_id'";
    try{
        return $this->command($qr)->fetch_assoc();
    }
    catch(Exception){
        return false;
    }
   }
}