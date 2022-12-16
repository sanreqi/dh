<?php
\common\assets\EasyUiAsset::register($this);
?>

<ul id="tt"></ul>

<div id="mm" class="easyui-menu" style="width:120px;">
    <div onclick="append()" data-options="iconCls:'icon-add'">Append</div>
    <div onclick="remove()" data-options="iconCls:'icon-remove'">Remove</div>
</div>

<script>
    function append() {
        var selected = $("#tt").tree('getSelected');
        $.ajax({
            type: "post",
            url: "/taxonomy/create",
            data: {
                parent_id: selected.id,
                name: "新节点"
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $("#tt").tree('append', {
                        parent: selected.target,
                        data: [{
                            // id:后端返回
                            id: data.data.id,
                            text: '新节点'
                        }]
                    });
                } else {
                    dhAlert(data.errorMsg)
                }
            },
        });
    }

    function remove() {
        var selected = $("#tt").tree('getSelected');


        $.ajax({
            type: "post",
            url: "/taxonomy/delete",
            data: {
                id: selected.id
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $("#tt").tree("remove", selected.target);
                } else {
                    dhAlert(data.errorMsg)
                }
            },
        });
    }
    $(document).ready(function () {
        let old_name = "";
        let drag_flag = true;
        $("#tt").tree({
            url: "/taxonomy/get-tree-data",
            dnd: true,

            onClick: function(node){
                //编辑
                $(this).tree('beginEdit',node.target);
            },

            onContextMenu: function(e, node){
                e.preventDefault();
                // select the node
                $("#tt").tree('select', node.target);
                // display context menu
                $('#mm').menu('show', {
                    left: e.pageX,
                    top: e.pageY
                });
            },

            onBeforeEdit: function (node) {
                old_name = node.text;
            },

            onAfterEdit: function (node) {
                $.ajax({
                    type: "post",
                    url: "/taxonomy/update",
                    data: {
                        id: node.id,
                        name: node.text
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {

                        } else {
                            dhAlert(data.errorMsg);
                            // $(node.target).find(".tree-title").text(old_name);

                            var node = $('#tt').tree('getSelected');
                            if (node){
                                $('#tt').tree('update', {
                                    target: node.target,
                                    text: old_name
                                });
                            }
                        }
                    },
                });
            },

            onBeforeDrop: function (target, source, point) {
                let target_node = $("#tt").tree("getData", target);
                if (target_node.attributes.parent_id != source.attributes.parent_id ||
                    target_node.id == source.id ||
                    (point != "top" && point != "bottom")) {
                    drag_flag = false;
                    return false;
                }
            },

            onStopDrag: function (node) {
                if (!drag_flag) {
                    return false;
                }
                let parent = $("#tt").tree("getParent", node.target);
                let children = $("#tt").tree("getChildren", parent.target);
                let ids = [];
                let i = 0;
                $.each(children, function (index, dom) {
                    ids[i] = dom.id;
                    i++;
                })

                $.ajax({
                    type: "post",
                    url: "/taxonomy/drag",
                    data: {
                        parent_id: node.attributes.parent_id,
                        ids: ids
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {

                        } else {
                            dhAlert(data.errorMsg);
                        }
                    },
                });
            }
        });
    });
</script>

<style>
    .accordion {
        background-color: #343a40!important;
        border-color: inherit!important;
    }
    .tree-node {
        width: auto;
        display: inline-block;
    }
</style>