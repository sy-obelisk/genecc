<?php
namespace app\modules\order\models;
use yii\db\ActiveRecord;
use app\modules\content\models\Category;
use app\modules\content\models\Content;
class FavourableActivity extends ActiveRecord {
    public static function tableName(){
        return '{{%favourable_activity}}';
    }

    /**
     * 获取优惠活动的范围内容
     * @Obelisk
     */
    public static function getContent($favourable){
        $content = [];
        if($favourable->rangeType == 2){
            $content = Category::find()->where("id in ($favourable->rangeExt)")->all();
        }
        if($favourable->rangeType == 3){
            $content = Content::find()->where("id in ($favourable->rangeExt)")->all();
        }
        return $content;
    }
}
