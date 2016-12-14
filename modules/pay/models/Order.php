<?php
namespace app\modules\pay\models;
use app\modules\user\models\UserDiscuss;
use yii\db\ActiveRecord;
use app\libs\GoodsPager;
use app\libs\Pager;
class Order extends ActiveRecord {
    public static function tableName(){
        return '{{%user_order}}';
    }

    public function getAllOrder($userId,$pageSize,$page,$status=""){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        if($status){
            if($status == 1){
                $status = 'AND uo.status = 1';
            }
            if($status == 2){
                $status = 'AND uo.status > 2';
            }
        }
        $sql = "select uo.*,oc.name as consigneeName from {{%user_order}} uo LEFT JOIN {{%order_consignee}} oc ON oc.orderId=uo.id WHERE uo.userId=$userId $status order by uo.createTime DESC $limit";
        $count = "select uo.*,oc.name as consigneeName from {{%user_order}} uo LEFT JOIN {{%order_consignee}} oc ON oc.orderId=uo.id WHERE uo.userId=$userId $status order by uo.createTime DESC";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k => $v){
            $data[$k]['goods'] = OrderGoods::find()->where('orderId='.$v['id'])->all();
            $data[$k]['reviews'] = 1;
            foreach($data[$k]['goods'] as $val){
                $sign = UserDiscuss::find()->where("contentId = {$val['contentId']} AND orderId = {$v['id']}")->one();
                if(!$sign){
                    $data[$k]['reviews'] = 0; break;
                }
            }
        }
        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
        $pageModel = new GoodsPager($count,$page,$pageSize,5);
        $pageStr = $pageModel->GetPagerContent();
        return ['data' => $data,'pageStr' => $pageStr];
    }

    public function getOrderDetails($orderId){
        $sql = "select uo.*,oc.name as consigneeName,oc.address as address,oc.phone as phone from {{%user_order}} uo LEFT JOIN {{%order_consignee}} oc ON oc.orderId=uo.id WHERE uo.id=$orderId";
        $data = \Yii::$app->db->createCommand($sql)->queryOne();
        $data['goods'] = OrderGoods::find()->asArray()->where("orderId=$orderId")->all();
        return $data;
    }

    public function getAllClass($userId,$pageSize,$page){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $status = 'AND uo.status > 2';
        $sql = "select og.*,(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=og.contentId AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as commencement,(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=og.contentId AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as teacher from {{%order_goods}} og LEFT JOIN {{%user_order}} uo ON og.orderId=uo.id LEFT JOIN {{%content}} c on c.id=og.contentId WHERE c.catId=155 AND uo.userId=$userId $status order by uo.createTime DESC $limit";
        $count = "select og.* from {{%order_goods}} og LEFT JOIN {{%user_order}} uo ON og.orderId=uo.id LEFT JOIN {{%content}} c on c.id=og.contentId WHERE c.catId=155 AND  uo.userId=$userId $status order by uo.createTime DESC";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
        $pageModel = new Pager($count,$page,$pageSize);
        $pageStr = $pageModel->GetPagerContent();
        return ['data' => $data,'pageStr' => $pageStr];
    }

}
