<?php

namespace backend\models\forms;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

//    public $fileName;

    public $name;

    public $physicalPath;

    public $webPath;

    private $errorMsg;


    public function rules()
    {
        return [
            //@todo
//            maxsize;
            //提示错误信息
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'jpeg', 'image/png', 'image/jpg', 'image/jpeg']],
        ];
    }

    public function getErrorMsg() {
        return $this->errorMsg;
    }

    /*
     * 上传文件
     */
    public function upload()
    {
        $dir = $this->createFolder();
        if ($dir === false) {
            $this->errorMsg = '文件夹创建失败';
            return false;
        }

        //文件名
        //替换原来的文件名称
        //@todo 数据库保存文件名 大小 类型等字段

        $this->physicalPath = $dir .'/' . $this->file->name . '.' . $this->file->extension;

//@todo        $this->fileName

        if (!$this->file->saveAs($this->physicalPath)) {
            $this->errorMsg = '文件上传失败';
            return false;
        }

        return true;

    }

    /*
     * 创建日期命名的文件夹
     */
    public function createFolder() {
        $date =  date('Ymd');

        //存入数据库
        $this->webPath = '/uploads/' . $date . '/' . $this->file->name . '.' . $this->file->extension;

        $date_dir = Yii::getAlias('@backend') . '/web/uploads/' . $date;

        if (!is_dir($date_dir)) {
            //需要先chmod777该文件夹
            @mkdir($date_dir, '0777');
        }

        if (is_dir($date_dir)) {
            return $date_dir;
        }

        return false;
    }
}