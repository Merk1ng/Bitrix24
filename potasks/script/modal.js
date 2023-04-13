
jQuery('.product').ready(function () {
    pm()
});

function popup(href, class1, class2) {

    if (href == 'close') {
        if (jQuery('*').is('.modal')) {
            jQuery('.modal').addClass('zoomOut animated')
            jQuery('.modalback').addClass('fadeOut animated')
            setTimeout(function () {
                jQuery('.modal').remove()
            }, 550)
            setTimeout(function () {
                jQuery('.modalback').remove()
            }, 550)

        }

    } else {

        if (jQuery('*').is('.modal')) {
            jQuery('.modalback').remove();
            jQuery('.modal').remove();

        } else {
            jQuery.get(
                    href, function (data) {

                        if (class1) {
                            cls = class1;
                        } else {
                            cls = 'content';
                        }
                        var page = jQuery(data).find("." + cls).html();
                        console.log("." + cls);
                        console.log(page);
                        jQuery('.modal').append(page + "<script>swiper()</script>");
                        jQuery('.modal').ready(function () {
                            pm();
                            jQuery('#page-preload').delay(550).fadeOut(800);
                        });
                    }
            );

            jQuery('body').append("<div style='top:" + (jQuery('body').scrollTop() + jQuery(window).height() / 5) + "px;' class='modal zoomIn animated'><div class='whiteloader' id='page-preload'><span class='spinner infinite rotateIn'>W</span></div><div class='modalclose' onclick='popup(\"close\")'>&times;</div></div><div class='modalback fadeIn animated' onclick='popup(\"close\")'></div>");

        }
    }


}
;

function message(m)
{
    jQuery('body').append("<div style='top:" + (jQuery('body').scrollTop() + jQuery(window).height() / 5) + "px;' class='modal message zoomIn animated'>" + m + "<div class='modalclose' onclick='popup(\"close\")'>&times;</div></div><div class='modalback fadeIn animated' onclick='popup(\"close\")'></div>");
}

jQuery('.seek a').click(function () {
//if(jQuery('*').is('.modal')) {

    jQuery('.module_list span').remove();
// } 
// else {
    jQuery.get(
            jQuery(this).attr("href"), onAjaxSuccess
            );

    function onAjaxSuccess(data)
    {
        var page = jQuery(data).find('.module_list').html();


        jQuery('.module_list').append(page);
    }

// }	


});


function fpages(a) {
    jQuery.get("?page=" + a, b);
    function b(a) {
        var b = jQuery(a).find(".module_list").html();
        jQuery(".module_list").html("");
        jQuery(".module_list").append(b);
    }
}
function onAjaxSuccess(data)
{
    var page = jQuery(data).find('.module_list').html();
    jQuery('.module_list').append("<script>pm();</script>" + page);
}



jQuery('.fpagination span').click(function () {
    jQuery('.fpagination span').removeClass("active");
    jQuery(this).toggleClass("active");

});

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};


function addcart(id, f) {

    var pcart = 0;
    var incart = [];
    var qua = 0;

    if (id) {

        jQuery(".cartlist>i").remove();
        var adb = jQuery('#prod_' + f + id);
        var it_qty = adb.attr("data-qua");
        var it_pri = adb.attr("data-price");

        var it_name = adb.attr("data-name");



        if (jQuery("div").is("#" + id)) {

            $("#" + id).find('.pqty .qval').html(parseFloat($("#" + id).find('.pqty .qval').html()) + parseFloat(it_qty))


        } else {
            jQuery(".cartlist").append("<div id='" + id + "'><span class='pname'>" + it_name + "</span><span class='premove'>&times;</span><span class='price'>" + it_pri + "</span><span class='pqty'><b class='minus' onclick='recalc()'>-</b><b class='qval'>" + it_qty + "</b><b class='plus' onclick='recalc()'>+</b></span></div>")
        }

    }
    jQuery(".cartlist div").each(function () {


        var summ = parseFloat($(this).find('span.price').html().replace(/\s+/g, '')) * parseFloat($(this).find('span.pqty .qval').html())

        pcart = pcart + summ;
        qua = qua + parseFloat($(this).find('span.pqty .qval').html());

        incart.push($(this).find('span.pname').html() + "|" + $(this).find('span.price').html() + "|" + $(this).find('span.pqty .qval').html() + "|" + $(this).attr('id'));


    })
    if ($("div").is(".cartlist")) {
        localStorage.setItem('incart', JSON.stringify(incart));


        $('span.ptotal, .minicart span').html(((pcart).formatMoney(2, ',', ' ')).replace(/,00/g, ".-"));
    }



    $("span.premove").click(function () {

        $(this).parent().remove();
        addcart();

    })


    $('.fdelivery').html(d_check(pcart));

    if ($(".cartlist div").html() && $('div').is('.checkbut') == false) {

        $(".cart").append("<div class='checkbut'><a class='button button-pill button-flat-highlight' href='/checkout' >Оформить заказ</a></div>")
    } else if ($(".cartlist div").html() == null) {
        $("div.checkbut").remove()
    }
    if ($("div").is(".cartlist")) {
        $(".minicart i").html(qua);
        if (qua == 0) {
            $(".minicart span").html("Корзина пуста");
            $(".cartlist").html("<i>Корзина пуста</i>");
        }
    }
}

function d_check(d)

{
    if ((parseFloat(localStorage.getItem('freedelivery')) - d) > 0) {
        return "До бесплатной доставки осталось " + (parseFloat(localStorage.getItem('freedelivery')) - d).formatMoney(2, ',', ' ').replace(/,00/g, ".-");
    } else {
        return "Бесплатная доставка";
    }
}

function incart(d) {

    if ($(".in_cart>div").length == 0) {
        $('.in_cart').html('<span class="empty">Ваша корзина пуста<b></b></span>');
        disable_form()
    }

    var pcart = 0;
    var qua = 0;
    var incart = [];
    var order = [];
    jQuery(".in_cart>div").each(function () {

        var summ = parseFloat(jQuery(this).find('span.price').html().replace(/\s+/g, '')) * parseFloat($(this).find('span.pqty .qval').html())
        $(this).find('span.subtotal').html((summ).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));
        pcart = pcart + summ;

        qua = qua + parseFloat($(this).find('span.pqty .qval').html());

        incart.push($(this).find('span.pname').html() + "|" + $(this).find('span.price').html() + "|" + $(this).find('span.pqty .qval').html() + "|" + $(this).attr('id'));

        order.push($(this).find('span.pname').html() + "|" + $(this).find('span.price').html() + "|" + $(this).find('span.pqty .qval').html() + "|" + $(this).attr('id') + "|" + summ + "|" + pcart);

    })



    if (d_check(pcart) == "Бесплатная доставка") {
        select('remove');

    } else
    {
        select('add');
    }


    if (d) {

        $('.inrow_delivery .in_cost').html((parseFloat(d)).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));
        $('span.in_total').html((pcart + parseFloat(d)).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));
    } else {

        $('span.in_total').html((pcart).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));

    }

    if ($('select').is('#delivery')) {

        d = $('select#delivery').val();


        $('.inrow_delivery .in_cost').html((parseFloat(d)).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));

        $('input#delivery_f').val(" " + d + " руб.");

        $('span.in_total').html((pcart + parseFloat(d)).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));
    }


    localStorage.setItem('incart', JSON.stringify(incart));
    $("#formMail").find("#order").val(JSON.stringify(order));
    $('.minicart span').html((pcart).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));



    $(".minicart i").html(qua);
    if (qua == 0) {
        $(".minicart span").html("Корзина пуста");
    }



}

function recalc() {
    jQuery("span.pqty").each(function () {

        var form = $(this);
        var qty = $(form).find(".qval").html();

        $(form).find('.minus').click(function () {
            if (qty > 1) {
                qty--;
                $(form).find(".qval").html(qty);
                addcart();
            }
        })

        $(form).find('.plus').click(function () {
            qty++;
            $(form).find(".qval").html(qty);
            addcart();
        })

    })

}

function recalc2() {
    jQuery("span.pqty").each(function () {

        var form = $(this);
        var qty = $(form).find(".qval").html();

        $(form).find('.minus').click(function () {
            if (qty > 1) {
                qty--;
                $(form).find(".qval").html(qty);
                incart();
            }
        })

        $(form).find('.plus').click(function () {
            qty++;
            $(form).find(".qval").html(qty);
            incart();
        })

    })
    $(".in_cart span.remove").click(function () {
        $(this).parent().remove();
        incart();
    })
}

function fromcache() {

    var incart = localStorage.getItem('incart');
    var quz = 0;
    var st = 0;
    var total = 0;
    if (incart) {
        $.each($.parseJSON(incart), function () {
            var name = this.split('|')[0];
            var price = this.split('|')[1];
            var qua = this.split('|')[2];
            var classe = this.split('|')[3];
            $(".cartlist").append("<div id='" + classe + "'><span class='pname'>" + name + "</span><span class='premove'>&times;</span><span class='price'>" + price + "</span><span class='pqty'><b class='minus' onclick='recalc()'>-</b><b class='qval'>" + qua + "</b><b class='plus' onclick='recalc()'>+</b></span></div>")
            st = parseFloat(price.replace(/\s+/g, '')) * parseFloat(qua);
            total = total + st;
            quz = parseFloat(quz) + parseFloat(qua);

        })
        $('.minicart i').html(quz);
        (quz == 0) ? $('.minicart span').html('Корзина пуста') : $('.minicart span').html((total).formatMoney(2, ',', ' ').replace(/,00/g, ".-"));
    }
}
function swiper() {

    var mySwiper = new Swiper('.swc', {
        loop: true,
        direction: 'horizontal',

        pagination: '#cust-navigation',
        paginationClickable: true, speed: 500,
        slidesPerView: 1,
        autoplayDisableOnInteraction: false,
        grabCursor: true,
        autoplay: 3000
    })
}

function pm() {

    $("div.qua").each(function () {
        var form = $(this);
        var it_qty = $(form).find('input#quantity').val();
        $(form).find('button').attr('data-qua', it_qty);
        var it_max = "0";
        var it_unlim = "";
        $(form).find('span.minus').click(function () {
            if (it_qty > 1) {
                it_qty--;
                $(form).find('input#quantity').val(it_qty);
                $(form).find('button').attr('data-qua', it_qty);
            }
            ;
        });
        $(form).find('span.plus').click(function () {
            if (it_qty < it_max || it_unlim !== 0) {
                it_qty++;
                $(form).find('input#quantity').val(it_qty);
                $(form).find('button').attr('data-qua', it_qty);
            }
            ;
        });
    });

}

function gogo() {
    jQuery(".fpagination").remove();
    jQuery(".module_list").html("");
    jQuery(".module_list").append("<div class='pageloader' id='page-preload'><span class='spinner animate-spin'></span></div>");
    var a = jQuery('#filter fieldset[name="props"]').serializeArray();
    var b = jQuery('#filter fieldset[name="filters"]').serializeArray();
    console.log(jQuery.param(b) + "&empty=1");
    if ("" != a) jQuery.get(location.href, jQuery.param($.merge(a, b)), c); else jQuery.get(location.href, jQuery.param(b) + "&empty=1", c);
    function c(a) {
        var b = jQuery(a).find(".module_list").html();
        jQuery(".module_list").append(b);
        jQuery(".module_list").ready(function() {
            jQuery(".pageloader").delay(550).fadeOut(800);
        });
        //selectimg();
    }
}
function disable_form()
{
    $('#formMail input').each(function () {
        $(this).attr('readonly', true)
    });
    $('#formMail input').each(function () {
        $(this).attr('disabled', true)
    });
    $('#formMail span.plus').addClass('disabled');
    $('#formMail span.minus').addClass('disabled');

}

function showcart() {
    jQuery('.in_cart').remove();
    jQuery('.cart').remove();
    var incart = localStorage.getItem('incart');

    jQuery.post(location.href, {'incart': incart}, onAjaxSuccess3);




}

function onAjaxSuccess3(data)
{


    var page = jQuery(data).find('.in_cart').html();
    jQuery('.in_cart').append(page);
    incart();
    recalc2();

}

function onAjaxSuccess5(data)
{
    jQuery('.in_cart').remove();
    jQuery('.cart').remove();
    var page = jQuery(data).find('.in_cart').html();
    jQuery('.in_cart').append(page);

}


function pricereload(id, f)
{

    var price = eval(f);
    $('.p' + id).find('#price').html((price.formatMoney(2, ',', ' ')).replace(/,00/g, ".-"));
    $('.p' + id).find('#prod_1' + id).attr('data-price', price.formatMoney(2, ',', ' '));


}

function addcomment()
{
    link = $('form#form').attr('action');
    if ($('textarea[name="doc[document]"]').val() == '') {
        message('Текст комментария - обязателен!')
    } else if ($('input[name="doc[title]"]').val() == '') {
        message('Введите ваше имя!')
    } else {
        var s = jQuery('#form').serializeArray();


        if (s != '') {
            jQuery.post(link, s, onFormSuccess);
        }

//$("#form").submit();
    }

    function onFormSuccess(data)
    {
        jQuery('.message').remove();
        jQuery('.modalback ').remove();


        var page = jQuery(data).find('.message').html();
        message(page);
        $("#form").trigger('reset')

    }


}


 