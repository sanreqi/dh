<?php

namespace common\models;

use common\helper\Tools;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "log_data".
 *
 * @property int $id
 * @property int $uid 用户id
 * @property string $project 项目名称
 * @property string $module 模块名称
 * @property int $type 类型 1-创建 2-修改 3-删除
 * @property string $table 数据库表名
 * @property string $table_key 主键
 * @property string $description 描述
 * @property string $old_val 老数据
 * @property string $new_val 新数据
 * @property strin $change_attributes 改变的字段
 * @property int $time 操作时间
 */
class LogData extends \yii\db\ActiveRecord
{
    const TYPE_INSERT = 1;
    const TYPE_UPDATE = 2;
    const TYPE_DELETE = 3;

    public static function getTypeList() {
        return [
            self::TYPE_INSERT => '新增',
            self::TYPE_UPDATE => '修改',
            self::TYPE_DELETE => '删除',
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

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'type', 'time'], 'integer'],
            [['project', 'module', 'table', 'table_key', 'description'], 'string', 'max' => 255],
            [['old_val', 'new_val'], 'string', 'max' => 4000],
            [['change_attributes'], 'string', 'max' => 1000],
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
            'project' => 'Project',
            'module' => 'Module',
            'type' => 'Type',
            'table' => 'Table',
            'table_key' => 'Table Key',
            'description' => 'Description',
            'old_val' => 'Old Val',
            'new_val' => 'New Val',
            'time' => 'Time',
        ];
    }

    public function getLogDataTableArr($key) {
        $logDataTable = array_values(Yii::$app->params['log_data_table']);
        if (!isset($logDataTable[0][$key])) {
            return [];
        }
        return array_column($logDataTable, $key);
    }

    //6个搜索字段
    public function search($params, $count = false) {
        $query = new Query();
        $query->from('log_data');
//        if (isset($params['type'])) {
//            $query->andWhere(['type' => $params['type']]);
//        }
//        if (isset($params['name'])) {
//            $query->andWhere(['name' => $params['name']]);
//        }
        if ($count) {
            return $query->count();
        }
        Tools::constructPage($query, $params);
        $data = $query->all();
        return $this->convertData($data);
    }

    public function convertData($data) {
        if (empty($data)) {
            return [];
        }

        foreach ($data as &$v) {
            $v['username'] = User::findByIdAttr($v['uid'], 'username');
            $v['type'] = self::getTypeByKey($v['type']);
            $v['time'] = date('Y-m-d', $v['time']);
        }

        return $data;
    }


}
