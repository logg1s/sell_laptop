<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo BaseController::Base() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Views/Shared/img/favicon_io/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="./lib/font-awesome/css/all.css">
    <link rel="stylesheet" href="./lib/css/Master.css">
    <script src="./lib/jquery/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="./lib/jquery/jquery.modal.min.css" />
    <link rel="stylesheet" href="./lib/sweetalert2/sweetalert2.min.css" />
    <meta property="fb:app_id" content="536870328517734" />
</head>
<style>
    #div-nav__right>div {
        display: none;
    }

    #nav-hello ul {
        min-width: 210px;
    }

    #nav-hello ul li a {
        display: flex;
        column-gap: 30px;
    }

    #nav-hello a {
        position: relative;
        width: 100%;
    }

    #nav-right a {
        display: block;
    }

    #nav-hello a span {
        padding-left: 30px;

    }

    #nav-hello img {
        position: absolute;
        height: 40px;
        width: 40px;
        border-radius: 50%;
        object-fit: cover;
        top: -1px;
        left: 0;
        padding: 5px;
        /* display: inline-block; */
    }

    #search_result {
        position: absolute;
        background-color: white;
        border: 1px solid black;
        z-index: 999;
        font-size: 1rem;
        max-height: 80vh;
        overflow: auto;
        display: flex;
        flex-direction: column;
        /* row-gap: 50px; */
        width: 100%;
        border-radius: 10px;
        list-style-type: none;
    }

    #search_result li:nth-child(n+2):hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    #search_result li {
        padding: 10px 5px;
        border: 1px solid #eeeeee;

    }

    #search_result li a {
        display: flex;
        column-gap: 10px;

    }

    #div-search_result {
        position: relative;
        display: none;
    }

    #div-search_result span#bg-search {
        position: fixed;
        z-index: 98;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100vw;
        height: 100vh;
        top: 0;
        right: 0;
    }

    .searchbutton {
        cursor: pointer;
        transition: all .1s linear;
    }

    .searchbutton:hover {
        font-size: 1.3rem;
        opacity: .6;
    }

    /* width */
    #search_result::-webkit-scrollbar {
        width: 6px;
    }


    #search_result::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }

    #search_result::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<body>
    <nav>
        <div id="nav__left">
            <a href="">
                <div class="lazyload">
                    <!-- <img src="./Views/Shared/img/LogoBrand.png" alt="Logo"> -->
                </div>
            </a>
        </div>


        <div id="nav__center">
            <form style="position: relative;z-index: 100" action="./Search">
                <input id="search" type="text" placeholder="Tìm kiếm" autocomplete="off" name="q"  value="<?php if (isset($_GET['q'])) {echo $_GET['q'];} ?>">
                <button type="submit" class="searchbutton" onclick="return checkSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div id="div-search_result">
                <span id="bg-search"></span>
                <ul id="search_result">

                </ul>
            </div>
        </div>
        <div id="nav__right">
            <div style="position: relative">
                <a href="./Cart" id="nav__cart"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng</a>
                <span id="number__cart">
                </span>
            </div>
            <div id="div-nav__right">
                <div id='nav-hello'>
                    <a href="./User">
                    </a>
                    <ul>
                        <li>
                            <a href="./User"><i class="fa-solid fa-user"></i> Thông tin cá nhân</a>
                        </li>
                        <li>
                            <a href="./User/Order"><i class="fa-solid fa-square-list"></i> Đơn hàng của tôi</a>
                        </li>
                        <li>
                            <a id="logout" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </div>
                <div id="nav-login">
                    <a href="./Login" id="nav__user"><i class="fa-solid fa-user"></i> Đăng nhập</a>
                </div>
            </div>
        </div>
    </nav>

    <script src="./lib/jquery/jquery.min.js"></script>
    <script>
        function checkSearch() {
            if ($("input#search").val().trim() == "")
                return false;
        }
        $.post("./Ajax/LoginStatus", function(result) {
            if (result) {
                $("#nav-hello").show().children("a").html(`
                  <img src="${result.avatar}"> 
                 <span>${result.fullname || ""}</span>
                 `);
            } else $("#nav-login").show();
        }, "json")

        $("#nav-hello").on({
            mouseenter: function() {
                $(this).children("ul").stop();
                $(this).children("ul").slideDown(100);
            },
            mouseleave: function() {
                $(this).children("ul").stop();
                $(this).children("ul").slideUp(100);
            }
        })

        function logout() {
            $.post("./Ajax/Logout", function() {
                window.location = window.location;
            })
        }

        function TitleHandle(value, type) {
            if (type) {
                return value.replace(/-+/g, ' ') || false;
            } else {
                return value.replace(/\s+/g, '-') || false;
            }
        }
        var timeOut;
        $("#search").on("input focus", function() {
            clearTimeout(timeOut);
            let value = $(this).val().trim();
            if (value == "")
                $("#div-search_result").hide();
            else {
                timeOut = setTimeout(Search, 200);
                $("#div-search_result").show();
            }
        })

        function Search() {

            let s = $("#search").val().trim();
            $.post("./Ajax/Search", {
                search: s
            }, function(result) {
                $("#search_result").children("li").remove();
                $("#search_result").append(`<li><h4>Hiển thị kết quả cho "${s}"</h4></li>`);

                if ($("#search").val().trim().length > 1 && (result)) {
                    $("#search_result li")[0].append(`Tìm được ${result.length} sản phẩm`);
                    for (let data of result) {
                        $("#search_result").append(`
                    <li>
                    <a href='./Detail/${data.link}'>
                     <img src='${data.thumbnail}' height='50'> 
                 
                        <p>
                            <b>${data.title}</b>
                            <br> 
                            <span style='color: black; font-size: .95rem'>
                                ${data.cpu ? data.cpu : "" }  ${data.ram ? data.ram + 'GB' : ""}  ${data.storage ? data.storage+'GB' :""}  ${data.screen ? data.screen+'inch': ""}  ${data.os?data.os:""}
                            </span>
                            <br>
                            <span style='color: red'>
                                    ${data.price_out}<sup>đ</sup>
                                    </span> 
                                    <s style="color: #97a4c3; font-size: .8rem">${data.price}</s>
                                
                        </p>
                     </a>
                     </li>`)
                    }
                } else $("#search_result").append(`<li style='text-align: center'>Không có kết quả nào</li>`);
            }, "json")
        }
        $(window).click(function(e) {
            if ($(e.target).is('#div-search_result span'))
                $("#div-search_result").hide();
        })
    </script>

</div>


    <script src="./lib/sweetalert2/sweetalert2.all.min.js"></script>
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
</body>

</html>