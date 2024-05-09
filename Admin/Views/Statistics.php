<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thống Kê | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->

</head>

<body onload="time()" class="app sidebar-mini rtl">

    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="app-title">
                    <ul class="app-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><b>Thống kê</b></a></li>
                    </ul>
                    <div id="clock"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class='icon  bx bxs-user fa-3x'></i>
                    <div class="info">
                        <h4>Tài khoản khách hàng</h4>
                        <p><b><?php echo $data['tongkhachhang'] ?> tài khoản</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class='icon  bx bx-pause fa-3x'></i>
                    <div class="info">
                        <h4>Đang chờ xử lí</h4>
                        <p><b><?php echo $data['choxuli'] ?> đơn hàng</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class='icon fa-3x bx bxs-shopping-bag-alt'></i>
                    <div class="info">
                        <h4>Tổng đơn hàng</h4>
                        <p><b><?php echo $data['tongdonhang'] ?> đơn hàng</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small warning coloured-icon"><i class='icon bx bxs-purchase-tag-alt fa-3x'></i>
                    <div class="info">
                        <h4>Tổng sản phẩm</h4>
                        <p><b><?php echo $data['tongsanpham'] ?> sản phẩm</b></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class='icon fa-3x bx bxs-chart'></i>
                    <div class="info">
                        <h4>Truy cập trong ngày</h4>
                        <p><b><?php echo $data['TongLuotTruyCapTrongThang'] ?> lượt</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class='icon  bx bx-check fa-3x'></i>
                    <div class="info">
                        <h4>đơn hàng thành công</h4>
                        <p><b><?php echo $data['daban'] ?> đơn hàng</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class='icon fa-3x bx bxs-receipt'></i>
                    <div class="info">
                        <h4>Đơn hàng hủy</h4>
                        <p><b><?php echo $data['donhanghuy'] ?> đơn hàng</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small danger coloured-icon"><i class='icon fa-3x bx bxs-tag-x'></i>
                    <div class="info">
                        <h4>Hết hàng</h4>
                        <p><b><?php echo $data['hethang'] ?> sản phẩm</b></p>
                    </div>
                </div>
            </div>



        </div>
        <?php if (count($data['SanPhamDaBanTrongNgay']) > 0) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div>
                            <h3 class="tile-title">SẢN PHẨM ĐÃ BÁN HÔM NAY</h3>
                        </div>
                        <div class="tile-body">
                            <table class="table table-hover table-bordered" id="banchay">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Danh mục</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>SL còn lại</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Kết quả kinh doanh</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($data['SanPhamDaBanTrongNgay']); $i++) { ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td><?php echo $data['SanPhamDaBanTrongNgay'][$i]['category_name'] ?></td>
                                            <td><?php echo $data['SanPhamDaBanTrongNgay'][$i]['id'] ?></td>
                                            <td style="text-align: left"><a href='<?php echo BaseController::Detail() . $this->TitleHandle($data['SanPhamDaBanTrongNgay'][$i]['title'], 0) ?>'> <img src="<?php echo BaseController::Client() . $data['SanPhamDaBanTrongNgay'][$i]['thumbnail'] ?>" height="50" alt=""> <?php echo $data['SanPhamDaBanTrongNgay'][$i]['title'] ?></a></td>
                                            <td><?php echo $data['SanPhamDaBanTrongNgay'][$i]['remain'] ?></td>
                                            <td><?php echo $this->MoneyHandle($data['SanPhamDaBanTrongNgay'][$i]['price']) ?>đ</td>
                                            <td><?php echo $data['SanPhamDaBanTrongNgay'][$i]['num'] ?></td>
                                            <td style="font-weight: 700"><?php echo $this->MoneyHandle($data['SanPhamDaBanTrongNgay'][$i]['income']) ?>đ</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <th colspan="6" style="text-align:right">KẾT QUẢ KINH DOANH HÔM NAY:</th>
                                    <td style="text-align: center; font-weight: 600; font-style: italic;" colspan="3"><?php echo $this->MoneyHandle($data['ThuNhapTrongNgay']["tntn"]) ?>đ</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (count($data['SanPhamDaHet']) > 0) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div>
                            <h3 class="tile-title">SẢN PHẨM ĐÃ HẾT HÀNG</h3>
                        </div>
                        <div class="tile-body">
                            <table class="table table-hover table-bordered" id="dahet">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Danh mục</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>SL Còn lại</th>
                                        <th>Lượt xem</th>
                                        <th>Đã bán</th>
                                        <th>Lãi/Lỗ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($data['SanPhamDaHet']); $i++) { ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td><?php echo $data['SanPhamDaHet'][$i]['category_name'] ?></td>
                                            <td><?php echo $data['SanPhamDaHet'][$i]['id'] ?></td>
                                            <td style="text-align: left"><a href='<?php echo BaseController::Detail() . $this->TitleHandle($data['SanPhamDaHet'][$i]['title'], 0) ?>'> <img src="<?php echo BaseController::Client() . $data['SanPhamDaHet'][$i]['thumbnail'] ?>" height="50" alt=""> <?php echo $data['SanPhamDaHet'][$i]['title'] ?></a></td>
                                            <td><?php echo $data['SanPhamDaHet'][$i]['num'] ?></td>
                                            <td><?php echo $data['SanPhamDaHet'][$i]['view'] ?></td>

                                            <td><?php echo $data['SanPhamDaHet'][$i]['selled'] ?></td>
                                            <td style="font-weight: 700"><?php echo $this->MoneyHandle($data['SanPhamDaHet'][$i]['income']) ?>đ</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (count($data['TongThuNhap']) > 0) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div>
                            <h3 class="tile-title">KẾT QUẢ KINH DOANH TỪ TRƯỚC ĐẾN NAY</h3>
                        </div>
                        <div class="tile-body">
                            <table class="table table-hover table-bordered" id="thunhap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>SL nhập</th>
                                        <th>SL đã bán</th>
                                        <th>SL còn lại</th>
                                        <th>Đơn Giá nhập</th>
                                        <th>Chi phí nhập</th>
                                        <th>Doanh thu</th>
                                        <th>Lãi/Lỗ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($data['TongThuNhap']); $i++) { ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td><?php echo $data['TongThuNhap'][$i]['id'] ?></td>
                                            <td style="text-align: left"><a href='<?php echo BaseController::Detail() . $this->TitleHandle($data['TongThuNhap'][$i]['title'], 0) ?>'>
                                                    <img src="<?php echo BaseController::Client() . $data['TongThuNhap'][$i]['thumbnail'] ?>" alt="" height=50>
                                                    <?php echo $data['TongThuNhap'][$i]['title'] ?></a></td>
                                            <td><?php echo $data['TongThuNhap'][$i]['total_num'] ?></td>
                                            <td><?php echo $data['TongThuNhap'][$i]['selled'] ?></td>
                                            <td><?php echo $data['TongThuNhap'][$i]['num'] ?></td>
                                            <td><?php echo $this->MoneyHandle($data['TongThuNhap'][$i]['price_in']) ?>đ</td>
                                            <td style="font-weight: 700"><?php echo $this->MoneyHandle($data['TongThuNhap'][$i]['tiennhap']) ?>đ</td>

                                            <td style="font-weight: 700"><?php echo $this->MoneyHandle($data['TongThuNhap'][$i]['sum_tienban']) ?>đ</td>
                                            <td style="font-weight: 700"><?php echo $this->MoneyHandle($data['TongThuNhap'][$i]['thunhap']) ?>đ</td>
                                        </tr>


                                    <?php } ?>
                                </tbody>
                            </table>
                            <table id="bangthongke">
                                <tr>
                                    <th>TỔNG CHI PHÍ NHẬP</th>
                                    <th>TỔNG DOANH THU</th>
                                    <th>TỔNG LÃI/LỖ</th>
                                </tr>
                                <tr>

                                    <td><?php echo $this->MoneyHandle($data['CongTongThuNhap']['TongTienNhap']) ?>đ</td>

                                    <td><?php echo $this->MoneyHandle($data['CongTongThuNhap']['TongTienBan']) ?>đ</td>

                                    <td><?php echo $this->MoneyHandle($data['CongTongThuNhap']['TongThuNhap']) ?>đ</td>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">LƯỢT TRUY CẬP WEBSITE</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">KẾT QUẢ KINH DOANH TỪNG THÁNG</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right" style="font-size: 12px">
            <p><b>Nguyễn Hoàng Long</b></p>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script>
        let banchay = new DataTable('#banchay', {
            "language": {
                "lengthMenu": "Hiển thị _MENU_ mục mỗi trang",
                "zeroRecords": "Không có thông tin",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(đã lọc tổng cộng _MAX_ bản ghi)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "<<",
                    "last": ">>",
                    "next": ">",
                    "previous": "<"
                }
            },
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            }],

        });
        let dahet = new DataTable('#dahet', {
            "language": {
                "lengthMenu": "Hiển thị _MENU_ mục mỗi trang",
                "zeroRecords": "Không có thông tin",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(đã lọc tổng cộng _MAX_ bản ghi)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "<<",
                    "last": ">>",
                    "next": ">",
                    "previous": "<"
                }
            },
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            }],
        });
        let thunhap = new DataTable('#thunhap', {
            "language": {
                "lengthMenu": "Hiển thị _MENU_ mục mỗi trang",
                "zeroRecords": "Không có thông tin",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(đã lọc tổng cộng _MAX_ bản ghi)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "<<",
                    "last": ">>",
                    "next": ">",
                    "previous": "<"
                }
            },
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            }],

        });
    </script>
    <script type="text/javascript">
        $.post("./Ajax/CountViewMonth", function(result) {
                    // var luottruycap = {
                    //     labels: result.thang,
                    //     datasets: [{
                    //         label: "Lượt truy cập hàng tháng",
                    //         fillColor: "rgba(9, 109, 239, 0.651)  ",
                    //         pointColor: "rgb(9, 109, 239)",
                    //         strokeColor: "rgb(9, 109, 239)",
                    //         pointStrokeColor: "rgb(9, 109, 239)",
                    //         pointHighlightFill: "rgb(9, 109, 239)",
                    //         pointHighlightStroke: "rgb(9, 109, 239)",
                    //         data: result.soluong
                    //     }]
                    // };


                    // var ctxl = $("#barChartDemo").get(0).getContext("2d");
                    // var lineChart = new Chart(ctxl).Bar(luottruycap);

                    const ctx = $("#barChartDemo").get(0).getContext("2d");
                    const myChart = new Chart(ctx, {
                        data: {
                            labels: result.thang,
                            datasets: [{
                                        type: "bar",
                                        label: 'Lượt truy cập',
                                        data: result.soluong,
                                        backgroundColor: [
                                            'rgba(106, 194, 57, 0.1)',
                                        ],
                                        borderColor: [
                                            'rgba(106, 194, 57, 1)',
                                        ],
                                        borderWidth: 2,
                                        tension: 0.5,
                                    },
                                    {
                                        type: "line",
                                        label: 'Ngày cao điểm',
                                        data: result.ngay,
                                        backgroundColor: [
                                            'rgba(255, 212, 59, 1)',
                                        ],
                                        borderColor: [
                                            'rgba(255, 212, 59, 1)',
                                        ],
                                        borderWidth: 1.5,
                                        tension: 0.5,
                                    },
                                    {
                                        type: "line",
                                        label: 'View cao điểm',
                                        data: result.max,
                                        backgroundColor: [
                                            'rgba(237, 51, 36, 1)',
                                        ],
                                        borderColor: [
                                            'rgba(237, 51, 36, 1)',
                                        ],
                                        borderWidth: 2,
                                        tension: 0.5,
                                    }],
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: false
                                            }
                                        }
                                    }
                                }
                                }
                                );
                        },
                        "json")

                $.post("./Ajax/MoneyMonth", function(result) {
                    // var tongthunhap = {
                    //     labels: result.thang,
                    //     datasets: [{
                    //         label: "KQKD từng tháng",
                    //         fillColor: "rgba(255, 255, 255, 0.158)",
                    //         strokeColor: "rgb(237, 51, 36)",
                    //         pointColor: "rgb(23, 31, 35)",
                    //         pointStrokeColor: "#fff",
                    //         pointHighlightFill: "#fff",
                    //         pointHighlightStroke: "green",
                    //         data: result.tongthunhap
                    //     }]
                    // }
                    // var ctxb = $("#lineChartDemo").get(0).getContext("2d");
                    // var barChart = new Chart(ctxb).Line(tongthunhap);
                    const ctx = $("#lineChartDemo").get(0).getContext("2d");
                    const myChart = new Chart(ctx, {
                        data: {
                            labels: result.thang,
                            datasets: [{
                                        type: "line",
                                        label: 'Lãi / Lỗ',
                                        data: result.tongthunhap,
                                        backgroundColor: [
                                            'rgba(255, 0, 0, 0.2)',
                                            
                                        ],
                                        borderColor: [
                                            'red',
                                        ],
                                        borderWidth: 2,
                                        tension: 0.1,
                                    },
                                ],
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                }
                                }
                                );
                }, "json")
    </script>
    <style>
        table a {
            color: blue;
        }

        #bangthongke th,
        #bangthongke td {
            text-align: center;
        }

        th.dt-center,
        td.dt-center {
            text-align: center;
        }
    </style>
</body>

</html>