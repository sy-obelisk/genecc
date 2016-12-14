<?php
namespace app\modules\cn\controllers;
use app\modules\content\models\CategoryExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
use app\modules\cn\models\Category;

class RankingController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 大学排名
     * @yanni
     */
    public function actionIndex(){
        $rank_type = Yii::$app->request->get('type','');
        $year = Yii::$app->request->get('year','');
        $page = Yii::$app->request->get('page','1');
        $model = new Content();
        $data = $model->rankSearch(292,$rank_type,$year,$page,50);
        return $this->render('index',['data'=>$data]);
    }
    /**
     * 动态详情
     * @yanni
     */
    public function actionDetail(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $catid = Yii::$app->request->get('catid','');
        $contentid = Yii::$app->request->get('content','');
        $modelc = new Category();
        $catIntroduce = $modelc->find()->where("id=".$catid)->all();
        $model = new Content();
        $data =  $model->getClass(['where' => 'c.pid=0','fields' => 'answer','category'=>$catid]);
        if($data){
            if($contentid==''){
                $contentid = $data[0]['id'];
            }
            $subContent = $model->find()->where("pid=".$contentid)->all();
        }else{
            $subContent ='';
        }
        return $this->exitData(['data'=>$data,'catIntroduce'=>$catIntroduce,'subContent'=>$subContent],$dataType,"detail",2);
    }
    /**
     * 子内容
     * @return json
     * by yanni
     */
    public function actionContent(){
        $contentid = Yii::$app->request->post('id','');
        $model = new Content();
        $subContent = $model->find()->asArray()->where("pid=".$contentid)->all();
        return json_encode($subContent);
    }
}