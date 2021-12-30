<?php
namespace common\behaviors;

use common\models\Constants;
use common\models\LogData;
use common\models\UserProject;
use Yii;
use yii\base\Behavior;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\AfterSaveEvent;
use yii\db\BaseActiveRecord;
use yii\web\NotFoundHttpException;

class LogBehavior extends Behavior
{

    private $beforeOldAttributes;

    private $logDataTable;

    private $uid;

    /**
     * @var ActiveRecord
     */
    public $ownerModel;

    public function events() {
        return
        [
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function initData() {
        $this->ownerModel = $this->owner;
        if (!($this->ownerModel instanceof ActiveRecord)) {
            throw new NotFoundHttpException();
        }
        $tableName = $this->ownerModel->tableName();
        if (!isset(Yii::$app->params['log_data_table'][$tableName])) {
            throw new NotFoundHttpException();
        }
        $this->uid = Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->getId();
        $this->logDataTable = Yii::$app->params['log_data_table'][$tableName];
        return true;
    }

    private function setLogData(LogData $model) {
        //@todo srq 有bug
        $model->uid = $this->uid;
        $model->module = $this->logDataTable['module'];
        $model->table = $this->logDataTable['table'];
        $model->table_key = (string) $this->ownerModel->primaryKey;
        $model->time = time();
    }

    public function afterInsert() {
        $this->initData();
        $model = new LogData();
        $this->setLogData($model);
        $model->type = LogData::TYPE_INSERT;
        $model->new_val = json_encode($this->ownerModel->attributes);
        $model->description = '创建' . $this->logDataTable['desc'];
        $model->save();
    }

    public function beforeUpdate() {
        $this->initData();
        $this->beforeOldAttributes = $this->ownerModel->oldAttributes;
    }

    public function afterUpdate(AfterSaveEvent $event) {
        $this->initData();
        $model = new LogData();
        $this->setLogData($model);
        $model->type = LogData::TYPE_UPDATE;
        $model->old_val = json_encode($this->beforeOldAttributes);
        $model->new_val = json_encode($this->ownerModel->attributes);
        if ($this->ownerModel->hasAttribute('is_delete') &&
            $this->ownerModel->getAttribute('is_delete') == Constants::IS_DELETE_YES) {
            //is_delete=1软删除
            $model->description = '删除' . $this->logDataTable['desc'];
        } else {
            $model->description = '修改' . $this->logDataTable['desc'];
        }
        if (!empty($event->changedAttributes)) {
            $model->change_attributes = implode(',', array_keys($event->changedAttributes));
        }
        $model->save();
    }

    public function beforeDelete() {
        $this->initData();
        $this->beforeOldAttributes = $this->ownerModel->oldAttributes;
    }

    public function afterDelete() {
        $this->initData();
        $model = new LogData();
        $this->setLogData($model);
        $model->type = LogData::TYPE_DELETE;
        $model->old_val = json_encode($this->beforeOldAttributes);
        $model->description = '删除' . $this->logDataTable['desc'];
        $model->save();
    }
}