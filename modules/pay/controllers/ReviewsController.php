<?php
/**
 * 购物车管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\pay\controllers;

use app\modules\cn\models\Content;
use app\modules\cn\models\OrderGoods;
use app\modules\cn\models\UserDiscuss;
use app\modules\pay\models\ShoppingCart;
use yii;
use app\libs\ToeflController;

class ReviewsController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';

    /**
     * 评价
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $request = Yii::$app->request;
        $userId = $session->get('userId');
        $orderId = $request->get('orderId');
        $model = new OrderGoods();
        $data = $model->getAllEvaluate($orderId);
        return $this->exitData(['data' => $data,'orderId' => $orderId],'arr',"index",2);
    }

    /**
     * 删除购物车
     * @return string
     * @Obelisk
     */
    public function actionDelete()
{
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $contentId = Yii::$app->request->get('contentId');
        if($userId){
            ShoppingCart::deleteAll("userId=$userId AND contentId=$contentId");
        }else{
            $shopCart = $session->get('shopCart');
            if($shopCart){
                foreach($shopCart as $k => $v){
                    if($contentId == $v['contentId']){
                        unset($shopCart[$k]);
                    }
                }
                $session->set('shopCart',$shopCart);
            }
        }
        $this->redirect('/shopping-cart.html');
    }

    /**
     * 添加成功
     * @Obelisk
     */
    public function actionSuccess(){
        return $this->render('success');
    }
}