<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Login;

class UserController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 托福首页
     * @Obelisk
     */
    public function actionIndex(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $userId = Yii::$app->session->get('userId');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $model = new Login();
        $data = $model->findOne($userId);
        if($dataType == 'json'){
            $data = $data->attributes;
        }
        return $this->exitData(['data' => $data],$dataType,"index",2);
    }

    public function actionDeclare(){
        return $this->renderPartial('declare');
    }

}