<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "page_content".
 *
 * @property int $id
 * @property int $page_id
 * @property int $type
 * @property string $value
 * @property int $template_order
 * @property int $is_delete
 * @property int $created_at
 * @property int $updated_at
 */
class PageContent extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_IMAGE = 3;
    const TYPE_EDITOR = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_content';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'type', 'template_order', 'is_delete', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'required'],
            [['value'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'type' => 'Type',
            'value' => 'Value',
            'template_order' => 'Template Order',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
