<?php
namespace app\modules\cn\controllers;
use app\modules\cn\models\User;
use app\modules\content\models\CategoryExtend;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\QuestionContent;
use app\modules\cn\models\Content;

class QuestionController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 问答首页
     * @yanni
     */
    public function actionIndex(){
        $page = Yii::$app->request->get('page',1);
        $cat = Yii::$app->request->get('cat',1);
        if($cat==1){
            $model = new QuestionContent();
            $question = $model->getQuestion(1,'',$page,10);
            foreach($question['data'] as $key=>$v){
                $model = new QuestionContent();
                $question['data'][$key]['answer'] = $model->getAnswer($v['id']);    //推荐问题
            }
        }
        if($cat==2){
            $model = new QuestionContent();
            $question = $model->getNewestQuestion($page,10);
            foreach($question['data'] as $key=>$n){
                $model = new QuestionContent();
                $question['data'][$key]['answer'] = $model->getAnswer($n['id']);    //最新问题
            }
        }
        if($cat==3){
            $model = new QuestionContent();
            $question = $model->getStayQuestion($page,10);
            foreach($question['data'] as $key=>$s){
                $model = new QuestionContent();
                $question[$key]['answer'] = $model->getAnswer($s['id']);;    //待回复问题
            }
        }
        $model = new QuestionContent();
        $all_question =$model->getAllQuestion();     //所有问题
        $num =count($all_question);
        $modelc = new Content();
        $data =  $modelc->getClass(['fields' => 'duration','category' =>"239"]);
        if(count($data)>0){
            foreach($data as $key=>$u){
                if(!empty($u['duration'])){
                    $model = new QuestionContent();
                    $answer_rank[$key]['num'] = count($model->find()->asArray()->where("userId=".$u['duration']." and type=2")->all());
                    $answer_rank[$key]['information'] = $u;
                }else{
                    $answer_rank[$key]['num'] = 0;
                    $answer_rank[$key]['information'] = $u;
                }
            }
            foreach($answer_rank as $t){
                $rank[] = $t['num'];
            }
            array_multisort($rank, SORT_DESC, $answer_rank);  //按回答数量排序
        }else{
            $answer_rank='';
        }
        return $this->render('index',['num'=>$num,'question'=>$question,'answer_rank'=>$answer_rank]);
    }
    /**
     * 答题页
     * @yanni
     */
    public function actionDetail(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $questionid = Yii::$app->request->get('id','');
        $modelc = new Content();
        $answer_user =  $modelc->getClass(['fields' => 'duration','category' =>"239"]);
        if(count($answer_user)>0) {
            foreach ($answer_user as $key => $u) {   //查询用户答题数量
                if (!empty($u['duration'])) {
                    $model = new QuestionContent();
                    $answer_rank[$key]['num'] = count($model->find()->asArray()->where("userId=" . $u['duration'] . " and type=2")->all());
                    $answer_rank[$key]['information'] = $u;
                } else {
                    $answer_rank[$key]['num'] = 0;
                    $answer_rank[$key]['information'] = $u;
                }
            }
            foreach ($answer_rank as $t) {
                $rank[] = $t['num'];
            }
            array_multisort($rank, SORT_DESC, $answer_rank);  //按回答数量排序
        }else{
            $answer_rank = '';
        }
        $all_question =$model->getAllQuestion();     //所有问题
        $num =count($all_question);
          //回答问题的数量
        $model = new QuestionContent();
        $data = $model->getQuestion('',$questionid);       //问题简介
        $model->updateAll(array('browse'=>$data[0]['browse']+1),'id='.$questionid);  //浏览量加1
        $answer = $model->getAnswer($questionid);    //问题回答
        foreach($answer as $key=>$v){
            $answer[$key]['reply'] = $model->getAnswer($v['id']);
            $answer[$key]['adviser'] = $model->getAdviser($v['userid']);
        }
//        var_dump($answer);die;
        return $this->render('detail',['num'=>$num,'data'=>$data,'answer'=>$answer,'answer_rank'=>$answer_rank]);
    }
    /**
     * 提交问题
     * @yanni
     */
    public function actionQuestion(){
        $userid = Yii::$app->session->get('userId','');
        $userData = Yii::$app->session->get('userData','');
        if($userid){
            $appointid = Yii::$app->request->post('appointid','');
            $question = Yii::$app->request->post('question','');
            $content = Yii::$app->request->post('contents','');
            $type = yii::$app->request->post('type','1');
            if($content){
                $model = new QuestionContent();
                $model->userId =$userData['uid'];
                $model->qId =$appointid;
                $model->question =$question;
                $model->content=$content;
                $model->addTime= date('Y-m-d H:i:s',time());
                $model->type=$type;
                $model->questionType=1;
                $model->save();
            }else{
                exit ("<script>alert('问题或详情不能为空');history.go(-1);</script>");
            }
            return $this->redirect(['index']);
        }else{
            echo "<script>alert('你还没登陆哦~~~~~');window.location.href='http://login.gmatonline.cn/cn/index?source=1&url=http://+".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."';</script>";
        }
    }
    /**
     * 提交回答
     * @yanni
     */
    public function actionAnswer(){
        $questionid = Yii::$app->request->post('question','');
        $userid = Yii::$app->session->get('userId','');
        $userData = Yii::$app->session->get('userData','');
        $pid = yii::$app->request->post('pid','');
        $content = Yii::$app->request->post('contents','');
        $type = yii::$app->request->post('type','2');
        if($userid){
            if($content){
                $model = new QuestionContent();
                $model->pId =$pid;
                $model->userId =$userData['uid'];
                $model->content=$content;
                $model->addTime= date('Y-m-d H:i:s',time());
                $model->type=$type;
                $model->save();
                $model->updateAll(array('tag'=>1),'id='.$pid);
            }else{
                exit ("<script>alert('回答不能为空');history.go(-1);</script>");
            }
            return $this->redirect(array('detail','id'=>$questionid));
        }
        else{
            echo "<script>alert('你还没登陆哦~~~~~');window.location.href='http://login.gmatonline.cn/cn/index?source=1&url=http://+".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."';</script>";
        }
    }

}