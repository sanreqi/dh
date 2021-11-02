<?php

namespace app\models;

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
    const PROJECT_BACKEND = 1;

    const PROJECT_FRONTEND = 2;

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
}
