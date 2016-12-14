<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use app\modules\content\models\CategoryExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;

class StudyController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 托福首页
     * @Obelisk
     */
    public function actionIndex(){
        $this->title = '出国留学_美国留学_留学考试_GMAT课程_托福课程_小申商城出国留学互助社区';
        $this->keywords = '托福,toefl,出国留学,GMAT,雅思,留学文书,选校,网申,实习';
        $this->description = '出国留学互助商城，可在线学习托福课程、GMAT课程，在线咨询留学申请服务。';
        $this->type = 1;
        $extendData = CategoryExtend::find()->where("catId=230 AND belong='content'")->orderBy('id ASC')->all();
        return $this->render('index',['extend' => $extendData]);
    }

    public function actionDeclare(){
        return $this->renderPartial('declare');
    }

}