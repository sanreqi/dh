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
        var url = "/" + name + "/create-modal";
        var modal = "#" + name + "-modal";
        $.ajax({
            type: "get",
            url: url,
            data: {},
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $(modal).html(data.data.html).modal();
                }
            }
        });
    });
}

function updateModalBind(name) {
    var btn = ".update-" + name + "-btn";
    $("body").on("click", btn, function () {
        var url = "/" + name + "/update-modal";
        var modal = "#" + name + "-modal";
        var _id = name + "_id";
        var id = $(this).attr(_id);
        $.ajax({
            type: "get",
            url: url,
            data: {
                "id": id
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $(modal).html(data.data.html).modal();
                }
            }
        });
    });
}

function saveModalBind(name, url) {
    var btn = "#save-" + name + "-btn";
    $("body").on("click", btn, function () {
        //typeof兼容null和undefined
        if (typeof(url) == "undefined") {
            url = "/" + name + "/save-" + name;
        }
        var form = "#" + name + "-form";
        var $this = $(this);
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

