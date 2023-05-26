<?php
?>

<form id="acq-form">


<!--    <div class="col-sm-9">-->
<!--        <input value="--><?php //echo $model->date; ?><!--" id="date" type="text" class="form-control" name="date">-->
<!--    </div>-->

    <div class="form-group row">
        <label for="xx" class="col-sm-3 col-form-label">下拉框</label>
        <select name="ddd" value="-10" class="form-group row col-sm-9">
            <option value="">-1</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
</form>
<div class="modal-footer">
    <a href="/acq/form" class="btn btn-secondary">取消</a>
    <a href="javascript:void(0)" class="btn btn-primary" id="save-btn">保存</a>
</div>



<script>
    $(document).ready(function () {




        $("#save-btn").click(function () {
            var form = "#acq-form";
            var $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/acq/form",
                data: $(form).serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        // window.location.href = '/asd-diary/index';
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
