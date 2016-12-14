<?php
namespace app\modules\cn\controllers;
use app\modules\cn\models\Old;
use app\modules\content\models\CategoryContent;
use app\modules\content\models\CategoryExtend;
use app\modules\content\models\ContentExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
use app\modules\cn\models\RelatedContent;
use app\modules\cn\models\QuestionContent;
class ConsultantController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 商城顾问
     * @yanni
     */
    public function actionIndex(){
        $order='';
        $dataType = Yii::$app->request->get('data-type','arr');
        $countryid = Yii::$app->request->get('country','');
        $regionid = Yii::$app->request->get('regionid','');
        $page = Yii::$app->request->get('page','1');
        $num = Yii::$app->request->get('num','');
        if($num==1){
            $order .='ORDER BY CAST(students as SIGNED) DESC';
        }else{
            $order .='ORDER BY CAST(sort as SIGNED) ASC';
        }
        $model = new Content();
        $data = $model->dynamicListSearch(239,$countryid,$regionid,$order,$page,8);
        $schools = file_get_contents("http://schools.smartapply.cn/cn/api/select-schools");
        $schools = json_decode($schools,true);
//        var_dump($schools);die;
        return $this->exitData(['data'=>$data,'schools'=>$schools],$dataType,"index",2);
    }
    public function actionContent(){
        set_time_limit(0);
//        $model = new RelatedContent();
//        $data = $model->find()->asArray()->all();
//        $_SESSION['RelatedContent'] = $data;
//        $model = new Content();
//        $model1 = new ContentExtend();
//        $model2 = new ExtendData();
//        $model3 = new CategoryContent();
//        $data = $model->find()->asArray()->where("id>540")->all();
//        $data1 = $model1->find()->asArray()->where("id>5106")->all();
//        $data2 = $model2->find()->asArray()->where("id>206")->all();
//        $data3 = $model3->find()->asArray()->where("id>15151")->all();
//        $_SESSION['content'] = $data;
//        $_SESSION['ContentExtend'] = $data1;
//        $_SESSION['ExtendData'] = $data2;
//        $_SESSION['CategoryContent'] = $data3;
//        var_dump($data3);die
//        foreach($_SESSION['RelatedContent'] as $v){
//            $contentId = Old::find()->asArray()->where("old={$v['contentId']}")->one();
//            $relatedContentId = Old::find()->asArray()->where("old={$v['relatedContentId']}")->one();
//            $model = new RelatedContent();
//            $model->contentId = $contentId['new'];
//            $model->relatedContentId = $relatedContentId['new'];
//            $model->save();
//        }
//        foreach($_SESSION['content'] as $key=>$v) {
//            if ($key >= 1528) {
//                $model = new Content();
//                $model->pid = $v['pid'];
//                $model->catId = $v['catId'];
//                $model->name = $v['name'];
//                $model->title = $v['title'];
//                $model->image = $v['image'];
//                $model->createTime = $v['createTime'];
//                $model->sort = $v['sort'];
//                $model->userId = $v['userId'];
//                $model->viewCount = $v['viewCount'];
//                $model->save();
//                $id = $model->primaryKey;
//                $sql = "INSERT INTO old (`old`,`new`) VALUES ({$v['id']},$id)";
//                Yii::$app->db->createCommand($sql)->query();
//                foreach ($_SESSION['ContentExtend'] as $va) {
//                    if ($va['contentId'] == $v['id']) {
//                        $model1 = new ContentExtend();
//                        $model1->catExtendId = $va['catExtendId'];
//                        $model1->contentId = $id;
//                        $model1->name = $va['name'];
//                        $model1->title = $va['title'];
//                        $model1->image = $va['image'];
//                        $model1->description = $va['description'];
//                        $model1->type = $va['type'];
//                        $model1->userId = $va['userId'];
//                        $model1->createTime = $va['createTime'];
//                        $model1->value = $va['value'];
//                        $model1->inheritId = $va['inheritId'];
//                        $model1->canDelete = $va['canDelete'];
//                        $model1->code = $va['code'];
//                        $model1->typeValue = $va['typeValue'];
//                        $model1->required = $va['required'];
//                        $model1->requiredValue = $va['requiredValue'];
//                        $model1->save();
//                        $id1 = $model1->primaryKey;
//                        foreach ($_SESSION['ExtendData'] as $val) {
//                            if ($val['extendId'] == $va['id']) {
//                                $model2 = new ExtendData();
//                                $model2->extendId = $id1;
//                                $model2->value = $val['value'];
//                                $model2->save();
//                            }
//                        }
//                    }
//                }
//                foreach ($_SESSION['CategoryContent'] as $valu) {
//                    if ($valu['contentId'] == $v['id']) {
//                        $model3 = new CategoryContent();
//                        $model3->contentId = $id;
//                        $model3->catId = $valu['catId'];
//                        $model3->save();
//                    }
//                }
//            }
//        };
    }
    /**
     * 顾问详情
     * @yanni
     */
    public function actionDetails(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $contentid = Yii::$app->request->get('contentid','');
        $html = file_get_contents("http://schools.smartapply.cn/cn/api/select-ranking");
        $ranking = json_decode($html,true);
        $model = new Content();
        $data =  $model->getClass(['fields' => 'answer,alternatives,article,listeningFile,cnName,numbering,duration','where' =>"c.id=$contentid"]);
        $caseid = $model->getCaseList($contentid);
        foreach($caseid as $v){
            $caseList[] =  $model->getClass(['where' => 'c.id='.$v['relatedContentId'],'fields' => 'article,problemComplement,listeningFile,cnName,numbering,sentenceNumber,duration','page'=>1,'pageSize' => 4]);;
        }
        if(empty($caseList)){
            $caseList = '';
        }
        $answer = '';
        if($data[0]['duration']){
            $modelq = new QuestionContent();
            $answer = $modelq->getAdviserAnswer($data[0]['duration']);
            foreach($answer as $key=>$v){
                $modelq = new QuestionContent();
                $question = $modelq->find()->asArray()->where("id=".$v['pid'])->one();
                $answer[$key]['question'] = $question['question'] ;   //推荐问题
            }
        }
//        var_dump($answer);die;
        return $this->exitData(['data'=>$data,'caseList'=>$caseList,'answer'=>$answer,'schools'=>$ranking],$dataType,"details",2);
    }

}