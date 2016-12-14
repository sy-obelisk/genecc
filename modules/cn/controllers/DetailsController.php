<?php
/**
 * 详情
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\modules\cn\models\Category;
use app\modules\cn\models\Content;
use app\modules\cn\models\UserDiscuss;
use app\modules\content\models\ContentTag;
use app\modules\cn\models\OrderGoods;
use yii;
use app\libs\ToeflController;

class DetailsController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 商城详情页
     * @Obelisk
     */
    public function actionDetails(){
        $model = new Content();
        $dataType = Yii::$app->request->get('data-type','arr');
        $id = Yii::$app->request->get('id');
        $sign = $model->findOne($id);
        if($sign->pid == 0){
            $data = Content::find()->where("pid=$id")->one();
            if($data){
                $this->redirect('/goods/'.$data['id'].'.html');
            }else{
                die('<script>alert("商品缺少详情");history.go(-1);</script>');
            }
        }else{
            $data =  $model->getClass(['fields' => 'price,originalPrice','where' =>"c.id=$id",'pageSize' => 1]);
            $parent =  $model->getClass(['fields' => 'description,answer,alternatives,article,listeningFile','where' =>"c.id=$sign->pid"]);
            $tagModel = new ContentTag();
            $tag = $tagModel->getAllTag($id);
            $count = $parent[0]['viewCount'];
            Content::updateAll(['viewCount' => ($count+1)],"id=$sign->pid");
            $pid = $sign->pid;
        }
        $model = new OrderGoods();
        $bought = $model->getBought($sign->pid);
        $model = new UserDiscuss();
        $discuss = $model->getAllDiscuss($sign->pid);
        $this->title = $data[0]['name'].'_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        return $this->exitData(['discount' => $discuss['count'],'high' => $discuss['high'],'middle' => $discuss['middle'],'low' => $discuss['low'],'stars' => $discuss['stars'],'plate' => $discuss['plate'],'discuss' => $discuss['discuss'],'id' => $id,'pid' => $pid,'count' => $count,'tag' => $tag,'data' => $data[0],'parent' => $parent[0],'bought' => $bought],$dataType,"details",2);
    }

    public function actionDeclare(){
        return $this->render('declare');
    }

}