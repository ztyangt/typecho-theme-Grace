function download(data, strFileName, strMimeType) {
    var self = window, // this script is only for browsers anyway...
        u = "application/octet-stream", // this default mime also triggers iframe downloads
        m = strMimeType || u,
        x = data,
        D = document,
        a = D.createElement("a"),
        z = function(a) {
            return String(a);
        },
        B = self.Blob || self.MozBlob || self.WebKitBlob || z,
        BB = self.MSBlobBuilder || self.WebKitBlobBuilder || self.BlobBuilder,
        fn = strFileName || "download",
        blob,
        b,
        ua,
        fr;
    //if(typeof B.bind === 'function' ){ B=B.bind(self); }
    if (String(this) === "true") { //reverse arguments, allowing download.bind(true, "text/xml", "export.xml") to act as a callback
        x = [x, m];
        m = x[0];
        x = x[1];
    }
    //go ahead and download dataURLs right away
    if (String(x).match(/^data\:[\w+\-]+\/[\w+\-]+[,;]/)) {
        return navigator.msSaveBlob ? // IE10 can't do a[download], only Blobs:
            navigator.msSaveBlob(d2b(x), fn) : saver(x); // everyone else can save dataURLs un-processed
    } //end if dataURL passed?
    try {
        blob = x instanceof B ? x : new B([x], {
            type: m
        });
    } catch (y) {
        if (BB) {
            b = new BB();
            b.append([x]);
            blob = b.getBlob(m); // the blob
        }
    }

    function d2b(u) {
        var p = u.split(/[:;,]/),
            t = p[1],
            dec = p[2] == "base64" ? atob : decodeURIComponent,
            bin = dec(p.pop()),
            mx = bin.length,
            i = 0,
            uia = new Uint8Array(mx);
        for (i; i < mx; ++i) uia[i] = bin.charCodeAt(i);
        return new B([uia], {
            type: t
        });
    }

    function saver(url, winMode) {
        if ('download' in a) { //html5 A[download]          
            a.href = url;
            a.setAttribute("download", fn);
            a.innerHTML = "downloading...";
            D.body.appendChild(a);
            setTimeout(function() {
                a.click();
                D.body.removeChild(a);
                if (winMode === true) {
                    setTimeout(function() {
                        self.URL.revokeObjectURL(a.href);
                    }, 250);
                }
            }, 66);
            return true;
        }
        //do iframe dataURL download (old ch+FF):
        var f = D.createElement("iframe");
        D.body.appendChild(f);
        if (!winMode) { // force a mime that will download:
            url = "data:" + url.replace(/^data:([\w\/\-\+]+)/, u);
        }
        f.src = url;
        setTimeout(function() {
            D.body.removeChild(f);
        }, 333);
    } //end saver 
    if (navigator.msSaveBlob) { // IE10+ : (has Blob, but not a[download] or URL)
        return navigator.msSaveBlob(blob, fn);
    }
    if (self.URL) { // simple fast and modern way using Blob and URL:
        saver(self.URL.createObjectURL(blob), true);
    } else {
        // handle non-Blob()+non-URL browsers:
        if (typeof blob === "string" || blob.constructor === z) {
            try {
                return saver("data:" + m + ";base64," + self.btoa(blob));
            } catch (y) {
                return saver("data:" + m + "," + encodeURIComponent(blob));
            }
        }
        // Blob but not URL:
        fr = new FileReader();
        fr.onload = function(e) {
            saver(this.result);
        };
        fr.readAsDataURL(blob);
    }
    return true;
}

function downloadfile(url, strFileName, strMimeType) {
    var xmlHttp = null;
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
    if (xmlHttp != null) {
        xmlHttp.open("get", url, true);
        xmlHttp.responseType = 'blob';
        xmlHttp.send();
        xmlHttp.onreadystatechange = doResult;
    }

    function doResult() {
        if (xmlHttp.readyState == 4) { //4表示执行完成
            if (xmlHttp.status == 200) { //200表示执行成功
                download(xmlHttp.response, strFileName, strMimeType);
            }
        }
    }
}
// 粒子特效背景
particlesJS("particles-js", {
    particles: {
        number: {
            value: 120,
            density: {
                enable: true,
                value_area: 800
            }
        },
        color: {
            value: "#ffffff"
        },
        shape: {
            type: "circle",
            stroke: {
                width: 0,
                color: "#000000"
            },
            polygon: {
                nb_sides: 5
            },
            image: {
                src: "img/github.svg",
                width: 100,
                height: 100
            }
        },
        opacity: {
            value: 1,
            random: false,
            anim: {
                enable: false,
                speed: 1,
                opacity_min: .1,
                sync: false
            }
        },
        size: {
            value: 1,
            random: true,
            anim: {
                enable: false,
                speed: 20,
                size_min: .1,
                sync: false
            }
        },
        line_linked: {
            enable: true,
            distance: 40,
            color: "#fff",
            opacity: 1,
            width: 1
        },
        move: {
            enable: true,
            speed: 3,
            direction: "none",
            random: false,
            straight: false,
            out_mode: "out",
            attract: {
                enable: false,
                rotateX: 600,
                rotateY: 1200
            }
        }
    },
    interactivity: {
        detect_on: "canvas",
        events: {
            onhover: {
                enable: true,
                mode: "grab"
            },
            onclick: {
                enable: true,
                mode: "push"
            },
            resize: true
        },
        modes: {
            grab: {
                distance: 120,
                line_linked: {
                    opacity: 1
                }
            },
            bubble: {
                distance: 400,
                size: 40,
                duration: 2,
                opacity: 8,
                speed: 3
            },
            repulse: {
                distance: 300
            },
            push: {
                particles_nb: 4
            },
            remove: {
                particles_nb: 2
            }
        }
    },
    retina_detect: true,
    config_demo: {
        hide_card: false,
        background_color: "#b61924",
        background_image: "",
        background_position: "50% 50%",
        background_repeat: "no-repeat",
        background_size: "cover"
    }
});
// 点赞+1特效
// 文章点赞
(function($) {
    $.extend({
        tipsBox: function(options) {
            options = $.extend({
                obj: null,
                str: "+1",
                startSize: "12px",
                endSize: "30px",
                interval: 600,
                color: "#f30f0f",
                weight: "bold",
                callback: function() {} //回调函数
            }, options);
            $("body").append("<span class='num'>" + options.str + "</span>");
            var box = $(".num");
            var left = options.obj.offset().left + options.obj.width() / 2;
            var top = options.obj.offset().top - options.obj.height();
            box.css({
                "position": "absolute",
                "left": left + "px",
                "top": top + "px",
                "z-index": 9999,
                "font-size": options.startSize,
                "line-height": options.endSize,
                "color": options.color,
                "font-weight": options.weight
            });
            box.animate({
                "font-size": options.endSize,
                "opacity": "0",
                "top": top - parseInt(options.endSize) + "px"
            }, options.interval, function() {
                box.remove();
                options.callback();
            });
        }
    });
})(jQuery);
$(document).ready(function() {
    $("#post-btn").click(function() {
        $.ajax({
            type: 'post',
            url: $('this').attr('data-url'),
            data: {
                postCid: $(this).attr('data-cid'),
                indent: $("[name='indent']:checked").val(),
                slide: $("[name='slide']:checked").val(),
                topPost: $("[name='topPost']:checked").val(),
                postName: $('#post-name-value').val(),
                postCover: $('#post-cover-value').val(),
                postKeywords: $('#post-keywords-value').val(),
                postDesc: $('#post-desc-value').val()
            },
            async: true,
            timeout: 30000,
            cache: false,
            success: function(data) {
                $(".md-modal").removeClass('md-show');
                $("#top-post-title").html($('#post-name-value').val());
                if ($('#post-cover-value').val()) {
                    $(".diy-bg").css('background-image', 'url(' + $('#post-cover-value').val() + ')');
                } else {
                    $(".diy-bg").css('background-image', 'url(' + $('.default-cover').text() + ')');
                } 
                $("#poster-description").html($('#post-desc-value').val());           
            },
            error: function() {},
        });
    });
})
$('#ThumbUp-btn,#ThumbUp-btn1').on('click', function() {
    $('#ThumbUp-btn,#ThumbUp-btn1').get(0).disabled = true;
    if ($('#ThumbUp-btn,#ThumbUp-btn1').get(1)) {
        $('#ThumbUp-btn,#ThumbUp-btn1').get(1).disabled = true;
    }
    $('#ThumbUp-btn,#ThumbUp-btn1').removeClass("pbtn");
    $('#ThumbUp-btn,#ThumbUp-btn1').addClass("grey");
    $.ajax({
        type: 'post',
        url: $('#ThumbUp-btn').attr('data-url'),
        data: {
            'ThumbUp': $('#ThumbUp-btn').attr('data-cid'),
            'TUtitle': $("title").text(),
            'TUsum': $("#thumb-num").text(),
            'TUlink': $('#ThumbUp-btn').attr('data-url'),
        }, 
        async: true,
        timeout: 30000,
        cache: false,
        success: function(data) {
            $("#thumb-num").html(parseInt($("#thumb-num").text())+1);
        },
        error: function() {
            //  如果请求出错就恢复点赞按钮
            $('#ThumbUp-btn,#ThumbUp-btn1').get(0).disabled = false;
            $('#ThumbUp-btn,#ThumbUp-btn1').removeClass("grey");
        },
    });
});
$(function() {
    $("#ThumbUp-btn,#ThumbUp-btn1").click(function() {
        $.tipsBox({
            obj: $(this),
            str: "+ 1",
            callback: function() {}
        });
    });
});
$(document).ready(function() {
    if($(".feetype img")){
        $(".feetype a").children().unwrap();
        $(".feetype img").each(function(){
            $(this).removeClass("lazy");
            $(this).attr("src", $(this).attr("data-original"));            
        })
    }
    if ($("#ThumbUp-btn,#ThumbUp-btn1").prop("disabled")) {
        $('#ThumbUp-btn,#ThumbUp-btn1').addClass("grey");
        $('#ThumbUp-btn,#ThumbUp-btn1').removeClass("pbtn");
    };

    function getFileType(url){
        var Ttype="";
        let suffix = '';
        let result = '';
        const flieArr = url.split('.');
        suffix = flieArr[flieArr.length - 1];
        if(suffix!=""){
            suffix = suffix.toLocaleLowerCase();
            const imglist = $(".filetype").attr("data-list").split(",");
            result = imglist.find(item => item === suffix);
            if (result) {
                return true;
            }else {
                return false;
            }
        }
    }

    // 文件下载
    $('.dload-btn').click(function() {
        var url = $(this).attr("url");
        var filename = $(this).attr("filename");
        var filetype = $(this).attr("filetype");
        if(getFileType(url)){
            downloadfile(url, filename, filetype);
        }else{
            window.open(url,"_blank")
        }
    })
    // 视频播放
    if ($(".post-video")) {
        $(".post-video").each(function(i) {
            var url = $(this).attr("data-url");
            var cover = $(this).attr("data-cover");
            var color = $(this).css("color");
            var logo = $(this).attr("data-logo");
            $(this).attr("id", "post-video-" + i)
            const postdp = new DPlayer({
                container: document.getElementById('post-video-' + i),
                video: {
                    url: url,
                    pic: cover,
                },
                theme: color,
                lang: 'zh-cn',
                screenshot: true,
                logo: logo,
                contextmenu: [{
                    text: '南玖',
                    link: 'https://ztongyang.cn/',
                }],
            });
            $(this).removeAttr("data-url");
        });
    }
});
// 流程图
$(function() {
    if($('code.language-flow,code.lang-flow')){
    var flow_elements = $('code.language-flow,code.lang-flow');
    if ($(window).width() < 768) {
        var fontSize = 12;
        var lineWidth = 1;
    } else {
        var fontSize = 14;
        var lineWidth = 2;
    }
    for (var i = 0; i < flow_elements.length; i++) {
        var flow_element = flow_elements[i];
        var container = document.createElement("div");
        // console.log(flow_element);
        flow_element.parentNode.parentNode.insertBefore(container, flow_element.parentNode);
        var code = flow_element.innerText;
        chart = flowchart.parse(code);
        flow_element.parentNode.remove();
        chart.drawSVG(container, {
            'x': 0,
            'y': 0,
            'line-width': lineWidth,
            'line-length': 50,
            'text-margin': 10,
            'font-size': fontSize,
            'font-color': 'black',
            'line-color': 'black',
            'element-color': 'black',
            'fill': 'white',
            'yes-text': 'Yes',
            'no-text': 'No',
            'arrow-end': 'block',
            'scale': 1,
            'symbols': {
                'start': {
                    // 'font-color': 'red',
                    // 'element-color': 'green',
                    // 'fill': 'yellow'
                },
                'end': {
                    'class': 'end-element'
                }
            },
            // 'flowstate': {
            //     'past': { 'fill': '#CCCCCC', 'font-size': 12 },
            //     'current': { 'fill': 'yellow', 'font-color': 'red', 'font-weight': 'bold' },
            //     'future': { 'fill': '#FFFF99' },
            //     'request': { 'fill': 'blue' },
            //     'invalid': { 'fill': '#444444' },
            //     'approved': { 'fill': '#58C4A3', 'font-size': 12, 'yes-text': 'APPROVED', 'no-text': 'n/a' },
            //     'rejected': { 'fill': '#C45879', 'font-size': 12, 'yes-text': 'n/a', 'no-text': 'REJECTED' }
            // }
        });
    }}
});
// 绘制海报
$("#creatposter").click(function() {
    $('body').css({
        "overflow-x": "hidden",
        "overflow-y": "hidden"
    });
    loadPoster();
    createPoster();
    setTimeout(function() {
        // document.documentElement.scrollTop = 0;
        // document.body.scrollTop = 0;
        html2canvas(document.querySelector("#create-poster"), {
            allowTaint: false,
            useCORS: true,
            x: $("#create-poster").offset().left,
            y: $("#create-poster").offset().top,
            height: $("#create-poster").height(),
            width: $("#create-poster").width(),
            dpi: window.devicePixelRatio * 2.5,
            scale: 2.5,
            backgroundColor: "transparent",
        }).then(canvas => {
            dataURL = canvas.toDataURL("image/png");
            $(".md-content-poster").css("opacity",1);
            $('.loadgif-box').remove();
            $("#poster").addClass("poster-modal");
            $(".md-content-poster").css("width","100%");
            $(".md-content-poster").css("height","auto");
            $("#create-poster").css("display","none");
            $('.md-content-poster').append('<img class="wh-100" src="' + dataURL + '"/>');
            $('.md-content-poster').append('<div class="transform dload-poster"><a class="cursor href-poster"><svg t="1604146762105" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="47549" width="200" height="200"><path d="M512 0c409.6 0 512 102.4 512 512S921.6 1024 512 1024 0 921.6 0 512 102.4 0 512 0z" fill="#34CF8B" p-id="47550"></path><path d="M181.991131 547.108571a341.711726 341.711726 0 1 0 683.423452 0c0-188.726126-152.9856-341.711726-341.711726-341.711725S181.991131 358.382446 181.991131 547.108571z" fill="#28C681" p-id="47551"></path><path d="M170.288274 512a341.711726 341.711726 0 1 0 683.423452 0c0-188.726126-152.9856-341.711726-341.711726-341.711726S170.288274 323.273874 170.288274 512z" fill="#49F7AB" p-id="47552"></path><path d="M235.426377 512c0 152.745691 123.827931 276.573623 276.573623 276.573623s276.573623-123.827931 276.573623-276.573623S664.745691 235.426377 512 235.426377 235.426377 359.254309 235.426377 512z" fill="#FFFFFF" p-id="47553"></path><path d="M631.427657 527.997806a12928.152137 12928.152137 0 0 0-117.713188 120.574537c-38.853486-40.3456-78.058057-80.574171-117.713189-120.574537 27.542674 0.117029 55.085349 0.117029 82.7392 0.117028V378.856594H548.805486v149.25824c27.542674 0 55.085349 0 82.628023-0.117028z" fill="#34CF8B" p-id="47554"></path></svg></a><a class="poster-close cursor"><svg t="1605276386440" class="icon" viewBox="0 0 1026 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6063" width="200" height="200"><path d="M512 0c-282.298182 0-512 229.701818-512 512 0 282.298182 229.678545 512 512 512 282.321455 0 512-229.678545 512-512C1024 229.701818 794.321455 0 512 0zM682.426182 654.173091c8.704 8.727273 8.704 22.807273 0 31.511273-4.352 4.375273-10.030545 6.493091-15.755636 6.493091-5.678545 0-11.357091-2.141091-15.732364-6.493091l-140.567273-140.590545-140.590545 140.590545c-4.352 4.375273-10.053818 6.539636-15.755636 6.539636-5.678545 0-11.380364-2.187636-15.732364-6.539636-8.704-8.680727-8.704-22.784 0-31.464727l140.590545-140.590545-136.238545-136.238545c-8.680727-8.727273-8.680727-22.784 0-31.511273 8.680727-8.680727 22.784-8.680727 31.488 0l136.238545 136.238545 143.802182-143.825455c8.727273-8.680727 22.784-8.680727 31.511273 0 8.680727 8.704 8.680727 22.784 0 31.511273l-143.825455 143.825455L682.426182 654.173091z" p-id="6064"></path></svg></a></div>');
            $(".md-overlay,.poster-close").click(function(){
                if($("#poster").hasClass("poster-modal")){
                    $("#poster").removeClass("md-show");
                    $('body').css({"overflow-x": "auto","overflow-y": "auto"});             
                    $(".dload-poster").remove();
                    $(".md-content-poster img").remove();
                    $("#create-poster").css("display","block");
                    $(".md-content-poster").css("height","500px");
                    $(".md-content-poster").css("width","350px");
                    $("#poster").removeClass("poster-modal");
                    $(".md-content-poster").css("opacity",0);
                }
                })            
            var dload = document.querySelector(".href-poster");
            dload.href = dataURL;
            dload.download = $('#top-post-title').text() + ".png";
            // dload.click();                
        })
    }, 100)
});

function loadPoster() {
    $('#poster').append('<div class="loadgif-box "><div class="load-gif wh-100"><img class="gif-icon" src="/usr/themes/Grace/img/poster.gif" /><span class="info-text">海报生成中...</span></div></div>');
}

function createPoster() {
    var posterWd = $('#poster-Wd').text();
    var posterDt = $('#poster-Dt').text();
    $('.poster-box').empty();
    $('.poster-box').append('<div class="poster-img"><div class="poster-date"><span>' + posterWd + '</span><span>' + posterDt + '</span></div></div><div class="poster-info"><div class="poster-title"><span id="poster-title" class="h-1x"></span></div><div class="poster-label"></div><div class="poster-sum"><span></span></div></div>');
    var posterImg = $('#poster-cover').text();
    $('.poster-img').append('<img id="imgbase64" class="wh-100" src="' + posterImg + '">');
    var posterTitle = $('#top-post-title').text();
    var posterCate = $('.pcate a')[$('.pcate a').length - 1].text;
    var description = $('#poster-description').text();
    var posterAuthor = $('.pauthor').text();
    var posterDate = $('.update').attr('time');
    var AvaImage = $('#AvaImage').text();
    $('#poster-title').html(posterTitle);
    $('.poster-label').append('<span id="post-label" class="post-label"><span><i class="fa fa-folder-open-o" aria-hidden="true">&nbsp;</i>' + posterCate + '</span></span>');
    $(".head-post-tags").each(function() {
        $('.poster-label').append('<span class="tags-list">' + $(this).html() + '</span>');
    });
    $('.poster-sum span').html(description);
    $('.poster-info').append('<div class="poster-footer-box"><div style="height: 90px;"><div class="poster-author"><div class="poster-avatar-box ycenter"></div><div class="poster-author-info"><div class="ycenter"></div></div></div><div class="pfooter"><span class="xcenter">扫描二维码查看全文</span></div></div><div id="poster-qrcode" class="poster-qrcode ycenter"></div></div>')
    $('.poster-avatar-box').append('<img class="poster-avatar ycenter" src="' + AvaImage + '">')
    $('.poster-author-info div').append('<span>文章作者：' + posterAuthor + '</span><span>更新时间：' + posterDate + '</span>');
    makeCode();
};

function loadMask() {
    $('body').append('<div class="poster-load"><div class="loadgif-box "><div class="load-gif wh-100"><img class="gif-icon" src="/usr/themes/Grace/img/poster.gif" /><span class="info-text">海报生成中...</span></div></div></div>');
}

function makeCode() {
    var qr_code = $('#qrcode-url').text();
    $("#poster-qrcode").qrcode({
        // render: "table",
        text: qr_code,
        width:70,
        height: 70,
        foreground: $(".post-label").css("color"),
        background: "#ffffff",
        correctLevel: 3,
    })
}

$(document).ready(function() {
    // 文章目录切换
    $("#toc-btn").click(function() {
        var millisecond = new Date().getTime();
        var expiresTime = new Date(millisecond + 60 * 1000);
        $.cookie("toc-tag", true, {
            expires: expiresTime,
            path: '/'
        });
        var scroll = document.documentElement.scrollTop;
        if ($(".toc-widget").css("display") == "none") {
            $(".toc-widget").css("display", "block");
            $(".sidex").css("display", "none");
            document.documentElement.scrollTop = scroll - 1;
            document.documentElement.scrollTop = scroll + 1;
        } else {
            $(".toc-widget").css("display", 'none');
            $(".sidex").css("display", "block");
            document.documentElement.scrollTop = scroll - 1;
            document.documentElement.scrollTop = scroll + 1;
        }
    });
    if ($.cookie('toc-tag')) {
        $(".toc-widget").css("display", "block");
        $(".sidex").css("display", "none");
    }
    if ($(".toc-card").find("ul").length !== 0) {
        var bl = true;
        if ($(document).scrollTop() > $(".toc-ctrl").eq(0).offset().top) {
            $(".toc-ctrl").eq(0).addClass("toc-active").siblings().removeClass("toc-active");
        };
        $(window).scroll(function() {
            if (bl) {
                $(".topmao").each(function(i, ele) {
                    if ($(document).scrollTop() > $(ele).offset().top) {
                        $("#toc-widget .toc-ctrl").eq(i).addClass("toc-active").siblings().removeClass("toc-active");
                    }
                });
            }
        });
        $(".toc-ctrl").click(function() {
            bl = false;
            var currentTop = $(".topmao").eq($(this).index()).offset().top;
            $("html").stop().animate({
                scrollTop: currentTop
            }, function() {
                setTimeout(function() {
                    bl = true;
                }, 50)
            });
            $(this).addClass("toc-active").siblings().removeClass("toc-active");
        });
    }
});