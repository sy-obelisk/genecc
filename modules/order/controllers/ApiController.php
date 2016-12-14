<?php
/**
 * 内容接口类
 * @return string
 * @Obelisk
 */
namespace app\modules\order\controllers;


use app\libs\Method;
use app\modules\order\models\Content;
use app\modules\order\models\Order;
use app\modules\order\models\OrderConsignee;
use app\modules\order\models\OrderGoods;
use yii;
use app\modules\content\models\Category;
use app\modules\order\models\Consignee;
use app\modules\content\models\CategoryExtend;
use app\libs\ApiControl;

class ApiController extends ApiControl {
    public $enableCsrfValidation = false;
    /**
     * 获取所有在用分类
     * @Obelisk
     */
    public function actionGetContent()
    {
        $searchKeywords = Yii::$app->request->post('searchKeywords');
        $rangeType = Yii::$app->request->post('rangeType');
        if($rangeType == 2){
            $model = new Category();
            $data = $model->searchCat($searchKeywords);
        }else{
            $model = new Content();
            $data = $model->searchCont($searchKeywords);
        }
        die(json_encode($data));
    }

    /**
     * 搜索商品
     * @Obelisk
     */
    public function actionSearchContent(){
        $keywords = Yii::$app->request->get('keywords');
        $type = Yii::$app->request->get('type');
        $where = "1=1";
        if($type ==1){
            if($keywords != ''){
                $where .= " AND name like '%$keywords%'";
            }
            $sql = "select id,name as text from {{%content}} where $where AND pid !=0";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
        }else{
            $sql = "select id,name as text from {{%content}} where pid !=0 AND catId=$keywords ";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
        }
        die(json_encode($data));
    }

    /**
     * 搜索用户
     * @Obelisk
     */
    public function actionSearchUser(){
        $user = [];
        $keywords = Yii::$app->request->get('keywords');
        $sql = "select id,userName,phone,email from {{%user}} where userName like '%$keywords%' or phone like '%$keywords%' or email like '%$keywords%'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k=>$v){
            $user[$k]['id'] = $v['id'];
            if(!empty($v['userName'])){
                $user[$k]['text'] = $v['userName'];
            }elseif(!empty($v['phone'])){
                $user[$k]['text'] = $v['phone'];
            }else{
                $user[$k]['text'] = $v['email'];
            }
        }
        die(json_encode($user));

    }

    /**
     *搜索收货人
     * @Obelisk
     */
    public function actionSearchConsignee(){
        $userId = Yii::$app->request->get('userId');
        $sql = "select * from {{%user_consignee}} WHERE userId=$userId";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $consignee = [];
        foreach($data as $k=>$v){
            $consignee[$k]['id'] = $v['id'];
            $consignee[$k]['text'] = $v['name'].'-'.$v['address'].'-'.$v['phone'];
        }
        die(json_encode($consignee));
    }

    /**
     * 添加收货人
     * @Obelisk
     */
    public function actionAddConsignee(){
        $userId = Yii::$app->request->post('userId');
        $name = Yii::$app->request->post('name');
        $address = Yii::$app->request->post('address');
        $phone = Yii::$app->request->post('phone');
        $model = new Consignee();
        $model->userId = $userId;
        $model->name = $name;
        $model->address = $address;
        $model->phone = $phone;
        $model->createTime = time();
        $model->save();
        die(json_encode(['code'=>1]));
    }

    /**
     * 获取商品详情
     * @Obelisk
     */
    public function actionGetGoods(){
        $goodsStr = Yii::$app->request->post('goodsStr');
        $num = Yii::$app->request->post('num','');
        $goods = [];
        $price = 0;
        if($goodsStr != null){
            foreach($goodsStr as $k=>$v){
                $sign = Content::getClass(['fields' => 'price','where' => "c.id=$v"]);
                $goods[$k]['image'] = $sign[0]['image'];
                $goods[$k]['name'] = $sign[0]['name'];
                $number = !empty($num)?$num[$k]:1;
                $price += $sign[0]['price']*$number;
            }
        }
        die(json_encode(['goods' => $goods,'price' => $price]));
    }

    /**
     * 添加订单
     * @Obelisk
     */

    public function actionAddOrder(){
        $goods = Yii::$app->request->post('goods');
        $num= Yii::$app->request->post('num');
        $userId = Yii::$app->request->post('userId');
        $consignee = Yii::$app->request->post('consignee');
        $totalMoney = Yii::$app->request->post('totalMoney');
        $totalDis = Yii::$app->request->post('totalDis');
        $favorableDetails = Yii::$app->request->post('favorableDetails');
        $freight = Yii::$app->request->post('freight');
        $payable = Yii::$app->request->post('payable');
        $payType = Yii::$app->request->post('payType');
        $status = Yii::$app->request->post('status');
        $model = new Order();
        $model->orderNumber = Method::guid();
        $model->userId = $userId;
        $model->totalMoney = $totalMoney;
        $model->freight = $freight;
        $model->totalDis = $totalDis;
        $model->payable = $payable;
        $model->payType = $payType;
        $model->status = $status;
        $model->favorableDetails = $favorableDetails;
        $model->createTime = time();
        if($status>=3){
            $model->payTime = time();
        }
        $sign = $model->save();
        if($sign){
            $orderId = $model->primaryKey;
            foreach($goods as $k=>$v){
                $sql = "select c.image,ca.name as catName,ca.id as catId,c.name as contentName,c.id as contentId,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.id=$v";
                $content = Yii::$app->db->createCommand($sql)->queryOne();
                $tag = "";
                $sql = "select c.name from {{%content_tag}} ct LEFT JOIN {{%content}} c ON ct.tagContentId=c.id WHERE ct.contentId=$v";
                $data = Yii::$app->db->createCommand($sql)->queryAll();
                foreach($data as $val){
                    $tag .= ($val['name'].' ');
                }
                $goodsModel = new OrderGoods();
                $goodsModel->orderId = $orderId;
                $goodsModel->contentId = $content['contentId'];
                $goodsModel->image = $content['image'];
                $goodsModel->contentName = $content['contentName'];
                $goodsModel->catName = $content['catName'];
                $goodsModel->contentTag = $tag;
                $goodsModel->num = $num[$k];
                $goodsModel->price = $content['price'];
                $goodsModel->userId = $userId;
                $goodsModel->createTime = time();
                $goodsModel->save();
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
            $model->createTime = time();
            $model->save();
            die(json_encode(['code' => 1,'message' => '添加成功']));
        }else{
            die(json_encode(['code' => 0,'message' => '添加失败请重试']));
        }

    }
}