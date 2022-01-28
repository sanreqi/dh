<?php
namespace api\common\helpers;


/**
 * author:hollis
 * des:
 * datetime:2020 2020-04-17 14:47
 */
class ExportCsv{

    protected $titles;

    /**
     * author:srq
     * des:构造对象
     * datetime:2020 2020-04-17 19:19
     */
    public function makeFp($titles=[],$fileName){
        set_time_limit ( 0 );
        ini_set('memory_limit', '1024M'); //设置程序运行的内存
        ini_set('max_execution_time', 0); //设置程序的执行时间,0为无上限
        ob_end_clean();  //清除内存
        ob_start();
        header("Content-Type: text/csv");
        header("Content-Disposition:filename=" . $fileName . '.csv');
        $fp = fopen('php://output', 'w');
        fwrite($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        $this->titles = $titles;
        fputcsv($fp, $this->titles);
        return $fp;
    }

    /**
     * author:srq
     * des:写入数据
     * datetime:2020 2020-04-17 19:19
     */
    public function exportData($fp,$list)
    {
        foreach ($list as $key => $line) {
            fputcsv($fp, $line);
        }
        ob_flush();//清除内存
        flush();
    }


    /**
     * author:srq
     * des:结构
     * datetime:2020 2020-04-17 19:19
     */
    public function end(){
        ob_end_clean();
        exit();
    }

    //示例
    public function export($params, $titles, $filename) {
        $header = array_values($titles);
        $exportCsv = new ExportCsv();
        $fp = $exportCsv->makeFp($header, $filename);
        $page = 0;
        while (true) {
            $page ++;
            if ($page > 200) {
                break;
            }
            $params['per_page'] = 50;
            $params['page'] = $page;
            $result = $this->getExportList($params);
            if (empty($result)) {
                break;
            }
            $newDataList = [];
            foreach ($result as $v) {
                $newDataList[] = $v;
            }
            $exportCsv->exportData($fp, $newDataList);
        }
        $exportCsv->end();
    }

    public function export($params) {
        $titles = self::getExportTitlte();
        $fields = array_keys($titles);
        $header = array_values($titles);

        $exportCsv = new ExportCsv();
        $filename = '医学隔离点' . date('Ymd_His');
        $fp = $exportCsv->makeFp($header, $filename);
        $page = 0;
        while (true) {
            $page ++;
            if ($page > 100) {
                break;
            }
            $params['per_page'] = 50;
            $params['page'] = $page;
            $result = $this->getList($params);

            if (!isset($result['data']) || empty($result['data'])) {
                break;
            }
            $newDataList = [];
            foreach ($result['data'] as $data) {
                $line = [];
                foreach ($fields as $field) {
                    $line[$field] = isset($data[$field]) ? $data[$field] . "\t" : '';
                }
                $newDataList[] = $line;
            }
            $exportCsv->exportData($fp, $newDataList);
        }
        $exportCsv->end();
    }

    public function getExportTitle() {
        $titles = [
            'district_name' => '所属区',
            'street_name' => '所属街道',
            'name' => '集中隔离点名称',
            'address' => '集中隔离点地址',
            'rooms_number' => '最大可容纳房间数',
            'room_total_count' => '房间总数',
            'room_isolation_total_count' => '隔离人员用房总数',
            'room_isolation_free_count' => '隔离人员可用房间数',
            'room_isolation_disinfect_count' => '隔离房源消毒房间数',
            'room_staff_total_count' => '工作人员用房总数',
            'state' => '隔离点状态',
            'contacts'=>'联系人',
            'contact_number' => '联系电话',
            'isolation_point_type' => '隔离点属性',
            'tags' => '隔离对象类型',
        ];

        return $titles;
    }

}