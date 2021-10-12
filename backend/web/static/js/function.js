function dhAlert(content) {
    $("#dh-alert").find(".modal-body p").html(content);
    $("#dh-alert").modal();
}

function dhConfirm(content) {
    $("#dh-confirm").find(".modal-body p").html(content);
    $("#dh-confirm").modal();
}