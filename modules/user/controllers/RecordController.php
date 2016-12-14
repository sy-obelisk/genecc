<?php
/**
 * 记录管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\user\controllers;


use yii;
use app\libs\AppControl;
use app\libs\Method;
use app\modules\user\models\AdminRecord;

class RecordController extends AppControl {
    public $enableCsrfValidation = false;
    //用户列表
    public function actionIndex()
    {
        $page = Yii::$app->request->get('page',1);
        $beginTime = strtotime(Yii::$app->request->get('beginTime',''));
        $endTime = strtotime(Yii::$app->request->get('endTime',''));
        $userId  = Yii::$app->request->get('userId','');
        $where="1=1";
        if($beginTime){
            $where .= " AND createTime>=$beginTime";
        }
        if($endTime){
            $where .= " AND createTime<=$endTime";
        }
        if($userId){
            $where .= " AND userId = $userId";
        }
        $model = new AdminRecord();
        $data = $model->getAllRecord($where,10,$page);
        $page = Method::getPagedRows(['count'=>$data['count'],'pageSize'=>10, 'rows'=>'models']);
        return $this->render('index',['page' => $page,'data' => $data['data'],'block' => $this->block]);
    }

}