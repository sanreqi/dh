<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "taxonomy".
 *
 * @property int $id 主键id
 * @property int $parent_id 父类id
 * @property string $node 节点名称
 * @property int $sort 排序
 * @property int $level 层级
 * @property int $is_leaf 是否叶子节点 0-不是 1-是
 * @property int $create_time 创建时间
 * @property int $update_time 修改时间
 */
class Taxonomy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taxonomy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort', 'level', 'is_leaf', 'create_time', 'update_time'], 'integer'],
            [['node'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'node' => 'Node',
            'sort' => 'Sort',
            'level' => 'Level',
            'is_leaf' => 'Is Leaf',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
