<?php

namespace backend\models\forms;

use Yii;
use common\models\Page;
use common\models\User;
use yii\base\Model;
use yii\db\Query;

class PageForm extends Model
{
    public $name;
    public $description;
    public $id;
    public $errorMsg;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['name', 'trim'],
            ['name', 'required', 'message' => '页面名称不能为空'],
            ['name', 'validateName'],

            ['description', 'trim'],

            [['id'], 'safe'],
        ];
    }

    public function validateName() {
        $query = new Query();
        $query->from('page')->where(['is_delete' => Page::IS_DELETE_NO])->andWhere(['name' => $this->name]);
        if (!empty($this->id)) { //编辑情况
            $query->andWhere(['!=', 'id', $this->id]);
        }

        $model = $query->one();
        if (!empty($model)) {
            $this->addError('name', '页面名称已存在');
        }
        return true;
    }

    public function savePage() {
        if (!empty($this->id)) {
            $model = Page::find()->where(['is_delete' => Page::IS_DELETE_NO, 'id' => $this->id])->one();
            if (empty($model)) {
                $this->errorMsg = '页面id不存在';
                return false;
            }
        } else {
            $model = new Page();
        }

        $model->name = $this->name;
        $model->description = $this->description;
        return $model->save();
    }
}