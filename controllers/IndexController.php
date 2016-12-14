<?php

namespace app\controllers;

use Yii;
use app\libs\ApiControl;


class IndexController extends ApiControl
{
    public function actionIndex()
    {
        $userId = Yii::$app->session->get('adminId');
        if(!$userId){
            $this->redirect('/user/login/index');
        }else{
            return $this->render('index');
        }
    }

}
