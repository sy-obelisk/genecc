<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class OrderGoods extends ActiveRecord {
    public static function tableName(){
        return '{{%order_goods}}';
    }

    /**
     * 获取已购人员
     * @Obelisk
     */
    public function getBought($id){
        $sql = "select u.userName,u.nickname,u.image from {{%order_goods}} og LEFT JOIN {{%user_order}} o on o.id=og.orderId LEFT JOIN {{%user}} u ON u.id=og.userId LEFT JOIN {{%content}} c ON c.id=og.contentId WHERE o.status>2 AND c.pid=$id GROUP BY og.userId ORDER BY og.createTime DESC";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function getAllEvaluate($orderId){
        $sql = "select c.name,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price,c.image,c.pid,og.createTime,ud.id,og.contentId from {{%order_goods}} og LEFT JOIN {{%user_discuss}} ud ON og.contentId=ud.contentId AND og.orderId=ud.orderId LEFT JOIN {{%content}} c on c.id=og.contentId WHERE og.orderId=$orderId";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
}
