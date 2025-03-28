"use strict";

function initActive(e) {
    $('a[href="' + e + '"]').parent().addClass("active")
}

function hidePreloader() {
    $("#preloader").fadeOut()
}

$(function () {
    $(".scroll-down").viewportChecker({classToAdd: "animated bounce", offset: 0}), $(".scroll-down").click(function (e) {
        console.log("click");
        var i = $(this), t = $(this).attr("href");
        return 0 != $(t).length && ($(".navbar").hasClass("navbar-fixed-top") ? (console.log("has fixed"), $("html, body").animate({scrollTop: $(t).offset().top - 65}, 500, function () {
            i.hide()
        })) : $("html, body").animate({scrollTop: $(t).offset().top - 130}, 500, function () {
            i.hide()
        })), !1
    }), $("#term-agree").on("click", function () {
        $("#myModal").hide(), $(".agreed__checked").show()
    }), $(window).scroll(function () {
        $(this).scrollTop() > 250 ? ($(".my-navbar").addClass("navbar-fixed-top"), $(".brand").addClass("animated bounceIn")) : ($(".my-navbar").removeClass("navbar-fixed-top"), $(".brand").removeClass("animated bounceIn"))
    }), window.matchMedia("(min-width: 768px)").matches && ($(".fleet-item:odd").each(function () {
        $(this).addClass("flex-reverse"), $(this).find(".fleet-item__title").addClass("right-skew")
    }), $(".fleet-item:even").each(function () {
        $(this).find(".fleet-item__title").addClass("left-skew")
    })), $(window).resize(function () {
        window.matchMedia("(min-width: 768px)").matches && ($(".fleet-item:odd").each(function () {
            $(this).addClass("flex-reverse"), $(this).find(".fleet-item__title").addClass("right-skew")
        }), $(".fleet-item:even").each(function () {
            $(this).find(".fleet-item__title").addClass("left-skew")
        }))
    }), $(".rate-table__row").hover(function () {
        window.matchMedia("(min-width: 768px)").matches && ($(this).find(".btn-price").toggleClass("btn-price-hovered"), $(this).find(".btn-reserve").toggleClass("visible-xs"))
    }, function () {
        window.matchMedia("(min-width: 768px)").matches && ($(this).find(".btn-price").toggleClass("btn-price-hovered"), $(this).find(".btn-reserve").toggleClass("visible-xs"))
    }), $(".upload").click(function () {
        $(this).siblings($("input[type='file']")).trigger("click")
    }), $("input[type='file']").change(function () {
        var e = $(this).closest(".up"), i = e.find(".upload-val");
        i.text(this.value.replace(/C:\\fakepath\\/i, ""))
    }), $(".plus").on("click", function () {
        console.log("click");
        var e = $(this).siblings("#num-vehicles").val(), i = parseInt(e) + 1;
        $(this).siblings("#num-vehicles").val(i);
        var t = $(this).siblings(".num");
        t.text(i)
    }), $(".minus").on("click", function () {
        var e = $(this).siblings("#num-vehicles").val();
        if (!(parseInt(e) <= 1)) {
            var i = parseInt(e) - 1;
            $(this).siblings("#num-vehicles").val(i), $(this).siblings(".num").text(i)
        }
    }), $(".faq-block__heading").on("click", function () {
        var e = $(this).find(".faq-block__title");
        $(".faq-wrap .open").each(function () {
            $(this).is(e) || $(this).removeClass("open")
        }), $(this).find(".faq-block__title").toggleClass("open")
    }), $("label[for='submit_agree']").on("click", function (e) {
        var i = $(this).find("span"), t = "agreed__checked", s = i.hasClass(t);
        s ? i.removeClass(t) : i.addClass(t)
    }), $(".pickup .agreed").on("click", function (e) {
        var i = $(this).find(".agreed__checkbox span"), t = "agreed__checked", s = i.hasClass(t);
        s ? i.removeClass(t) : (i.addClass(t), $("#address2").val($("#address").val()), $("#city2").val($("#city").val()), $("#zip2").val($("#zip").val()), $("#phone").val($("#mobile").val()), $("#state2").val($("#state").val()))
    }), $("#billing-same").on("click", function (e) {
        var i = $(this).find(".agreed__checkbox span"), t = "agreed__checked", s = i.hasClass(t);
        s ? (i.removeClass(t), $(this).next(".row").removeClass("hidden")) : (i.addClass(t), $(this).next(".row").addClass("hidden"))
    }), $("input[name=pickup]").change(function (e) {
        var i = $(this).data("show"), t = $(this).data("hide");
        $(i).show(), $(t).hide(), "street" == $(this).val() ? ($("#pickup_street .required_s").each(function () {
            $(this).addClass("required")
        }), $("#pickup_airport .required_a").each(function () {
            $(this).removeClass("required")
        })) : ($("#pickup_street .required_s").each(function () {
            $(this).removeClass("required")
        }), $("#pickup_airport .required_a").each(function () {
            $(this).addClass("required")
        }))
    }), $("input[name=destination]").change(function () {
        var e = $(this).data("show"), i = $(this).data("hide");
        $(e).show(), $(i).hide(), "street" == $(this).val() ? ($("#destination_street .required_s").each(function () {
            $(this).addClass("required")
        }), $("#destination_airport .required_a").each(function () {
            $(this).removeClass("required")
        })) : ($("#destination_street .required_s").each(function () {
            $(this).removeClass("required")
        }), $("#destination_airport .required_a").each(function () {
            $(this).addClass("required")
        }))
    }), $("input[name=payment]").change(function () {
        "credit_card" == $(this).val() ? ($(".pyment_by_card").show(), $(".required_c").each(function () {
            $(this).addClass("required")
        }), $(".required_b").each(function () {
            $(this).removeClass("required")
        })) : ($(".pyment_by_card").hide(), $(".required_c").each(function () {
            $(this).removeClass("required")
        }), $(".required_b").each(function () {
            $(this).addClass("required")
        }))
    }), $("#destination_airport").hide(), $("#pickup_airport").hide()
});