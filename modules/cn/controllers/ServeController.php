<?php
/**
 * 服务管理
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;


use app\modules\cn\models\HistoryRecord;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Category;
use app\modules\cn\models\Content;
class ServeController extends  ToeflController{
    public $enableCsrfValidation = false;
    public $layout = 'cn';

    /**
     * 申请服务
     * @return string
     * @Obelisk
     */
    public function actionApply(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
        $country = Yii::$app->request->get('country','');
        $aim = Yii::$app->request->get('aim','');
        $category = Yii::$app->request->get('category','');
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
        $data = $model->listSearch($category,$country,$aim,$order,$page);
        $this->title = '出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        return $this->exitData($data,$dataType,"apply",2);
    }

    /**
     * 文书服务
     * @return string
     * @Obelisk
     */
    public function actionWrit(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
        $country = Yii::$app->request->get('country','');
        $aim = Yii::$app->request->get('aim','');
        $page = Yii::$app->request->get('page',1);
        $price = Yii::$app->request->get('price','');
        $buyNum = Yii::$app->request->get('buyNum','');
        $time = Yii::$app->request->get('time','');
        if($price){
            if($price == 1){
                $order .= 'ORDER BY price DESC';
            }else{
                $order .= 'ORDER BY price ASC';
            }
        }
        if($buyNum){
            if($buyNum == 1){
                $order .= 'ORDER BY buyNum DESC';
            }else{
                $order .= 'ORDER BY buyNum ASC';
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
        $data = $model->listSearch(152,$country,$aim,$order,$page);
        return $this->exitData($data,$dataType,"writ",2);
    }

    /**
     * 签证服务
     * @return string
     * @Obelisk
     */
    public function actionVisa(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
        $country = Yii::$app->request->get('country','');
        $aim = Yii::$app->request->get('aim','');
        $page = Yii::$app->request->get('page',1);
        $price = Yii::$app->request->get('price','');
        $buyNum = Yii::$app->request->get('buyNum','');
        $time = Yii::$app->request->get('time','');
        if($price){
            if($price == 1){
                $order .= 'ORDER BY price DESC';
            }else{
                $order .= 'ORDER BY price ASC';
            }
        }
        if($buyNum){
            if($buyNum == 1){
                $order .= 'ORDER BY buyNum DESC';
            }else{
                $order .= 'ORDER BY buyNum ASC';
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
        $data = $model->listSearch(153,$country,$aim,$order,$page);
        return $this->exitData($data,$dataType,"visa",2);
    }

    /**
     * 实习项目
     * @return string
     * @Obelisk
     */
    public function actionPractice(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
        $country = Yii::$app->request->get('country','');
        $aim = Yii::$app->request->get('aim','');
        $page = Yii::$app->request->get('page',1);
        $price = Yii::$app->request->get('price','');
        $buyNum = Yii::$app->request->get('buyNum','');
        $time = Yii::$app->request->get('time','');
        if($price){
            if($price == 1){
                $order .= 'ORDER BY price DESC';
            }else{
                $order .= 'ORDER BY price ASC';
            }
        }
        if($buyNum){
            if($buyNum == 1){
                $order .= 'ORDER BY buyNum DESC';
            }else{
                $order .= 'ORDER BY buyNum ASC';
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
        $data = $model->listSearch(154,$country,$aim,$order,$page);
        return $this->exitData($data,$dataType,"practice",2);
    }
}