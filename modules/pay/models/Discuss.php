<?php
namespace app\modules\pay\models;
use yii\db\ActiveRecord;
class Discuss extends ActiveRecord {
    public static function tableName(){
        return '{{%user_discuss}}';
    }

}
