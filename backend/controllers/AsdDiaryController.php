<?php

namespace backend\controllers;
use backend\services\AsdDiaryService;
use common\models\AsdDiary;
use common\models\WqBlacklist;
use Yii;
use yii\data\Pagination;

class AsdDiaryController extends BaseController
{
    public function actionIndex() {
        $url = Yii::$app->request->url;
        $params = Yii::$app->request->getQueryParams();
        $pageSize = isset($params['per-page']) && !empty($params['per-page']) ? $params['per-page'] : 10;
        $service = new AsdDiaryService();
        $result = $service->pageList($params);
        $data = $result['data'];
        $count = $result['count'];
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        return $this->render('index', ['data' => $data, 'count' => $count, 'pages' => $pages, 'params' => $params]);
    }

    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        $service = new AsdDiaryService();
        $result = $service->delete($id);
        if ($result) {
            $this->successAjax();
        } else {
            $this->errorAjax($service->getErrMsg());
        }
    }

    public function actionForm() {
        $params = Yii::$app->request->getQueryParams();
        if (isset($params['id']) && !empty($params['id'])) {
            $model = AsdDiary::find()->where(['is_delete'=>0, 'id'=>$params['id']])->one();
            if (empty($model)) {
                $this->errorAjax('参数id不正确');
            }
        } else {
            $model = new AsdDiary();
        }

        $model->date = !empty($model->date) ? date('Y-m-d', strtotime($model->date)) : date('Y-m-d');
        $model->level = !empty($model->level) ? $model->level : 1;

        $title = $model->isNewRecord ? '创建日记' : '编辑日记';
        return $this->render('form', ['model' => $model, 'title' => $title, 'content' => $model->content]);
    }

    public function actionCreateUpdate() {
        $params = Yii::$app->request->post();
        $service = new AsdDiaryService();
        $result = $service->createUpdate($params);
        if (false === $result) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax();
        }
    }

    public function actionDetail() {
        $params = Yii::$app->request->getQueryParams();
        if (!isset($params['id']) && empty($params['id'])) {
            $this->errorAjax('参数id不能为空');
        }
        $model = AsdDiary::find()->where(['is_delete'=>0, 'id'=>$params['id']])->asArray()->one();
        if (empty($model)) {
            $this->errorAjax('参数id不正确');
        }
        $model['date'] = date('Y-m-d', strtotime($model['date']));
        $weekDays = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
        $time = strtotime($model['date']);
        $title = !empty($model['title']) ? $model['title'] : date('Y年m月d日', $time) . ' ' . $weekDays[date('w',$time)];
        return $this->render('detail',['model'=>$model, 'title'=>$title]);
    }

    public function actionTest() {
        return $this->render('test');
    }

    public function actionGetJson() {


        $data = '[{
	"id": 1,
	"text": "My Documents",
	"children": [{
		"id": 11,
		"text": "Photos",
		"state": "closed",
		"children": [{
			"id": 111,
			"text": "Friend"
		}, {
			"id": 112,
			"text": "Wife"
		}, {
			"id": 113,
			"text": "Company"
		}]
	}, {
		"id": 12,
		"text": "Program Files",
		"children": [{
			"id": 121,
			"text": "Intel"
		}, {
			"id": 122,
			"text": "Java",
			"attributes": {
				"p1": "Custom Attribute1",
				"p2": "Custom Attribute2"
			}
		}, {
			"id": 123,
			"text": "Microsoft Office"
		}, {
			"id": 124,
			"text": "Games",
			"checked": true
		}]
	}, {
		"id": 13,
		"text": "index.html"
	}, {
		"id": 14,
		"text": "about.html"
	}, {
		"id": 15,
		"text": "welcome.html"
	}]
}]';
        echo $data;
        exit;
    }

}
