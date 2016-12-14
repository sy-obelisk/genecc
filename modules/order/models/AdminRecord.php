<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
class AdminRecord extends ActiveRecord {
    public static function tableName(){
        return '{{%admin_record}}';
    }
}
