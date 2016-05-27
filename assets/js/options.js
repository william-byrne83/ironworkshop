jQuery(window).bind("load", function() {
   jQuery(".load-complete").hide();
});


(function() {

    "use strict";

    var matched, browser;

    // Use of jQuery.browser is frowned upon.
    // More details: http://api.jquery.com/jQuery.browser
    // jQuery.uaMatch maintained for back-compat
    jQuery.uaMatch = function(ua) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
            /(webkit)[ \/]([\w.]+)/.exec(ua) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
            /(msie) ([\w.]+)/.exec(ua) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [];

        return {
            browser: match[1] || "",
            version: match[2] || "0"
        };
    };

    matched = jQuery.uaMatch(navigator.userAgent);
    browser = {};

    if (matched.browser) {
        browser[matched.browser] = true;
        browser.version = matched.version;
    }

    // Chrome is Webkit, but Webkit is also Safari.
    if (browser.chrome) {
        browser.webkit = true;
    } else if (browser.webkit) {
        browser.safari = true;
    }

    jQuery.browser = browser;

    jQuery.sub = function() {
        function jQuerySub(selector, context) {
            return new jQuerySub.fn.init(selector, context);
        }
        jQuery.extend(true, jQuerySub, this);
        jQuerySub.superclass = this;
        jQuerySub.fn = jQuerySub.prototype = this();
        jQuerySub.fn.constructor = jQuerySub;
        jQuerySub.sub = this.sub;
        jQuerySub.fn.init = function init(selector, context) {
            if (context && context instanceof jQuery && !(context instanceof jQuerySub)) {
                context = jQuerySub(context);
            }

            return jQuery.fn.init.call(this, selector, context, rootjQuerySub);
        };
        jQuerySub.fn.init.prototype = jQuerySub.fn;
        var rootjQuerySub = jQuerySub(document);
        return jQuerySub;
    };

})();

jQuery(document).ready(function() {
    "use strict";
    jQuery(".responsive-menu").click(function(e) {
        jQuery(".menu>ul").css({
            display: "block"
        });
        e.stopPropagation();
        if (e.preventDefault)
            e.preventDefault();
        return false;
    });
    jQuery("body").click(function() {
        jQuery(".menu>ul").css({
            display: "none"
        });
    });
});


$(document).ready(function() {
    /* GALLERY IMAGE ZOOM */
    $Electra.swipebox = (jQuery().swipebox) ? $(".swipebox").swipebox() : null;
});

/* ================= START SCROOL TOP ================= */
$(document).ready(function() {
    $('.to-top').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1200, 'swing');
        return false;
    });

    $('.slow-motion').click(function() {
        var t = $(this);
        var t_target = t.attr('data-target');
        $('body,html').animate({
            scrollTop: t_target ? $(t_target).offset().top : 0
        }, 1200, 'swing');
        return false;
    });

    $('.navbar').scrollspy()
    $('[data-spy="scroll"]').each(function() {
        var $spy = $(this).scrollspy('refresh')
    });
});
/* ================= END SCROOL TOP ================= */

/* ================= IE fix ================= */
$(document).ready(function() {
    "use strict";
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function(obj, start) {
            for (var i = (start || 0), j = this.length; i < j; i++) {
                if (this[i] === obj) {
                    return i;
                }
            }
            return -1;
        };
    }
});

/* ================= START PLACE HOLDER ================= */
$(document).ready(function($) {
    "use strict";
    $('input[placeholder], textarea[placeholder]').placeholder();
});
/* ================= END PLACE HOLDER ================= */

jQuery('.contact-form,.contact-form-2').each(function() {
    "use strict";
    var t = jQuery(this);
    var t_result = jQuery(this).find('.form-send');
    var t_result_init_val = t_result.val();
    var validate_email = function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
    var t_timeout;
    t.submit(function(event) {
        event.preventDefault();
        var t_values = {};
        var t_values_items = t.find('input[name],textarea[name]');
        t_values_items.each(function() {
            t_values[this.name] = jQuery(this).val();
        });
        if (t_values['contact-name'] === '' || t_values['contact-email'] === '' || t_values['contact-message'] === '') {
            t_result.val('Please fill in all the required fields.');
        } else
        if (!validate_email(t_values['contact-email']))
            t_result.val('Please provide a valid e-mail.');
        else
            jQuery.post("php/contacts.php", t.serialize(), function(result) {
                t_result.val(result);
            });
        clearTimeout(t_timeout);
        t_timeout = setTimeout(function() {
            t_result.val(t_result_init_val);
        }, 3000);
    });

});


/* AS JavaScript [START] */
$Electra = {};

// Email object
$Electra.email = {};

// Forms
$Electra.form = {};
$Electra.form.errorClass = 's_error';

$Electra.form.subscribe = {};
$Electra.form.subscribe.id = '#newsletter';

jQuery(document).ready(function($) {

    "use strict";

    /* SUBSCRIBE FORM */
    $($Electra.form.subscribe.id).on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var input = form.find('input[type="text"]');
        if ($Electra.form.validate(form)) {
            $.post('php/subscribe.php', form.serialize(), function(result) {
                input.attr('placeholder', result);
                input.val('');
            });
        } else {
            setTimeout(function() {
                input.removeClass($Electra.form.errorClass);
            }, 800);
        }
        return false;
    });
});

/*  EMAIL VALIDATION FUNCTION */
$Electra.email.validate = function(email) {
    "use strict";
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};
/* --------------------------- */

/*  FORM ELEMENT VALIDATION FUNCTION */
$Electra.form.validate = function validate(form) {
    "use strict";
    var valid = true;
    $.each(form.find(':input:not(:input[type="submit"])'), function(index, input) {
        var val = $(input).val();
        if ($.trim(val) === '') {
            $Electra.form.inputError(input);
            valid = false;
            return false;
        }
        if ($(input).attr('name') === 'newsletter-email') {
            if (!$Electra.email.validate(val)) {
                $Electra.form.inputError(input);
                valid = false;
                return false;
            }
        }
    });
    return valid;
};

/* TOGGLE INPUT ERROR CLASS */
$Electra.form.inputError = function inputError(input) {
    "use strict";
    if (!$(input).hasClass($Electra.form.errorClass))
        $(input).addClass($Electra.form.errorClass);
    $(input).focus();
};
/* AS JavaScript [END] */


// Instantiate theme collapse element object
$theme_accordion = {};
$theme_accordion.collapse = {};

/* ACCORDION */
$(".accordion-toggle").click(function() {
    "use strict";
    if ($(this).parent().hasClass('active')) {
        $theme_accordion.collapse.close($(this).parent().parent());
        return;
    }
    $('#accordion').children('.accordion-group').each(function(i, elem) {
        $theme_accordion.collapse.close(elem);
    });
    $theme_accordion.collapse.open(this);
});


/* ACCORDION STATE MANAGER */
$theme_accordion.collapse.close = function close(element) {
    "use strict";
    jQuery(element).children('.accordion-heading').removeClass('active');
    jQuery(element).children('.accordion-body').removeClass('in');
    jQuery(element).children('.accordion-heading').find('.plus').html('+');
};
$theme_accordion.collapse.open = function open(element) {
    "use strict";
    jQuery(element).parent().toggleClass('active');
    jQuery(element).find('.plus').html('-');
};
/* --------------------------- */


/* =================Twitter============================ */
var load_twitter = function() {
    "use strict";
    var linkify = function(text) {
        text = text.replace(/(https?:\/\/\S+)/gi, function(s) {
            return '<a href="' + s + '">' + s + '</a>';
        });
        text = text.replace(/(^|)@(\w+)/gi, function(s) {
            return '<a href="http://twitter.com/' + s + '">' + s + '</a>';
        });
        text = text.replace(/(^|)#(\w+)/gi, function(s) {
            return '<a href="http://search.twitter.com/search?q=' + s.replace(/#/, '%23') + '">' + s + '</a>';
        });
        return text;
    };
    $('.twitter_widget').each(function() {
        var t = $(this);
        var t_date_obj = new Date();
        var t_loading = 'Loading tweets..'; //message to display before loading tweets
        var t_container = $('<ul>').addClass('twitter').append('<li>' + t_loading + '</li>');
        t.append(t_container);
        var t_user = t.attr('data-user');
        var t_posts = parseInt(t.attr('data-posts'), 10);
        $.getJSON("php/twitter.php?user=" + t_user, function(t_tweets) {
            t_container.empty();
            for (var i = 0; i < t_posts && i < t_tweets.length; i++) {
                var t_date = Math.floor((t_date_obj.getTime() - Date.parse(t_tweets[i].created_at)) / 1000);
                var t_date_str;
                var t_date_seconds = t_date % 60;
                t_date = Math.floor(t_date / 60);
                var t_date_minutes = t_date % 60;
                if (t_date_minutes) {
                    t_date = Math.floor(t_date / 60);
                    var t_date_hours = t_date % 60;
                    if (t_date_hours) {
                        t_date = Math.floor(t_date / 60);
                        var t_date_days = t_date % 24;
                        if (t_date_days) {
                            t_date = Math.floor(t_date / 24);
                            var t_date_weeks = t_date % 7;
                            if (t_date_weeks)
                                t_date_str = t_date_weeks + ' week' + (1 == t_date_weeks ? '' : 's') + ' ago';
                            else
                                t_date_str = t_date_days + ' day' + (1 == t_date_days ? '' : 's') + ' ago';
                        } else
                            t_date_str = t_date_hours + ' hour' + (1 == t_date_hours ? '' : 's') + ' ago';
                    } else
                        t_date_str = t_date_minutes + ' minute' + (1 == t_date_minutes ? '' : 's') + ' ago';
                } else
                    t_date_str = t_date_seconds + ' second' + (1 == t_date_seconds ? '' : 's') + ' ago';
                var t_message =
                    '<li>' +
                    linkify(t_tweets[i].text) +
                    '<span>' +
                    t_date_str +
                    '</span>' +
                    '</li>';
                t_container.append(t_message);
            }
            //load_twitter_rotator();
        });
    });
};
//load modules-------------

jQuery(document).ready(function($) {
    "use strict";
    load_twitter();
});


jQuery(document).ready(function() {
    "use strict";
    jQuery(".search-button-last").click(function(e) {
        e.stopPropagation();

        jQuery(".search-location").css({
            height: "auto",
            opacity: "1",
            filter: "alpha(opacity=100)"
        });

    });
    jQuery('.top-line li ul li form').click(function(e) {
        e.stopPropagation();

        jQuery(".search-location").css({
            height: "auto",
            opacity: "1",
            filter: "alpha(opacity=100)"
        });

    });
    jQuery("body").click(function() {
        jQuery(".search-location").css({
            height: "auto",
            opacity: "0",
            filter: "alpha(opacity=0)"
        });
    });
});


// Navigation (A.B.)
jQuery(function($) {
    function load_navigation() {
        var menu_links = $('.menu ul li a').filter(function() {
            var s = $(this).data('anchor') ? '#' + $(this).data('anchor') : $(this).attr('href');
            if ($(s).length)
                return true;
            else
                return false;
        }).sort(function(a, b) {
            var as = $(a).data('anchor') ? '#' + $(a).data('anchor') : $(a).attr('href');
            var bs = $(b).data('anchor') ? '#' + $(b).data('anchor') : $(b).attr('href');
            return $(as).offset().top - $(bs).offset().top;
        });
        var menu_links_parents = menu_links.parent();
        var scrollSpyNavigation_flag = true;
        var scrollSpyNavigation_loop_flag = false;
        var scrollSpyNavigation_loop_time = 100;
        $('.menu ul li a').not(menu_links).parent().addClass('no-anchor');

        function scrollSpyNavigation() {
            if (scrollSpyNavigation_flag) {
                scrollSpyNavigation_flag = false;
                scrollSpyNavigation_action();
                setTimeout(scrollSpyNavigation_loop, scrollSpyNavigation_loop_time);
            } else {
                scrollSpyNavigation_loop_flag = true;
            }
        }

        function scrollSpyNavigation_loop() {
            if (scrollSpyNavigation_loop_flag) {
                scrollSpyNavigation_loop_flag = false;
                scrollSpyNavigation_action();
                setTimeout(scrollSpyNavigation_loop, scrollSpyNavigation_loop_time);
            } else {
                scrollSpyNavigation_flag = true;
            }
        }

        function scrollSpyNavigation_action() {

            if (!menu_links.length) return;

            var delta = 20;

            var targetOffset = $(window).scrollTop() + $('.navbar').height() + $('#wpadminbar').height() + delta;
            var i = -1;
            var i_parent;
            var i_buffer;

            while (i + 1 < menu_links.length && targetOffset >= $(menu_links.eq(i + 1).data('anchor') ? '#' + menu_links.eq(i + 1).data('anchor') : menu_links.eq(i + 1).attr('href')).offset().top) i++;

            i_buffer = i;
            while (i_buffer > 0 && ($(menu_links.eq(i).data('anchor') ? '#' + menu_links.eq(i).data('anchor') : menu_links.eq(i).attr('href')).offset().top) === ($(menu_links.eq(i_buffer - 1).data('anchor') ? '#' + menu_links.eq(i_buffer - 1).data('anchor') : menu_links.eq(i_buffer - 1).attr('href')).offset().top)) i_buffer--;

            menu_links_parents.filter('.active').each(function(index, element) {

                var t = $(element);
                var t_link = t.children('a');
                var t_link_index = menu_links.index(t_link);

                if (t_link_index < i_buffer || t_link_index > i)
                    t.removeClass('active');

            });

            while (i_buffer <= i) {

                menu_links.eq(i_buffer).parent().addClass('active');
                if (1 <= i_buffer)
                    $('.header').addClass('header-transform');
                else
                    $('.header').removeClass('header-transform');
                i_buffer++;

            }
        }

        function scrollToElement(target, duration) {
            if (!target.length) return;
            $('body,html').animate({
                scrollTop: target.offset().top
            }, 1000, 'swing');
        }
        menu_links.bind('click', function(e) {
            var s = $(this).data('anchor') ? '#' + $(this).data('anchor') : $(this).attr('href');
            e.preventDefault();
            scrollToElement($(s));
        });
        $(document).ready(function() {
            scrollSpyNavigation();
        });
        $(window).load(function() {
            scrollSpyNavigation();
        });
        $(window).scroll(function() {
            scrollSpyNavigation();
        });
    }
    load_navigation();
});

//==============END TWITTER====================================

//==============START COUNT DOWN====================================
//-----------CONFIGURATION---------------------------------

var from_date = "1 May 2014";
var due_date = "30 September 2015";



//---------------------------------------------------------



$(document).ready(function() {
    var t_date_obj = new Date();
    var t_date = Math.floor((Date.parse(due_date) - t_date_obj.getTime()) / 1000);
    var t_date_total = Math.floor((Date.parse(due_date) - Date.parse(from_date)) / 1000);
    var t_date_delta = t_date_total - t_date;
    var t_ship_left = Math.floor(100 * (t_date_delta / t_date_total));
    var t_ship_left_text = t_ship_left + '%';
    var t_date_seconds = t_date % 60;
    t_date = Math.floor(t_date / 60);
    var t_date_minutes = t_date % 60;
    t_date = Math.floor(t_date / 60);
    var t_date_hours = t_date % 24;
    var t_date_days = Math.floor(t_date / 24);
    var t_seconds = $('#seconds');
    var t_minutes = $('#minutes');
    var t_hours = $('#hours');
    var t_days = $('#days');
    var t_seconds_container = $('#seconds');
    var t_minutes_container = $('#minutes');
    var t_hours_container = $('#hours');
    var t_days_container = $('#days');

    var t_ship = $('.bottom_site .ocean .ship');
    var t_ship_text = $('.bottom_site .ocean .right_a .port');
    var t_ocean = $('.bottom_site .ocean');

    t_seconds.html(t_date_seconds);
    t_minutes.html(t_date_minutes);
    t_hours.html(t_date_hours);
    t_days.html(t_date_days);
    t_ship.css({
        left: t_ship_left_text
    });
    t_ship_text.html(t_ship_left_text);

    var t_speed = 1000;
    var t_speed_pause = 500;
    var t_speed_first = Math.floor((t_speed - t_speed_pause) / 2);
    var t_speed_second = t_speed - t_speed_pause - t_speed_first;

    var t_seconds_marine = {
        0: t_seconds_container.children().eq(0),
        1: t_seconds_container.children().eq(1)
    }
    var t_minutes_marine = {
        0: t_minutes_container.children().eq(0),
        1: t_minutes_container.children().eq(1)
    }
    var t_hours_marine = {
        0: t_hours_container.children().eq(0),
        1: t_hours_container.children().eq(1)
    }
    var t_days_marine = {
        0: t_days_container.children().eq(0),
        1: t_days_container.children().eq(1)
    }

    var t_interval;
    var t_ship_left_old = t_ship_left;
    var t_chip_custom = $({
        percentage: 0
    });

    t_interval = setInterval(function() {
        if (t_date_delta < t_date_total) {
            t_date_delta++;
            t_ship_left = Math.floor(100 * (t_date_delta / t_date_total));
            if (t_ship_left !== t_ship_left_old) {
                t_ship_left_text = t_ship_left + '%';
                if (t_ship_left - t_ship_left_old)
                    t_chip_custom.stop().prop('percentage', t_ship_left_old).animate({
                        percentage: t_ship_left
                    }, {
                        queue: false,
                        duration: t_speed,
                        easing: 'linear',
                        step: function() {
                            t_ship_text.html(Math.floor(this.percentage) + '%');
                        }
                    });
                else {
                    t_chip_custom.stop();
                    t_ship_text.html(t_ship_left_text);
                }
                t_ship.stop(true, true).animate({
                    left: t_ship_left_text
                }, {
                    queue: false,
                    duration: t_speed,
                    easing: 'linear'
                });
                t_ship_left_old = t_ship_left;
            }
        } else {
            t_chip_custom.stop();
            t_ship_text.html(t_ship_left_text);
            t_ship.stop(true, true).animate({
                left: t_ship_left_text
            }, {
                queue: false,
                duration: t_speed,
                easing: 'linear'
            });
        }
        if (t_date_seconds)
            t_date_seconds--;
        else {
            t_date_seconds = 59;
            if (t_date_minutes)
                t_date_minutes--;
            else {
                t_date_minutes = 59;
                if (t_date_hours)
                    t_date_hours--;
                else {
                    t_date_hours = 23;
                    if (t_date_days)
                        t_date_days--;
                    else {
                        clearInterval(t_interval);
                        t_date_hours = 0;
                        t_date_minutes = 0;
                        t_date_seconds = 0;
                    }
                    t_days_marine[0].stop(true, true).animate({
                        opacity: 0
                    }, {
                        queue: false,
                        duration: t_speed_first,
                        easing: 'easeInQuad'
                    });
                    t_days_marine[1].stop(true, true).animate({
                        opacity: 1
                    }, {
                        queue: false,
                        duration: t_speed_first,
                        easing: 'easeInQuad'
                    });
                    t_days_container.stop(true, true).animate({
                        marginTop: 0
                    }, {
                        queue: false,
                        duration: t_speed_first,
                        easing: 'easeOutQuad',
                        complete: function() {
                            t_days.html(t_date_days);
                            t_days_marine[0].stop(true, true).animate({
                                opacity: 1
                            }, {
                                queue: false,
                                duration: t_speed_first,
                                easing: 'easeOutQuad'
                            });
                            t_days_marine[1].stop(true, true).animate({
                                opacity: 0
                            }, {
                                queue: false,
                                duration: t_speed_first,
                                easing: 'easeOutQuad'
                            });
                            t_days_container.animate({
                                marginTop: 0
                            }, {
                                queue: false,
                                duration: t_speed_second,
                                easing: 'easeInQuad'
                            });
                        }
                    });
                }
                t_hours_marine[0].stop(true, true).animate({
                    opacity: 0
                }, {
                    queue: false,
                    duration: t_speed_first,
                    easing: 'easeInQuad'
                });
                t_hours_marine[1].stop(true, true).animate({
                    opacity: 1
                }, {
                    queue: false,
                    duration: t_speed_first,
                    easing: 'easeInQuad'
                });
                t_hours_container.stop(true, true).animate({
                    marginTop: 0
                }, {
                    queue: false,
                    duration: t_speed_first,
                    easing: 'easeOutQuad',
                    complete: function() {
                        t_hours.html(t_date_hours);
                        t_hours_marine[0].stop(true, true).animate({
                            opacity: 1
                        }, {
                            queue: false,
                            duration: t_speed_first,
                            easing: 'easeOutQuad'
                        });
                        t_hours_marine[1].stop(true, true).animate({
                            opacity: 0
                        }, {
                            queue: false,
                            duration: t_speed_first,
                            easing: 'easeOutQuad'
                        });
                        t_hours_container.animate({
                            marginTop: 0
                        }, {
                            queue: false,
                            duration: t_speed_second,
                            easing: 'easeInQuad'
                        });
                    }
                });
            }
            t_minutes_marine[0].stop(true, true).animate({
                opacity: 0
            }, {
                queue: false,
                duration: t_speed_first,
                easing: 'easeInQuad'
            });
            t_minutes_marine[1].stop(true, true).animate({
                opacity: 1
            }, {
                queue: false,
                duration: t_speed_first,
                easing: 'easeInQuad'
            });
            t_minutes_container.stop(true, true).animate({
                marginTop: 0
            }, {
                queue: false,
                duration: t_speed_first,
                easing: 'easeOutQuad',
                complete: function() {
                    t_minutes.html(t_date_minutes);
                    t_minutes_marine[0].stop(true, true).animate({
                        opacity: 1
                    }, {
                        queue: false,
                        duration: t_speed_first,
                        easing: 'easeOutQuad'
                    });
                    t_minutes_marine[1].stop(true, true).animate({
                        opacity: 0
                    }, {
                        queue: false,
                        duration: t_speed_first,
                        easing: 'easeOutQuad'
                    });
                    t_minutes_container.animate({
                        marginTop: 0
                    }, {
                        queue: false,
                        duration: t_speed_second,
                        easing: 'easeInQuad'
                    });
                }
            });
        }
        t_seconds_marine[0].stop(true, true).animate({
            opacity: 0
        }, {
            queue: false,
            duration: t_speed_first,
            easing: 'easeInQuad'
        });
        t_seconds_marine[1].stop(true, true).animate({
            opacity: 1
        }, {
            queue: false,
            duration: t_speed_first,
            easing: 'easeInQuad'
        });
        t_seconds_container.stop(true, true).animate({
            marginTop: 0
        }, {
            queue: false,
            duration: t_speed_first,
            easing: 'easeOutQuad',
            complete: function() {
                t_seconds.html(t_date_seconds);
                t_seconds_marine[0].stop(true, true).animate({
                    opacity: 1
                }, {
                    queue: false,
                    duration: t_speed_first,
                    easing: 'easeOutQuad'
                });
                t_seconds_marine[1].stop(true, true).animate({
                    opacity: 0
                }, {
                    queue: false,
                    duration: t_speed_first,
                    easing: 'easeOutQuad'
                });
                t_seconds_container.animate({
                    marginTop: 0
                }, {
                    queue: false,
                    duration: t_speed_second,
                    easing: 'easeInQuad'
                });
            }
        });
    }, t_speed);

    var t_ocean_custom = $({
        distance: 0
    });
    var t_ocean_time = 3000;
    var t_course = $('.bottom_site .course');
    var t_ocean_waves = function() {
        t_ocean_custom.stop().prop('distance', 0).animate({
            distance: 98
        }, {
            queue: false,
            duration: t_ocean_time,
            easing: 'easeInOutQuad',
            step: function() {
                t_ocean.css('background-position', this.distance + 'px 0px');
                var t_course_value = 'rotate(' + String(Math.sin(2 * Math.PI * this.distance / 98) * 15) + 'deg)';
                t_course.css({
                    '-webkit-transform': t_course_value,
                    '-moz-transform': t_course_value,
                    '-ms-transform': t_course_value,
                    '-o-transform': t_course_value,
                    'transform': t_course_value
                });
            }
        });
    };

    t_ocean_waves();
    setInterval(t_ocean_waves, t_ocean_time);

});




jQuery(document).ready(function() {
    /* ANIMATIONS */
    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();

    jQuery('.skill-id-1').css('width', '80%');
    jQuery('.skill-id-2').css('width', '60%');
    jQuery('.skill-id-3').css('width', '90%');
    jQuery('.skill-id-4').css('width', '85%');
    jQuery('.skill-id-5').css('width', '75%');

    jQuery('body').find('.counter-all').counterUp({
        delay: 10, // the delay time in ms
        time: 1000 // the speed time in ms
    });

});


/* NEW ITEMS */
var aWP = {

  settings: {

    scripts: [
      /* 'js/plugins/queryloader.js', */
      '/assets/js/plugins/easing.js',
      '/assets/js/plugins/sticky.js',
      '/assets/js/plugins/viewport.js',
      '/assets/js/plugins/magnific-popup.js',
      '/assets/js/plugins/bigslide.js',
      '/assets/js/plugins/enquire.js',
      '/assets/js/plugins/jquery.finger.js',
      /* 'js/plugins/simple-slider.js', */
      '/assets/js/plugins/knob.js',
      '/assets/js/plugins/fitvids.js',
      '/assets/js/plugins/masonry.pkgd.min.js',
      '/assets/js/plugins/classie.js',
      '/assets/js/plugins/imagesloaded.js',
      '/assets/js/plugins/AnimOnScroll.js',
      '/assets/js/plugins/tubular.js',
      '/assets/js/plugins/swipebox.js',
      '/assets/js/plugins/scrolld.js',
      '/assets/js/plugins/appear.js',
    ]

  },
  init: function () {
    this.loadScripts();    
  },

  module: function () {
    /* this.queryLoader(); */
    this.twitter();
    this.sticky();
    this.viewport();
    this.modal();
    this.map();
    this.knob();
    this.flickr();
    this.menu();
    this.fitvids();
    this.progressBar();
    this.tubular();
    this.zoomImage();
    this.portfolioFilter();
    this.scrolld();
    this.scrollEffect();
  },

  loadScripts: function () {

    Modernizr.load([
      {
        load: [
                '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
              ],
        complete: function () {
          if ( !window.jQuery ) {
                Modernizr.load('js/jquery.js');
          }
          var scripts = [];
          $.each(aWP.settings.scripts,function(index,script){
            scripts[index] = $.getScript(script);
          });
          $.when.apply($,scripts).done(function(){
            aWP.module();
            
          });

        },
      },
     
    ]);

  },
  
  /*
  queryLoader: function () {

    $(document).ready(function () {
      $("body").queryLoader2({
        backgroundColor: '#FBFBFB',
        barColor: '#99D9F2',
        percentage: false,
        barHeight: 10,
        minimumTime: 3000,
        overlayId: 'theme-loader',
        onComplete: showContent(),
      });

      //$('#theme-loader').prepend('Some text');

      function showContent() {
        $('#home').addClass('show-content');
         $("body").css('overflow', 'visible');
        aWP.simpleSlider();

        setTimeout(function() {
          aWP.gridEffect();
          
        }, 100);
      }
    });
  },
    */
    
  sticky: function () {
    if($('.sticky-bar').length) {
      $(".sticky-bar").sticky({topSpacing:0});       
    }
  },

  fitvids: function () {
    var video = $('noscript').text();

    if(video.trim().search('iframe') === 1) {
      $('noscript').parent().append(video);      
    }


    $("#home").fitVids({ customSelector: "iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com']"});
  },

  viewport: function () {
     //$(":in-viewport")
     //$(":below-the-fold")
     //$(":above-the-top")
     //$(":left-of-screen")
     //$(":right-of-screen")

    $(window).scroll(function () {
       $('.small-footer:in-viewport').each(function () {
       
     });
    }); 
  },

  modal: function () {

    $('.modal-link').magnificPopup({
      type:'inline',
      midClick: true,
      gallery: {
          enabled: true
        },
      mainClass: 'mfp-fade'
    });

  },

  scrolld: function () {
    $(".main-nav > ul#one-page > li > a, .intro-button").stop(true).on('click', function (e) {
      $(".main-nav > ul#one-page > li").removeClass('current-menu-item');

      if($(this).hasClass('intro-button')) {
        $(".main-nav > ul > li").eq(0).addClass('current-menu-item'); 
      } else {
        $(this).parent().addClass('current-menu-item');        
      }


      e.preventDefault();
      $(this).scrolld({
        scrolldEasing: 'easeOutBack'
      });
    });
  },

  tubular: function () {

    $('.full-video').tubular({
      videoId : 'ssutK1Gei4A',
      start   : 3
    });

  },

  map: function () {

    if(typeof(google) != "undefined") {

      var myLatlng = new google.maps.LatLng(44.2661906,-68.5691898);
      var myOptions = {
          zoom: 16,
          center: myLatlng,
          disableDefaultUI: true,
          panControl: true,
          zoomControl: true,
          scrollwheel: false,
          zoomControlOptions: {
              style: google.maps.ZoomControlStyle.DEFAULT
          },

          mapTypeControl: true,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
          },
          streetViewControl: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP,

          styles:[
              {
                  "featureType": "landscape",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "lightness": 65
                      },
                      {
                          "visibility": "on"
                      }
                  ]
              },
              {
                  "featureType": "poi",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "lightness": 51
                      },
                      {
                          "visibility": "simplified"
                      }
                  ]
              },
              {
                  "featureType": "road.highway",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "visibility": "simplified"
                      }
                  ]
              },
              {
                  "featureType": "road.arterial",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "lightness": 30
                      },
                      {
                          "visibility": "on"
                      }
                  ]
              },
              {
                  "featureType": "road.local",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "lightness": 40
                      },
                      {
                          "visibility": "on"
                      }
                  ]
              },
              {
                  "featureType": "transit",
                  "stylers": [
                      {
                          "saturation": -100
                      },
                      {
                          "visibility": "simplified"
                      }
                  ]
              },
              {
                  "featureType": "administrative.province",
                  "stylers": [
                      {
                          "visibility": "off"
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "labels",
                  "stylers": [
                      {
                          "visibility": "on"
                      },
                      {
                          "lightness": -25
                      },
                      {
                          "saturation": -100
                      }
                  ]
              },
              {
                  "featureType": "water",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "hue": "#ffff00"
                      },
                      {
                          "lightness": -25
                      },
                      {
                          "saturation": -97
                      }
                  ]
              }
          ]
          }
      var map = new google.maps.Map(document.getElementById("map-box"), myOptions);
      var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title:"brooklin"
      });

    }

  },

  flickr: function () {
    $('.flickr-widget').each(function(){
        var stream = $(this),
            stream_userid = stream.attr('data-userid'),
            stream_items = parseInt(stream.attr('data-items'));

        $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=json&id="+stream_userid+"&jsoncallback=?", function(stream_feed){
            
            for(var i=0;i<stream_items&&i<stream_feed.items.length;i++){
                var stream_function = function(){
                    if(stream_feed.items[i].media.m){
                        var stream_a = $('<a>').addClass('flickr-link').attr('href',stream_feed.items[i].link).attr('target','_blank');
                        var stream_img = $('<img>').addClass('flickr-img').attr('src',stream_feed.items[i].media.m).attr('alt','').each(function(){
                            var t_this = this;
                            var j_this = $(this);
                            var t_loaded_function = function(){
                                stream_a.append(t_this);
                            };
                            var t_loaded_ready = false;
                            var t_loaded_check = function(){
                                if(!t_loaded_ready){
                                    t_loaded_ready = true;
                                    t_loaded_function();
                                }
                            }
                            var t_loaded_status = function(){
                                if(t_this.complete&&j_this.height()!==0)
                                    t_loaded_check();
                            }
                            t_loaded_status();
                            $(this).load(function(){
                                t_loaded_check();
                            });
                        });
                        stream.append($('<li class="col-xs-3 col-md-6">').append(stream_a));
                    }
                }
                stream_function();
            }
        });
    });
  },

  twitter: function () {
    var linkify = function(text) {
        text = text.replace(/(https?:\/\/\S+)/gi, function(s) {
            return '<a href="' + s + '">' + s + '</a>';
        });
        text = text.replace(/(^|)@(\w+)/gi, function(s) {
            return '<a href="http://twitter.com/' + s + '">' + s + '</a>';
        });
        text = text.replace(/(^|)#(\w+)/gi, function(s) {
            return '<a href="http://search.twitter.com/search?q=' + s.replace(/#/, '%23') + '">' + s + '</a>';
        });
        return text;
    };
    $('.twitter-widget').each(function() {
        var t = $(this);
        var t_date_obj = new Date();
        var t_loading = 'Loading tweets..'; //message to display before loading tweets
        var t_container = t.append('<p>' + t_loading + '</p>');
        t.append(t_container);
        var t_user = t.attr('data-user');
        var t_posts = parseInt(t.attr('data-posts'), 10);
        $.getJSON("php/twitter.php?user=" + t_user, function(t_tweets) {
            t_container.empty();
            for (var i = 0; i < t_posts && i < t_tweets.length; i++) {
                var t_date = Math.floor((t_date_obj.getTime() - Date.parse(t_tweets[i].created_at)) / 1000);
                var t_date_str;
                var t_date_seconds = t_date % 60;
                t_date = Math.floor(t_date / 60);
                var t_date_minutes = t_date % 60;
                if (t_date_minutes) {
                    t_date = Math.floor(t_date / 60);
                    var t_date_hours = t_date % 60;
                    if (t_date_hours) {
                        t_date = Math.floor(t_date / 60);
                        var t_date_days = t_date % 24;
                        if (t_date_days) {
                            t_date = Math.floor(t_date / 24);
                            var t_date_weeks = t_date % 7;
                            if (t_date_weeks)
                                t_date_str = t_date_weeks + ' week' + (1 == t_date_weeks ? '' : 's') + ' ago';
                            else
                                t_date_str = t_date_days + ' day' + (1 == t_date_days ? '' : 's') + ' ago';
                        }
                        else
                            t_date_str = t_date_hours + ' hour' + (1 == t_date_hours ? '' : 's') + ' ago';
                    }
                    else
                        t_date_str = t_date_minutes + ' minute' + (1 == t_date_minutes ? '' : 's') + ' ago';
                }
                else
                    t_date_str = t_date_seconds + ' second' + (1 == t_date_seconds ? '' : 's') + ' ago';
                var t_message =
                        '<p>' +
                        linkify(t_tweets[i].text) +
                        '<span>' +
                        t_date_str +
                        '</span>' +
                        '</p>';
                t_container.append(t_message);
            }
        });
    });
  },

  menu: function () {
    var menu = $('.main-nav');
    var bodyPosition,
        menuButtonHTML = '<a href="#" class="mobile-menu-button"><i class="icon-62"></i></a>',
        menuButton = $('.mobile-menu-button'),
        menuButtonHolder = $('.logo'),
        menuMarkup = menu.clone(),
        i = 0,
        t = 0;
        //menuMarkup.prepend(menuButtonHTML);

        $(document).on('click', '.mobile-menu-button', function(e) {
          e.preventDefault();

          if(menuMarkup.hasClass('active-menu')) {
            menuMarkup.removeClass('active-menu');
          }else {
            menuMarkup.toggleClass('active-menu');            
          }

          if($('body').hasClass('active-menu')) {
             $('body').removeClass('active-menu');
          }else {            
            $('body').toggleClass('menu-effect');
          }
        });

        $(document).on('drag', 'body .main-nav', function(e) {
            bodyPosition = -(e.adx - 200);

            if(e.adx < 100) {
              $('body.menu-effect .boxed-view').css({
                '-webkit-transform': 'translate3d('+bodyPosition+'px,0,0)'
              });
            }

            if(e.end === true) {
                $('body.menu-effect .boxed-view').removeAttr("style");
              if(e.adx > 100) {
                $('body ').removeClass('menu-effect');
                $('body > .main-nav').removeClass('active-menu');
              }
            }            
        });

        enquire.register("screen and (max-width:992px)", {

            // OPTIONAL
            // If supplied, triggered when a media query matches.
            match : function() {
              menu.hide();
              if(i === 0) {
                $('body').prepend(menuMarkup);
                i++;             
              } else {
                menuMarkup.show();
              }

              if(t === 0) {
                menuButtonHolder.append(menuButtonHTML);
                t++;               
              } else {
                $('.logo .mobile-menu-button').show();
              }


              $(document).on('click', 'body > .main-nav > ul > li > a', function(e) {
                var checkParent = $(this).next('ul');
                var menuItem = $(this)[0].outerHTML;

                if(checkParent.length === 1) {
                   e.preventDefault();
                   $('body > .main-nav > ul > li > ul').removeClass('menu-items-active-mob');
                   checkParent.toggleClass('menu-items-active-mob');
                   $('body > .main-nav > ul > li > a').removeClass('link-items-active-mob');
                   $(this).toggleClass('link-items-active-mob');
                   if(checkParent.find('.prepended').length === 0 ){
                    checkParent.prepend('<li class="prepended">'+menuItem+'</li>');
                    
                   }
                }

              });

               $(document).on('click', '.link-items-active-mob', function(e) {
                  $(this).removeClass('link-items-active-mob');
                   $(this).next().removeClass('menu-items-active-mob');
                });
            },      
                                        
            // OPTIONAL
            // If supplied, triggered when the media query transitions 
            // *from a matched state to an unmatched state*.
            unmatch : function() {
             menuMarkup.hide();
             menu.show();
             $('.logo .mobile-menu-button').hide();
            },    
            
            // OPTIONAL
            // If supplied, triggered once, when the handler is registered.
            setup : function() {},    
                                        
            // OPTIONAL, defaults to false
            // If set to true, defers execution of the setup function 
            // until the first time the media query is matched
            deferSetup : true,
                                        
            // OPTIONAL
            // If supplied, triggered when handler is unregistered. 
            // Place cleanup code here
            destroy : function() {}
              
        });

  },
  /*
  simpleSlider: function () {

    $( '#simple-slider' ).sudoSlider({
       numeric: true,
       responsive: true,
       autoHeight: false,
       effect: "random",
       prevhtml:          ' <a href="#" class="prev-nav"><i class="icon-517"></i></a> ',
       nexthtml:          ' <a href="#" class="next-nav"><i class="icon-501"></i></a> ',
       controlsattr:      'id="controls"',
       numericattr:       'class="slider-nav"',
       continuous: true,
       updateBefore: true,
       animationZIndex: 10,
    });    

    var portfolioSlider = $( '#portfolio-slider' ).sudoSlider({
       numeric: false,
       responsive: true,
       slideCount: 4,
       moveCount: 1,
       speed: 500,
       continuous: false,
       updateBefore: true,
       prevhtml:          ' <a href="#" class="prev-nav"><i class="icon-517"></i></a> ',
       nexthtml:          ' <a href="#" class="next-nav"><i class="icon-501"></i></a> ',
       controlsattr:      'id="controls-portfolio"'
    });

    if($( '#portfolio-slider' ).length) {
      $(window).resize(function() {
      if($(window).width() < 992) {
        portfolioSlider.setOption('slideCount', 1);
      }else {
        portfolioSlider.setOption('slideCount', 4);
      }
    });
    }

    $( '#testimonials-slider' ).sudoSlider({
       numeric: false,
       responsive: true,
       moveCount: 1,
       speed: 1000,
       updateBefore: true,
       vertical: true,
       continuous: true,
       auto: true,
       prevhtml:          ' <a href="#" class="prev-nav"><i class="icon-503"></i></a> ',
       nexthtml:          ' <a href="#" class="next-nav"><i class="icon-515"></i></a> ',
       controlsattr:      'id="controls-testimonials"'
    });

    $( '.portfolio-slider' ).sudoSlider({
       numeric: true,
       responsive: true,
       moveCount: 1,
       speed: 1000,
       auto: false,
       continuous: true,
       updateBefore: true,
       prevhtml:          ' <a href="#" class="prev-nav"><i class="icon-517"></i></a> ',
       nexthtml:          ' <a href="#" class="next-nav"><i class="icon-501"></i></a> ',
       controlsattr:      'id="controls"',
       numericattr:       'class="slider-nav"', 
    });

    $( '.blog-slider' ).sudoSlider({
       numeric: false,
       responsive: true,
       moveCount: 1,
       speed: 1000,
       auto: false,
       continuous: true,
       updateBefore: true,
       prevhtml:          ' <a href="#" class="prev-nav"><i class="icon-517"></i></a> ',
       nexthtml:          ' <a href="#" class="next-nav"><i class="icon-501"></i></a> ',
       controlsattr:      'id="controls"',
       numericattr:       'class="slider-nav"', 
    });


    // sliders.each(function() {
    //   var imgSrc = $(this).find('img').attr('src');
    //   $('.portfolio-thumbs').append('<li><img src="' + imgSrc + '" height="28"></li>');
    // });

  },
  */

  knob: function () {

    $(".statistic-item").knob({
      thickness: '.05',
      lineCap: 'round',
      fgColor: '#ffffff',
      bgColor: 'rgba(255,255,255,0.2)',
      readOnly: true,
      displayInput: true,
      font: "Playfair Display",
      fontWeight: '700',
      step: 1,
    });     

    $(".statistic-item").each(function() {
        var defaultVal = $(this).val(),
            item = $(this),
            i = 0,
            statisticAnimation = setInterval(function(){
              if(i<=defaultVal) {
                item.val(i).trigger("change");
                i++;
              } else {
                clearInterval(statisticAnimation);
              }
        }, 50);

    });

  },

  progressBar: function () {
    var target = $('.progresive-bar-items > li'),
        bar = $('.progresive-bar-items > li span');

    target.each(function (e) {

      var data = bar.eq(e).data('progress');
      var i = 100;

      data = 100-data;

      var progressVal = setInterval(function() {
        if (i > data) {

          if(i%2 == 0) {
            i = i+3;
          } else {
            i = i-5;
          }

          bar.eq(e).css('right', i+'%');
        } else {
          clearInterval(progressVal);
        }          
      }, 20);
      
    });
  },

  gridEffect: function() {

      if($('#grid-effect').length) {
          new AnimOnScroll( document.getElementById( 'grid-effect' ), {
            minDuration : 0.4,
            maxDuration : 0.7,
            viewportFactor : 0.1
          } );
      }
    
  },

  zoomImage: function () {
    $( '.zoom-image' ).swipebox();
  },

  portfolioFilter: function () {
      $('.filter-tags > li a').click(function (e) {
          e.preventDefault();
          var tag = $(this).text();
          var filters = $(this).parent();
          $('.filter-tags > li').removeClass('active-filter')
          filters.addClass('active-filter');

          $('#sorted-tag').html(tag);

          $('.portfolio-items > li > div').each(function() {
           $(this).parent().removeClass('hidden-item');
            if($(this).hasClass(tag.toLowerCase()) == false && tag.toLowerCase() !== 'all') {
              $(this).parent().addClass('hidden-item');
            }

          });

      });
  },

  scrollEffect: function() {

      $('.box').appear();

      $('.box').on('appear', function(event) {

          $('.fancy-heading').addClass('scroll-actived');
          
          if($(this).is('#features')) {

            if($('.features-items > li').hasClass('scroll-actived') === false) {

                $('.features-items > li').each(function(index) {
                      setTimeout(
                        function() 
                        {
                          //do something special
                           $('.features-items > li').eq(index).addClass('scroll-actived');

                        }, 400 * index);
                      
                });
            }
          }

          if($(this).is('.action-box') &&  $('.action-box').hasClass('scroll-actived') === false) {
            $('.action-box').addClass('scroll-actived');
          }

          if($(this).is('.statistics-box') && $('.statistics-box').hasClass('scroll-actived') === false) {
            $('.statistics-box').addClass('scroll-actived');
            setTimeout(
              function() 
              {               

                  $(".statistic-item").each(function() {
                    var defaultVal = $(this).val(),
                        item = $(this),
                        i = 0,
                        statisticAnimation = setInterval(function(){
                          if(i<=defaultVal) {
                            item.val(i).trigger("change");
                            i++;
                          } else {
                            clearInterval(statisticAnimation);
                          }
                        }, 50);

                  });

                
              }, 400);
          }

          // if($(this).is('.portfolio-box') && $('.portfolio-box').hasClass('scroll-actived') === false) {

          //     $('.portfolio-box').addClass('scroll-actived');

          //      $('.portfolio-items > li').each(function(index) {
          //         setTimeout(
          //           function() 
          //           {
          //             //do something special
          //              $('.portfolio-items > li').eq(index).addClass('scroll-actived');

          //           }, 100 * index);
                      
          //       });
          // }

    });
  }

};

aWP.init();