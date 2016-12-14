<?php
namespace app\modules\cn\controllers;
use app\modules\content\models\CategoryExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;

class EnactController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 留学定制
     * @yanni
     */
    public function actionIndex(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $model = new Content();
        $data = $model->listSearch(152,'','','',1);
        return $this->exitData($data,$dataType,"index",2);
    }
    /**
     * 文书页面
     * @yanni
     */
    public function actionWrit(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $page = Yii::$app->request->get('page',1);
        $model = new Content();
        $data = $model->listSearch(223,'','','',$page);
        return $this->exitData($data,$dataType,"writ",2);
    }
    /**
     * gmat页面
     * @yanni
     */
    public function actionGmat(){
        $liveClass = file_get_contents("http://www.gmatonline.cn/index.php?web/webapi/gmatLiveLesson");
        $liveClass = json_decode($liveClass,true);
        return $this->render('gmat',['liveClass'=>$liveClass]);
    }
    public function actionDeclare(){
        return $this->renderPartial('declare');
    }

}