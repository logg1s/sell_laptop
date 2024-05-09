<title><?php echo $data['search']?> | Tìm kiếm sản phẩm</title>
<main>
    <?php if (count($data['result']) > 0) { ?>
        <h1 style='text-align: center; margin: 50px'>HIỂN THỊ KẾT QUẢ CHO "<?php echo $data['search'] ?>" | Tìm được <?php echo count($data['result'])?> sản phẩm</h1>
    <div class="products__grid linhkien">
            <?php
            foreach ($data['result'] as $row) {
                $currency = $this->MoneyHandle($row['price_out']);
                $product = $this->TitleHandle($row['title'], 0);
                echo "<div class='item'>
            <div class='item-top'>
            <a href='./Detail/$product'>
                <img src = '$row[thumbnail]'>
                <p style='font-size: 1rem;font-weight: 600; color: black'>$row[title]</p>
            <span class='price_sell'>
            <span class='money_price'>$currency <u>đ</u></span><span style='color: #97a4c3; font-size: .8rem;'>
            <s>";
                if ($row['price'] > $row['price_out']) {
                    echo $this->MoneyHandle($row['price']) . "đ";
                }
                echo "</s>
                </span>
                </span>
                </a>
                ";
                echo " </div>
            </div>";
            }
            ?>
        </div>
    <?php } else {
        echo "<h1 style='padding: 150px; text-align: center'>KHÔNG TÌM THẤY SẢN PHẨM NÀO</h1>";
    } ?>
</main>