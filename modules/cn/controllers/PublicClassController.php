<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\modules\cn\models\Category;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;

class PublicClassController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'class';
    /**
     * 托福首页
     * @Obelisk
     */
    public function actionIndex(){
        $this->title = '公开课_出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        return $this->render('index');
    }

    public function actionList(){
        $catId = Yii::$app->request->get('category');
        $sign = Category::findOne($catId);
        $category = "218,$catId";
        $page = Yii::$app->request->get('page',1);
        $data = Content::getClass(['pageStr' =>1,'fields' => "cnName,numbering,listeningFile,alternatives,problemComplement",'pageSize'=> 7,'category' => $category,'page' => $page,'where' => 'c.pid=0']);
        $pageStr = $data['pageStr'];
        $count = $data['count'];
        $total = $data['total'];
        unset($data['count']);
        unset($data['total']);
        unset($data['pageStr']);
        $this->title = '公开课_出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        return $this->render('list',['count' => $count,'total' => $total,'pageStr' => $pageStr,'data'=>$data,'page' =>$page,'category' => $catId,'name' => $sign->name]);
    }

    public function actionDetails(){
        $id = Yii::$app->request->get('id');
        $dataType = Yii::$app->request->get('data-type','arr');
        $sign = Content::findOne($id);
        if($sign->pid == 0){
            $data = Content::find()->where("pid=$id")->one();
            if($data){
                if($dataType == 'json'){
                    die(json_encode(['code' => 3,'id'=>$data['id']]));
                }else{
                    $this->redirect('/public-class/'.$data['id'].'.html');
                }
            }else{
                die('<script>alert("商品缺少详情");history.go(-1);</script>');
            }
        }else {
            $parent = Content::getClass(['fields' => "sentenceNumber,duration,cnName,listeningFile,article,problemComplement,answer", 'where' => "c.id = $sign->pid"]);
            $data = Content::getClass(['fields' => "price", 'where' => "c.id = $id"]);
            $count = $data[0]['viewCount'];
            Content::updateAll(['viewCount' => ($count + 1)], "id=$sign->pid");
            $this->title = '公开课_出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
            $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
            $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
            $this->type = 1;
            return $this->exitData(['parent' => $parent[0],'data' => $data[0]],$dataType,'details',2);

        }
    }

    public function actionBack(){
        $id = Yii::$app->request->get('id');
        $data = Content::getClass(['fields' => "article,listeningFile,answer,duration",'where' => "c.id = $id"]);
        $count = $data[0]['viewCount'];
        Content::updateAll(['viewCount' => ($count+1)],"id=$id");
        $this->title = '公开课_出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        return $this->render('back',['data' => $data[0]]);
    }

}