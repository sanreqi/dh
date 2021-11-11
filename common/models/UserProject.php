<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_project".
 *
 * @property int $id
 * @property int $user_id
 * @property int $project 1-后台 2-前台
 */
class UserProject extends \yii\db\ActiveRecord
{
    const PROJECT_BACKEND = 'backend';
    const PROJECT_FRONTEND = 'frontend';

    const CONTROLLER_BACKEND_USER = 'backend_user';
    const CONTROLLER_BACKEND_PAGE = 'backend_page';
    const CONTROLLER_BACKEND_PAGE_CONTENT = 'backend_page_content';
    const CONTROLLER_BACKEND_ROLE = 'backend_role';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'project'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'project' => 'Project',
        ];
    }

    public static function getProjectList() {
        return [
            self::PROJECT_BACKEND => '后台',
            self::PROJECT_FRONTEND => '前台',
        ];
    }

    public static function getProjectByKey($key) {
        $result = '';
        $list = self::getProjectList();
        if (array_key_exists($key, $list)) {
            $result = $list[$key];
        }
        return $result;
    }

    public static function getControllerList() {
        return [
            self::CONTROLLER_BACKEND_USER => '用户(User)',
            self::CONTROLLER_BACKEND_PAGE => '页面(Page)',
            self::CONTROLLER_BACKEND_PAGE_CONTENT => '页面内容(PageContent)',
            self::CONTROLLER_BACKEND_ROLE => '角色(Role)',
        ];
    }

    public static function getControllerByKey($key) {
        $result = '';
        $list = self::getControllerList();
        if (array_key_exists($key, $list)) {
            $result = $list[$key];
        }
        return $result;
    }


}
