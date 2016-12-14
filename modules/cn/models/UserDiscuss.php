<?php 
namespace app\modules\cn\models;
use app\libs\Pager;
use app\modules\cn\models\DiscussPlat;
use yii\db\ActiveRecord;
class UserDiscuss extends ActiveRecord {
    public static function tableName(){
            return '{{%user_discuss}}';
    }

    /**
     * 获取当前内容的评论
     * @param $contentId
     * @param int $page
     * @return array
     * @Obelisk
     */
    public function getContentDiscuss($contentId,$page=1){
        $pageSize = 10;
        $limit = "limit ".($page-1)*$pageSize.",$pageSize";
        $data = \Yii::$app->db->createCommand("SELECT u.image,u.nickname,u.userName,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND type =2 AND d.contentId = $contentId order by d.createTime DESC ".$limit)->queryAll();
        foreach($data as $k => $v){
            if(!$v['nickname']){
                $data[$k]['nickname'] = $v['userName'];
            }
            if(!$v['image']){
                $data[$k]['image'] = '/cn/images/details_defaultImg.png';
            }
        }
        $parse = \Yii::$app->db->createCommand("SELECT d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND type =1 AND d.contentId = $contentId order by d.createTime DESC Limit 1")->queryOne();
        $count = count(\Yii::$app->db->createCommand("SELECT d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid=0 AND d.status=1 AND d.contentId = $contentId order by d.createTime DESC ")->queryAll());
        $pageModel = new Pager($count,$page);
        $pageStr = $pageModel->GetPagerContent();
        return ['data' => $data,'pageStr' => $pageStr,'page' => $page,'parse' => $parse];
    }

    public function getAllDiscuss($contentId){
        $sql = "select ud.*,u.image from {{%user_discuss}} ud LEFT JOIN {{%user}} u on ud.userId=u.id WHERE ud.contentPid=$contentId AND ud.status=1 AND ud.type=1 ORDER BY ud.createTime DESC";
        $discuss  = \Yii::$app->db->createCommand($sql)->queryAll();
        $stars = 0;
        $high = $this->find()->where("contentPid=$contentId AND status=1 AND type=1 AND stars>=4")->count();
        $middle = $this->find()->where("contentPid=$contentId AND status=1 AND type=1 AND stars<4 AND stars>1")->count();
        $low = $this->find()->where("contentPid=$contentId AND status=1 AND type=1 AND stars<2")->count();
        foreach($discuss as $v){
            $stars += $v['stars'];
        }
        $stars = count($discuss)?number_format(($stars/count($discuss))*2,1):'暂无评分';
        $discussPlate = Content::find()->where("catId = 217")->orderBy("sort DESC")->all();
        $plate = [];
        foreach($discussPlate as $k =>$v){
            $model = new DiscussPlate();
            $count = $model->find()->where("contentPid=$contentId AND plate={$v['id']}")->count();
            $plate[$k]['count'] = $count;
            $plate[$k]['name'] = $v['name'];
        }
        return ['high'=> $high,'middle' => $middle,'low' =>$low,'stars' => $stars,'plate' => $plate,'discuss' => $discuss,'count' => count($discuss)];

    }


}
