<?php
/**
 * 后台接口基础类
 * by Obelisk
 */
	namespace app\libs;
    use yii;
    use yii\web\Controller;
    use app\modules\basic\models\Params;
	class ApiControl extends Controller {
		public function init() {
            $this->config();
		}

        public function config(){
            define('baseUrl',Yii::$app->params['baseUrl']);
            define('tablePrefix',Yii::$app->db->tablePrefix);
            $data = Params::find()->all();
            foreach($data as $v){
                define($v->key,$v->value);
            }
        }
	}
?>