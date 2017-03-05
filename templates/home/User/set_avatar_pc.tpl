<link rel="stylesheet" href="<{$__PLUGIN__}>/cropper/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<{$__PLUGIN__}>/cropper/dist/cropper.min.css">
<script src="<{$__PLUGIN__}>/cropper/assets/js/jquery.min.js"></script>
<script src="<{$__PLUGIN__}>/cropper/assets/js/bootstrap.min.js"></script>
<script src="<{$__PLUGIN__}>/cropper/dist/cropper.js"></script>
<script src="<{$__PLUGIN__}>/layer/layer.min.js"></script>
<style>
    .img-handler-btn{
        background: #78B658;
    }
    #file-avatar{
        filter:alpha(opacity=50);
        -moz-opacity:0.5;
        -khtml-opacity: 0.5;
        opacity: 0;
        position: absolute;
        top:318px;
        left: 14px;
        width: 97px;
        height:37px;
        margin:0;
    }
    #confirm-up{
        background: #00b3ee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div style="width: 400px;height:300px;" id="img-prevew">
                <img src="" style="width: 400px;height:300px;" id="avatar_img"/>
            </div>
            <br/>
            <form enctype="multipart/form-data" method="post" id="avatar-form">
                <input type="file" id="file-avatar" name="avatar">
                <button class="btn img-handler-btn btn-info" id="img-rotate"><span class="glyphicon glyphicon-open"></span>选择图片</button>
                <a class="btn img-handler-btn btn-info" id="confirm-up">确认上传</a>
                &nbsp;&nbsp;
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
                <input type="hidden" name="width" id="width">
                <input type="hidden" name="height" id="height">
            </form>

        </div>
        <div class="col-sm-3">
            <div class="preview">

            </div>
        </div>
    </div>

</div>
<script>
    var data = null
    $('#file-avatar').change(function(){
        $('#avatar_img').prop('src',PreviewImage(this));
        crop();
    });

    function crop(){
        var $previews = $('.preview');
        $('#avatar_img').cropper('destroy')
        $('#avatar_img').cropper({
            build: function (e) {
                var $clone = $(this).clone();
                $clone.css({
                    display: 'block',
                    width: '100%',
                    minWidth: 0,
                    minHeight: 0,
                    maxWidth: 'none',
                    maxHeight: 'none'
                });

                $previews.css({
                    width: '100%',
                    overflow: 'hidden'
                }).html($clone);
            },

            crop: function (e) {
                console.log(e);
                data = e;
                var imageData = $(this).cropper('getImageData');
                var previewAspectRatio = e.width / e.height;
                $previews.each(function () {
                    var $preview = $(this);
                    var previewWidth = $preview.width();
                    var previewHeight = previewWidth / previewAspectRatio;
                    var imageScaledRatio = e.width / previewWidth;

                    $preview.height(previewHeight).find('img').css({
                        width: imageData.naturalWidth / imageScaledRatio,
                        height: imageData.naturalHeight / imageScaledRatio,
                        marginLeft: -e.x / imageScaledRatio,
                        marginTop: -e.y / imageScaledRatio
                    });
                });
            },
            aspectRatio:1.0,
            strict:true,
            viewMode: 1,
            minCanvasHeight:300
        });
    }

    //保存头像
    $('#confirm-up').click(function () {
        if(data === null && $('#avatar_img').val()==''){
            alert('请选择一张图片');
        }
        $('#x').val(data.x);
        $('#y').val(data.y);
        $('#width').val(data.width);
        $('#height').val(data.height);
        $.ajax({
            url: './?m=user&c=set_avatar',
            type: 'POST',
            cache: false,
            data: new FormData($('#avatar-form')[0]),
            contentType: false,
            processData: false,
            success:function(e){
                var data = $.parseJSON(e);
                console.log(data)
                if(data.code ==0){
                    layer.msg(data.msg,{icon:1,time:1000},function () {
                        parent.layer.close(1);
                    });
                }
            }
        })

    });

    function PreviewImage(fileObj, imgPreviewId, divPreviewId) {
        var allowExtention = ".jpg,.bmp,.gif,.png"; //允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
        var extention = fileObj.value.substring(fileObj.value.lastIndexOf(".") + 1).toLowerCase();
        var browserVersion = window.navigator.userAgent.toUpperCase();
        var img_url ='';
        if (allowExtention.indexOf(extention) > -1) {
            if (fileObj.files) {     //HTML5实现预览，兼容chrome、火狐7+等
                img_url = URL.createObjectURL(fileObj.files[0]);
                return  img_url;
            } else if (browserVersion.indexOf("MSIE") > -1) {
                if (browserVersion.indexOf("MSIE 6") > -1) { //ie6
                    return fileObj.value;
                } else {   //ie[7-9]
                    fileObj.select();
                    if (browserVersion.indexOf("MSIE 9") > -1)
                        fileObj.blur(); //不加上document.selection.createRange().text在ie9会拒绝访问
                    /*var newPreview = document.getElementById(divPreviewId + "New");
                    if (newPreview == null) {
                        newPreview = document.createElement("div");
                        newPreview.setAttribute("id", divPreviewId + "New");
                        newPreview.style.width = document.getElementById(imgPreviewId).width + "px";
                        newPreview.style.height = document.getElementById(imgPreviewId).height + "px";
                        newPreview.style.border = "solid 1px #d2e2e2";
                    }*/
                    return document.selection.createRange().text;
                    newPreview.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
                    var tempDivPreview = document.getElementById(divPreviewId);
                    tempDivPreview.parentNode.insertBefore(newPreview, tempDivPreview);
                    tempDivPreview.style.display = "none";
                }
            } else if (browserVersion.indexOf("FIREFOX") > -1) { //firefox
                var firefoxVersion = parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                if (firefoxVersion < 7) { //firefox7以下版本
                    return fileObj.files[0].getAsDataURL();
                } else { //firefox7.0+                    
                    return window.URL.createObjectURL(fileObj.files[0]);
                }
            } else {
                return  fileObj.value;
            }
        } else {
            alert("仅支持" + allowExtention + "为后缀名的文件!");
            fileObj.value = ""; //清空选中文件
            if (browserVersion.indexOf("MSIE") > -1) {
                fileObj.select();
                document.selection.clear();
            }
            fileObj.outerHTML = fileObj.outerHTML;
        }
    }
</script>