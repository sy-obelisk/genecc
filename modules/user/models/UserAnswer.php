<?php
namespace app\modules\user\models;
use yii\db\ActiveRecord;
class UserAnswer extends ActiveRecord {
    public static function tableName(){
        return '{{%user_answer}}';
    }

    /**g
     * 口语答案列表
     * @Obelisk
     */
    public function getAllSpeaking($where,$pageSize = 10,$page =1){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT ua.example,ua.id,ca.id as catId,ua.userId,ua.contentId,c.name,ca.name as catName,ua.answer from {{%user_answer}} ua LEFT JOIN {{%content}} c ON ua.contentId=c.id LEFT JOIN {{%category}} ca ON c.catId=ca.id where ".$where." order by ua.createTime DESC ".$limit)->queryAll();
        $count = count(\Yii::$app->db->createCommand("SELECT ua.contentId,c.name,ca.name as catName,ua.answer from {{%user_answer}} ua LEFT JOIN {{%content}} c ON ua.contentId=c.id LEFT JOIN {{%category}} ca ON c.catId=ca.id where ".$where." order by ua.createTime DESC")->queryAll());
        return ['data' => $data,'count' => $count];
    }
}
