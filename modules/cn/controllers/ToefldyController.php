<?php
/**
 * 首页
 * Created by PhpStorm.
 * User: obelisk
 */
namespace app\modules\cn\controllers;
use yii;
use app\libs\ToeflController;
use app\modules\cn\models\Content;
use app\libs\VerificationCode;
use app\modules\cn\models\ContentExtend;
class ToefldyController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 托福单页 
     * @Yanni
     */
    public function actionIndex(){
        $teacher = file_get_contents("http://www.toeflonline.cn/cn/api/get-teacher");
        $teacher = json_decode($teacher,true);
        return $this->render('index',['teacher'=>$teacher]);
    }
    /**
     * 马上预约
     * @Yanni
     */
    public function actionMake(){
        $apps = Yii::$app->request;
        $session = Yii::$app->session;
        if($apps->isPost){
            $name=$apps->post("user_name");
            $phone=$apps->post("user_phone");
            $school=$apps->post("user_school");
            $code=$apps->post("user_code");
            $extendVal=[$name,$phone,$school];
            if($code!='' && $name!='' && $phone!='' && $school !=''){
                new VerificationCode;
                $co=$session->get('verificationCode');
                if($co!=$code){
                    die('<script>alert("验证码错误");history.go(-1);</script>');
                }
                $contentModel = new Content();
                $time=date('Y-m-d H:i:s', strtotime('-1 days'));
                $res=Content::findBySql('SELECT * FROM {{%content}} where name='."'$name'")->all();
                if($res){
                    foreach($res as $v){
                        if($v['createTime'] > $time){
                            die('<script>alert("你今天已预约，请24小时后再次预约");history.go(-1);</script>');
                        }
                    }
                    $contentModel->addContent(280,'',$name,$extendVal);
                    die('<script>alert("提交成功，专业申请老师将会在2小时之后联系你");history.go(-1);</script>');
                }else{
                    $contentModel->addContent(280,'',$name,$extendVal);
                    die('<script>alert("提交成功，专业申请老师将会在2小时之后联系你");history.go(-1);</script>');
                }
            }else{
                die('<script>alert("请检查填写信息");history.go(-1);</script>');
            }
        }
    }
    public function actionDeclare(){
        return $this->renderPartial('declare');
    }

}