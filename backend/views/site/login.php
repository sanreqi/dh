<?php \backend\assets\LoginAsset::register($this); ?>
<?php $this->context->layout = false; ?>

<?php $this->beginPage(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v4.6</title>

    <?php $this->head(); //必须，layout=false情况下，通过这行代码引入前端资源包，asset register ?>




</head>
<body class="text-center">
<?php $this->beginBody(); ?>
<form class="form-signin">

    <img class="mb-4" src="/uploads/202110/1634806378_SUu6Dz.jpg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
</form>



</body>
<?php $this->endBody(); ?>
</html>

<?php $this->endPage(); ?>
