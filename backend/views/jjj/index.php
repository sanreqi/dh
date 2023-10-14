<?php //\backend\assets\LoginAsset::register($this); ?>
<?php \backend\assets\JjjAsset::register($this); ?>
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
<div id="ban-modal" class="modal">
    <!-- 弹窗内容 -->
    <div class="modal-content">
        <div class="modal-header">
            <h2>弹窗头部</h2>
        </div>
        <div class="modal-body">
            <form id="ban-form" data-id="0">
                <div class="form-group">
                    <label for="ban-keyword">关键字</label>
                    <input class="form-control" autocomplete="off" type="text" name="ban[keyword]" id="ban-keyword">
                </div>

                <div class="form-group">
                    <label for="ban-degree">程度</label>
                    <select class="form-control" name="ban[degree]" id="ban-degree">
                        <option value="0">无</option>
                        <option value="1">低</option>
                        <option value="2">中</option>
                        <option value="3">高</option>
                    </select>
                </div>

                <input type="hidden" value="0" name="ban[id]" id="ban-id">
            </form>
        </div>

        <div class="footer-line"></div>

        <div class="modal-footer clearfix">
            <a class="btn btn-primary save">保存</a>
            <a class="btn btn-secondary cancel">取消</a>
        </div>
    </div>
</div>

<!--<form id="ban-search-form">-->
<!--    <input type="hidden" name="search[keyword]" id="search-keyword" value="">-->
<!--    <input type="hidden" name="search[degree]" id="search-degree" value="-1">-->
<!--    <input type="hidden" name="search[sort_type]" id="search-sort_type" value="0">-->
<!--</form>-->
<div class="wrapper">
    <h1 class="title">不要再说了</h1>
    <div id="nav">
        <div><input type="text" class="form-control" name="search"></div>
        <div><a href="javascript:void(0);" class="btn btn-primary search-btn">搜索</a></div>
        <div><a href="javascript:void(0);" class="btn btn-primary create-btn">创建</a></div>
    </div>

    <div id="sort">
        <ul>
            <li>排序</li>
            <li><a href="javascript:void(0);" class="sort-by-degree active" sort_type="0">默认排序</a></li>
            <li><a href="javascript:void(0);" class="sort-by-degree" sort_type="1">按程度排序</a></li>
            <li><a href="javascript:void(0);" class="sort-by-count" sort_type="2">按出现频次排序</a></li>
        </ul>
    </div>

    <div id="degree">
        <ul>
            <li>程度</li>
            <li><a href="javascript:void(0);" class="active" degree="-1">全部</a></li>
            <li><a href="javascript:void(0);" class="" degree="0">无</a></li>
            <li><a href="javascript:void(0);" class="" degree="1">低</a></li>
            <li><a href="javascript:void(0);" class="" degree="2">中</a></li>
            <li><a href="javascript:void(0);" class="" degree="3">高</a></li>
        </ul>
    </div>

    <div id="edit-mode">
        <div>开启编辑模式</div>
        <div class="edit-mode-div"><input type="checkbox"></div>
    </div>

    <div id="ban-table">

    </div>
</div>
</body>
<?php $this->endBody(); ?>
</html>

<?php $this->endPage(); ?>

<script>

</script>


<!--</html>-->