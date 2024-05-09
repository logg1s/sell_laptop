<title><?php echo $data['detail']['title'] ?> </title>
<div class='modal__box' style="display: none;  z-index: 99;">
  <div style="width: 100vw;height: 100vh; position: fixed; top: 0; display: flex; justify-content: center; align-items:center; z-index: 99;" class="modal__bg">
    <div class="modal__content" style="height: 20%;width:30%; border-radius: 5px; background-color: rgba(0, 0, 0, 0.8);position: relative; z-index: 1;  display: flex; flex-direction: column; justify-content:center; align-items: center">
      <!-- <span id='close__modal' style="position: absolute; right: 1vw; top: 1vh; background-color: transparent; font-size: 2rem">&times;</span> -->

    </div>

  </div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="./lib/flickity/flickity.css" media="screen">
<style>
  .carousel {
    margin-bottom: 40px;
  }

  .carousel-cell {
    width: 100%;
    margin-right: 10px;
    border-radius: 5px;
    text-align: center;
  }

  /* cell number */


  .carousel-nav .carousel-cell {
    /* height: 80px; */
    width: auto;
  }

  /* .carousel-nav .carousel-cell:before {
    font-size: 50px;
    line-height: 80px;
  } */

  .carousel-nav .carousel-cell.is-nav-selected {
    border: 2px solid #ED2;
  }
</style>
<main id="product_detail">

  <div id="route">
    <a href="">Trang chủ</a>
    <span>/</span>
    <a href="./<?php echo $data['detail']['type'] ?>"><?php echo $data["detail"]["name"] ?></a>
    <span>/</span>
    <a href="./<?php echo $data['detail']['type'] ?>/<?php echo $data["detail"]["manufacturer"] ?>"><?php echo $data["detail"]["manufacturer"] ?></a>
    <span>/</span>
    <span> <?php echo $data["detail"]["title"] ?></span>
  </div>

  <div class="detail" data-id="<?php echo $data['detail']['id'] ?>">
    <div class="detail__center">
      <div class="detail__center-left">
        <div class="left1">
          <div class="carousel carousel-main" data-flickity='{"contain": true,"prevNextButtons": true, "lazyLoad": 1}'>
            <div class="carousel-cell">
              <a href="<?php echo $data['detail']['thumbnail'] ?>">
                <img data-flickity-lazyload="<?php echo $data['detail']['thumbnail'] ?>" alt="" width="300">
              </a>
            </div>

            <?php
            foreach ($data['gallery'] as $gallery) { ?>
              <div class="carousel-cell">
                <a href="<?php echo $gallery['picture'] ?>">
                  <img data-flickity-lazyload="<?php echo $gallery['picture'] ?>" alt="" width="300">
                </a>
              </div>
            <?php } ?>
          </div>

          <div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false,"prevNextButtons": false, "lazyLoad": 1 }'>
            <div class="carousel-cell">
              <img data-flickity-lazyload="<?php echo $data['detail']['thumbnail'] ?>" alt="" height="70">
            </div>
            <?php
            foreach ($data['gallery'] as $gallery) { ?>
              <div class="carousel-cell">

                <img data-flickity-lazyload="<?php echo $gallery['picture'] ?>" alt="" height="70">

              </div>
            <?php } ?>
          </div>


        </div>
        <div class="left2">
          <div class="prod__name">
            <?php
            $title = $data["detail"]["title"];
            if ($data["detail"]["category_id"] === "1") {
              $cpu = $this->CPUHandle($data['detail']['cpu']);
              $title .= " | $cpu | " . $data["detail"]["ram"] . "GB | " . $data["detail"]["storage"] . "GB | " . $data["detail"]["screen"] . " inch | " . $data["detail"]["os"];
            }
            echo $title;
            ?>
          </div>



          <?php if ($data['detail']['num'] > 0) { ?>
            <div class="prod__price">
              <?php
              echo "<span class='price__VND'>" . $this->MoneyHandle($data['detail']['price_out']) . "<sup>đ</sup></span>";
              if ($data['detail']['price'] > $data['detail']['price_out']) {

                echo "<span id='prod__priceOld' style='color: #97a4c3; font-size: 1rem'><s>" . $this->MoneyHandle($data['detail']['price']) . "đ</s></span>";

                echo "<span id='prod__discount'>-" . $this->PercentDiscount($data['detail']['price_out'], $data['detail']['price']) . "%</span>";


                echo "<div style='font-size: 0.9rem'>(Tiết kiệm: <span style='color: #ed3324;'>" . $this->MoneyHandle($data['detail']['price'] - $data['detail']['price_out']) . "<sup>đ</sup>)</span></div>";
              }
              ?>
              <em style="font-size: .9rem; display: block">Giá sản phẩm đã bao gồm VAT</em>
            </div>
            <p>Thương hiệu: <a href="./Laptop/<?php echo $data["detail"]["manufacturer"] ?>"><?php echo $data["detail"]["manufacturer"] ?></a></p>

            <br>


            <?php
            if (!empty($data["detail"]["promotion"])) {
              $promotion = explode(".", $data["detail"]["promotion"]);
              if (count($promotion) > 0) {
                echo "<div class='prod__promotion'><ul>";
                foreach ($promotion as $value) {
                  echo "<li>$value</li>";
                }
                echo "</ul></div>";
              }
            }
            ?>
          <?php } ?>
          <div class="prod__buy">
            <?php if ($data['detail']['num'] > 0) { ?>
              <form action="./Checkout" method="GET">
                <div style="display: flex; align-items:center; justify-content:space-between">
                  <div style="display: flex; column-gap: 10px; align-items:center">
                    <span>Số lượng:</span>
                    <input id='number_product' class='numberstyle' type='number' min='1' max='<?php echo $data['detail']['num'] ?>' step='1' value='1' name='num'>
                  </div>
                  <div style="font-weight: 600"><?php echo $data['detail']['num'] ?> sản phẩm có sẵn</div>
                </div>
                <span style="display: flex; column-gap: 10px;">
                  <input type="hidden" name="id" value="<?php echo $data["detail"]["id"] ?>">
                  <button name='buynow' type="submit" style="flex: 80%">MUA NGAY</button>
                  <button id="addCart" style="font-size: .8rem; padding: 0 10px" onclick="return false">Thêm vào giỏ hàng</button>
                </span>
              </form>
            <?php } else { ?>
              <h1 style="color: red; text-align:center;text-transform: uppercase;">Hết hàng</h1>
              <h3 style="text-align:center">Vui lòng quay lại sau</h3>
            <?php } ?>
          </div>

        </div>
      </div>

      <div class="detail__center-right">
        <div><img src="./Views/Shared/img/policy/2.webp" alt="">
          <p>Sản phẩm chính hãng phân phối tại Việt Nam</p>
        </div>
        <div><img src="./Views/Shared/img/policy/3.webp" alt="">Tiết kiệm hơn từ 10% - 30% so với thị trường</div>
        <div><img src="./Views/Shared/img/policy/4.webp" alt="">Đổi mới trong vòng 07 ngày nếu có lỗi do nhà sản xuất</div>
      </div>
    </div>
  </div>
  <div class="description" style="display: flex; column-gap: 1vw; ">
    <div style='flex: 75%'>
      <p style="font-size: 2rem; font-weight:600;text-align: center">Tổng quan sản phẩm</p>
      <p><?php echo nl2br($data["detail"]["description"]) ?></p>
    </div>
    <div style="flex: 25%; padding: 15px">
      <p style="text-align: center;font-weight:600">Thông số kỹ thuật</p>
      <table class="specs" style="width: 100%; ">

        <?php if (!empty($data['detail']['screen']))
          echo "
            <tr>
              <td>Màn hình</td>
              <td>" . $data["detail"]["screen"] . " inch</td>
            </tr>
          ";
        ?>
        <?php if (!empty($data['detail']['cpu']))
          echo "
            <tr>
              <td>CPU</td>
              <td>" . $data["detail"]["cpu"] . "</td>
            </tr>
          ";
        ?>
        <?php if (!empty($data['detail']['ram']))
          echo "
            <tr>
              <td>RAM</td>
              <td>" . $data["detail"]["ram"] . " GB</td>
            </tr>
          ";
        ?>
        <?php if (!empty($data['detail']['storage']))
          echo "
            <tr>
              <td>Ổ cứng</td>
              <td>" . $data["detail"]["storage"] . " GB</td>
            </tr>
          ";
        ?>
        <?php if (!empty($data['detail']['gpu']))
          echo "
            <tr>
              <td>GPU</td>
              <td>" . $data["detail"]["gpu"] . "</td>
            </tr>
          ";
        ?>
        <?php if (!empty($data['detail']['os']))
          echo "
            <tr>
              <td>Hệ điều hành</td>
              <td>" . $data["detail"]["os"] . "</td>
            </tr>
          ";
        ?>
        <?php if (!empty($data['detail']['weight']))
          echo "
            <tr>
              <td>Trọng lượng</td>
              <td>" . $data["detail"]["weight"] . " kg</td>
            </tr>
          ";
        ?>
      </table>
    </div>
  </div>
  <br><br><br>
  <div id="fbcomm" style="width: 75%"></div>
</main>
<script>
  $("#fbcomm").append(`
    <div class="fb-comments" data-href="${window.location.href}" data-numposts="5" data-width="100%" data-lazy="true"></div>
    `);
</script>
<script type="text/javascript" src="./lib/js/js.js">

</script>
<script src="./lib/jquery/jquery.min.js"></script>
<script src="./lib/flickity/flickity.pkgd.js"></script>
<script src="./lib/flickity/as-nav-for.js"></script>
<script src="./lib/flickity/hash.js"></script>
<script src="./lib/jquery/jquery.lazyload-any.js"></script>