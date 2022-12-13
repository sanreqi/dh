<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asd_diary".
 *
 * @property int $id 主键id
 * @property string|null $date 日期
 * @property string title 标题
 * @property string $content 内容
 * @property int $level 等级
 * @property string $bright 亮点
 * @property string $problem 问题
 * @property int $is_delete 是否删除 0-正常 1-删除
 * @property int $create_time 创建时间
 * @property int $update_time 修改时间
 */


class AsdDiary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asd_diary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['level', 'is_delete', 'create_time', 'update_time'], 'integer'],
            [['content'], 'string', 'max' => 8000],
            [['bright', 'problem'], 'string', 'max' => 1000],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'content' => 'Content',
            'level' => 'Level',
            'bright' => 'Bright',
            'problem' => 'Problem',
            'is_delete' => 'Is Delete',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
