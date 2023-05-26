<?php
$this->title = "结算";
?>

<?php
//上月1号
$recordDate = date("Y-m", strtotime("-1 month"));
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="b-income-modal-label">结算</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="b-record-form">
                <div class="form-group row">
                    <label for="record-date" class="col-sm-3 col-form-label">结算时间</label>
                    <div class="col-sm-9">
                        <input name="record-date" type="text" class="form-control" id="record-date"
                               value="<?php echo $recordDate; ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-record-btn">保存</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#record-date").datetimepicker({
            lang: "ch",
            timepicker: false,
            format: "Y-m",
        });
    });
</script>
