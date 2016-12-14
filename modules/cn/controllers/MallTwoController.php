<?php
namespace app\modules\cn\controllers;
use app\modules\content\models\CategoryExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
use app\modules\cn\models\Category;

class MallTwoController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 案例库
     * @yanni
     */
    public function actionIndex(){

        return $this->render('index');
    }
    /**
     * gmat案例
     * @yanni
     */
    public function actionGmat(){
        return $this->render('gmat');
    }
    /**
     * toefl案例
     * @yanni
     */
    public function actionToefl(){
        return $this->render('toefl');
    }
    /**
     * 名校offer
     * @yanni
     */
    public function actionOffer(){
        return $this->render('offer');
    }
    /**
     * 案例分类显示
     * @yanni
     */
    public function actionDetail(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
        $categoryid = Yii::$app->request->get('countryid','');
        $page = Yii::$app->request->get('page','1');
        $modelCat = new Category();
        $class = $modelCat->find()->where("id=".$categoryid)->all();
        $model = new Content();
        $data = $model->dynamicListSearch(240,$categoryid,'',$order,$page,8);
        return $this->exitData(['data'=>$data,'class'=>$class],$dataType,"detail",2);
    }
    /**
     * 案例详情
     * @yanni
     */
    public function actionThree(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $id = Yii::$app->request->get('contentid','');
        $catid = Yii::$app->request->get('countryid','');
        $modelCat = new Category();
        $class = $modelCat->find()->where("id=".$catid)->all();
        $model = new Content();
        $data =  $model->getClass(['fields' => 'alternatives','where' =>"c.id=$id"]);
//        var_dump($data);die;
        return $this->exitData(['data'=>$data,'class'=>$class],$dataType,"three",2);
    }
}