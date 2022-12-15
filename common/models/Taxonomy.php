<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "taxonomy".
 *
 * @property int $id 主键id
 * @property int $parent_id 父类id
 * @property int $root_id 根节点id
 * @property string $name 节点名称
 * @property int $sort 排序
 * @property int $level 层级
 * @property int $is_leaf 是否叶子节点 0-不是 1-是
 * @property int $is_delete 是否删除 0-正常 1-删除
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
            [['parent_id', 'root_id', 'sort', 'level', 'is_delete', 'is_leaf', 'create_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'Name' => 'name',
            'sort' => 'Sort',
            'level' => 'Level',
            'is_leaf' => 'Is Leaf',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
