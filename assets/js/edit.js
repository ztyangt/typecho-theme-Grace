$(document).ready(function() {
    $("head").append('<link rel="stylesheet" href="/usr/themes/Grace/assets/OwO/OwO.min.css">')
    $("head").append('<link rel="stylesheet" href="/usr/themes/Grace/assets/css/edit.css">')
    $("#wmd-editarea").append('<ul class="add-btn"><li class="wmd-button OwO-logo" id="wmd-owo-button" title="添加表情" style="left: 100px;"><span style="background:none;height:20px;width:20px;display:block;"><svg style="width:100%;height:100%;" t="1603454046545" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1194" width="200" height="200"><path d="M523.9 511.98m-419.5 0a419.5 419.5 0 1 0 839 0 419.5 419.5 0 1 0-839 0Z" fill="#FFD629" p-id="1195"></path><path d="M885.2 298.58c-1.6-0.6 37.1 68.4 49.5 128.9 46.4 227-99.9 448.6-326.9 495.1-37.9 7.8-75.7 10.1-112.5 7.7-63.2-4.2-123.6-22.8-177.3-53 0 0 348.9-269.7 567.2-578.7z" fill="#FF9A2C" opacity=".1" p-id="1196"></path><path d="M922.4 383.38c73.9 216.8-52.8 456-264 525.8-36.7 12.1-108.5 28.3-184.9 19.4 0-0.5 166.62-15.7 313.54-190.74C942.88 552.16 920.2 376.98 922.4 383.38z" fill="#FF9A2C" opacity=".2" p-id="1197"></path><path d="M790 184.48c-40.9-34.6-93.6-59.3-155.8-77.3-95.5-27.6-199.4-17.7-300.6 31.5-139.3 67.7-240.1 245.9-227.6 400.2 4.2 52 10.1 101.8 30 145.5 0.5 1 1.6 1.5 2.7 1.2 21.1-6.8 218.8-73.6 375.8-190.3 213.3-158.5 292.3-296.6 275.5-310.8z" fill="#FCE99A" opacity=".24" p-id="1198"></path><path d="M188.008782 408.574552a136 234.3 54.429 1 0 381.157036-272.589938 136 234.3 54.429 1 0-381.157036 272.589938Z" fill="#F9F2D7" opacity=".2" p-id="1199"></path><path d="M616.9 326.38m-52.7 0a52.7 52.7 0 1 0 105.4 0 52.7 52.7 0 1 0-105.4 0Z" fill="#211715" p-id="1200"></path><path d="M381.7 438.38l-77.6 125.3-15.5-8c-16-8.2-22.3-27.9-14.1-43.9l26.2-47.3-45.6-19.6c-15.7-8.1-21.9-27.4-13.8-43.1l8.2-16 132.2 52.6z" fill="#211715" p-id="1201"></path><path d="M603 479.68c27.4 56.5 14.1 119.5-29.7 140.8s-101.6-7.2-129-63.7l30.6-8c37.4-9.7 72.1-26.6 102.9-50l25.2-19.1z" fill="#F94616" p-id="1202"></path><path d="M514.5 567.38l8.8 6c3.6 2.5 8.3 2.8 12.2 0.7l26.9-14c3.4-1.8 5.7-5.1 6.3-8.9l1.5-10.5c1.4-10-9.4-17.1-18-11.9-9.1 5.5-20.9 11.8-35.4 17.7-8.8 3.6-10.1 15.5-2.3 20.9z" fill="#E53600" opacity=".68" p-id="1203"></path><path d="M922.4 383.38c73.9 216.8-52.8 456-264 525.8-36.7 12.1-108.5 28.3-184.9 19.4 0-0.5 122.92-45.83 275.21-216.29C910.21 531.51 920.2 376.98 922.4 383.38z" fill="#FF9A2C" opacity=".19" p-id="1204"></path><path d="M922.4 383.38c73.9 216.8-52.8 456-264 525.8-36.7 12.1-108.5 28.3-184.9 19.4 0-0.5 89.92-84.69 242.21-255.15C877.21 492.65 920.2 376.98 922.4 383.38z" fill="#FF9A2C" opacity=".15" p-id="1205"></path></svg></span></li><li class="wmd-button" id="wmd-dload-button" title="添加外链下载卡片" ><span style="background:none;height:20px;width:20px;display:block;"><svg style="width:100%;height:100%;" t="1603531889281" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="11456" width="200" height="200"><path d="M928 639.015c-16.753 0-30 13.581-30 30.333v92.849C898 835.608 838.152 895 764.974 895H256.889C182.879 895 123 835.608 123 762.197v-92.849c0-16.753-13.748-30.333-30.5-30.333S62 652.595 62 669.348v92.849C62 869.061 149.427 956 256.889 956h508.085c51.85 0 100.304-20.148 136.759-56.733C938.132 862.738 958 814.059 958 762.197v-92.849c0-16.753-13.247-30.333-30-30.333z" fill="#E75934" p-id="11457"></path><path d="M486.91 720.111c5.923 5.923 13.686 8.884 21.449 8.884 7.763 0 15.526-2.961 21.449-8.884l155.505-155.505c11.846-11.846 11.846-31.053 0-42.899s-31.052-11.846-42.898 0L540 624.122V184.013c0-16.753-13.747-30.333-30.5-30.333S479 167.26 479 184.013v442.392L376.447 523.851c-11.846-11.843-31.052-11.843-42.898 0-11.846 11.846-11.846 31.053 0 42.899L486.91 720.111z" fill="#E75934" p-id="11458"></path></svg></span></li><li class="wmd-button" id="wmd-video-button" title="插入视频" ><span style="background:none;height:20px;width:20px;display:block;"><svg style="width:100%;height:100%;" t="1606915610399" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1185" width="200" height="200"><path d="M405.054439 320.636878l300.406634 173.930146a15.235122 15.235122 0 0 1 0 26.349269L405.054439 694.821463a15.160195 15.160195 0 0 1-22.777756-13.187122V333.873951a15.235122 15.235122 0 0 1 22.777756-13.237073z" fill="#6694FF" p-id="1186"></path><path class="icon"  d="M512.449561 74.926829C272.134244 74.926829 77.249561 270.286049 77.249561 511.300683c0 240.989659 194.809756 436.323902 435.150049 436.323902 240.315317 0 435.175024-195.334244 435.175024-436.323902C947.574634 270.286049 752.789854 74.926829 512.449561 74.926829z m228.451902 506.954927l-300.406634 173.955122a81.170732 81.170732 0 0 1-81.345561 0 81.595317 81.595317 0 0 1-40.660292-70.606049V337.395512a81.845073 81.845073 0 0 1 40.685268-70.656 80.246634 80.246634 0 0 1 81.320585 0l300.406634 173.905171a81.595317 81.595317 0 0 1 40.660293 70.631024c0 29.146537-15.484878 56.070244-40.660293 70.631025z" fill="#9CBDFF" p-id="1187"></path></svg></span></li></ul>');
    $(".editor").append('<div class="dialog-OwO OwO edit-owo"></div>')
    $("#wmd-editarea>textarea").addClass("OwO-textarea edit-textarea");
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

    $("body").append('<div class="my-wmd-prompt-background hidden" style="position: absolute; top: 0px; z-index: 1000; opacity: 0.5; height: 1443px; left: 0px; width: 100%;"></div>\
    <div class="my-wmd-prompt-dialog wmd-prompt-dialog hidden" role="dialog"><div><p><b class="dload hidden">插入外链文件下载卡片</b><b class="video hidden">插入视频</b></p><p>请在下方的输入框内输入相关信息</p></div>\
    <form id="dload" name="dload">\
    <div class="dload hidden">\
    <label>文件名字：</label><input id="filename" class="dload-text" type="text" >\
    <label>文件链接：</label><input id="filelink" class="dload-text" type="text" >\
    <label>文件描述：</label><input id="introduce" class="dload-text" type="text" >\
    </div>\
    <div class="video hidden">\
    <label>视频链接：</label><input id="videourl" class="video-text" type="text" >\
    <label>视频封面：</label><input id="videocover" class="video-text" type="text" >\
    </div>\
    <div style="display:flex;"><div class="footer-btn"><button type="button" class="btn btn-ok primary">确定</button><button type="button" class="btn btn-quxiao">取消</button></div></div></form></div>\
    ')
    // $("#wmd-owo-button").click(function(){
    //     if($(".dialog-OwO").hasClass("hidden")){
    //         $(".dialog-OwO").removeClass("hidden")
    //     }else{
    //         $(".dialog-OwO").addClass("hidden")
    //     }
    // })
    $("#wmd-dload-button").click(function() {
        $('.my-wmd-prompt-background,.my-wmd-prompt-dialog,.dload').removeClass("hidden");
        $(".btn-ok").removeClass('video-ok');
        $(".btn-ok").addClass('dload-ok');
    });
    $("#wmd-video-button").click(function() {
        $('.my-wmd-prompt-background,.my-wmd-prompt-dialog,.video').removeClass("hidden");
        $(".btn-ok").removeClass('dload-ok');
        $(".btn-ok").addClass('video-ok');
    });
    $(".btn-quxiao").click(function() {
        $('.my-wmd-prompt-background,.my-wmd-prompt-dialog,.dload,.video').addClass("hidden");
        $('.dload-text,.video-text').val("");
    });
    $(".btn-ok").click(function() {
        $('.my-wmd-prompt-background,.my-wmd-prompt-dialog,.video,.dload').addClass("hidden");
        var filename = document.getElementById("filename").value;
        var filelink = document.getElementById("filelink").value;
        var introduce = document.getElementById("introduce").value;
        var videourl = document.getElementById("videourl").value;
        var videocover = document.getElementById("videocover").value;
        var target = document.getElementsByClassName("edit-textarea")[0];
        const cursorPos = target.selectionEnd;
        let areaValue = target.value;
        if($(".btn-ok").hasClass("dload-ok")){
            if (filename.length > 0 && filelink.length > 0 && introduce.length > 0) {
                target.value = areaValue.slice(0, cursorPos) + '[dload name="' + filename + '" link="' + filelink + '" introduce="' + introduce + '" /]' + areaValue.slice(cursorPos);
            } else {
                alert("请将信息填写完整！");
            }           
        }else{
            if (videourl.length > 0) {
                target.value = areaValue.slice(0, cursorPos) + '[video url="' + videourl + '" cover="' + videocover + '" /]' + areaValue.slice(cursorPos);
            } else {
                alert("请将信息填写完整！");
            }           
        }
        $('.dload-text,.video-text').val("");
    });




});