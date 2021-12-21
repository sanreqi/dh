<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\rbac\Role;

//@todo 重做
class RoleForm extends Model
{
    public $name;
    public $description;
    public $ruleName;
    public $data;
    public $parent_role;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'ruleName', 'data'], 'trim'],
            ['name', 'required', 'message' => '角色名称不能为空'],
            ['name', 'string', 'max' => 50, 'tooLong' => '用户名长度过长'],
            ['name', 'validateName'],
            [['parent_role'], 'safe'],
        ];
    }



    public function scenarios1()
    {
        return [
            'create' => ['name', 'description', 'ruleName', 'data', 'parent_role'],
            'update' => ['name', 'description', 'ruleName', 'data', 'parent_role'],
        ];
    }

    public function validateName1() {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->name);
        if ($this->scenario == 'create' && !empty($role)) {
            $this->addError('role', '角色名称已经存在');
        }
        if ($this->scenario == 'update' && empty($role)) {
            $this->addError('role', '角色名称不存在');
        }

        return true;
    }

    public function createRole2() {
        $auth = Yii::$app->authManager;
//        if (!empty($this->parent_role)) {
//            $parentRole = $auth->getRole($this->parent_role);
//            if (!empty($parentRole)) {
//                if ($auth->canAddChild($parentRole, $role)) {
//
//                }
//            }
//        }


        $role = $auth->createRole($this->name);
        !empty($this->description) && $role->description = $this->description;
        !empty($this->ruleName) && $role->ruleName = $this->ruleName;
        !empty($this->data) && $role->data = $this->data;
        $auth->add($role);


        return true;

    }

    public function updateRole3() {
        //名称不允许修改
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->name);
        !empty($this->description) && $role->description = $this->description;
        !empty($this->ruleName) && $role->ruleName = $this->ruleName;
        !empty($this->data) && $role->data = $this->data;
        //可能会抛出异常
        return $auth->update($this->name, $role);
    }


}