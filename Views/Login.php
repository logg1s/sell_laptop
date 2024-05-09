<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin>
    <link rel="stylesheet" href="./lib/css/Login.css">
       
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Đăng nhập</h1>
        </div>
        <form method="post">
            <div class="form-group"> 
                <input type="text" name="username" id="username" required class="inputField"> <label for="username">Tài Khoản (Email hoặc Số điện thoại)</label> 
                <span class="warn">Vui lòng nhập email hoặc số điện thoại</span>
            </div>
            <div class="form-group"> 
                <input type="password" name="password" id="password" required class="inputField"> 
                <label for="password">Mật khẩu</label> 
                <span class="warn">Vui lòng nhập mật khẩu</span>
            </div> 
            <span class="warn" id='login_fail'></span>
            <button class="submitButton" name="btnLogin">Đăng nhập</button>
        </form>
        <div class="footer" style="display: flex; justify-content: space-between;"> <a href="./Register">Đăng ký</a> <a href="./Account">Quên mật khẩu</a></div>
	</div>
    </div>
</body>
<script>
    function CheckLogin() {
		var check = true;
		$(".container form input").each(function() {
			if ($(this).val().trim() == "") {
				$(this).css("border", "2px solid red");
				$(this).siblings("span").fadeIn();
				check = false;
			} else {
				$(this).css("border", "2px solid #1da1f2");
				$(this).siblings("span").fadeOut();
			}
		})

		if (!check)
			$('html, body').animate({
				scrollTop: $('.container .header h1').offset().top
			});
		return check;
	}
	//đổi màu border khi nhập
	$(document).ready(function() {
		$(".container form input").keyup(function() {
			if ($(this).val().trim() != "" && event.keyCode !== 13) {
				$(this).css("border", "2px solid #1da1f2");
				$(this).siblings("span").fadeOut();
				$("#login_fail").hide()
			}
		})
	})


	// Ajax đăng nhập
	$(document).ready(function() {
		$(".submitButton").click(function(event) {
			event.preventDefault();
			if (CheckLogin()) {
				let un = $("#username").val().trim();
				let pw = $("#password").val().trim();
				$.post("./Ajax/Login", {
					btnLogin: "co chuyen thua ngai",
					username: un,
					password: pw
				}, function(result) {
					let dialog = "";
					switch(result){
						case "0":
							$("#login_fail").hide()
							window.location.href = "./";
							return;
						case "1":
							dialog = "Tài khoản của bạn đang bị khóa.<br>Vui lòng liên hệ để được hỗ trợ !";
							break;
						case "-1":
							dialog = "Tài khoản chưa được kích hoạt.<br>Vui lòng truy cập email đã đăng kí để kích hoạt tài khoản !";
							break;
						default:
						dialog = "Tài khoản hoặc mật khẩu không chính xác !";
					}
                        $(".container form input").css("border", "2px solid red");
						$("#login_fail").html(dialog).show();
					
				})
			}
		})
	})
</script>
</html>

