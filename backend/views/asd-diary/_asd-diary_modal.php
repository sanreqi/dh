<?php
\common\assets\UEditorAsset::register($this);
/* @var $model */
$this->title = 'DIARY';
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="asd-diary-modal-label">Diary</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="asd-diary-form">
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">日期</label>
                    <div class="col-sm-9">
                        <input value="<?= '2022-11-02' ?>" id="date" type="text" class="form-control" name="date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-3 col-form-label">内容</label>
                    <div class="col-sm-9">
                        <textarea name="content" rows="4" class="form-control" id="content"><?php  ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-3 col-form-label">内容</label>
                    <div class="col-sm-9">
                        <div class="udc" content="11111" id="c1"></div>
                    </div>

<!--                    <input type="hidden" class="ueditor-input" name="content[]">-->
<!--                    <input type="hidden" class="form-control dh-hide" name="inputType[]" value="4">-->
                </div>
                <div class="form-group row">
                    <label for="level" class="col-sm-3 col-form-label">优先级</label>
                    <div class="col-sm-9">
                        <input name="level" type="text" class="form-control" id="level" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bright" class="col-sm-3 col-form-label">亮点</label>
                    <div class="col-sm-9">
                        <input name="bright" type="text" class="form-control" id="bright" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="problem" class="col-sm-3 col-form-label">问题</label>
                    <div class="col-sm-9">
                        <input name="problem" type="text" class="form-control" id="problem" value="">
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-asd-diary-btn">保存</button>
        </div>
    </div>
</div>

<div id="c2"></div>

<script>
    $('#date').datetimepicker({
        lang: 'ch',
        timepicker: false,
        format: 'Y-m-d',
    });

    UE.getEditor('c2');

    // var ue = UE.getEditor('c1', {onready: function() {
    //     this.setContent('66')
    // }});
</script>

