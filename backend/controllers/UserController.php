<?php

namespace backend\controllers;
use backend\components\QiArrLogic;
use common\helper\Tools;
use common\models\Constants;
use common\models\UserInfo;
use common\models\UserProject;
use common\services\RbacService;
use common\services\UserService;
use Yii;
use backend\models\forms\UserForm;
use common\models\User;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class UserController extends BaseController
{

    public function actionIndex() {
        $params = Yii::$app->request->get();
        $search['username'] = Yii::$app->request->get('username', '');
        $search['truename'] = Yii::$app->request->get('truename', '');
        $model = new User();
        $models = $model->search($params);
        $count = $model->search($params, true);
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_user_modal', ['model' => []]);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }

        $model = User::find()->where(['id' => $id, 'status' => User::STATUS_ACTIVE])->one();
        if (empty($model)) {
            $this->errorAjax('用户不存在');
        }

        $html = $this->renderPartial('_user_modal', ['model' => $model]);
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        $model = new UserForm();
        $model->scenario = 'create';
        $model->load($post);
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }

        if ($model->createUser()) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }
        $post = Yii::$app->request->post();
        $model = new UserForm();
        $model->scenario = 'update';
        $model->load($post);
        $model->id = $id;
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }

        if ($model->updateUser()) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (empty($id)) {
            $this->errorAjax('非法请求');
        }

        $model = User::find()->where(['id' => $id, 'status' => User::STATUS_ACTIVE])->one();
        if (empty($model)) {
            $this->errorAjax('非法请求');
        }

        if ($model->username == 'admin') {
            $this->errorAjax('超级管理员不能删除');
        }

        $model->status = User::STATUS_DELETED;
        $model->is_delete = Constants::IS_DELETE_YES;
        if ($model->save()) {
            $this->successAjax();
        } else {
            $this->errorAjax('删除失败');
        }
    }

    /**
     * 用户详情
     */
    public function actionDetail() {
        $uid = Yii::$app->request->get('uid');
        $user = User::findIdentity($uid);
        if (empty($user)) {
            throw new HttpException();
        }
        $user->syncUserToInfo();
        return $this->render('detail', ['uid' => $uid]);
    }

    /**
     * 基本信息卡片
     * @throws NotFoundHttpException
     */
    public function actionGetBasicViewHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::find()->where(['id' => $uid])->one();
        $userInfo = UserInfo::find()->where(['uid' => $uid])->one();
        //user和userInfo一定会同时存在
        if (empty($user) || empty($userInfo)) {
            throw new NotFoundHttpException();
        }

        $html = $this->renderPartial('_basic', ['user' => $user, 'userInfo' => $userInfo]);
        $this->successAjax(['html' => $html]);
    }

    public function actionGetBasicFormHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::find()->where(['id' => $uid])->one();
        $userInfo = UserInfo::find()->where(['uid' => $uid])->one();
        //user和userInfo一定会同时存在
        if (empty($user) || empty($userInfo)) {
            throw new NotFoundHttpException();
        }

        $userInfo->setInfoByIdentityCard();

        $html = $this->renderPartial('_basic_form', ['user' => $user, 'userInfo' => $userInfo]);
        $this->successAjax(['html' => $html]);
    }


    public function actionGetRoleFormHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $assignRoleNames = [];
        $roles = [];
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $assignments = $auth->getAssignments($uid);
        if (!empty($assignments)) {
            foreach ($assignments as $assignment) {
                $assignRoleNames[] = $assignment->roleName;
            }
        }
        if (!empty($allRoles)) {
            foreach ($allRoles as $role) {
                $tmp['name'] = $role->name;
                $tmp['checked'] = in_array($role->name, $assignRoleNames) ? 'checked' : '';
                $roles[] = $tmp;
            }
        }
        $html = $this->renderPartial('_role_form', ['roles' => $roles, 'uid' => $uid]);
        $this->successAjax(['html' => $html]);
    }

    public function actionGetRoleViewHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $roles = [];
        $auth = Yii::$app->authManager;
        $assignments = $auth->getAssignments($uid);
        foreach ($assignments as $assignment) {
            $roles[] = $assignment->roleName;
        }
        $roleNames = !empty($roles) ? implode(',', $roles) : '暂无角色';
        $html = $this->renderPartial('_role', ['roleNames' => $roleNames, 'uid' => $uid]);
        $this->successAjax(['html' => $html]);
    }

    public function actionAssignRole() {
        $post = Yii::$app->request->post();
        if (!isset($post['uid']) || empty($post['uid'])) {
            $this->errorAjax('非法请求');
        }
        $uid = $post['uid'];
        $roleNames = isset($post['roles']) ? $post['roles'] : [];
        $service = new RbacService();
        $service->assignRoles($uid, $roleNames);
        $this->successAjax();
    }

    public function actionSaveBasic() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::findIdentity($uid);
        if (empty($user)) {
            $this->errorAjax('非法请求');
        }
        $post = Yii::$app->request->post();
        if (!isset($post['truename']) || empty(trim($post['truename']))) {
            $this->errorAjax('姓名必填');
        }
        if (isset($post['identity_card']) && !empty(trim($post['identity_card']))) {
            $identityCard = trim($post['identity_card']);
            if (!Tools::checkIdentity($identityCard)) {
                $this->errorAjax('身份证填写错误');
            }
        }

        if ($user->saveDetailBasic($post)) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionGetProjectViewHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::findIdentity($uid);
        if (empty($user)) {
            $this->errorAjax('非法请求');
        }
        $userProject = UserProject::find()->where(['uid' => $uid])->all();
        $project = [];
        if (!empty($userProject)) {
            foreach ($userProject as $v) {
                $project[] = UserProject::getProjectByKey($v->project);
            }
        }
        $projectStr = !empty($project) ? implode(',', $project) : '暂无项目权限';
        $html = $this->renderPartial('_project', ['projectStr' => $projectStr]);
        $this->successAjax(['html' => $html]);
    }


    public function actionGetProjectFormHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::findIdentity($uid);
        if (empty($user)) {
            $this->errorAjax('非法请求');
        }

        $projects = [];
        foreach (UserProject::getProjectList() as $k => $v) {
            //循环查询问题不大
            $userProject = UserProject::find()->where(['uid' => $uid, 'project' => $k])->one();
            $tmp['key'] = $k;
            $tmp['val'] = $v;
            $tmp['checked'] = !empty($userProject) ? 'checked' : '';
            $projects[] = $tmp;
        }

        $html = $this->renderPartial('_project_form', ['projects' => $projects]);
        $this->successAjax(['html' => $html]);
    }

    public function actionSaveProject() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $user = User::findIdentity($uid);
        if (empty($user)) {
            $this->errorAjax('非法请求');
        }

        $projects = Yii::$app->request->post('projects', []);
        $model = new UserProject();
        $model->saveDetailProject($uid, $projects);
        $this->successAjax();
    }


    public function actionTest() {
        return $this->render('test');
    }
}