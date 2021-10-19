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

    public $folderName;

    private $errorMsg;


    public function rules()
    {
        return [
            //@todo
            //提示错误信息
//            'maxSize' => '4M'
            [['file'], 'file', 'skipOnEmpty' => false,
                'extensions' => ['png', 'jpg', 'jpeg', 'image/png', 'image/jpg', 'image/jpeg'],
                'checkExtensionByMimeType' => false, 'maxSize' => 2*1024*1024*1024],

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
        //$this->file->name

        $fileName = time() . '_' . getRandString(6) . '.' . $this->file->extension;
        $this->physicalPath = $dir .'/' . $fileName;
        $this->webPath = '/uploads/' . $this->folderName . '/' . $fileName;

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
        $date =  date('Ym');
        $this->folderName = $date;
        //存入数据库
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