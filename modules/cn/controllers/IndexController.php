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

class IndexController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';
    /**
     * 托福首页
     * @Obelisk
     */
    public function actionIndex(){

        $schools = file_get_contents("http://schools.smartapply.cn/cn/api/select-ranking");
        $schools = json_decode($schools,true);
        $schoolsc = file_get_contents("http://schools.smartapply.cn/cn/api/select-country");
        $schoolsc = json_decode($schoolsc,true);
//        var_dump($country);die;
        return $this->render('newIndex',['schools'=>$schools,'schoolsc'=>$schoolsc]);
    }

    public function actionHome (){
        $model = new Content();
        $order ='ORDER BY CAST(sort as SIGNED) ASC';
        $Research = $model->listSearch('153,220,223,224','','',$order,1,4);
        $bengke = $model->listSearch(152,'','',$order,1,4);
        return $this->render('productStudy',['research'=>$Research,'bengke'=>$bengke]);
    }

    public function actionProgramme()
    {
        $name = Yii::$app->request->post('user_name');
        $phone = Yii::$app->request->post('user_phone');
        $country = Yii::$app->request->post('country');
        $pantime = Yii::$app->request->post('pan_time');
        $grade = Yii::$app->request->post('grade');
        $extendVal=[$name,$phone,$country,$pantime,$grade];
//        var_dump($extendVal);die;
        if($name!='' && $phone!='' && $country!='' && $pantime !='' && $grade !=''){
            $contentModel = new Content();
            $time=date('Y-m-d H:i:s', strtotime('-1 days'));
            $res=Content::findBySql('SELECT * FROM {{%content}} where name='."'$name'")->all();
            if($res){
                foreach($res as $v){
                    if($v['createTime'] > $time){
                        die('<script>alert("你今天已预约，请24小时后再次预约");history.go(-1);</script>');
                    }
                }
                $contentModel->addContent(304,'',$name,$extendVal);
                die('<script>alert("提交成功，专业申请老师将会在2小时之后联系你");history.go(-1);</script>');
            }else{
                $contentModel->addContent(304,'',$name,$extendVal);
                die('<script>alert("提交成功，专业申请老师将会在2小时之后联系你");history.go(-1);</script>');
            }
        }else{
            die('<script>alert("请检查填写信息");history.go(-1);</script>');
        }
    }
    public function actionDeclare(){
        return $this->renderPartial('declare');
    }

}