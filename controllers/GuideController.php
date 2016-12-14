<?php

namespace app\controllers;

use app\modules\cn\models\HistoryRecord;
use app\modules\cn\models\TestStatistics;
use app\modules\cn\models\Content;
//use app\modules\content\models\Content;
use app\modules\user\models\UserAnswer;
use Yii;
use yii\web\Controller;
use app\models\Excl;
use app\modules\content\models\Category;
use app\modules\content\models\CategoryContent;
use app\modules\content\models\ContentExtend;
use app\modules\content\models\ExtendData;


class GuideController extends Controller
{
    //听力导入
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $data = Yii::$app->db->createCommand("Select * From x2_excl")->queryAll();

        foreach($data as $v){
            if($v['id']){
                $model =  new Content();
                $catName = substr($v['number'],0,6);
                $catId = Category::find()->where("name='$catName'")->one();
                $vice1 = Category::find()->where("name='{$v['vice1']}'")->one();
                $vice2 = Category::find()->where("name='{$v['vice2']}'")->one();
                $catId = $catId->id;
                $vice1 = $vice1->id;
                $vice2 = $vice2->id;
                $model->pid = 0;
                $model->catId = $catId;
                $model->name = $v['name'];
                $model->title = substr($v['number'],7);
                $model->image = '/files/guide/TPO 11/TFindex_boPart.png';
                $model->createTime = date("Y-m-d H:i:s");
                $model->userId = 1;
                $model->save();
                $contentId = $model->primaryKey;
                $model = new CategoryContent();
                $saveData = [
                    'contentId' => $contentId,
                    'catId' => 38,
                ];
                $model->setAttributes($saveData);
                $model->save();
                $this->addSecondClass($contentId,$catId);
                $this->addSecondClass($contentId,$vice1);
                $this->addSecondClass($contentId,$vice2);
                $session->set('contentId',$contentId);
                $this->addContentExtend($contentId,$catId,$v,$catName);
                $this->addChildQuestion($contentId,$v,$catName);
                $this->addChildText($contentId,$v);
            }else{
                $contentId = $session->get('contentId');
                if($v['questionNumber']){
                    $this->addChildQuestion($contentId,$v,$catName);
                    $this->addChildText($contentId,$v);
                }else if($v['section']){
                    $this->addChildText($contentId,$v);

                }
            }
        }
        echo '导入结束';
    }

    public function addContentExtend($contentId,$catId,$val,$catName){
        $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=$catId AND belong='content' ORDER by id ASC")->queryAll();
        foreach($cateExtend as $k => $v){
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $v['id'];
            $contExtendModel->contentId = $contentId;
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
            $contExtendModel->required = $v['required'];
            $contExtendModel->requiredValue = $v['requiredValue'];
            if($k == 0){
                $contExtendModel->value = '';
                $contExtendModel->save();
            }
            if($k == 1){
                $contExtendModel->value = '';
                $contExtendModel->save();
            }
            if($k == 2){
                $contExtendModel->value = "/files/guide/".$catName."/".$val['textUrl'];
                $contExtendModel->save();
            }
            if($k == 3){
                $value = file_get_contents("files/guide/".$catName."/".$val['textContent']);
                if(!isset($value{255})){
                    $contExtendModel->value = $value;
                }
                $contExtendModel->save();
                if(isset($value{255})){
                    $dataModel = new ExtendData();
                    $dataModel->extendId = $contExtendModel->primaryKey;
                    $dataModel->value = $value;
                    $dataModel->save();
                }
            }
            if($k == 4){
                $contExtendModel->value = $val['cnName'];
                $contExtendModel->save();
            }
        }
    }

    public function addChildQuestion($contentId,$val,$catName){
        $model =  new Content();
        $model->pid = $contentId;
        $model->catId = 48;
        $model->name = $val['questionText'];
        $model->createTime = date("Y-m-d H:i:s");
        $model->userId = 1;
        $model->save();
        $contentId = $model->primaryKey;
        $this->addSecondClass($contentId,48);
        $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=48 AND belong='content' ORDER by id ASC")->queryAll();
        foreach($cateExtend as $k => $v){
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $v['id'];
            $contExtendModel->contentId = $contentId;
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
            $contExtendModel->required = $v['required'];
            $contExtendModel->requiredValue = $v['requiredValue'];
            if($k == 0){
                $value =  $val['selectText'];
                if(!isset($value{255})){
                    $contExtendModel->value = $value;
                }
                $contExtendModel->save();
                if(isset($value{255})){
                    $dataModel = new ExtendData();
                    $dataModel->extendId = $contExtendModel->primaryKey;
                    $dataModel->value = $value;
                    $dataModel->save();
                }
            }
            if($k == 1){
                $contExtendModel->value = $val['answer'];
                $contExtendModel->save();
            }
            if($k == 2){
                $contExtendModel->value = "/files/guide/".$catName."/".$val['questionUrl'];
                $contExtendModel->save();
            }
            if($k == 3){
                $contExtendModel->value = !empty($val['questionUrl2'])?"/files/guide/".$catName."/".$val['questionUrl2']:'';;
                $contExtendModel->save();
            }
            if($k == 4){
                $contExtendModel->value = $val['questionType'];;
                $contExtendModel->save();

            }
        }
    }
    public function addChildText($contentId,$val){
        $model =  new Content();
        $model->pid = $contentId;
        $model->catId = 49;
        $model->name = 'childText';
        $model->createTime = date("Y-m-d H:i:s");
        $model->userId = 1;
        $model->save();
        $contentId = $model->primaryKey;
        $this->addSecondClass($contentId,49);
        $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=49 AND belong='content' ORDER by id ASC")->queryAll();
        foreach($cateExtend as $k => $v){
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $v['id'];
            $contExtendModel->contentId = $contentId;
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
            $contExtendModel->required = $v['required'];
            $contExtendModel->requiredValue = $v['requiredValue'];
            if($k == 0){
                $contExtendModel->value = $val['section'];
                $contExtendModel->save();
            }
            if($k == 1){
                $contExtendModel->value = $val['sentence'];
                $contExtendModel->save();
            }
            if($k == 2){
                $value =  $val['sentenceText'];
                if(!isset($value{255})){
                    $contExtendModel->value = $value;
                }
                $contExtendModel->save();
                if(isset($value{255})){
                    $dataModel = new ExtendData();
                    $dataModel->extendId = $contExtendModel->primaryKey;
                    $dataModel->value = $value;
                    $dataModel->save();
                }
            }
            if($k == 3){
                $contExtendModel->value = $val['time'];
                $contExtendModel->save();
            }
            if($k == 4){
                $value =  $val['sentenceCnText'];
                if(!isset($value{255})){
                    $contExtendModel->value = $value;
                }
                $contExtendModel->save();
                if(isset($value{255})){
                    $dataModel = new ExtendData();
                    $dataModel->extendId = $contExtendModel->primaryKey;
                    $dataModel->value = $value;
                    $dataModel->save();
                }
            }
        }
    }

    public function addSecondClass($contentId,$catId){
        $model = new CategoryContent();
        $saveData = [
            'contentId' => $contentId,
            'catId' => $catId,
            ];
        $model->setAttributes($saveData);
        $model->save();
    }
    //口语导入
    public function actionSpoken(){
        $data = Yii::$app->db->createCommand("Select * From x2_spoken")->queryAll();
        foreach($data as $k=>$v){
            if($v['category'] != ''){
                $id = Category::find()->where("name='{$v['category']}'")->one();
                Yii::$app->session->set('id',$id->id);
                Yii::$app->session->set('category',$v['category']);
            }
            $id = Yii::$app->session->get('id');
            $category = Yii::$app->session->get('category');
            $model = new Content();
            $model->catId = $id;
            $model->name = "question ".$v['title'];
            $model->pid = 0;
            $model->title =$v['title'];
            $model->image = '';
            $model->createTime = date("Y-m-d H:i:s");
            $model->userId = 1;
            $model->save();
            $contentId = $model->primaryKey;
            $model = new CategoryContent();
            $saveData = [
                'contentId' => $contentId,
                'catId' => $id,
            ];
            $model->setAttributes($saveData);
            $model->save();
            $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=$id AND belong='content' ORDER by id ASC")->queryAll();
            foreach($cateExtend as $key=>$val){
                $contExtendModel = new ContentExtend();
                $contExtendModel->catExtendId = $val['id'];
                $contExtendModel->contentId = $contentId;
                $contExtendModel->name = $val['name'];
                $contExtendModel->title = $val['title'];
                $contExtendModel->image = $val['image'];
                $contExtendModel->description = $val['description'];
                $contExtendModel->type = $val['type'];
                $contExtendModel->userId = $val['userId'];
                $contExtendModel->createTime = $val['createTime'];
                $contExtendModel->inheritId = $val['inheritId'];
                $contExtendModel->canDelete = $val['canDelete'];
                $contExtendModel->code = $val['code'];
                $contExtendModel->typeValue = $val['typeValue'];
                $contExtendModel->required = $val['required'];
                $contExtendModel->requiredValue = $val['requiredValue'];
                if($key == 0){
                    $contExtendModel->value = '';
                    $contExtendModel->save();
                    $dataModel = new ExtendData();
                    $dataModel->extendId = $contExtendModel->primaryKey;
                    $dataModel->value = $v['readText'];
                    $dataModel->save();
                }
                if($key == 1){
                    $contExtendModel->value = !empty($v['listenFile'])?"/files/spoken/".$category."/".$v['listenFile']:'';
                    $contExtendModel->save();
                }
                if($key == 2){
                    $contExtendModel->value = '';
                    $contExtendModel->save();
                }
                if($key == 3){
                    $contExtendModel->value = '';
                    $contExtendModel->save();
                    $dataModel = new ExtendData();
                    $dataModel->extendId = $contExtendModel->primaryKey;
                    $dataModel->value = $v['questionText'];
                    $dataModel->save();
                }
                if($key == 4){
                    $contExtendModel->value = "/files/spoken/".$category."/".$v['questionFile'];
                    $contExtendModel->save();
                }
            }
        }
    }

    public function actionTestContent(){
        $listen = Category::find()->where("pid=38")->all();
        $speaking = Category::find()->where("pid=102")->all();
        foreach($listen as $k=>$v){
            $model = new Content();
            $model->name = $v['name'];
            $model->pid = 0;
            $model->catId = 146;
            $model->createTime = time();
            $model->userId = 1;
            $model->save();
            $contentId = $model->primaryKey;
            $model = new CategoryContent();
            $saveData = [
                'contentId' => $contentId,
                'catId' => 146,
            ];
            $model->setAttributes($saveData);
            $model->save();
            $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId=146 AND belong='content' ORDER by id ASC")->queryAll();
            foreach($cateExtend as $key => $val){
                $contExtendModel = new ContentExtend();
                $contExtendModel->catExtendId = $val['id'];
                $contExtendModel->contentId = $contentId;
                $contExtendModel->name = $val['name'];
                $contExtendModel->title = $val['title'];
                $contExtendModel->image = $val['image'];
                $contExtendModel->description = $val['description'];
                $contExtendModel->type = $val['type'];
                $contExtendModel->userId = $val['userId'];
                $contExtendModel->createTime = $val['createTime'];
                $contExtendModel->inheritId = $val['inheritId'];
                $contExtendModel->canDelete = $val['canDelete'];
                $contExtendModel->code = $val['code'];
                $contExtendModel->typeValue = $val['typeValue'];
                $contExtendModel->required = $val['required'];
                $contExtendModel->requiredValue = $val['requiredValue'];
                if($key == 0){
                    $contExtendModel->value = $v['id'];
                    $contExtendModel->save();
                }
                if($key == 1){
                    $contExtendModel->value = $speaking[$k]['id'];
                    $contExtendModel->save();
                }
                if($key == 2){
                    $contExtendModel->value = '';
                    $contExtendModel->save();
                }
                if($key == 3){
                    $contExtendModel->value = '';
                    $contExtendModel->save();
                }
            }
        }
    }

    public function actionGuideTest(){
        $sql = "select * from {{%tf_test_history}} WHERE recordType=1";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $v){
            $model = new TestStatistics();
            $contentModel = new Content();
            $tpoNumber = $contentModel->getSpokenId($v['testId']);
            $model->listen = $v['testId'];
            $model->tpoNumber = $tpoNumber;
            $model->startTime = $v['startTime'];
            $model->endTime = $v['endTime'];
            $model->userId = $v['userId'];
            $model->type = $v['isBreak'];
            $model->save();
            $statisticsId = $model->primaryKey;
            HistoryRecord::updateAll(['statisticsId' => $statisticsId,'testType' => 'listen'],"id={$v['id']}");
            $sql = "select GROUP_CONCAT(id) as contentStr from {{%content}} WHERE catId={$v['testId']} GROUP by catId";
            $contentStr = Yii::$app->db->createCommand($sql)->queryOne();
            $contentStr = $contentStr['contentStr'];
            UserAnswer::updateAll(['recordId' => $v['id']],"pid in ($contentStr) AND userId={$v['userId']} AND belong='test'");
        }
    }

    public function actionIdeas(){
        $sql = "select ce.id as extendId,c.id,c.title,ca.name from {{%content_extend}} ce LEFT JOIN {{%content}} c ON ce.contentId=c.id LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE ca.pid=102 AND ce.code='32cc8e6f27caf3fdf26e8cfd4e7b4433' ORDER BY c.id ASC";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        $arr = [];
        foreach($data as $v){
            if($v['title'] ==1 || $v['title'] == 2){
                $arr['extendId'] = $v['extendId'];
                $arr['value'] = '1、按照有细节（也就是抽象意见的具体展开）；
2、有必要的连接词（but, moreover 之类）；
3、单词尽可能多样化（同一单词不要多次重复）；
4、看情况适当使用从句长句（which, who 什么的就算）；
5、句子结构正确；
6、内容完整最重要，论据直接支持论点；
7、表达多样性：插入语，状语前置，形容词、副词的灵活运用。
8、语速不必过快（重点是要人家听清楚你在说什么）
9、可以有一两处小错，说不完也没关系的方式准备.';
            }
            if($v['title'] ==3){
                $arr['extendId'] = $v['extendId'];
                $arr['value'] = '阅读
记：1.主要内容；2.1st 理由；3.2nd 理由
听力
记：1.观点提出人的性别；
2.什么观点（同意/反对）；
3.针对1st 理由的同意/反对；
4.针对2nd 理由的同意/反对；
TIP：阅读的两条理由在听力中会被重复所以阅读时间来不及可以听力的时候再
记；
回答：看题目要求来
一般是先总结阅读内容The school made an announcement that...../ in the proposal,
there is a student suggesting that....
然后说学生意见the ... in the conversation agreed/disagreed with ...because....1st
reason 2nd reason';
            }
            if($v['title'] ==4){
                $arr['extendId'] = $v['extendId'];
                $arr['value'] = '这道题一般来说是大家最头疼的题目。
因为阅读很抽象题目很多时候两个单词都看不懂更多时候是看懂了也不知道
在说什么。
这道题记住一个原则
阅读的抽象概念和听力的具体事例是一一对应的，就是说，如果阅读说reference group 是指一帮子人我们很崇拜他们所以他们干嘛我们，就会去学他们干嘛
听力中必然会出现具体的一帮子人我们绝对会崇拜他们他们绝对会做一些具
体的事情我们绝对会去学他们做这些事情。
听力中除了以上和阅读相关的，其他的信息不用听不用记。
回答：题目会要求用听力中的例子解释阅读定义
in the lecture, the professor.....
然后原则是听力中请出现阅读关键词，
比如这道题说完听力中出现具体的一帮子人我们很崇拜他们以后要说therefore, they became his REFERENCE GROUP。目的是让rater 知道你是真的听懂了听力和阅读之间的联系。';
            }
            if($v['title'] ==5){
                $arr['extendId'] = $v['extendId'];
                $arr['value'] = '听
1、问题
问题的组成大多情况下遵循这个原则：期望BUT 现实且两者之间有巨大的矛盾
比如想去音乐会（期望） BUT 那个时间有AUDITION（现实）；
2、两个SOLUTION
回答：
总结问题说清楚solution（不需理由），然后说你选哪个为什么，其实后半部分就是第二题的微缩版本答题技巧请参照1，2 题答题技巧。';
            }
            if($v['title'] ==6){
                $arr['extendId'] = $v['extendId'];
                $arr['value'] = '技巧：上来三句话一定是废话三句之后出现重点，
重点=第四题概念
也就是同样的技巧抓关键词接下啦每一个例子都跟关键词对应，就拿日本7 月6 号的题来讲，河里面的生物有adaptation 所以可以不被水流冲走活下去，接下来你需要听是哪个生物有什么adaptation ，怎么不被水冲走，于是出现了第一个larva 它有个Hook 可以勾住河床所以冲不走，第二个xx（名字忘了） 它没有鱼漂所以不会float。
tip：动物名字如果真的记不下来可以记首字母因为后面问题里面会出现这两只
的名字照着念就好了。';
            }
            Yii::$app->db->createCommand()->insert('{{%extend_data}}',$arr)->execute();
        }
    }

    public function actionQuestionName(){
        $sql = "SELECT pid,id,name from x2_content WHERE LENGTH(`name`)>99;";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $k => $v){
            $sql = "SELECT ca.name,c.title from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.id={$v['pid']}";
            $p = Yii::$app->db->createCommand($sql)->queryOne();
            $data[$k]['title'] = $p['title'];
            $data[$k]['catName'] = $p['name'];

        }
        foreach($data as $v){
            if(strstr($v['name'],"'")){
                var_dump($v['id'].$v['title'].$v['catName']);
            }else{
                $sql = "select content from {{%questionname}} WHERE content like '%{$v['name']}%'";
                $name = Yii::$app->db->createCommand($sql)->queryOne();
                Content::updateAll(['name' => $name['content']],"id={$v['id']}");
            }

        }

    }

    public function actionArticle(){
        $sql = "select c.title,c.id,c.catId,ca.name as catName from {{%content}} c LEFT JOIN {{%category}} ca ON c.catId=ca.id WHERE c.title in(3,4) AND ca.pid =102";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($data as $v){
            $cateExtend = Yii::$app->db->createCommand("select * from x2_category_extend WHERE catId={$v['catId']} AND belong='content' AND code='61f13913003193ea19e7e1271bca2752' ORDER by id ASC")->queryOne();
            $contExtendModel = new ContentExtend();
            $contExtendModel->catExtendId = $cateExtend['id'];
            $contExtendModel->contentId = $v['id'];
            $contExtendModel->name = $cateExtend['name'];
            $contExtendModel->title = $cateExtend['title'];
            $contExtendModel->image = $cateExtend['image'];
            $contExtendModel->description = $cateExtend['description'];
            $contExtendModel->type = $cateExtend['type'];
            $contExtendModel->userId = $cateExtend['userId'];
            $contExtendModel->createTime = $cateExtend['createTime'];
            $contExtendModel->inheritId = $cateExtend['inheritId'];
            $contExtendModel->canDelete = $cateExtend['canDelete'];
            $contExtendModel->code = $cateExtend['code'];
            $contExtendModel->typeValue = $cateExtend['typeValue'];
            $contExtendModel->required = $cateExtend['required'];
            $contExtendModel->requiredValue = $cateExtend['requiredValue'];
            $contExtendModel->value = "/files/spoken/".$v['catName']."/".$v['catName']."-Q".$v['title']."-background.mp3";
            $contExtendModel->save();

            }
        }

    public function actionChange(){
        $data = Content::find()->where("catId in (151,152,153,154)")->all();
        foreach($data as $v){
            Content::updateAll(['catId' => 150],"id={$v['id']}");
            $model = new CategoryContent();
            $model->catId = 150;
            $model->contentId = $v['id'];
            $model->save();
        }
    }

    public function actionChangeType(){
        $data = Content::find()->where("catId in (151,152,153,154)")->all();
        foreach($data as $v){
            Content::updateAll(['catId' => 150],"id={$v['id']}");
            $model = new CategoryContent();
            $model->catId = 150;
            $model->contentId = $v['id'];
            $model->save();
        }
    }

}
