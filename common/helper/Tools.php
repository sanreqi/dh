<?php
namespace common\helper;

use yii\base\Model;

class Tools {
    public static function getModelError(Model $model) {
        if (empty($model->getFirstErrors())) {
            return '';
        }

        $errors = array_values($model->getFirstErrors());
        return $errors[0];
    }

    public static function constructPage($query, $params)
    {
        if (isset($params['page']) && isset($params['pageSize'])) {
            $page = intval($params['page']);
            $pageSize = intval($params['pageSize']);
            $offset = ($page - 1) * $pageSize;
            $limit = $pageSize;
            $query->offset($offset)->limit($limit);
        }
        if (isset($params['page']) && isset($params['per-page'])) {
            $page = intval($params['page']);
            $pageSize = intval($params['per-page']);
            $offset = ($page - 1) * $pageSize;
            $limit = $pageSize;
            $query->offset($offset)->limit($limit);
        }
        return $query;
    }
}

//function exportExcel($filename, array $titles, array $dataArray, $bigTitle = '')
//{
//    // 后缀
//    $suffix = substr($filename, strrpos($filename, '.'));
//    empty($titles) && die('标题数组不能为空！');
//    //empty($dataArray) && die('数据数组不能为空！');
//    !in_array($suffix, ['.xls', '.xlsx']) && die('文件名格式错误！');
//
//    $oExcel = new \PHPExcel();
//    $oExcel->setActiveSheetIndex(0);
//    $sheet = $oExcel->getActiveSheet();
//
//    // 行索引
//    $rowIndex = $bigTitle != '' ? 2 : 1;
//
//    // 设置大标题
//    if ($bigTitle != '') {
//        $sheet->mergeCells('A1:' . chr(64 + count($titles)) . '1');
//        $sheet->getStyle('A1')->applyFromArray([
//            'font' => ['bold' => true],
//            'alignment' => ['horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
//        ]);
//        $sheet->setCellValue('A1', $bigTitle);
//    }
//
//    // 设置标题 A1 B1 C1 ....
//    $colIndex = 0;
//    $fieldsMap = [];
//    foreach ($titles as $key => $title) {
//        $fieldsMap[] = $key;
//        $sheet->setCellValue(chr(65 + $colIndex) . $rowIndex, $title);
//        $colIndex++;
//    }
//    // 设置内容 A1 B1 C1 ....   A2 B2 C2 ....
//    $rowIndex++;
//    foreach ($dataArray as $key => $value) {
//        foreach ($fieldsMap as $colIndex => $field) {
//            $sheet->setCellValue(chr(65 + $colIndex) . $rowIndex, $value[$field]);
//        }
//        $rowIndex++;
//    }
//
//    if ($suffix == '.xlsx') {
//        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//    } else {
//        header('Content-Type: application/vnd.ms-excel');
//    }
//    header('Content-Disposition: attachment;filename="' . $filename . '"');
//    $oWriter = \PHPExcel_IOFactory::createWriter($oExcel, 'Excel2007');
//    $oWriter->save('php://output');
//    $oExcel->disconnectWorksheets();
//    exit;
//}
