<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
use app\modules\content\models\Content;
class CategoryTag extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%category_tag}}';
    }

    /**
     * 标签组
     * @param $catId
     * @return array
     * @Obelisk
     */
    public static function getCatTag($catId){
        $sql = "select ct.id,ca.name from {{%category_tag}} ct LEFT JOIN {{%category}} ca ON ct.tagCatId = ca.id WHERE ct.catId = $catId";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }

    /**
     *获取分类所有标签
     * @Obelisk
     */
    public function getAllTag($catId){
        $sql = "select ct.id,tagCatId,ca.name from {{%category_tag}} ct LEFT JOIN {{%category}} ca ON ct.tagCatId = ca.id WHERE ct.catId = $catId ORDER BY ct.id ASC";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $data[$k]['child'] = \Yii::$app->db->createCommand("select id,name from {{%content}} WHERE catId={$v['tagCatId']}")->queryAll();
        }
        return $data;
    }


}
