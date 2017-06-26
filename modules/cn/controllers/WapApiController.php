<?php

/**
 * toefl API
 * Created by PhpStorm.
 * User: obelisk
 */

namespace app\modules\cn\controllers;


use app\libs\Method;
use app\modules\cn\models\HistoryRecord;

use app\modules\cn\models\TestStatistics;
use app\modules\cn\models\Vocab;
use app\modules\cn\models\ShoppingCart;
use app\modules\order\models\OrderGoods;
use app\modules\cn\models\Order;

use yii;

use app\libs\ToeflApiControl;

use app\libs\VerificationCode;

use app\libs\Sms;

use app\modules\cn\models\Content;

use app\modules\cn\models\UserAnswer;

use app\modules\cn\models\UserDiscuss;

use app\modules\cn\models\Collect;

use app\modules\cn\models\Login;

use UploadFile;



class WapApiController extends ToeflApiControl
{
    public function actionDetails(){
        $id = Yii::$app->request->get('id');
        $sign = Content::findOne($id);
        if($sign->pid == 0){
            $data = Content::find()->where("pid=$id")->one();
            if($data){
                $callback = $_GET['callback'];
                echo $callback.'('.json_encode(['code' => 3,'id'=>$data['id']]).')';
                exit;
            }else{
                $callback = $_GET['callback'];
                echo $callback.'('.json_encode(['code' => 0,'message' => '没有该内容']).')';
                exit;
            }
        }else {
            $parent = Content::getClass(['fields' => "sentenceNumber,duration,cnName,listeningFile,article,problemComplement,answer", 'where' => "c.id = $sign->pid"]);
            $parent[0]['sentenceNumber'] = str_replace('src="/files','src="http://www.smartapply.cn/files',$parent[0]['sentenceNumber']);
            $data = Content::getClass(['fields' => "price", 'where' => "c.id = $id"]);
            $count = $data[0]['viewCount'];
            Content::updateAll(['viewCount' => ($count + 1)], "id=$sign->pid");
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode(['code' =>1,'parent' => $parent[0],'data' => $data[0]]).')';
            exit;
        }
    }

    public function actionBack(){
        $id = Yii::$app->request->get('id');
        $data = Content::getClass(['fields' => "article,listeningFile,answer,duration",'where' => "c.id = $id"]);
        $data[0]['duration'] = str_replace('src="/files','src="http://www.smartapply.cn/files',$data[0]['duration']);
        $count = $data[0]['viewCount'];
        Content::updateAll(['viewCount' => ($count+1)],"id=$id");
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode(['data' => $data[0]]).')';
        exit;
    }

    /**
     * 总调度
     * @Obelisk
     */
    public function actionUnifyLogin(){
        $session = Yii::$app->session;
        $logins = new Login();
        $uid = Yii::$app->request->get('uid');
        $username = Yii::$app->request->get('username');
        $phone = Yii::$app->request->get('phone');
        $password = Yii::$app->request->get('password');
        $email =Yii::$app->request->get('email');
        $loginsdata = $logins->find()->where("uid=$uid")->one();
        if(empty($loginsdata['id'])){
            $where = '';
            if(!empty($email) ){
                $where .= empty($where)?"email='$email'":" or email='$email'";
            }
            if(!empty($username) ){
                $where .= empty($where)?"userName='$username'":" or userName='$username'";
            }
            if(!empty($phone) ){
                $where .= empty($where)?"phone='$phone'":" or phone='$phone'";
            }
            $loginsdata = $logins->find()->where("$where")->one();
            if (empty($loginsdata['id'])) {
                $login = new Login();
                $login->phone = $phone;

                $login->userPass = $password;

                $login->email = $email;

                $login->createTime = time();

                $login->userName = $username;
                $login->uid = $uid;
                $login->save();
                $loginsdata = $logins->find()->where("$where")->one();
            }else{
                if($phone != $loginsdata['phone']){
                    Login::updateAll(['phone' => $phone],"id={$loginsdata['id']}");
                }
                if($email != $loginsdata['email']){
                    Login::updateAll(['email' => "$email"],"id={$loginsdata['id']}");
                }
                if($username != $loginsdata['userName']){
                    Login::updateAll(['userName' => "$username"],"id={$loginsdata['id']}");
                }
                if($uid != $loginsdata['uid']){
                    Login::updateAll(['uid' => "$uid"],"id={$loginsdata['id']}");
                }
                $loginsdata = $logins->find()->where("id={$loginsdata['id']}")->one();
            }
        }else{
            if($phone != $loginsdata['phone']){
                Login::updateAll(['phone' => $phone],"id={$loginsdata['id']}");
            }
            if($email != $loginsdata['email']){
                Login::updateAll(['email' => "$email"],"id={$loginsdata['id']}");
            }
            if($username != $loginsdata['userName']){
                Login::updateAll(['userName' => "$username"],"id={$loginsdata['id']}");
            }
            $loginsdata = $logins->find()->where("id={$loginsdata['id']}")->one();
        }
        $session->set('userId', $loginsdata['id']);
        $session->set('userData', $loginsdata);
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode(['userId' => $loginsdata['id'],'sid' => session_id()]).')';
        exit;
    }
}