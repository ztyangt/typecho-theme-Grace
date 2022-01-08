$(".layout-box").click(function() {
    $(this).parent().parent().parent().parent().find(".layout-box").removeClass("layout-selected");
    $(this).addClass("layout-selected");
});
// 标签页刷新定位
$(".intitle").click(function() {
    var millisecond = new Date().getTime();
    var expiresTime = new Date(millisecond + 60 * 1000 * 5);
    var value = $(this).find("a").attr("data-target")
    $.cookie("back-tag", value, {
        expires: expiresTime,
        path: '/'
    });
})
$(document).ready(function() {
    $("#typecho-option-item-index_layout-9,#typecho-option-item-post_style-10,#typecho-option-item-sider_layout-19").find("input").each(function() {
        $(this).css("display","none");
        if ($(this).attr("checked") == "checked") {
            $(this).parent().find("img").addClass("layout-selected")
        }
    })
    // 标签页刷新不切换
    if ($.cookie('back-tag')) {
        $($.cookie('back-tag')).addClass("active");
        var tag = $("a[data-target$='" + $.cookie('back-tag') + "']");
        tag.parent().addClass("active");
    } else {
        var tag = $(".nav-pills").find("li").first();
        tag.addClass("active");
        var tagPageId = tag.find("a").first().attr("data-target");
        $(tagPageId).addClass("active");
    }
    $(".btn").click(function() {
        $("form").submit();
    });
    $('.myui-left,.myui-right').theiaStickySidebar({
        containerSelector: ".myui",
        additionalMarginTop: 20,
    });

    function scrollToDest(name, offset = 0) {
        const scrollOffset = $(name).offset()
        $('body,html').animate({
            scrollTop: scrollOffset.top - offset
        });
    };
    $('.intitle').on('click', function() {
        scrollToDest('body')
    })
    $(".menu").on("click", function(e) {
        e.stopPropagation();
        $(".myui-left").css("display", "block");
        setTimeout(function(){
            $(".myui-left").css("transform", "translate(0,-50%)");
        },1)
        
        $(".overlay").css("opacity", 1);
        $(".overlay").css("display", 'block');
        $("body").css("overflow", 'hidden');
    });
    $(document).click(function(e) {
        if ($(".overlay").is(e.target)) {
            $(".overlay").css("opacity", 0);
            $(".overlay").css("display", 'none');
            $("body").css("overflow", 'auto');
            $(".myui-left").css("transform", "translate(110%,-50%)");
            setTimeout(function(){
                $(".myui-left").attr("style","");
            },500)
        }
    });
    // 设置遮罩层禁止滑动
    $(".overlay").bind("touchmove", function(e) {
        e.preventDefault();
    });

    // 版本信息获取
    // let version = $('#version').attr("data");   　　　　 
    // $.ajax({
    //     type: 'get',
    //     url: "https://api.ucool.icu/grace/",
    //     data: {"key":"98kwoxihuansimqgt209df"},
    //     async: true,
    //     timeout: 30000,
    //     cache: true,
    //     success: function(data) {
    //         if(data.success == "true"){
    //             if (data.version !== version) {
    //                 let str = '<h2 class="update">检测到版本更新！</h2><p>当前版本号：' + version + '</p><p>最新版本号：' + data.version + '</p>' + data.info;
    //                 $("#pane0").html(str);
    //             } else {
    //                 let str = '<h2 class="no-update">当前已是最新版本！</h2><p>当前版本号：' + version + '</p><p>最新版本号：' + data.version + '</p>' + data.info;
    //                 $("#pane0").html(str);
    //             }    
    //         }else {
    //             $("#pane0").html("<h2>版本信息获取失败</h2>");
    //         }    
    //     },
    //     error: function(data) {$("#pane0").html("<h2>版本信息获取失败</h2>");},
    // });

});

