<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "b_account".
 *
 * @property int $id
 * @property int $uid
 * @property string $name 账户名称
 * @property string account 账户号
 * @property float $amount 金额
 * @property int $is_delete
 * @property int $create_time
 * @property int $update_time
 */
class BAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['is_delete', 'create_time', 'update_time', 'uid'], 'integer'],
            [['name', 'account'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'account' => 'Account',
            'amount' => 'Amount',
            'is_delete' => 'Is Delete',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
