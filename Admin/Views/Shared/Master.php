<base href="<?php echo BaseController::Base() ?>">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./lib/doc/css/main.css">
<link rel="stylesheet" href="./lib/vendor/font-awesome/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="./lib/vendor/dataTables/jquery.dataTables.min.css">
<link rel="stylesheet" href="./lib/vendor/boxicon/boxicons.min.css">
<style>
  @media (max-width: 767px) {
    div.hidesidebar {
      display: none;
    }
  }


  .hidesidebar {
    position: fixed;
    z-index: 99999999999;
    top: 0;
    padding: 15px;
    height: 50px;
    transition: 1s;
    cursor: pointer
  }

  .hidesidebar i {
    color: white;
  }

  .app-menu li {
    transition: .5s;
  }

  .app-menu li:hover {
    border-radius: 10px;
    background-color: gray;
  }

  .app-sidebar__user {
    transition: .5s;
  }

  .app-sidebar__user:hover {
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0.6);
    border-radius: 50px;
  }
  table {
      font-size: .9rem;
    }
  table.dataTable tbody td, table.dataTable thead th {
    vertical-align: middle;
  }

  table.dataTable tbody td label {
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
<header class="app-header">
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    <!-- User Menu-->
    <li><a class="app-nav__item" id="logout" href=""><i class='bx bx-log-out bx-rotate-180'></i></a>
    </li>
  </ul>
</header>
<!-- Sidebar menu-->
<div class="hidesidebar">
  <i class="fa fa-bars"></i>
</div>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">

  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar" src="<?php echo $_SESSION['avatar'] ?>" width="50px" alt="User Image"></label>

    <div>
      <p class="app-sidebar__user-name"><b><?php echo "[$_SESSION[admin]] $_SESSION[fullname]"?></b></p>
      <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
    </div>
  </div>
  <hr>
  <ul class="app-menu">
    <!-- <li><a class="app-menu__item haha" href="phan-mem-ban-hang.html"><i class='app-menu__icon bx bx-cart-alt'></i>
          <span class="app-menu__label">POS Bán Hàng</span></a></li> -->
    <li><a class="app-menu__item" href="./" id="Dashboard"><i class='app-menu__icon bx bx-tachometer'></i><span class="app-menu__label">Bảng điều khiển</span></a></li>
    <li><a class="app-menu__item" href="./Order" id="Order"><i class='app-menu__icon bx bx-task'></i><span class="app-menu__label">Quản lý đơn hàng</span></a></li>
    <li><a class="app-menu__item" href="./Product" id="Product"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
    </li>
    <li><a class="app-menu__item " href="./Account" id="Account"><i class='app-menu__icon bx bx-id-card'></i> <span class="app-menu__label">Quản lý tài khoản</span></a></li>

    <li><a class="app-menu__item" href="./Statistics" id="Statistics"><i class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Thống kê</span></a>
    </li>

  </ul>
  <input type="hidden" class="menuapp" value="<?php echo get_class() ?>">
</aside>


<script src="./lib/doc/js/jquery.min.js"></script>
<script src="./lib/doc/js/popper.min.js"></script>
<script src="./lib/doc/js/bootstrap.min.js"></script>
<script src="./lib/doc/js/main.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js" integrity="sha512-d6nObkPJgV791iTGuBoVC9Aa2iecqzJRE0Jiqvk85BhLHAPhWqkuBiQb1xz2jvuHNqHLYoN3ymPfpiB1o+Zgpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./lib/vendor/dataTables/jquery.dataTables.min.js"></script>
<script>
  $("#logout").click(function(event){
    event.preventDefault()
    $.post("./Ajax/Logout",{logout: "w"}, function(){
      window.location.href = ""
    })
  })
  let menuapp = $(".menuapp").val();
  changeColor("#" + menuapp)
  $(".app-menu__item").click(function() {
    $("#" + menuapp).css({
      "background-color": 'transparent',
      "color": "white"
    })
    changeColor($(this))
  })

  function changeColor(a) {
    $(a).css({
      "background-color": '#c6defd',
      "color": "rgb(22 22 72)"
    })
  }
  $(document).ready(function() {
    $("div.hidesidebar").click(function() {

      $(".app-sidebar").animate({
        width: 'toggle'
      }, 350, function() {
        if ($(".app-sidebar").is(":visible")) {
          $(".app-content").animate({
            marginLeft: 250
          }, 200);
        } else {
          $(".app-content").animate({
            marginLeft: 0
          }, 200);
        }
      });
    })

  //   $("div.hidesidebar").trigger('click')
  })
  $(".app-sidebar__toggle").click(function() {
    $(".app-sidebar").animate({
      width: 'toggle'
    }, 350)
  })

  $(".app-sidebar__user").click(function() {
    window.location.href = "./EditAccount";
  })
</script>
<script>
  function time() {
    var today = new Date();
    var weekday = new Array(7);
    weekday[0] = "Chủ Nhật";
    weekday[1] = "Thứ Hai";
    weekday[2] = "Thứ Ba";
    weekday[3] = "Thứ Tư";
    weekday[4] = "Thứ Năm";
    weekday[5] = "Thứ Sáu";
    weekday[6] = "Thứ Bảy";
    var day = weekday[today.getDay()];
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    nowTime = h + " giờ " + m + " phút " + s + " giây";
    if (dd < 10) {
      dd = '0' + dd
    }
    if (mm < 10) {
      mm = '0' + mm
    }
    today = day + ', ' + dd + '/' + mm + '/' + yyyy;
    tmp = '<span class="date"> ' + today + ' - ' + nowTime +
      '</span>';
    document.getElementById("clock").innerHTML = tmp;
    clocktime = setTimeout("time()", "1000", "Javascript");

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }
  }
  //In dữ liệu
  var myApp = new function() {
    this.printTable = function() {
      var tab = document.getElementById('sampleTable');
      var win = window.open('', '', 'height=700,width=700');
      win.document.write(tab.outerHTML);
      win.document.close();
      win.print();
    }
  }
</script>