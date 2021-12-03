<?php


namespace backend\components;


class QiArrLogic
{

    private $qiArr = []; //1个
    private $allQiArr = []; //所有
    private $startX = 10;
    private $startY = 10;
    private $num = 4;

    public function run() {
        set_time_limit(0);
        $this->getAll();
    }

    private function getAll() {
        $qi = [$this->startX, $this->startY];
        $this->qiArr[] = $qi;
        $this->next([$this->startX * 10 + $this->startY => $qi]);
        $rQi = $this->qiUnique($this->allQiArr);
        print_r($this->myPrint($rQi));exit;
    }

    private function next($qiArr) {
        //左下角0,0起始
        //4个方向 左、上、右、下
        $canQi = [];
        foreach ($qiArr as $q) {
            $qi1 = [$q[0] - 1, $q[1]];
            $qi2 = [$q[0], $q[1] + 1];
            $qi3 = [$q[0] + 1, $q[1]];
            $qi4 = [$q[0], $q[1] - 1];

            $this->checkQi($qi1) && $canQi[$qi1[0] * 10 + $qi1[1]] = $qi1;
            $this->checkQi($qi2) && $canQi[$qi2[0] * 10 + $qi2[1]] = $qi2;
            $this->checkQi($qi3) && $canQi[$qi3[0] * 10 + $qi3[1]] = $qi3;
            $this->checkQi($qi4) && $canQi[$qi4[0] * 10 + $qi4[1]] = $qi4;
        }

        foreach ($canQi as $ck => $cq) {
            $tmpQiArr = $qiArr;
            $tmpQiArr[$ck] = $cq; //加一个
            $this->qiArr = $tmpQiArr;

            if (count($tmpQiArr) == $this->num) {
                //排序，再判断是否已经存在
                ksort($tmpQiArr);
                if (!in_array($tmpQiArr, $this->allQiArr)) {
                    $this->allQiArr[] = $tmpQiArr;
                }
                $this->qiArr = [];
            } else {
                $this->next($tmpQiArr);
            }
        }
    }


    private function checkQi($qi) {
        if (in_array($qi, $this->qiArr)) {
            return false;
        }

        return true;
    }

    private function myPrint($qiArr) {
        foreach ($qiArr as $v1) {
            $sArr = [];
            foreach ($v1 as $v2) {
                $x = $v2[0];
                $y = $v2[1];
                $sArr[] = '('.$x.','.$y.')';
            }
            $s = implode(',', $sArr);
            echo $s . "\n";
        }

        echo count($qiArr) . '个';

        exit;
    }

    //排序
    private function qiSort($qiArr) {
        $minK = 0;
        while (true) {
            $min = current($qiArr);
            foreach ($qiArr as $k => $v) {
                if ($this->compareQi($min, $v) != 0) {
                    $min = $v;
                    $minK = $k;
                }
            }

            $arr[] = $min;
            unset($qiArr[$minK]);
            if (empty($qiArr)) {
                return $arr;
            }
        }

        return $arr;
    }

    //优先比x
    //-1等于 1大于 0小于
    private function compareQi($qi1, $qi2) {
        if ($qi1[0] == $qi2[0] && $qi1[1] == $qi2[1]) {
            return -1;
        }

        if ($qi1[0] > $qi2[0] || ($qi1[0] == $qi2[0] && $qi1[1] > $qi2[1])) {
            return 1;
        }

        return 0;
    }

    //平移
    private function checkPingYi($qiArr1, $qiArr2) {
        //先排序
        ksort($qiArr1);
        $qiArr1 = array_values($qiArr1);
        $qiArr2 = array_values($qiArr2);

        $diffX = $qiArr1[0][0] - $qiArr2[0][0];
        $diffY = $qiArr1[0][1] - $qiArr2[0][1];

        for ($i=0; $i<$this->num; $i++) {
            if (($qiArr1[$i][0] - $qiArr2[$i][0] != $diffX) || ($qiArr1[$i][1] - $qiArr2[$i][1] != $diffY)) {
                return false;
            }
        }

        return true;
    }

    //3种旋转
    private function xuanZhuan($qiArr, $type) {
        $arr = [];
        if ($type == 0) {
            return $qiArr;
        }
        $ca = current($qiArr);
        $x = $ca[0];
        $y = $ca[1];
        foreach ($qiArr as $v) {
            $diffX = $v[0] - $x;
            $diffY = $v[1] - $y;

            if ($type == 1) {
                //左90
                $nx = $x - $diffY;
                $ny = $y + $diffX;
            } elseif ($type == 2) {
                //左180
                $nx = $x - $diffX;
                $ny = $y - $diffY;
            } elseif ($type == 3) {
                //左270
                $nx = $x + $diffY;
                $ny = $y - $diffX;
            }

            $qi = [$nx, $ny];
            $arr[$nx*10 + $ny] = $qi;
        }

        return $arr;
    }

    //对于中间 x=10对称
    private function duiCheng($qiArr) {
        $arr = [];
        foreach ($qiArr as $v) {
            $diffX = 10 - $v[0];
            $nx = 10 + $diffX;
            $ny = $v[1];
            $qi = [$nx, $ny];
            $arr[$nx*10 + $ny] = $qi;
        }

        return $arr;
    }

    private function checkSame($qiArr1, $qiArr2) {
        //8种情况，然后平移判断
        $cq[] = $this->xuanZhuan($qiArr1, 0);
        $cq[] = $this->xuanZhuan($qiArr1, 1);
        $cq[] = $this->xuanZhuan($qiArr1, 2);
        $cq[] = $this->xuanZhuan($qiArr1, 3);
        $cdq1 = $this->duiCheng($qiArr1);
        $cq[] = $this->xuanZhuan($cdq1, 0);
        $cq[] = $this->xuanZhuan($cdq1, 1);
        $cq[] = $this->xuanZhuan($cdq1, 2);
        $cq[] = $this->xuanZhuan($cdq1, 3);

        foreach ($cq as $v) {
            if ($this->checkPingYi($v, $qiArr2)) {
                return true;
            }
        }

        return false;
    }

    //去重
    private function qiUnique($qiArr) {
        $arr = [];
        foreach ($qiArr as $v1) {
            if (empty($arr)) {
                $arr[] = $v1;
                continue;
            }

            $flag = true;

            foreach ($arr as $v2) {
                if ($this->checkSame($v1, $v2)) {
                    $flag = false;
                    break;
                }
            }
            if ($flag) {
                $arr[] = $v1;
            }
        }

        return $arr;
    }

}