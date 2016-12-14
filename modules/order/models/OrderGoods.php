<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
class OrderGoods extends ActiveRecord {
    public static function tableName(){
        return '{{%order_goods}}';
    }
}
