<title>Đơn hàng của tôi</title>
<link rel="stylesheet" href="./lib/dataTables/jquery.dataTables.min.css">
<style>
   #user_detail {
        display: flex;
        padding: 10px;
        font-size: 1.1rem;
        column-gap: 50px;
        /* justify-content: space-between; */
    }

    #user_detail_left {
        flex: 15%;
        border-right: 1px solid rgba(0, 0, 0, 0.2);
        border-left: 1px solid rgba(0, 0, 0, 0.2);
        height: 50%;

    }
    #table_order {
        flex: 85%;
        text-align: center;

    }


    #user_detail_right #form_edit_user {
        /* flex: 50%; */
        /* min-width: 50%; */
        width: 100%;
    }


    #form_edit_user input:not([type=file]) {
        width: 100%;
        min-height: 30px;
        border-radius: 3px;
        border: 1px solid #262729;
        /* outline: none; */
        padding: 10px;
    }

    #form_edit_user tr td {
        padding: 10px;
    }

    #form_edit_user button {
        padding: 10px;
        cursor: pointer;
        border: none;
        border-radius: 3px;
    }

    #form_edit_user .red {
        color: red;
        display: none;
    }

    #form_edit_user #saveInfo {
        background-color: #cd1818;
        color: white;
    }

    #form_edit_user #showAvatar {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #form_edit_user #showAvatar img {
        max-height: 200px;
        width: 200px;
        border-radius: 50%;
        object-fit: cover;
    }



    #table_order table {
        border: 1px solid rgba(0, 0, 0, 0.2);
        width: 100%;
        border-radius: 5px;
    }
    table tr{
        background-color: rgba(0, 0, 0, 0.2);
    }

    #table_order tr,
    #table_order td,
    #table_order th {
        /* display: none;  */
        font-size: .9rem;
        padding: 5px;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }



  

    .detail_userinfo,
    .detail_order {
        cursor: pointer;
    }

    #menu_userinfo {
        /* margin-top: 10px; */
        list-style-type: none;
        border-collapse: collapse;
        text-align: center;
        /* border-radius: 10px; */
        /* border: 1px solid black; */
    }

    /* #menu_userinfo li{
        padding:  0 10px 0 30px;
        } */
</style>
<main id="user">
    <div id="route">
        <a href="">Trang chủ</a>
        <span>/ Đơn hàng của tôi</span>
    </div>

    <div id="user_detail">
        <div id="user_detail_left">
            <ul id="menu_userinfo">
                <li><a class="detail_userinfo" href="./User"><i class="fa-solid fa-user"></i>   Thông tin cá nhân</a></li>
                <li><i class="fa-solid fa-square-list"></i>   Đơn hàng của tôi</li>
            </ul>
        </div>
        <div id="table_order">
            <h1>Đơn hàng</h1>
            <table width="100%" id="order_tables">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Kiểu thanh toán</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái</th>
                    <th>Ngày hoàn thành</th>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                <?php $index = 0;
                foreach ($data["order"] as $table) {
                    $index++; ?>
                    <tr>
                        <td><?php echo $index ?></td>
                        <td><a href="./Detail/<?php echo $this->TitleHandle($table["title"], 0) ?>"><?php echo "<img src='$table[thumbnail]' height='100' style='display: block; margin: auto'>" . $table["title"] ?></a> </td>
                        <td><?php echo $table["num"] ?></td>
                        <td><?php echo $table["payment_method"]?></td>
                        <td style="color: red; font-weight: bold"><?php echo $this->MoneyHandle($table["total_money"]) ?> VNĐ</td>
                        <td class='orderdate' data-date='<?php echo $table["order_date"] ?>'><?php echo $table["order_date"] ?></td>
                        <td data-status="<?php echo $table['status'] ?>" class="td-status">
                            <input type="hidden" data-id="<?php echo $table['id'] ?>">
                            <?php echo $this->Status($table["status"]) ?>
                        </td>
                        <td><?php echo $table["finish_date"]?></td>
                        <td><?php echo $table["fullname"] ?></td>
                        <td><?php echo $table["phone_number"] ?></td>
                        <td><?php echo $table["address"] ?></td>
                        <td><?php echo $table["note"] ?></td>
                        <td><button class="cancel_order" <?php if($table['status'] != '0') echo 'disabled' ?>>Hủy</button></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="./lib/dataTables/jquery.dataTables.min.js">
</script>
<script>
    let table = new DataTable("#order_tables",{
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
            }]
            
    })
</script>
<script src="./lib/js/js.js"></script>
<script>
    function CheckEdit() {
        $.ajaxSetup({
            async: false
        })
        var check = true;
        $("#form_edit_user td input").each(function(index) {
            if (index < 3) {
                let input = $(this).val().trim();
                if (input == "") {
                    $(this).css("border", "1px solid red");
                    $(this).siblings("span").fadeIn();
                    check = false;
                } else {
                    $(this).css("border", "1px solid black");
                    $(this).siblings("span").fadeOut();
                }
            }
        })
        let un = $("#phone").val().trim();
        if (un != $("#phone").data("phone")) {
            let regexUsername = /^\d{6,15}$/;
            if (!regexUsername.test(un)) {
                check = false;
                $("#phone").css("border", "2px solid red");
                $("#phone").siblings("span").text("Vui lòng nhập lại số điện thoại hợp lệ (6-15 ký tự)").fadeIn();
            }
            $.post("./Ajax/CheckUsername", {
                username: un
            }, function(result) {
                if (result) {
                    check = false;
                    $("#phone").css("border", "2px solid red");
                    $("#phone").siblings("span").text("Số điện thoại này đã tồn tại. Vui lòng nhập số khác").fadeIn();
                }
            })
        }



        let em = $("#email").val().trim();
        if (em != $("#email").data("email")) {
            $.post("./Ajax/CheckEmail", {
                email: em
            }, function(result) {
                if (result) {
                    check = false;
                    $("#email").css("border", "2px solid red");
                    $("#email").siblings("span").text("Địa chỉ email này đã tồn tại. Vui lòng nhập email khác").fadeIn();
                }
            })
        }

        if (!check)
            $('html, body').animate({
                scrollTop: $('#user_detail').offset().top
            });
        return check;
    }

    $(document).ready(function() {
        $("#form_edit_user td input").keyup(function() {
            if ($(this).val().trim() != "") {
                $(this).css("border", "2px solid black");
                $(this).siblings("span").fadeOut();
            }
        })

        $("#form_edit_user #cancel").click(function() {
            window.location = window.location;
        })
    })



    $("#saveInfo").click(function() {
        event.preventDefault();
        if (CheckEdit()) {
            let formValues = $("#form_edit_user").serializeArray();
            let formData = new FormData();

            $.each(formValues, function(index, field) {
                formData.append(field.name, field.value);
            })
            formData.append('btnsaveInfo', "thua ngai co lenh update ne");
            $.ajax({
                url: './Ajax/UpdateUser',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result) {
                        alert("Cập nhật thông tin thành công");
                        window.location = window.location;
                    } else alert("Thông tin chưa được cập nhật. Vui lòng kiểm tra lại");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    })

    $("#avatar").change(function() {
        let avatar = $('input[type=file]')[0];
        if (avatar) {
            let formData = new FormData();
            formData.append('avatar', avatar.files[0]);
            $.ajax({
                url: './Ajax/UpdateUser',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result) {
                        window.location = window.location;
                    } else alert("Avatar không hợp lệ");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })

        }
    })



    // $(".cancel_order").each(function() {
    //     let status = $(this).parent().siblings(".td-status").data("status");
    //     if (status != 0)
    //         $(this).prop("disabled", "true");
    // })



    $("#order_tables").on('click','.cancel_order',function(event) {
        event.preventDefault();
        var stt = $(this).parent().siblings(".td-status").data("status");
        var oid = $(this).parent().siblings(".td-status").children("input").data("id");
        var datetime = $(this).parent().siblings(".orderdate").data("date");
        var btn = $(this);
        if (stt != 0)
            alert("Thao tác không chính xác !");
        else {
            if (confirm("Bạn có muốn hủy đơn hàng này ?")) {
                $.post("./Ajax/CancelOrder", {
                    status: stt,
                    id: oid,
                    datetime: datetime
                }, function(result) {
                    if (result) {
                        window.location = window.location;
                        btn.prop("disabled", "false");
                    } else
                        alert("thất bại");
                })
            }
        }
    })
</script>