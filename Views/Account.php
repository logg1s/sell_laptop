<!DOCTYPE html>
<title><?php echo $data['title'] ?></title>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="./lib/css/Login.css">
</head>

<body>
    <?php if ($data['status'] == "") { ?>
        <div class="container">
            <div class="header">
                <h1>Quên mật khẩu</h1>
            </div>
            <form method="post">
                <!-- <input type="hidden" name="table" value="user"> -->
                <div class="form-group">
                    <input type="text" name="account" id="account" class="inputField">
                    <label for="account">Số điện thoại hoặc email</label>
                    <span class="warn">Vui lòng nhập số điện thoại hoặc email</span>
                </div>
                <button class="submitButton resetPassword">Lấy lại mật khẩu</button>
            </form>
            <div class="footer" style="text-align: center">
                <a href="./Login">Đăng nhập</a>
            </div>
        </div>
    <?php } else if ($data['status'] == "notification") { ?>
        <main style="display: flex;align-items: center; justify-content: center;">
            <div style="text-align: center;">

                <?php echo $data['content']; ?>
            </div>
        </main>
    <?php } else { ?>


        <p style="text-align: center; font-size: 2rem; font-weight: 600">Khôi phục mật khẩu cho tài khoản "<?php echo $data['user']['username'] ?>"</p>
        <div class="container">
            <form autocomplete="off" method="post">
                <!-- <input type="hidden" name="table" value="user"> -->
                <input type="hidden" id="username" value="<?php echo $data['user']['username'] ?>">
                <div class="form-group">
                    <input type="password" name="password" id="password" class="inputField" autocomplete="off">
                    <label for="password">Mật khẩu mới (tối thiểu 8 kí tự)</label>
                    <span class="warn">Vui lòng nhập mật khẩu</span>
                </div>
                <div class="form-group">
                    <input type="password" name="password2" id="password2" class="inputField" autocomplete="off">
                    <label for="password2">Nhập lại mật khẩu</label>
                    <span class="warn">Vui lòng nhập lại mật khẩu</span>
                </div>
                <button class="submitButton changePassword" name="btnForgotPassword">Đổi mật khẩu</button>
            </form>
        </div>

    <?php } ?>

</body>
<script>
    // sự kiện khi ấn nút đăng ký
    $.ajaxSetup({
        async: false
    })

    function CheckAccount() {
        let check = true;
        $(".container form input").each(function() {
            if ($(this).val().trim() == "") {
                // let id = $(this).attr("id");
                $(this).css("border", "2px solid red");
                $(this).siblings("span").fadeIn();
                check = false;

            } else {
                $(this).css("border", "2px solid #1da1f2");
                $(this).siblings("span").fadeOut();
            }
        })
        // let regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        // if (!regexEmail.test(em)) {
        //     check = false;
        //     $("#email").css("border", "2px solid red");
        //     $("#email").siblings("span").text("Vui lòng nhập lại email hợp lệ").fadeIn();
        // }
        let account = $("#account").val().trim();
        $.post("./Ajax/CheckAccount", {
            account: account
        }, function(result) {
            if (!result) {
                check = false;
                $("#account").css("border", "2px solid red");
                $("#account").siblings("span").text("Thông tin tài khoản không tồn tại. Vui lòng kiểm tra lại").fadeIn();
            }
        })

        if (!check)
            $('html, body').animate({
                scrollTop: $('.container .header h1').offset().top
            });
        return check;
    }

    function CheckPassword() {
        let check = true;
        $(".container form input").each(function() {
            if ($(this).val().trim() == "") {
                // let id = $(this).attr("id");
                $(this).css("border", "2px solid red");
                $(this).siblings("span").fadeIn();
                check = false;

            } else {
                $(this).css("border", "2px solid #1da1f2");
                $(this).siblings("span").fadeOut();
            }
        })
        let password = $("#password").val().trim();
        let password2 = $("#password2").val().trim();
        if (password !== password2) {
            check = false;
            $("#password2").css("border", "2px solid red");
            $("#password2").siblings("span").text("Vui lòng nhập lại mật khẩu trùng khớp").fadeIn();
        }
        if (password.length < 8) {
            check = false;
            $("#password").css("border", "2px solid red");
            $("#password").siblings("span").text("Vui lòng nhập mật khẩu tối thiểu 8 kí tự").fadeIn();
        }

        if (!check)
            $('html, body').animate({
                scrollTop: $('.container .header h1').offset().top
            });
        return check;
    }
    $(document).ready(function() {
        $(".container form input").keyup(function() {
            if ($(this).val().trim() != "") {
                $(this).css("border", "2px solid #1da1f2");
                $(this).siblings("span").fadeOut();
            }
        })
    })


    $(".resetPassword").click(function(event) {
        event.preventDefault()
        if (CheckAccount()) {
            Swal.fire({
                title: 'Đang kiểm tra...',
                text: 'Vui lòng chờ trong giây lát',
                showConfirmButton: false
            })
            let account = $("#account").val().trim();
            $.post("./Ajax/ForgotPassword", {
                btnForgotPassword: "kp",
                account: account
            }, function(result) {
                if (result) {
                    Swal.fire({
                        title: 'Đã gửi email khôi phục',
                        text: 'Vui lòng kiểm tra hòm thư email của bạn trong vòng 10 phút',
                        icon: 'info'
                    }).then((result) => {
                        window.location.href = "./Login"
                    })
                } else {
                    Swal.fire(
                        'Không thể gửi email xác nhận',
                        'Vui lòng kiểm tra lại địa chỉ email',
                        'error'
                    )
                }
            })

        }
    })
    $(".changePassword").click(function(event) {
        event.preventDefault()
        if (CheckPassword()) {
            let username = $("#username").val().trim()
            let password = $("#password").val().trim()
            $.post("./Ajax/RecoverPassword", {
                username: username,
                password: password
            }, function(result) {
                if (result) {
                    Swal.fire({
                        title: 'Khôi phục mật khẩu thành công',
                        showDenyButton: true,
                        confirmButtonText: 'Đăng Nhập',
                        confirmButtonColor: '#50a679',
                        denyButtonText: `Về Trang Chủ`,
                        denyButtonColor: '#6191a4',
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "./Login"
                        } else if (result.isDenied) {
                            window.location.href = ""
                        }
                    })
                }
            })
        }
    })
</script>

</html>