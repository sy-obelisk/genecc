<?php
namespace app\modules\cn\models;
use yii\db\ActiveRecord;
use app\modules\cn\models\User;
use app\libs\GoodsPager;
use app\libs\Pager;
class QuestionContent extends ActiveRecord {
    public $cateData;

    public static function tableName(){
        return '{{%question_content}}';
    }

//    获取问题信息
    public function getQuestion($type,$id='',$page=1,$pageSize=10){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        if($id){
            $sql = "select * from {{%question_content}} as con left join {{%user}} as u on con.userId=u.id where con.id=".$id;
            $data = \Yii::$app->db->createCommand($sql)->queryAll();
            return $data;
        }else{
            if($type){
                $where = "and questionType=".$type;
            }else {
                $where = "";
            }
            $sql = "select con.id,con.question,con.browse,con.follow,u.image,u.username from {{%question_content}} as con left join {{%user}} as u on con.userId=u.uid where type=1 ".$where." order by con.addTime desc";
            $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
            $sql .= $limit;
            $data = \Yii::$app->db->createCommand($sql)->queryAll();
            $pageModel = new GoodsPager($count,$page,$pageSize,10);
            $pageStr = $pageModel->GetPagerContent();
            $totalPage = ceil($count/$pageSize);
            return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
        }
    }
//    按时间降序排序查询最新问题
    public function getNewestQuestion($page=1,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select con.id,con.question,con.browse,con.follow,u.image,u.username from {{%question_content}} as con left join {{%user}} as u on con.userId=u.uid where type=1 order by con.addTime desc";
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $limit;
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $pageModel = new GoodsPager($count,$page,$pageSize,10);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
    public function getStayQuestion($page=1,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "select con.id,con.question,con.browse,con.follow,u.image,u.username from {{%question_content}} as con left join {{%user}} as u on con.userId=u.uid where type=1 and isnull(tag) order by con.addTime asc";
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $limit;
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $pageModel = new GoodsPager($count,$page,$pageSize,10);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
//    获取问题回答信息
    public function getAnswer($id){
        $sql = "select con.id,con.content,con.userid,con.addTime,u.username,u.image from {{%question_content}} as con left join {{%user}} as u on con.userId=u.uid where con.pid=".$id." ORDER BY con.addTime desc";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
    public function getAllQuestion(){
        $sql = "select distinct con.pid from {{%question_content}} as con  where type=2";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
    //    获取顾问回答信息
    public function getAdviserAnswer($user){
        $sql = "select con.pid,con.addtime,con.content,u.image,u.username from {{%question_content}} as con left join {{%user}} as u on con.userId=u.uid where type=2 and u.uid=".$user;
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
    //获取关联顾问
    public function getAdviser($id){
        $sql = "Select c.*, (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='c8cc4bd99d4fcfcdfd5673bd635b5bcd') as duration FROM {{%content}} c WHERE c.catId=239 AND pid =0 ";
        $res = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach($res as $v) {
            if ($v['duration'] == $id) {
                $data['name'] = $v['name'];
                $data['image'] = $v['image'];
                $data['time'] = $v['createTime'];
            } else {
                $data = '';
            }
        }
        return $data;
    }
}
