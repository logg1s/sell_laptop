<?php
class Statistics extends BaseController{
    public function __construct(){
        parent::__construct();
        require_once "./Views/Shared/Master.php";
        $this->View("Statistics",[
            "tongkhachhang" => $this->Model("Stats")->TongKhachHang(),
            "tongsanpham" => $this->Model("Stats")->TongSanPham(),
            "tongdonhang" => $this->Model("Stats")->TongDonHang(),
            "saphethang" => $this->Model("Stats")->SapHetHang(),
            "choxuli" => $this->Model("Stats")->ChoXuLi(),
            "TongLuotTruyCapTrongThang" => $this->Model("Stats")->TongLuotTruyCapTrongNgay(),
            "hethang" => $this->Model("Stats")->HetHang(),
            "daban" => $this->Model("Stats")->DaBan(),
            "donhanghuy" => $this->Model("Stats")->DonHangHuy(),
            "SanPhamDaBanTrongNgay" => $this->Model("Stats")->SanPhamDaBanTrongNgay(),
            "ThuNhapTrongNgay" => $this->Model("Stats")->ThuNhapTrongNgay(),
            "SanPhamDaHet" => $this->Model("Stats")->SanPhamDaHet(),
            "TongThuNhap" => $this->Model("Stats")->TongThuNhap(),
            "CongTongThuNhap" => $this->Model("Stats")->CongTongThuNhap(),
            "LuotTruyCapTungThang" => $this->Model("Stats")->LuotTruyCapTungThang(),
            "ThuNhapHangThang" => $this->Model("Stats")->ThuNhapHangThang(),

        ]);
    }
}