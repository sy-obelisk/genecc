<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
class Consignee extends ActiveRecord {
    public static function tableName(){
        return '{{%user_consignee}}';
    }

}
