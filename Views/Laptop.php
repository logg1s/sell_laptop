<title>Trang chủ</title>
<div id='category'>
    <div id="route">
        <a href="">Trang chủ</a>
        <span>/ Laptop</span>
    </div>
    <div class='category-container'>
        <div class='category-container-left'>
            <ul class="ul-manufacturer">
                <h4>HÃNG SẢN XUẤT</h4>
                <input type="hidden" id='hidden-check' value="<?php echo $data['GetCheck']?>">
                <?php
                foreach ($data['Manufacturer'] as $manufacturer) {
                    echo "
                    <li>
                    <input type='checkbox' name= 'manufacturer[]' value='$manufacturer[manufacturer]' id='category-manufacturer-$manufacturer[manufacturer]'>
                    <label for='category-manufacturer-$manufacturer[manufacturer]'>$manufacturer[manufacturer]</label>
                    </li>
                    ";
                }
                ?>
            </ul>
            <ul>
                <h4>MỨC GIÁ</h4>
                <!-- <li>
                    <input type="checkbox" name="" id="category-price-all">
                    <label for="category-price-all">Tất cả</label>
                </li> -->
                <li>
                    <input type="checkbox" name="price[]" id="category-price-10" value='price_out between 0 and 10000000'>
                    <label for="category-price-10">Dưới 10 triệu</label>
                </li>
                <li>
                    <input type="checkbox" name="price[]" id="category-price-1015" value='price_out between 10000000 and 15000000'>
                    <label for="category-price-1015">Từ 10 - 15 triệu</label>
                </li>
                <li>
                    <input type="checkbox" name="price[]" id="category-price-1520" value='price_out between 15000000 and 20000000'>
                    <label for="category-price-1520">Từ 15 - 20 triệu</label>
                </li>
                <li>
                    <input type="checkbox" name="price[]" id="category-price-2025" value='price_out between 20000000 and 25000000'>
                    <label for="category-price-2025">Từ 20 - 25 triệu</label>
                </li>
                <li>
                    <input type="checkbox" name="price[]" id="category-price-25" value='price_out > 25000000'>
                    <label for="category-price-25">Trên 25 triệu</label>
                </li>
            </ul>
            <ul>
                <h4>MÀN HÌNH</h4>
                <!-- <li>
                    <input type="checkbox" name="" id="category-screen-all">
                    <label for="category-screen-all">Tất cả</label>
                </li> -->
                <li>
                    <input type="checkbox" name="screen[]" id="category-screen-13" value="screen between 13 and 14">
                    <label for="category-screen-13">Khoảng 13 inch</label>
                </li>
                <li>
                    <input type="checkbox" name="screen[]" id="category-screen-14" value="screen between 14 and 15">
                    <label for="category-screen-14">Khoảng 14 inch</label>
                </li>
                <li>
                    <input type="checkbox" name="screen[]" id="category-screen-15" value="screen > 15">
                    <label for="category-screen-15">Trên 15 inch</label>
                </li>
            </ul>
            <ul>
                <h4>CPU</h4>
                <!-- <li>
                    <input type="checkbox" name="" id="category-cpu-all">
                    <label for="category-cpu-all">Tất cả</label>
                </li> -->
                <li>
                    <input type="checkbox" name="cpu[]" id="category-cpu-i3" value="cpu like '%i3%'">
                    <label for="category-cpu-i3">Intel Core i3</label>
                </li>
                <li>
                    <input type="checkbox" name="cpu[]" id="category-cpu-i5" value="cpu like '%i5%'">
                    <label for="category-cpu-i5">Intel Core i5</label>
                </li>
                <li>
                    <input type="checkbox" name="cpu[]" id="category-cpu-i7" value="cpu like '%i7%'">
                    <label for="category-cpu-i7">Intel Core i7</label>
                </li>
                <li>
                    <input type="checkbox" name="cpu[]" id="category-cpu-r3" value="cpu like '%r3%'">
                    <label for="category-cpu-r3">AMD Ryzen 3</label>
                </li>
                <li>
                    <input type="checkbox" name="cpu[]" id="category-cpu-r5" value="cpu like '%r5%'">
                    <label for="category-cpu-r5">AMD Ryzen 5</label>
                </li>
                <li>
                    <input type="checkbox" name="cpu[]" id="category-cpu-r7" value="cpu like '%r7%'">
                    <label for="category-cpu-r7">AMD Ryzen 7</label>
                </li>
            </ul>
            <ul>
                <h4>RAM</h4>
                <!-- <li>
                <input type="checkbox" name="" id="category-ram-all">
                    <label for="category-ram-all">Tất cả</label>
                </li> -->
                <li>
                    <input type="checkbox" name="ram[]" id="category-ram-4" value="4">
                    <label for="category-ram-4">4 GB</label>
                </li>
                <li>
                    <input type="checkbox" name="ram[]" id="category-ram-8" value="8">
                    <label for="category-ram-8">8 GB</label>
                </li>
                <li>
                    <input type="checkbox" name="ram[]" id="category-ram-16" value="16">
                    <label for="category-ram-16">16 GB</label>
                </li>
                <li>
                    <input type="checkbox" name="ram[]" id="category-ram-32" value="32">
                    <label for="category-ram-32">32 GB</label>
                </li>
                <li>
                    <input type="checkbox" name="ram[]" id="category-ram-64" value="64">
                    <label for="category-ram-64">64 GB</label>
                </li>
            </ul>
            <ul>
                <h4>CARD ĐỒ HỌA</h4>
                <li>
                    <input type="checkbox" name="gpu[]" id="category-gpu-nvidia" value="gpu like '%nvidia%'">
                    <label for="category-gpu-nvidia">NVIDIA Geforce</label>
                </li>
                <li>
                    <input type="checkbox" name="gpu[]" id="category-gpu-amd" value="gpu like '%amd%'">
                    <label for="category-gpu-amd">AMD Radeon / Vega</label>
                </li>
                <li>
                    <input type="checkbox" name="gpu[]" id="category-gpu-intel" value="gpu like '%intel%'">
                    <label for="category-gpu-intel">Intel Xe / UHD Graphics</label>
                </li>
            </ul>
            <ul>
                <h4>Ổ CỨNG</h4>
                <li>
                    <input type="checkbox" name="storage[]" id="category-storage-1" value="1000">
                    <label for="category-storage-1">1 TB</label>
                </li>
                <li>
                    <input type="checkbox" name="storage[]" id="category-storage-512" value="512">
                    <label for="category-storage-512">512 GB</label>
                </li>
                <li>
                    <input type="checkbox" name="storage[]" id="category-storage-256" value="256">
                    <label for="category-storage-256">256 GB</label>
                </li>
                <li>
                    <input type="checkbox" name="storage[]" id="category-storage-128" value="128">
                    <label for="category-storage-128">128 GB</label>
                </li>
            </ul>
            <!-- <ul>
                <h4>HỆ ĐIỀU HÀNH</h4>
                <li>
                    <input type="checkbox" name="" id="category-win-11">
                    <label for="category-win-11">Windows 11</label>
                </li>
                <li>
                    <input type="checkbox" name="" id="category-win-10">
                    <label for="category-win-10">Windows 10</label>
                </li>
            </ul> -->
        </div>
        <div class='category-container-right'>
            <div>
                <h1 class='headerCategory'>Laptop
                </h1>
                <div class="prefer_view">
                    <span>Ưu tiên xem:</span>
                    <ul>
                        <li><button data-id='order by selled desc' style='background-color: #cd1818;color:white;'>Bán chạy nhất</button></li>
                        <li><button data-id='order by price_out asc'>Giá tăng dần</button></li>
                        <li><button data-id='order by price_out desc'>Giá giảm dần</button></li>
                        <li><button data-id='and (price_out < price)'>Đang giảm giá</button></li>
                    </ul>
                    <h3 id="countProduct" style="margin-right: 20px"></h3>
                </div>
            </div>
            <div class="products__grid laptop" style="margin-top: 20px">

            </div>
            <!-- <a href=''><button class='btnViewAll'>Xem tất cả <i class="fa-solid fa-arrow-right"></i></button> </a> -->
            <?php

            ?>
        </div>
    </div>

</div>
<script>
    var filter = 'order by selled desc';
    // GetProductLaptop();
    $("input[type=checkbox]").change(function() {
        let btnID = $(this).attr("id");
        if ($(this).is(":checked")) {
            let btnValue = $(this).siblings("label").text();
            $(".headerCategory").append(`
            <button id = '${btnID}' class='btnheaderCategory btnAction'>${btnValue} <i class="fa-solid fa-x"></i></button>
            `);
        } else {
            $("button[id=" + btnID + "]").remove();
        }
        // animateChange();
        // setTimeout(animateChange, 500);

        $(".headerCategory button[id=" + btnID + "]").click(function() {
            let ckbID = $(this).attr("id");
            $("input[id=" + ckbID + "]").prop("checked", false).trigger("change");
        })


        if ($(".headerCategory").children(".btnAction").length) {
            $("#btndeleteAll").remove();
            $(".headerCategory").append(`
            <button id = 'btndeleteAll' class='btnheaderCategory'>Xóa tất cả <i class="fa-solid fa-x"></i></button>
            `)
            $("#btndeleteAll").click(function() {
                $("input[type=checkbox]:checked").prop("checked", false);
                $(".headerCategory .btnAction").remove();
                animateChange();
                $("#btndeleteAll").remove();
            })
        } else $("#btndeleteAll").remove();


    var urlChange = [];
        $("input[type=checkbox]").each(function(){
            if($(this).is(":checked")){
                urlChange.push($(this).siblings("label").text());
            }
        })
        history.replaceState('', '', "./Laptop/" + urlChange.join("_"));
        animateChange();

    })
    // function ChangeURL(){

    // }

    $(".prefer_view ul button").click(function() {
        $(".prefer_view ul button").css({
            "background-color": "white",
            "color": "rgba(0, 0, 0, 0.7)"
        })
        filter = $(this).data("id");
        animateChange(filter);
        $(this).css({
            "background-color": "#cd1818",
            "color": "white"
        });
    })

    function animateChange(a) {
        $(".products__grid").children().fadeOut().remove();
        GetProductLaptop(a);
        $(".products__grid").hide().fadeIn();
    }
    function CPUHandle(value = 0) {
    return value.trim().replace(/^(\w+\W+){2}/, '') || false;
}
    function GetProductLaptop(sortContent = 'order by selled desc') {
        let manufacturer = ""
        let price = ""
        let screen = ""
        let cpu = ""
        let ram = ""
        let gpu = ""
        let storage = ""
        let sort = sortContent
        // $("input[type=checkbox]:checked").each(function() {

        manufacturer = $("input[name='manufacturer[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });

        price = $("input[name='price[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });

        screen = $("input[name='screen[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });

        cpu = $("input[name='cpu[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });

        ram = $("input[name='ram[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });

        gpu = $("input[name='gpu[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });

        storage = $("input[name='storage[]']:checked").serializeArray().map(function(item) {
            return item.value;
        });
        // })
        $.post("./Ajax/GetProductLaptop", {
            manufacturer: manufacturer,
            price: price,
            screen: screen,
            cpu: cpu,
            ram: ram,
            gpu: gpu,
            storage: storage,
            sort: sort
        }, function(data) {
            // console.log(data);

            if (data.length > 0) {
                for (let product of data) {
                    $(".products__grid").append(`
                <div class='item'>
                    <div class='item-top'>
                    <a href='./Detail/${product.link}'>
                    <img src = '${product.thumbnail}'>
                    <div>
                    <p style='font-size: 1rem;font-weight: 600; color: black;text-align: left'>${product.title} ${CPUHandle(product.cpu)}</p>
                    <span class='price_sell'>
                    <span class='money_price' style='font-size: 1rem'>${product.price_out} <u>đ</u></span>
                    <span style='color: #97a4c3; font-size: .8rem; '>
                    <s>${product.price}</s>
                    </span>
                    </span>
                    </div>
                    </a>
                    </div>
                    <div class='spec'>
                    <div>
                    <div class='speclr'>
                    <span title='CPU'>
                    <i class='fa-sharp fa-solid fa-microchip'></i> ${CPUHandle(product.cpu)}</span>
                    <span title='RAM'>
                    <i class='fa-sharp fa-solid fa-memory'></i> ${product.ram} GB
                    </span>
                    </div>
                    <span title='Ổ cứng'>
                    <i class='fa-solid fa-container-storage'></i> SSD ${product.storage} GB
                    </span>
                  
                    <div  class='speclr'>
                    <span title='Màn hình'>
                    <i class='fa-duotone fa-display'></i> ${product.screen} inch</span>
                    <span title='Trọng lượng'>
                    <i class='fa-solid fa-weight-hanging'></i> ${product.weight} kg
                    </span>
                    </div>
                    <span title='Đồ họa'>
                    <i class='fa-solid fa-chess-board'></i> ${product.gpu}
                    </span>
                    </div>
                    </div>
                    </div>
                `);
                }
                $("#countProduct").text(`"${data.length} sản phẩm được hiển thị"`)
            } else {
                $("#countProduct").text(`"0 sản phẩm được hiển thị"`)
            }
        }, "json")
    }
        let hiddencheck = $("#hidden-check").val().split("_");
        $("input[type=checkbox]").each(function(){
                if(hiddencheck.includes($(this).siblings("label").text())){
                $(this).prop("checked", true);
            }
        })
        
           
    $(document).ready(function(){
        setTimeout(animateChange,500)
    })
</script>