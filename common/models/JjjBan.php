<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "taxonomy".
 *
 * @property int $id
 * @property string $keyword
 * @property int degree
 * @property int is_delete
 * @property int create_time
 * @property int update_time
 */
class JjjBan extends \yii\db\ActiveRecord
{
    const DEGREE_NONE = 0;
    const DEGREE_LOW = 1;
    const DEGREE_MIDDLE = 2;
    const DEGREE_HIGH = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jjj_ban';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['keyword','degree','is_delete','create_time','update_time',],'safe']
        ];
    }

    public static function getDegreeList() {
        return [
            self::DEGREE_NONE => '无',
            self::DEGREE_LOW => '低',
            self::DEGREE_MIDDLE => '中',
            self::DEGREE_HIGH => '高',
        ];
    }

    public static function getDegreeByKey($key) {
        $result = '';
        $list = self::getDegreeList();
        if (array_key_exists($key, $list)) {
            $result = $list[$key];
        }
        return $result;
    }

}
