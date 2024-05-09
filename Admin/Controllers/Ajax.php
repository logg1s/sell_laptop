<?php
class Ajax extends BaseController
{
    public function __construct($param = "")
    {
        // echo $_SESSION['password'] ?? "haha";
        if (method_exists($this, $param) && !empty($_SESSION['admin'])) {
            $data = $this->Model("Users")->Login($_SESSION['admin']);
            $verify =  password_verify($_SESSION['password'] ?? "", $data['password'] ?? "");
            if ($verify) {
                $this->$param();
                exit();
            }
        }
        $this->Login();
    }

    public function Login()
    {
        if (
            !empty($_POST['username']) &&
            !empty($_POST['password'])
        ) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = $this->Model("Users")->Login($username);
            $verify =  password_verify($password ?? "", $data['password'] ?? "");
            if ($verify) {
                $_SESSION['admin'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['avatar'] = $data['avatar'];
                $_SESSION['fullname'] = $data['fullname'];
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function Logout()
    {
        if (isset($_POST['logout'])) {
            unset($_SESSION['admin']);
            unset($_SESSION['password']);
            unset($_SESSION['avatar']);
            unset($_SESSION['fullname']);
            session_destroy();
            echo true;
            exit();
        }
        // echo "d";
    }
    public function DeleteOrder()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            if ($this->Model("Orders")->delete($id)) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function VerifyOrder()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            $info = $this->Model("Orders")->getOrderID($id);
            $email = $info["email"];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $url = BaseController::Client();
            $urlOrder = BaseController::Client() . "User/Order";

            $dateVerify = date("Y-m-d H:i:s", time());
            $subject = "Đơn hàng của bạn đã được xác nhận vào lúc $dateVerify";
            $content = "
            <p>Xin chào, $info[fullname]</p>
            <p>Chúng tôi muốn thông báo với bạn rằng đơn hàng của bạn đã được xác nhận.</p>
            <br>
            <p>Thông tin giao hàng của bạn:</p>
            <h3>$info[title]</h3>
            <p><b>Mã đơn hàng: $info[order_id]</b></p>
            <p><b>Thời gian đặt hàng: $info[order_date]</b></p>
            <p><b>Thời gian xác nhận: $dateVerify</b></p>
            <p><b>Số lượng hàng hóa: $info[order_num]</b></p>
            <p><b>Tổng giá trị đơn hàng của bạn: <span style='color: red'>" . $this->MoneyHandle($info["total_money"]) . " VNĐ </span></b></p>
            <p><b>Phương thức thanh toán: $info[payment_method]</b></p>
            <p><b>Địa chỉ nhận hàng: $info[address]</b></p>
            <p><b>Số điện thoại: $info[phone_number]</b></p>
            <br>
            <p>Bạn có thể kiểm tra đơn hàng nếu có tài khoản đăng nhập tại địa chỉ <a href='$urlOrder'>$urlOrder</a></p>
            <p>Vui lòng kiểm tra lại thông tin và liên hệ với chúng tôi nếu có sai sót. Website của chúng tôi <a href='$url'>$url</a></p>

            <p>Cảm ơn bạn đã tin tưởng lựa chọn sản phẩm của chúng tôi !</p>
            <p>Trân trọng.</p>";
            if ($this->Model("Orders")->verify($id)) {
                echo $this->sendmail($email, $subject, $content);
                exit();
            }
        }
        echo false;
    }
    public function FinishOrder()
    {
        if (
            !empty($_POST['id']) && isset($_POST['selled']) && isset($_POST['product_id'])
        ) {
            $id = $_POST['id'];
            $info = $this->Model("Orders")->getOrderID($id);
            $email = $info["email"];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $url = BaseController::Client();
            $dateVerify = date("Y-m-d H:i:s", time());
            $subject = "Đơn hàng được giao thành công";
            $content = "
            <p>Xin chào, $info[fullname]</p>
            <p>Đơn hàng <b>$info[title]</b> đã được giao thành công vào lúc $dateVerify</p>
            <br>
            <p>Thông tin giao hàng của bạn:</p>
            <h3>$info[title]</h3>
            <p><b>Mã đơn hàng: $info[order_id]</b></p>
            <p><b>Thời gian đặt hàng: $info[order_date]</b></p>
            <p><b>Thời gian hoàn thành: $dateVerify</b></p>
            <p><b>Số lượng hàng hóa: $info[order_num]</b></p>
            <p><b>Tổng giá trị đơn hàng của bạn: <span style='color: red'>" . $this->MoneyHandle($info["total_money"]) . " VNĐ </span></b></p>
            <p><b>Phương thức thanh toán: $info[payment_method]</b></p>
            <p><b>Địa chỉ nhận hàng: $info[address]</b></p>
            <p><b>Số điện thoại: $info[phone_number]</b></p>
            <br>
            <p>Cảm ơn bạn đã tin tưởng lựa chọn sản phẩm của chúng tôi !</p>
            <p>Khi có bất kì vấn đề nào, hãy truy cập <a href='$url'>Trang Web của chúng tôi</a> để được hỗ trợ nhanh nhất.</p>
            <p>Trân trọng.</p>";

            $selled = $_POST['selled'];
            $product_id = $_POST['product_id'];
            if ($this->Model("Orders")->finish($id, $selled, $product_id)) {
                echo $this->sendmail($email, $subject, $content);
                exit();
            }
        }
        echo false;
    }
    public function CancelOrder()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            $info = $this->Model("Orders")->getOrderID($id);
            $email = $info["email"];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $url = BaseController::Client();
            $dateVerify = date("Y-m-d H:i:s", time());
            $subject = "Đơn hàng đã được hủy";
            $content = "
            <p>Xin chào, $info[fullname]</p>
            <p>Chúng tôi rất lấy làm tiếc phải thông báo cho bạn rằng:<br>Đơn hàng <b>$info[title]</b> không thể được xác nhận.<br>Đây là sự cố tạm thời và chúng tôi có thể sẽ khắc phục sớm.<br>Rất mong bạn thông cảm cho sự cố lần này.</p>
            <br>
            <p>Thông tin giao hàng của bạn:</p>
            <h3>$info[title]</h3>
            <p><b>Mã đơn hàng: $info[order_id]</b></p>
            <p><b>Thời gian đặt hàng: $info[order_date]</b></p>
            <p><b>Thời gian hủy: $dateVerify</b></p>
            <p><b>Số lượng hàng hóa: $info[order_num]</b></p>
            <p><b>Tổng giá trị đơn hàng của bạn: <span style='color: red'>" . $this->MoneyHandle($info["total_money"]) . " VNĐ </span></b></p>
            <p><b>Phương thức thanh toán: $info[payment_method]</b></p>
            <p><b>Địa chỉ nhận hàng: $info[address]</b></p>
            <p><b>Số điện thoại: $info[phone_number]</b></p>
            <br>
            <p>Khi có bất kì vấn đề nào, hãy truy cập <a href='$url'>Trang Web của chúng tôi</a> để được hỗ trợ nhanh nhất.</p>
            <p>Trân trọng.</p>";
            if ($this->Model("Orders")->cancel($id)) {
                echo $this->sendmail($email, $subject, $content);
                exit();
            }
        }
        echo false;
    }
    public function CantOrder()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];

            $info = $this->Model("Orders")->getOrderID($id);
            $email = $info["email"];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $url = BaseController::Client();
            $dateVerify = date("Y-m-d H:i:s", time());
            $subject = "Đơn hàng đã được hủy";
            $content = "
            <p>Xin chào, $info[fullname]</p>
            <p>Chúng tôi rất lấy làm tiếc phải thông báo cho bạn rằng:<br>Đơn hàng <b>$info[title]</b> không thể được giao do sự cố vận chuyển.<br>Rất mong bạn thông cảm vì sự cố bất khả kháng này.</p>
            <br>
            <p>Thông tin giao hàng của bạn:</p>
            <h3>$info[title]</h3>
            <p><b>Mã đơn hàng: $info[order_id]</b></p>
              <p><b>Thời gian đặt hàng: $info[order_date]</b></p>
              <p><b>Thời gian hủy: $dateVerify</b></p>
            <p><b>Số lượng hàng hóa: $info[order_num]</b></p>
            <p><b>Tổng giá trị đơn hàng của bạn: <span style='color: red'>" . $this->MoneyHandle($info["total_money"]) . " VNĐ </span></b></p>
            <p><b>Phương thức thanh toán: $info[payment_method]</b></p>
            <p><b>Địa chỉ nhận hàng: $info[address]</b></p>
            <p><b>Số điện thoại: $info[phone_number]</b></p>
            <br>
            <p>Khi có bất kì vấn đề nào, hãy truy cập <a href='$url'>Trang Web của chúng tôi</a> để được hỗ trợ nhanh nhất.</p>
            <p>Trân trọng.</p>";
            if ($this->Model("Orders")->cant($id)) {
                echo $this->sendmail($email, $subject, $content);
                exit();
            }
        }
        echo false;
    }
    public function DeleteAllOrder()
    {

        if ($this->Model("Orders")->deleteall()) {
            echo true;
            exit();
        }
        echo false;
    }
    public function DeleteProduct()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            if ($this->Model("Products")->delete($id)) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function DeleteProductAll()
    {
        if ($this->Model("Products")->deleteall()) {
            echo true;
            exit();
        }
        echo false;
    }
    public function LoadInfoProduct()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            $data = $this->Model("Products")->getAllProduct("and id='$id'");
            if ($data) {

                echo json_encode($data[0]);
                exit();
            }
        }
        echo json_encode(false);
    }
    public function LoadInfoUser()
    {
        if (
            !empty($_POST['username'])
        ) {
            $username = $_POST['username'];
            try {
                echo json_encode($this->Model("Users")->getUser($username));
            } catch (Exception) {
                echo json_encode(false);
            }
        } else echo json_encode(false);
    }
    public function UpdateProduct()
    {

        if (
            !empty($_POST['danhmuc']) &&
            !empty($_POST['tensanpham'])
            && !empty($_POST['gianhap']) && !empty($_POST['giagoc']) && !empty($_POST['giaban'])
            && !empty($_POST['soluong'])
        ) {
            $id = $_POST['id'];
            $danhmuc = $_POST['danhmuc'];
            $tensanpham = $_POST['tensanpham'];
            $gianhap = $_POST['gianhap'];
            $giagoc = $_POST['giagoc'];
            $giaban = $_POST['giaban'];
            $soluong = $_POST['soluong'];
            $hinhanh =  $_POST['linkanh'];;
            $mota = $_POST['mota'];
            $nhacungcap = !empty($_POST['nhacungcap']) ? "'$_POST[nhacungcap]'" : "NULL";
            $nhasanxuat = $_POST['nhasanxuat'];
            $manhinh = !empty($_POST['manhinh']) ? "'$_POST[manhinh]'" : "NULL";
            $cpu = $_POST['cpu'];
            $ram = !empty($_POST['ram']) ? $_POST['ram'] : "NULL";
            $gpu = $_POST['gpu'];
            $storage = !empty($_POST['storage']) ? "'$_POST[storage]'" : "NULL";
            $weight = !empty($_POST['weight']) ? "'$_POST[weight]'" : "NULL";
            $os = $_POST['os'];
            $promotion = $_POST['promotion'];
            $type = $_POST['type'];

            if (!empty($_FILES['hinhanh'])) {
                $hinh = $_FILES['hinhanh'];
                $format = pathinfo($hinh['name'], PATHINFO_EXTENSION);
                $target_dir = BaseController::AbsolutePath() . "Views/Shared/img/Products/$tensanpham";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                if (file_exists($target_dir)) {
                    $uniqid = uniqid() . ".$format";
                $path = $target_dir . "/" . $uniqid;
                if (move_uploaded_file($hinh['tmp_name'], $path)) {
                    $hinhanh = "./Views/Shared/img/Products/$tensanpham/$uniqid";
                }
                } else {
                    echo false;

                   return;
                }
                
            }

            try {
                if ($_POST['action']) {
                    $this->Model("Products")->insertProduct(
                        $danhmuc,
                        $tensanpham,
                        $gianhap,
                        $giagoc,
                        $giaban,
                        $soluong,
                        $hinhanh,
                        $mota,
                        $nhacungcap
                    );
                    if ($this->Model("Products")->insertProductDetail(
                        $nhasanxuat,
                        $manhinh,
                        $cpu,
                        $ram,
                        $gpu,
                        $storage,
                        $weight,
                        $os,
                        $promotion,
                        $type
                    )) {
                        echo true;
                        exit();
                    }
                } else {

                    if ($this->Model("Products")->updateProduct(
                        $id,
                        $danhmuc,
                        $tensanpham,
                        $gianhap,
                        $giagoc,
                        $giaban,
                        $soluong,
                        $hinhanh,
                        $mota,
                        $nhacungcap
                    )) {
                        if ($this->Model("Products")->updateProductDetail(
                            $id,
                            $nhasanxuat,
                            $manhinh,
                            $cpu,
                            $ram,
                            $gpu,
                            $storage,
                            $weight,
                            $os,
                            $promotion,
                            $type
                        )) {
                            echo true;
                            exit();
                        }
                    }
                }
            } catch (Exception $e) {
                echo $e;
                exit();
            }
            echo false;
        }
    }
    public function HideProduct()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            if ($this->Model("Products")->hideshow($id, '1')) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function ShowProduct()
    {
        if (
            !empty($_POST['id'])
        ) {
            $id = $_POST['id'];
            if ($this->Model("Products")->hideshow($id, '0')) {
                echo true;
                exit();
            }
        }
        echo false;
    }
    public function CreateUser()
    {
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['role_id'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];
            $fullname = empty($_POST['fullname']) ? "NULL" : "'$_POST[fullname]'";
            $email = empty($_POST['email']) ? "NULL" : "'$_POST[email]'";
            $address = empty($_POST['address']) ? "NULL" : "'$_POST[address]'";
            $birthday = empty($_POST['birthday']) ? "NULL" : "'$_POST[birthday]'";
            try {
                echo $this->Model("Users")->create($username, $password, $role_id, $fullname, $email, $address, $birthday);
            } catch (Exception) {
                echo false;
            }
        }
    }
    public function EditUser()
    {
        if (!empty($_POST['username']) && !empty($_POST['role_id']) && !empty($_POST['username_new'])) {
            $username = $_POST['username'];
            $role_id = $_POST['role_id'];
            $username_new = $_POST['username_new'];
            $fullname = empty($_POST['fullname']) ? "NULL" : "'$_POST[fullname]'";
            $email = empty($_POST['email']) ? "NULL" : "'$_POST[email]'";
            $address = empty($_POST['address']) ? "NULL" : "'$_POST[address]'";
            $birthday = empty($_POST['birthday']) ? "NULL" : "'$_POST[birthday]'";
            try {
                echo $this->Model("Users")->edit($username, $role_id, $fullname, $email, $address, $birthday, $username_new);
            } catch (Exception) {
                echo false;
            }
        }
    }
    public function BanUnban()
    {
        if (!empty($_POST['username']) && isset($_POST['ban'])) {
            $username = $_POST['username'];
            $ban = $_POST['ban'];
            try {
                echo $this->Model("Users")->banunban($username, $ban);
            } catch (Exception) {
                echo false;
            }
        } else echo false;
    }
    public function ResetPassword()
    {
        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
            try {
                echo $this->Model("Users")->reset($username);
            } catch (Exception) {
                echo false;
            }
        } else echo false;
    }
    public function DeleteUser()
    {
        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
            try {
                echo $this->Model("Users")->delete($username);
            } catch (Exception) {
                echo false;
            }
        } else echo false;
    }
    public function DeleteAllUser()
    {
        try {
            echo $this->Model("Users")->deleteall();
        } catch (Exception) {
            echo false;
        }
    }
    public function AcceptAllOrder()
    {
        try {
            echo $this->Model("Orders")->statusall(1, 0);
        } catch (Exception) {
            echo false;
        }
    }
    public function CancelAllOrder()
    {
        try {
            echo $this->Model("Orders")->statusall(100, 0);
        } catch (Exception) {
            echo false;
        }
    }
    public function SuccessAllOrder()
    {
        try {
            echo $this->Model("Orders")->statusall(2, 1);
        } catch (Exception) {
            echo false;
        }
    }
    public function CountViewMonth()
    {
        try {
            $data = $this->Model("Stats")->LuotTruyCapTungThang();
            $thang = array();
            $soluong = array();
            $ngay = array();
            $max = array();
            foreach ($data as $row) {
                array_push($thang, $row['Thang']);
                array_push($soluong, $row['SoLuong']);
                array_push($ngay, $row['Ngay']);
                array_push($max, $row['maxView']);
            }
            // var_dump($thang);
            echo json_encode(["thang" => $thang, "soluong" => $soluong, "ngay" => $ngay, "max" => $max]);
        } catch (Exception) {
            echo json_encode(false);
        }
    }
    public function MoneyMonth()
    {
        try {
            $data = $this->Model("Stats")->ThuNhapHangThang();
            $thang = array();
            foreach ($data as $row) {
                array_push($thang, $row['Thang']);
            }
            $thunhap = array();
            foreach ($data as $row) {
                array_push($thunhap, $row['TongThuNhap']);
            }
            // var_dump($thang);
            echo json_encode(["thang" => $thang, "tongthunhap" => $thunhap]);
        } catch (Exception) {
            echo json_encode(false);
        }
    }
    public function UpdatePassword()
    {
        if (!empty($_POST['oldpass']) && !empty($_POST['newpass1']) && !empty($_POST['newpass2'])) {
            $oldpass = $_POST['oldpass'];
            $newpass1 = $_POST['newpass1'];
            $newpass2 = $_POST['newpass2'];
            $acc = $this->Model("Users")->getUserToChangePassword($_SESSION['admin']);
            // die($oldpass . $newpass1 . $newpass2);
            try {
                if (password_verify($oldpass, $acc['password'])) {
                    $newpass1 = password_hash($newpass1, PASSWORD_BCRYPT);
                    $this->Model("Users")->UpdatePassword($_SESSION['admin'], $newpass1);
                    echo true;
                    exit();
                } else echo "saimk";
            } catch (Exception) {
                echo false;
            }
        } else echo false;
    }

    public function UpdateAvatar()
    {
        if (!empty($_FILES['avatarimg'])) {
            try {
                $avatar = $_FILES['avatarimg'];
                $format = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                $path = "./Views/Shared/img/Users/$_SESSION[admin].$format";

                if (move_uploaded_file($avatar['tmp_name'], $path)) {
                    $avt =  "Views/Shared/img/Users/$_SESSION[admin].$format";
                    echo $this->Model("Users")->UpdateAvatar($_SESSION['admin'], $avt);
                    $_SESSION['avatar'] = $avt;
                    exit();
                }
            } catch (Exception) {
                echo false;
            }
        } else echo false;
    }
    public function UpdateHot()
    {
        if (isset($_POST['id']) && isset($_POST['hot'])) {
            $id = $_POST['id'];
            $hot = $_POST['hot'];
            try {
                echo $this->Model("Products")->hot($id, $hot);
            } catch (Exception) {
                echo false;
            }
        } else echo false;
    }
    public function HideShowAll()
    {
        $deleted = $_POST['deleted'];
        try {
            echo $this->Model("Products")->hideshowAll($deleted);
        } catch (Exception) {
            echo false;
        }
    }
    public function HotAll()
    {
        $hot = $_POST['hot'];
        try {
            echo $this->Model("Products")->hotAll($hot);
        } catch (Exception) {
            echo false;
        }
    }
}
