<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\modules\cn\models\Content;
class ShoppingCart extends ActiveRecord {
    public static function tableName(){
        return '{{%shopping_cart}}';
    }

    public function mergeCart(){
        $shopCart = \Yii::$app->session->get('shopCart');
        $userId = \Yii::$app->session->get('userId');
        if($shopCart){
            foreach($shopCart as $v){
                $sign = $this->find()->where("contentId = {$v['contentId']} AND userId=$userId")->one();
                if($sign){
                    $this->updateAll(['num' => ($sign->num+$v['num'])],"id=$sign->id");
                }else{
                    $this->contentId = $v['contentId'];
                    $this->num = $v['num'];
                    $this->userId = $userId;
                    $this->createTime = time();
                    $this->save();
                }
            }
            \Yii::$app->session->remove('shopCart');
        }
    }

}
