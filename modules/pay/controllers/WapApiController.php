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
use app\libs\Method;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
class WapApiController extends ToeflController {
    public $enableCsrfValidation = false;
    public $layout = 'cn';

    function init (){
        parent::init();
        include_once($_SERVER['DOCUMENT_ROOT'].'/../libs/ucenter/ucenter.php');
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
        ini_set('session.use_trans_sid','1');
        ini_set("session.use_only_cookies",0);
        ini_set("session.use_cookies",0);
        $sid = Yii::$app->request->get('sid');
        if($sid && $sid != 'null'){
            session_destroy();
            session_id($sid);
            session_start();
        }
        $orderId = Yii::$app->request->get('orderId');
        $server = Yii::$app->request->get('server','http');
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $userData = $session->get('userData');
        if(!$userId){
            die('<script>alert("请登录");history.go(-1);</script>');
        }
        $sign = Order::findOne($orderId);
        $orderDetail = [
            'orderNumber' => $sign->orderNumber,
            'money' => $sign->payable
        ];
        $session->set('orderDetail',$orderDetail);
        if(!$sign){
            die('<script>alert("无效订单");history.go(-1);</script>');
        }
        if($sign->payable<=0){
            Order::updateAll(['status' => 3,'payTime' => time()],"orderNumber='{$sign->orderNumber}'");
            if($sign->integral>0){
                uc_user_edit_integral($userData['userName'],'购买托福课程',2,$sign->integral);
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
     * 购物详情
     * @return string
     * @Obeliskrfn
     */
    public function actionClear()
    {
        $id = Yii::$app->request->get('id');
        $sign = Content::findOne($id);
        $num = Yii::$app->request->get('num',1);
        $userId = Yii::$app->request->get('userId', '');
        $username = Yii::$app->request->get('username', '');
        if(!$userId){
            $re = [
                'code' => 0,
                'message' => '请登录',
               // 'sid' => $sid,
                'userId' => $userId
            ];
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;
        }
        if(!$sign){
            $re = [
                'code' => 0,
                'message' => '系统错误'
            ];
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;
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
        $consignee = Consignee::find()->asArray()->where("userId=$userId")->all();
        $integral = uc_user_integral($username);
        $re = [
            'code' => 1,
            'message' => ['integral' => $integral['integral'],'goods' => $order['goods'],'totalDis'=>$order['totalDis'],'totalMoney' => $order['totalMoney'],'consignee' => $consignee,'adminStr' =>$order['adminStr'],'canDelete' => 1]
        ];
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($re).')';
        exit;
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

    /**
     * 保存收货人信息
     * @Obelisk
     */
    public function actionSaveConsignee(){
        $userId = Yii::$app->request->get('userId', '');
        if(!$userId){
            $re = ['code' => 0,'message' =>'请登录'];
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;
        }
        $name = Yii::$app->request->get('name');
        $address = Yii::$app->request->get('address');
        $phone = Yii::$app->request->get('phone');
        $province = Yii::$app->request->get('province');
        $city = Yii::$app->request->get('city');
        $area = Yii::$app->request->get('area');
        $alias = Yii::$app->request->get('alias');
        $id = Yii::$app->request->get('id');
        if(!$id){
            $model = new Consignee();
            $model->userId = $userId;
            $model->name = $name;
            $model->address = $address;
            $model->phone = $phone;
            $model->alias = $alias;
            $model->province = $province;
            $model->city = $city;
            $model->area = $area;
            $model->createTime = time();
            $sign = $model->save();
        }else{
            $sign = Consignee::updateAll(['alias' => "$alias",'province' => "$province",'city' => "$city",'area' => "$area",'name' => "$name",'address' => "$address",'phone' => "$phone"],"id=$id");
        }
        if($sign){
            $re = [
                'code' => 1,
                'message' => '保存成功',
            ];
        }else{
            $re = [
                'code' => 0,
                'message' => '保存失败'
            ];
        }
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($re).')';
        exit;
    }

    /**
     * 删除收货人
     * @Obelisk
     */
    public function actionDeleteConsignee(){
        $userId = Yii::$app->request->get('userId', '');
        if(!$userId){
            $re = ['code' => 0,'message' =>'请登录'];
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;
        }
        $id = Yii::$app->request->get('id');
        $sign = Consignee::deleteAll("id=$id");
        if($sign){
            $re = [
                'code' => 1,
                'message' => '删除成功',
            ];
        }else{
            $re = [
                'code' => 0,
                'message' => '删除失败'
            ];
        }
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode($re).')';
        exit;
    }

    /**
     * 提交订单
     */
    public function actionSubOrder(){
        $userId = Yii::$app->request->get('userId', '');
        if(!$userId){
            $re = ['code' => 0,'message' => '请登录'];
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;
        }
        $consignee = Yii::$app->request->get('consignee');
        $id = Yii::$app->request->get('id');
        $num = Yii::$app->request->get('num');
        $payType = Yii::$app->request->get('payType');
        $type = Yii::$app->request->get('type');
        $integral = Yii::$app->request->get('integral');
        if($type){
            $integralMoney = $integral*0.01;
        }else{
            $integralMoney = 0;
            $integral = 0;
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
        $totalMoney = $order['totalMoney'];
        $adminStr = $order['adminStr'];
        $totalDis = $order['totalDis'];
        $goods = $order['goods'];
        $time = time();
        $model = new Order();
        $model->orderNumber = Method::orderNumber();
        $model->totalMoney = $totalMoney;
        $model->userId = $userId;
        $model->totalDis = $totalDis;
        $model->payable = $totalMoney-$totalDis-$integralMoney;
        $model->payType = $payType;
        $model->favorableDetails = $adminStr;
        $model->status = 1;
        $model->integral = $integral;
        $model->createTime = $time;
        $sign = $model->save();
        if(!$sign){
            $re = ['code' => 0,'message' => '订单提交失败'];
            $callback = $_GET['callback'];
            echo $callback.'('.json_encode($re).')';
            exit;
        }
        $orderId = $model->primaryKey;
        foreach($goods as $v){
            $model = new OrderGoods();
            $model->orderId = $orderId;
            $model->contentId = $v['contentId'];
            $model->contentName = $v['contentName'];
            $model->catName = $v['catName'];
            $model->contentTag = $v['tag'];
            $model->price = $v['price'];
            $model->image = $v['image'];
            $model->num = $v['num'];
            $model->userId = $userId;
            $model->createTime = $time;
            $model->save();
        }
        $sign = Consignee::findOne($consignee);
        $model = new OrderConsignee();
        $model->userId = $sign->userId;
        $model->orderId = $orderId;
        $model->name = $sign->name;
        $model->address = $sign->address;
        $model->phone = $sign->phone;
        $model->alias = $sign->alias;
        $model->province = $sign->province;
        $model->city = $sign->city;
        $model->area = $sign->area;
        $model->createTime = $time;
        $model->save();
        $callback = $_GET['callback'];
        echo $callback.'('.json_encode(['code' => 1,'orderId'=>$orderId,'message'=>'订单提交成功']).')';
        exit;
    }

}