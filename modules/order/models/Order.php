<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
use app\modules\order\models\Consignee;
use app\modules\order\models\AdminDiscount;
class Order extends ActiveRecord {
    public static function tableName(){
        return '{{%user_order}}';
    }

    public function getAllOrder($where,$pageSize,$page){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select uo.* from {{%user_order}} uo LEFT JOIN {{%user}} u ON uo.userId=u.id WHERE $where ORDER BY createTime DESC $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $count = count(\Yii::$app->db->createCommand("select uo.* from {{%user_order}} uo LEFT JOIN {{%user}} u ON uo.userId=u.id WHERE $where ORDER BY createTime")->queryAll());
        foreach($data as $k=>$v){
            $disCount = 0;
            $disReason = "";
            if($v['type'] == 1){
                $consignee = OrderConsignee::find()->where("orderId={$v['id']}")->one();
                if($consignee){
                    $data[$k]['consignee'] = $consignee->name.'-'.$consignee->address.'-'.$consignee->phone;
                }else{
                    $data[$k]['consignee'] = '';
                }
            }else{
                $data[$k]['consignee'] = '雷豆';
            }
            $discount = AdminDiscount::find()->where("orderId={$v['id']}")->all();
            foreach($discount as $v){
                $disCount += ($v['money']);
                $disReason .= $v['reason'].';';
            }
            $data[$k]['disCount'] = $disCount;
            $data[$k]['disReason'] = $disReason;
        }
        return ['data' => $data,'count' => $count];
    }

}
