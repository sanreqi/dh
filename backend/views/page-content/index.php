<?php \common\assets\UEditorAsset::register($this); ?>
<?php $this->title = 'PAGE-CONTENT'; ?>


<button type="button" id="add-text-btn" class="btn btn-primary">Primary</button>
<button type="button" id="add-textarea-btn" class="btn btn-secondary">Secondary</button>
<button type="button" id="add-img-btn" class="btn btn-success">Success</button>
<button type="button" id="add-editor-btn" class="btn btn-warning">Warning</button>
<button type="button" id="save-content-btn" class="btn btn-warning">Warning</button>
<div id="image-file-div"><input type="file" id="image-file" name="UploadForm[file]" class="dh-hide" /></div>
<input type="hidden" id="ueditor-num" value="1">


<form id="content-form" class="mt-30" enctype="multipart/form-data" method="post">
</form>

<div id="content-text" class="dh-hide">
    <div class="form-group row">
        <div class="col-sm-6">
            <input type="text" class="form-control" name="content[]">
            <input type="hidden" class="form-control dh-hide" name="inputType[]" value="1">
        </div>
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-remove content-remove dh-cp">
        </div>
    </div>
</div>

<div id="content-textarea" class="dh-hide">
    <div class="form-group row">
        <div class="col-sm-6">
            <textarea class="form-control" rows="4" name="content[]"></textarea>
            <input type="hidden" class="form-control dh-hide" name="inputType[]" value="2">
        </div>
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-remove content-remove dh-cp">
        </div>
    </div>
</div>

<div id="content-img" class="dh-hide">
    <div class="form-group row">
        <div class="col-sm-6">
            <img src="" class="col-sm-6">
            <input type="hidden" class="form-control dh-hide img-input" name="content[]">
            <input type="hidden" class="form-control dh-hide" name="inputType[]" value="3">
        </div>
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-remove content-remove dh-cp">
        </div>
    </div>
</div>

<div id="content-editor" class="dh-hide">
    <div class="form-group row">
        <div class="col-sm-6">
            <div class="udc"></div>
        </div>
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-remove content-remove dh-cp">
        </div>
        <input type="hidden" class="ueditor-input" name="content[]">
        <input type="hidden" class="form-control dh-hide" name="inputType[]" value="4">
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#add-text-btn").click(function () {
            var html = $("#content-text").html();
            $("#content-form").append(html);
        });
        $("#add-textarea-btn").click(function () {
            var html = $("#content-textarea").html();
            $("#content-form").append(html);
        });
        $("#add-img-btn").click(function () {
            $("#image-file").click();
        });
        $("#image-file").change(function() {
            ajaxFileUpload();
            $("#image-file").prop("value", null);
        });
        $("body").on("click", ".content-remove", function() {
            $(this).parents(".form-group").remove();
        });
        $("#add-editor-btn").click(function () {
            var num = $("#ueditor-num").val();
            var id = "ueditor-" + num;
            $("#content-editor .udc").prop("id", id);
            num ++;
            $("#ueditor-num").val(num);
            var ue = UE.getEditor(id);
            var html = $("#content-editor").html();
            $("#content-form").append(html);
            $("#content-editor .udc").removeAttr("id").empty();
        });
    })
    function ajaxFileUpload() {
        $.ajaxFileUpload({
            url: "/page-content/upload", //用于文件上传的服务器端请求地址
            type: "POST",
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: "image-file", //文件上传域的ID
            dataType: "json", //返回值类型 一般设置为json
            success: function(data) {
                if (data.status == 1) {
                    $("#content-img").find("img").prop("src", data.src);
                    $("#content-img").find(".img-input").prop("value", data.src);
                    var html = $("#content-img").html();
                    $("#content-form").append(html);
                } else {
                    dhAlert(data.errorMsg)
                }
            }
        });
    }
    $("#save-content-btn").click(function () {
        setUeditorVal();
        $.ajax({
            type: "post",
            url: "/page-content/save-content",
            data: $("#content-form").serializeArray(),
            dataType: "json",
            success: function (data) {
                // if (data.status == 1) {
                //     window.location.reload();
                // } else {
                //     dhAlert(data.errorMsg)
                // }
            },
            complete: function (data) {
                $this.prop("disabled", false).removeClass("disabled");
            }
        });
    });
    function setUeditorVal() {
        $("#content-form .udc").each(function() {
            var ue = UE.getEditor($(this).attr("id"));
            var content = ue.getContent();
            $(this).parents(".form-group").find(".ueditor-input").prop("value", content);
        });
    }
</script>




