<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $uid 用户id
 * @property int $type 1-手机 2-微信 3-QQ 4-email 5-地址
 * @property string $contact 联系方式
 * @property int $is_main 是否主要联系方式 0-否 1-是
 * @property int $create_uid 创建人id
 * @property int $update_uid 更新人id
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Contact extends \yii\db\ActiveRecord
{
    const TYPE_MOBILE = 1;
    const TYPE_WECHAT = 2;
    const TYPE_QQ = 3;
    const TYPE_EMAIL = 4;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'type', 'is_main', 'create_uid', 'update_uid', 'created_at', 'updated_at'], 'integer'],
            [['contact'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'type' => 'Type',
            'contact' => 'Contact',
            'is_main' => 'Is Main',
            'create_uid' => 'Create Uid',
            'update_uid' => 'Update Uid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getTypeList() {
        return [
            self::TYPE_MOBILE => '手机',
            self::TYPE_WECHAT => '微信',
            self::TYPE_QQ => 'QQ',
            self::TYPE_EMAIL => '邮箱',
        ];
    }

    public static function getTypeByKey($key) {
        $result = '';
        $list = self::getTypeList();
        if (array_key_exists($key, $list)) {
            $result = $result[$key];
        }

        return $result;
    }

    public function getContactHtmlForDetail($uid) {
        $models = Contact::find()->where(['uid' => $uid, 'is_delete' => Constants::IS_DELETE_NO])->orderBy(['type'=>SORT_ASC, 'is_main'=>SORT_DESC, 'id'=>SORT_ASC ])->asArray()->all();
        if (empty($models)) {
            return [];
        }

        $lastType = 0;

        $html = '';
        foreach ($models as $model) {
            if ($lastType != $model['type']) {
                $html .= '<div class="contact-unit">';
            }
            $result[$model['type']][] = $model;
        }

        print_r($result);exit;
    }

    public function getContactsForDetail($uid) {
        $models = Contact::find()->where(['uid' => $uid, 'is_delete' => Constants::IS_DELETE_NO])->orderBy(['type'=>SORT_ASC, 'is_main'=>SORT_DESC, 'id'=>SORT_ASC ])->asArray()->all();
        $result = [];
        $data = [];
        if (!empty($models)) {
            foreach ($models as $model) {
                $data[$model['type']][] = $model;
            }
        }

        foreach (self::getTypeList() as $typeK => $typeV) {
            if (!array_key_exists($typeK, $data)) {
                $row = [
                    'id' => 0,
                    'type_k' => $typeK,
                    'type' => $typeV,
                    'contact' => '',
                    'star_display' => false,
                    'empty_star_display' => false,
                    'edit_display' => false,
                    'remove_display' => false,
                    'plus_display' => true,
                ];
                //一个都没有,只有一行
                $result[$typeK][] = $row;
                continue;
            }

            //第一行
            $firstRow = true;
            foreach ($data[$typeK] as $dataRow) {
                $row = [
                    'id' => $dataRow['id'],
                    'type_k' => $typeK,
                    'type' => '',
                    'contact' => $dataRow['contact'],
                    'star_display' => false,
                    'empty_star_display' => false,
                    'edit_display' => true,
                    'remove_display' => true,
                    'plus_display' => false,
                ];

                if ($firstRow) {
                    $row['type'] = $typeV;
                    $row['plus_display'] = true;
                    $firstRow = false;
                }
                if ($dataRow['is_main']) {
                    $row['star_display'] = true;
                } else {
                    $row['empty_star_display'] = true;
                }
                $result[$typeK][] = $row;
            }
        }
print_r($result);exit;
        return $result;
    }
}
