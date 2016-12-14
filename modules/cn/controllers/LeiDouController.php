<?php
/**
 * 雷豆
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use yii;
use app\libs\ToeflController;
use app\libs\GoodsPager;

class LeiDouController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 托福首页
     * @Obelisk
     */
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }

    /**
     * 积分列表
     * @return string
     * @Obelisk
     */
    public function actionIndex(){
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $dataType = Yii::$app->request->get('data-type','arr');
        $page = Yii::$app->request->get('page',1);
        $pageSize = Yii::$app->request->get('pageSize',10);
        $type = Yii::$app->request->get('type',0);
        $limit = (($page-1)*$pageSize).",$pageSize";
        $where = '';
        if($type == 1){
            $where .= 'AND type=1';
        }
        if($type == 2){
            $where .= 'AND type=2';
        }
        $userData = $session->get('userData');
        $data = uc_user_integral($userData['userName'],"limit $limit",$where);
        if(!is_array($data['details'])){
            $data['details'] = [];
        }
        $pageModel = new GoodsPager($data['count'],$page,$pageSize,5);
        $pageStr = $pageModel->GetPagerContent();
        return $this->exitData(['userData' => $userData,'integral' => $data['integral'],'pageStr' => $pageStr,'details' => $data['details']],$dataType,'index',2);
    }

    /**
     * 积分用途
     * @return string
     * @Obelisk
     */
    public function actionUse(){
        return $this->render('use');
    }


}