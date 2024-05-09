<!DOCTYPE html>
<title>Đăng ký tài khoản</title>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib\font-awesome\css\all.css">
	<link rel="stylesheet" href="./lib/css/Login.css">
</head>

<body>
	<div class="container">
		<div class="header">
			<h1>Đăng ký tài khoản</h1>
		</div>
		<form autocomplete="off" method="post">
			<!-- <input type="hidden" name="table" value="user"> -->
			<div class="form-group">
				<input type="text" name="username" id="username" class="inputField" autocomplete="off" autofocus>
				<label for="username">Số điện thoại (6-15 kí tự)</label>
				<span class="warn">Vui lòng nhập số điện thoại</span>
			</div>

			<div class="form-group">
				<input type="password" name="password" id="password" class="inputField" autocomplete="off">
				<label for="password">Mật khẩu (tối thiểu 8 kí tự)</label>
				<span class="warn">Vui lòng nhập mật khẩu</span>
			</div>
			<div class="form-group">
				<input type="password" name="password2" id="password2" class="inputField" autocomplete="off">
				<label for="password2">Nhập lại mật khẩu</label>
				<span class="warn">Vui lòng nhập lại mật khẩu</span>
			</div>
			<div class="form-group">
				<input type="text" name="fullname" id="fullname" class="inputField" autocomplete="off">
				<label for="fullname">Họ tên</label>
				<span class="warn">Vui lòng nhập họ tên</span>
			</div>
			<div class="form-group">
				<input type="text" name="email" id="email" class="inputField" autocomplete="off">
				<label for="email">Email</label>
				<span class="warn">Vui lòng nhập email</span>
			</div>
			<button class="submitButton" name="btnRegister">Đăng ký</button>
		</form>
		<div class="footer" style="text-align: center"> <a href="./Login">Đăng nhập</a> </div>
	</div>
</body>
<script>
	// sự kiện khi ấn nút đăng ký
	function CheckRegister() {
		let check = true;
		
		$(".container form input").each(function() {
			if ($(this).val().trim() == "") {
				let id = $(this).attr("id");
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
		let un = $("#username").val().trim();
		let regexUsername = /^\d{6,15}$/;
		if (!regexUsername.test(un)) {
			check = false;
			$("#username").css("border", "2px solid red");
			$("#username").siblings("span").html("Vui lòng nhập lại số điện thoại hợp lệ<br>(6-15 ký tự)").fadeIn();
		}


		let em = $("#email").val().trim();
		let regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		if (!regexEmail.test(em)) {
			check = false;
			$("#email").css("border", "2px solid red");
			$("#email").siblings("span").text("Vui lòng nhập lại email hợp lệ").fadeIn();
		}

		let fn = $("#fullname").val().trim();
		
		let regexName = /^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*$/;
		if (!regexName.test(fn)) {
			check = false;
			$("#fullname").css("border", "2px solid red");
			$("#fullname").siblings("span").html("Vui lòng nhập lại tên hợp lệ<br>(Viết hoa chữ cái đầu - chỉ chứa kí tự là chữ)").fadeIn();
		}
	
		//check so dien thoai
		$.post("./Ajax/CheckUsername", {
			username: un
		}, function(result) {
			if (result) {
				check = false;
				$("#username").css("border", "2px solid red");
				$("#username").siblings("span").html("Số điện thoại này đã tồn tại.<br>Vui lòng nhập số khác !").fadeIn();
			}
		})

		
	
		$.post("./Ajax/CheckEmail", {
			email: em
		}, function(result) {
			if (result) {
				check = false;
				$("#email").css("border", "2px solid red");
				$("#email").siblings("span").html("Địa chỉ email này đã tồn tại.<br>Vui lòng nhập email khác !").fadeIn();
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
			if ($(this).val().trim() != "") {
				$(this).css("border", "2px solid #1da1f2");
				$(this).siblings("span").fadeOut();
			}
		})
	})

	// Ajax đăng ký
	$(document).ready(function() {
		$(".submitButton").click(function(event) {
			event.preventDefault();
			$check1 = CheckRegister();
			if ($check1) {
				Swal.fire({
					title: 'Đang kiểm tra thông tin...',
					text: 'Vui lòng chờ trong giây lát',
					showConfirmButton: false,
					// allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading()
						let un = $("#username").val().trim();
						let pw = $("#password").val().trim();
						let fn = $("#fullname").val().trim();
						let em = $("#email").val().trim();
						$.post("./Ajax/Register", {
							btnRegister: "dang ky ne",
							fullname: fn,
							password: pw,
							username: un,
							email: em
						}, function(result) {
							if (result) {
								Swal.close()
								Swal.fire({
									title: 'Đăng kí thành công',
									text: 'Vui lòng kiểm tra hòm thư email của bạn để kích hoạt tài khoản',
									icon: 'success'
								}).then((result) => {
									window.location.href = "./Login";
								})
							} else {
								Swal.close()
								

								// Swal.fire(
								// 	'Không thể hoàn tất đăng kí',
								// 	'Vui lòng kiểm tra lại thông tin',
								// 	'error'
								// )
							}

						})
					}
				})
			}
		})
	})
	//
</script>

</html>