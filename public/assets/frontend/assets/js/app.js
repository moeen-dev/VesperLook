var THEMEIM = THEMEIM || {};

(function ($) {
    // USE STRICT
    "use strict";

    THEMEIM.initialize = {
        init: function () {
            THEMEIM.initialize.general();
            THEMEIM.initialize.mobileMenu();
        },

        general: function () {
            /* Main Slider  */
            $(".slider-start").owlCarousel({
                loop: true,
                nav: false,
                items: 1,
                autoplay: false,
                dots: true,
                smartSpeed: 600,
            });

            $(".slider-start").on("translate.owl.carousel", function () {
                $(".slider-img").removeClass("fadeInDown animated").hide();
            });

            $(".slider-start").on("translated.owl.carousel", function () {
                $(".slider-img").addClass("fadeInDown animated").show();
            });

            $(".slider-start").on("translate.owl.carousel", function () {
                $(".slider-text h4").removeClass("fadeInUp animated").hide();
            });

            $(".slider-start").on("translated.owl.carousel", function () {
                $(".slider-text h4").addClass("fadeInUp animated").show();
            });

            $(".slider-start").on("translate.owl.carousel", function () {
                $(".slider-text h1").removeClass("fadeInUp animated").hide();
            });

            $(".slider-start").on("translated.owl.carousel", function () {
                $(".slider-text h1").addClass("fadeInUp animated").show();
            });

            $(".slider-start").on("translated.owl.carousel", function () {
                $(".slider-text p").addClass("fadeInUp animated").show();
            });

            $(".slider-start").on("translate.owl.carousel", function () {
                $(".slider-text p").removeClass("fadeInUp animated").hide();
            });

            $(".slider-start").on("translated.owl.carousel", function () {
                $(".slider-text a").addClass("fadeInUp animated").show();
            });

            $(".slider-start").on("translate.owl.carousel", function () {
                $(".slider-text a").removeClass("fadeInUp animated").hide();
            });

            /* Instagram Slider  */
            $(".instagram-slider").owlCarousel({
                loop: true,
                nav: false,
                items: 5,
                autoplay: true,
                dots: false,
                responsive: {
                    320: {
                        items: 1,
                    },
                    480: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    992: {
                        items: 4,
                    },
                    1300: {
                        items: 5,
                    },
                },
            });

            /* Product filter   */
            $(".main-product").imagesLoaded(function () {
                var $grid = $(".grid").isotope({
                    // options
                    itemSelector: ".grid-item",
                    stagger: 30,
                });

                //Product filter active menu
                $(".pro-tab-button .filter").on("click", function () {
                    $(".pro-tab-button .filter").removeClass("active");
                    $(this).addClass("active");
                });

                $(".pro-tab-button").on("click", "li", function () {
                    var filterValue = $(this).attr("data-filter");
                    $grid.isotope({
                        filter: filterValue,
                    });
                });
            });

            /* Blog filter   */

            $(".blog-wrapper").imagesLoaded(function () {
                var $grid = $(".grid").isotope({
                    // options
                    itemSelector: ".grid-item",
                    stagger: 30,
                });

                //Blog filter active menu
                $(".pro-tab-button .filter").on("click", function () {
                    $(".pro-tab-button .filter").removeClass("active");
                    $(this).addClass("active");
                });

                $(".pro-tab-button").on("click", "li", function () {
                    var filterValue = $(this).attr("data-filter");
                    $grid.isotope({
                        filter: filterValue,
                    });
                });
            });

            /* Client Slider  */
            $(".client-car").owlCarousel({
                loop: true,
                nav: false,
                items: 5,
                autoplay: true,
                dots: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>",
                ],
                responsive: {
                    320: {
                        items: 1,
                    },
                    576: {
                        items: 2,
                    },

                    768: {
                        items: 3,
                    },
                    992: {
                        items: 4,
                    },
                },
            });

            /* Testimonial Slider  */
            $(".testimonial-carousel").owlCarousel({
                loop: true,
                nav: false,
                items: 2,
                autoplay: true,
                dots: true,
                responsive: {
                    320: {
                        items: 1,
                    },
                    576: {
                        items: 1,
                    },

                    768: {
                        items: 1,
                    },
                    992: {
                        items: 2,
                    },
                },
            });

            /* Product Slider  */
            $(".prod-carousel").owlCarousel({
                loop: true,
                nav: false,
                items: 3,
                autoplay: true,
                dots: false,
                responsive: {
                    320: {
                        items: 1,
                    },
                    600: {
                        items: 2,
                    },
                    768: {
                        items: 2,
                    },
                    1200: {
                        items: 4,
                    },
                },
            });

            /* Category Slider  */
            $(".category-carousel").owlCarousel({
                loop: true,
                nav: false,
                items: 3,
                autoplay: true,
                dots: false,
                responsive: {
                    320: {
                        items: 1,
                    },
                    440: {
                        items: 2,
                    },
                    900: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    },
                },
            });

            //Product Single Details

            $(".slider-for").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: ".slider-nav",
                swipe: false,
            });

            $(".slider-nav").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: ".slider-for",
                focusOnSelect: true,
                swipe: false,
                infinite: false,
                arrows: true,
            });

            // $(".trigger").on("click", function (e) {
            //     e.preventDefault();
            //     var mask = '<div class="mask-overlay">';

            //     $(".quickview-wrapper").toggleClass("open");
            //     $(mask).hide().appendTo("body").fadeIn("fast");
            //     $(".mask-overlay, .close-qv").on("click", function () {
            //         $(".quickview-wrapper").removeClass("open");
            //         $(".mask-overlay").remove();
            //     });
            // });

            // Open modal and overlay before AJAX content loads
            $(".trigger").on("click", function (e) {
                e.preventDefault();

                var mask = '<div class="mask-overlay">';

                $(".quickview-wrapper").toggleClass("open");
                $(mask).hide().appendTo("body").fadeIn("fast");

                // Close modal when clicking on overlay or close button
                $(".mask-overlay, .close-qv").on("click", function () {
                    $(".quickview-wrapper").removeClass("open");
                    $(".mask-overlay").remove();
                });

                // Load AJAX content into the modal
                var productId = $(this).data("id");
                $("#quickview-ajax-content").html(
                    '<div class="text-center py-5">Loading Product Details...</div>'
                );

                $.ajax({
                    url: "/product/quick-view/" + productId,
                    method: "GET",
                    success: function (data) {
                        $("#quickview-ajax-content").html(data);

                        // Reinitialize slider after content is loaded (if you're using Slick)
                        $(".slider-for").slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: true,
                            fade: true,
                            asNavFor: ".slider-nav",
                        });
                        $(".slider-nav").slick({
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            asNavFor: ".slider-for",
                            dots: false,
                            centerMode: false,
                            focusOnSelect: true,
                        });

                        // Re-attach event listeners to overlay and close button after AJAX content is loaded
                        $(".mask-overlay, .close-qv").on("click", function () {
                            $(".quickview-wrapper").removeClass("open");
                            $(".mask-overlay").remove();
                        });
                    },
                    error: function () {
                        $("#quickview-ajax-content").html(
                            '<div class="text-danger text-center">Sorry! Failed to load product.</div>'
                        );
                    },
                });
            });

            // Close modal
            $(document).on("click", ".mask-overlay, .close-qv", function () {
                $(".quickview-wrapper").removeClass("open");
                $(".mask-overlay").fadeOut(function () {
                    $(this).remove();
                });
            });

            //Product plus minus

            $(".cart-plus-minus-button").append(
                '<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>'
            );
            $(".qtybutton").on("click", function () {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.text() == "+") {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find("input").val(newVal);
            });

            /*---------------------
         Back to Top
         --------------------- */

            var backtotop = $(".backtotop");

            var windo = $(window),
                HtmlBody = $("html, body");

            backtotop.on("click", function () {
                HtmlBody.animate(
                    {
                        scrollTop: 0,
                    },
                    1500
                );
            });

            new WOW().init();

            /*---------------------
          Search toggle class
          ------------------------- */

            $(".top-search a").on("click", function () {
                $(".search-input").toggleClass("active");
            });

            /*---------------------
          Cart top show hide toggle
          ------------------------- */

            $(".top-cart > a").on("click", function () {
                $(".cart-drop").toggleClass("active");
            });

            /*---------------------
          Menu three toggle
          ------------------------- */

            $(".menu-btn a").on("click", function () {
                $(this).toggleClass("active");

                $(".mainmenu").toggleClass("active");

                $("body").toggleClass("menu-open");
            });

            /*---------------------
          price-slider active
          ------------------------- */

            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 600,
                values: [60, 570],
                slide: function (event, ui) {
                    $("#amount").val(
                        "$" + ui.values[0] + " to $" + ui.values[1]
                    );
                },
            });
            $("#amount").val(
                "$" +
                    $("#slider-range").slider("values", 0) +
                    " to $" +
                    $("#slider-range").slider("values", 1)
            );

            /*---------------------
         Google Map
         ------------------------- */

            $(".gmap3-area").each(function () {
                var $this = $(this),
                    key = $this.data("key"),
                    lat = $this.data("lat"),
                    lng = $this.data("lng"),
                    mrkr = $this.data("mrkr");

                $this
                    .gmap3({
                        center: [lat, lng],
                        zoom: 16,
                        scrollwheel: false,
                        mapTypeId: "shadeOfGrey", // to select it directly
                        mapTypeControlOptions: {
                            mapTypeIds: [
                                google.maps.MapTypeId.ROADMAP,
                                "shadeOfGrey",
                            ],
                        },
                        style: [
                            {
                                featureType: "poi.business",
                                elementType: "all",
                                stylers: [
                                    {
                                        hue: "#ff00ca",
                                    },
                                    {
                                        saturation: "100",
                                    },
                                    {
                                        lightness: "0",
                                    },
                                    {
                                        gamma: "1",
                                    },
                                ],
                            },
                            {
                                featureType: "poi.business",
                                elementType: "labels.icon",
                                stylers: [
                                    {
                                        hue: "#ff0000",
                                    },
                                ],
                            },
                        ],
                    })
                    .marker(function (map) {
                        return {
                            position: map.getCenter(),
                            icon: mrkr,
                        };
                    })
                    .styledmaptype(
                        "shadeOfGrey",
                        [
                            {
                                featureType: "administrative.land_parcel",
                                elementType: "all",
                                stylers: [
                                    {
                                        visibility: "off",
                                    },
                                ],
                            },
                            {
                                featureType: "landscape.man_made",
                                elementType: "all",
                                stylers: [
                                    {
                                        visibility: "off",
                                    },
                                ],
                            },
                            {
                                featureType: "poi",
                                elementType: "labels",
                                stylers: [
                                    {
                                        visibility: "off",
                                    },
                                ],
                            },
                            {
                                featureType: "road",
                                elementType: "labels",
                                stylers: [
                                    {
                                        visibility: "simplified",
                                    },
                                    {
                                        lightness: 20,
                                    },
                                ],
                            },
                            {
                                featureType: "road.highway",
                                elementType: "geometry",
                                stylers: [
                                    {
                                        hue: "#f49935",
                                    },
                                ],
                            },
                            {
                                featureType: "road.highway",
                                elementType: "labels",
                                stylers: [
                                    {
                                        visibility: "simplified",
                                    },
                                ],
                            },
                            {
                                featureType: "road.arterial",
                                elementType: "geometry",
                                stylers: [
                                    {
                                        hue: "#fad959",
                                    },
                                ],
                            },
                            {
                                featureType: "road.arterial",
                                elementType: "labels",
                                stylers: [
                                    {
                                        visibility: "off",
                                    },
                                ],
                            },
                            {
                                featureType: "road.local",
                                elementType: "geometry",
                                stylers: [
                                    {
                                        visibility: "simplified",
                                    },
                                ],
                            },
                            {
                                featureType: "road.local",
                                elementType: "labels",
                                stylers: [
                                    {
                                        visibility: "simplified",
                                    },
                                ],
                            },
                            {
                                featureType: "transit",
                                elementType: "all",
                                stylers: [
                                    {
                                        visibility: "off",
                                    },
                                ],
                            },
                            {
                                featureType: "water",
                                elementType: "all",
                                stylers: [
                                    {
                                        hue: "#a1cdfc",
                                    },
                                    {
                                        saturation: 30,
                                    },
                                    {
                                        lightness: 49,
                                    },
                                ],
                            },
                        ],
                        {
                            name: "Shades of Grey",
                        }
                    );
            });

            /*---------------------
            Headroom
            ------------------------- */

            $("#header").each(function () {
                var header = document.querySelector("#header");

                var headroom = new Headroom(header, {
                    tolerance: {
                        down: 10,
                        up: 20,
                    },
                    offset: 205,
                });
                headroom.init();
            });

            var myElement = document.querySelector(".mobile-header");
            var headroom = new Headroom(myElement);

            headroom.init({
                offset: 80,

                tolerance: {
                    up: 80,
                    down: 80,
                },

                classes: {
                    top: "headroom--top",
                },
            });
        },

        /*==================================*/
        /*=           Mobile Menu          =*/
        /*==================================*/

        mobileMenu: function () {
            var Accordion = function (el, multiple) {
                this.el = el || {};

                this.multiple = multiple || false;

                var dropdownlink = this.el.find(".link");
                dropdownlink.on(
                    "click",
                    {
                        el: this.el,
                        multiple: this.multiple,
                    },
                    this.dropdown
                );
            };

            Accordion.prototype.dropdown = function (e) {
                e.preventDefault();
                var $el = e.data.el,
                    $this = $(this),
                    $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass("open");

                if (!e.data.multiple) {
                    //show only one menu at the same time
                    $el.find(".submenu")
                        .not($next)
                        .slideUp()
                        .parent()
                        .removeClass("open");
                }
            };

            var accordion = new Accordion($("#mobilemenu"), false);

            $(".accordion-wrapper .mobile-open").on("click", function () {
                $(".accordion").toggleClass("active");
            });

            $(".accordion .closeme").on("click", function () {
                $(this).parents(".accordion").removeClass("active");
            });

            $(".mobile-open").on("click", function (e) {
                e.preventDefault();
                var mask = '<div class="mask-overlay">';

                $("body").toggleClass("active");
                $(mask).hide().appendTo("body").fadeIn("fast");
                $(".mask-overlay, .closeme").on("click", function () {
                    $(".accordion").removeClass("active");
                    $(".mask-overlay").remove();
                });
            });
        },
    };

    THEMEIM.documentOnReady = {
        init: function () {
            THEMEIM.initialize.init();
        },
    };

    THEMEIM.documentOnLoad = {
        init: function () {
            $("#loader-wrapper").fadeOut("slow");
            $("#exampleModalCenter").modal("show");
            $("#exampleModaltwo").modal("show");
        },
    };

    THEMEIM.documentOnResize = {
        init: function () {},
    };

    THEMEIM.documentOnScroll = {
        init: function () {
            if ($(this).scrollTop() > 150) {
                $("header").addClass("hide-topbar");
            } else {
                $("header").removeClass("hide-topbar");
            }

            /* Back to top */
            if ($(this).scrollTop() > 400) {
                $(".backtotop").fadeIn(500);
            } else {
                $(".backtotop").fadeOut(500);
            }
        },
    };

    // Initialize Functions
    $(document).ready(THEMEIM.documentOnReady.init);
    $(window).on("load", THEMEIM.documentOnLoad.init);
    $(window).on("resize", THEMEIM.documentOnResize.init);
    $(window).on("scroll", THEMEIM.documentOnScroll.init);
})(jQuery);

// Shop Product Sorting
function sortProducts(value) {
    window.location.href = "{{ request()->url() }}?sort=" + value;
}

document.addEventListener("DOMContentLoaded", function () {
    // Get the last active tab from localStorage
    const lastTab = localStorage.getItem("activeTab");

    // If there's a saved tab, trigger it
    if (lastTab) {
        const tabTrigger = document.querySelector(`a[href="${lastTab}"]`);
        if (tabTrigger) {
            new bootstrap.Tab(tabTrigger).show();
        }
    }

    // Listen to tab shown events and store in localStorage
    const tabLinks = document.querySelectorAll('a[data-bs-toggle="tab"]');
    tabLinks.forEach((tab) => {
        tab.addEventListener("shown.bs.tab", function (e) {
            localStorage.setItem("activeTab", e.target.getAttribute("href"));
        });
    });
});

// Collection Sorting
document.querySelectorAll(".collection-filter button").forEach((button) => {
    button.addEventListener("click", function () {
        const filter = this.getAttribute("data-filter");

        // Set active class
        document
            .querySelectorAll(".collection-filter button")
            .forEach((btn) => btn.classList.remove("active"));
        this.classList.add("active");

        // Show/hide grid items
        document
            .querySelectorAll(".collection-content .mix")
            .forEach((item) => {
                if (filter === "all" || item.classList.contains(filter)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
    });
});

// Password eye icon
document.addEventListener("DOMContentLoaded", function () {
    const toggle1 = document.getElementById("togglePassword1");
    const password1 = document.getElementById("password1");

    if (toggle1 && password1) {
        toggle1.addEventListener("click", function () {
            const type = password1.type === "password" ? "text" : "password";
            password1.type = type;
            this.classList.toggle("fa-eye-slash");
        });
    }

    const toggle2 = document.getElementById("togglePassword2");
    const password2 = document.getElementById("password2");

    if (toggle2 && password2) {
        toggle2.addEventListener("click", function () {
            const type = password2.type === "password" ? "text" : "password";
            password2.type = type;
            this.classList.toggle("fa-eye-slash");
        });
    }
});

// Toaster for livewire
document.addEventListener("DOMContentLoaded", function () {
    Livewire.on("toast", ({ type, title, message }) => {
        if (["success", "info", "warning", "error"].includes(type)) {
            iziToast[type]({
                title: title,
                message: message,
                position: "topRight",
            });
        } else {
            console.error("Unsupported toast type:", type);
        }
    });
});
