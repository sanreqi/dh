const cell = 5; //一行几列

$(document).ready(function() {
    $(document).on("click",".create-btn",function () {
        $("#ban-id").val(0);
        $(".modal").css("background-color","rgba(0,0,0,0.4");
        $(".modal").css("display","block");
    });

    $(document).on("click",".modal .save",function () {
        let $this = $(this);
        $this.prop("disabled",true);
        $.ajax({
            url: "/jjj/create-update-ban",
            type: "post",
            dataType: "json",
            data: $("#ban-form").serializeArray(),
            success: function (data) {
                if (data.status===1) {
                    requestTable();
                    $(".modal").css("display","none");
                } else {
                    alert(data.errMsg);
                }
            },
            complete: function () {
                //防重复点击
                $this.prop("disabled",false);
            }
        });
    });

    $(document).on("click",".modal .cancel",function () {
        $(".modal").css("display","none");
    });

    $(document).on("click","#ban-table .icon-delete",function () {
        let keyword = $(this).parent("li").data("keyword");
        if (!confirm(`确定要删除${keyword}吗？`)) {
            return false;
        }
        let id = $(this).parent("li").data("id");
        $.ajax({
            url: "/jjj/delete-ban",
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: function (data) {
                if (data.status===1) {
                    requestTable();
                } else {
                    alert(data.errMsg);
                }
            },
            complete: function () {
            }
        });
    });

    $(document).on("click",".edit-mode-div input", function() {
        if ($(this).is(":checked")) {
            $(".icon-edit").show();
            $(".icon-delete").show();
        } else {
            $(".icon-edit").hide();
            $(".icon-delete").hide();
        }
    });

    $(document).on("click","#ban-table .icon-edit",function () {
        $(".modal").css("background-color","rgba(0,0,0,0.4");
        $(".modal").css("display","block");

        let id = $(this).parent("li").data("id");
        let degree = $(this).parent("li").data("degree");
        let keyword = $(this).parent("li").data("keyword");

        $("#ban-id").val(id);
        $("#ban-keyword").val(keyword);
        $("#ban-degree").val(degree);
    });

    $(document).on("click","#sort a",function () {
        if ($(this).attr("sort_type") == 2) {
            alert("还没有开发哦");
            return false;
        }
        $(this).parents("#sort").find("a.active").removeClass("active");
        $(this).addClass("active");
        requestTable();
        // $("#search-sort_type").val($(this).attr("sort_type"));
    });

    $(document).on("click","#degree a",function () {
        $(this).parents("#degree").find("a.active").removeClass("active");
        $(this).addClass("active");
        requestTable();
        // $("#search-degree").val($(this).attr("degree"));
    });

    $(document).on("click",".search-btn",function () {
        requestTable();
    });


    function renderIcon() {
        if ($(".edit-mode-div input").is(":checked")) {
            $(".icon-edit").show();
            $(".icon-delete").show();
        } else {
            $(".icon-edit").hide();
            $(".icon-delete").hide();
        }
    }

    function requestTable() {
        $.ajax({
            url: "/jjj/ban-list",
            type:"get",
            dataType:"json",
            // data: $("#ban-search-form").serializeArray(),
            data: {
                keyword: $("input[name=search]").val(),
                degree: $("#degree .active").attr("degree"),
                sort_type: $("#sort .active").attr("sort_type"),
            },

            success: function (data) {
                if (data.status===1) {
                    renderTable(data.data);
                }
            },
            complete: function () {
                renderIcon();
            }
        });
    }

    function renderTable(data) {
        let str = '';
        for (let i=0; i<data.length; i++) {
            if (i % cell === 0) {
                str += '<ul class="row">';
            }
            str += `<li data-id="${data[i].id}" data-degree="${data[i].degree}" data-keyword="${data[i].keyword}" class="cell">${data[i].keyword}<i class="icon-edit iconfont"></i><i class="icon-delete iconfont"></i>`;

            if (i % cell === 4) {
                str += '</ul>';
            }
        }
        if (data.length % 5 !== 0) {
            str += '</ul>';
        }

        $("#ban-table").html(str);
    }

    requestTable();
});

