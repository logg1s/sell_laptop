	<link rel="stylesheet" href="./lib/sweetalert2/sweetalert2.min.css">
	<title>Đặt hàng</title>
	<main id='checkoutScreen'>
		<input type="hidden" value="<?php echo $this->login__status ?>" id="login_status">
		<div class="checkout">
			<div class="checkout__1">
				<h3>Điền thông tin mua hàng</h3>
				<div>
					<p><span class="red_require">* </span>Họ và tên:</p>
					<input type="text" id='name' required value='<?php echo $data['user']['fullname'] ?? "" ?>' class='input_require OI'>
					<span class="warn">Vui lòng nhập họ tên</span>
				</div>
				<div>
					<p><span class="red_require">* </span>Số điện thoại:</p>
					<input type="text" required id='phone' value='<?php echo $data['user']['username'] ?? "" ?>' class='input_require OI'>
					<span class="warn">Vui lòng nhập số điện thoại</span>
				</div>
				<div>
					<p><span class="red_require">* </span>Địa chỉ:</p>
					<textarea required rows="5" cols="50" id='address' class='input_require OI'><?php echo $data['user']['address'] ?? "" ?></textarea>
					<span class="warn">Vui lòng nhập địa chỉ</span>
				</div>
				<div>
					<p><span class="red_require">* </span>Email:</p>
					<input type="email" value='<?php echo $data['user']['email'] ?? "" ?>' id='email' class="input_require OI">
					<span class="warn">Vui lòng nhập email</span>
				</div>
				<div>
					<p>Ghi chú:</p>
					<textarea rows="4" cols="50" id='note' class="OI"><?php echo $data['user']['note'] ?? "" ?></textarea>
				</div>
			</div>


			<div class="checkout__3">
				<div>
					<h2 style='text-align: center; margin-bottom: 10px'>Đơn hàng</h2>
					<?php
					foreach ($data['checkout'] as $row) {
						$currency = $this->MoneyHandle($row['price_out']);
						$product = $this->TitleHandle($row['title'], 0);
						$number = $row['cart_num'] ?? $data['number'];
						echo "
						<a href = './Detail/$product' class='checkout-item'>
							<img src='$row[thumbnail]' height='100'>
							<div>
								<div style='padding-right: 10px'> 
								<p style='flex: 30%; font-weight: 600;color: blue';>$row[title]</p>
								<p style='color: black; font-size: .9rem'>
								";
						if (!empty($row['cpu'])) echo "<u>" . $row['cpu'] . "</u> &nbsp;";
						if (!empty($row['ram'])) echo "<u>" . $row['ram'] . "GB</u> &nbsp;";
						if (!empty($row['storage'])) echo "<u>" . $row['storage'] . "GB</u> &nbsp;";
						if (!empty($row['screen'])) echo "<u>" . $row['screen'] . " inch</u> &nbsp;";
						if (!empty($row['os'])) echo "<u>" . $row['os'] . "</u> &nbsp;";
						echo "</p>
								</div>
								<div class='priceNnum'>
								<input type='hidden' data-id = '$row[id]' data-num = '$number'>
									<div>
									<div style='display: flex; align-item: center; column-gap: 10px;'>
									<p style='font-size: 1.1rem; '>$currency" . "đ</p>
									<p data-number='$number'>x$number</p>
									</div>
									
									</div>
										<div>=
										<p style='color: grey;font-size: 1.2rem;'>" . $this->MoneyHandle($row['total'] ?? $row['price_out'] * $number) . "đ</p>
										</div>
								</div>
							</div>
						
						</a>
						";
					}
					?>
					<!-- <div class='checkout__3-1'>
						<div>
							<p>Tạm tính:</p>
						</div>
						<div>
							<p style='color: orange;font-size: 1.3rem'>
								<//?php echo $data['total'] ?>
								đ</p>
						</div>

					</div> -->
					<div class='checkout__3-2'>
						<h2 style='font-weight: bold'>TỔNG SỐ TIỀN:</h2>
						<p class='price__VND'>
							<sup><?php echo $this->MoneyHandle($data['total']) ?>đ</sup>
						</p>
					</div>
					<span style='float:right'>(<?php echo $data['vndtext'] ?>)</span>
				</div>
				<div class="checkout__3-3">
					<input type="hidden" name="payment_method" value="<?php echo $data['payment_method'] ?>">
					<input type="hidden" name="payment_result" value="<?php echo $data['payment_result'] ?>">
					<input type="hidden" name="payment_id" value="<?php echo $data['payment_id'] ?>">
					<button id='checkout_ordernow' value='<?php echo $data['buyone'] ?>'>
						<h3>ĐẶT HÀNG NGAY (Thanh toán khi nhận hàng)</h3>
					</button>
					<form method="POST" enctype="application/x-www-form-urlencoded" action="./Payment/Momo">
						<input type="hidden" name="allOrderID">
						<input type="hidden" name="redirectUrl">
						<input type="hidden" id="get_num" value='<?php echo $_GET['num'] ?>'>
						<input type="hidden" id="get_id" value='<?php echo $_GET['id'] ?>'>
						<button class='bthPayment' name='requestType' value='captureWallet' style="border: 1px solid #b0006e;">
							<span style="margin-right: 10px">Thanh toán bằng mã QR với Momo </span> <img src="./Views/Shared/img/momo.svg" alt="momo logo" width="30">
							<br>
							<button class='bthPayment' name='requestType' value='payWithATM' style="border: 1px solid #b0006e;">
								<span style="margin-right: 10px">Thanh toán qua thẻ ATM với Momo </span> <img src="./Views/Shared/img/momo.svg" alt="momo logo" width="30">
							</button>
					</form>
					<button onclick="history.back()" id="backorder">
						< Quay về</button>
				</div>
			</div>
		</div>
	</main>
	<script src='./lib/jquery/jquery.min.js'></script>
	<script src='./lib/js/js.js'></script>
	<script src='./lib/sweetalert2/sweetalert2.all.min.js'></script>

	<script>
		function UpdateRedirect() {
			let name = $("#name").val();
			let phone = $("#phone").val();
			let address = $("#address").val();
			let email = $("#email").val();
			let note = $("#note").val();
			$("input[name=redirectUrl]").val(window.location.href + `&fullname=${name}&username=${phone}&address=${address}&email=${email}&note=${note}`)
		}
		$(".OI").change(UpdateRedirect)
		$(document).ready(function() {
			let arr = [];
			$(".priceNnum input[type='hidden']").each(function() {
				arr.push($(this).data("id") + "_" + $(this).data("num"));
			})
			$("input[name=allOrderID]").val(arr.join("-"))
			UpdateRedirect()


			let payment_result = $("input[name=payment_result]").val()
			if (payment_result != "") {
				if (payment_result == '1') {
					$("#checkout_ordernow").trigger("click")
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Thanh toán thất bại',
						text: 'Có lỗi xảy ra trong quá trình thanh toán. Vui lòng kiểm tra lại thông tin',
						showConfirmButton: true,
					}).then(() => {
						let name = $("#name").val();
						let phone = $("#phone").val();
						let address = $("#address").val();
						let email = $("#email").val();
						let note = $("#note").val();
						let id = $("#get_id").val()
						let num = $("#get_num").val()
						window.location = `Checkout?num=${num}&id=${id}&buynow=&fullname=${name}&username=${phone}&address=${address}&email=${email}&note=${note}`
					})
					$("input[name=payment_method]").val("Thanh toán khi nhận hàng")
				}
			}

		})
		$("#checkout_ordernow").click(function(event) {
			event.preventDefault();
			if (checkOrderInfo()) {
				UpdateOrder();
			}
		})
		$(".bthPayment").click(function(event) {
			if (!checkOrderInfo())
				event.preventDefault()
		})

		function checkOrderInfo() {
			var check = true;
			$(".checkout__1 .input_require").each(function() {
				if ($(this).val().trim() == "") {
					check = false;
					$(this).siblings("span").fadeIn();
					$(this).css("border", "1px solid red")
				}
			})
			let un = $("#phone").val().trim();
			let regexUsername = /^\d{6,15}$/;
			if (!regexUsername.test(un)) {
				check = false;
				$("#phone").css("border", "2px solid red");
				$("#phone").siblings("span").text("Vui lòng nhập lại số điện thoại hợp lệ (6-15 ký tự)").fadeIn();
			}

			let em = $("#email").val().trim();
		let regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		if (!regexEmail.test(em)) {
			check = false;
			$("#email").css("border", "2px solid red");
			$("#email").siblings("span").text("Vui lòng nhập lại email hợp lệ").fadeIn();
		}


			let fn = $("#name").val().trim();
			let regexName = /^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*$/;
			if (!regexName.test(fn)) {
				check = false;
				$("#name").css("border", "2px solid red");
				$("#name").siblings("span").html("Vui lòng nhập lại tên hợp lệ<br>(Viết hoa chữ cái đầu - chỉ chứa kí tự là chữ)").fadeIn();
			}



			if (!check)
				$('html, body').animate({
					scrollTop: $('.checkout__1').offset().top
				});
			return check;
		}


		$(".checkout__1 .input_require").keyup(function() {
			if ($(this).val().trim() != "") {
				$(this).css("border", "1px solid rgba(34, 31, 31, 0.279)");
				$(this).siblings("span").fadeOut();
			}
		})

		function UpdateOrder() {
			let payment_method = $("input[name=payment_method]").val().trim()
			let payment_id = $("input[name=payment_id]").val().trim()
			let arr = {};
			$(".priceNnum input[type='hidden']").each(function() {
				arr[$(this).data("id")] = $(this).data("num");
			})
			let name = $("#name").val();
			let phone = $("#phone").val();
			let address = $("#address").val();
			let email = $("#email").val();
			let note = $("#note").val();
			let orderclick = $("#checkout_ordernow").val();


			Swal.fire({
				title: 'Đang kiểm tra thông tin...',
				text: 'Vui lòng chờ trong giây lát',
				showConfirmButton: false,
				allowOutsideClick: false,
				didOpen: () => {
					Swal.showLoading()
					$.post("./Ajax/UpdateOrder", {
						orderclick: orderclick,
						name: name,
						phone: phone,
						address: address,
						email: email,
						note: note,
						id_num: arr,
						payment_method: payment_method,
						payment_id: payment_id
					}, function(result) {
						if (result)
							Swal.fire({
								icon: 'success',
								title: 'Đặt hàng thành công',
								text: 'Cảm ơn bạn đã đặt mua sản phẩm',
								showConfirmButton: true,
							}).then((result) => {

								let login_status = $("#login_status").val()
								if (login_status) window.location.href = './User/Order';
								else window.location = "";

							})
						else Swal.fire({
							icon: 'error',
							title: 'Đặt hàng thất bại',
							text: 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng liên hệ lại với chúng tôi',
							showConfirmButton: true,
						})
					})
				}
			})
		}
	</script>