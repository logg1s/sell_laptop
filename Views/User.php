<title>Thông tin tài khoản</title>
<style>
    #user_detail {
        width: 90%;
        display: flex;

        padding: 10px;
        font-size: 1.1rem;
        column-gap: 100px;
        justify-content: flex-start;
    }

    #user_detail_left {
        flex: 20%;
        border-right: 1px solid rgba(0, 0, 0, 0.2);
        border-left: 1px solid rgba(0, 0, 0, 0.2);
        height: 50%;
    }

    #user_detail_right {
        flex: 80%;
        border: 1px solid rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        /* justify-content: space-between; */
        
    }

    #user_detail_right #form_edit_user {

        width: 100%;
    }


    #form_edit_user input:not([type=file]) {
        width: 80%;
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
        object-fit: cover;
    }



    #table_order table {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }

    #table_order tr,
    #table_order td,
    #table_order th {
        /* display: none;  */
        font-size: .9rem;
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
    }

    #user_detail_right {
        /* display: none; */
    }

    #table_order {
        flex: 80%;
        text-align: center;
        font-size: 1rem;
        display: none;
    }

    .detail_userinfo,
    .detail_order {
        cursor: pointer;
    }

    #menu_userinfo {
        /* margin-top: 10px; */
        /* padding: 10px; */
        list-style-type: none;
        border-collapse: collapse;
        /* text-align: center; */
        /* border-radius: 10px; */
        /* border: 1px solid black; */
    }

    #menu_userinfo li {
        text-align: center;
    }

    .userinfo_savepassword {
        display: none;
    }
</style>
<main id="user">
    <div id="route">
        <a href="">Trang chủ</a>
        <span>/ Thông tin cá nhân</span>
    </div>

    <div id="user_detail">
        <div id="user_detail_left">
            <ul id="menu_userinfo">
                <li><i class="fa-solid fa-user"></i> Thông tin cá nhân</li>
       
                <li><a class="detail_order" href="./User/Order"><i class="fa-solid fa-square-list"></i> Đơn hàng của tôi</a></li>
            </ul>
        </div>

        <div id="user_detail_right">
            <h1 style="text-align: center">Thông tin cá nhân</h1>
            <form method="post" id="form_edit_user" enctype="multipart/form-data">
                <table width="100%">
                    <tr>
                        <td>Hình đại diện:</td>
                        <td id="showAvatar">
                            <a href="<?php echo $data['avatar'] ?>"><img src="<?php echo $data['avatar'] ?>" alt=""></a>
                            <form action="" method="post">
                                <input type="file" name='avatar' id='avatar' title="Đổi hình" accept="image/*">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Mật khẩu:</td>
                        <td>
                            <button id="updatePassword">Cập nhật</button>
                        </td>
                    </tr>
                    <tr class="userinfo_changepassword">
                        <td><span class="red_require">*</span>Họ và tên:</td>
                        <td>
                            <input type="text" name="fullname" id="fullname" required value="<?php echo $data['fullname'] ?>">
                            <br>
                            <span class="red">Vui lòng nhập họ và tên</span>
                        </td>
                    </tr>
                    <tr class="userinfo_changepassword">
                        <td><span class="red_require">*</span>Số điện thoại:</td>
                        <td>
                            <input type="text" name="username" id="phone" required data-phone="<?php echo $data["username"] ?>" value="<?php echo $data["username"] ?>">
                            <br>
                            <span class="red">Vui lòng nhập số điện thoại</span>
                        </td>
                    </tr>
                    <tr class="userinfo_changepassword">
                        <td><span class="red_require">*</span>Email:</td>
                        <td>
                            <input type="email" name="email" id="email" required data-email="<?php echo $data['email'] ?>" value="<?php echo $data['email'] ?>">
                            <br>
                            <span class="red">Vui lòng nhập email</span>
                        </td>
                    </tr>
                    <tr class="userinfo_changepassword">
                        <td>Ngày sinh:</td>
                        <td>
                            <input type="date" name="birthday" id="birthday" value="<?php echo $data['birthday'] ?>">
                        </td>
                        </td>
                    </tr>
                    <tr class="userinfo_changepassword">
                        <td>Địa chỉ:</td>
                        <td><input type="text" name="address" value="<?php echo $data['address'] ?>" id="address">
                    </tr>
                    <tr class="userinfo_changepassword">
                        <td></td>
                        <td><button id="saveInfo" name="btnsaveInfo">Lưu thay đổi</button>
                            <button id="cancel">Huỷ</button>
                        </td>
                    </tr>
                    <tr class="userinfo_savepassword">
                        <td><span class="red_require">*</span> Nhập mật khẩu cũ</td>
                        <td>
                            <input type="password" id="_old_password">
                            <br>
                            <span class="red">Vui lòng nhập mật khẩu cũ</span>
                        </td>
                    </tr>
                    <tr class="userinfo_savepassword">
                        <td><span class="red_require">*</span> Nhập mật khẩu mới</td>
                        <td>
                            <input type="password" id="_new_password1">
                            <br>
                            <span class="red">Vui lòng nhập mật khẩu mới</span>
                        </td>
                    </tr>
                    <tr class="userinfo_savepassword">
                        <td><span class="red_require">*</span> Nhập lại mật khẩu mới</td>
                        <td>
                            <input type="password" id="_new_password2">
                            <br>
                            <span class="red">Vui lòng nhập lại mật khẩu mới</span>
                        </td>
                    </tr>
                    <tr class="userinfo_savepassword">
                        <td></td>
                        <td><button id="savePassword" name="btnsaveInfo" style="background-color: green; color: white">Lưu thay đổi</button>
                            <button id="cancelsavepass">Huỷ</button>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</main>

<script src="./lib/js/js.js"></script>
<script>
    function CheckEdit() {
        let check = true;
        $("#form_edit_user td input:not([type=file])").each(function(index) {
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

        let fn = $("#fullname").val().trim();
		
		let regexName = /^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*$/;
		if (!regexName.test(fn)) {
			check = false;
			$("#fullname").css("border", "2px solid red");
			$("#fullname").siblings("span").html("Vui lòng nhập lại tên hợp lệ<br>(Viết hoa chữ cái đầu - chỉ chứa kí tự là chữ)").fadeIn();
		}

        $.ajaxSetup({
            async: false
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
        let regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		if (!regexEmail.test(em)) {
			check = false;
			$("#email").css("border", "2px solid red");
			$("#email").siblings("span").text("Vui lòng nhập lại email hợp lệ").fadeIn();
		}
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

        $("#form_edit_user #cancel").click(function(event) {
            event.preventDefault()
            window.location.reload()
        })
    })



    $("#saveInfo").click(function(event) {
        event.preventDefault()
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
                    if (result)
                    Swal.fire("Cập nhật thông tin thành công", '', 'success').then((result)=>{
                        window.location = window.location
                    })
                else Swal.fire("Cập nhật thông tin thất bại", '', 'error')
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
                    } else Swal.fire("Avatar không hợp lệ", '', 'error')
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })

        }
    })



    $("#updatePassword").click(function(event) {
        event.preventDefault();
        $(".userinfo_changepassword").hide();
        $(".userinfo_savepassword").show();
    })
    $("#cancelsavepass").click(function() {
        event.preventDefault();
        $(".userinfo_savepassword").hide();
        $(".userinfo_changepassword").show();
    })


    function CheckPassword() {
        var check = true;
        $(".userinfo_savepassword input").each(function() {
            if ($(this).val().trim() == "") {
                let id = $(this).attr("id");
                $(this).css("border", "2px solid red");
                $(this).siblings("span").fadeIn();
                check = false;

            } else {
                $(this).css("border", "2px solid black");
                $(this).siblings("span").fadeOut();
            }
        })
        let pw = $("#_old_password").val().trim();
        let password1 = $("#_new_password1").val().trim();
        let password2 = $("#_new_password2").val().trim();
        if (password1 !== password2) {
            check = false;
            $("#_new_password2").css("border", "2px solid red");
            $("#_new_password2").siblings("span").text("Vui lòng nhập lại mật khẩu trùng khớp").fadeIn();
        }
        if (password1.length < 8) {
            check = false;
            $("#_new_password1").css("border", "2px solid red");
            $("#_new_password1").siblings("span").text("Vui lòng nhập mật khẩu tối thiểu 8 kí tự").fadeIn();
        }

        $.ajax({
            url: './Ajax/CheckPassword',
            data: {
                password: pw
            },
           async: false,
           type: 'POST',
            success:  function(result) {
            if (!result) {
                check = false;
                $("#_old_password").css("border", "2px solid red");
                $("#_old_password").siblings("span").text("Vui lòng nhập lại mật khẩu cũ chính xác").fadeIn();
            }
        }
    })

        if (!check)
            $('html, body').animate({
                scrollTop: $('#user_detail_right').offset().top
            });
        return check;
    }
    //đổi màu border khi nhập
    $(document).ready(function() {
        $(".userinfo_savepassword input").keyup(function() {
            if ($(this).val().trim() != "") {
                $(this).css("border", "2px solid black");
                $(this).siblings("span").fadeOut();
            }
        })
    })

    $("#savePassword").click(function(event) {
        event.preventDefault();
        if (CheckPassword()) {
            let pw = $("#_new_password1").val().trim();
            $.post("./Ajax/UpdatePassword", {
                btnsaveInfo: "co chuyen",
                password: pw
            }, function(result) {
                if (result)
                    Swal.fire("Đổi mật khẩu thành công", '', 'success').then((result)=>{
                        window.location = window.location
                    })
                else Swal.fire("Đổi mật khẩu thất bại", '', 'error')
            })
        }
    })
</script>