<?php
/**
 * 在线课程
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
class VoucherController extends  ToeflController{
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    public function actionIndex(){
        $order = '';
        $dataType = Yii::$app->request->get('data-type','arr');
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
        $data = $model->courseSearch(170,$category,'',$order,$page);
        $this->title = '出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        return $this->exitData($data,$dataType,"index",2);
    }

}