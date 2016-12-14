<?php
/**
 * 订单接口类
 * @return string
 * @Obelisk
 */
namespace app\modules\pay\controllers;


use app\libs\Method;
use app\modules\cn\models\Content;
use app\modules\cn\models\DiscussPlate;
use app\modules\cn\models\UserDiscuss;
use app\modules\pay\models\Consignee;
use app\modules\pay\models\OrderConsignee;
use app\modules\pay\models\ShoppingCart;
use yii;
use app\modules\pay\models\Order;
use app\modules\pay\models\OrderGoods;
use app\modules\content\models\CategoryExtend;
use app\libs\ToeflApiControl;

class ApiController extends ToeflApiControl {
    public $enableCsrfValidation = false;

    /**
     * 添加购物车
     * @Obelisk
     */
    public function actionAddShopping(){
        $session =  Yii::$app->session;
        $userId = $session->get('userId');
        $contentId = Yii::$app->request->post('id');
        $num = Yii::$app->request->post('num',1);
        $model = new ShoppingCart();
        $sign = 0;
        if($userId){
            $sign = $model->find()->where("contentId=$contentId AND userId=$userId")->one();
            if($sign){
                ShoppingCart::updateAll(['num' =>($sign->num+$num)],"id=$sign->id");
            }else{
                $model->userId = $userId;
                $model->num = $num;
                $model->contentId = $contentId;
                $model->createTime = time();
                $model->save();
            }
        }else{
            $shopCart = $session->get('shopCart');
            if(!$shopCart){
                $arr = [];
                $shopCart = [];
                $arr['num'] = $num;
                $arr['contentId'] = $contentId;
                $arr['createTime'] = time();
                $shopCart[] = $arr;
                $session->set('shopCart',$shopCart);
            }else{
                foreach($shopCart as $k => $v){
                    if($v['contentId'] == $contentId){
                        $shopCart[$k]['num'] += $num;
                        $sign = 1;
                    }
                }
                if(!$sign){
                    $arr = [];
                    $arr['num'] = $num;
                    $arr['contentId'] = $contentId;
                    $arr['createTime'] = time();
                    $shopCart[] = $arr;
                }
                $session->set('shopCart',$shopCart);
            }
        }
        die(json_encode(['code' => 1]));
    }

    /**
     * 保存收货人信息
     * @Obelisk
     */
    public function actionSaveConsignee(){
        $session =  Yii::$app->session;
        $userId = $session->get('userId');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $name = Yii::$app->request->post('name');
        $address = Yii::$app->request->post('address');
        $phone = Yii::$app->request->post('phone');
        $province = Yii::$app->request->post('province');
        $city = Yii::$app->request->post('city');
        $area = Yii::$app->request->post('area');
        $alias = Yii::$app->request->post('alias');
        $id = Yii::$app->request->post('id');
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
        die(json_encode($re));
    }

    /**
     * 删除收货人
     * @Obelisk
     */
    public function actionDeleteConsignee(){
        $session =  Yii::$app->session;
        $userId = $session->get('userId');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $id = Yii::$app->request->post('id');
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
        die(json_encode($re));
    }

    /**
     *添加订单详情
     * @Obelisk
     */
    public function actionAddOrderGoods(){
        $shopId = Yii::$app->request->post('shopId');
        Yii::$app->session->set('shopId',$shopId);
        die(json_encode(['code'=>1]));
    }

    /**
     * 提交订单
     */
    public function actionSubOrder(){
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        $canDelete= $session->get('canDelete');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        if(!$canDelete) {
            $shopCartId = $session->get('shopId');
            if (!$shopCartId) {
                die(json_encode(['code' => 0, 'message' => '获取用户订单信息失败']));
            }
            foreach ($shopCartId as $v) {
                $sign = ShoppingCart::findOne($v);
                if (!$sign) {
                    die(json_encode(['code' => 0, 'message' => '获取用户订单信息失败']));
                }
            }
        }
        $consignee = Yii::$app->request->post('consignee');
        $payType = Yii::$app->request->post('payType');
        $type = Yii::$app->request->post('type');
        $integral = Yii::$app->request->post('integral');
        if($type){
            $integralMoney = $integral*0.01;
        }else{
            $integralMoney = 0;
            $integral = 0;
        }
        $totalMoney = $session->get('totalMoney');
        $adminStr = $session->get('adminStr');
        $totalDis = $session->get('totalDis');
        $goods = $session->get('goods');
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
            die(json_encode(['code' => 0,'message'=>'订单提交失败']));
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
            if(!$canDelete){
                ShoppingCart::deleteAll("id={$v['id']}");
            }
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
        $session->remove('shopId');
        $session->remove('canDelete');
        die(json_encode(['code' => 1,'orderId'=>$orderId,'message'=>'订单提交成功']));
    }

    /**
     * 购物车数量控制
     * @Obelisk
     */
    public function actionShopNum(){
        $contentId = Yii::$app->request->post('contentId');
        $type = Yii::$app->request->post('type');
        $session = Yii::$app->session;
        $userId = $session->get('userId');
        if($userId){
            $shopCart = ShoppingCart::find()->where("userId=$userId")->all();
            foreach($shopCart as $k => $v){
                if($contentId == $v['contentId']){
                    if($type == 1){
                        ShoppingCart::updateAll(['num' => $v['num'] -1],"id={$v['id']}");
                    }else{
                        ShoppingCart::updateAll(['num' => $v['num'] +1],"id={$v['id']}");
                    }
                }
            }
        }else{
            $shopCart = $session->get('shopCart');
            foreach($shopCart as $k => $v){
                if($contentId == $v['contentId']){
                    if($type == 1){
                        $shopCart[$k]['num'] -=1;
                    }else{
                        $shopCart[$k]['num'] +=1;
                    }
                }
            }
            $session->set('shopCart',$shopCart);
        }
        die(json_encode(['code' => 1]));

    }

    /**
     * 取消订单
     * @Obelisk
     */
    public function actionCancelOrder(){
        $orderId = Yii::$app->request->post('orderId');
        $userId = Yii::$app->session->get('userId');

        if(!$userId){

            $re = ['code' => 2];

            die(json_encode($re));

        }

        $sign = Order::updateAll(['status' => 2],"id=$orderId");
        if($sign){
            $re = ['code' => 1,'message' => '取消成功'];
        }else{
            $re = ['code' => 2,'message' => '取消失败'];
        }
        die(json_encode($re));
    }

    /**
     * 立即购买
     * @Obelisk
     */
    public function actionBuyAgain(){
        $orderId = Yii::$app->request->post('orderId');
        $userId = Yii::$app->session->get('userId');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $data = OrderGoods::find()->where("orderId=$orderId")->all();
        foreach($data as $v){
            $sign = ShoppingCart::find()->where("userId=$userId AND contentId={$v['contentId']}")->one();
            if($sign){
                ShoppingCart::updateAll(['num' => $v['num']],"id=$sign->id");
            }else{
                $model = new ShoppingCart();
                $model->userId = $userId;
                $model->contentId = $v['contentId'];
                $model->num = $v['num'];
                $model->createTime = time();
                $model->save();
            }
        }
        die(json_encode(['code' => 1]));
    }

    /**
     * 雷豆充值
     * @Obelisk
     */
    public function actionIntegralPay (){
        $userId = Yii::$app->session->get('userId');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $time = time();
        $money = Yii::$app->request->post('money');
        $model = new Order();
        $model->orderNumber = Method::orderNumber();
        $model->totalMoney = $money;
        $model->userId = $userId;
        $model->totalDis = 0;
        $model->payable = $money;
        $model->payType = 1;
        $model->favorableDetails = '';
        $model->status = 1;
        $model->integral = 0;
        $model->createTime = $time;
        $model->type = 2;
        $model->save();
        $orderId = $model->primaryKey;
        die(json_encode(['code' => 1,'orderId'=>$orderId,'message'=>'下单成功']));
    }

    /**
     * 获取模块信息
     */
    public function actionGetPlate(){
        $userId = Yii::$app->session->get('userId');
        if(!$userId){
            $re = ['code' => 2];
            die(json_encode($re));
        }
        $contentId= Yii::$app->request->post('contentId');
        $discussPlate = Content::find()->where("catId = 217")->orderBy("sort DESC")->all();
        $plate = [];
        foreach($discussPlate as $k =>$v){
            $model = new DiscussPlate();
            $count = $model->find()->where("contentId=$contentId AND plate={$v['id']}")->count();
            $plate[$k]['count'] = $count;
            $plate[$k]['name'] = $v['name'];
            $plate[$k]['id'] = $v['id'];
        }
        die(json_encode($plate));
    }

    /**
     * 添加讨论
     * @Obelisk
     */

    public function actionAddDiscuss()
    {

        $model = new UserDiscuss();

        $model->pid = Yii::$app->request->post('pid',0);

        $plate = Yii::$app->request->post('plate',0);

        $model->status = Yii::$app->request->post('status', 1);

        $userId = $model->userId = Yii::$app->session->get('userId');
        if (!$userId) {
            die(json_encode(['code' => 2, 'message' => '请登录']));
        }
        $model->discussContent = Yii::$app->request->post('content');

        $model->contentId = Yii::$app->request->post('contentId');

        $model->type = Yii::$app->request->post('type',1);

        $model->stars = Yii::$app->request->post('stars',0);

        $model->orderId = Yii::$app->request->post('orderId',0);

        $model->contentPid = Yii::$app->request->post('contentPid',0);

        $model->createTime = time();

        $re = $model->save();

        foreach($plate as $v){
            $model = new DiscussPlate();
            $model->contentId = Yii::$app->request->post('contentId');
            $model->contentPid = Yii::$app->request->post('contentPid',0);
            $model->orderId = Yii::$app->request->post('orderId',0);
            $model->plate = $v;
            $model->createTime = time();
            $model->userId = $userId;
            $model->save();
        }

        if ($re) {

            die(json_encode(['code' => 1, 'user' => $userId]));

        } else {

            die(json_encode(['code' => 0, 'message' => '提交失败，请重试']));

        }


    }

    /**
     * 检查
     * @Obelisk
     */
    public function actionPublicClear(){

    }

}