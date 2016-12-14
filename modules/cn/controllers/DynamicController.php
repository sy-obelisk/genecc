<?php
namespace app\modules\cn\controllers;
use app\modules\content\models\CategoryExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
use app\modules\cn\models\Category;
use app\libs\GoodsPager;
class DynamicController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 留学动态
     * @yanni
     */
    public function actionIndex(){
        $modelCat = new Category();
        $ks_class = $modelCat->find()->asArray()->where("pid=243")->all();
        $html = file_get_contents("http://schools.smartapply.cn/cn/api/select-ranking");
        $ranking = json_decode($html,true);
//        var_dump($ranking);die;
        return $this->render('index',['ranking'=>$ranking,'ks_class'=>$ks_class]);
    }
    /**
     * 分类内容
     * @yanni
     */
    public function actionBody(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $catid = Yii::$app->request->get('catid','');
        $page = Yii::$app->request->get('page','1');
        $order = 'ORDER BY age DESC';
        $modelCat = new Category();
        $class = $modelCat->find()->where("id=".$catid)->all();
        $model = new Content();
        $data = $model->dynamicListSearch(238,$catid,'',$order,$page,8);
        $html = file_get_contents("http://schools.smartapply.cn/cn/api/select-ranking");
        $ranking = json_decode($html,true);
        return $this->exitData(['data'=>$data,'ranking'=>$ranking,'class'=>$class],$dataType,"body",2);
    }
    /**
     * 动态详情
     * @yanni
     */
    public function actionDetail(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $id = Yii::$app->request->get('id','');
        $catid = Yii::$app->request->get('catid','');
        $modelCat = new Category();
        $class = $modelCat->find()->where("id=".$catid)->all();
        $model = new Content();
        $data =  $model->getClass(['fields' => 'alternatives','where' =>"c.id=$id"]);
        $html = file_get_contents("http://schools.smartapply.cn/cn/api/select-ranking");
        $ranking = json_decode($html,true);
        return $this->exitData(['data'=>$data,'ranking'=>$ranking,'class'=>$class],$dataType,"detail",2);
//        return $this->render('detail');
    }

}