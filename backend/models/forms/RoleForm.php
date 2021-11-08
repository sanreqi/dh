<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\rbac\Role;

class RoleForm extends Model
{
    public $name;
    public $description;
    public $ruleName;
    public $data;

    const TYPE_CREATE = 1;
    const TYPE_UPDATE = 2;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'ruleName', 'data'], 'trim'],
            ['name', 'required', 'message' => '角色名称不能为空'],
            ['name', 'string', 'max' => 50, 'tooLong' => '用户名长度过长'],
            ['name', 'validateName'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['name', 'description', 'ruleName', 'data'],
            'update' => ['name', 'description', 'ruleName', 'data'],
        ];
    }

    public function validateName() {
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

    public function createRole() {
        $auth = Yii::$app->authManager;
        $role = $auth->createRole($this->name);
        !empty($this->description) && $role->description = $this->description;
        !empty($this->ruleName) && $role->ruleName = $this->ruleName;
        !empty($this->data) && $role->data = $this->data;
        //可能会抛出异常
        $auth->add($role);
        return true;
    }

    public function updateRole() {
        //名称不允许修改
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->name);
        !empty($this->description) && $role->description = $this->description;
        !empty($this->ruleName) && $role->ruleName = $this->ruleName;
        !empty($this->data) && $role->data = $this->data;
        //可能会抛出异常
        $auth->update($this->name, $role);
    }


}