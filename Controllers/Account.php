<?php
class Account extends BaseController
{
    public function __construct($param = "")
    {
        parent::__construct();
        if ($this->login__status){
            header("location: ./");
            exit();
        }
        $status = "";
        $content = "";
        $title = "Đặt lại mật khẩu";
        $key = "";
        if (!empty($_GET['accesskey'])) {
            $key = $_GET['accesskey'];
            $accesskey = explode("-", $key);
            $source = $this->Model('Users')->getAccessKey($_GET['accesskey']) ?? [];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            if (count($accesskey) == 3 && count($source) > 0) {
                switch ($accesskey[0]) {
                    case "R":
                        $status = "reset";
                        if (time() - $accesskey[1] < 600) {
                            $this->ShowResult($status, $content, $title, $key);
                        } else $this->Failed($key);
                        exit();
                    case "V":
                        $status = "notification";
                        $content = "<i class='fa-solid fa-check fa-2xl' style='color: #14c80e;font-size: 5rem;'></i><br>
                        <h2 style='margin-top: 10px'>Đã xác thực tài khoản thành công. Bạn có thể đăng nhập vào website <br> <a href='./Login'>Đăng nhập ngay</a></h2>";
                        $title = "Xác thực thành công";
                        $this->ShowResult($status, $content, $title, $key);
                        $this->Model("Users")->VerifyAccount($key);
                        exit();
                }
            } else $this->Failed($key);
        }
        else $this->ShowResult($status, $content, $title, $key);
    }

    public function Failed($key)
    {
        $status = "notification";
        $content = "<img src='./Views/Shared/img/error.png' alt='Lỗi'>
        <h1 style='padding-bottom: 20px'>Liên kết không hợp lệ. Vui lòng kiểm tra lại !</h1>";
        $title = "Lỗi xác thực";
        $this->ShowResult($status, $content, $title, $key);
    }
    public function ShowResult($status, $content, $title, $key)
    {
        $this->View("Account", [
            "status" => $status,
            "content" => $content,
            "title" => $title,
            "user" => $this->Model("Users")->getAccessKey($key ?? "")
        ]);
    }
}
