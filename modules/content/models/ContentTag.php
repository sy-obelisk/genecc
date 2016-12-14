<?php 
namespace app\modules\content\models;
use yii\db\ActiveRecord;
class ContentTag extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%content_tag}}';
    }

    /**
     * 获取内容标签
     * @Obelisk
     */
    public function getAllTag($contentId){
        $sql = "select ct.id,ca.name,tagCatId,tagContentId from {{%content_tag}} ct LEFT JOIN {{%category}} ca ON ct.tagCatId=ca.id WHERE contentId=$contentId AND ct.showd=1";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $child = \Yii::$app->db->createCommand("select id,name from {{%content}} WHERE catId={$v['tagCatId']}")->queryAll();
            foreach($child as $key => $val){
                if($val['id'] == $v['tagContentId']){
                    $child[$key]['select'] = 1;
                }else{
                    $child[$key]['select'] = 0;
                }
            }
            $data[$k]['child'] = $child;
        }
        return $data;
    }


}
