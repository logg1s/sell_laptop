/* =========================================== */
/* =========================================== */

function CheckAccount() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password-field").value;
  var check = true;
  if (username == "" && password == "") {
    swal({
      title: "",
      text: "Bạn chưa điền đầy đủ thông tin đăng nhập...",
      icon: "error",
      close: true,
      button: "Thử lại",
    }).then(()=>{
      document.getElementById("username").focus()
    });

    check = false;
  }
  else if (username == null || username == "") {
    swal({
      title: "",
      text: "Tài khoản đang để trống...",
      icon: "warning",
      close: true,
      button: "Thử lại",
    }).then(()=>{
      document.getElementById("username").focus()
    });
    check = false;
  }
  //Nếu không nhập mật khẩu sẽ báo lỗi
  else if (password == null || password == "") {
    swal({
      title: "",
      text: "Mật khẩu đang để trống...",
      icon: "warning",
      close: true,
      button: "Thử lại",
    }).then(()=>{
      document.getElementById("password-field").focus()
    });
    check = false;
  }

  return check;
}
    //Nếu trống toàn bộ thì báo lỗi

    

