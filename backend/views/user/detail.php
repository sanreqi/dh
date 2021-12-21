<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */
/* @var $uid */

$this->title = 'USER';
?>


<div class="row">
    <div class="col-sm-7">
        <div id="basic-card"></div>
        <div id="project-card"></div>
        <div id="role-card"></div>
    </div>
    <div class="col-sm-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        renderHtml("/user/get-basic-view-html?uid="+"<?= $uid; ?>", "basic-card");
        renderHtml("/user/get-role-view-html?uid="+"<?= $uid; ?>", "role-card");

        //@todo srq 写通用方法 renderForm
        //$("body").on("click", "#edit-role-btn", function () {
        //    let $this = $(this);
        //    $this.prop("disabled", "disabled").addClass("disabled");
        //    let url = "/user/get-role-form?uid=" + "<?//= $uid; ?>//"
        //    renderHtml("/user/get-role-form-html?uid="+"<?//= $uid; ?>//", "role-card");
        //    $this.prop("disabled", false).removeClass("disabled");
        //
        //    return false;
        //});
        //
        //$("body").on("click", "#save-role-btn", function () {
        //    let $this = $(this);
        //    $this.prop("disabled", "disabled").addClass("disabled");
        //    $.ajax({
        //        type: "post",
        //        url: "/user/assign-role",
        //        data: $("#role-form").serializeArray(),
        //        dataType: "json",
        //        success: function (data) {
        //            if (data.status == 1) {
        //                renderHtml("/user/get-role-view-html?uid="+"<?//= $uid; ?>//", "role-card");
        //            } else {
        //                dhAlert(data.errorMsg)
        //            }
        //        },
        //        complete: function (data) {
        //            $this.prop("disabled", false).removeClass("disabled");
        //        }
        //    });
        //
        //    return false;
        //});
    });
</script>
