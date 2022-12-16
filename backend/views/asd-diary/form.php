<?php
\common\assets\DateTimePickerAsset::register($this);
\common\assets\UEditorAsset::register($this);
/* @var $model */
/* @var $title */
$this->title = $title;
?>

<form id="asd-diary-form">
    <div class="form-group row">
        <label for="date" class="col-sm-3 col-form-label">日期</label>
        <div class="col-sm-9">
            <input value="<?php echo $model->date; ?>" id="date" type="text" class="form-control" name="date">
        </div>
    </div>
    <div class="form-group row">
        <label for="title" class="col-sm-3 col-form-label">标题</label>
        <div class="col-sm-9">
            <input name="title" type="text" class="form-control" id="title" value="<?php echo $model->title; ?>">
        </div>
    </div>
<!--    <div class="form-group row">-->
<!--        <label for="content" class="col-sm-3 col-form-label">内容</label>-->
<!--        <div class="col-sm-9">-->
<!--            <textarea name="content" rows="4" class="form-control" id="content">--><?php // ?><!--</textarea>-->
<!--        </div>-->
<!--    </div>-->
    <div class="form-group row">
        <label for="content" class="col-sm-3 col-form-label">内容</label>
        <div class="col-sm-9">
            <div id="content" name="content"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="level" class="col-sm-3 col-form-label">优先级</label>
        <div class="col-sm-9">
            <input name="level" type="text" class="form-control" id="level" value="<?php echo $model->level; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="bright" class="col-sm-3 col-form-label">亮点</label>
        <div class="col-sm-9">
            <input name="bright" type="text" class="form-control" id="bright" value="<?php echo $model->bright; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="problem" class="col-sm-3 col-form-label">问题</label>
        <div class="col-sm-9">
            <input name="problem" type="text" class="form-control" id="problem" value="<?php echo $model->problem; ?>">
        </div>
    </div>

    <input type="hidden" id="id" name="id" value="<?php echo $model->id; ?>">
</form>
<div class="modal-footer">
    <a href="/asd-diary/index" class="btn btn-secondary">取消</a>
    <a href="javascript:void(0)" class="btn btn-primary" id="save-asd-diary-btn">保存</a>
</div>

<input type="hidden" value='<?php echo $model->content ?>' id="ct">

<script>
    $(document).ready(function () {
        $('#date').datetimepicker({
            lang: 'ch',
            timepicker: false,
            format: 'Y-m-d',
        });

        var ue = UE.getEditor('content', {
            onready: function () {
                this.setContent($("#ct").val());
            }
        });

        $("#save-asd-diary-btn").click(function () {
            var form = "#asd-diary-form";
            var $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/asd-diary/create-update",
                data: $(form).serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        window.location.href = '/asd-diary/index';
                    } else {
                        dhAlert(data.errorMsg)
                    }
                },
                complete: function (data) {
                    $this.prop("disabled", false).removeClass("disabled");
                }
            });
        });
    });
</script>
