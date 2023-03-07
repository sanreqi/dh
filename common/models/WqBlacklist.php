<?php


namespace common\models;

use common\helper\Tools;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "wq_blacklist".
 *
 * @property int $id
 * @property int $platform
 * @property int $type
 * @property string $username
 * @property int $created_at
 * @property int $updated_at
 */
class WqBlacklist extends \yii\db\ActiveRecord
{
    const PLATFORM_YEHU = 1;
    const PLATFORM_YICHENG = 2;

    const TYPE_UNKNOWN = 1;
    const TYPE_HUMAN = 2;
    const TYPE_DOG = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wq_blacklist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['platform', 'created_at', 'updated_at', 'is_delete', 'type'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform' => 'Platform',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getPlatformList() {
        return [
            self::PLATFORM_YEHU => '野狐围棋',
            self::PLATFORM_YICHENG => '弈城围棋',
        ];
    }

    public static function getPlatformByKey($key) {
        $result = '';
        $list = self::getPlatformList();
        if (array_key_exists($key, $list)) {
            $result = $list[$key];
        }
        return $result;
    }

    public static function getTypeList() {
        return [
            self::TYPE_UNKNOWN => '未知',
            self::TYPE_HUMAN => '人',
            self::TYPE_DOG => '狗',
        ];
    }

    public static function getTypeByKey($key) {
        $result = '';
        $list = self::getTypeList();
        if (array_key_exists($key, $list)) {
            $result = $list[$key];
        }
        return $result;
    }

    public function search($params, $count = false) {
        $query = new Query();
        $query->from('wq_blacklist')->where(['is_delete' => Constants::IS_DELETE_NO]);
        //keywords
        if (isset($params['username']) && !empty($params['username'])) {
            $query->andWhere(['like', 'username', $params['username']]);
        }

        if (isset($params['platform']) && !empty($params['platform'])) {
            $query->andWhere(['platform' => $params['platform']]);
        }

        if (isset($params['type']) && !empty($params['type'])) {
            $query->andWhere(['type' => $params['type']]);
        }

        if ($count) {
            return $query->count();
        }

        Tools::constructPage($query, $params);
        return $query->all();
    }

    public function createWqBlacklist($data) {
        $model = new WqBlacklist();
        $model->platform = $data['platform'];
        $model->type = $data['type'];
        $model->username = $data['username'];
        $description = trim($data['description']);
        if (!empty($description)) {
            $model->description = $description;
        }
        return $model->save();
    }

    public function updateWqBlacklist($data) {
        $model = WqBlacklist::find()->where(['id' => $data['id']])->one();
        $model->platform = $data['platform'];
        $model->type = $data['type'];
        $model->username = $data['username'];
        $description = trim($data['description']);
        if (!empty($description)) {
            $model->description = $description;
        }
        return $model->save();
    }
}
