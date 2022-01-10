<div class="row">

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse accordion">
        <div class="sidebar-sticky pt-3 accordion">
            <ul class="nav flex-column mb-2">
                <li class="nav-item" id="heading0">
                    <a class="nav-link" data-toggle="collapse" data-target=".collapse0" aria-expanded="true" aria-controls="collapse0" href="/user/index">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="ml-8">用户</span>
                    </a>
                </li>
                <div class="collapse collapse0 " aria-labelledby="heading0" data-parent="#sidebarMenu">
                    <li class="nav-item">
                        <a class="nav-link" href="/user/index">
                            <span class="ml-26">用户列表</span>
                        </a>
                    </li>
                </div>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item" id="heading1">
                    <a class="nav-link" data-toggle="collapse" data-target=".collapse1" aria-expanded="true" aria-controls="collapse1" href="/page/index">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="ml-8">页面</span>
                    </a>
                </li>
                <div class="collapse collapse1 " aria-labelledby="heading1" data-parent="#sidebarMenu">
                    <li class="nav-item">
                        <a class="nav-link" href="/page/index">
                            <span class="ml-26">页面列表</span>
                        </a>
                    </li>
                </div>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item" id="heading2">
                    <a class="nav-link" data-toggle="collapse" data-target=".collapse2" aria-expanded="true" aria-controls="collapse2" href="/role/index">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="ml-8">安全</span>
                    </a>
                </li>
                <div class="collapse collapse2 " aria-labelledby="heading2" data-parent="#sidebarMenu">
                    <li class="nav-item">
                        <a style="background-color:#0f6ecd" class="nav-link" href="/role/index">
                            <span class="ml-26">角色列表</span>
                        </a>
                    </li>
                </div>
            </ul>
            <ul class="nav flex-column mb-2">
                <li class="nav-item" id="heading3">
                    <a class="nav-link" data-toggle="collapse" data-target=".collapse3" aria-expanded="true" aria-controls="collapse3" href="/role/index">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="ml-8">围棋</span>
                    </a>
                </li>
                <div class="collapse collapse3 " aria-labelledby="heading3" data-parent="#sidebarMenu">
                    <li class="nav-item">
                        <a class="nav-link" href="/wq-blacklist/index">
                            <span class="ml-26">开狗黑名单</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/wq/rank">
                            <span class="ml-26">围棋排列计算</span>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ROLE</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>


        <div class="modal fade" id="role-modal" tabindex="-1" aria-labelledby="role-modal-label" aria-hidden="true">

        </div>

        <form class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control mb-2" name="name" value="" placeholder="角色名称">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">搜索</button>
            </div>
            <div class="col-auto">
                <a id="create-role-btn" class="btn btn-primary mb-2">创建</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>描述</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href="/permission/index?role=213">213</a></td>
                    <td></td>
                    <td>2021-11-08</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="213">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="213" str="213">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=21321321">21321321</a></td>
                    <td>3123123</td>
                    <td>2021-12-21</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="21321321">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="21321321" str="21321321">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=321">321</a></td>
                    <td>22</td>
                    <td>2021-11-10</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="321">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="321" str="321">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=444">444</a></td>
                    <td>ssssssss</td>
                    <td>2021-11-10</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="444">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="444" str="444">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=555">555</a></td>
                    <td></td>
                    <td>2021-11-10</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="555">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="555" str="555">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=aaa">aaa</a></td>
                    <td>tttte</td>
                    <td>2021-11-09</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="aaa">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="aaa" str="aaa">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=default">default</a></td>
                    <td>普通</td>
                    <td>2021-12-05</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="default">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="default" str="default">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=dq">dq</a></td>
                    <td></td>
                    <td>2021-11-09</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="dq">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="dq" str="dq">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=Normal+User">Normal User</a></td>
                    <td></td>
                    <td>2021-11-17</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="Normal User">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="Normal User" str="Normal User">删除</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="/permission/index?role=r">r</a></td>
                    <td></td>
                    <td>2021-11-05</td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="r">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="r" str="r">删除</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div>
            <ul class="pagination"><li class="page-item first disabled"><span class="page-link">首页</span></li>
                <li class="page-item prev disabled"><span class="page-link">上一页</span></li>
                <li class="page-item active"><a class="page-link" href="/role/index?page=1&amp;per-page=10" data-page="0">1</a></li>
                <li class="page-item"><a class="page-link" href="/role/index?page=2&amp;per-page=10" data-page="1">2</a></li>
                <li class="page-item next"><a class="page-link" href="/role/index?page=2&amp;per-page=10" data-page="1">下一页</a></li>
                <li class="page-item last"><a class="page-link" href="/role/index?page=2&amp;per-page=10" data-page="1">末页</a></li></ul></div>

        <script>
            $(document).ready(function () {
                createModalBind("role");
                updateModalBind("role", "name");
                saveModalBind("role");
                deleteModalBind("role", "name");
            });
        </script><!--            <h2>Section title</h2>-->


        <div id="dh-alert" class="modal" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">提示</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="dh-confirm" class="modal" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">提示</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button id="dh-confirm-btn" type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
                    </div>
                </div>
            </div>
        </div>        </main>
</div>