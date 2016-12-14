<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
class Old extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%old}}';
    }

}
