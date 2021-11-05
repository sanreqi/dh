<?php

namespace common\models;

use PhpOffice\PhpSpreadsheet\IOFactory;
use yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadExcelFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $excel_file;
    
    public $file_path;
    
    protected $format;
    
    public static function imporUrl() {
        return Yii::getAlias(Yii::$app->params['upload_excel_config']['api_url']);
    }
    
    public function upload()
    {
        if (!is_dir(self::imporUrl())) {
            mkdir(self::imporUrl(), 0777, true);
        }
        $this->excel_file = UploadedFile::getInstanceByName('excel_file');
        $this->file_path = self::imporUrl() . DIRECTORY_SEPARATOR .
            md5($this->excel_file->baseName) . '_' . date('YmdHis') . '.' .
            $this->excel_file->extension;
        $this->excel_file->saveAs($this->file_path);
        return true;
    }
    
    /**
     * reading the xls file
     */
    public function readFile() {
        $sheetDatas = [];
        if ($this->excel_file->extension == 'json') {
            $file = file_get_contents($this->file_path);
            $aFielData = explode("\n",$file);
            if (!empty($aFielData)) {
                foreach ($aFielData as $temp) {
                    $sheetDatas[] = json_decode($temp,true);
                }
            }
        } else {
            $this->format = IOFactory::identify($this->file_path);
            $objectreader = IOFactory::createReader($this->format);
            if ($this->format == "Csv") {
                $objectreader->setDelimiter(',');
                $objectreader->setInputEncoding('GBK');
            }
            $objectPhpExcel = $objectreader->load($this->file_path);
            $sheetDatas = $objectPhpExcel->getActiveSheet()->toArray(null, true, true, true);
            $sheetDatas = $this->executeArrayLabel($sheetDatas);
        }
        
        return $sheetDatas;
    }
    /**
     * Setting label or keys on every record if setFirstRecordAsKeys is true.
     * @param array $sheetData
     * @return multitype:multitype:array
     */
    public function executeArrayLabel($sheetData) {
        $keys = yii\helpers\ArrayHelper::remove($sheetData, '1');
        
        $new_data = [];
        
        foreach ($sheetData as $values) {
            $new_data[] = array_combine($keys, $values);
        }
        
        return $new_data;
    }
}