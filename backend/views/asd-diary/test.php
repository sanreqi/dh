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
<!--<div id="mm" class="easyui-menu" style="width:120px;">-->
<!--    <div onclick="append()" data-options="iconCls:'icon-add'">Append</div>-->
<!--    <div onclick="remove()" data-options="iconCls:'icon-remove'">Remove</div>-->
<!--</div>-->
<script>
    function append() {
        var selected = $('#tt').tree('getSelected');
        console.log(selected);
        $('#tt').tree('append', {
            parent: selected.target,
            data: [{
                // id:后端返回
                text: '新节点'
            }]
        });

        alert();
    }

    function remove() {
        alert(2222);
    }
    $(document).ready(function () {


        $('#tt').tree({
            url: "/asd-diary/get-json",
            dnd: true,

            onClick: function(node){
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

            onAfterEdit: function (node) {
                // alert(node.target);
                console.log(node.id);
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