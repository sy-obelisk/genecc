<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
class ShoppingCart extends ActiveRecord {
    public static function tableName(){
        return '{{%shopping_cart}}';
    }


}
