<?php
namespace app\modules\pay\models;
use yii\db\ActiveRecord;
class UserCourse extends ActiveRecord {
    public static function tableName(){
        return '{{%user_course}}';
    }

}
