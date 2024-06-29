!(function(e) {
    e(document).ready(function() {
            e("body").addClass("js");
            var t = e("#menu"),
                o = e(".menu-link");
            o.click(function() {
                return o.toggleClass("active"), t.toggleClass("active"), !1;
            });
        }),
        videoPopup(),
        $(".owl-carousel").owlCarousel({ loop: false, items, 3 }),
        e(".owl-carousel").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            autoplay: !0,
            autoplayTimeout: 5e3,
            autoplayHoverPause: !0,
            responsive: {
                0: { items: 1 },
                550: { items: 2 },
                750: { items: 3 },
                1000: { items: 4 },
                1200: { items: 5 },
            },
        }),
        e(".Modern-Slider").slick({
            autoplay: !0,
            autoplaySpeed: 1e4,
            speed: 600,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: !1,
            dots: !0,
            pauseOnDotsHover: !0,
            cssEase: "fade",
            draggable: !1,
            prevArrow: '<button class="PrevArrow"></button>',
            nextArrow: '<button class="NextArrow"></button>',
        }),
        e("div.features-post").hover(
            function() {
                e(this).find("div.content-hide").slideToggle("medium");
            },
            function() {
                e(this).find("div.content-hide").slideToggle("medium");
            }
        ),
        e("#tabs").tabs(),
        (function() {
            var e, t;
            (e = new Date().getFullYear() + 1 + "/1/1"),
            (t = setInterval(function() {
                var o = (function(e) {
                    var t = Date.parse(e) - Date.parse(new Date()),
                        o = Math.floor((t / 1e3) % 60),
                        n = Math.floor((t / 1e3 / 60) % 60),
                        a = Math.floor((t / 36e5) % 24);
                    return {
                        total: t,
                        days: Math.floor(t / 864e5),
                        hours: a,
                        minutes: n,
                        seconds: o,
                    };
                })(e);
                (document.querySelector(".days > .value").innerText = o.days),
                (document.querySelector(".hours > .value").innerText = o.hours),
                (document.querySelector(".minutes > .value").innerText = o.minutes),
                (document.querySelector(".seconds > .value").innerText = o.seconds),
                o.total <= 0 && clearInterval(t);
            }, 1e3));
        })();
})(jQuery);
$(".nav li:first").addClass("active");
var showSection = function(t, e) {
        var o = t.replace(/#/, ""),
            i =
            $(".section")
            .filter('[data-section="' + o + '"]')
            .offset().top - 0;
        e
            ?
            $("body, html").animate({ scrollTop: i }, 800) :
            $("body, html").scrollTop(i);
    },
    checkSection = function() {
        $(".section").each(function() {
            var t = $(this),
                e = t.offset().top - 80,
                o = e + t.height(),
                i = $(window).scrollTop();
            if (e < i && o > i) {
                var a = t.data("section");
                $("a")
                    .filter("[href*=\\#" + a + "]")
                    .closest("li")
                    .addClass("active")
                    .siblings()
                    .removeClass("active");
            }
        });
    };
$(".main-menu, .scroll-to-section").on("click", "a", function(t) {
        $(t.target).hasClass("external") ||
            (t.preventDefault(),
                $("#menu").removeClass("active"),
                showSection($(this).attr("href"), !0));
    }),
    $(window).scroll(function() {
        checkSection();
    });