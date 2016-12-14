<?php
/**
 * 分数管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\order\controllers;



use app\modules\order\models\FavourableActivity;
use yii;
use app\libs\AppControl;

class FavouriteController extends AppControl {
    public $enableCsrfValidation = false;

    /**
     * 优惠活动列表
     * @return string
     * @Obelisk
     */
    public function actionIndex()
    {
        $model = new FavourableActivity();
        $data = $model->find()->all();
        return $this->render('index',['data' => $data,'block' => $this->block]);
    }

    /**
     * 添加优惠活动
     * @return string
     * @Obelisk
     */
    public function actionAdd()
    {
        if($_POST){
            $id = Yii::$app->request->post('id');
            $favourable = Yii::$app->request->post('favourable');
            $this->checkSub($favourable);
            if($id){
                $sign = $this->updateFavourite($favourable,$id);
            }else{
                $sign = $this->addFavourite($favourable);
            }
            if($sign){
                $this->redirect('/order/favourite/index');
            }else{
                echo '<script>alert("失败，请重试");history.go(-1);</script>';
                die;
            }
        }else{
            return $this->render('add');
        }
    }

    //具体添加优惠活动方法
    public function addFavourite($favourable){
        if($favourable['rangeType'] != 1){
            $favourable['rangeExt'] = implode(",",$favourable['rangeExt']);
        }
        $favourable['startTime'] = strtotime($favourable['startTime']);
        $favourable['endTime'] = strtotime($favourable['endTime']);
        $favourable['userId'] = Yii::$app->session->get('adminId');
        $favourable['createTime'] = time();
        $sign = Yii::$app->db->createCommand()->insert('{{%favourable_activity}}',$favourable)->execute();
        return $sign;
    }

    //具体修改优惠活动方法
    public function updateFavourite($favourable,$id){
        if($favourable['rangeType'] != 1){
            $favourable['rangeExt'] = implode(",",$favourable['rangeExt']);
        }
        $favourable['startTime'] = strtotime($favourable['startTime']);
        $favourable['endTime'] = strtotime($favourable['endTime']);
        $sign = FavourableActivity::updateAll($favourable,"id=$id");
        return $sign;
    }

    public function checkSub($favourable){
        if($favourable['name'] == ''){
            die('<script>alert("请输入活动名称");history.go(-1);</script>');
        }
        if($favourable['startTime'] == '' || $favourable['endTime'] == ''){
            die('<script>alert("请完善活动时间");history.go(-1);</script>');
        }
        if($favourable['startTime'] == '' || $favourable['endTime'] == ''){
            die('<script>alert("请完善活动时间");history.go(-1);</script>');
        }
        if($favourable['rangeType'] != 1 && count($favourable['rangeExt']) <=0){
            die('<script>alert("请选择确切内容或分类");history.go(-1);</script>');
        }
        if(($favourable['type'] == 1 && $favourable['typeExt'] == '' && $favourable['details'] == '') || ($favourable['type'] == 2 && $favourable['details'] == '')){
            die('<script>alert("请完善优惠类型内容");history.go(-1);</script>');
        }
    }
    /**
     * 修改优惠活动
     * @Obelisk
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $favourable = FavourableActivity::findOne($id);
        $content = FavourableActivity::getContent($favourable);
        return $this->render('add',['id' => $id,'data' => $favourable,'content' => $content]);
    }

    /**
     * 删除优惠活动
     * @Obelisk
     */
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        FavourableActivity::deleteAll("id=$id");
        $this->redirect('/order/favourite/index');
    }

}