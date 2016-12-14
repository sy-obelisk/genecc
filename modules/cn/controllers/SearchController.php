<?php
/**
 * 在线课程
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\modules\cn\models\UserDiscuss;
use app\modules\content\models\ContentTag;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
use app\modules\cn\models\Category;
class SearchController extends  ToeflController{
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    public function actionIndex(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
        $content = Yii::$app->request->get('content','');
        if(!$content){
            $content='';
        }
        $page = Yii::$app->request->get('page',1);
        $price = Yii::$app->request->get('price','');
        $buyNum = Yii::$app->request->get('buyNum','');
        $time = Yii::$app->request->get('time','');
        if($price){
            if($price == 1){
                $order .= 'ORDER BY CAST(price as SIGNED) DESC';
            }else{
                $order .= 'ORDER BY CAST(price as SIGNED) ASC';
            }
        }
        if($buyNum){
            if($buyNum == 1){
                $order .= 'ORDER BY CAST(buyNum as SIGNED) DESC';
            }else{
                $order .= 'ORDER BY CAST(buyNum as SIGNED) ASC';
            }
        }

        if($time){
            if($time == 1){
                $order .= 'ORDER BY createTime DESC';
            }else{
                $order .= 'ORDER BY createTime ASC';
            }
        }
        $model = new Content();
        $data = $model->search($content,$order,$page);
        $this->title = '（留学考试）_出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        return $this->exitData($data,$dataType,"index",2);
    }

    /**
     * 在线课程
     * @return string
     * @Obelisk
     */
    public function actionGetClass(){
        $model = new Content();
        $dataType = Yii::$app->request->get('data-type','arr');
        $category = Yii::$app->params['classCategory'];
        $data = [];
        foreach($category as $v){
            $data[$v['name']] = $model->getClass(['fields' => 'numbering,originalPrice,duration,price','category' =>"{$v['id']},163,155",'where' => "c.pid=0"]);
        }
        $hotData =  $model->getClass(['category' =>"182,163,155",'pageSize' => 4,'where' => "c.pid=0"]);
        return $this->exitData(['category'=> $category,'hotData' => $hotData,'data' => $data],$dataType,"onlineClass");
    }

    /**
     * 课程详情
     * @Obelisk
     */
    public function actionClassDetails(){
        $model = new Content();
        $dataType = Yii::$app->request->get('data-type','arr');
        $id = Yii::$app->request->get('id');
        $sign = $model->findOne($id);
        if($sign->pid == 0){
            $data =  $model->getClass(['fields' => 'price,originalPrice,numbering,duration','where' =>"c.pid=$id",'pageSize' => 1]);
            if(count($data) == 0){
                echo json_encode(['code' => 0,'没有课程详情']);die;
            }
            $description =  $model->getClass(['fields' => 'description','where' =>"c.id=$id"]);
            $tagModel = new ContentTag();
            $tag = $tagModel->getAllTag($data[0]['id']);
            $pData = $model->findOne($id);
            $count = $pData->viewCount;
            Content::updateAll(['viewCount' => ($count+1)],"id=$id");
            $pid = $id;
            $id = $data[0]['id'];
            $data[0]['description'] = $description[0]['description'];
        }else{
            $data =  $model->getClass(['fields' => 'price,originalPrice,numbering,duration','where' =>"c.id=$id",'pageSize' => 1]);
            $description =  $model->getClass(['fields' => 'description','where' =>"c.id=$sign->pid"]);
            $tagModel = new ContentTag();
            $tag = $tagModel->getAllTag($id);
            $pData = $model->findOne($sign->pid);
            $count = $pData->viewCount;
            Content::updateAll(['viewCount' => ($count+1)],"id=$sign->pid");
            $pid = $sign->pid;
            $data[0]['description'] = $description[0]['description'];
        }
        return $this->exitData(['id' => $id,'pid' => $pid,'count' => $count,'tag' => $tag,'data' => $data[0]],$dataType,"details");
    }

    public function actionHotClass(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $model = new Content();
        $class = $model->getClass(['fields' => 'numbering','category' =>"155,182",'pageSize' => 4,'where' => "c.pid=0"]);
        return $this->exitData($class,$dataType,"details");
    }
}