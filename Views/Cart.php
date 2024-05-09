<title>Giỏ hàng</title>
<main>
  <div id="route">
    <a href="">Trang chủ</a>
    <span>/</span>
    <span>Giỏ hàng</span>
  </div>
  <?php echo $this->login__user ?>
  <h3 id="Cart__Title" style="text-align: center;">Giỏ hàng</h3>
  <div style='margin: 20vh; display: none; min-height: 30vh; align-items:center; justify-content:space-evenly; flex-direction: column;' id="no__Cart">
    <h2>KHÔNG CÓ SẢN PHẨM NÀO TRONG GIỎ HÀNG</h2>
    <a href=""><button>Tiếp tục mua sắm</button></a>
  </div>
  <div id="show__Cart">

    <div id="cart__detail" style="position: relative">
      <div class="cart__detail-left" style=" border: 2px solid rgba(0, 0, 0, 0.7); border-radius: 3px;;">
        <div style="display: flex; justify-content: space-around;font-size: .9rem; color: rgba(0, 0, 0, 0.5)">
          <div>
            <input type="checkbox" id="select__All">
            <label for="select__All" style="color: black"><b>Chọn tất cả</b></label>
          </div>
          <div style="flex: 40%; text-align: center;  ">
            <b>Sản phẩm</b>
          </div>
          <div style="display: flex; column-gap: 65px;padding-right: 30px;">
            <b>Đơn giá</b>
            <b>Số lượng</b>
            <b>Thành tiền</b>
          </div>
        </div>
        <?php foreach ($data as $row) {
          $product = $this->TitleHandle($row['title'], 0);
          echo "
          <div data-id='$row[id]' class='row_Cart'>
          <div style='display:flex; align-items: center;'>
          <input type='checkbox' class='checkbox__Cart' data-id='$row[id]' id='cart__item-$row[id]'>
          <label for='cart__item-$row[id]'>
          <img src='$row[thumbnail]' alt='thumbnail' width='100' >
          </label>
          <span><a href='./Detail/$product' ><p style='font-size: 1.2rem; font-weight: 600'>$row[title]</p>
            <p style='color: black'>";
          if (!empty($row['cpu'])) echo "<u>" . $row['cpu'] . "</u> &nbsp;";
          if (!empty($row['ram'])) echo "<u>" . $row['ram'] . "GB</u> &nbsp;";
          if (!empty($row['storage'])) echo "<u>" . $row['storage'] . "GB</u> &nbsp;";
          if (!empty($row['screen'])) echo "<u>" . $row['screen'] . " inch</u> &nbsp;";
          if (!empty($row['os'])) echo "<u>" . $row['os'] . "</u> &nbsp;";

          echo "</p></a></span>
          </div>

          <div style='display: flex;align-items: center;' data-id='$row[id]'>
          <button class='cart__item-delete' style='position: absolute;left: 56vw'>Xóa</button>
          <span style='color: #cd1818; margin: 0 20px'>" . $this->MoneyHandle($row['price_out']) . "<sup style=' color: #cd1818'>đ</sup></span>
          
          <input class='numberstyle' type='number' min='1' max='$row[num]' step='1'  oninput='this.value|=0'
           value='$row[cart_num]' data-id='$row[id]' >
          <span data-id='$row[id]' class='price_Cart' style='color: #cd1818; margin: 0 20px'>" . $this->MoneyHandle($row['price_out'] * $row['cart_num']) . "<sup style=' color: #cd1818'>đ</sup></span>
          <span class='maxNum' style='position: absolute; bottom: -5vh; max-width: 20vw; color: red'></span>
          </div>

          </div>
          ";
        }
        ?>

      </div>
      <div style='display: flex; justify-content: space-between; margin-top: 5vh'>
        <div>
          <p id="selectedCheckbox"></p>
          <button onclick="deleteAll()">Xóa tất cả</button>
        </div>
        <div class="cart__detail-right">
          <div>
            <h3>TỔNG CỘNG: <span></span></h3>
            <span class="price__VND"> </span>
            <sup style="font-size: 1.5rem; color: #ed3324; font-weight: bold">đ</sup>
          </div>
          <form action="./Checkout">
            <button class="btnCheckout" name='btnOrder'>ĐẶT HÀNG</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript" src="./lib/js/js.js">
</script>
<script>
  setInterval(TotalMoney, 1000)
  setInterval(GetCartNum, 1000)
</script>