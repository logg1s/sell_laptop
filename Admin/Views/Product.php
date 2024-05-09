<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản Lý Sản Phẩm | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->



  <style>
    #editproduct ul {
      display: flex;
      flex-wrap: wrap;
      column-gap: 50px;
    }

    #editproduct li {
      display: flex;
      flex-direction: column;
      /* row-gap: 10px; */
      margin-bottom: 30px;
      flex: calc(33% - 50px);
    }

    #editproduct input:not([type=file]),
    select,
    textarea {
      border-radius: 5px;
      border: 1px solid black;
      padding: 10px;
    }

    .red_require {
      color: red;
    }

    table a {
      color: blue;
    }

    #editproduct button {
      padding: 10px;
      border: none;
      background-color: #574;
      cursor: pointer;
      color: white;
      border-radius: 5px;
      font-weight: 600;
    }

    label {
      font-weight: 700;
      font-size: 1.1rem
    }

    textarea {
      resize: both;
    }
  </style>
</head>

<body onload="time()" class="app sidebar-mini rtl">

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Quản lý sản phẩm</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">

                <a class="btn btn-add btn-sm" id="createproduct" title="Thêm"><i class="fas fa-plus"></i>
                  Thêm sản phẩm mới</a>
              </div>
              <!-- <div class="col-sm-2">
                <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i class="fas fa-file-upload"></i> Tải từ file</a>
              </div> -->

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div>
              <!-- <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i class="fas fa-copy"></i> Sao chép</a>
              </div> -->

              <!-- <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
              </div> -->
              <!-- <div class="col-sm-2">
                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
              </div> -->
              <div class="col-sm-2">
                <button class="btn btn-danger btn-sm " id="deleteall" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa tất cả </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-warning btn-sm " id="hideall" type="button" title="Ẩn"><i class="fas fa-eye-slash"></i> Ấn tất cả </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-success btn-sm " id="showall" type="button" title="Ẩn"><i class="fas fa-eye"></i> Hiện tất cả </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-info btn-sm " id="hotall" type="button" title="Ẩn"><i class="fas fa-check"></i> Tất cả HOT </button>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-info btn-sm " id="unhotall" type="button" title="Ẩn"><i class="fa fa-square"></i> Bỏ chọn HOT </button>
              </div>
            </div>
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Danh mục</th>
                  <th>Mã sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Lượt xem</th>
                  <th>Ngày thêm</th>
                  <th>Số lượng</th>
                  <th>Đã bán</th>
                  <th>Giá bán</th>
                  <th>Tình trạng</th>
                  <th>HOT</th>
                  <th>Chức năng</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i = 0; $i < count($data['product']); $i++) { ?>
                  <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $data['product'][$i]['name'] ?></td>
                    <td class="data-id" data-id='<?php echo $data['product'][$i]['id'] ?>'><?php echo $data['product'][$i]['id'] ?></td>
                    <td> <a href="<?php echo BaseController::Detail() . $this->TitleHandle($data['product'][$i]['title'], 0) ?>" target='_blank'>
                        <?php echo $data['product'][$i]['title'] ?></a></td>
                    <td> <a href="<?php echo BaseController::Detail() . $this->TitleHandle($data['product'][$i]['title'], 0) ?>" target='_blank'>
                        <img src="<?php echo BaseController::Client() . $data['product'][$i]['thumbnail'] ?>" alt="" height='100'></a></td>
                        <td><?php echo $data['product'][$i]['view'] ?></td>
                    <td><?php echo $data['product'][$i]['created_at'] ?></td>
                    <td><?php echo $data['product'][$i]['num'] ?></td>
                    <td><?php echo $data['product'][$i]['selled'] ?></td>
                    <td><?php echo $this->MoneyHandle($data['product'][$i]['price_out']) ?> đ</td>
                    <td>
                      <?php echo $this->StatusProduct($data['product'][$i]['num']) ?>
                      <br>
                      <?php if ($data['product'][$i]['deleted'] == "1") echo '<span class="badge bg-danger">Bị ẩn</span>' ?>
                    </td>
                    <td>
                      <label style="height: 100px; width: 100%"><input class="hotcheck" type="checkbox" <?php if ($data['product'][$i]['hot']) echo "checked" ?>></label>
                    </td>
                    <td>
                      <button class="btn btn-primary btn-sm trash" type="button" title="Xóa" onclick=""><i class="fas fa-trash-alt delete"></i>
                      </button>
                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"><i class="fas fa-edit"></i></button>
                      <?php if ($data['product'][$i]['deleted'] == '0') { ?>
                        <button class="btn btn-primary btn-sm hide" type="button" title="Ẩn sản phẩm" id="show-emp"><i class="fas fa-eye-slash"></i></button>
                      <?php } else { ?>
                        <button class="btn btn-success btn-sm show" type="button" title="Hiện sản phẩm" id="show-emp"><i class="fas fa-eye"></i></button>
                      <?php } ?>
                    </td>
                  </tr>

                <?php } ?>

              </tbody>
            </table>
            <div id='editproduct'>
              <form action="" method="post" enctype="multipart/form-data" style="margin: auto" id="formeditproduct">
                <input type="hidden" name='id' id="id">
                <ul>
                  <li>
                    <label for="danhmuc"><span class="red_require">*</span> Danh mục: </label>
                    <select name="danhmuc" id="danhmuc">
                      <?php
                      foreach ($data['category'] as $row) { ?>
                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                      <?php  } ?>
                    </select>
                  </li>
                  <li>
                    <label for="tensanpham"><span class="red_require">*</span> Tên sản phẩm: </label>
                    <input type="text" id="tensanpham" name="tensanpham" required>
                  </li>
                  <li>
                    <label for="gianhap"><span class="red_require">*</span> Giá nhập: </label>
                    <input type="number" id="gianhap" name="gianhap" required min = "1000">
                  </li>
                  <li>
                    <label for="giagoc"><span class="red_require">*</span> Giá gốc: </label>
                    <input type="number" id="giagoc" name="giagoc" required min = "1000">
                  </li>
                  <li>
                    <label for="giaban"><span class="red_require">*</span> Giá bán chính thức: </label>
                    <input type="number" id="giaban" name="giaban" required min = "1000">
                  </li>

                  <li>
                    <label for="soluong"><span class="red_require">*</span> Số lượng: </label>
                    <input type="number" id="soluong" min='1' name="soluong" required >
                  </li>

                  <li>
                    <label for="hinhanh">Hình ảnh: </label>
                    <img src="" alt="" width="100" id="imageProduct">
                    <input type="hidden" id="linkanh" name="linkanh">
                    <input type="file" id="hinhanh" name="hinhanh" accept="image/*">
                  </li>

                  <li>
                    <label for="mota">Mô tả: </label>
                    <textarea name="mota" id="mota" cols="30" rows="10"></textarea>
                  </li>
                  <li>
                    <label for="nhacungcap">Nhà cung cấp: </label>
                    <select name="nhacungcap" id="nhacungcap">
                      <option value=""></option>
                      <?php foreach ($data['supplier'] as $row) { ?>
                        <option value="<?php echo $row['supplier_id'] ?>"><?php echo $row['supplier_name'] ?></option>
                      <?php } ?>
                    </select>
                  </li>

                  <li>
                    <label for="nhasanxuat">Nhà sản xuất: </label>
                    <input type="text" id="nhasanxuat" name="nhasanxuat">
                  </li>
                  <li>
                    <label for="manhinh">Kích cỡ màn hình(inch): </label>
                    <input type="number" id="manhinh" name="manhinh" step="0.01">
                  </li>
                  <li>
                    <label for="cpu">CPU: </label>
                    <input type="text" id="cpu" name="cpu">
                  </li>
                  <li>
                    <label for="ram">RAM(GB): </label>
                    <input type="number" id="ram" name="ram">
                  </li>
                  <li>
                    <label for="gpu">Card đồ họa: </label>
                    <input type="text" id="gpu" name="gpu">
                  </li>
                  <li>
                    <label for="storage">Dung lượng ổ cứng(GB): </label>
                    <input type="number" id="storage" name="storage">
                  </li>
                  <li>
                    <label for="weight">Trọng lượng(Kg): </label>
                    <input type="number" id="weight" name="weight" step="0.01">
                  </li>
                  <li>
                    <label for="os">Hệ điều hành: </label>
                    <input type="text" id="os" name="os">
                  </li>
                  <li>
                    <label for="promotion">Ưu đãi: </label>
                    <textarea name="promotion" id="promotion" cols="30" rows="10"></textarea>
                  </li>
                  <li style="display: none">
                    <label for="type">Loại: </label>
                    <input type="text" id="type" name="type">
                  </li>
                  <li>
                    <div style="margin: auto">
                      <button type="submit" id="saveinfoproduct">Lưu thay đổi</button>
                      <button type="submit" id="savenew" style='display: hidden'>Thêm mới</button>
                      <button class="canceledit" style="background-color: gray;">Hủy</button>
                    </div>
                  </li>
                </ul>

              </form>
            </div>
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
    //Thời Gian
  </script>
  <script>
    // function deleteRow(r) {
    //     var i = r.parentNode.parentNode.rowIndex;
    //     document.getElementById("myTable").deleteRow(i);
    // }
    $("#sampleTable").on('click', '.trash', function() {
      let id = $(this).parent().siblings("td.data-id").data("id");
      swal({
          title: "Bạn có chắc chắn là muốn xóa sản phẩm này?",

          text: "Lưu ý: Thao tác này sẽ xóa toàn bộ thông tin liên quan đến sản phẩm này (bao gồm thông tin đơn hàng và hóa đơn...) Bạn có muốn xóa không?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/DeleteProduct", {
              id: id
            }, function(result) {
              if (result) {
                swal("Đã xóa thành công.!", {}).then(() => {
                  window.location.reload();;
                });

              } else
                swal("Xóa thất bại.!", {});
            })
          }
        });
    });



    $("#sampleTable").on('click', '.edit', function() {
      let id = $(this).parent().siblings("td.data-id").data("id");
      $('table').parents('div.dataTables_wrapper').first().hide();
      $("#savenew").hide();
      $("#saveinfoproduct").show();
      $.post("./Ajax/LoadInfoProduct", {
        id: id
      }, function(result) {
        if (result) {
          $("#id").val(result.id);
          $("#danhmuc").val(result.category_id);
          $("#tensanpham").val(result.title);
          $("#gianhap").val(result.price_in);
          $("#giagoc").val(result.price);
          $("#giaban").val(result.price_out);
          $("#soluong").val(result.num);
          // $("#linkimage").attr("href", result.thumbnail);
          $("#imageProduct").attr("src", '<?php echo BaseController::Client() ?>' + result.thumbnail);
          $("#mota").val(result.description);
          $("#nhacungcap").val(result.supplier_id);
          $("#linkanh").val(result.thumbnail);

          $("#nhasanxuat").val(result.manufacturer);
          $("#manhinh").val(result.screen);
          $("#cpu").val(result.cpu);
          $("#ram").val(result.ram);
          $("#gpu").val(result.gpu);
          $("#storage").val(result.storage);
          $("#weight").val(result.weight);
          $("#os").val(result.os);
          $("#promotion").val(result.promotion);
          $("#type").val(result.type);
        }
      }, "json")

      $("#editproduct").fadeIn();
    })

    $(".canceledit").click(function(event) {
      event.preventDefault();
      $("#editproduct").fadeOut();
      $('table').parents('div.dataTables_wrapper').first().fadeIn();
    })

    oTable = $('#sampleTable').dataTable();
    $('#all').click(function(e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });
  </script>
  <script>
    $("#editproduct").hide();

    function CheckInput(action = 1) {
      let check = true;
      if (

        $("select#danhmuc").val() == "" ||
        $("input#tensanpham").val() == "" ||
        $("input#gianhap").val() == "" ||
        $("input#giagoc").val() == "" ||
        $("input#giaban").val() == "" ||
        $("input#soluong").val() == ""
        // $("select#nhacungcap").val() == "" 
      ) {
        check = false;
        alert("❌ Vui lòng nhập các thông tin bắt buộc có dấu * ở bên trên !!!");
      }
      if($("input#soluong").val() < 1){
        check = false;
        alert("❌ Số lượng phải lớn hơn 0 !!!");
      }
      if( $("input#gianhap").val() < 1000 ||
        $("input#giagoc").val() < 1000 ||
        $("input#giaban").val() < 1000){
        check = false;
        alert("❌ Giá phải lớn hơn hoặc bằng 1000 !!!");
      }


      if (check) {
        let formData = new FormData($("form")[0]);
        formData.append("action", action);
        $.ajax({
          url: "./Ajax/UpdateProduct",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(result) {
            if (result) {
              swal({
                title: "Lưu thành công",
                text: "",
                icon: "success",
              }).then(() => {
                window.location.reload();;
              });
            } else {
              swal({
                title: "Lưu thất bại",
                text: "",
                icon: "error",
              })
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            alert('Lỗi gửi dữ liệu: ' + errorThrown);
          }
        })
      }
      // return false;
    }
    $("#saveinfoproduct").click(function(event) {
      event.preventDefault();
      CheckInput(0);
    })
    $("#savenew").click(function(event) {
      event.preventDefault();
      CheckInput(1);
    })

    $("#sampleTable").on('click', 'button.hide', function() {
      let id = $(this).parent().siblings("td.data-id").data('id');
      $.post("./Ajax/HideProduct", {
        id: id
      }, function(result) {
        window.location.reload();;
      })
    })
    $("#sampleTable").on('click', 'button.show', function() {
      let id = $(this).parent().siblings("td.data-id").data('id');
      $.post("./Ajax/ShowProduct", {
        id: id
      }, function(result) {
        window.location.reload();;
      })
    })

    $("a#createproduct").click(function() {
      $('table').parents('div.dataTables_wrapper').first().hide();
      $("#editproduct").fadeIn();
      $("#formeditproduct").get(0).reset();
      $("#imageProduct").attr("src", "")
      $("#saveinfoproduct").hide();
      $("#savenew").show();
    })

    $("#hideall").click(function() {
      swal({
          title: "Bạn có chắc chắn muốn ẩn toàn bộ sản phẩm?",
          text: "Các sản phẩm đang hiển thị sẽ bị ẩn. Bạn có muốn tiếp tục ?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/HideShowAll", {
              deleted: '1'
            }, function() {
              window.location.reload();;
            })
          }
        });
    })
    $("#showall").click(function() {
      swal({
          title: "Bạn có chắc chắn muốn hiển thị toàn bộ sản phẩm?",
          text: "Các sản phẩm đang bị ẩn sẽ được hiển thị. Bạn có muốn tiếp tục ?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/HideShowAll", {
              deleted: '0'
            }, function() {
              window.location.reload();;
            })
          }
        });
    })
    $("#deleteall").click(function() {
      swal({
          title: "Bạn có chắc chắn muốn xóa toàn bộ sản phẩm?",
          text: "Lưu ý: Thao tác này sẽ xóa toàn bộ thông tin liên quan (bao gồm thông tin đơn hàng và hóa đơn...) Bạn có muốn xóa không?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/DeleteProductAll", function(result) {
              if (result) {
                swal("Đã xóa toàn bộ sản phẩm.!", {}).then(() => {
                  window.location.reload();;
                });

              } else
                swal("Xóa thất bại.!", {});
            })
          }
        });
    })
    $("#hotall").click(function() {
      swal({
          title: "Đặt tất cả sản phẩm thành HOT",
          text: "",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/HotAll", {
              hot: '1'
            }, function() {
              window.location.reload();;
            })
          }
        });
    })
    $("#unhotall").click(function() {
      swal({
          title: "Bỏ chọn HOT cho tất cả sản phẩm ?",
          text: "",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/HotAll", {
              hot: '0'
            }, function() {
              window.location.reload();;
            })
          }
        });
    })
    $("#sampleTable").on('click', '.hotcheck', function() {
      let check = 0;
      let id = $(this).closest("td").siblings("td.data-id").data('id');
      if ($(this).is(":checked"))
        check = 1;
      else check = 0;
      $.post("./Ajax/UpdateHot", {
        id: id,
        hot: check
      }, function() {})
    })
  </script>

</body>

</html>