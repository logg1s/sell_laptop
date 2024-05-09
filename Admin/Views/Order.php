<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản Lý Đơn Hàng | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Quản Lý Đơn Hàng</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <!-- 
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="form-add-don-hang.html" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới đơn hàng</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i class="fas fa-file-upload"></i> Tải từ file</a>
              </div> -->

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div>
  
              <div class="col-sm-2">
                <button class="btn btn-sm btn-danger" id='deleteAll' type="button" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa tất cả </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-sm btn-warning" id='acceptAll' type="button" title="Duyệt tất cả"><i class="fa fa-share"></i> Duyệt tất cả đơn hàng </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-sm btn-success" id='successAll' type="button" title="Giao toàn bộ"><i class="fa fa-check"></i> Đã giao toàn bộ đơn hàng </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-sm btn-danger" id='cancelAll' type="button" title="Hủy toàn bộ"><i class="fa fa-ban"></i> Hủy toàn bộ đơn hàng </button>
              </div>
            </div>
          
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <!-- <th width="10"><input type="checkbox" id="all"></th> -->
                  <th>STT</th>
                  <th>ID đơn hàng</th>
                  <th>Đơn hàng</th>
                  <th>Khách hàng</th>
                  <th>Địa chỉ</th>
                  <th>Số điện thoại</th>
                  <th>Ngày đặt hàng</th>
                  <th>Ngày hoàn thành</th>
                  <th>Đơn giá</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                  <th>Ghi chú</th>
                  <th>Kiểu thanh toán</th>
                  <th>Tình trạng</th>
                  <th>Tính năng</th>
                </tr>
              </thead>
              <tbody>
                <?php for($i=0; $i<count($data['order']);$i++) { ?>
                  <td><?php echo $i + 1?></td>
                  <td class="data-id" data-id='<?php echo $data['order'][$i]['order_id'] ?>'><?php echo $data['order'][$i]['order_id'] ?> <input type="hidden" class = "pid" data-pid="<?php echo $data['order'][$i]['id']?>"> <input type="hidden" class="selled" data-selled= "<?php echo $data['order'][$i]['order_num']?>"> </td>
                  <td style="text-align: left"><a href="<?php echo BaseController::Detail() . $this->TitleHandle($data['order'][$i]['title'], 0) ?>" target='_blank'><img src="<?php echo BaseController::Client().$data['order'][$i]['thumbnail'] ?>" height='30'>
              
                      <span style='color: blue'> <?php echo $data['order'][$i]['title'] ?></span>
                    </a></td>
                  <td>
                    <?php echo $data['order'][$i]['fullname'] ?>
                  </td>
                  <td>
                    <?php echo $data['order'][$i]['address'] ?>
                  </td>
                  <td>
                    <?php echo $data['order'][$i]['phone_number'] ?>
                  </td>
                  <td>
                    <?php echo $data['order'][$i]['order_date'] ?>
                  </td>
                  <td>
                    <?php echo $data['order'][$i]['finish_date'] ?>
                  </td>
                  <td><?php echo $this->MoneyHandle($data['order'][$i]['order_price']) ?>đ</td>
                  <td>
                    <?php echo $data['order'][$i]['order_num'] ?>
                  </td>
                  <td style='color: #922; font-weight: 600'><?php echo $this->MoneyHandle($data['order'][$i]['total_money']) . "đ" ?></td>
                  <td ><?php echo $data['order'][$i]['note']?></td>
                  <td style="font-weight: 700; color: green; text-align: left"><?php echo $data['order'][$i]['payment_method']?></td>

                  <td><?php echo $this->Status($data['order'][$i]['status']) ?></td>
                  <td>
                    <?php if ($data['order'][$i]['status'] == '1') {
                      echo '<button class="btn btn-success btn-sm finish" type="button" title="Đã giao"><i class="fa fa-check"></i></button>
                      <button class="btn btn-danger btn-sm fail" type="button" title="Giao không thành công"><i class="fas fa-strikethrough"></i></button>
                      ';
                    }
                    if ($data['order'][$i]['status'] == '0') {
                      echo '<button class="btn btn-primary btn-sm verify" type="button" title="Xác nhận giao hàng"><i class="fa fa-share"></i></button>
                      <button class="btn btn-primary btn-sm cancel" type="button" title="Hủy đơn hàng"><i class="fa fa-ban"></i></button>';
                    }
                    ?>
                    <button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button>

                  </td>
                  </tr>
                <?php } ?>
              
              </tbody>
            </table>
            <!-- <a class="btn btn-danger btn-sm" id='deleteAll' type="button" title="Xóa" onclick=""><i class="fas fa-trash-alt"></i> Xóa tất cả </a> -->
          </div>
        </div>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    $('#sampleTable').DataTable({
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
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
   
      $("#sampleTable").on('click','.trash',function() {
        let id = $(this).parent().siblings("td.data-id").data("id");
        swal({
            title: "Cảnh báo",

            text: "Bạn có chắc chắn là muốn xóa đơn hàng này?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/DeleteOrder", {
                id: id
              }, function(result) {
                if (result) {
                  swal("Đã xóa thành công.!", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Xóa thất bại.!", {});
              })
            }
          });
      });

      $("#sampleTable").on('click','.verify',function() {
        let id = $(this).parent().siblings("td.data-id").data("id");
        swal({
            title: "Cảnh báo",
            text: "Xác nhận vận chuyển với đơn hàng này?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/VerifyOrder", {
                id: id
              }, function(result) {
                if (result) {
                  swal("Đã xác nhận vận chuyển với đơn hàng này !", {}).then(() => {
                    window.location.reload();
                  });
                } else
                  swal("Có vấn đề với việc xác nhận !", {});
              })
            }
          });
      });



      $("#sampleTable").on('click','.finish',function() {
        let id = $(this).parent().siblings("td.data-id").data("id");
        let selled = $(this).parent().siblings("td").children("input.selled").data("selled");
        let product_id = $(this).parent().siblings("td").children("input.pid").data("pid");
        swal({
            title: "Cảnh báo",
            text: "Xác nhận giao hàng thành công ?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/FinishOrder", {
                id: id,
                selled: selled,
                product_id: product_id
              }, function(result) {
                if (result) {
                  swal("Đã xác nhận giao hàng thành công !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có vấn đề với việc xác nhận !", {});
              })
            }
          });
      });

      $("#sampleTable").on('click','.fail',function() {
        let id = $(this).parent().siblings("td.data-id").data("id");
        swal({
            title: "Cảnh báo",
            text: "Xác nhận không thể giao đơn hàng này ?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/CantOrder", {
                id: id
              }, function(result) {
                if (result) {
                  swal("Đã xác nhận giao thất bại !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có lỗi xảy ra !", {});
              })
            }
          });
      });
      $("#sampleTable").on('click','.cancel',function() {
        let id = $(this).parent().siblings("td.data-id").data("id");
        swal({
            title: "Cảnh báo",
            text: "Hủy đơn hàng này?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/CancelOrder", {
                id: id
              }, function(result) {
                if (result) {
                  swal("Đã hủy đơn hàng này !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có lỗi xảy ra !", {});
              })
            }
          });
      });

      
      jQuery("#deleteAll").click(function() {
        swal({
            title: "Xóa tất cả đơn hàng ??",
            text: "Bạn sẽ không thể hoàn tác",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/DeleteAllOrder", function(result) {
                if (result) {
                  swal("Đã xóa toàn bộ đơn hàng !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có lỗi xảy ra !", {});
              })
            }
          });
      });

      jQuery("#acceptAll").click(function() {
        swal({
            title: "Xác nhận giao cho tất cả đơn hàng??",
            text: "Các đơn hàng đang chờ xử lý sẽ được chuyển sang trạng thái vận chuyển. Bạn có muốn tiếp tục ?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/AcceptAllOrder", function(result) {
                if (result) {
                  swal("Đã xác nhận toàn bộ đơn hàng !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có lỗi xảy ra !", {});
              })
            }
          });
      });
      jQuery("#cancelAll").click(function() {
        swal({
            title: "Xác nhận hủy toàn bộ đơn hàng??",
            text: "Các đơn hàng đang chờ xử lý sẽ được hủy. Bạn có muốn tiếp tục ?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/CancelAllOrder", function(result) {
                if (result) {
                  swal("Đã hủy toàn bộ đơn hàng !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có lỗi xảy ra !", {});
              })
            }
          });
      });
      jQuery("#successAll").click(function() {
        swal({
            title: "Xác nhận đã giao hàng cho tất cả đơn hàng??",
            text: "Chỉ các đơn hàng đang vận chuyển mới có thể xác nhận. Bạn có muốn tiếp tục",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              $.post("./Ajax/SuccessAllOrder", function(result) {
                if (result) {
                  swal("Toàn bộ đơn hàng đã được giao !", {}).then(() => {
                    window.location.reload();
                  });

                } else
                  swal("Có lỗi xảy ra !", {});
              })
            }
          });
      });

    oTable = $('#sampleTable').dataTable();
    $('#all').click(function(e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });

 

    $("#show-emp").on("click", function() {
      $("#ModalUP").modal({
        backdrop: false,
        keyboard: false
      })
    });
  </script>
</body>

</html>