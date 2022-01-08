jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') {
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        var path = options.path ? '; path=' + options.path : '';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
var lcs = {
    get: function(dataKey) {
        if (window.localStorage) {
            return localStorage.getItem(dataKey);
        } else {
            return $.cookie(dataKey);
        }
    },
    set: function(key, value) {
        if (window.localStorage) {
            localStorage[key] = value;
        } else {
            $.cookie(key, value);
        }
    },
    remove: function(key) {
        if (window.localStorage) {
            localStorage.removeItem(key);
        } else {
            $.cookie(key, undefined);
        }
    }
};
(function(window) {
    'use strict';

    function classReg(className) {
        return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    }
    var hasClass, addClass, removeClass;
    if ('classList' in document.documentElement) {
        hasClass = function(elem, c) {
            return elem.classList.contains(c);
        };
        addClass = function(elem, c) {
            elem.classList.add(c);
        };
        removeClass = function(elem, c) {
            elem.classList.remove(c);
        };
    } else {
        hasClass = function(elem, c) {
            return classReg(c).test(elem.className);
        };
        addClass = function(elem, c) {
            if (!hasClass(elem, c)) {
                elem.className = elem.className + ' ' + c;
            }
        };
        removeClass = function(elem, c) {
            elem.className = elem.className.replace(classReg(c), ' ');
        };
    }

    function toggleClass(elem, c) {
        var fn = hasClass(elem, c) ? removeClass : addClass;
        fn(elem, c);
    }
    var classie = {
        // full names
        hasClass: hasClass,
        addClass: addClass,
        removeClass: removeClass,
        toggleClass: toggleClass,
        // short names
        has: hasClass,
        add: addClass,
        remove: removeClass,
        toggle: toggleClass
    };
    // transport
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(classie);
    } else {
        // browser global
        window.classie = classie;
    }
})(window);
var ModalEffects = (function() {
    function init() {
        var overlay = document.querySelector('.md-overlay');
        [].slice.call(document.querySelectorAll('.md-trigger')).forEach(function(el, i) {
            var modal = document.querySelector('#' + el.getAttribute('data-modal')),
                close = modal.querySelector('.md-close');

            function removeModal(hasPerspective) {
                classie.remove(modal, 'md-show');
                if (hasPerspective) {
                    classie.remove(document.documentElement, 'md-perspective');
                }
            }

            function removeModalHandler() {
                removeModal(classie.has(el, 'md-setperspective'));
                $('body').css({
                    "overflow-x": "auto",
                    "overflow-y": "auto"
                });
            }
            el.addEventListener('click', function(ev) {
                classie.add(modal, 'md-show');
                overlay.removeEventListener('click', removeModalHandler);
                overlay.addEventListener('click', removeModalHandler);
                if (classie.has(el, 'md-setperspective')) {
                    setTimeout(function() {
                        classie.add(document.documentElement, 'md-perspective');
                    }, 25);
                }
            });
            close.addEventListener('click', function(ev) {
                ev.stopPropagation();
                removeModalHandler();
            });
        });
    }
    init();
})();
//切换密码显示
var pai = 1;
$(".passw").on("click", function() {
    if (pai == 1) {
        $(this).find('.fa').addClass("fa-eye-slash");
        $(this).siblings('input').attr('type', 'text');
        pai = 2
    } else {
        $(this).find('.fa').removeClass("fa-eye-slash");
        $(this).siblings('input').attr('type', 'password');
        pai = 1
    }
})
// 夜间模式切换
$(".toggle-theme").click(function() {
    var pane = $('<div class="sky-bg"><div class="day-moon-1 hidden"></div><div class="day-moon-2 hidden"></div></div>');
    pane.appendTo("body");
    var millisecond = new Date().getTime();
    var expiresTime = new Date(millisecond + 60 * 1000 * 60 * 2);
    $("#body").addClass("fixed");
    setTimeout(function() {
        if ($('body').hasClass('dark-theme')) {
            $("body").removeClass("dark-theme");
            $("body").addClass("white-theme");
            $.cookie("night", "0", {
                expires: expiresTime,
                path: '/'
            });
            $(".day-moon-1").removeClass("hidden");
            $(".sw-btn").removeClass("fa-sun-o");
            $(".sw-btn").addClass("fa-moon-o");
            setTimeout(function() {
                $(".day-moon-2").removeClass("hidden");
                $(".day-moon-1").addClass("hidden");
            }, 1000)
        } else {
            $("body").addClass("dark-theme");
            $("body").removeClass("white-theme");
            $.cookie("night", "1", {
                expires: expiresTime,
                path: '/'
            });
            $(".day-moon-2").removeClass("hidden");
            $(".sw-btn").removeClass("fa-moon-o");
            $(".sw-btn").addClass("fa-sun-o");
            setTimeout(function() {
                $(".day-moon-1").removeClass("hidden")
                $(".day-moon-2").addClass("hidden")
            }, 1000)
        }
        setTimeout(function() {
            $(".sky-bg").fadeOut(1000, function() {
                $(this).remove()
            })
            $("#body").removeClass("fixed");
            if ($("#chart-1").hasClass("gdtu")) {
                window.location.reload()
            }
        }, 2000)
    }, 0)
});
// 按钮展开
$('#r-config').on('click', function() {
    if ($('#r-hide').hasClass('rightside-in')) {
        $('#r-hide').removeClass('rightside-in').addClass('rightside-out')
    } else {
        $('#r-hide').removeClass('rightside-out').addClass('rightside-in')
    }
})
// 返回顶部
function scrollToDest(name, offset = 0) {
    const scrollOffset = $(name).offset()
    $('body,html').animate({
        scrollTop: scrollOffset.top - offset
    });
};
$(window).scroll(function() {
    var scroHei = $(window).scrollTop();
    if (scroHei > 250) {
        $('#go-up').removeClass("btn-hidden");
    } else {
        $('#go-up').addClass("btn-hidden");
    }
});
$('#go-up').on('click', function() {
    scrollToDest('body')
})
// 侧栏随动
$(document).ready(function() {
    $('.index-layout,.side-layout').theiaStickySidebar({
        containerSelector: ".index-content",
        additionalMarginTop: 80,
    });
});
// 首页轮播
$(document).ready(function() {
    $(".flexslider").flexslider({
        animation: "fade",
        slideshow: true,
        pauseOnHover: false,
        keyboardNav: true,
        mousewheel: false,
        controlNav: true,
        mousewheel: false,
        slideshowSpeed: 7000,
        animationDuration: 400,
        touch: true,
        directionNav: true,
        prevText: "",
        nextText: "",
    });
});
// 标签页
if (typeof jQuery === 'undefined') {
    throw new Error('Bootstrap\'s JavaScript requires jQuery')
} + function($) {
    'use strict';
    var version = $.fn.jquery.split(' ')[0].split('.')
    if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1) || (version[0] > 3)) {
        throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4')
    }
}(jQuery); + function($) {
    'use strict';
    var Tab = function(element) {
        this.element = $(element)
    }
    Tab.TRANSITION_DURATION = 150
    Tab.prototype.show = function() {
        var $this = this.element
        var $ul = $this.closest('ul:not(.dropdown-menu)')
        var selector = $this.data('target')
        if (!selector) {
            selector = $this.attr('href')
            selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '')
        }
        if ($this.parent('li').hasClass('active')) return
        var $previous = $ul.find('.active:last a')
        var hideEvent = $.Event('hide.bs.tab', {
            relatedTarget: $this[0]
        })
        var showEvent = $.Event('show.bs.tab', {
            relatedTarget: $previous[0]
        })
        $previous.trigger(hideEvent)
        $this.trigger(showEvent)
        if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) return
        var $target = $(selector)
        this.activate($this.closest('li'), $ul)
        this.activate($target, $target.parent(), function() {
            $previous.trigger({
                type: 'hidden.bs.tab',
                relatedTarget: $this[0]
            })
            $this.trigger({
                type: 'shown.bs.tab',
                relatedTarget: $previous[0]
            })
        })
    }
    Tab.prototype.activate = function(element, container, callback) {
        var $active = container.find('> .active')
        var transition = callback && $.support.transition && ($active.length && $active.hasClass('fade') || !!container.find('> .fade').length)

        function next() {
            $active.removeClass('active').find('> .dropdown-menu > .active').removeClass('active').end().find('[data-toggle="tab"]').attr('aria-expanded', false)
            element.addClass('active').find('[data-toggle="tab"]').attr('aria-expanded', true)
            if (transition) {
                element[0].offsetWidth // reflow for transition
                element.addClass('in')
            } else {
                element.removeClass('fade')
            }
            if (element.parent('.dropdown-menu').length) {
                element.closest('li.dropdown').addClass('active').end().find('[data-toggle="tab"]').attr('aria-expanded', true)
            }
            callback && callback()
        }
        $active.length && transition ? $active.one('bsTransitionEnd', next).emulateTransitionEnd(Tab.TRANSITION_DURATION) : next()
        $active.removeClass('in')
    }

    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.tab')
            if (!data) $this.data('bs.tab', (data = new Tab(this)))
            if (typeof option == 'string') data[option]()
        })
    }
    var old = $.fn.tab
    $.fn.tab = Plugin
    $.fn.tab.Constructor = Tab
    $.fn.tab.noConflict = function() {
        $.fn.tab = old
        return this
    }
    var clickHandler = function(e) {
        e.preventDefault()
        Plugin.call($(this), 'show')
    }
    $(document).on('click.bs.tab.data-api', '[data-toggle="tab"]', clickHandler).on('click.bs.tab.data-api', '[data-toggle="pill"]', clickHandler)
}(jQuery);
// 标签页刷新定位
$(".intitle").click(function() {
    var millisecond = new Date().getTime();
    var expiresTime = new Date(millisecond + 60 * 1000 * 5);
    var value = $(this).find("a").attr("data-target")
    $.cookie("index-tag", value, {
        expires: expiresTime,
        path: '/'
    });
    $(value + ">ul>li>a>img").lazyload({});
})

// 滚动加载
$('.loadmore').click(function(){
        if($('.next').attr('href')){
    　　　　 $.ajax({
                type: 'post',
                url: $('.next').attr('href'),
                async: true,
                timeout: 30000,
                cache: true,
                success: function(data) {
                    var div = $('<div>');
                    div.html(data);
                    var nextUrl = div.find('.next').attr("href");
                    if(!nextUrl){$('.next').remove();}
                    var nextPosts = div.find(".post-box-item").html();
                    $('.next').attr('href',nextUrl);
                    $(".post-box-item").append(nextPosts); 
                    $(".post-box-item img").lazyload({});
                },
                error: function(data) {console.log('滚动加载请求失败');},
            });
        }else {
            $(".loadmore").text("已经到底咯···")
        }
});

$(document).ready(function() {
    // 图片懒加载
    $("img.lazy").lazyload({
        threshold: 100,
        effect: "fadeIn"
    });
    // 打字机
    var typed_text = $(".typed-text").text();
    var typed_array = typed_text.split("\n");
    var typed = new Typed("#typed", {
        strings: typed_array,
        startDelay: 300,
        typeSpeed: 50,
        loop: true,
        backSpeed: 50,
        directionNav: false,
        showCursor: false
    });
    // 标签页刷新不切换
    if ($.cookie('index-tag')) {
        $($.cookie('index-tag')).addClass("active");
        var tag = $("a[data-target$='" + $.cookie('index-tag') + "']");
        tag.parent().addClass("active");
    } else {
        var tag = $(".nav-pills").find("li").first();
        tag.addClass("active");
        var tagPageId = tag.find("a").first().attr("data-target");
        $(tagPageId).addClass("active");
    };
    // 占满全屏
    var bh = $(body).height();
    var wh = $(window).height();
    var lt = $(".layout-page").offset().top;
    var lh = $(".layout-page").height();
    var fh = $("footer").height();
    var ph = wh - lt - lh - fh;
    if (bh < wh) {
        $(".layout-page").css("padding-bottom", ph + "px");
    }
    // 视频播放
    if ($("#dplayer").hasClass("player")) {
        const dplay = new DPlayer({
            container: document.getElementById('dplayer'),
            preload: 'auto',
            screenshot: true,
            hotkey: true,
            logo: $(".video").attr("logo"),
            theme: $(".video").css("color"),
            lang: 'zh-cn',
            playbackSpeed: [0.5, 0.75, 1, 1.25, 1.5, 2],
            autoplay: false,
            video: {
                url: $("#dplayer").attr('play-url'),
                pic: $(".diy-bg").css('backgroundImage').split('("')[1].split('")')[0],
                type: 'auto',
            },
        });

        function sw() {
            dplay.switchVideo({
                url: $("#dplayer").attr('play-url'),
                pic: $(".diy-bg").css('backgroundImage').split('("')[1].split('")')[0],
            })
        }
        $(".play").on("click", function() {
            var spurl = $(this).attr("data-url");
            $("#dplayer").attr("play-url", spurl);
            sw()
        });
    }
    // 取色盘
    $('.piccolor').colpick({
        flat: true,
        layout: 'full',
        submit: 0,
        colorScheme: 'light',
        onChange: function(hsb, hex, rgb, el, bySetColor) {
            $(el).css('border-color', '#' + hex);
            if (!bySetColor) $(el).val(hex);
        }
    }).keyup(function() {
        $(this).colpickSetColor(this.value);
    });
    $('[data-fancybox]').fancybox({
        transitionEffect: "zoom-in-out",
        transitionDuration: 366,
        protect: true,
        buttons: ["zoom", "slideShow", "fullScreen", "thumbs","close"],
    });

});
//代码添加行号
$('pre').addClass("line-numbers pre-scrollbar");
if ($(".OwO").length > 0) {
    var OwO_demo = new OwO({
        logo: "OωO表情",
        container: document.getElementsByClassName("OwO")[0],
        target: document.getElementsByClassName("OwO-textarea")[0],
        api: "/usr/themes/Grace/assets/OwO/OwO.json",
        position: "down",
        width: "100%",
        maxHeight: "250px"
    })
};

function cot_del() {
    var msg = "您真的确定要删除吗？";
    if (confirm(msg) == true) {
        return true;
    } else {
        return false;
    }
}
// 全局加载动画
$("#loading").fadeOut(500)
setTimeout(function() {
    $("#loading").remove();
}, 100)
// ajax

$(document).ready(function() {
    // 加密文章跳转
    $(".jiami").click(function(){
        $("#post-pass").attr("data-url",$(this).attr("data-url"));
    })
    $(".jiami a").attr("href","javascript:void(0)");
    $('#post-pass').on('click', function() {
        var post_url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url: post_url,
            data: {
                protectPassword: $('#post-password').val(),
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                if(data.indexOf("密码错误") >= 0 && data.indexOf("<title>Error</title>") >= 0){
                    alert("密码错误，请重试！");
                }else{
                    $(location).attr('href', post_url);
                }
            },
            error: function() {},
        });
    });

    // 分类页面设置
    $('#arc-btn').on('click', function() {
        $.ajax({
            type: 'post',
            url: $('#arc-btn').attr('data-url'),
            data: {
                arcId: $('#arc-btn').attr('data-mid'),
                name: $('#arc-name-value').val(),
                cover: $('#arc-cover-value').val(),
                icon: $('#arc-icon-value').val(),
                desc: $('#arc-desc-value').val()
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                $(".arc-name").html($('#arc-name-value').val());
                $("#menu-mid-" + $('#arc-btn').attr('data-mid') + " span").html($('#arc-name-value').val());
                if ($('#arc-cover-value').val()) {
                    $(".diy-archive-bg").css('background-image', 'url(' + $('#arc-cover-value').val() + ')');
                } else {
                    $(".diy-archive-bg").css('background-image', 'url(' + $('.default-cover').text() + ')');
                }
                if ($('#arc-icon-value').val()) {
                    $("#menu-mid-" + $('#arc-btn').attr('data-mid') + " i:first-child").removeClass();
                    $("#menu-mid-" + $('#arc-btn').attr('data-mid') + " i:first-child").addClass("fa x5 " + $('#arc-icon-value').val());
                    $("#m-menu-" + $('#arc-btn').attr('data-mid') + " i:first-child").removeClass();
                    $("#m-menu-" + $('#arc-btn').attr('data-mid') + " i:first-child").addClass("fa x5 " + $('#arc-icon-value').val());
                } else {
                    $("#menu-mid-" + $('#arc-btn').attr('data-mid') + " i:first-child").removeClass();
                    $("#menu-mid-" + $('#arc-btn').attr('data-mid') + " i:first-child").addClass("fa x5");
                    $("#m-menu-" + $('#arc-btn').attr('data-mid') + " i:first-child").removeClass();
                    $("#m-menu-" + $('#arc-btn').attr('data-mid') + " i:first-child").addClass("fa x5");
                }
            },
            error: function() {},
        });
    });
    // 页面设置
    $('#page-btn').on('click', function() {
        $.ajax({
            type: 'post',
            url: $('#page-btn').attr('data-url'),
            data: {
                pageCid: $('#page-btn').attr('data-cid'),
                pageCover: $('#page-cover-value').val(),
                pageIcon: $('#page-icon-value').val()
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                if ($('#page-cover-value').val()) {
                    $(".diy-archive-bg").css('background-image', 'url(' + $('#page-cover-value').val() + ')');
                } else {
                    $(".diy-archive-bg").css('background-image', 'url(' + $('.default-cover').text() + ')');
                }
                if ($('#page-icon-value').val()) {
                    $("#page-cid-" + $('#page-btn').attr('data-cid') + " i:first-child").removeClass();
                    $("#page-cid-" + $('#page-btn').attr('data-cid') + " i:first-child").addClass("fa x5 " + $('#page-icon-value').val());
                    $("#m-page-" + $('#page-btn').attr('data-cid') + " i:first-child").removeClass();
                    $("#m-page-" + $('#page-btn').attr('data-cid') + " i:first-child").addClass("fa x5 " + $('#page-icon-value').val());
                } else {
                    $("#page-cid-" + $('#page-btn').attr('data-cid') + " i:first-child").removeClass();
                    $("#page-cid-" + $('#page-btn').attr('data-cid') + " i:first-child").addClass("fa x5");
                    $("#m-page-" + $('#page-btn').attr('data-cid') + " i:first-child").removeClass();
                    $("#m-page-" + $('#page-btn').attr('data-cid') + " i:first-child").addClass("fa x5");
                }
            },
            error: function() {},
        });
    });
    // 添加链接
    $('#links-btn').on('click', function() {
        $.ajax({
            type: 'post',
            url: $('#links-btn').attr('data-url'),
            data: {
                ajaxPage: 'links',
                linksName: $('#links-name-value').val(),
                linksUrl: $('#links-url-value').val(),
                linksAvatar: $('#links-avatar-value').val(),
                linksDesc: $('#links-desc-value').val()
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                $(".links-page").append('<div class="link-item"><a class="links-box" href="' + $('#links-url-value').val() + '" ><img class="transform" src="' + $('#links-avatar-value').val() + '"><div class="link-ship"><h2 class="h-1x">' + $('#links-name-value').val() + '</h2><p class="h-2x">' + $('#links-desc-value').val() + '</p></div></a></div>')
            },
            error: function() {},
        });
    });
    // 删除链接
    $('.delete-link').on('click', function() {
        if ($('.links-edit').hasClass("hidden")) {
            $('.links-edit').removeClass("hidden");
        } else {
            $('.links-edit').addClass("hidden");
        }
    });
    $("#cansel-btn").click(function() {
        $(".md-modal").removeClass('md-show');
    })
    $('.de-link').on('click', function() {
        $("#link-id").remove();
        $(".links-page").append('<span id="link-id" style="display:none;">' + $(this).attr("data-lid") + '</span>');
        var lid = $("#link-id").text();
        $(".delete-name").html($('#link-' + lid + ' h2').text());
        $(".delete-desc").html($('#link-' + lid + ' p').text());
        $(".delete-avatar").attr("src", $('#link-' + lid + ' img').attr("src"));
        $("#de-link-btn").attr("data-lid", lid);
    });
    $('#de-link-btn').on('click', function() {
        var lid = $(this).attr("data-lid");
        $(".links-page").append('<span class="link-span">' + lid + '</span>');
        $.ajax({
            type: 'post',
            url: $(this).attr('data-url'),
            data: {
                DelLid: $(this).attr("data-lid")
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                $("#link-" + lid).remove();
                $('.link-span').remove();
            },
            error: function() {},
        });
    });
    // 编辑链接
    $(".edit-link").click(function() {
        var lid = $(this).attr("data-lid");
        var name = $("#link-" + lid + " h2").text();
        var url = $("#link-" + lid + " a").attr("href");
        var avatar = $("#link-" + lid + " img").attr("src");
        var desc = $("#link-" + lid + " p").text();
        $("#links-edit-btn").attr("data-lid", lid);
        $("#links-name-value1").attr("value", name);
        $("#links-url-value1").attr("value", url);
        $("#links-avatar-value1").attr("value", avatar);
        $("#links-desc-value1").attr("value", desc);
    });
    $('#links-edit-btn').on('click', function() {
        var lid = $(this).attr("data-lid");
        $(".links-page").append('<span class="link-span">' + lid + '</span>');
        $.ajax({
            type: 'post',
            url: $(this).attr('data-url'),
            data: {
                editLid: $(this).attr("data-lid"),
                editName: $('#links-name-value1').val(),
                editUrl: $('#links-url-value1').val(),
                editAvatar: $('#links-avatar-value1').val(),
                editDesc: $('#links-desc-value1').val(),
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                $("#link-" + lid + " h2").html($('#links-name-value1').val());
                $("#link-" + lid + " p").html($('#links-desc-value1').val());
                $("#link-" + lid + " a").attr("href", $('#links-url-value1').val());
                $("#link-" + lid + " img").attr("src", $('#links-avatar-value1').val());
                $('.link-span').remove();
            },
            error: function() {},
        });
    });
    $('.edit-talks').on('click', function() {
        if ($('.talks-edit').hasClass("hidden")) {
            $('.talks-edit').removeClass("hidden");
        } else {
            $('.talks-edit').addClass("hidden");
        }
    });
    $('.de-talk').on('click', function() {
        $("#talk-id").remove();
        $(".page-post").append('<span id="talk-id" style="display:none;">' + $(this).attr("data-tid") + '</span>');
        var tid = $("#talk-id").text();
        $("#de-talk-btn").attr("data-tid", tid);
    });
    $('#de-talk-btn').on('click', function() {
        var tid = $(this).attr("data-tid");
        $(".page-post").append('<span class="talk-span">' + tid + '</span>');
        $.ajax({
            type: 'post',
            url: $(this).attr('data-url'),
            data: {
                DelTid: $(this).attr("data-tid")
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                $("#talk-" + tid).remove();
                $('.talk-span').remove();
            },
            error: function() {},
        });
    });
    $(".edit-talk").click(function() {
        var tid = $(this).attr("data-tid");
        var type = $("#talk-" + tid).attr('type');
        var text = $("#talk-" + tid + " .talk-text").text();
        var url = $("#talk-" + tid + " .talk-url").text();
        $(".talk-tid").attr("value", tid);
        $("#edit-talk-btn").attr("data-tid", tid);
        $(".option input").removeAttr("checked");
        $("#talk-" + type + "1").attr('checked', "");
        $("#talk-meta-value1").attr("value", url);
        $("#talk-text-value1").html(text);
    });
    $(".talk-video").each(function() {
        var url = $(this).attr("data-url");
        var tid = $(this).attr("data-tid");
        var color = $(this).css("color");
        var logo = $(this).attr("data-logo");
        const dp = new DPlayer({
            container: document.getElementById('talk-video-' + tid),
            video: {
                url: url,
                pic: "",
            },
            theme: color,
            lang: 'zh-cn',
            screenshot: true,
            logo: logo,
        });
        $(this).removeAttr("data-url");
    });
    $('#color-btn').on('click', function() {
        $.ajax({
            type: 'post',
            url: $('#color-btn').attr('data-url'),
            data: {
                themeColor: $(".colpick_new_color").css("background-color"),
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                var cstr = "rgb(" + $(".colpick_new_color").css("background-color").split("rgb(")[1].split(")")[0];
                $(':root').attr("style", "--theme-color:" + $(".colpick_new_color").css("background-color") + ";--theme-bg-color:" + cstr + ", .3);--theme-bg-color1:" + cstr + ", .3);--theme-bg-color2:" + cstr + ", .5);--theme-bg-color3:" + cstr + ", .7);");
            },
            error: function() {},
        });
    });
});
// 文章发布统计图
$(document).ready(function() {
    if ($("#chart-1").hasClass("gdtu")) {
        var chart = echarts.init(document.getElementById('chart-1'));
        var option = {
            baseOption: {
                title: {
                    text: '文章发布统计图',
                    textStyle: {
                        color: $("#color1").css("color"),
                        lineHeight: 20,
                        fontSize: 18
                    },
                    padding: [20, 0, 0, 20],
                    left: 'center'
                },
                tooltip: {
                    trigger: 'axis',
                },
                grid: {
                    left: 20,
                    right: 10,
                    bottom: 80,
                },
                xAxis: {
                    type: 'category',
                    data: $("#chart-x-data").text().split(','),
                    axisLine: {
                        lineStyle: {
                            color: $("#color2").css("color"),
                        }
                    },
                    axisLabel: {
                        rotate: 10,
                        interval: 0,
                        textStyle: {
                            fontSize: 12,
                        }
                    },
                    nameTextStyle: {
                        fontSize: 10
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLine: {
                        lineStyle: {
                            color: $("#color2").css("color"),
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: "#777",
                            width: 1,
                            type: 'solid'
                        }
                    }
                },
                dataZoom: [{
                    height: 30,
                    startValue: $("#chart-start").text(),
                    bottom: 20,
                    textStyle: {
                        color: $("#color2").css("color")
                    },
                }, {
                    type: 'inside',
                }],
                series: [{
                    data: $("#chart-y-data").text().split(','),
                    type: 'line',
                    color: $("#theme-color").css("color"),
                    name: '发布文章数',
                    legendHoverLink: true,
                    markLine: {
                        silent: true,
                        data: [{
                            type: 'average',
                            name: '平均值',
                            lineStyle: {
                                color: "orange",
                                width: 1
                            }
                        }],
                        label: {
                            position: "middle",
                        }
                    }
                }]
            },
            media: [{
                query: {
                    maxWidth: 700
                },
                option: {
                    title: {
                        textStyle: {
                            color: $("#color1").css("color"),
                            lineHeight: 15,
                            fontSize: 14
                        },
                        padding: [15, 0, 0, 0],
                    },
                    grid: {
                        top: 40,
                        bottom: 60,
                    },
                    tooltip: {
                        textStyle: {
                            fontSize: 12,
                        }
                    },
                    xAxis: {
                        axisLabel: {
                            textStyle: {
                                fontSize: 10
                            }
                        },
                    },
                    yAxis: {
                        axisLabel: {
                            textStyle: {
                                fontSize: 10
                            }
                        },
                    },
                    dataZoom: [{
                        height: 20,
                        startValue: $("#chart-start1").text(),
                        bottom: 10,
                        textStyle: {
                            fontSize: 10,
                        },
                        left: 20
                    }, ],
                    series: [{
                        markLine: {
                            silent: true,
                            data: [{
                                type: 'average',
                                lineStyle: {
                                    color: "orange",
                                    width: 0.5
                                },
                            }],
                        },
                        lineStyle: {
                            width: 1
                        }
                    }]
                }
            }, {
                query: {
                    maxWidth: 500
                },
                option: {
                    grid: {
                        top: 40,
                        bottom: 50,
                    },
                    tooltip: {
                        textStyle: {
                            fontSize: 10,
                        }
                    },
                    dataZoom: [{
                        height: 15,
                        startValue: $("#chart-start2").text(),
                        bottom: 10,
                        textStyle: {
                            fontSize: 10
                        }
                    }, ],
                }
            }, ]
        };
        chart.setOption(option);
        $("#remove").remove();
    }
});
// 响应式布局
$(document).ready(function() {
    if ($(window).width() < 992) {
        // $(".side-layout").remove();
        // $(".nav_menu").remove();
        // $(".toc-widget").remove();
    }
    if ($(window).width() > 992) {
        // $(".m-nav-btn").remove();
        // $(".m-toc-widget").remove();
    }
    if ($(window).width() < 500) {
        // $(".fr1").remove();
    }
    if ($(window).width() < 500) {
        // $(".fr2").remove();
    }
    // 移动端侧栏
    var m_cover = document.getElementById("m-overlay");
    $("#mside-btn").on("click", function(e) {
        e.stopPropagation();
        $("#msidebar").css("transform", "translateX(2px)")
        setTimeout(function() {
            $("#m-overlay").css("opacity", 1);
            $("#m-overlay").css("display", 'block');
            $("body").css("overflow", 'hidden');
        }, 20)
    });
    $(document).click(function(e) {
        if ($("#m-overlay").is(e.target)) {
            $("#m-overlay").css("opacity", 0);
            $("#m-overlay").css("display", 'none');
            $("body").css("overflow", 'auto');
            $("#msidebar").css("transform", "translateX(-110%)")
        }
    });
    // 设置遮罩层禁止滑动
    $("#m-overlay").bind("touchmove", function(e) {
        e.preventDefault();
    });
    $("#msidebar .md-trigger").click(function() {
        $("#m-overlay").css("opacity", 0);
        $("#m-overlay").css("display", 'none');
        $("body").css("overflow", 'auto');
        $("#msidebar").css("transform", "translateX(-110%)")
    });
    $(".mdrop").click(function() {
        var ctrl_mid = $(this).attr("c-mid");
        var num = $("#" + ctrl_mid).attr("data-num");
        if ($("#" + ctrl_mid).css('height') == "0px") {
            $("." + ctrl_mid + " .iright").attr("class", "fa fa-angle-down iright");
            $("#" + ctrl_mid).css('max-height', num * 2 + 1 + "rem");
        } else {
            $("." + ctrl_mid + " .iright").attr("class", "fa fa-angle-right iright");
            $("#" + ctrl_mid).css('max-height', "0px");
        }
    })
    // 移动端目录
    $("#m-toc-btn").on("click", function(e) {
        e.stopPropagation();
        $(".m-toc-widget").css("transform", "translateX(0)")
        setTimeout(function() {
            $("#m-overlay").css("opacity", 1);
            $("#m-overlay").css("display", 'block');
            $("body").css("overflow", 'hidden');
        }, 20)
    });
    $(document).click(function(e) {
        if ($("#m-overlay").is(e.target)) {
            $("#m-overlay").css("opacity", 0);
            $("#m-overlay").css("display", 'none');
            $("body").css("overflow", 'auto');
            $(".m-toc-widget").css("transform", "translateX(110%)")
        }
    });
})

