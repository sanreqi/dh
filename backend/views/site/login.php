<?php \backend\assets\LoginAsset::register($this); ?>
<?php $this->context->layout = false; ?>

<?php $this->beginPage(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>后台登录</title>

    <?php $this->head(); //必须，layout=false情况下，通过这行代码引入前端资源包，asset register ?>
</head>
<?php $this->beginBody(); ?>
    <body class="text-center">
        <form id="login-form" class="form-signin" method="post">
            <img class="mb-4" src="/uploads/202110/1634806378_SUu6Dz.jpg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">后台登录</h1>
            <label for="username" class="sr-only">用户名</label>
            <input type="text" name="LoginForm[username]" id="username" class="form-control" placeholder="用户名" required autofocus>
            <label for="password" class="sr-only">密码</label>
            <input type="password" name="LoginForm[password]" id="password" class="form-control" placeholder="密码" required>
            <div class="checkbox mb-3">
                <label>
                    <input name="LoginForm[rememberMe]" type="checkbox"> 自动登录
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" id="login-btn" type="submit">登录</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019-2021</p>
        </form>

        <?php echo \Yii::$app->view->render('/layouts/_alert_confirm'); ?>
    </body>
<?php $this->endBody(); ?>
</html>

<?php $this->endPage(); ?>

<script>
    $(document).ready(function() {
        $("body").on("click", "#login-btn", function () {
            let $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/site/login-ajax",
                data: $("#login-form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        window.location.href = "/site/index";
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