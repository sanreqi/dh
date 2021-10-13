<?php

namespace common\widgets;

use yii\widgets\LinkPager;

class DhLinkPager extends LinkPager
{
    public function init()
    {
        parent::init();

        $this->firstPageLabel = '首页';
        $this->prevPageLabel = '上一页';
        $this->nextPageLabel = '下一页';
        $this->lastPageLabel = '末页';
        $this->linkContainerOptions = ['class' => 'page-item'];
        $this->linkOptions = ['class' => 'page-link'];
        $this->disabledListItemSubTagOptions = ['class' => 'page-link'];
        $this->hideOnSinglePage = false;
    }

}
