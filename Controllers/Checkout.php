<?php

class Checkout extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        $user = $this->Model("Users")->getUser($this->login__user);
        $payment_method = "Thanh toán khi nhận hàng";
        $payment_result = "";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $payment_id = time();
        if (!empty($_GET['orderType']) && !empty($_GET['orderId'])) {
            $payment_id = $_GET['orderId'];
            if ($this->Model("Orders")->getPaymentId($payment_id))
                $payment_result = 0;
            else {
                $method = ($_GET['payType'] == "napas") ? "thẻ ATM" : "mã QR";
                $payment_method =  "✅ Đã thanh toán bằng " . $method . " qua MoMo";
                $payment_result = ($_GET['resultCode'] == 0) ? 1 : 0;
            }
            $user = [
                'fullname' => $_GET['fullname'],
                'username' => $_GET['username'],
                'address' => $_GET['address'],
                'email' => $_GET['email'],
                'note' => $_GET['note']
            ];
        }
        if (isset($_REQUEST['buynow'])) {
            if (!empty($_REQUEST['id']) && !empty($_REQUEST['num'])) {
                $id = $_REQUEST['id'];
                $num = $_REQUEST['num'];
                $checkout = $this->Model("Products")->getProductDetailID($id);
                $check = $checkout->fetch_assoc();
                if (!empty($check) && $check['num'] >= $num) {
                    $total =  $check['price_out'] * $num;
                    $vnd = $this->VndText($total);

                    $this->View("Checkout", [
                        "checkout" => $checkout,
                        "user" => $user,
                        "number" => $num,
                        "total" => $total,
                        "vndtext" => $vnd,
                        "buyone" => true,
                        'payment_method' => $payment_method,
                        'payment_result' => $payment_result,
                        'payment_id' => $payment_id

                    ]);
                } else echo "Đừng thao tác như vậy :v";
            }
        } else if (isset($_REQUEST['btnOrder'])) {
            $checkout = $this->Model("Checkouts")->getItemOrder($this->login__user);
            if ($checkout->{"num_rows"}) {
                $total = 0;
                foreach ($checkout as $each)
                    $total += $each['total'];
                $vnd = $this->VndText($total);
                $this->View("Checkout", [
                    "checkout" => $checkout,
                    "user" => $user,
                    "total" =>  $total,
                    "vndtext" => $vnd,
                    "buyone" => false,
                    'payment_method' => $payment_method,
                    'payment_result' => $payment_result,
                    'payment_id' => $payment_id
                ]);
            } else echo "Thao tác không đúng";
        } else {
            $this->View("Error");
        }
    }
}
