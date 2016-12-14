<?php
/**
 * 登录管理
 * Created by Obelisk.
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\cn\controllers;
use yii;
use yii\web\Controller;
use app\modules\cn\models\Login;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\libs\ToeflController;

class LoginController extends ToeflController {
    public $enableCsrfValidation = false;
    /**
     * 登陆界面
     * @return string
     */
    public function actionLogin(){
        $userId = Yii::$app->session->get('userId');
        if($userId){
            $this->redirect('/');
        }else{
            return $this->renderPartial('login');
        }
    }


    /**
     * 注册界面
     * @return string
     * */
    public function actionRegister()
    {
        $userId = Yii::$app->session->get('userId');
        if($userId){
            $this->redirect('/');
        }else{
            return $this->renderPartial('register');
        }
    }

    /**
     * 找回密码界面
     * @return string
     * */
    public function actionFound()
    {
        $userId = Yii::$app->session->get('userId');
        if($userId){
            $this->redirect('/');
        }else{
            return $this->renderPartial('found');
        }
    }

    /**
     * 短信快捷登录
     * @return string
     * */
    public function actionMessage()
    {
        $userId = Yii::$app->session->get('userId');
        if($userId){
            $this->redirect('/');
        }else{
            return $this->renderPartial('message');
        }
    }
    /**
     * 注销账户
     * @return string
     * */
    public function actionLoginOut()
    {
        $session    = Yii::$app->session;
        $session->remove('userName');
        $session->remove('userPass');
        $session->remove('userId');
        $this->redirect('/cn/login');
    }
}