<?php
namespace app\modules\pay\models;
use yii\db\ActiveRecord;
class ShoppingCart extends ActiveRecord {
    public static function tableName(){
        return '{{%shopping_cart}}';
    }

    /**
     * 获取购物车列表
     * @Obelisk
     */
    public function getCart($where=""){
        $userId = \Yii::$app->session->get('userId');
        $sql = "select sc.createTime,c.image,ca.name as catName,ca.id as catId,c.name as contentName,sc.num,sc.contentId,sc.id,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=sc.contentId AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price from {{%shopping_cart}} sc LEFT JOIN {{%content}} c ON sc.contentId=c.id LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE sc.userId=$userId $where";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }

    /**
     * 获取购物车列表
     * @Obelisk
     */
    public function getGoods($id){
        $sql = "select c.id as contentId,c.image,ca.name as catName,ca.id as catId,c.name as contentName,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price from  {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.id=$id";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }


}
