<?php

namespace app\modules\cn\models;

use yii\db\ActiveRecord;

class DiscussPlate extends ActiveRecord
{
    public static function tableName(){
        return '{{%discuss_plate}}';
    }
}
