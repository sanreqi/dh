<?php
namespace backend\models\forms;

use common\models\User;
use yii\base\Model;

class UserForm extends Model
{
    public $username;
    public $truename;
    public $mobile;
    public $password;
    public $confirmPassword;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => '用户名必填'],
            ['username', 'string', 'min' => 3, 'max' => 20, 'tooShort' => '用户名长度必须在3-20之间', 'tooLong' => '用户名长度必须在3-20之间'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'filter' => ['status' => User::STATUS_ACTIVE], 'message' => '用户名已经存在'],

            ['truename', 'trim'],
            ['truename', 'string', 'min' => 2, 'max' => 20, 'tooShort' => '姓名长度必须在2-20之间', 'tooLong' => '姓名长度必须在2-20之间'],

            ['mobile', 'trim'],
            ['mobile', 'match', 'pattern' => '/^1[3|4|5|7|8][0-9]{9}$/', 'message' => '请填写正确手机号'],

            ['email', 'email'],

            ['password', 'required', 'message' => '密码必填', 'on' => 'create'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码长度不能小于6位'],
            ['password', 'validatePassword', 'on' => 'update'],

            ['confirmPassword', 'required', 'message' => '两次输入密码不一致', 'on' => 'create'],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>'两次输入密码不一致'],
        ];
    }

    /**
     * 用于update时候验证
     */
    public function validatePassword() {
        if (empty($this->password) && empty($this->confirmPassword)) {
            //修改时候密码为空就保持不变
            return true;
        }

        if ($this->password == $this->confirmPassword) {
            return true;
        }

        $this->addError('password', '两次输入密码不一致');
    }

    /**
     * 创建用户
     * @return bool
     */
    public function createUser() {
        $model = new User();
        $model->username = $this->username;
        $model->truename = $this->truename;
        $model->mobile = $this->mobile;
        $model->email= $this->email;
        $model->status = User::STATUS_ACTIVE;
        $model->setPassword($this->password);
        $model->generateAuthKey();
        return $model->save();
    }

}