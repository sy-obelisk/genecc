<?php

namespace app\controllers;

use Yii;
use app\libs\ApiControl;


class TestController extends ApiControl
{
    public function actionIndex()
    {

        $url = "http://fanyi.youdao.com/openapi.do?keyfrom=5asdfasdf6&key=925644231&type=data&only=dict&doctype=json&version=1.1&q=name";
        $list = file_get_contents($url);
        $js_de = json_decode($list,true);
        var_dump($js_de);die;
        return $this->renderPartial('index');
    }

}
