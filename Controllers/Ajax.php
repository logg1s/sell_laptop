<?php
class Ajax extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        if (method_exists($this, $param))
            $this->$param();
        else
            echo "false";
    }
    public function AddToCart()
    {
        if (isset($_POST['id']) && isset($_POST['num'])) {
            $id = $_POST['id'];
            $num = $_POST['num'];
            if ($this->Model("Carts")->addCart($id, $num, $this->login__user))
                echo true;
            else echo false;
        } else echo false;
    }

    public function CartUpdate()
    {

        if (isset($_POST['id']) && isset($_POST['num'])) {
            $id = $_POST['id'];
            $num = $_POST['num'];
            $money = $this->Model("Carts")->updateCartNum($id, $num, $this->login__user);
            echo $this->MoneyHandle($money);
        } else echo "false";
    }
    public function CartDelete()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if ($this->Model("Carts")->deleteCart($id, $this->login__user))
                echo 'true';
        } else echo 'false';
    }
    public function GetCartNum()
    {
        $num = $this->Model("Carts")->getcartnum($this->login__user);
        echo $num["sum(cart_num)"] ?? 0;
    }
    public function GetChecked()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $checked = $this->Model("Carts")->checkbox($id, $this->login__user);
            if ($checked)
                echo $checked["checked"] ?? 0;
        } else echo 'false';
    }
    public function CheckboxUpdate()
    {
        if (isset($_POST['id']) && isset($_POST['checked'])) {
            $id = $_POST['id'];
            $checked = $_POST['checked'];
            if ($this->Model("Carts")->updateCartCheckbox($id, $checked, $this->login__user))
                echo 'true';
        } else echo 'false';
    }


    public function CheckUsername()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            if ($this->Model("Users")->getUser($username)) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function CheckEmail()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            if ($this->Model("Users")->getEmail($email)) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function CheckAccount()
    {
        if (!empty($_POST['account'])) {
            $account = $_POST['account'];
            if ($this->Model("Users")->Login($account)) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function Register()
    {
        if (
            isset($_POST['btnRegister']) &&
            isset($_POST['fullname']) &&
            isset($_POST['password']) &&
            isset($_POST['username']) &&
            isset($_POST['email'])
        ) {
            $fullname = $_POST['fullname'];
            $password = $_POST['password'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $url = str_replace("/index.php", "", "http://$_SERVER[SERVER_NAME]$_SERVER[PHP_SELF]");
            $accesskey = "V-" . time() . "-" . uniqid();
            $subject = "Xác nhận đăng kí tài khoản";
            $content = "<h1>Kích hoạt tài khoản của bạn</h1>
            <p>Xin chào, $fullname</p>
            <p>Chúng tôi rất vui mừng nhận được thông tin đăng kí tài khoản của bạn. Chúng tôi đã nhận được yêu cầu đăng kí của bạn và đã tiến hành xác nhận thông tin đăng kí của bạn.</p>

            <p>Để hoàn tất quá trình đăng kí, bạn cần xác nhận bằng cách nhấn vào mục dưới đây:</p>
            <p><b><a href='$url/Account?accesskey=$accesskey'>Xác thực đăng kí ngay</a></b></p>
            <p>Sau khi xác nhận đăng kí, bạn sẽ có thể truy cập vào tài khoản của mình và sử dụng các dịch vụ của chúng tôi.</p>
            <p>Khi có bất kì vấn đề nào cần hỗ trợ, truy cập <a href='$url'>Trang web của chúng tôi tại đây</a> để được hỗ trợ nhanh nhất.</p>
            <p>Trân trọng.</p>";
            if ($this->Model("Users")->Register($username, $fullname, $email, $password, $accesskey)) {
                echo $this->sendmail($email, $subject, $content);
                exit();
            }
        }
        echo false;
    }
    
    public function Login()
    {
        if (
            isset($_POST['btnLogin']) &&
            isset($_POST['username']) &&
            isset($_POST['password'])
        ) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = $this->Model("Users")->Login($username);
            $verify =  password_verify($password, $data['password'] ?? "");
            if ($verify) {
                if ($data['deleted'] == "0") {
          
                    // setcookie("login__status", true, time() + 180 * 86400, '/', '', false, true);
                    // setcookie("login__user", $data['username'], time() + 180 * 86400, '/', '', false, true);
                    // setcookie("login__pw", $data['password'], time() + 180 * 86400, '/', '', false, true);
                    $_SESSION['login__status'] = true;
                    $_SESSION['login__user'] = $data['username'];
                    $_SESSION['login__pw'] = $password;
                }
                echo $data['deleted'];
                exit();
            }
        }
        echo "";
    }
    public function LoginStatus()
    {
        // if ($this->login__status) {
            $data = $this->Model("Users")->getUser($this->login__user);
            if ($data) {
                echo json_encode($data) ?? false;
                exit();
            // }
        }
        echo json_encode(false);
    }
    public function Logout()
    {
        // setcookie("login__status", false, 0, '/', '', false, true);
        // setcookie("login__user", "", 0, '/', '', false, true);
        unset($_SESSION['login__status']);
        unset($_SESSION['login__user']);
        unset($_SESSION['login__pw']);
        session_destroy();
    }

    public function UpdateUser()
    {
        if (
            isset($_POST['btnsaveInfo']) &&
            isset($_POST['fullname']) &&
            isset($_POST['username']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday']) &&
            isset($_POST['address'])
        ) {
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $address1 = $_POST['address'];
            $address = htmlspecialchars($address1, ENT_QUOTES, 'UTF-8');

            $birthday = empty($_POST['birthday']) ? "NULL" : "'$_POST[birthday]'";
            if ($this->Model("Users")->UpdateInfo($this->login__user, $username, $fullname, $email, $address, $birthday)) {
                // setcookie("login__user", $username, time() + 180 * 86400, '/', '', false, true);
                $_SESSION['login__user'] = $username;
                $this->login__user = $username;
                echo true;
                exit();
            }
        } else if (isset($_FILES['avatar'])) {
            $avatar = $_FILES['avatar']['name'];
            $format = pathinfo($avatar, PATHINFO_EXTENSION);
            $path = "./Views/Shared/img/Users/$this->login__user.$format";
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
                $this->Model("Users")->command("update user set avatar = '$path' where username='$this->login__user'");
                echo true;
                exit();
            }
        }
        echo false;
    }

    public function CancelOrder()
    {
        if (
            isset($_POST['status']) &&
            isset($_POST['id']) &&
            isset($_POST['datetime'])
        ) {
            $status = $_POST['status'];
            $id = $_POST['id'];
            $datetime = $_POST['datetime'];
            $num = $this->Model("Orders")->getOrderTime($id, $this->login__user, $datetime)[0]['num'];
            if ($status == 0) {
                if ($this->Model("Orders")->updateOrder($id, $this->login__user, -1, $datetime) && $this->Model("Products")->UpdateNum($id, "num + $num")) {
                    echo true;
                    exit();
                }
            }
        }
        echo false;
    }
    public function CheckPassword()
    {
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            $data = $this->Model("Users")->Login($this->login__user);
            echo $verify =  password_verify($password, $data['password'] ?? "");
            exit();
        }
        echo false;
    }
    public function UpdatePassword()
    {
        if (
            isset($_POST['btnsaveInfo']) &&
            isset($_POST['password'])
        ) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            if ($this->Model("Users")->UpdatePassword($this->login__user, $password)) {
                $_SESSION['login__pw'] = $_POST['password'];
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function RecoverPassword()
    {
        if (
            !empty($_POST['username']) && !empty($_POST['password'])
        ) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            if ($this->Model("Users")->UpdatePassword($username, $password)) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function Search()
    {
        if (isset($_POST['search'])) {
            $search =  $_POST['search'];
            $result = $this->Model("Products")->SearchProduct($search);

            if ($result) {
                for ($i = 0; $i < count($result); $i++) {
                    $old = $result[$i]['price_out'];
                    $result[$i]['price_out'] = $this->MoneyHandle($result[$i]['price_out']);

                    if ($old < $result[$i]['price'])
                        $result[$i]['price'] = $this->MoneyHandle($result[$i]['price']) . "đ";
                    else $result[$i]['price'] = "";

                    $result[$i]['link'] = $this->TitleHandle($result[$i]['title'], 0);
                }
                echo json_encode($result) ?? false;
                exit();
            }
        }
        echo json_encode(false);
    }
    public function MoneyResult()
    {
        if (isset($_POST['money']) && isset($_POST['sale'])) {
            $money = $this->MoneyHandle($_POST['money'] ?? 0);
            $sale = $this->MoneyHandle($_POST['sale'] ?? 0);
            echo json_encode(["money" => $money, "sale" => $sale]);
            exit();
        }
        echo json_encode(false);
    }
    public function GetProductLaptop()
    {
        $manufacturer = "";
        if (!empty($_POST['manufacturer']))
            $manufacturer = "and manufacturer in ('" . implode("','", $_POST['manufacturer']) . "')";


        $price = "";
        if (!empty($_POST['price']))
            $price = "and (" . implode(' or ', $_POST['price']) . ")";


        $screen = "";
        if (!empty($_POST['screen']))
            $screen = "and (" . implode(' or ', $_POST['screen']) . ")";



        $cpu = "";
        if (!empty($_POST['cpu']))
            $cpu = "and (" . implode(' or ', $_POST['cpu']) . ")";

        $ram = "";
        if (!empty($_POST['ram']))
            $ram = "and ram in ('" . implode("','", $_POST['ram']) . "')";


        $gpu = "";
        if (!empty($_POST['gpu']))
            $gpu = "and (" . implode(' or ', $_POST['gpu']) . ")";


        $storage = "";
        if (!empty($_POST['storage']))
            $storage = "and storage in ('" . implode("','", $_POST['storage']) . "')";

        $sort = "";
        if (!empty($_POST['sort']))
            $sort = $_POST['sort'];


        $data = $this->Model("Products")->GetProductLaptop(
            $manufacturer,
            $price,
            $screen,
            $cpu,
            $ram,
            $gpu,
            $storage,
            $sort
        );
        // $check = [$manufacturer,
        // $price,
        // $screen,
        // $cpu,
        // $ram,
        // $gpu,
        // $storage,
        // $option,
        // $order];
        // echo json_encode($check);
        if ($data) {

            for ($i = 0; $i < count($data); $i++) {
                $old = $data[$i]['price_out'];
                $data[$i]['price_out'] = $this->MoneyHandle($data[$i]['price_out']);

                if ($old < $data[$i]['price']) {

                    $data[$i]['price'] = $this->MoneyHandle($data[$i]['price']) . "đ";
                } else $data[$i]['price'] = "";
                $data[$i]['link'] = $this->TitleHandle($data[$i]['title'], 0);
            }
            echo json_encode($data) ?? false;
            exit();
        }
        echo json_encode(false);
    }
    public function UpdateOrder()
    {
        if (
            !empty($_POST['name']) &&
            !empty($_POST['phone']) &&
            !empty($_POST['address']) &&
            !empty($_POST['id_num']) &&
            isset($_POST['orderclick'])
            && !empty($_POST['payment_method'])
        ) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address1 = $_POST['address'];
            $address = htmlspecialchars($address1, ENT_QUOTES, 'UTF-8');
            $email = $_POST['email'] ?? "";
            $note1 = $_POST['note'] ?? "";
            $note = htmlspecialchars($note1, ENT_QUOTES, 'UTF-8');
            $id_num = $_POST['id_num'];
            $buyone = $_POST['orderclick'];
            $payment_method = $_POST['payment_method'];
            $payment_id = $_POST['payment_id'];

            $pr = 0;

            foreach ($id_num as $id => $num) {
                $price = $this->Model("Products")->getProductDetailID($id)->fetch_assoc()['price_out'];
                $pr += $price * $num;
                $order = $this->Model("Checkouts")->buy($id, $price, $num, $price * $num, $this->login__user, $name, $email, $phone, $address, $note,  $payment_id, $payment_method);
                if (!$buyone)
                    $this->Model("Carts")->deleteCart($id, $this->login__user);
                $product = $this->Model("Products")->UpdateNum($id, "num - $num");
                if (!$order || !$product) {
                    echo false;
                    return;
                }
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $url = $_SERVER["SERVER_NAME"];
            // $urlOrder = BaseController::Client() . "User/Order";
            $dateVerify = date("Y-m-d H:i:s", time());
            $subject = "Đơn hàng mới đang chờ xử lí";
            $content = "
                <h2>ĐƠN HÀNG MỚI ĐANG CHỜ XỬ LÍ</h2>
                <br>
                <p>Thông tin đơn hàng:</p>
                <p><b>Họ tên: $name</b></p>
                <p><b>Địa chỉ: $address</b></p>
                <p><b>SĐT: $phone</b></p>
                <p><b>Email: $email</b></p>
                <p><b>Ghi chú: $note</b></p>
                <p><b>Thời gian đặt hàng: $dateVerify</b></p>
                <p><b>Phương thức thanh toán: $payment_method</b></p>
                <p><b>Tổng giá trị đơn hàng: <span style='color: red'>" . $this->MoneyHandle($pr) . " VNĐ</span></b></p>
                <br><br>
                <p>Để xử lí đơn hàng này, vui lòng truy cập vào trang quản trị tại địa chỉ: <a href='$url/Admin/Order'>https://$url/Admin/Order</a></p>
            ";
            $to = 'lrng159@gmail.com';
            echo $this->sendmail($to, $subject, $content);
            exit();
        }
        echo false;
    }
    public function ForgotPassword()
    {
        if (isset($_POST['btnForgotPassword']) && !empty($_POST['account'])) {
            $data = $this->Model("Users")->Login($_POST['account']);
            $email = $data['email'];
            $url = str_replace("/index.php", "", "http://$_SERVER[SERVER_NAME]$_SERVER[PHP_SELF]");
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $accesskey = "R-" . time() . "-" . uniqid();
            $subject = "Khôi phục mật khẩu của bạn";
            $content = "<h1>Khôi phục mật khẩu của bạn</h1>
            <p>Xin chào, $data[fullname]</p>
            <p>Nếu bạn muốn khôi phục mật khẩu của mình, vui lòng bấm vào liên kết dưới đây (liên kết này có thời hạn 10 phút tính từ thời điểm bạn nhận được thư):</p>
            <p><b><a href='$url/Account?accesskey=$accesskey'>Khôi phục mật khẩu</a></b></p>
            <p>Nếu bạn không yêu cầu khôi phục mật khẩu, hãy bỏ qua email này.</p>
            <p>Khi có bất kì vấn đề nào cần hỗ trợ, truy cập <a href='$url'>Trang web của chúng tôi tại đây</a> để được hỗ trợ nhanh nhất.</p>
            <p>Trân trọng.</p>";
            if ($this->Model("Users")->ForgotPassword($email, $accesskey)) {
                echo $this->sendmail($email, $subject, $content);
                exit();
            }
        }
        echo false;
    }
}
