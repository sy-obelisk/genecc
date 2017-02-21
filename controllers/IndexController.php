<?php

namespace app\controllers;

use app\libs\yii2_alipay\AlipayPay;
use Yii;
use yii\web\Controller;


class IndexController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionPlay(){
        $sdk = Yii::$app->request->get('sdk');
        $name = Yii::$app->request->get('name');
        if(!isset($_SESSION['sdk'])){
            $_SESSION['sdk'] = [];
        }
        if(!in_array($sdk,$_SESSION['sdk'])){
            $_SESSION['sdk'][] = $sdk;
            $_SESSION[$sdk]['type'] = $type = 0;
            $_SESSION[$sdk]['time'] = $time = 0;
        }else{
            $type = $_SESSION[$sdk]['type'];
            $time = $_SESSION[$sdk]['time'];
        }
        if($type != 1){
            $time = 0;
        }
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
            return $this->renderPartial('ios',['type' => $type,'sdk' => $sdk,'time' => $time,'name' => $name]);
        }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
            return $this->renderPartial('android',['type' => $type,'sdk' => $sdk,'time' => $time,'name' => $name]);
        }else{
            return $this->renderPartial('play',['type' => $type,'sdk' => $sdk,'time' => $time,'name' => $name]);
        }
    }

    public function actionPlayAndroid(){
        $sdk = Yii::$app->request->get('sdk');
        $name = Yii::$app->request->get('name');
        return $this->renderPartial('androidApp',['sdk' => $sdk,'name' => $name]);
    }

    public function actionPay(){
        $sdk = Yii::$app->request->post('sdk');
        $money = Yii::$app->request->post('money');
        $model = new AlipayPay();
        $order_id = 'ds'.time();
        $_SESSION['nowSdk'] = $sdk;
        $gift_name = '视频打赏';
        $body = '视频打赏';
        $show_url = 'http://video.gmatonline.cn';
        $html = $model->requestPay($order_id, $gift_name, $money, $body, $show_url,'wap');
        echo $html;
    }

    public function actionJudge(){
        $sdk = Yii::$app->request->post('sdk');
        $nowTime = Yii::$app->request->post('nowTime');
        $data =  $_SESSION[$sdk];
        if($data['type'] == 1){
            die(json_encode(['code' => 1]));
        }else{
            $_SESSION[$sdk]['time'] = $nowTime;
            die(json_encode(['code' => 0]));
        }
    }

    public function actionReturnUrl(){
        $sdk = $_SESSION['nowSdk'];
        $alipay = new AlipayPay();
        $verify_result = $alipay->verifyReturn();
        if ($verify_result) {//验证成功
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];

            //$this->vip_recharge_model->addAlipayLog($alipay_log);
            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                $data =  $_SESSION[$sdk];
                if($data['type'] != 1){
                    $_SESSION[$sdk]['type'] = 1;
                }
                //返回状态
                $this->redirect("/index/play?sdk=$sdk");
            }
        } else {
            //验证失败
            die('支付状态验证错误');
        }

    }


}
