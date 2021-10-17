<?php \common\assets\UEditorAsset::register($this); ?>
<?php $this->title = 'PAGE-CONTENT'; ?>

<button type="button" id="add-text-btn" class="btn btn-primary">Primary</button>
<button type="button" id="add-img-btn" class="btn btn-success">Success</button>
<button type="button" id="add-editor-btn" class="btn btn-warning">Warning</button>

<form id="content-form" class="mt-30" method="post">
    <div class="form-group row" enctype="multipart/form-data">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Email address</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-remove">
        </div>
    </div>
    <div class="form-group row">
        <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Example textarea</label>
        <div class="col-sm-6">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-remove">
        </div>
    </div>
<!--    <div class="form-group row">-->
<!--        <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Example file input</label>-->
<!--        <div class="col-sm-6">-->
<!--            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="abcd">-->
<!--        </div>-->
<!--        <div class="col-sm-1">-->
<!--            <span class="glyphicon glyphicon-remove">-->
<!--        </div>-->
<!--    </div>-->
</form>

<!--<script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>-->
<script>
    // var ue = UE.getEditor('editor');
</script>

<?php
use yii\widgets\ActiveForm;
?>



<p><input type="file" id="imageFile" name="UploadForm[file]" /></p>
<input type="button" value="上传" id="abcd" />
<p><img id="img1" alt="上传成功啦" src="" /></p>

<script>
    $(function () {
        $("#abcd").click(function () {
            ajaxFileUpload();

        })
    });
    function ajaxFileUpload() {
        $.ajaxFileUpload({
            url: "/page-content/upload", //用于文件上传的服务器端请求地址
            type: "POST",
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: "imageFile", //文件上传域的ID
            dataType: "json", //返回值类型 一般设置为json
            success: function(data) {

            }
        });
        return false;
    }
</script>




