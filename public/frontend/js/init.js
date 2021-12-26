(function () {
    "use strict";

    // here all ready functions
    myfolio__init__data_load();



    jQuery(window).load("body", function () {
        myfolio__my_load();
    });
    jQuery(window).on("resize", function () {
        myIsotope();
    });
})(jQuery);

// ------------------------------------------------
// ---------------   FUNCTIONS    -----------------
// ------------------------------------------------

function projectMesonary() {
    if ($(".myfolio-gallery").length) {
        $(".myfolio-gallery").isotope({
            layoutMode: "masonry",
        });
    }
    if ($(".myfolio-filter.masonary").length) {
        $(".myfolio-filter.masonary li")
            .children("span")
            .on("click", function () {
                var Self = $(this);
                var selector = Self.parent().attr("data-filter");
                $(".myfolio-filter.masonary li")
                    .children("span")
                    .parent()
                    .removeClass("active");
                Self.parent().addClass("active");
                $(".myfolio-gallery").isotope({
                    filter: selector,
                });
                return false;
            });
    }
}

function myfolio__progress(){
    // -------------------------------------------------
    // -------------  PROGRESS BAR  --------------------
    // -------------------------------------------------

    jQuery(".myfolio_progress").each(function () {
        "use strict";

        var pWrap = jQuery(this);
        pWrap.waypoint({
            handler: function () {
                tdProgress(pWrap);
            },
            offset: "90%",
        });
    });
}

function myfolio__grouploop(){
// Testimonial Title
$("#grouploop").grouploop({
    velocity: 1,
    forward: false,
    childNode: ".item",
    childWrapper: ".item-wrap",
    pauseOnHover: false,
    complete: function () {
        console.log("init");
    },
});
}

function myfolio__init__data_load() {



    myfolio__color_switcher();
	myfolio__switcher_opener();
	myfolio__cursor_switcher();
	myfolio__nav_bg();
	myfolio__trigger_menu();

    myfolio__progress();
    myfolio__grouploop();

	myfolio__modalbox_news();
	myfolio__modalbox_portfolio();
	myfolio__cursor();
	myfolio__imgtosvg();
	myfolio__popup();
	myfolio__data_images();
	myfolio__contact_form();
	myIsotope();
	myfolio__jarallax();
	myfolio__owl_carousel();

    projectMesonary();

    // -----------------------------------------------------
    // --------------------    WOW JS    -------------------
    // -----------------------------------------------------

    new WOW().init();



    new Typed("#typed", {
        stringsElement: "#typed-strings",
        typeSpeed: 60,
        backSpeed: 30,
        backDelay: 2000,
        startDelay: 1000,
        loop: true,
        showCursor: true,
        cursorChar: "|",
    });

    if ($(".counter").length) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    }


    // confetti

      var canvas1Settings = {
        target: 'canvas1',
        max: 100,
        maxsize: 1.5,
        props: ['square', 'triangle', 'line', 'circle'],
        colors: [[80,80,80]],
        animate:true,
        start_from_edge:false,
        clock: 3
      };
      var canvas1 = new ConfettiGenerator(canvas1Settings);
      canvas1.render();


}

// -----------------------------------------------------
// ---------------------   SWITCHERS    ----------------
// -----------------------------------------------------

function myfolio__color_switcher() {
    "use strict";

    var list = jQuery(".myfolio__settings .colors li a");

    list.on("click", function () {
        var element = jQuery(this);
        var elval = element.attr("class");
        element
            .closest(".myfolio__all_wrap")
            .attr("data-color", "" + elval + "");
        return false;
    });
}

function myfolio__switcher_opener() {
    "use strict";

    var settings = jQuery(".myfolio__settings");
    var button = settings.find(".link");
    var direction = settings.find(".direction li a");
    var light = settings.find(".direction li a.light");
    var dark = settings.find(".direction li a.dark");

    button.on("click", function () {
        var element = jQuery(this);
        if (element.hasClass("opened")) {
            element.removeClass("opened");
            element.closest(".myfolio__settings").removeClass("opened");
        } else {
            element.addClass("opened");
            element.closest(".myfolio__settings").addClass("opened");
        }
        return false;
    });

    direction.on("click", function () {
        var element = jQuery(this);
        if (!element.hasClass("active")) {
            direction.removeClass("active");
            element.addClass("active");
        }
    });

    dark.on("click", function () {
        var el = jQuery(this);
        jQuery("body").addClass("dark");
        jQuery(".myfolio__partners").addClass("opened");
        el.closest(".myfolio__settings").addClass("changed");
        return false;
    });

    light.on("click", function () {
        var ele = jQuery(this);
        jQuery("body").removeClass("dark");
        jQuery(".myfolio__partners").removeClass("opened");
        ele.closest(".myfolio__settings").removeClass("changed");
        return false;
    });
}

function myfolio__cursor_switcher() {
    "use strict";

    var wrapper = jQuery(".myfolio__all_wrap");
    var button = jQuery(".myfolio__settings .cursor li a");
    var show = jQuery(".myfolio__settings .cursor li a.show");
    var hide = jQuery(".myfolio__settings .cursor li a.hide");

    button.on("click", function () {
        var element = jQuery(this);
        if (!element.hasClass("showme")) {
            button.removeClass("showme");
            element.addClass("showme");
        }
        return false;
    });
    show.on("click", function () {
        wrapper.attr("data-magic-cursor", "");
    });
    hide.on("click", function () {
        wrapper.attr("data-magic-cursor", "hide");
    });
}


// -------------------------------------------------
// -------------  PROGRESS BAR  --------------------
// -------------------------------------------------

function tdProgress(container) {
    "use strict";

    container.find(".progress_inner").each(function () {
        var progress = jQuery(this);
        var pValue = parseInt(progress.data("value"), 10);
        var pColor = progress.data("color");
        var pBarWrap = progress.find(".bar");
        var pBar = progress.find(".bar_in");
        pBar.css({ width: pValue + "%", backgroundColor: pColor });
        setTimeout(function () {
            pBarWrap.addClass("open");
        });
    });
}

jQuery(".myfolio_progress").each(function () {
    "use strict";

    var pWrap = jQuery(this);
    pWrap.waypoint({
        handler: function () {
            tdProgress(pWrap);
        },
        offset: "90%",
    });
});

// -------------------------------------------------
// -------------   TOPBAR BG SCROLL  ---------------
// -------------------------------------------------

function myfolio__nav_bg() {
    "use strict";

    jQuery(window).on("scroll", function () {
        var menu = jQuery(".myfolio__topbar");
        var WinOffset = jQuery(window).scrollTop();
        var hamburger = jQuery(".trigger .hamburger");
        var list = jQuery(".myfolio__topbar .list ul li");
        var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(
            navigator.userAgent
        )? true: false;
       if(!isMobile){
        if (WinOffset >= 100) {
            menu.addClass("animate");
            if (!hamburger.hasClass("is-active")) {
                hamburger.addClass("is-active");
                list.each(function (i) {
                    var ele = jQuery(this);
                    setTimeout(function () {
                        ele.addClass("opened");
                    }, i * 50);
                });
            }
        } else {
            menu.removeClass("animate");
            hamburger.removeClass("is-active");
            list.each(function (i) {
                var ele = jQuery(this);
                setTimeout(function () {
                    ele.removeClass("opened");
                }, i * 50);
            });
        }
       }
    });
}

// -----------------------------------------------------
// ---------------   TRIGGER MENU    -------------------
// -----------------------------------------------------

function myfolio__trigger_menu() {
    "use strict";

    // One Page Activation
    jQuery(".anchor_nav").onePageNav();

    // -----------------------------------------------------
    // --------------- MENU  ITEM CLICK --------------------
    // -----------------------------------------------------

    var audio = jQuery("#audio2");
    var menuItem = jQuery("a[href]");
    menuItem.on("click", function () {
        audio[0].volume = 0.2;
        audio[0].play();
    });


    // Click Function
    var audio1 = jQuery("#audio1");
    var audio2 = jQuery("#audio2");
    var hamburger = jQuery(".trigger .hamburger");
    var list = jQuery(".myfolio__topbar .list ul li");
    var mobileMenu = jQuery(".myfolio__mobile_menu .dropdown");
    var mobileMenuList = jQuery(
        ".myfolio__mobile_menu .dropdown .dropdown_inner ul li a"
    );

    hamburger.on("click", function () {
        var element = jQuery(this);

        if (element.hasClass("is-active")) {
            element.removeClass("is-active");
            audio1[0].play();
            list.removeClass("opened");
            mobileMenu.slideUp();
        } else {
            element.addClass("is-active");
            audio2[0].play();
            list.each(function (i) {
                var ele = jQuery(this);
                setTimeout(function () {
                    ele.addClass("opened");
                }, i * 50);
            });
            mobileMenu.slideDown();
        }
        return false;
    });

    mobileMenuList.on("click", function () {
        jQuery(".trigger .hamburger").removeClass("is-active");
        mobileMenu.slideUp();
        return false;
    });
}

// -------------------------------------------------
// -------------  MODALBOX NEWS  -------------------
// -------------------------------------------------

function myfolio__modalbox_news() {
    "use strict";

    var modalBox = jQuery(".myfolio__modalbox");
    var list = jQuery(".myfolio__news ul li");
    var closePopup = modalBox.find(".close");

    list.each(function () {
        var element = jQuery(this);
        var details = element.find(".list_inner").html();
        var buttons = element.find(".details a, .myfolio__full_link");
        var mainImage = element.find(".main");
        var imgData = mainImage.data("img-url");
        var title = element.find(".title");
        var titleHref = element.find(".title a").html();
        buttons.on("click", function () {
            modalBox.addClass("opened");
            modalBox.find(".description_wrap").html(details);
            mainImage = modalBox.find(".main");
            mainImage.css({ backgroundImage: "url(" + imgData + ")" });
            title = modalBox.find(".title");
            title.html(titleHref);
            myfolio__imgtosvg();
            return false;
        });
    });
    closePopup.on("click", function () {
        modalBox.removeClass("opened");
        modalBox.find(".description_wrap").html("");
        return false;
    });
}

// -------------------------------------------------
// -------------  MODALBOX PORTFOLIO  --------------
// -------------------------------------------------

function myfolio__modalbox_portfolio() {
    "use strict";

    var modalBox = jQuery(".myfolio__modalbox");
    var button = jQuery(".myfolio__portfolio .popup_info");

    button.on("click", function () {
        var element = jQuery(this);
        var parent = element.closest("li");
        var details = parent.find(".portfolio_hidden_infos").html();
        var titles = parent.find(".details").html();
        var image = parent.find(".image").html();

        modalBox.addClass("opened");
        modalBox.find(".description_wrap").html(details);
        modalBox.find(".top_image").html(image);
        modalBox.find(".portfolio_main_title").html(titles);

        return false;
    });
}

// -----------------------------------------------------
// ---------------   PRELOADER   -----------------------
// -----------------------------------------------------

function myfolio__preloader() {
    "use strict";

    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(
        navigator.userAgent
    )
        ? true
        : false;
    var preloader = $("#preloader");

    if (!isMobile) {
        setTimeout(function () {
            preloader.addClass("preloaded");
        }, 800);
        setTimeout(function () {
            preloader.remove();
        }, 2000);
    } else {
        preloader.remove();
    }
}

// -----------------------------------------------------
// -----------------   MY LOAD    ----------------------
// -----------------------------------------------------

function myfolio__my_load() {
    "use strict";
    setTimeout(function(){jQuery('body').addClass('loaded');},speed+2000);
    var speed = 500;
    setTimeout(function () {
        myfolio__preloader();
    }, speed);
}

// -----------------------------------------------------
// ------------------   CURSOR    ----------------------
// -----------------------------------------------------

function myfolio__cursor() {
    "use strict";

    var myCursor = jQuery(".mouse-cursor");
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(
        navigator.userAgent
    )? true: false;
    if (myCursor.length && !isMobile) {
        if ($("body")) {
            const e = document.querySelector(".cursor-inner"),
                t = document.querySelector(".cursor-outer");
            let n,
                i = 0,
                o = !1;
            (window.onmousemove = function (s) {
                o ||
                    (t.style.transform =
                        "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                    (e.style.transform =
                        "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                    (n = s.clientY),
                    (i = s.clientX);
            }),
                $("body").on(
                    "mouseenter",
                    "a, .myfolio__topbar .trigger, .cursor-pointer",
                    function () {
                        e.classList.add("cursor-hover"),
                            t.classList.add("cursor-hover");
                    }
                ),
                $("body").on(
                    "mouseleave",
                    "a, .myfolio__topbar .trigger, .cursor-pointer",
                    function () {
                        ($(this).is("a") &&
                            $(this).closest(".cursor-pointer").length) ||
                            (e.classList.remove("cursor-hover"),
                            t.classList.remove("cursor-hover"));
                    }
                ),
                (e.style.visibility = "visible"),
                (t.style.visibility = "visible");
        }
    }
}

// -----------------------------------------------------
// ---------------    IMAGE TO SVG    ------------------
// -----------------------------------------------------

function myfolio__imgtosvg() {
    "use strict";

    jQuery("img.svg").each(function () {
        var jQueryimg = jQuery(this);
        var imgClass = jQueryimg.attr("class");
        var imgURL = jQueryimg.attr("src");

        jQuery.get(
            imgURL,
            function (data) {
                // Get the SVG tag, ignore the rest
                var jQuerysvg = jQuery(data).find("svg");

                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== "undefined") {
                    jQuerysvg = jQuerysvg.attr(
                        "class",
                        imgClass + " replaced-svg"
                    );
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                jQuerysvg = jQuerysvg.removeAttr("xmlns:a");

                // Replace image with new SVG
                jQueryimg.replaceWith(jQuerysvg);
            },
            "xml"
        );
    });
}

// -----------------------------------------------------
// --------------------   POPUP    ---------------------
// -----------------------------------------------------

function myfolio__popup() {
    "use strict";

    jQuery(".gallery_zoom").each(function () {
        // the containers for all your galleries
        jQuery(this).magnificPopup({
            delegate: "a.zoom", // the selector for gallery item
            type: "image",
            gallery: {
                enabled: true,
            },
            removalDelay: 300,
            mainClass: "mfp-fade",
        });
    });
    jQuery(".popup-youtube, .popup-vimeo").each(function () {
        // the containers for all your galleries
        jQuery(this).magnificPopup({
            disableOn: 700,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
        });
    });

    jQuery(".soundcloude_link").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
    });
}

// -----------------------------------------------------
// ---------------   DATA IMAGES    --------------------
// -----------------------------------------------------

function myfolio__data_images() {
    "use strict";

    var data = jQuery("*[data-img-url]");

    data.each(function () {
        var element = jQuery(this);
        var url = element.data("img-url");
        element.css({ backgroundImage: "url(" + url + ")" });
    });
}

// -----------------------------------------------------
// ----------------    CONTACT FORM    -----------------
// -----------------------------------------------------

function myfolio__contact_form() {
    "use strict";

    jQuery(".contact_form #send_message").on("click", function () {
        var name = jQuery(".contact_form #name").val();
        var email = jQuery(".contact_form #email").val();
        var message = jQuery(".contact_form #message").val();
        var subject = jQuery(".contact_form #subject").val();
        var success = jQuery(".contact_form .returnmessage").data("success");

        jQuery(".contact_form .returnmessage").empty(); //To empty previous error/success message.
        //checking for blank fields
        if (name === "" || email === "" || message === "") {
            jQuery("div.empty_notice").slideDown(500).delay(2000).slideUp(500);
        } else {
            // Returns successful data submission message when the entered information is stored in database.
            jQuery.post(
                "modal/contact.php",
                {
                    ajax_name: name,
                    ajax_email: email,
                    ajax_message: message,
                    ajax_subject: subject,
                },
                function (data) {
                    jQuery(".contact_form .returnmessage").append(data); //Append returned message to message paragraph

                    if (
                        jQuery(
                            ".contact_form .returnmessage span.contact_error"
                        ).length
                    ) {
                        jQuery(".contact_form .returnmessage")
                            .slideDown(500)
                            .delay(2000)
                            .slideUp(500);
                    } else {
                        jQuery(".contact_form .returnmessage").append(
                            "<span class='contact_success'>" +
                                success +
                                "</span>"
                        );
                        jQuery(".contact_form .returnmessage")
                            .slideDown(500)
                            .delay(4000)
                            .slideUp(500);
                    }

                    if (data === "") {
                        jQuery("#contact_form")[0].reset(); //To reset form fields on success
                    }
                }
            );
        }
        return false;
    });
}

function myIsotope() {
    "use strict";

    $(".grid").isotope({
        // options
        itemSelector: ".grid-item",
    });
}

// -----------------------------------------------------
// --------------------    JARALLAX    -----------------
// -----------------------------------------------------

function myfolio__jarallax() {
    "use strict";

    jQuery(".jarallax").each(function () {
        var element = jQuery(this);
        var customSpeed = element.data("speed");

        if (customSpeed !== "undefined" && customSpeed !== "") {
            customSpeed = customSpeed;
        } else {
            customSpeed = 0.5;
        }

        element.jarallax({
            speed: customSpeed,
            automaticResize: true,
        });
    });
}


// -----------------------------------------------------
// ----------------    OWL CAROUSEL    -----------------
// -----------------------------------------------------

function myfolio__owl_carousel() {
    "use strict";

    var carousel = jQuery(".myfolio__testimonials .owl-carousel");
    carousel.owlCarousel({
        loop: true,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        items: 1,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 6000,
        smartSpeed: 2000,
        margin: 0,
        dots: true,
        nav: false,
        navSpeed: true,
        responsive: {
            0: {
                mouseDrag: false,
                touchDrag: true,
            },
            1100: {
                mouseDrag: true,
                touchDrag: true,
            },
        },
    });
    myfolio__imgtosvg();
}
