<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\rbac\Role;

class RoleForm extends Model
{
    public $name;
    public $description;
    public $ruleName;
    public $data;
    public $parent_role;

    private $errorMsg = '';

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'description', 'ruleName', 'data'], 'trim'],
            ['name', 'required', 'message' => '角色名称不能为空'],
            ['name', 'string', 'max' => 50, 'tooLong' => '用户名长度过长'],
            [['parent_role'], 'safe'],
        ];
    }

    public function createRole() {
        $auth = Yii::$app->authManager;
        if (empty($this->name)) {
            $this->errorMsg = '角色名称不能为空';
            return false;
        }
        $role = $auth->getRole($this->name);
        if (!empty($role)) {
            $this->errorMsg = '角色名称已经存在';
            return false;
        }
        if (!empty($this->parent_role)) {
            $parentRole = $auth->getRole($this->parent_role);
            if (empty($parentRole)) {
                $this->errorMsg = '父类角色不存在';
                return false;
            }
            if ($this->parent_role == $this->name) {
                $this->errorMsg = '父类角色子类角色相同';
                return false;
            }
        }

        $role = $auth->createRole($this->name);
        !empty($this->description) && $role->description = $this->description;
        $auth->add($role);
        if (isset($parentRole) && !empty($parentRole) && ($auth->canAddChild($parentRole, $role))) {
            $auth->addChild($parentRole, $role);
        }

        return true;
    }

    public function updateRole() {
        $auth = Yii::$app->authManager;
        if (empty($this->name)) {
            $this->errorMsg = '角色名称不能为空';
            return false;
        }
        $role = $auth->getRole($this->name);
        if (empty($role)) {
            $this->errorMsg = '角色名称不存在';
            return false;
        }
        if (!empty($this->parent_role)) {
            $parentRole = $auth->getRole($this->parent_role);
            if (empty($parentRole)) {
                $this->errorMsg = '父类角色不存在';
                return false;
            }
            if ($this->parent_role == $this->name) {
                $this->errorMsg = '父类角色子类角色相同';
                return false;
            }
        }
        !empty($this->description) && $role->description = $this->description;
        $auth->update($this->name, $role);

        //删除父类角色
        Yii::$app->db->createCommand()->delete('auth_item_child', "child='".$this->name."'")->execute();
        if (isset($parentRole) && !empty($parentRole) && ($auth->canAddChild($parentRole, $role))) {
            $auth->addChild($parentRole, $role);
        }

        return true;
    }

    public function getErrorMsg() {
        return $this->errorMsg;
    }


}