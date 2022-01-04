<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */
/* @var $uid */

$this->title = 'USER DETAIL';
\common\assets\DateTimePickerAsset::register($this);
$this->registerJsFile('@web/static/js/contact.js?v=1', ['depends' => '\backend\assets\AppAsset']);
?>


<div class="row">
    <div class="col-sm-7">
        <div id="basic-card"></div>
        <div id="project-card"></div>
        <div id="role-card"></div>
    </div>

    <div id="contact-card" class="col-sm-5">

    </div>
</div>

<script>
    $(document).ready(function() {
        renderHtml("/user/get-basic-view-html?uid="+"<?= $uid; ?>", "basic-card");
        renderHtml("/user/get-project-view-html?uid="+"<?= $uid; ?>", "project-card");
        renderHtml("/user/get-role-view-html?uid="+"<?= $uid; ?>", "role-card");
        renderHtml("/user/get-contact-view-html?uid="+"<?= $uid; ?>", "contact-card");

        //@todo srq 可以写成通用的renderForm
        $("body").on("click", "#edit-role-btn", function () {
            let $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            renderHtml("/user/get-role-form-html?uid="+"<?= $uid; ?>", "role-card");
            // $this.prop("disabled", false).removeClass("disabled");

            return false;
        });

        $("body").on("click", "#save-role-btn", function () {
            let $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/user/assign-role",
                data: $("#role-form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        renderHtml("/user/get-role-view-html?uid="+"<?= $uid; ?>", "role-card");
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

        $("body").on("click", "#edit-basic-btn", function () {
            let $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            renderHtml("/user/get-basic-form-html?uid="+"<?= $uid; ?>", "basic-card");
            // $this.prop("disabled", false).removeClass("disabled");

            return false;
        });

        $("body").on("click", "#save-basic-btn", function () {
            let $this = $(this);
            let url = "/user/save-basic?uid=" + <?= $uid; ?>;
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: url,
                data: $("#basic-form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        renderHtml("/user/get-basic-view-html?uid="+"<?= $uid; ?>", "basic-card");
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

        $("body").on("click", "#edit-project-btn", function () {
            let $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            renderHtml("/user/get-project-form-html?uid="+"<?= $uid; ?>", "project-card");
            // $this.prop("disabled", false).removeClass("disabled");

            return false;
        });

        $("body").on("click", "#save-project-btn", function () {
            let $this = $(this);
            let url = "/user/save-project?uid=" + <?= $uid; ?>;
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: url,
                data: $("#project-form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        renderHtml("/user/get-project-view-html?uid="+"<?= $uid; ?>", "project-card");
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
