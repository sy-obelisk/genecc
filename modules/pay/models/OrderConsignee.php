<?php
namespace app\modules\pay\models;
use yii\db\ActiveRecord;
class OrderConsignee extends ActiveRecord {
    public static function tableName(){
        return '{{%order_consignee}}';
    }

}