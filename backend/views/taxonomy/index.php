<?php
\common\assets\EasyUiAsset::register($this);
?>
<!--<h2>Editable Tree</h2>-->
<!--<p>Click the node to begin edit, press enter key to stop edit or esc key to cancel edit.</p>-->
<!--<div style="margin:20px 0;"></div>-->
<!--<div class="easyui-panel" style="padding:5px">-->
<!--    <ul id="tt" class="easyui-tree" data-options="-->
<!--				url: '/asd-diary/get-json',-->
<!--				method: 'get',-->
<!--				animate: true,-->
<!--				onClick: function(node){-->
<!--					$(this).tree('beginEdit',node.target);-->
<!--				}-->
<!--			"></ul>-->
<!--</div>-->


<ul id="tt"></ul>

<div id="mm" class="easyui-menu" style="width:120px;">
    <div onclick="append()" data-options="iconCls:'icon-add'">Append</div>
    <div onclick="remove()" data-options="iconCls:'icon-remove'">Remove</div>
</div>

<script>
    function append() {
        var selected = $('#tt').tree('getSelected');
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
                    $('#tt').tree('append', {
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
        var selected = $('#tt').tree('getSelected');


        $.ajax({
            type: "post",
            url: "/taxonomy/delete",
            data: {
                id: selected.id
            },
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    $('#tt').tree("remove", selected.target);
                } else {
                    dhAlert(data.errorMsg)
                }
            },
        });
    }
    $(document).ready(function () {
        let old_name = "";
        $('#tt').tree({
            url: "/taxonomy/get-tree-data",
            dnd: true,

            onClick: function(node){
                //编辑
                $(this).tree('beginEdit',node.target);
            },

            onContextMenu: function(e, node){
                e.preventDefault();
                // select the node
                $('#tt').tree('select', node.target);
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
                            $(node.target).find(".tree-title").text(old_name);
                        }
                    },
                });
            },

            onBeforeDrag: function (node) {
                // alert(111);
            },

            onStartDrag: function (node) {
                // alert(222);
            },

            onStopDrag: function (node) {
                // node.id
                // alert(333);
            },

            onBeforeDrop: function (target, source, point) {
                console.log(source);
                console.log(target.id);
                // alert(target.id);

                // return false;
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