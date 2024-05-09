<title>Trang chủ</title>
<link rel="stylesheet" href="./lib/flickity/flickity.css" media="screen">
<style>
    #galery-carousel {
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100vw;
    }

    #galery-carousel .carousel {
        /* margin: auto; */
        /* border-radius: 5px; */
        margin: 10px 0 50px;
        width: 100vw;
    }

    #galery-carousel .carousel-cell {
        margin-right: 10px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        object-fit: cover;
    }

    #galery-carousel .carousel-cell img {
        width: 100%;
        display: block;
        border-radius: 5px;
        /* object-fit: cover; */
    }

    .hot .carousel-cell {
        /* height: 100%; */
        height: 350px;
        width: 20%;
        border-radius: 5px;
        background: white;
        border-radius: 5px;
    }

    .hot .carousel-cell.item {
        outline: none
    }

    .hot .carousel-cell.item:hover {
        border: 2px solid black;
    }

    .hot.carousel {
        width: 90%;
        margin: auto;
        border: 1px solid #c2c2c2;
        /* border-radius: 5px; */
    }

    .hot .flickity-page-dots {
        bottom: -22px;
    }

    .hot .flickity-page-dots .dot {
        height: 4px;
        width: 40px;
        margin: 0;
        border-radius: 0;
    }

    .hot .flickity-page-dots .dot.is-selected {
        background-color: #333;
    }

    .hot .flickity-button {
        outline: 1px solid black;
    }

  
</style>

<div id="galery-carousel">
    <div class="carousel" data-flickity='{ "autoPlay": true, "wrapAround": true, "lazyLoad": 1}'>
        <div class="carousel-cell">
            <a href="./Laptop">
                <img data-flickity-lazyload="./Views/Shared/img/Banner/1.webp" alt="">
            </a>
        </div>
        <div class="carousel-cell">
            <a href="./Laptop/Lenovo">
                <img data-flickity-lazyload="./Views/Shared/img/Banner/2.webp" alt="">
            </a>
        </div>
        <div class="carousel-cell">
            <a href="./Laptop/MSI">
                <img data-flickity-lazyload="./Views/Shared/img/Banner/3.webp" alt="">
            </a>
        </div>
        <div class="carousel-cell">
            <a href="./Laptop">

                <img data-flickity-lazyload="./Views/Shared/img/Banner/4.webp" alt="">
            </a>
        </div>
        <div class="carousel-cell">
            <a href="./Laptop/NVIDIA Geforce">

                <img data-flickity-lazyload="./Views/Shared/img/Banner/5.webp" alt="">
            </a>
        </div>
    </div>
</div>
<?php if (count($data['hot']) > 0) { ?>
    <div class="category-bar" style="width: 90vw;margin: auto; background-color: #ffb000">
        <h3 style="color: black">SẢN PHẨM HOT
            <div class="lazyload">
                <!-- <img src="./Views/Shared/img/hot-icon.gif" alt="hot" height="40"> -->
            </div>
        </h3>
        <!-- <button onclick='window.location.href="./Laptop"' style='color:white; font-size: 1.1rem;'>Xem tất cả ></button> -->
    </div>
    <div class="carousel hot" data-flickity='{ "contain": true, "groupCells": 5, "lazyLoad": true, "prevNextButtons": false }'>
        <?php foreach ($data["hot"] as $row) {
            $currency = $this->MoneyHandle($row['price_out']);
            $cpu = $this->CPUHandle($row['cpu']);
            $product = $this->TitleHandle($row['title'], 0);
            echo "<div class='carousel-cell item' style='border-radius: 0'>
        <div class='item-top'>
       <a href='./Detail/$product'>
       <img data-flickity-lazyload = '$row[thumbnail]'> 
            <div>
            <p style='font-size: 1rem;font-weight: 600; color: black; text-align: left'>$row[title] $cpu</p>
        
        <span class='price_sell'>
        <span class='money_price'>$currency <u>đ</u></span><span style='color: #97a4c3; font-size: .8rem;'>
        <s>";
            if ($row['price'] > $row['price_out']) {
                echo $this->MoneyHandle($row['price']) . "đ";
            }
            echo "</s>
            </span>
            </span>
            </div>
            </a>
            ";

            echo "
                            </div>
                            <div class='spec'>
                                   
                            </div>
                        </div>";
        }
        ?>
    </div>
<?php } ?>
<main>
    <?php
    if ($data["Laptop"]->{"num_rows"}) {
    ?>
        <div class="category-bar">
            <h3>MÁY TÍNH XÁCH TAY</h3>
            <button onclick='window.location.href="./Laptop"' style='color:white; font-size: 1.1rem;'>Xem tất cả ></button>
        </div>
        <div class="products__grid laptop">
            <?php
            foreach ($data["Laptop"] as $row) {
                $currency = $this->MoneyHandle($row['price_out']);
                $cpu = $this->CPUHandle($row['cpu']);
                $product = $this->TitleHandle($row['title'], 0);
                echo "<div class='item'>
                            <div class='item-top'>
                             <a href='./Detail/$product'>
                             <div class='lazyload'> 
                              <!-- <img src = '$row[thumbnail]'> -->
                              </div>
                            <div>
                            <p style='font-size: 1rem;font-weight: 600; color: black;text-align: left'>$row[title] $cpu</p>
                        
                        <span class='price_sell'>
                        <span class='money_price'>$currency <u>đ</u></span><span style='color: #97a4c3; font-size: .8rem;'>
                        <s>";
                if ($row['price'] > $row['price_out']) {
                    echo $this->MoneyHandle($row['price']) . "đ";
                }
                echo "</s>
                            </span>
                            </span>
                            </div>
                            </a>
                            ";

                echo "
                            </div>
                            <div class='spec'>
                               <div>
                                    <div class='speclr'><span title='CPU'>
                                    <i class='fa-sharp fa-solid fa-microchip'></i> $cpu
                                </span>
                                <span title='RAM'>
                                    <i class='fa-sharp fa-solid fa-memory'></i> $row[ram] GB
                                </span></div>
                                    <span title='Ổ cứng'>
                                    <i class='fa-solid fa-container-storage'></i> SSD $row[storage] GB
                                </span>
                                    <div class='speclr'>
                                    <span title='Màn hình'>
                                    <i class='fa-duotone fa-display'></i> $row[screen] inch</span>
                                    <span title='Trọng lượng'>
                                        <i class='fa-solid fa-weight-hanging'></i> $row[weight] kg
                                    </span>
                                    </div>
                                    <span title='Đồ họa'>
                                        <i class='fa-solid fa-chess-board'></i> $row[gpu]
                                    </span>
                            </div>
                            </div>
                        </div>";
            }
            ?>
        </div>
        <button class='btnViewAll' onclick='window.location.href="./Laptop"'>Xem tất cả <i class="fa-solid fa-arrow-right"></i></button>
    <?php
    }
    ?>
    <?php
    if ($data["Linhkien"]->{"num_rows"}) {
    ?>
        <div class="category-bar">
            <h3>LINH KIỆN MÁY TÍNH</h3>
            <!-- <a href="" style='color:white; font-size: 1.1rem;'>Xem tất cả ></a> -->
        </div>
        <div class="products__grid linhkien">
            <?php
            foreach ($data["Linhkien"] as $row) {
                $currency = $this->MoneyHandle($row['price_out']);
                $product = $this->TitleHandle($row['title'], 0);
                echo "<div class='item'>
            
            <div class='item-top'>
            <a href='./Detail/$product'>
            <div class='lazyload'>
         <!-- <img src = '$row[thumbnail]'> -->
         </div>
                <p style='font-size: 1rem;font-weight: 600; color: black'>$row[title]</p>
            <span class='price_sell'>
            <span class='money_price'>$currency <u>đ</u></span><span style='color: #97a4c3; font-size: .8rem;'>
            <s>";
                if ($row['price'] > $row['price_out'])
                    echo $this->MoneyHandle($row['price']) . "đ";
                echo "</s>
                </span>
                </span>
                </a></div>
            </div>";
            }
            ?>
        </div>
        <!-- <a href=''><button class='btnViewAll'>Xem tất cả <i class="fa-solid fa-arrow-right"></i></button> </a> -->
    <?php
    }
    ?>
    </div>
    <br><br><br>
    <div id="fbcomm"  style="width: 75%"></div>
</main>
<script>
    $("#fbcomm").append(`
    <div class="fb-comments" data-href="${window.location.href}" data-numposts="5" data-width="100%" data-lazy="true"></div>
    `);
</script>
<script src="./lib/jquery/jquery.min.js"></script>
<script src="./lib/js/js.js">
</script>
<script src="./lib/flickity/flickity.pkgd.js"></script>
<script src="./lib/flickity/as-nav-for.js"></script>
<script src="./lib/flickity/hash.js"></script>
<script src="./lib/jquery/jquery.lazyload-any.js"></script>
<script>
    function load(img) {
        img.fadeOut(0, function() {
            img.fadeIn(1000);
        });
    }
    $('.lazyload').lazyload({
        load: load
    });
</script>