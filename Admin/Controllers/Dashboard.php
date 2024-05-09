<?php
class Dashboard extends BaseController{
    public function __construct($param = ""){
        parent::__construct();
        $this->Show();
    }
    public function Show(){
        $user = $this->Model("Users")->getUser($_SESSION['admin']);
        $order= $this->Model("Orders")->getOrder("limit 5");
        require_once "./Views/Shared/Master.php";
        $this->View("Dashboard", [
            "user" => $user,
            "order" => $order,
            "tongkhachhang" => $this->Model("Stats")->TongKhachHang(),
            "tongsanpham" => $this->Model("Stats")->TongSanPham(),
            "tongdonhang" => $this->Model("Stats")->TongDonHang(),
            "saphethang" => $this->Model("Stats")->SapHetHang(),
            "khachhangmoi" => $this->Model("Users")->getAllUser(),
            "choxuli" => $this->Model("Stats")->ChoXuLi(),
            "daban" => $this->Model("Stats")->DaBan()
        ]);
    }
}