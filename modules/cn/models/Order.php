<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Pager;
class Order extends ActiveRecord {
    public static function tableName(){
        return '{{%user_order}}';
    }
}
