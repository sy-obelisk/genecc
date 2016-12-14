<?php
/**
 * 订单管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\pay\controllers;

use app\modules\cn\models\Content;
use app\modules\pay\models\Order;
use app\modules\pay\models\OrderConsignee;
use app\modules\pay\models\OrderGoods;
use app\modules\pay\models\ShoppingCart;
use app\modules\pay\models\Consignee;
use app\modules\pay\models\UserCourse;
use app\modules\user\models\User;
use yii;
use app\libs\ToeflController;
use app\libs\yii2_alipay\AlipayPay;
use app\libs\Sms;

class OrderController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';

    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
    }

    /**
     * 购物详情
     * @return string
     * @Obeliskrfn
     */
    public function actionIndex()
    {
        $dataType = Yii::$app->request->get('data-type','arr');
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $userData = $session->get('userData');
        $shopCartId = $session->get('shopId');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        if(!$shopCartId){
            die('<script>alert("路径错误");history.go(-1);</script>');
        }
        foreach($shopCartId as $v){
            $sign = ShoppingCart::findOne($v);
            if(!$sign){
                die('<script>alert("多次重复刷新");history.go(-1);</script>');
            }
        }
        $cartStr = implode(",",$shopCartId);
        $model = new ShoppingCart();
        $shopCart = $model->getCart("AND sc.id in($cartStr)");
        $tag = "";
        foreach($shopCart as $k=>$v){
            $sql = "select c.name from {{%content_tag}} ct LEFT JOIN {{%content}} c ON ct.tagContentId=c.id WHERE ct.contentId={$v['contentId']}";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            foreach($data as $val){
                $tag .= ($val['name'].' ');
            }
            $shopCart[$k]['tag'] = $tag;
            $tag = "";
        }
        $order = $this->goodsFavorable($shopCart);
        $session->set('totalMoney',$order['totalMoney']);
        $session->set('totalDis',$order['totalDis']);
        $session->set('goods',$order['goods']);
        $session->set('adminStr',$order['adminStr']);
        $consignee = Consignee::find()->where("userId=$userId")->all();
        $integral = uc_user_integral($userData['userName']);
        return $this->exitData(['integral' => $integral['integral'],'goods' => $order['goods'],'totalDis'=>$order['totalDis'],'totalMoney' => $order['totalMoney'],'consignee' => $consignee],$dataType,"index",2);
    }

    /**
     * 订单列表
     * @return string
     * @Obelisk
     */
    public function actionList(){
        $dataType = Yii::$app->request->get('data-type','arr');
        $userId = Yii::$app->session->get('userId');
        $page = Yii::$app->request->get('page',1);
        $status = Yii::$app->request->get('status','');
        if($status == 3){
            $status = '';
        }
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $model = new Order();
        $data = $model->getAllOrder($userId,10,$page,$status);
        return $this->exitData($data,$dataType,"list",2);
    }

    /**
     * 删除购物车
     * @return string
     * @Obelisk
     */
    public function actionDelete()
    {
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $contentId = Yii::$app->request->get('contentId');
        if($userId){
            ShoppingCart::deleteAll("userId=$userId AND contentId=$contentId");
        }else{
            $shopCart = $session->get('shopCart');
            if($shopCart){
                foreach($shopCart as $k => $v){
                    if($contentId == $v['contentId']){
                        unset($shopCart[$k]);
                    }
                }
                $session->set('shopCart',$shopCart);
            }
        }
        $this->redirect('/shopping-cart.html');
    }

    /**
     * 计算每个商品的优惠值
     * @Obelisk
     */
    public function goodsFavorable($goods){
        $totalDis = 0;
        $totalMoney = 0;
        $adminStr = '';
        foreach($goods as $k => $v){
            $totalMoney += ($v['price']*$v['num']);
            $fStr = '';
            //计算折扣
            //当前商品是否享受折扣
            $time = time();
            $contentSql = "select * from {{%favourable_activity}} WHERE startTime<$time AND endTime>$time AND (rangeType=1 or (rangeType=3 AND rangeExt like '%{$v['contentId']}%'))";
            $sign = Yii::$app->db->createCommand($contentSql)->queryOne();
            if($sign){
                $dis = $v['price']*$v['num']*((100-$sign['details'])/100);
                $fStr .= '根据('.$sign['name'].')活动，该商品享受'.($sign['details']/10).'折优惠，优惠'.$dis.'元;';
                $adminStr .= '根据('.$sign['name'].')活动(活动Id'.$sign['id'].')，'.$v['contentName'].'(商品Id'.$v['contentId'].')享受'.($sign['details']/10).'折优惠，优惠'.$dis.'元;';
                $totalDis +=$dis;
            }
            //当前商品分类是否享受优惠
            $categorySql = "select * from {{%favourable_activity}} WHERE startTime<$time AND endTime>$time AND rangeType=2  AND rangeExt like '%{$v['catId']}%'";
            $sign = Yii::$app->db->createCommand($categorySql)->queryOne();
            if($sign){
                $dis = $v['price']*$v['num']*((100-$sign['details'])/100);
                $fStr .= '根据('.$sign['name'].')活动，该商品享受'.($sign['details']/10).'折优惠，优惠'.$dis.'元;';
                $totalDis +=$dis;
                $adminStr .= '根据('.$sign['name'].')活动(活动Id'.$sign['id'].')，'.$v['contentName'].'(商品Id'.$v['contentId'].')享受'.($sign['details']/10).'折优惠，优惠'.$dis.'元;';
            }
            $goods[$k]['fStr'] = $fStr;
        }
        return ['adminStr' => $adminStr,'goods' => $goods,'totalDis' => $totalDis,'totalMoney'=>$totalMoney];
    }

    /**
     * 订单提交成功
     * @Obelisk
     */
    public function actionPay(){
        $orderId = Yii::$app->request->get('orderId');
        $server = Yii::$app->request->get('server','http');
        $userId = Yii::$app->request->get('userId');
        if($userId){
            $wapType = 1;
            $username = Yii::$app->request->get('username');
        }else{
            $wapType = 0;
            $session = Yii::$app->session;
            $userId = $session->get('userId');
            $username = $session->get('userData');
        }

        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $sign = Order::findOne($orderId);
        $orderDetail = [
            'orderNumber' => $sign->orderNumber,
            'money' => $sign->payable
        ];
        if(!$wapType) {
            $session->set('orderDetail', $orderDetail);
        }
        if(!$sign){
            die('<script>alert("无效订单");history.go(-1);</script>');
        }
        if($sign->payable<=0){
            Order::updateAll(['status' => 3,'payTime' => time()],"orderNumber='{$sign->orderNumber}'");
            if($sign->integral>0){
                uc_user_edit_integral($username,'购买托福课程',2,$sign->integral);
            }
            $this->redirect('/pay/order/success');
        }else{
            $model = new AlipayPay();
            $order_id = $sign->orderNumber;
            $gift_name = $sign->type==1?'购买雷哥留学服务':'雷豆充值';
            $money = $sign->payable;
            $body = $sign->type==1?'购买雷哥留学服务':'雷豆充值';
            $show_url = 'http://toeflonline.cc/toeflcourses.html';
            $html = $model->requestPay($order_id, $gift_name, $money, $body, $show_url,$server);
            echo $html;
        }
    }

    /**
     * 支付宝返回
     * @Obelisk
     */
    public function actionReturnUrl(){

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
                //取该订单信息
                $order_info = Order::find()->where("orderNumber='$out_trade_no'")->one();
                $user = User::findOne($order_info->userId);
                if (!$order_info) {
                    die('订单信息错误');
                }
                //判断该笔订单是否在商户网站中已经做过处理
                $order_status = $order_info->status;
                if ($order_status == 1 ) {
                    //完成订单
                    if($order_info->type == 1){
                        Order::updateAll(['status' => 3,'payTime' => time()],"orderNumber='$out_trade_no'");
                        $model = new UserCourse();
                        $model->userId = $order_info->userId;
                        $model->type = 1;
                        $model->number = $order_info->payable;
                        $model->createTime = time();
                        $model->save();
                        if($order_info->integral>0){
                            uc_user_edit_integral($user->userName,'购买托福课程',2,$order_info->integral);
                        }
                        $goods = OrderGoods::find()->where("orderId=$order_info->id")->all();
                        $content = "下单购买";
                        foreach($goods as $v){
                            $content .= "【{$v['contentName']}】";
                        }
                        $consignee = OrderConsignee::find()->where('orderId='.$order_info->id)->one();
                        $total = $order_info->totalMoney;
                        $content = "订单号$out_trade_no,用户名$user->userName,姓名$consignee->name,手机号$consignee->phone,于".date("Y-m-d H:i")."$content,应付款$total,实付款$order_info->payable 元";
                    }else{
                        Order::updateAll(['status' => 3,'payTime' => time()],"orderNumber='$out_trade_no'");
                        $model = new UserCourse();
                        $model->userId = $order_info->userId;
                        $model->type = 1;
                        $model->number = $order_info->payable;
                        $model->createTime = time();
                        $model->save();
                        uc_user_edit_integral($user->userName,'雷豆充值',1,$order_info->payable*100);
                        $total = $order_info->payable;
                        $num = $total*100;
                        $content = "订单号$out_trade_no,用户名$user->userName,于".date("Y-m-d H:i")."下单充值雷豆$num,实付款$total 元";
                    }
                    $sms = new Sms();
                    $sms->send(15828654649, $content, $ext = '', $stime = '', $rrid = '');
                } else {
                    die('已处理过的订单 不做处理');
                    //已处理过的订单 不做处理
                }
            }
            //返回状态
            $this->redirect('/pay/order/success');
        } else {
            //验证失败
            die('支付状态验证错误');
        }

    }


    /**
     * @var String 服务器异步通知页面路径
     * 需http://格式的完整路径，不能加?id=123这类自定义参数
     */
    public function actionNotifyUrl()
    {
        $alipay = new AlipayPay();
        $verify_result = $alipay->verifyNotify();
        if ($verify_result) {//验证成功
            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];

//            //记录支付宝回调数据
//            $alipay_log = array();
//            $alipay_log['subject'] = $_POST['subject'];
//            $alipay_log['trade_no'] = $trade_no;
//            $alipay_log['buyer_email'] = $_POST['buyer_email'];
//            $alipay_log['gmt_create'] = $_POST['gmt_create'];
//            $alipay_log['out_trade_no'] = $out_trade_no;
//            $alipay_log['notify_time'] = $_POST['notify_time'];
//            $alipay_log['trade_status'] = $trade_status;
//
//
//            $this->vip_recharge_model->addAlipayLog($alipay_log);
            $file  = 'log.txt';//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
            $content = $out_trade_no.$trade_status;
            file_put_contents($file, $content,FILE_APPEND);// 这个函数支持版本(PHP 5)

              if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                  //取该订单信息
                  $order_info = Order::find()->where("orderNumber='$out_trade_no'")->one();
                  $user = User::findOne($order_info->userId);
                  if (!$order_info) {
                      die(json_decode(['code' =>0,'message' => '订单信息错误']));
                  }
                  //判断该笔订单是否在商户网站中已经做过处理
                  $order_status = $order_info->status;
                  if ($order_status == 1 ) {
                      //完成订单
                      if($order_info->type == 1){
                          Order::updateAll(['status' => 3,'payTime' => time()],"orderNumber='$out_trade_no'");
                          $model = new UserCourse();
                          $model->userId = $order_info->userId;
                          $model->type = 1;
                          $model->number = $order_info->payable;
                          $model->createTime = time();
                          $model->save();
                          if($order_info->integral>0){
                              uc_user_edit_integral($user->userName,'购买托福课程',2,$order_info->integral);
                          }
                          $goods = OrderGoods::find()->where("orderId=$order_info->id")->all();
                          $content = "下单购买";
                          foreach($goods as $v){
                              $content .= "【{$v['contentName']}】";
                          }
                          $consignee = OrderConsignee::find()->where('orderId='.$order_info->id)->one();
                          $total = $order_info->totalMoney;
                          $content = "订单号$out_trade_no,用户名$user->userName,姓名$consignee->name,手机号$consignee->phone,于".date("Y-m-d H:i")."$content,应付款$total,实付款$order_info->payable 元";
                      }else{
                          Order::updateAll(['status' => 3,'payTime' => time()],"orderNumber='$out_trade_no'");
                          $model = new UserCourse();
                          $model->userId = $order_info->userId;
                          $model->type = 1;
                          $model->number = $order_info->payable;
                          $model->createTime = time();
                          $model->save();
                          uc_user_edit_integral($user->userName,'雷豆充值',1,$order_info->payable*100);
                          $total = $order_info->payable;
                          $num = $total*100;
                          $content = "订单号$out_trade_no,用户名$user->userName,于".date("Y-m-d H:i")."下单充值雷豆$num,实付款$total 元";
                      }
                      $sms = new Sms();
                      $sms->send(15828654649, $content, $ext = '', $stime = '', $rrid = '');
                  } else {
                      die(json_decode(['code' =>0,'message' => '已处理过的订单 不做处理']));
                      //已处理过的订单 不做处理
                  }
              }

            //返回状态
            echo "success";
        } else {
            //验证失败
            echo "fail";
        }
    }

    /**
     * 支付成功
     * @return string
     * @Obelisk
     */
    public function actionSuccess(){
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $orderDetail = $session->get('orderDetail');
        if($orderDetail){
            $session->remove('orderDetail');
        }else{
           $this->redirect('/');
        }
        return $this->renderPartial('success',$orderDetail);
    }

    /**
     * 支付成功
     * @return string
     * @Obelisk
     */
    public function actionSuccessWap(){
        return $this->renderPartial('successWap');
    }

    /**
     * 支付成功
     * @return string
     * @Obelisk
     */
    public function actionPayType(){
        $orderId = Yii::$app->request->get('orderId');
        $dataType = Yii::$app->request->get('data-type','arr');
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $sign = Order::findOne($orderId);
        if(!$sign || $sign->status != 1){
            die('<script>alert("无效订单");history.go(-1);</script>');
        }
        if($dataType == 'json'){
            $sign = Order::find()->asArray()->where("id=$orderId")->one();
        }
        return $this->exitData(['sign' => $sign],$dataType,"payType",2);
    }

    /**
     * 雷豆充值
     * @Obelisk
     */

    public function actionIntegral(){
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $userData = $session->get('userData');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $integral = uc_user_integral($userData['userName']);
        return $this->renderPartial('integral',['integral' => $integral['integral']]);
    }

    /**
     * 订单详情
     * @Obelisk
     */
    public function actionDetails(){
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $orderId = Yii::$app->request->get('orderId');
        $dataType = Yii::$app->request->get('data-type','arr');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $model = new Order();
        $data = $model->getOrderDetails($orderId);
        return $this->exitData(['data' => $data],$dataType,"details",2);
    }

    /**
     * 购物详情
     * @return string
     * @Obeliskrfn
     */
    public function actionClear()
    {
        $dataType = Yii::$app->request->get('data-type','arr');
        $id = Yii::$app->request->get('id');
        $sign = Content::findOne($id);
        $num = Yii::$app->request->get('num',1);
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $userData = $session->get('userData');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        if(!$sign){
            die('<script>alert("系统错误请重试");location.href="/";</script>');
        }
        if($sign->pid==0){
            $data = Content::find()->where("pid=$id")->one();
            $this->redirect("/quick-clearing/".$data['id']."/".$num.".html");
        }
        $model = new ShoppingCart();
        $shopCart = $model->getGoods($id);
        $tag = "";
        foreach($shopCart as $k=>$v){
            $sql = "select c.name from {{%content_tag}} ct LEFT JOIN {{%content}} c ON ct.tagContentId=c.id WHERE ct.contentId={$v['contentId']}";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            foreach($data as $val){
                $tag .= ($val['name'].' ');
            }
            $shopCart[$k]['tag'] = $tag;
            $shopCart[$k]['num'] = $num;
            $tag = "";
        }
        $order = $this->goodsFavorable($shopCart);
        $session->set('totalMoney',$order['totalMoney']);
        $session->set('totalDis',$order['totalDis']);
        $session->set('goods',$order['goods']);
        $session->set('adminStr',$order['adminStr']);
        $session->set('canDelete',1);
        $consignee = Consignee::find()->asArray()->where("userId=$userId")->all();
        $integral = uc_user_integral($userData['userName']);
        return $this->exitData(['integral' => $integral['integral'],'goods' => $order['goods'],'totalDis'=>$order['totalDis'],'totalMoney' => $order['totalMoney'],'consignee' => $consignee],$dataType,"index",2);
    }

    /* 我的课程
    * @return string
    * @Obelisk
    */
    public function actionClass(){
        $dataType = Yii::$app->request->get('data-type','arr');

        $userName = Yii::$app->request->get('userName');
        $user = User::find()->where("userName='$userName'")->one();
        $page = Yii::$app->request->get('page',1);
        $model = new Order();
        $data = $model->getAllClass($user['id'],10,$page);
        echo json_encode($data);
    }

}