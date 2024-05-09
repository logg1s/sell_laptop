$(document).ready(function () {

    $("#myImg").click(function () {
        $("#myModal").css("display", "block");
        $("#img01").attr("src", this.src);
        $("#caption").html(this.alt);
    });

    $('.modal').click(function () {
        $("#myModal").css("display", "none");
    });

    $('.modal-content, #caption').click(function (event) {
        event.stopPropagation();
    });


 var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "105516815843958");
      chatbox.setAttribute("attribution", "biz_inbox");
 

 
 
});


(function ($) {

    $.fn.numberstyle = function (options) {

        var settings = $.extend({
            value: 0,
            step: undefined,
            min: undefined,
            max: undefined
        }, options);

        return this.each(function (i) {

            var input = $(this);

            var container = document.createElement('div'),
                btnAdd = document.createElement('div'),
                btnRem = document.createElement('div'),
                min = (settings.min) ? settings.min : input.attr('min'),
                max = (settings.max) ? settings.max : input.attr('max'),
                value = (settings.value) ? settings.value : parseInt(input.val());
            container.className = 'numberstyle-qty';
            btnAdd.className = (max && value >= max) ? 'qty-btn qty-add disabled' : 'qty-btn qty-add';
            btnAdd.innerHTML = '+';
            btnRem.className = (min && value <= min) ? 'qty-btn qty-rem disabled' : 'qty-btn qty-rem';
            btnRem.innerHTML = '-';
            input.wrap(container);
            input.closest('.numberstyle-qty').prepend(btnRem).append(btnAdd);


            $(document).off('click', '.qty-btn').on('click', '.qty-btn', function (e) {

                var input = $(this).siblings('input'),
                    sibBtn = $(this).siblings('.qty-btn'),
                    step = (settings.step) ? parseInt(settings.step) : parseInt(input.attr('step')),
                    min = (settings.min) ? settings.min : (input.attr('min')) ? input.attr('min') : undefined,
                    max = (settings.max) ? settings.max : (input.attr('max')) ? input.attr('max') : undefined,
                    oldValue = parseInt(input.val()),
                    newVal;


                if ($(this).hasClass('qty-add')) {

                    newVal = (oldValue >= max) ? oldValue : oldValue + step,
                        newVal = (newVal > max) ? max : newVal;

                    if (newVal == max) {
                        $(this).addClass('disabled');
                    }
                    sibBtn.removeClass('disabled');


                } else {

                    newVal = (oldValue <= min) ? oldValue : oldValue - step,
                        newVal = (newVal < min) ? min : newVal;

                    if (newVal == min) {
                        $(this).addClass('disabled');
                    }
                    sibBtn.removeClass('disabled');

                }


                input.val(newVal).trigger('change');

            });

            input.on('change', function () {

                const val = parseInt(input.val()),
                    min = (settings.min) ? settings.min : (input.attr('min')) ? input.attr('min') : undefined,
                    max = (settings.max) ? settings.max : (input.attr('max')) ? input.attr('max') : undefined;

                if (val > max) {
                    input.val(max);
                }

                if (val == "" || val < min) {
                    input.val(min);
                }
            });

        });
    };


    $('.numberstyle').numberstyle();
    TotalMoney();
}(jQuery));


$(document).ready(function () {
    $('input.checkbox__Cart').each(function () {
        let pid = $(this).data("id");
        $.post("./Ajax/GetChecked", { id: pid }, function (result) {
            if (result == "1")
                $(".row_Cart input[data-id=" + pid + "]").prop('checked', true);
            else $(".row_Cart input[data-id=" + pid + "]").prop('checked', false);
        })
    }
    )

    let value = $(".numberstyle-qty input").val();
    $(".numberstyle-qty input").change(function () {
        let min = $(this).attr("min");
        let max = $(this).attr("max");
        if ($(this).val() < value || $(this).val() > value) {
            let pid = $(this).data("id");
            $.post("./Ajax/CartUpdate", { id: pid, num: $(this).val() }, function (result) {
                $("span[data-id=" + pid + "]").html(`${result}<sup>đ</sup>`);
            })
        }

        if ($(this).val() == max)
            $(this).closest("div").siblings(".maxNum").html('<p>Đã đạt đến số lượng tối đa</p>');
        else $(this).closest("div").siblings(".maxNum").html(" ");
        value = $(this).val();
        setTimeout(() => TotalMoney(), 500);
        setTimeout(() => GetCartNum(), 500);
    })

    $(".cart__item-delete").click(function () {
        let pid = $(this).closest("div").data("id");
        $.post('./Ajax/CartDelete', { id: pid }, function (result) {

            if (result === "true") {
                $("div[data-id=" + pid + "]").remove();
                $("div[data-id=" + pid + "]").removeClass("row_Cart");
            }
        });
        setTimeout(() => TotalMoney(), 500);
        setTimeout(() => checkNum(), 500);
        setTimeout(() => GetCartNum(), 500);
    });
    $('#addCart').click(function() {
        let pid = $(".detail").data('id');
        let pnum = $("#number_product").val();
        $.post('./Ajax/AddToCart', { id: pid, num: pnum }, function (result) {
            if (result) {
                $(".modal__content").html("<i class='fa-solid fa-circle-check' style='font-size: 2rem; color: green;'></i><p style='font-size: 1.1rem; color: white; text-align: center'>Thêm vào giỏ hàng thành công</p>");

            }
            else {
                $(".modal__content").html("<i class='fa-solid fa-circle-xmark' style='font-size: 2rem; color: red;'></i><p style='font-size: 1.1rem; color: white;text-align: center'>Thêm vào giỏ hàng thất bại.<br> Đã đạt số lượng tối đa trong giỏ hàng</p>");
            }
            $(".modal__box").css("display", 'block');

        });
        setTimeout(() => $(".modal__box").fadeOut(), 3000);
        setTimeout(() => GetCartNum(), 100);
    });
    setTimeout(() => CheckAll(), 1500)
});
function CheckAll() {
    $('input.checkbox__Cart').each(function () {
        if (!$(this).is(":checked")) {
            $("#select__All").prop("checked", false);
            return false;
        }
        $("#select__All").prop("checked", true);
    })
}
$("input[type=checkbox]").change(function () {
    let pid = $(this).data('id');
    let check = 0;
    if ($(this).is(':checked'))
        check = 1;
    $.post("./Ajax/CheckboxUpdate", { id: pid, checked: check }, function (result) {
    })
    setTimeout(() => CheckAll(), 500);
    setTimeout(() => TotalMoney(), 500);
    setTimeout(() => GetCartNum(), 500);
})



function TotalMoney() {
    let sum = 0;
    let count = 0;
    let countCheckbox = 0;
    $('.row_Cart input[type=checkbox]:checked').each(function () {
        let id = $(this).data('id');
        let money = parseInt($("span[data-id=" + id + "]").text().replace(/\./g, ""));
        sum += money;
        count += parseInt($(".numberstyle-qty input[data-id=" + id + "]").val());
        countCheckbox++;
    });
    console.log("sum: " + sum + "\ncount: " + count)
    $("#selectedCheckbox").text(countCheckbox + " mục được chọn");
    $(".cart__detail-right h3 span").text(count);
    $(".cart__detail-right .price__VND").text(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
}
// Checkbox(1);
function Checkbox(action) {
    $('input[type=checkbox]').each(function () {

        if (action) {
            if (!$(this).is(':checked'))
                $(this).trigger("click");
        }
        else {
            if ($(this).is(':checked'))
                $(this).trigger("click");
        }

    })
    setTimeout(() => GetCartNum(), 500);
    setTimeout(() => TotalMoney(), 500);
}

$("#select__All").change(function () {
    if ($(this).is(':checked'))
        Checkbox(1);
    else Checkbox(0);
    setTimeout(() => GetCartNum(), 500);
});




function deleteAll() {
    if (confirm("Xóa tất cả sản phẩm trong giỏ hàng?")) {
        $(".cart__item-delete").each(function () {
            $(this).trigger('click');
        })
        setTimeout(() => checkNum(), 500);
        setTimeout(() => GetCartNum(), 500);
    }
}
checkNum();
function checkNum() {
    if (!$(".row_Cart").length) {
        $("#show__Cart").css("display", 'none');
        $("#no__Cart").css('display', 'flex');
        $("#Cart__Title").css('display', 'none');
    }
}


// $("#close__modal").click(function() {
//     $(".modal__box").fadeOut();
// });
$(window).click(function (e) {
    if ($(e.target).is('.modal__bg'))
        $(".modal__box").fadeOut();
})
GetCartNum();
function GetCartNum() {
    $.post("./Ajax/GetCartNum", {}, function (result) {
        // $("#number__cart").animate({
        //     minWidth: "+=10px",
        //     height: "+=10px",
        //     lineHeight: "+=10px",
        //     backgroundColor: "yellow"
        // })
        // $("#number__cart").animate({
        //     minWidth: "25px"
        //     ,height: "25px",
        //     lineHeight: "-=10px"
        // })
        if (result == "0")
            $("#number__cart").hide();
        else
            $("#number__cart").text(result).show();

    })
}

// $(".detail_userinfo").click(function(){
//     $("#table_order").hide();
//     $("#user_detail_right").show();
// })

// $(".detail_order").click(function(){
//     $("#table_order").show();
//     $("#user_detail_right").hide();
// })

   <!-- Messenger Plugin chat Code -->
    // <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    // <div id="fb-customer-chat" class="fb-customerchat">
    // </div>
    
    // Tạo thẻ div cho fb-root
var fbRootDiv = document.createElement("div");
fbRootDiv.setAttribute("id", "fb-root");

// Tạo thẻ div cho fb-customer-chat
var fbCustomerChatDiv = document.createElement("div");
fbCustomerChatDiv.setAttribute("id", "fb-customer-chat");
fbCustomerChatDiv.classList.add("fb-customerchat");

// Thêm fbRootDiv và fbCustomerChatDiv vào body của trang web
document.body.appendChild(fbRootDiv);
document.body.appendChild(fbCustomerChatDiv);


   
     
   

