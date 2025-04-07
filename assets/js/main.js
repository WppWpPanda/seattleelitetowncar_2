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
    }),
        $("#destination_airport").hide(), $("#pickup_airport").hide()
});