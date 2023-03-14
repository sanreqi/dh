<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */
/* @var $permissions */
/* @var $role */
/* @var $ownPermissions*/

$this->title = $role->name;
?>

<form id="permission-form" class="rem-1">
    <?php foreach ($permissions as $k1 => $v1): ?>
<!--        <span style="font-size: 20px;!important;"><b>--><?php //echo '----权限'; ?><!--</b></span>-->
<!--        <hr class="dh-hr">-->
        <?php //foreach ($v1 as $k2 => $v2): ?>
            <div class="controller-div">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="controller-chx form-check-input" value="">
                        <span><b><?php echo $v1['title'] ?></b></span>
                    </label>
                </div>
                <?php foreach ($v1['data'] as $k2 => $v2): ?>
                    <?php $pName = '' . $v2['name'] ?>
                    <?php $checked = in_array($pName, $ownPermissions) ? 'checked' : ''; ?>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input name="permissions[]" type="checkbox" <?= $checked; ?>  value="<?php echo $v2['name']; ?>"
                                   class="controller-chx-item form-check-input"><?php echo $v2['description'] . '(' . $v2['name'] . ')'; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="dh-hr">
        <?php //endforeach; ?>
    <?php endforeach; ?>
    <input type="hidden" name="role" value="<?= $role->name; ?>">

    <a class="btn btn-secondary">返回</a>
    <button type="button" class="btn btn-primary" id="save-permission-btn">保存</button>
</form>

<script>
    $(document).ready(function() {
        let items;

        $(".controller-chx").each(function() {
            let flag = true;
            let this_controller = $(this);
            items = $(this).parents(".controller-div").find(".controller-chx-item");
            items.each(function () {
                if (!$(this).is(":checked")) {
                    flag = false;
                    //跳出循环
                    return false;
                }
            });

            if (flag) {
                //全部选中
                this_controller.prop("checked", true);
            } else {
                this_controller.prop("checked", false);
            }
        });


        $(".controller-chx").change(function() {
            let items = $(this).parents(".controller-div").find(".controller-chx-item");
            let is_checked = $(this).is(":checked");
            items.each(function () {
                if (is_checked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
        });

        $(".controller-chx-item").change(function() {
            let items = $(this).parents(".controller-div").find(".controller-chx-item");
            let controller_chx = $(this).parents(".controller-div").find(".controller-chx");
            let flag = true;
            items.each(function () {
                if (!$(this).is(":checked")) {
                    flag = false;
                    //跳出循环
                    return false;
                }
            });
            if (flag) {
                //全部选中
                controller_chx.prop("checked", true);
            } else {
                controller_chx.prop("checked", false);
            }
        });

        $("body").on("click", "#save-permission-btn", function () {
            let $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/permission/save",
                data: $("#permission-form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        window.location.href = "/role/index";
                    } else {
                        dhAlert(data.errorMsg)
                    }
                },
                complete: function (data) {
                    $this.prop("disabled", false).removeClass("disabled");
                }
            });

            return false;
        });
    });
</script>