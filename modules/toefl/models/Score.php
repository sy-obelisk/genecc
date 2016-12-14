<?php
namespace app\modules\toefl\models;
use yii\db\ActiveRecord;
class Score extends ActiveRecord {
    public static function tableName(){
        return '{{%tf_score}}';
    }
}
