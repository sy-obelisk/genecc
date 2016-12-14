<?php 
namespace app\modules\cn\models;
use app\modules\cn\models\UserDiscuss;
use app\modules\content\models\CategoryContent;
use app\modules\content\models\ContentExtend;
use app\modules\content\models\ExtendData;
use yii\db\ActiveRecord;
use app\libs\GoodsPager;
use app\libs\Pager;
class Content extends ActiveRecord {
    public $cateData;

    public static function tableName(){
            return '{{%content}}';
    }
    public static function getBook($catId,$category='',$type='',$order='',$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "Select c.*,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as buyNum,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as originalPrice FROM {{%content}} c WHERE c.catId=$catId AND pid =0 ";
        if($category){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($category))  ";
        }
        if($type){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($type))  ";
        }
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
    /**
     * toefl调用内容
     * @param $select 包含where条件，查询字段，分页，排序
     * @return array
     * @Obelisk
     */
    public static function getClass($select){
        $where = "1=1";
        $where .= isset($select['where'])?" AND ".$select['where']:'';
        $seField = "";
        $fields = isset($select['fields'])?$select['fields']:'';
        //原价
        if(strstr($fields,'originalPrice')){
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as originalPrice";
        }
        //vip总监
        if(strstr($fields,'vip')){
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='63948cf4e1234694cfa02048a77ad754') as vip";
        }
        //总监老师
        if(strstr($fields,'majordomo')){
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='ab6df6ee04cfccc7f6ff9aadf0f46a8d') as majordomo";
        }
        //A级培训师
        if(strstr($fields,'A')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='3aa42936f977b9ef0b1717c646c5f91c') as A";
        }
        //描述
        if(strstr($fields,'description')){
            $seField .= ",(SELECT  CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b4433') as description";
        }
        //培训师
        if(strstr($fields,'trainer')){
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='784b0cdb89d960e484f35f8872b7b7ea') as trainer";
        }
        //课程时长
        if(strstr($fields,'duration')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='c8cc4bd99d4fcfcdfd5673bd635b5bcd') as duration";
        }
        //连接地址
        if(strstr($fields,'url')){
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='43f8278a38a3539a7cfcdff67e5af92c') as url";
        }
        //开课日期
        if(strstr($fields,'commencement')){
            $seField .= ",(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='90f1d6d0fea6f171e8b82d9cbefee283') as commencement";
        }
        //性价比
        if(strstr($fields,'performance')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b44f9') as performance";
        }
        //主讲课程
        if(strstr($fields,'speak')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as speak";
        }
        //价格
        if(strstr($fields,'price')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price";
        }
        //答案
        if(strstr($fields,'answer')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer";
        }
        //备选项
        if(strstr($fields,'alternatives')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as alternatives";
        }
//文章
        if(strstr($fields,'article')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as article";
        }
        //听力文件
        if(strstr($fields,'listeningFile')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='99b3cc02b18ec45447bd9fd59f1cd655') as listeningFile";
        }
        //中午名称
        if(strstr($fields,'cnName')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='6d67cf3eba969f1515df48f6f43e740d') as cnName";
        }
        //句子编号
        if(strstr($fields,'sentenceNumber')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='60883c91048a952f7abe6c666b54648b') as sentenceNumber";
        }

        //段落编号
        if(strstr($fields,'numbering')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='28ec209ca256d8e34aea41d0bda50fc4') as numbering";
        }
        //问题补充听力
        if(strstr($fields,'problemComplement')){
            $seField .= ",(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='e4dd05210147f22f9da9bdfcb1c0c562') as problemComplement";
        }
        if(isset($select['category'])){
            if(isset($select['type'])){
                $where .= " AND c.id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in(".$select['category'].") ) ";
            }else{
                $count = count(explode(",",$select['category']));
                $where .= " AND c.id in(select cc.contentId from {{%category_content}} cc where cc.catId in(".$select['category'].") group by cc.contentId having count(1)=$count ) ";
            }
        }
        $page = isset($select['page'])?$select['page']:1;
        $order = isset($select['order'])?$select['order']:'c.sort ASC,c.id DESC';
        $pageSize = isset($select['pageSize'])?$select['pageSize']:10;
        $limit = (($page-1)*$pageSize).",$pageSize";
        $sql = "select c.*,ca.name as catName$seField from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id where $where";
        if(isset($select['extend_category'])){
            $sql = " select * from ($sql) c WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in({$select['extend_category']}))  ";
        }
        $content = \Yii::$app->db->createCommand("$sql ORDER BY $order LIMIT ".$limit)->queryAll();
        if(isset($select['pageStr'])){
            $count = count(\Yii::$app->db->createCommand("$sql")->queryAll());
            $pageModel = new Pager($count,$page,$pageSize);
            $pageStr = $pageModel->GetPagerContent();
            $content['pageStr'] = $pageStr;
            $content['count'] = $count;
            $content['total'] = ceil($count/$pageSize);
        }
        return $content;
    }
    /**
     *  获取顾问老师的案例
     *  by Yanni
     */
    public function getCaseList($contentid){
        $sql = "select * from {{%content}} as con left join {{%related_content}} as re on con.id=re.relatedContentId where re.contentId=".$contentid;
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }
    /**
     * 获取大学排名
     * @Yanni
     */
    public function rankSearch($catId,$rank_type='',$year='',$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "Select c.*, (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as alternatives,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as article FROM {{%content}} c WHERE c.catId=$catId AND pid =0 ";
        if($rank_type){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($rank_type))";
        }
        if($year){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($year))";
        }
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= 'ORDER BY CAST(sort as SIGNED) ASC';
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump(\Yii::$app->db->createCommand($sql));die;
        $pageModel = new GoodsPager($count,$page,$pageSize,10);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
    /**
     *
     * @Yanni
     */
    public function dynamicListSearch($catId,$country='',$regionid='',$order='',$page,$pageSize){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "Select c.*, (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as buyNum,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='b34abe997968ee9a0852814db839f75e') as age,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='63948cf4e1234694cfa02048a77ad754') as students,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='ab6df6ee04cfccc7f6ff9aadf0f46a8d') as sid,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='3aa42936f977b9ef0b1717c646c5f91c') as source FROM {{%content}} c WHERE c.catId=$catId AND pid =0 ";
        if($country){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($country))";
        }
        if($regionid){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($regionid))";
        }
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump(\Yii::$app->db->createCommand($sql));die;
        $pageModel = new GoodsPager($count,$page,$pageSize,10);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }
    /**
     *
     * @Obelisk
     */
    public function listSearch($category,$country='',$aim='',$order='',$page,$pageSize=8){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "Select c.*, (SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as buyNum,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as originalPrice FROM {{%content}} c WHERE c.catId=150 AND pid =0 ";
        if($category){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($category))  ";
        }
        if($country){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($country))  ";
        }
        if($aim){
            $sql = "select * from ($sql) aim WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($aim))  ";
        }
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
//        $ages = array();
//        foreach ($data as $user) {
//            $ages[] = $user['price'];
//        }
//        array_multisort($ages, SORT_DESC, $data);
        $pageModel = new GoodsPager($count,$page,$pageSize,5);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }

    /**
     *
     * @Obelisk
     */
    public function courseSearch($catId,$category='',$type='',$order='',$page,$pageSize=8){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "Select c.*,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as buyNum,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as originalPrice FROM {{%content}} c WHERE c.catId=$catId AND pid =0 ";
        if($category){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($category))  ";
        }
        if($type){
            $sql = "select * from ($sql) country WHERE id in(select DISTINCT cc.contentId from {{%category_content}} cc where cc.catId in($type))  ";
        }
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $pageModel = new GoodsPager($count,$page,$pageSize,5);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }

    /**
     *
     * @Obelisk
     */
    public function Search($content='',$order='',$page,$pageSize=8){
        $limit = " limit ".($page-1)*$pageSize.",$pageSize";
        $sql = "Select c.*,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='dc4793dfb52237db70b240038d086d98') as buyNum,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='0ac9d45187ea22acbadedef8f8ab0e54') as price,(SELECT CONCAT_WS(' ',ce.value,ed.value) From {{%content_extend}} ce left JOIN {{%extend_data}} ed ON ed.extendId=ce.id WHERE ce.contentId=c.id AND ce.code='7611fcaa334c360593cb15bfdd72dc70') as answer,(SELECT ce.value FROM {{%content_extend}} ce WHERE ce.contentId=c.id AND ce.code='61f13913003193ea19e7e1271bca2752') as originalPrice FROM {{%content}} c WHERE c.name like '%$content%' AND pid =0 ";
        $count = count(\Yii::$app->db->createCommand($sql)->queryAll());
        $sql .= $order;
        $sql .= " $limit";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $pageModel = new GoodsPager($count,$page,$pageSize,5);
        $pageStr = $pageModel->GetPagerContent();
        $totalPage = ceil($count/$pageSize);
        return ['totalPage' => $totalPage,'data' => $data,'pageStr' => $pageStr,'count' => $count,'page' => $page];
    }

    /**
     * 通过标签获取课程Id
     * @Obelisk
     */
    public function getClassDetails($tagStr,$pid){
        $count = count(explode($tagStr,","));
        $sql = "select c.id from {{%content}} c WHERE c.pid=$pid AND c.id in(select ct.contentId from {{%content_tag}} ct where ct.tagContentId in(".$tagStr.") group by ct.contentId having count(1)=$count ) ";
        $data = \Yii::$app->db->createCommand($sql)->queryOne();
        return $data;
    }

    /**
     * 日历活动
     * @return array
     * @Obelisk
     */
    public static function getActive(){
        $date = date("Y-m");
        $firstday = date("Y-m-01",strtotime($date));
        $lastday = date("Y-m-d",strtotime("$firstday +2 month"));
        $sql = "select c.id,c.name,ce.value from {{%content}} c LEFT JOIN {{%content_extend}} ce ON c.id=ce.contentId WHERE ce.code='6d67cf3eba969f1515df48f6f43e740d' AND c.catId=218 AND ce.value >='$firstday' AND ce.value <='$lastday'";
        $data = \Yii::$app->db->createCommand($sql)->queryAll();
        $re = [];
        $date = [];
        foreach($data as $v){
            $re[ date("Y-m-d",strtotime($v['value']))] = $v;
            $date[] = date("Y-m-d",strtotime($v['value']));
        }
        return ['activity' => $re,'activityDate' => $date];
    }

    /**
     * 信息采集添加内容
     * @param $phone
     * @param $name
     * @param $extendVal
     * @Obelisk
     */
    public function addContent($catId,$image='',$name,$extendVal){
        $this->name = $name;
        $this->image = $image;
        $this->catId = $catId;
        $this->createTime = date('Y-m-d H:i:s');
        $this->save();
        $model = new CategoryContent();
        $model->contentId = $this->primaryKey;
        $model->catId = $catId;
        $model->save();
        $cateExtend = \Yii::$app->db->createCommand("select * from {{%category_extend}} WHERE catId=$catId AND belong='content' ORDER by id ASC")->queryAll();
        foreach($cateExtend as $k => $v){
            if(!isset($extendVal[$k])){
                $extendVal[$k] = "";
            }
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $v['id'];
            $contExtendModel->contentId = $this->primaryKey;
            $contExtendModel->name = $v['name'];
            $contExtendModel->title = $v['title'];
            $contExtendModel->image = $v['image'];
            $contExtendModel->description = $v['description'];
            $contExtendModel->type = $v['type'];
            $contExtendModel->userId = $v['userId'];
            $contExtendModel->createTime = $v['createTime'];
            $contExtendModel->inheritId = $v['inheritId'];
            $contExtendModel->canDelete = $v['canDelete'];
            $contExtendModel->code = $v['code'];
            $contExtendModel->typeValue = $v['typeValue'];
            if(!isset($extendValue[$k]{255})){
                $contExtendModel->value = $extendVal[$k];
            }
            $contExtendModel->save();
            if(isset($extendValue[$k]{255})){
                $dataModel = new ExtendData();
                $dataModel->extendId = $contExtendModel->primaryKey;
                $dataModel->value = $extendVal[$k];
                $dataModel->save();
            }
        }
    }
}
