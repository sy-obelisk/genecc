<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
class AdminDiscount extends ActiveRecord {
    public static function tableName(){
        return '{{%admin_discount}}';
    }

}
