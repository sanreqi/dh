<?php
/* @var $this \yii\web\View */

$this->title = 'USER';
?>

<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
<!--    Launch demo modal-->
<!--</button>-->

<!-- Modal -->
<div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="user-modal-label" aria-hidden="true">

</div>

<div>
    <div class="form-row align-items-center">
        <div class="col-auto">
            <input type="text" class="form-control mb-2" id="" placeholder="Jane Doe">
        </div>
        <div class="col-auto">
            <input type="text" class="form-control mb-2" id="" placeholder="Jane Doe">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">搜索</button>
        </div>
        <div class="col-auto">
            <button id="create-user-btn" class="btn btn-primary mb-2">创建</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        dhConfirm("123");

        $("body").on("click", "#create-user-btn", function () {
            $.ajax({
                type: "get",
                url: "/user/create-modal",
                data: {},
                dataType: "json",
                success: function(data){
                    if (data.status == 1) {
                        $("#user-modal").html(data.data.html).modal();
                    }
                }
            });
        });
    });
</script>