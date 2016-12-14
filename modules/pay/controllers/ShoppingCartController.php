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
use app\modules\pay\models\ShoppingCart;
use yii;
use app\libs\ToeflController;

class ShoppingCartController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';

    /**
     * 购物车列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $dataType = Yii::$app->request->get('data-type','arr');
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $tag = "";
        $model = new ShoppingCart();
        $contentModel = new Content();
        if($userId){
            $shopCart = $model->getCart();
            foreach($shopCart as $k=>$v){
                $sql = "select c.name from {{%content_tag}} ct LEFT JOIN {{%content}} c ON ct.tagContentId=c.id WHERE ct.contentId={$v['contentId']}";
                $data = Yii::$app->db->createCommand($sql)->queryAll();
                foreach($data as $val){
                    $tag .= ($val['name'].' ');
                }
                $shopCart[$k]['tag'] = $tag;
                $tag = "";
            }
        }else{
            $shopCart = $session->get('shopCart');
            if($shopCart){
                foreach($shopCart as $k=>$v){
                    $content = Content::findOne($v['contentId']);
                    $sql = "select c.name from {{%content_tag}} ct LEFT JOIN {{%content}} c ON ct.tagContentId=c.id WHERE ct.contentId={$v['contentId']}";
                    $data = Yii::$app->db->createCommand($sql)->queryAll();
                    foreach($data as $val){
                        $tag .= ($val['name'].' ');
                    }
                    $price = $contentModel->getClass(['fields' => 'price','where' => "c.id={$v['contentId']}"]);
                    $shopCart[$k]['price'] = $price[0]['price'];
                    $shopCart[$k]['contentName'] = $content->name;
                    $shopCart[$k]['image'] = $content->image;
                    $shopCart[$k]['tag'] = $tag;
                    $tag = "";
                }
            }else{
                $shopCart = [];
            }
        }
        return $this->exitData(['shopCart' => $shopCart],$dataType,"index",2);
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