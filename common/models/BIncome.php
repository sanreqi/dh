<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "b_income".
 *
 * @property int $id
 * @property int $account_id b_account id
 * @property float $amount 收入金额
 * @property string $date 收入时间
 * @property string $remark 备注
 * @property int $is_delete
 * @property int $create_time
 * @property int $update_time
 */
class BIncome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b_income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id', 'is_delete', 'create_time', 'update_time'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'required'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'amount' => 'Amount',
            'time' => 'Time',
            'is_delete' => 'Is Delete',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
