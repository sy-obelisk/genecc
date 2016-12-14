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


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
class ApiController extends ToeflApiControl
{
    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }

    public $enableCsrfValidation = false;


    /**检查用户做题正确性，并记录
     * @Obelisk
     */

    public function actionCheckAnswer()
    {

        $contentId = Yii::$app->request->post('contentId');

        $answer = Yii::$app->request->post('answer');

        $pid = Yii::$app->request->post('pid');

        $belong = Yii::$app->request->post('belong');

        $startTime = Yii::$app->session->get('startTime');

        $userId = Yii::$app->session->get('userId');

        $userData = Yii::$app->session->get('userData');

        $recordId = Yii::$app->session->get('recordId');

        $app = Yii::$app->request->post('app',0);

        if (!$userId) {

            $re = ['code' => 2];

            die(json_encode($re));

        }

        $saveData = [

            'userId' => $userId,

            'contentId' => $contentId,

            'pid' => $pid,

            'belong' => $belong,

            'answer' => $answer,

            'createTime' => date("Y-m-d H:i:s"),

        ];

        if($belong == 'test'){
            $saveData['recordId'] = $recordId;
        }

        if ($startTime) {

            $saveData['elapsedTime'] = time() - $startTime;

        }

        $trueAnswer = Yii::$app->db->createCommand("select (SELECT ce.value from {{%content_extend}} ce WHERE ce.contentId = c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer from {{%content}} c where c.id =" . $contentId)->queryOne();

        $trueAnswer = $trueAnswer['answer'];

        if ($answer == $trueAnswer) {

            $re = ['code' => 1, 'answer' => $trueAnswer];

            $saveData['answerType'] = 1;

        } else {

            $re = ['code' => 0, 'answer' => $trueAnswer];

            $saveData['answerType'] = 0;

        }
        if($belong != 'test'){
            $sign = UserAnswer::find()->where("contentId = $contentId AND userId = {$saveData['userId']} AND belong='$belong'")->one();
            if($sign){
                UserAnswer::updateAll($saveData,"id=$sign->id");

            } else {
                Yii::$app->db->createCommand()->insert('{{%user_answer}}',$saveData)->execute();

            }
            uc_user_edit_integral($userData['userName'],'听力做题一道',1,2);
        }else{
            $sign = UserAnswer::find()->where("contentId = $contentId AND recordId = $recordId ")->one();
            if($sign){
                UserAnswer::updateAll($saveData,"id=$sign->id");

            } else {

                Yii::$app->db->createCommand()->insert('{{%user_answer}}',$saveData)->execute();

            }
        }


        Yii::$app->session->remove('startTime');

        if ($app) {

            Yii::$app->session->set('startTime', time());

        }

        die(json_encode($re));

    }


    /**
     *
     * 听力首页，top 搜索与分页获取内容
     * @Obelisk
     */


    public function actionChangeContent()
    {

        $model = new Content();

        $tpo = Yii::$app->request->post('tpo');

        $tpoType = Yii::$app->request->post('tpoType');

        $page = Yii::$app->request->post('page');

        $content = $model->getContent($tpo, $tpoType, $page);

//        $count = $content['count'];

//        $pageStr = $content['pageStr'];

        $content = $content['content'];

        die(json_encode(['code' => 1, 'content' => $content]));

    }


    /**
     * tpo,获取问题
     * @Obelisk
     */

    public function actionChangeQuestion()
    {

        $model = new Content();

        $discussModel = new UserDiscuss();

        $contentId = Yii::$app->request->post('contentId');

        $question = $model->getOneQuestion($contentId);

        $parentQuest = $model->getOneQuestion($question['pid']);

        $select = explode("<br />", nl2br($question['questSelect']));

        $str = '';

        if ($question['questType'] == 1) {

            $name = explode(",", $select[0]);

            $count = count($name);

            $str .= '<table border="1" cellspacing="0" borderColor="#d2d2d2" width="700" cellpadding="0" style="border-collapse:collapse;">';

            $str .= '<tr>';

            $str .= '<th></th>';

            foreach ($name as $v) {

                $str .= '<th>' . $v . '</th>';

            }


            $str .= '</tr>';

            foreach ($select as $k => $val) {

                if ($k == 0) {

                    continue;

                }

                $str .= '<tr>';

                $str .= '<td>' . $val . '</td>';

                for ($i = 0; $i < $count; $i++) {

                    $str .= '<td class="tab-align"><input class="question" value="' . chr(ord('A') + intval($i)) . '" type="radio" name="rad0' . $k . '"/></td>';

                }

                $str .= '</tr>';

            }

            $str .= '</table>';

        }elseif($question['questType'] == 2){

            $str .= '<ul>';


            foreach ($select as $k => $v) {

                if ($k == 0) {

                    $str .= '<li><label for="ques0' . ($k + 1) . '"> ' . $v . '</label></li>';

                } else {

                    $str .= '<li><label for="ques0' . ($k + 1) . '">' . $v . '</label></li>';

                }

            }

            $str .= '</ul>';
            $str .='<span class="fontColor">Please send the answer in order to fill in the box below:<br/><input id="sortAnswer" type="text" value=""></span>';
        } else {

            $str .= '<ul>';

            $type = strlen($question['answer']) > 1 ? 'checkBox' : 'radio';

            foreach ($select as $k => $v) {

                if ($k == 0) {

                    $str .= '<li><input class="question" value="' . chr(ord('A') + intval($k)) . '" type="' . $type . '" name="question" id="ques0' . ($k + 1) . '"/><label for="ques0' . ($k + 1) . '"> ' . $v . '</label></li>';

                } else {

                    $str .= '<li><input class="question" value="' . chr(ord('A') + intval($k)) . '" type="' . $type . '" name="question" id="ques0' . ($k + 1) . '"/><label for="ques0' . ($k + 1) . '">' . $v . '</label></li>';

                }

            }

            $str .= '</ul>';

        }


        $discuss = $discussModel->getContentDiscuss($contentId);

        $question['questSelect'] = $str;

        $question['text'] = $parentQuest['text'];

        $question['catName'] = $parentQuest['catName'];

        $question['preName'] = $parentQuest['name'];

        $question['preFile'] = $parentQuest['file'];

        $question['discuss'] = $discuss;

        Yii::$app->session->set('startTime', time());

        die(json_encode($question));

    }


    /**
     * 获取基础听词内容
     * @Obelisk
     */

    public function actionGetBasicContent()
    {

        $model = new Content();

        $basic = Yii::$app->request->post('basic');

        $page = Yii::$app->request->post('page');

        $re = $model->getBasicContent($basic, $page);

        die(json_encode($re));


    }


    /**
     * 添加讨论
     * @Obelisk
     */

    public function actionAddDiscuss()
    {

        $model = new UserDiscuss();

        $model->pid = Yii::$app->request->post('pid');

        $model->status = Yii::$app->request->post('status', 1);

        $userId = $model->userId = Yii::$app->session->get('userId');
        if (!$userId) {
            die(json_encode(['code' => 2, 'message' => '请登录']));
        }
        $model->discussContent = Yii::$app->request->post('content');

        $model->contentId = Yii::$app->request->post('contentId');

        $model->type = Yii::$app->request->post('type');

        $model->createTime = date("Y-m-d H:i:s");

        $re = $model->save();

        if ($re) {

            die(json_encode(['code' => 1, 'user' => $userId]));

        } else {

            die(json_encode(['code' => 0, 'message' => '提交失败，请重试']));

        }


    }


    /**
     * 讨论分页
     * @Obelisk
     */

    public function actionDiscussPage()
    {

        $model = new UserDiscuss();

        $contentId = Yii::$app->request->post('contentId');

        $page = Yii::$app->request->post('page');

        $discuss = $model->getContentDiscuss($contentId, $page);

        die(json_encode($discuss));


    }


    /**
     * 引用回复
     * @Obelisk
     */

    public function actionChildDiscuss()
    {

        $discussId = Yii::$app->request->post('discussId');

        $data = Yii::$app->db->createCommand("SELECT u.nickname,u.userName,u.image,d.* from {{%user_discuss}} d left join {{%user}} u on d.userId = u.id where d.pid = $discussId order by d.createTime ASC ")->queryAll();

        foreach ($data as $k => $v) {

            if (!$v['nickname']) {

                $data[$k]['nickname'] = $v['userName'];

            }

            if (!$v['image']) {

                $data[$k]['image'] = '/cn/images/details_defaultImg.png';

            }

        }

        die(json_encode($data));

    }


    /**
     * 获取模考文章信息
     * @Obelisk
     */

    public function actionGetTest()
    {

        $model = new Content();

        $recordModel = new HistoryRecord();

        $userId = Yii::$app->session->get('userId');

        $id = Yii::$app->request->post('id');

        $num = Yii::$app->request->post('num');

        $statisticsId = Yii::$app->session->get('statisticsId');

//        $sign = $recordModel->find()->where("userId=$userId AND testId=$id AND isBreak=1 AND recordType=1")->one();

//        if(!$sign){
//
//            $recordModel->testId = $id;
//
//            $recordModel->isBreak = 1;
//
//            $recordModel->startTime = time();
//
//            $recordModel->endTime = time();
//
//            $recordModel->userId = $userId;
//
//            $recordModel->achieve = $num;
//
//            $recordModel->recordType = 1;
//
//            $recordModel->save();
//
//        }else{

        if($num<7){

            $recordModel->updateAll(['achieve' => $num,'endTime' => time()],"statisticsId=$statisticsId AND userId=$userId AND testId=$id");
        }
//
//        }

        $data = $model->getPrContent($id, $num);

        if ($data) {

            $data['code'] = 1;

            die(json_encode($data));

        } else {

            die(json_encode(['code' => 2]));

        }

    }


    /**
     * 获取模考问题信息
     * @Obelisk
     */

    public function actionTestQuestion()
    {

        $model = new Content();

        $answerModel = new UserAnswer();

        $contentId = Yii::$app->request->post('contentId');

        $testId = Yii::$app->request->post('id');

        $userId = Yii::$app->session->get('userId');

        $statisticsId = Yii::$app->session->get('statisticsId');

        $recordId = Yii::$app->session->get('recordId');

        $questionNum =  Yii::$app->request->post('questionNum');

        $correct = $answerModel->getTestCorrect($recordId);

        $num = $answerModel->getTestNum($recordId);

        HistoryRecord::updateAll(['endTime' => time(),'num' => $num,'correct' => $correct],"statisticsId=$statisticsId AND userId=$userId AND testId=$testId");

        $data = $model->getTestQuestion($contentId, $questionNum);

        $select = explode("<br />", nl2br($data['questSelect']));

        $str = '';

        if ($data['questType'] == 1) {

            $name = explode(",", $select[0]);

            $count = count($name);

            $str .= '<table border="1" cellspacing="0" borderColor="#d2d2d2" width="700" cellpadding="0" style="border-collapse:collapse;">';

            $str .= '<tr>';

            $str .= '<th></th>';

            foreach ($name as $v) {

                $str .= '<th>' . $v . '</th>';

            }


            $str .= '</tr>';

            foreach ($select as $k => $val) {

                if ($k == 0) {

                    continue;

                }

                $str .= '<tr>';

                $str .= '<td>' . $val . '</td>';

                for ($i = 0; $i < $count; $i++) {

                    $str .= '<td class="tab-align"><input class="questionAnswer" value="' . chr(ord('A') + intval($i)) . '" type="radio" name="rad0' . $k . '"/></td>';

                }

                $str .= '</tr>';

            }

            $str .= '</table>';

        }elseif($data['questType'] == 2){

            $str .= '<ul>';


            foreach ($select as $k => $v) {

                if ($k == 0) {

                    $str .= '<li><label for="ques0' . ($k + 1) . '"> ' . $v . '</label></li>';

                } else {

                    $str .= '<li><label for="ques0' . ($k + 1) . '">' . $v . '</label></li>';

                }

            }

            $str .= '</ul>';
            $str .='<span class="fontColor">Please send the answer in order to fill in the box below:<br/><input id="sortAnswer" type="text" value=""></span>';
        }else {

            $str .= '<ul>';

            $type = strlen($data['answer']) > 1 ? 'checkBox' : 'radio';

            foreach ($select as $k => $v) {

                if ($k == 0) {

                    $str .= '<li><input class="questionAnswer" value="' . chr(ord('A') + intval($k)) . '" type="' . $type . '" name="question" id="ques0' . ($k + 1) . '"/><label for="ques0' . ($k + 1) . '"> ' . $v . '</label></li>';

                } else {

                    $str .= '<li><input class="questionAnswer" value="' . chr(ord('A') + intval($k)) . '" type="' . $type . '" name="question" id="ques0' . ($k + 1) . '"/><label for="ques0' . ($k + 1) . '">' . $v . '</label></li>';

                }

            }

            $str .= '</ul>';

        }

        $data['questSelect'] = $str;

        die(json_encode($data));

    }


    /**
     * 提交当前模考
     * @Obelisk
     */

    public function actionSubmitTest()
    {

        $model = new UserAnswer();

//        $testId =  Yii::$app->request->post('testId');

        $recordId = Yii::$app->session->get('recordId');

//        $userId = Yii::$app->session->get('userId');

        $correct = $model->getTestCorrect($recordId);

        HistoryRecord::updateAll(['achieve' => '','isBreak' => 2,'num' => 34,'correct' => $correct,'endTime' => time()],"id=$recordId");
        $model = new UserAnswer();
        $model->deleteOneTest($recordId);
        $plate = Yii::$app->session->get('plate');
        unset($plate['listen']);
        Yii::$app->session->set('plate',$plate);
        die(json_encode(['code' => 1]));
    }


    /**
     * 用户登录
     * @Obelisk
     */

    public function actionCheckLogin()

    {
        $apps = Yii::$app->request;

        $session = Yii::$app->session;
        $logins = new Login();
        $cartModel = new ShoppingCart();
        if ($apps->isPost) {
            $verificationCode   = $apps->post('verificationCode','');
            if($verificationCode){
                if(strtolower($session->get('verificationCode'))!=strtolower($verificationCode )){
                    $re['code'] = 0;

                    $re['message'] = '验证码错误';

                    die(json_encode($re));
                }
            }

            $userName = $apps->post('userName');

            $userPass = $apps->post('userPass');

            if (!$userName) {

                $re['code'] = 0;

                $re['message'] = '请输入用户名';

                die(json_encode($re));

            }

            $userPass = md5($userPass);
            list($uid, $username, $password, $email,$merge,$phone) = uc_user_login($userName, $userPass);
            if($uid < 0){
                list($uid, $username, $password, $email,$merge,$phone) = uc_user_login($userName, $userPass,2);
                if($uid < 0){
                    list($uid, $username, $password, $email,$merge,$phone) = uc_user_login($userName, $userPass,3);
                }
            }
            if($uid > 0) {
                $success_content =  uc_user_synlogin($uid);
                $loginsdata = $logins->find()->where("(phone='$userName' or userName='$userName' or email='$userName')")->one();

                if (empty($loginsdata['id'])) {
                    $login = new Login();
                    $login->phone = $phone;

                    $login->userPass = $password;

                    $login->email = $email;

                    $login->createTime = time();

                    $login->userName = $username;
                    $login->uid = $uid;
                    $login->save();
                    $loginsdata = $logins->find()->where("(phone='$userName' or userName='$userName' or email='$userName')")->one();
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
                $session->set('userId', $loginsdata['id']);
                $session->set('userData', $loginsdata);
                $cartModel->mergeCart();
                $re['code'] = 1;
                $re['message'] = '登录成功';
                $session->set('success_content',$success_content);
            } elseif($uid == -1) {
                $re['code'] = 0;
                $re['message'] = '用户名错误';
            } elseif($uid == -2) {
                $re['code'] = 0;
                $re['message'] = '密码错误';
            } else {
                $re['code'] = 0;
                $re['message'] = '未定义';
            }
            die(json_encode($re));

        }

    }


    /**
     * 短信接口
     * @Obelisk
     */

    public function actionPhoneCode()

    {

        $session = Yii::$app->session;

        $sms = new Sms();

        $phoneNum = Yii::$app->request->post('phoneNum');

        if (!empty($phoneNum)) {

            $phoneCode = mt_rand(100000, 999999);

            $session->set($phoneNum . 'phoneCode', $phoneCode);

            $session->set('phoneTime', time());

            $content = '【小申托福在线】【SmartApply留学商城】验证码：' . $phoneCode . '（10分钟有效），您正在通过手机注册SmartApply留学商城免费会员！关注微信:toeflgo，获取更多信息；若有gmat/toefl/留学等问题，请咨询管理员QQ/微信2649471578
';
            $sms->send($phoneNum, $content, $ext = '', $stime = '', $rrid = '');

            $res['code'] = 1;

            $res['message'] = '短信发送成功！';

        } else {

            $res['code'] = 0;

            $res['message'] = '发送失败!手机号码为空！';

        }

        die(json_encode($res));

    }


    /**
     * 用户注册
     * @Obelisk
     */

    public function actionRegister()
    {
//        $data = Login::find()->all();
//        foreach($data as $v){
//            if($v['userName'] == null || $v['userName'] == ''){
//                $v['userName'] = '托福'.rand(1,888888);
//            }
//            $uid = uc_user_register($v['userName'],$v['userPass'],$v['email'],$v['phone'],'托福PC',$v['createTime']);
//            Login::updateAll(['uid' => $uid],"id={$v['id']}");
//            echo $uid;
//        }
//        die;
        $login = new Login();
        $registerStr = Yii::$app->request->post('registerStr');

        $pass = Yii::$app->request->post('pass');

        $code = Yii::$app->request->post('code');

        $type = Yii::$app->request->post('type');

        $source = Yii::$app->request->post('source','托福商城');

        $userName = Yii::$app->request->post('userName','');

        if(!$userName){
            $userName =  'toefl'.time();
        }

        $checkTime = $login->checkTime();

        if ($checkTime) {

            $checkCode = $login->checkCode($registerStr, $code);

            if ($checkCode) {

                if ($type == 1) {

                    $login->phone = $registerStr;

                    $login->userPass = md5($pass);

                    $login->createTime = time();

                    $login->userName = $userName;
                    $uid = uc_user_register($userName,md5($pass),'',$registerStr,$source,time());

                } else {

                    $login->email = $registerStr;

                    $login->userPass = md5($pass);

                    $login->createTime = time();

                    $login->userName = $userName;
                    $uid = uc_user_register($userName,md5($pass),$registerStr,'',$source,time());
                }
                if($uid <0){
                    if($uid == -1) {
                        $res['code'] = 0;
                        $res['message'] = '用户名已经被注册';
                    } elseif($uid == -2) {
                        $res['code'] = 0;
                        $res['message'] = '包含要允许注册的词语';
                    } elseif($uid == -3) {
                        $res['code'] = 0;
                        $res['message'] = '用户名已经存在';
                    } elseif($uid == -4) {
                        $res['code'] = 0;
                        $res['message'] = 'Email 格式有误';
                    } elseif($uid == -5) {
                        $res['code'] = 0;
                        $res['message'] = 'Email 不允许注册';
                    } elseif($uid == -6) {
                        $res['code'] = 0;
                        $res['message'] = '该 Email 已经被注册';
                    } elseif($uid == -7){
                        $res['code'] = 0;
                        $res['message'] = '电话已被注册';
                    }
                }else{
                    $login->uid = $uid;
                    $re = $login->save();
                    if ($re) {

                        $res['code'] = 1;

                        $res['message'] = '注册成功';

                        uc_user_edit_integral($userName,'注册成功',1,10);

                    } else {

                        $res['code'] = 0;

                        $res['message'] = '注册失败，请重试';

                        $res['type'] = '3';

                    }
                }
            } else {

                $res['code'] = 0;

                $res['message'] = '验证码错误';

                $res['type'] = '1';

            }

        } else {

            $res['code'] = 0;

            $res['message'] = '验证码过期';

            $res['type'] = '1';

        }

        die(json_encode($res));

    }

    /**
     * 短信登录
     * @Obelisk
     */

    public function actionPhoneLogin()
    {
        $login = new Login();
        $phone = Yii::$app->request->post('phone');

        $code = Yii::$app->request->post('code');

        $session = Yii::$app->session;

        $source = Yii::$app->request->post('source','托福商城');

        $checkTime = $login->checkTime();

        if ($checkTime) {

            $checkCode = $login->checkCode($phone, $code);

            if ($checkCode) {
                $sign = uc_get_user($phone,2);
                if($sign){
                    list($uid, $username, $email, $phone) = $sign;
                    $sign = Login::find()->where("userName='$username'")->one();
                    if($sign){
                        $session->set('userId', $sign['id']);
                        $session->set('userData', $sign);
                    }else{
                        $login->phone = $phone;

                        $login->userPass = md5('toefl123');

                        $login->createTime = time();

                        $login->userName = $username;

                        $login->email = $email;

                        $login->uid = $uid;

                        $login->save();

                        $sign = Login::findOne($login->primaryKey);

                        $session->set('userId', $sign['id']);
                        $session->set('userData', $sign);
                    }
                }else{
                    $username = '托福'.rand(1,8888888);
                    $uid = uc_user_register($username,md5('toefl123'),'',$phone,$source,time());

                    $login->phone = $phone;

                    $login->userPass = md5('toefl123');

                    $login->createTime = time();

                    $login->userName = $username;

                    $login->uid = $uid;

                    $login->save();

                    $sign = Login::findOne($login->primaryKey);

                    $session->set('userId', $sign['id']);
                    $session->set('userData', $sign);
                }
                $success_content =  uc_user_synlogin($uid);
                $session->set('success_content',$success_content);
                $res['code'] = 1;

                $res['message'] = '登录成功';
            } else {

                $res['code'] = 0;

                $res['message'] = '验证码错误';

                $res['type'] = '1';

            }

        } else {

            $res['code'] = 0;

            $res['message'] = '验证码过期';

            $res['type'] = '1';

        }

        die(json_encode($res));

    }


    /**
     * 发送邮箱
     * @Obelisk
     */

    public function actionSendMail()
    {

        $session = Yii::$app->session;

        $emailCode = mt_rand(100000, 999999);

        $email = Yii::$app->request->post('email');

        $session->set($email . 'phoneCode', $emailCode);

        $session->set('phoneTime', time());

        $mail = Yii::$app->mailer->compose();

        $mail->setTo($email);

        $mail->setSubject("【SmartApply留学商城】邮件验证码");

        $mail->setHtmlBody('

            <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

            <div style="width: 800px;margin: 0 auto;margin-bottom: 10px">

                 <img src="http://www.smartapply.cn/cn/images/head_logo.png" alt="logo">

            </div>

            <div style="width: 830px;border: 1px #dcdcdc solid;margin: 0 auto;overflow: hidden">

                 <p style="font-weight: bold;font-size: 18px;margin-left: 20px;color: #34388e;font-family: 微软雅黑;">亲爱的用户 ：</p>

                <span style="margin-left: 20px;font-family: 微软雅黑;">

            你好！你正在注册SmartApply留学商城，网址<a href="http://www.smartapply.cn">www.smartapply.cn</a>。你的验证码为：【<span style="color:#ff913e;">' . $emailCode . '</span>】。（有效期为：此邮件发出后48小时）
                </span>
                <p style="margin-left: 20px;font-family: 微软雅黑;">
                添加微信公众号：<span style="color:green;font-weight:bold">小申托福在线</span>，获取出国留学最新信息~
                </p>
            <div style="width: 100%;background: #e8e8e8;padding:5px 20px;font-size:12px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;margin-top: 30px;color: #808080;font-family: 微软雅黑;">

            温馨提示：请你注意保护你的邮箱，避免邮件被他人盗用哟！

            </div>

            </div>

            <div style="font-size: 12px;width: 800px;margin: 0 auto;text-align: right;color: #808080;">


        </div>

        '

        );    //发布可以带html标签的文本

        if ($mail->send()) {

            $res['code'] = 1;

            $res['message'] = '邮件发送成功！';

        } else {

            $res['code'] = 0;

            $res['message'] = '邮件发送失败！';

        }

        die(json_encode($res));

    }


    /**
     * 注销账户
     * @return string
     * */

    public function actionLoginOut()

    {

        $session = Yii::$app->session;

        $startListening = $session->get('startListening');

        $userId = $session->get('userId');

        if ($startListening) {

            $testId = Yii::$app->session->get('testId');

            $deltaTime = time() - $startListening;

            $sign = HistoryRecord::find()->where("userId=$userId AND testId=$testId AND recordType=2")->one();

            HistoryRecord::updateAll(['deltaTime' => $sign->deltaTime + $deltaTime], "userId=$userId AND testId=$testId AND recordType=2");

            Yii::$app->session->remove('startListening');

            Yii::$app->session->remove('testId');

        }

        $session->remove('userData');

        $session->remove('userId');

        @unlink("html\cn\heard.html");
        $loginOut = uc_user_synlogout();
        $session->set('loginOut',$loginOut);
        die(json_encode(['code' => 1]));

    }


    /**
     * 找回密码
     * @return string
     * */

    public function actionFindPass()

    {

        $login = new Login();

        $registerStr = Yii::$app->request->post('registerStr');

        $pass = Yii::$app->request->post('pass');

        $code = Yii::$app->request->post('code');

        $type = Yii::$app->request->post('type');

        $re = $login->find()->where("phone='$registerStr' or email='$registerStr'")->one();
        $userData = [1 => $re->userName];
        if (!$re) {
            if ($type == 1) {
                $status = uc_user_checkphone($registerStr);
                if($status){
                    $userData = uc_get_user($registerStr,2);
                    $login->userName = $userData[1];
                    $login->email = $userData[2];
                    $login->phone = $userData[3];
                    $login->createTime = time();
                    $login->save();
                }else{
                    $res['code'] = 0;
                    $res['message'] = '此电话还没有注册！';
                    die(json_encode($res));
                }
            } else{
                $status = uc_user_checkemail($registerStr);
                if($status){
                    $userData = uc_get_user($registerStr,3);
                    $login->userName = $userData[1];
                    $login->email = $userData[2];
                    $login->phone = $userData[3];
                    $login->createTime = time();
                    $login->save();
                }else {
                    $res['code'] = 0;
                    $res['message'] = '此邮箱还没有注册！';
                    die(json_encode($res));
                }
            }
        }

        $checkTime = $login->checkTime();

        if ($checkTime) {

            $checkCode = $login->checkCode($registerStr, $code);

            if ($checkCode) {

                if ($type == 1) {
                    $re = $login->updateAll(['userPass' => md5($pass)], "phone='$registerStr'");
                } else {
                    $re = $login->updateAll(['userPass' => md5($pass)], "email='$registerStr'");
                }

                if ($re) {
                    uc_user_edit($userData[1],'',$pass,'','',1);
                    $res['code'] = 1;

                    $res['message'] = '密码找回成功';


                } else {

                    $res['code'] = 0;

                    $res['message'] = '找回失败，请重试';

                    $res['type'] = '3';

                }

            } else {

                $res['code'] = 0;

                $res['message'] = '验证码错误';

                $res['type'] = '1';

            }

        } else {

            $res['code'] = 0;

            $res['message'] = '验证码过期';

            $res['type'] = '1';

        }

        die(json_encode($res));


    }





    /**
     * 取消收藏
     * @Obelisk
     */

    public function actionDeleteCollect()
    {

        $id = Yii::$app->request->post('id', '');

        $contentId = Yii::$app->request->post('contentId');

        $collectType = Yii::$app->request->post('collectType');

        if ($id) {

            $sign = Collect::deleteAll("id=$id");

        } else {

            $userId = Yii::$app->session->get('userId');

            $contentId = Yii::$app->request->post('contentId');

            $sign = Collect::deleteAll("contentId=$contentId AND userId=$userId AND collectType=$collectType");

        }

        if ($sign) {

            $res['code'] = 1;

            $res['message'] = '取消成功';

        } else {

            $res['code'] = 0;

            $res['message'] = '取消失败，请重试';

        }

        die(json_encode($res));

    }


    /**
     * 添加收藏
     * @Obelisk
     */

    public function actionAddCollect()
    {

        $userId = Yii::$app->session->get('userId');

        if ($userId) {

            $contentId = Yii::$app->request->post('contentId');
            $sign = Collect::find()->where("contentId=$contentId AND userId=$userId")->one();
            if($sign){
                $res['code'] = 0;

                $res['message'] = '已收藏';
                
                die(json_encode($res));
            }
            $collectType = Yii::$app->request->post('collectType');

            $num = Yii::$app->request->post('num');

            $model = new Collect();

            $model->contentId = $contentId;

            $model->userId = $userId;

            $model->num = $num;

            $model->collectType = $collectType;

            $model->createTime = time();

            $sign = $model->save();

            if ($sign) {

                $res['code'] = 1;

                $res['message'] = '收藏成功';

            } else {

                $res['code'] = 0;

                $res['message'] = '收藏失败，请重试';

            }

        } else {

            $res['code'] = 2;

            $res['message'] = '请登录';

        }

        die(json_encode($res));

    }


    /**
     * 收藏分页
     * @Obelisk
     */

    public function actionCollectPage()
    {

        $type = Yii::$app->request->post('type');

        $page = Yii::$app->request->post('page');

        $pageSize = Yii::$app->request->post('pageSize', 8);

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $model = new Collect();

        $data = $model->getCollect($userId, $type, $page, $pageSize);

        die(json_encode($data));

    }


    /**
     * 上传头像
     * @Obelisk
     */

    public function actionUpImage()
    {

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $userData = $session->get('userData');

        $image = Yii::$app->request->post('image');

        $sign = Login::updateAll(['image' => $image], "id=$userId");

        if ($sign) {

            $userData['image'] = $image;

            $session->set('userData', $userData);

            $res['code'] = 1;

            $res['message'] = '更换成功';

        } else {

            $res['code'] = 0;

            $res['message'] = '更换失败，请重试';

        }

        die(json_encode($res));

    }


    /**
     * App上传头像
     * @Obelisk
     */

    public function actionAppImage()
    {

        $file = $_FILES['upload'];

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $upload = new UploadFile();

        $upload->int_max_size = 3145728;

        $upload->arr_allow_exts = array('jpg', 'gif', 'png', 'jpeg');

        $upload->str_save_path = Yii::$app->params['upImage'];

        $arr_rs = $upload->upload($file);

        if ($arr_rs['int_code'] == 1) {

            $filePath = '/' . Yii::$app->params['upImage'] . $arr_rs['arr_data']['arr_data'][0]['savename'];

            $userData = $session->get('userData');

            $sign = Login::updateAll(['image' => $filePath], "id=$userId");

            if ($sign) {

                $userData['image'] = $filePath;

                $session->set('userData', $userData);

                $res['code'] = 1;

                $res['message'] = '上传成功';

                $res['image'] = $filePath;

            } else {

                $res['code'] = 1;

                $res['message'] = '服务器错，误请重试';

            }


        } else {

            $res['code'] = 0;

            $res['message'] = '上传失败，请重试';

        }

        die(json_encode($res));

    }


    /**
     * 修改用户资料
     * @Obelisk
     */

    public function actionChangeUserInfo()
    {

        $model = new Login();

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $phoneCode = Yii::$app->request->post('phoneCode', '');

        $phone = Yii::$app->request->post('phone', '');

        $nickname = Yii::$app->request->post('nickname', '');

        $school = Yii::$app->request->post('school');

        $major = Yii::$app->request->post('major');

        $grade = Yii::$app->request->post('grade');

        $sign = Login::find()->where("id!=$userId AND nickname='$nickname'")->one();

        if ($sign) {

            die(json_encode(['code' => 0, 'message' => '昵称已经被使用']));

        }
        $userInfo = [];
        if ($nickname) {
            $userInfo['nickname'] = $nickname;
        }
        if ($phone) {
            $userInfo['phone'] = $phone;
        }
        if ($school) {
            $userInfo['school'] = $school;
        }
        if ($major) {
            $userInfo['major'] = $major;
        }
        if ($grade) {
            $userInfo['grade'] = $grade;
        }
        if ($phone) {

            $signPhone = Login::find()->where("id=$userId AND phone='$phone'")->one();

            if (!$signPhone) {

                $status = uc_user_checkphone($phone);
                if ($status == -7) {

                    die(json_encode(['code' => 0, 'message' => '该手机已被其他用户绑定']));

                }

                $checkTime = $model->checkTime();

                if ($checkTime) {

                    $checkCode = $model->checkCode($phone, $phoneCode);

                    if ($checkCode) {

                        $model->updateAll($userInfo, "id=$userId");

                        $userData = $model->findOne($userId);

                        Yii::$app->session->set('userData', $userData);

                        $res['code'] = 1;

                        $res['message'] = '保存成功';
                        uc_user_edit($userData->userName,'','','',$phone,1);

                    } else {

                        $res['code'] = 0;

                        $res['message'] = '验证码错误';

                    }

                } else {

                    $res['code'] = 0;

                    $res['message'] = '验证码过期';

                }

            } else {

                $model->updateAll($userInfo, "id=$userId");

                $userData = $model->findOne($userId);

                Yii::$app->session->set('userData', $userData);

                $res['code'] = 1;

                $res['message'] = '保存成功';

            }

        } else {

            $model->updateAll($userInfo, "id=$userId");

            $userData = $model->findOne($userId);

            Yii::$app->session->set('userData', $userData);

            $res['code'] = 1;

            $res['message'] = '保存成功';

        }

        die(json_encode($res));

    }


    /**
     * 修改用户邮箱
     * @Obelisk
     */

    public function actionChangeUserEmail()
    {

        $model = new Login();

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $emailCode = Yii::$app->request->post('emailCode');

        $email = Yii::$app->request->post('email');

        $sign = uc_user_checkemail($email);

        if ($sign == -6) {

            die(json_encode(['code' => 0, 'message' => '该邮箱已被使用']));

        }

        $checkTime = $model->checkTime();

        if ($checkTime) {

            $checkCode = $model->checkCode($email, $emailCode);

            if ($checkCode) {

                $model->updateAll(['email' => $email], "id=$userId");

                $userData = $model->findOne($userId);

                Yii::$app->session->set('userData', $userData);

                $res['code'] = 1;

                $res['message'] = '保存成功';
                uc_user_edit($userData->userName,'','',$email,'',1);

            } else {

                $res['code'] = 0;

                $res['message'] = '验证码错误';

            }

        } else {

            $res['code'] = 0;

            $res['message'] = '验证码过期';

        }

        die(json_encode($res));

    }


    /**
     * 修改用户密码
     * @Obelisk
     */

    public function actionChangeUserPass()
    {

        $model = new Login();

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $oldPassword = Yii::$app->request->post('oldPassword');

        $userData = $model->findOne($userId);

        $newPassword = Yii::$app->request->post('newPassword');

        $sign = uc_user_edit($userData->userName,$oldPassword,$newPassword,'','');

        if ($sign == -1) {

            die(json_encode(['code' => 0, 'message' => '旧密码不正确']));

        } else {

            $model->updateAll(['userPass' => md5($newPassword)], "id=$userId");

            $userData = $model->findOne($userId);

            Yii::$app->session->set('userData', $userData);

            $res['code'] = 1;

            $res['message'] = '保存成功';

        }

        die(json_encode($res));

    }


    /**
     * 练习结果
     * @Obelisk
     */

    public function actionPracticeRow()
    {

        $session = Yii::$app->session;

        $userId = $session->get('userId');

        $pieceId = Yii::$app->request->post('pieceId');

        $model = new UserAnswer();

        $record = $model->getListenRecord($userId, $pieceId);

        die(json_encode($record));

    }


    /**
     * 精听修改TPO
     * @Obelisk
     */

    public function actionListeningChangeTpo()
    {

        $tpo = Yii::$app->request->post('tpo');

        $model = new Content();

        $data = $model->ListeningChangeTpo($tpo);

        die(json_encode($data));

    }


    /**
     * 听写提交
     * @Obelisk
     */

    public function actionSubDictation()
    {

        $contentId = Yii::$app->request->post('contentId');

        $answer = Yii::$app->request->post('answer');

        $pid = Yii::$app->request->post('pid');

        $belong = Yii::$app->request->post('belong');

        $userId = Yii::$app->session->get('userId');

        if (!$userId) {

            $re = ['code' => 2];

            die(json_encode($re));

        }

        $saveData = [

            'userId' => $userId,

            'contentId' => $contentId,

            'pid' => $pid,

            'belong' => $belong,

            'answer' => serialize($answer),

            'createTime' => date("Y-m-d H:i:s"),

        ];

        $sign = UserAnswer::find()->where("contentId = $contentId AND userId = $userId AND belong='$belong'")->one();

        if ($sign) {

            UserAnswer::updateAll($saveData, "id=$sign->id");

        } else {

            Yii::$app->db->createCommand()->insert(tablePrefix . "user_answer", $saveData)->execute();

        }

        $re = ['code' => 1, 'message' => '保存成功'];

        die(json_encode($re));

    }

    /**
     * 根据小分类获取文章信息接口
     * @Obelisk
     */
    public function actionTpoCatChange()
    {
        $catId = Yii::$app->request->post('catId');
        $model = new Content();
        $content = $model->getTpoCatChange($catId);
        die(json_encode($content));
    }

    /**
     * 备考资料分页
     * @Obelisk
     */
    public function actionReferencePage()
    {
        $page = Yii::$app->request->post('page');
        $catId = Yii::$app->request->post('catId');
        $pageSize = Yii::$app->request->post('pageSize', 7);
        $model = new Content();
        $data = $model->getClass(['pageStr' => 1, 'fields' => 'A,performance,description', 'category' => "$catId", 'pageSize' => $pageSize, 'page' => $page]);
        $pageStr = $data['pageStr'];
        unset($data['pageStr']);
        foreach ($data as $k => $v) {
            $data[$k]['createTime'] = strtotime($v['createTime']);
        }
        die(json_encode(['data' => $data, 'pageStr' => $pageStr]));
    }

    /**
     * 口语TPO列表切换
     * @Obelisk
     */
    public function actionSpokenTpo()
    {
        $category = Yii::$app->request->post('category');
        $model = new Content();
        $tpoData = $model->getSpokenTpo($category);
        die(json_encode($tpoData));
    }

    /**
     * 口语黄金80题列表切换
     * @Obelisk
     */
    public function actionChangeGold()
    {
        $page = Yii::$app->request->post('page');
        $model = new Content();
        $goldData = $model->changeGold($page);
        die(json_encode($goldData));
    }

    /**
     * 保存口语练习结果
     * @Obelisk
     */
    public function actionSaveSpoken()
    {
        $contentId = Yii::$app->request->post('contentId');
        $answer = Yii::$app->request->post('answer');
        $belong = Yii::$app->request->post('belong');
        $userId = Yii::$app->session->get('userId');
        $recordId = Yii::$app->session->get('recordId');
        $model = new UserAnswer();
        if (!$userId) {

            $re = ['code' => 2];

            die(json_encode($re));

        }
        if($belong != 'spokenTest'){
            $model->userId = $userId;
            $model->contentId = $contentId;
            $model->answer = $answer;
            $model->belong = $belong;
            $model->createTime = date("Y-m-d H:i:s");
            $sign = $model->save();
        }else{
            $sign = $model->find()->where("contentId=$contentId AND recordId=$recordId")->one();
            if($sign){
                $model->updateAll(['answer' => $answer,'createTime' => date("Y-m-d H:i:s")],"id=$sign->id");
            }else{
                $model->userId = $userId;
                $model->contentId = $contentId;
                $model->answer = $answer;
                $model->belong = $belong;
                $model->recordId = $recordId;
                $model->createTime = date("Y-m-d H:i:s");
                $sign = $model->save();
            }
        }
        if ($sign) {

            $re = ['code' => 1, 'message' => '保存成功', 'recordId' => $model->primaryKey];

        } else {
            $re = ['code' => 0, 'message' => '保存失败'];
        }

        die(json_encode($re));
    }

    /**
     * 口语记录分页
     * @Obelisk
     */
    public function actionSpokenPage()
    {
        $userId = Yii::$app->session->get('userId');

        $page = Yii::$app->request->post('page');

        $type = Yii::$app->request->post('type');

        $pageSize = Yii::$app->request->post('pageSize', 8);

        $model = new UserAnswer();

        $data = $model->getSpokenRecord($userId, $type, $pageSize, $page);

        die(json_encode($data));
    }

    /**
     * 口语音频上传
     * @Obelisk
     */
    public function actionSpokenUpload()
    {

        $token = Yii::$app->request->post('token');
        $session = Yii::$app->session;
        $authenticity_token = $session->get('authenticity_token');
        if ($token == $authenticity_token) {

            $file = $_FILES['upload_file'];

            $upload = new UploadFile();

            $upload->int_max_size = 20145728;

            $upload->arr_allow_exts = array('mp3', 'ogg', 'wav');

            $upload->str_save_path = Yii::$app->params['upSpoken'];

            $arr_rs = $upload->upload($file);

            if ($arr_rs['int_code'] == 1) {

                $filePath = '/' . Yii::$app->params['upSpoken'] . $arr_rs['arr_data']['arr_data'][0]['savename'];

                $res['code'] = 1;

                $res['file'] = $filePath;

                $res['message'] = '上传成功';

            } else {

                $res['code'] = 0;

                $res['message'] = '上传失败，请重试';

            }
        } else {
            $res['code'] = 0;

            $res['message'] = '上传失败，令牌错误';
        }
        die(json_encode($res));
    }

    /**
     * 生成模考清单
     * @Obelisk
     */
    public function actionTestPlate(){
        $session = Yii::$app->session;
        $userId = Yii::$app->session->get('userId');
        $plateArr = [];
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $tpoNumber = Yii::$app->request->post('tpoNumber');
        $testPlate = Yii::$app->request->post('testPlate');
        if($tpoNumber){
            $model = new TestStatistics();
            $model->tpoNumber = $tpoNumber;
            $model->startTime = time();
            $model->userId = $userId;
            $model->type = 1;
            $model->save();
            $statisticsId = $model->primaryKey;
        }
        foreach($testPlate as $v){
            if($v == 'listen'){
                $sql = "SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=$tpoNumber AND ce.code='4bf183d69dada92bb0963c4c4b57b55b'";
                $data = Yii::$app->db->createCommand($sql)->queryOne();
                $model->updateAll(['listen' => $data['value']],"id=$statisticsId");
                $plateArr['listen'] = $data['value'];
            }
            if($v == 'speak'){
                $sql = "SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=$tpoNumber AND ce.code='8c81734685cdd7fdb09748976c7b55d3'";
                $data = Yii::$app->db->createCommand($sql)->queryOne();
                $model->updateAll(['speaking' => $data['value']],"id=$statisticsId");
                $plateArr['speak'] = $data['value'];
            }
        }
        $session->set('plate',$plateArr);
//        $session->set('testType',1);
        $session->set('statisticsId',$statisticsId);
        if($statisticsId){
            $res['code'] = 1;

            $res['message'] = '模考板块完成';

        }else{

            $res['code'] = 0;

            $res['message'] = '失败，请重试';

        }
        die(json_encode($res));
    }

    /**
     * 口语模考下一题
     * @Obelisk
     */
    public function actionSpeakingNextQuestion(){
        $catId = Yii::$app->request->post('catId');
        $num = Yii::$app->request->post('num');
        $session = Yii::$app->session;
        $userId = Yii::$app->session->get('userId');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $recordId = $session->get('recordId');
        if($num == 6){
            HistoryRecord::updateAll(['isBreak'=> 2,'endTime' => time()],"id=$recordId");
            $model = new UserAnswer();
            $model->deleteOneTest($recordId);
            $plate = Yii::$app->session->get('plate');
            unset($plate['speak']);
            Yii::$app->session->set('plate',$plate);
            die(json_encode(['code'=>3]));
        }else{
            HistoryRecord::updateAll(['achieve'=> $num+1],"id=$recordId");
        }
        $model = new Content();
        $contentId = $model->getContentId($catId,$num+1);
        $data = $model->getSpokenQuestion($contentId['id']);
        die(json_encode($data));
    }

    /**
     * 添加购物车
     * @Obelisk
     */
    public function actionAddShopping()
    {
        $userId = Yii::$app->session->get('userId');
        $contentId = Yii::$app->request->post('contentId');
        $num = Yii::$app->request->post('num');
        $price = Yii::$app->request->post('price');
        if ($userId) {

        } else {

        }
    }

    /**
     * 点击获取验证码
     * @Obelisk
     */
    public function actionVerificationCode(){
        $_vc = new VerificationCode();  //实例化一个对象
        $_vc->doimg();
        Yii::$app->session->set('verificationCode',$_vc->getCode());//验证码保存到SESSION中
    }

    /**
     * 根据标签切换商品
     * @Obelisk
     */
    public function actionChangeClass(){
        $tagStr = Yii::$app->request->post('tagStr');
        $pid = Yii::$app->request->post('pid');
        $model = new Content();
        $data = $model->getClassDetails($tagStr,$pid);
        die(json_encode($data));
    }

    /**
     * 根据标签切换商品
     * @Obelisk
     */
    public function actionUrlChangeClass(){
        $tagStr = Yii::$app->request->get('tagStr');
        $pid = Yii::$app->request->get('pid');
        $model = new Content();
        $data = $model->getClassDetails($tagStr,$pid);
        die(json_encode($data));
    }

    /**
     * 获取用户积分
     * @Obelisk
     */
    public function actionGetIntegral(){
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        if (!$userId) {
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $userData = $session->get('userData');
        $data = uc_user_integral($userData['userName']);
        foreach($data['details'] as $k => $v){
            $data['details'][$k]['createTime'] = date('Y-m-d',$v['createTime']);
        }
        die(json_encode($data));
    }

    public function actionApiContent(){
        $fields = Yii::$app->request->post('fields','');
        $page = Yii::$app->request->post('page','');
        $pageSize = Yii::$app->request->post('pageSize','');
        $where = Yii::$app->request->post('where','');
        $order = Yii::$app->request->post('order','');
        $category = Yii::$app->request->post('category','');
        $pageStr = Yii::$app->request->post('pageStr','');
        $extend_category = Yii::$app->request->post('extend_category','');
        $condition = [];
        if($fields){
            $condition['fields'] = $fields;
        }
        if($page){
            $condition['page'] = $page;
        }
        if($pageSize){
            $condition['pageSize'] = $pageSize;
        }
        if($where){
            $condition['where'] = $where;
        }
        if($order){
            $condition['order'] = $order;
        }
        if($category){
            $condition['category'] = $category;
        }
        if($pageStr){
            $condition['pageStr'] = $pageStr;
        }
        if($extend_category){
            $condition['extend_category'] = $extend_category;
        }
        $data = Content::getClass($condition);
        die(json_encode($data));
    }


    /**
     *接口内容添加
     * @Obelisk
     */
    public function actionAddContent(){
        $image = Yii::$app->request->post('image','');
        $name = Yii::$app->request->post('name','');
        $catId = Yii::$app->request->post('catId','');
        $extendVal = Yii::$app->request->post('extend');
        $contentModel = new Content();
        $contentModel->addContent($catId,$image,$name,$extendVal);
        $res['code'] = 1;
        die(json_encode($res));
    }

    /**
     *获取分类魔板
     */
    public function actionGetTemplate(){
        $catId = Yii::$app->request->post('catId');
        $cateExtend = Yii::$app->db->createCommand("select * from {{%category_extend}} WHERE catId=$catId AND belong='content'  ORDER by id ASC")->queryAll();
        die(json_encode($cateExtend));
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
    }
}