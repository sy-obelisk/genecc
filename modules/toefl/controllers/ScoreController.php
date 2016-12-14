<?php
/**
 * 分数管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-6-17
 * Time: 下午2:37
 */
namespace app\modules\toefl\controllers;


use app\modules\toefl\models\Score;
use yii;
use app\libs\AppControl;

class ScoreController extends AppControl {
    public function actionIndex()
    {
        $data = Score::find()->orderBy('number DESC')->all();
        return $this->render('index',['data' => $data,'block' => $this->block]);
    }


}