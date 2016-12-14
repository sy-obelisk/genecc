<?php
/**
 * 分数管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\order\controllers;



use app\modules\order\models\Order;
use app\modules\order\models\OrderGoods;
use app\modules\order\models\AdminDiscount;
use app\modules\order\models\AdminRecord;
use yii;
use app\libs\AppControl;
use app\libs\Method;

class OrderController extends AppControl {
    public $enableCsrfValidation = false;

    /**
     * 用户订单列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $beginTime = strtotime(Yii::$app->request->get('beginTime',''));
        $endTime = strtotime(Yii::$app->request->get('endTime',''));
        $id  = Yii::$app->request->get('id','');
        $orderNumber  = Yii::$app->request->get('orderNumber','');
        $userId  = Yii::$app->request->get('userId','');
        $status  = Yii::$app->request->get('status','');
        $where="1=1";
        if($beginTime){
            $where .= " AND uo.createTime>=$beginTime";
        }
        if($endTime){
            $where .= " AND uo.createTime<=$endTime";
        }
        if($id){
            $where .= " AND uo.id = $id";
        }
        if($orderNumber){
            $where .= " AND uo.orderNumber = '$orderNumber'";
        }
        if($userId){
            $where .= " AND uo.userId = $userId";
        }
        if($status){
            $where .= " AND uo.status = $status";
        }
        $model = new Order();
        $data = $model->getAllOrder($where,10,$page);
        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>10, 'rows'=>'models']);
        return $this->render('index',['page' => $page,'data' => $data['data'],'block' => $this->block]);
    }

    /**
     * 订单商品
     * @return string
     * @Obelisk
     */
    public function actionGoods()
    {
        $id = Yii::$app->request->get('id');
        $data = OrderGoods::find()->where("orderId=$id")->all();
        return $this->render('goods',['data' => $data]);
    }

    //调价
    public function actionDiscount(){
        if($_POST){
            $userId = Yii::$app->session->get('adminId');
            $id = Yii::$app->request->post('id');
            $money = Yii::$app->request->post('money');
            $reason = Yii::$app->request->post('reason');
            if($money == '' || $reason == ''){
                die('<script>alert("请输入调价金额及原因");history.go(-1);</script>');
            }
            $model = new AdminDiscount();
            $model->money = $money;
            $model->reason = $reason;
            $model->orderId = $id;
            $model->userId = $userId;
            $model->createTime = time();
            $model->save();
            $sign = Order::findOne($id);
            $moneyUp = $sign->payable+($money);
            $moneyUp = round($moneyUp ,2);
            Order::updateAll(['payable' => $moneyUp],"id=$id");
            $model = new AdminRecord();
            $model->userId = $userId;
            $model->content = "管理员id($userId),对订单id($id)进行调价金额为($money)";
            $model->createTime = time();
            $model->save();
            $url= Yii::$app->request->post('url');
            $this->redirect($url);
        }else{
            $id = Yii::$app->request->get('id');
            $url= Yii::$app->request->get('url');
            return $this->render('discount',['id' => $id,'url' => $url]);
        }
    }

    /**
     *添加订单
     * @Obelisk
     */
    public function actionAdd(){
        return $this->render('add');
    }

}