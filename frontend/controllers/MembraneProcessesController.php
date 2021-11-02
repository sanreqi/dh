<?php

namespace frontend\controllers;

use yii\web\Controller;

class MembraneProcessesController extends Controller
{
    public function actionIndex() {
        $this->layout = false;
        return $this->render('index');
    }
}