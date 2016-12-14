<?php 
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\libs\Pager;
use app\modules\cn\models\Content;
class Collect extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%tf_collect}}';
    }

    public function getCollect($userId,$type,$page=1,$pageSize=8){
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select tc.num, tc.id,tc.contentId,c.pid,tc.createTime from {{%tf_collect}} tc LEFT JOIN {{%content}} c ON tc.contentId=c.id WHERE tc.userId=$userId AND collectType=$type  ORDER BY tc.createTime DESC $limit";
        $count = "select tc.num, tc.id,tc.contentId,c.pid,tc.createTime from {{%tf_collect}} tc LEFT JOIN {{%content}} c ON tc.contentId=c.id WHERE tc.userId=$userId AND collectType=$type";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $count = count(\Yii::$app->db->createCommand($count)->queryAll());
        $pageModel = new Pager($count,$page,$pageSize);
        $pageStr = $pageModel->GetPagerContent();
        foreach($data as $k => $v){
            $sql = "select (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId = c.id AND ce.code='6d67cf3eba969f1515df48f6f43e740d') as cnName,c.name,c.title,ca.name as catName from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.id={$v['pid']}";
            $contentData = \Yii::$app->db->createCommand($sql)->queryOne();
            if($contentData && substr($contentData['title'],0,1) == 'C'){
                $contentData['title'] = 'Conversation '.substr($contentData['title'],1,1);
            }else{
                $contentData['title'] = 'Lecture '.substr($contentData['title'],1,1);
            }
            $data[$k]['parent'] = $contentData;
        }
        return ['data' => $data,'pageStr' => $pageStr];
    }

}
