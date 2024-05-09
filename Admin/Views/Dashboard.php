<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bảng điều khiển | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->

  <main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><b>Bảng điều khiển</b></a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--Left-->
      <div class="col-md-12 col-lg-12">
        <div class="row">
          <div class="col-md-6">
            <div class="widget-small danger coloured-icon"><i class='icon bx bxs-bell fa-3x'></i>
              <div class="info">
                <h4>Đang chờ xử lý</h4>
                <p><b><?php echo $data['choxuli'] ?> đơn hàng</b></p>
                <p class="info-tong">Các đơn hàng đang chờ xử lý</p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="widget-small warning coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
              <div class="info">
                <h4>Sắp hết hàng</h4>
                <p><b><?php echo $data['saphethang'] ?> sản phẩm</b></p>
                <p class="info-tong">Các sản phẩm có số lượng nhỏ hơn 5 được cảnh báo sắp hết.</p>
              </div>
            </div>
          </div>

          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
              <div class="info">
                <h4>tài khoản</h4>
                <p><b><?php echo $data['tongkhachhang'] ?> tài khoản</b></p>
                <p class="info-tong">Tổng số tài khoản khách hàng được quản lý.</p>
              </div>
            </div>
          </div>


          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
              <div class="info">
                <h4>sản phẩm</h4>
                <p><b><?php echo $data['tongsanpham'] ?> sản phẩm</b></p>
                <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
              </div>
            </div>
          </div>
          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
              <div class="info">
                <h4>đơn hàng trong tháng</h4>
                <p><b><?php echo $data['tongdonhang'] ?> đơn hàng</b></p>
                <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="widget-small primary coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
              <div class="info">
                <h4>đơn hàng thành công</h4>
                <p><b><?php echo $data['daban'] ?> đơn hàng</b></p>
                <p class="info-tong">Tổng số đơn hàng thành công trong tháng.</p>
              </div>
            </div>
          </div>
          <!-- col-6 -->

          <!-- col-12 -->

          <div class="col-md-12">
            <?php if (count($data['order']) > 0) { ?>
              <div class="tile">
                <h3 class="tile-title">Tình trạng đơn hàng</h3>
                <div>
                  <table class="table table-bordered" id="tinhtrang">
                    <thead>
                      <tr>
                        <th>ID đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên khách hàng</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($data['order'] as $row) {
                      ?>
                        <tr>
                          <td><?php echo $row['order_id'] ?></td>
                          <td><?php echo $row['title'] ?></td>
                          <td><?php echo $row['fullname'] ?></td>
                          <td><?php echo $row['num'] ?></td>

                          <td style='color: #812; font-weight: 600'><?php echo $this->MoneyHandle($row['total_money']) . " đ" ?> </td>
                          <td><?php echo $this->Status($row['status']) ?></td>
                        </tr>
                      <?php
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
                <!-- / div trống-->
              </div>
            <?php } ?>
          </div>
  
          <div class="col-md-12">
            <?php if (count($data['khachhangmoi']) > 0) { ?>
              <div class="tile">
                <h3 class="tile-title">Khách hàng mới</h3>
                <div>
                  <table class="table table-hover" id="khachhangmoi">
                    <thead>
                      <tr>
                        <th>Số điện thoại</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày sinh</th>
                        <th>Ngày tạo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data['khachhangmoi'] as $row) { ?>
                        <tr>
                          <td><?php echo $row['username'] ?></td>
                          <td><?php echo $row['fullname'] ?></td>
                          <td><?php echo $row['birthday'] ?></td>
                          <td><?php echo $row['created_at'] ?></td>
                        </tr>

                      <?php } ?>

                    </tbody>
                  </table>
                </div>

              </div>
            <?php } ?>
          </div>
          <!-- / col-12 -->
        </div>
      </div>

    </div>

  </main>

  <script type="text/javascript">
    $(document).ready(function() {
      let khachhangmoi = new DataTable($("#khachhangmoi"), {
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
        order: [
          [3, 'desc']
        ]
      })
      let tinhtrang = new DataTable($("#tinhtrang"), {
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
        order: [
          [3, 'desc']
        ]
      })
    })
   
  </script>

</body>

</html>