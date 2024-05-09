<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quản Lý Tài Khoản | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <style>
   

    .red_require {
      color: red;
    }
  </style>

</head>

<body onload="time()" class="app sidebar-mini rtl">

  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Quản lý tài khoản</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" title="Thêm"><i class="fas fa-plus"></i>
                  Thêm tài khoản</a>
              </div>
              <!-- 
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i class="fas fa-file-upload"></i> Tải từ file</a>
              </div> -->

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm" id='deleteAll' #922type="button" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa tất cả </a>
              </div>
            </div>

            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <!-- <th width="10"><input type="checkbox" id="all"></th> -->
                  <th>STT</th>
                  <th>Tài khoản (số điện thoại)</th>
                  <th>Họ tên</th>
                  <th>Email</th>
                  <th>Địa chỉ</th>
                  <th>Ngày sinh</th>
                  <th>Ngày tạo</th>
                  <th>Truy cập lần cuối</th>
                  <th>Vai trò</th>
                  <th>Trạng thái</th>
                  <th>Tính năng</th>
                </tr>
              </thead>
              <tbody>
                <?php for($i=0; $i< count($data['user']);$i++) { ?>
                  <tr>
                    <td><?php echo $i + 1?></td>
                    <td class = "data-username" data-username="<?php echo $data['user'][$i]['username'] ?>" style="text-align: left;">
                      <img src="<?php echo BaseController::Client() . $data['user'][$i]['avatar'] ?>" alt="" height='50'>

                      <?php echo $data['user'][$i]['username'] ?>
                    </td>
                    <td>
                      <?php echo $data['user'][$i]['fullname'] ?>
                    </td>
                    <td><?php echo $data['user'][$i]['email'] ?></td>
                    <td style="text-align: left;"><?php echo $data['user'][$i]['address'] ?></td>
                    <td><?php echo $data['user'][$i]['birthday'] ?></td>
                    <td><?php echo $data['user'][$i]['created_at'] ?></td>
                    <td><?php echo $data['user'][$i]['datetime'] ?></td>
                    <td style="text-align: left;"><?php if ($data['user'][$i]['role_id'] == '1') echo "Khách hàng";
                                                  else if ($data['user'][$i]['role_id'] == '2') echo "<span class='badge bg-info'>Quản trị</span>" ?></td>
                    <td><?php if ($data['user'][$i]['deleted'] == "1") echo "<span class='badge bg-danger'>Bị khóa</span>";
                        else if ($data['user'][$i]['deleted'] == "-1")
                          echo "<span class='badge bg-warning'>Chưa kích hoạt</span>";
                        else
                          echo "<span class='badge bg-success'>Hoạt động</span>" ?>
                    <td>
                      <button class="btn btn-primary btn-sm trash" type="button" title="Xóa" onclick=""><i class="fas fa-trash-alt delete"></i>
                      </button>
                      <!-- <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"><i class="fas fa-edit"></i></button> -->
                      <button class="btn btn-primary btn-sm reset" type="button" title="Khôi phục mật khẩu" id="show-emp"><i class="fas fa-key"></i></button>
                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"><i class="fas fa-edit"></i></button>
                      <?php if ($data['user'][$i]['deleted'] == "1") { ?>
                        <button class="btn btn-success btn-sm unban" type="button" title="Mở khóa" id="show-emp"><i class="fas fa-unlock"></i></button>
                      <?php } else if($data['user'][$i]['deleted'] == "0") { ?>
                        <button class="btn btn-primary btn-sm ban" type="button" title="Khóa" id="show-emp"><i class="fas fa-lock"></i></button>

                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
            <!-- <a class="btn btn-danger btn-sm" id='deleteAll' type="button" title="Xóa" onclick=""><i class="fas fa-trash-alt"></i> Xóa tất cả </a> -->
            <div id="create-new-user" style="display: none">
              <table>
                <tr>
                  <td><span class="red_require">*</span>Tên người dùng</td>
                  <td><input type="text" required placeholder="Nhập tên người dùng đăng nhập" id="username"></td>
                </tr>
                <tr>
                  <td><span class="red_require">*</span>Mật khẩu</td>
                  <td><input type="password" required placeholder="Nhập mật khẩu đăng nhập" id="password"></td>
                </tr>
                <tr>
                  <td>Vai trò</td>
                  <td><select id="role_id">
                      <option value="1">Người dùng</option>
                      <option value="2">Quản trị</option>
                    </select> </td>
                </tr>
                <tr>
                  <td>Họ tên</td>
                  <td><input type="text" placeholder="Nhập họ tên" id="fullname"></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><input type="email" id="email" placeholder="Nhập email"></td>
                </tr>
                <tr>
                  <td>Địa chỉ</td>
                  <td><input type="text" id="address" placeholder="Nhập địa chỉ"></td>
                </tr>
                <tr>
                  <td>Ngày sinh</td>
                  <td><input type="date" id="birthday" placeholder="Nhập ngày sinh"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><button id="create-account" style="background-color: green; color: white">Thêm</button>
                    <button class="cancel-account">Hủy</button>
                  </td>
                </tr>
              </table>
            </div>


            <div id="edit-user" style="display: none">
              <table>
                <tr>
                  <td><span class="red_require">*</span>Tên người dùng(SĐT)</td>
                  <td><input type="text" required placeholder="Nhập tên người dùng đăng nhập" id="username1" data-username=""></td>
                </tr>
                <tr>
                  <td>Vai trò</td>
                  <td><select id="role_id1">
                      <option value="1">Người dùng</option>
                      <option value="2">Quản trị</option>
                    </select> </td>
                </tr>
                <tr>
                  <td>Họ tên</td>
                  <td><input type="text" placeholder="Nhập họ tên" id="fullname1"></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><input type="email" id="email1" placeholder="Nhập email"></td>
                </tr>
                <tr>
                  <td>Địa chỉ</td>
                  <td><input type="text" id="address1" placeholder="Nhập địa chỉ"></td>
                </tr>
                <tr>
                  <td>Ngày sinh</td>
                  <td><input type="date" id="birthday1" placeholder="Nhập ngày sinh"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><button id="edit-account" style="background-color: green; color: white">Cập nhật</button>
                    <button class="cancel-account">Hủy</button>
                  </td>
                </tr>
              </table>
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
      order: [
        [6, 'desc']
      ],
      "columnDefs": [{
        "className": "dt-center",
        "targets": "_all"
      }]
    });
  </script>
  <script>
    // function deleteRow(r) {
    //   var i = r.parentNode.parentNode.rowIndex;
    //   document.getElementById("myTable").deleteRow(i);
    // }

    $("#sampleTable").on('click', '.trash', function() {
      let username = $(this).parent().siblings("td.data-username").data("username");
      swal({
          title: "Cảnh báo",

          text: "Bạn có chắc chắn là muốn xóa tài khoản này?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/DeleteUser", {
              username: username
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




    $("#deleteAll").click(function() {
      swal({
          title: "Xóa tất cả tài khoản ??",
          text: "Lưu ý: Thông tin liên quan đến tài khoản này sẽ bị xóa. Bạn có muốn xóa không ?",
          buttons: ["Hủy bỏ", "Đồng ý"],
        })
        .then((willDelete) => {
          if (willDelete) {
            $.post("./Ajax/DeleteAllUser", function(result) {
              if (result) {
                swal("Đã xóa toàn bộ tài khoản !", {}).then(() => {
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
  </script>
  <script>
    $("a.btn-add").click(function() {
      $('table').parents('div.dataTables_wrapper').first().hide();
      $("#create-new-user").fadeIn();
      $("#edit-user").fadeOut();
      $(".element-button").hide();
    })
    $(".cancel-account").click(function() {
      $("#create-new-user").fadeOut();
      $("#edit-user").fadeOut();
      $(".element-button").show();
      $('table').parents('div.dataTables_wrapper').first().fadeIn();
    })
    $("#sampleTable").on('click', 'button.edit', function() {
      $('table').parents('div.dataTables_wrapper').first().hide();
      $("#edit-user").fadeIn();
      $("#create-new-user").fadeOut();
      $(".element-button").hide();
      let username = $(this).parent().siblings("td.data-username").data("username");
      $.post("./Ajax/LoadInfoUser", {
        username: username
      }, function(result) {
        $("#username1").val(result.username);
        $("#username1").attr("data-username", result.username);
        $("#role_id1").val(result.role_id);
        $("#fullname1").val(result.fullname);
        $("#email1").val(result.email);
        $("#address1").val(result.address);
        $("#birthday1").val(result.birthday);
      }, "json")
    })
    $("button#edit-account").click(function() {
      let username_new = $("#username1").val().trim();
      let username = $("#username1").data("username");
      let role_id = $("#role_id1").val();
      let fullname = $("#fullname1").val().trim();
      let email = $("#email1").val().trim();
      let address = $("#address1").val().trim();
      let birthday = $("#birthday1").val();
      if (username == "" || role_id == "") {
        alert(" ❌❌ Vui lòng nhập các thông tin bắt buộc")
      } else {
        $.post("./Ajax/EditUser", {
          username: username,
          username_new: username_new,
          role_id: role_id,
          fullname: fullname,
          email: email,
          address: address,
          birthday: birthday
        }, function(result) {
          if (result) {
            alert("✅ Chỉnh sửa thành công ✅");
            window.location.reload();
          } else alert("❌ Không thể cập nhật thay đổi\n❔ Tên người dùng hoặc email đã tồn tại");
        })
      }
    })


    $("#create-account").click(function() {
      let username = $("#username").val().trim();
      let password = $("#password").val().trim();
      let role_id = $("#role_id").val();
      let fullname = $("#fullname").val().trim();
      let email = $("#email").val().trim();
      let address = $("#address").val().trim();
      let birthday = $("#birthday").val().trim();
      if (username == "" || password == "" || role_id == "") {
        alert(" ❌❌ Vui lòng nhập các thông tin bắt buộc")
      } else {
        $.post("./Ajax/CreateUser", {
          username: username,
          password: password,
          role_id: role_id,
          fullname: fullname,
          email: email,
          address: address,
          birthday: birthday
        }, function(result) {
          if (result) {
            alert("✅ Thêm tài khoản thành công ✅");
            window.location.reload();
          } else alert("❌ Thêm tài khoản không thành công\n❔ Tên người dùng hoặc email đã tồn tại");
        })
      }
    })

    $("#sampleTable").on('click', 'td button.ban', function() {
      let username = $(this).parent().siblings("td.data-username").data("username")
      if (confirm("🔒Khóa tài khoản " + username + " ? 🔒")) {
        $.post("./Ajax/BanUnban", {
          username: username,
          ban: '1'
        }, function(result) {
          if (result)
          window.location.reload();
          else alert("❌ Thất bại")
        })
      }

    })

    $("#sampleTable").on('click', 'td button.unban', function() {
      let username = $(this).parent().siblings("td.data-username").data("username")
      if (confirm("🔓Mở khóa tài khoản " + username + " 🔓 ?")) {
        $.post("./Ajax/BanUnban", {
          username: username,
          ban: "0"
        }, function(result) {
          if (result)
          window.location.reload();
          else alert("❌ Thất bại")
        })
      }
    })
    $("#sampleTable").on('click', 'td button.reset', function() {
      let username = $(this).parent().siblings("td.data-username").data("username")
      if (confirm("🗝️ Khôi phục mật khẩu cho " + username + " ? 🗝️")) {
        $.post("./Ajax/ResetPassword", {
          username: username,
        }, function(result) {
          if (result) {
            alert("🔐✅ Đã khôi phục thành công")
            window.location.reload();
          } else alert("❌ Thất bại")
        })
      }
    })
  </script>
  <style>
    #create-new-user button,
    #edit-user button {
      border: 1px solid rgba(0, 0, 0, 0.6);
      cursor: pointer;
      padding: 5px;
      border-radius: 5px;
    }

    #edit-user input,
    #create-new-user input {
      border: 1px solid rgba(0, 0, 0, 0.5);
      border-radius: 5px;
      padding: 5px;
      width: 70%
    }
  </style>
</body>

</html>