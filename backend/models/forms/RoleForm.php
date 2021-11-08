<?php
namespace backend\models\forms;

use yii\base\Model;

class RoleForm extends Model
{
    public $name;
    public $description;
    public $ruleName;
    public $data;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'ruleName', 'data'], 'trim'],
            ['name', 'required', 'message' => '角色名称不能为空'],
//            ['name', 'validateName'],
//
//            ['description', 'trim'],
//
//            [['id'], 'safe'],
        ];
    }
}