function dhAlert(content) {
    $("#dh-alert").find(".modal-body p").html(content);
    $("#dh-alert").modal();
}

function dhConfirm(content) {
    $("#dh-confirm").find(".modal-body p").html(content);
    $("#dh-confirm").modal();
}

function createModalBind(name) {
    var btn = "#create-" + name + "-btn";
    $("body").on("click", btn, function () {
        var $this = $(this);
        $(this).prop("disabled", "disabled").addClass("disabled");
        var url = "/" + name + "/create-modal";
        var modal = "#" + name + "-modal";
        var post_url = "/" + name + "/create";
        $.ajax({
            type: "get",
            url: url,
            data: {},
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $(modal).html(data.data.html).modal();
                    var save_btn = "#save-" + name + "-btn";
                    $(save_btn).attr("url", post_url);
                }
            },
            complete: function (data) {
                $this.prop("disabled", false).removeClass("disabled");
            }
        });
    });
}

//prikey 主键名，id/name
function updateModalBind(name, prikey) {
    var btn = ".update-" + name + "-btn";
    $("body").on("click", btn, function () {
        var $this = $(this);
        $this.prop("disabled", "disabled").addClass("disabled");
        var modal = "#" + name + "-modal";
        var params = getPriParams(prikey, $this.attr("prikey-val"));
        var post_url = "/" + name + "/update" + params;
        var modal_url = "/" + name + "/update-modal" + params;
        $.ajax({
            type: "get",
            url: modal_url,
            data: {
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $(modal).html(data.data.html).modal();
                    var save_btn = "#save-" + name + "-btn";
                    $(save_btn).attr("url", post_url);
                }
            },
            complete: function (data) {
                $this.prop("disabled", false).removeClass("disabled");
            }
        });
    });
}

function saveModalBind(name, url) {
    var btn = "#save-" + name + "-btn";
    $("body").on("click", btn, function () {
        var $this = $(this);
        //typeof兼容null和undefined
        if (typeof(url) == "undefined") {
            url = $this.attr("url");
        }
        var form = "#" + name + "-form";
        $this.prop("disabled", "disabled").addClass("disabled");
        $.ajax({
            type: "post",
            url: url,
            data: $(form).serializeArray(),
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    window.location.reload();
                } else {
                    dhAlert(data.errorMsg)
                }
            },
            complete: function (data) {
                $this.prop("disabled", false).removeClass("disabled");
            }
        });
    });
}

function deleteModalBind(name, prikey) {
    var btn = ".delete-" + name + "-btn";
    $("body").on("click", btn, function () {
        var $this = $(this);
        $this.prop("disabled", "disabled").addClass("disabled");
        var post_url = "/" + name + "/delete";
        var params = getPriParamsJson(prikey, $this.attr("prikey-val"));
        var str = $this.attr("str");
        if (typeof(str) == "undefined") {
            str = "";
        }
        var alinfo = "确定要删除" + str + "吗?";
        dhConfirm(alinfo);

        $("#dh-confirm").find("#dh-confirm-btn").click(function() {
            $.ajax({
                type: "post",
                url: post_url,
                data: params,
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        window.location.reload();
                    } else {
                        dhAlert(data.errorMsg)
                    }
                },
                complete: function (data) {
                    $("#dh-confirm").find("#dh-confirm-btn").unbind("click");
                    $this.prop("disabled", false).removeClass("disabled");
                }
            });
        });
    });
}

//主键拼的参数
function getPriParams(prikey, prikeyVal) {
    if (typeof(prikey) == "undefined") {
        prikey = "id";
    }
    var params = "?" + prikey + "=" + prikeyVal;
    return params;
}

function getPriParamsJson(prikey, prikeyVal) {
    if (typeof(prikey) == "undefined") {
        prikey = "id";
    }
    var params_str = '{"' + prikey + '":"' + prikeyVal + '"}';
    return JSON.parse(params_str);
}

function renderView(url, id) {
    $.ajax({
        type: "get",
        url: url,
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.status == 1) {
                $("#" + id).html(data.data.html);
            } else {
                dhAlert(data.errorMsg)
            }
        },
        complete: function (data) {
            $this.prop("disabled", false).removeClass("disabled");
        }
    });
}