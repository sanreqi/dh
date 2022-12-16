<?php


namespace backend\services;

use Yii;
use common\models\Taxonomy;

class TaxonomyService
{
    private $result;
    private $errMsg;

    public function getErrMsg() {
        return $this->errMsg;
    }

    //id=1是最高层
    public function tree($id = 1) {
        $taxonomy = Taxonomy::find()->where(['is_delete'=>0, 'id'=>$id])->asArray()->one();
        if (empty($taxonomy)) {
            $this->errMsg = 'id错误';
            return false;
        }

        $result['id'] = $id;
        $result['text'] = $taxonomy['name'];
        $result['attributes'] = ['parent_id' => $taxonomy['parent_id'], 'tid' => $taxonomy['id']];
        $result['children'] = $this->children($id);
        return $result;
    }

    public function children($parentId) {
        $taxonomys = Taxonomy::find()->where(['is_delete'=>0, 'parent_id'=>$parentId])->asArray()->all();
        if (empty($taxonomys)) {
            return;
        }

        $result = [];
        foreach ($taxonomys as $v) {
            $data['id'] = $v['id'];
            $data['text'] = $v['name'];
            $data['attributes'] = ['parent_id' => $v['parent_id'], 'tid' => $v['id']];
            //递归
            $data['children'] = $v['is_leaf'] ? [] : $this->children($v['id']);
//            $data['children'] = $this->children($v['id']);
            $result[] = $data;
        }
        return $result;
    }

    //新增节点
    public function create($params) {
        $currentTime = time();
        if (false === $this->checkCreate($params)) {
            return false;
        }

        $parent = Taxonomy::find()->where(['is_delete'=>0, 'id'=>$params['parent_id']])->one();
        $maxSort = Taxonomy::find()->where(['is_delete'=>0, 'parent_id'=>$params['parent_id']])->max('sort');
        $sort = $maxSort ? $maxSort + 1 : 1;

        $model = new Taxonomy();
        $model->parent_id = $params['parent_id'];
        $model->root_id = $parent->root_id;
        $model->name = trim($params['name']);
        $model->sort = $sort;
        $model->level = $parent->level + 1;
        $model->is_leaf = 1;
        $model->is_delete = 0;
        $model->create_time = $currentTime;
        $model->update_time = $currentTime;

        //把父级is_leaf改为非叶子节点
        $parent->is_leaf = 0;
        $parent->update_time = $currentTime;
        $parent->save();

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model->save();
            $parent->save();
            $transaction->commit();
            return $model->id;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->errMsg = '保存失败';
            return false;
        }
    }

    private function checkCreate($params) {
        if (!isset($params['parent_id']) || empty($params['parent_id'])) {
            $this->errMsg = 'id不能为空';
            return false;
        }
        if (!isset($params['name']) || empty(trim($params['name']))) {
            $this->errMsg = 'name不能为空';
            return false;
        }
        $parent = Taxonomy::find()->where(['is_delete'=>0, 'id'=>$params['parent_id']])->count();
        if (empty($parent)) {
            $this->errMsg = 'parent_id不正确';
            return false;
        }

        $name = trim($params['name']);
        $taxonomy = Taxonomy::find()->where(['is_delete'=>0, 'parent_id'=>$params['parent_id'], 'name'=>$name])->count();
        if (!empty($taxonomy)) {
            $this->errMsg = '"' . $params['name'] . '"在该层级中已经存在';
            return false;
        }

        return $parent;
    }

    public function update($params) {
        $currentTime = time();
        if (false === $this->checkUpdate($params)) {
            return false;
        }

        $id = $params['id'];
        $name = trim($params['name']);

        $model = Taxonomy::find()->where(['id'=>$id])->one();
        $model->name = $name;
        $model->update_time = $currentTime;
        if ($model->save()) {
            return true;
        } else {
            $this->errMsg = array_values($model->getFirstErrors())[0];
            return false;
        }
    }

    private function checkUpdate($params) {
        if (!isset($params['id']) || empty($params['id'])) {
            $this->errMsg = 'id不能为空';
            return false;
        }
        if (!isset($params['name']) || empty(trim($params['name']))) {
            $this->errMsg = 'name不能为空';
            return false;
        }
        $name = trim($params['name']);

        $taxonomy1 = Taxonomy::find()->where(['is_delete'=>0, 'id'=>$params['id']])->count();
        if (empty($taxonomy1)) {
            $this->errMsg = 'id不正确';
            return false;
        }
        $taxonomy2 = Taxonomy::find()->where(['is_delete'=>0, 'name'=>$name])->andWhere(['!=', 'id', $params['id']])->count();
        if (!empty($taxonomy2)) {
            $this->errMsg = '"' . $params['name'] . '"在该层级中已经存在';
            return false;
        }

        return true;
    }

    public function delete($params) {
        $currentTime = time();
        if (false === $this->checkDelete($params)) {
            return false;
        }

        $id = $params['id'];
        $model = Taxonomy::find()->where(['id'=>$id])->one();
        $model->is_delete = 1;
        $model->update_time = $currentTime;

        //如果没有儿子就设置为叶子节点
        $children = Taxonomy::find()->where(['is_delete'=>0, 'parent_id'=>$model->id]);
        if (empty($children)) {
            $parent = Taxonomy::find()->where(['id'=>$model->parent_id])->one();
            $parent->is_leaf = 1;
            $parent->update_time = $currentTime;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model->save();
            if (empty($children)) {
                $parent->save();
            }
            $transaction->commit();
            return $model->id;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->errMsg = '保存失败';
            return false;
        }

//        $taxonomy

//        if ($model->save()) {
//            return true;
//        } else {
//            $this->errMsg = array_values($model->getFirstErrors())[0];
//            return false;
//        }
    }

    private function checkDelete($params) {
        if (!isset($params['id']) || empty($params['id'])) {
            $this->errMsg = 'id不能为空';
            return false;
        }
        $taxonomy1 = Taxonomy::find()->where(['is_delete'=>0, 'id'=>$params['id']])->count();
        if (empty($taxonomy1)) {
            $this->errMsg = 'id不正确';
            return false;
        }

        $taxonomy2 = Taxonomy::find()->where(['is_delete'=>0, 'parent_id'=>$params['id']])->count();
        if (!empty($taxonomy2)) {
            $this->errMsg = '有子节点不能删除';
            return false;
        }

        return true;
    }
}
