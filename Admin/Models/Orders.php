<?php
class Orders extends DB
{
    public function getOrder($limit = "")
    {
        $qr = "select p.*, `order_id`, `product_id`, orders.price order_price, orders.num order_num, `total_money`, `order_date`, `status`, `finish_date`, `username`, `fullname`, `email`, `phone_number`, `address`, `note`, payment_method from orders, product p where orders.product_id = p.id order by orders.order_id desc $limit";
        return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
    }
    public function getOrderID($id){
        $qr = "select p.*, `order_id`, `product_id`, orders.price order_price, orders.num order_num, `total_money`, `order_date`, `status`, `finish_date`, `username`, `fullname`, `email`, `phone_number`, `address`, `note`, payment_method from orders, product p where orders.order_id = '$id' and orders.product_id = p.id order by orders.order_id desc";
        return $this->command($qr)->fetch_assoc();
    }
   public function updateOrder($id, $username, $status, $datetime){
        $qr = "update orders set status ='$status' where product_id = '$id' and username ='$username' and order_date = '$datetime'";
        return $this->command($qr);
   }

   public function getOrderTime($id, $username, $datetime){
    $qr = "select p.title, p.id, p.thumbnail, o.num, o.total_money, o.order_date, o.status, o.fullname, o.phone_number, o.address, o.note from orders o, product p where o.username = '$username' and o.product_id = p.id and p.id = '$id' and o.order_date = '$datetime' order by o.order_date desc";
    return $this->command($qr)->fetch_all(MYSQLI_ASSOC);
   }
   public function delete($id){
    $qr = "delete from orders where order_id = '$id'";
    try{
        return $this->command($qr);
    }
    catch(Exception){
        return false;
    }
   }
   public function verify($id){
    $qr = "update orders set status = '1' where order_id = '$id' and status ='0'";
    try{
        return $this->command($qr);
    }
    catch(Exception){
        return false;
    }
   }
   public function finish($id, $selled, $product_id){
    $qr = "update orders set status = '2', finish_date = default where order_id = '$id' and status = '1'";
    $this->command("update product set selled = selled + '$selled' where id = '$product_id'");
    try{
        return $this->command($qr);
    }
    catch(Exception $e){
        return false;
    }
   }
   public function cancel($id){
    $qr = "update orders set status = '100' where order_id = '$id' and status = '0'";
    try{
        $order = $this->command("select product_id, num from orders where order_id = '$id'")->fetch_array();
        $this->command("update product set num = num + $order[1] where id='$order[0]'");
        return $this->command($qr);
    }
    catch(Exception){
        return false;
    }
   }
   
   public function cant($id){
    $qr = "update orders set status = '200' where order_id = '$id' and status = '1'";
    try{
        $order = $this->command("select product_id, num from orders where order_id = '$id'")->fetch_array();
        $this->command("update product set num = num + $order[1] where id='$order[0]'");
        return $this->command($qr);
    }
    catch(Exception){
        return false;
    }
   }
   public function deleteall(){
    $qr = "delete from orders";
    try{
        return $this->command($qr);
    }
    catch(Exception){
        return false;
    }
   }
   
   public function statusall($status, $where){
    $finish = "";
    if($status == '2' && $where == '1')
        $finish = ", finish_date = default";
    $qr = "update orders set status = '$status' $finish where status = '$where'";
    try{
        return $this->command($qr);
    }
    catch(Exception){
        return false;
    }
   }
   
}