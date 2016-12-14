<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class IndexController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionPlay(){
//        $sdk = Yii::$app->request->get('sdk');
        return $this->renderPartial('play');
    }

}
