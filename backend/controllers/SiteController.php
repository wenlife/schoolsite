<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\user;
use common\models\AdminUser;
use common\models\BackendLoginForm;
use backend\models\SignupForm;
//use backend\modules\content\models\Information;
//use backend\modules\content\models\ContentMenu;
//use backend\modules\content\models\infoitem;
//use backend\modules\content\models\Videolist;
//use backend\modules\content\models\Video;
//use backend\modules\content\models\Picturelist;
//use backend\modules\content\models\Picture;
//use backend\modules\test\models\TestItem;
//use backend\modules\test\models\TestScore;
//use backend\modules\test\models\Task;
use backend\modules\guest\models\UserTeacher;
//use backend\modules\school\models\TeachClass;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup','index'],
                        'allow' => true,
                        'roles'=>['?']
                    ],
                    [
                        'actions' => ['logout','list','detail','vdetail','pdetail','center','test','myclass','resetpwd','myinfo','index','error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    { 
       // if (Yii::$app->user->isGuest) 
       // {
            return $this->redirect(['/tcenter']);
        //}
        // $articles = ContentMenu::find()->count();
        // $students = User::find()->count();
        // $teachers = UserTeacher::find()->count();
        // $classes = TeachClass::find()->count();
        // $testItems = TestItem::find()->count();

        // $username = Yii::$app->user->identity->username;
        // $myself = UserTeacher::find()->where(['username'=>$username])->one();
 
        // return $this->render('index',[
        //    // 'articles'=>$articles,
        //    // 'students'=>$students,   
        //    // 'testItems'=>$testItems,
        //     'myself'=>$myself
        // ]);

    }

    public function actionLogin()
    {
        //$this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/tcenter']);
        }
        $model = new BackendLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = AdminUser::findByUsername($model->username);
            if($user->type == "ma")
            {
               return  $this->redirect(['/tcenter/mcenter']);
            }else{
               return  $this->redirect(['/tcenter']);
            }
            //return $this->goBack();
        } else {
            return $this->render('login', ['model' => $model,]);
        }
    }

    public function actionSignup()
    {
        $this->layout = 'main-login';
        $errMSG = [];
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            //exit(var_export($model));
            //如果已经注册
            // if(AdminUser::findByUsername($model->username)){
            //     $errMSG[] = '您已经注册，如果忘记密码，可到信息中心重置！';
            //     return $this->render('signup', ['model' => $model,]);
            // }
            //                 exit("ss");
            //查找是否有安全码
            $teacherModel = new userTeacher();
            $teacher = $teacherModel->find()->where(['secode'=>$model->secode])->one();
            if ($teacher!=null) {

                $model->name = $teacher->name;
                //$model->status = 10;
                if ($user = $model->signup()) {

                     $user->type = $teacher->type;
                     $user->save();
                     $teacher->username = $model->username;
                    if(!$teacher->save())
                    {
                        $errMSG[] = '用户名添加到数据库失败，请联系管理员解决！';
                        return $this->render('signup', ['model' => $model,]);
                    }
                    return $this->redirect(['/site/login']);
                }
            }else{
                $errMSG[] = "安全码不正确！";
            }
        }
        return $this->render('signup', [
            'model' => $model,
            'errMSG'=>$errMSG
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->redirect(['/tcenter']);
    }

    public function actionResetpwd($username)
    {
        $user = User::findByUsername($username);
        if ($user) {
            $user->setPassword($user->username);
            $user->generateAuthKey();
            if($user->save())
            {
                echo "重置用户".$username.'的密码为用户名成功！';
            }

        }
    }


    // public function actionTest()
    // {
    //     $this->layout = 'test';
    //     return $this->render('test');
    // }

    
   // public function actionCenter()
   //  {
   //      return $this->render('center');
   //  }


    // public function actionMyclass()
    // {
    //     $username = Yii::$app->user->identity->username;
    //     $teacher = UserTeacher::find()->where(['username'=>$username])->one();
    //     $classes = UserBanji::find()->where([$teacher->subject=>$teacher->id])->orderby('grade desc')->all();
    //     $students = array();
    //     $class='';
    //     if ($classes) {
    //       if ($post=Yii::$app->request->post()) {
    //          $class = $post['class'];
    //       }else{
    //         $class = $classes[0]->id;
    //       }
    //       $students = User::find()->where(['class'=>$class])->all();

    //     return $this->render('myclass',['class'=>$class,'classes'=>$classes,'students'=>$students]);

    //     }else{
    //         exit('查找您任教的班级失败！');
    //     }

    // }

    // public function actionMyinfo()
    // {
    //     return $this->render('myinfo');
    // }




    // public function actionList($cate)
    // {
    //     $this->layout = "content";
    //     $infoItem = new infoitem();
    //     $item = $infoItem->find()->where(['itemid'=>$cate])->one();

    //     if(!$item){exit('栏目不存在！');}

    //     $Information = new Information();
    //     $videolist = new Videolist();
    //     $piclist = new Picturelist();

    //     if($item->itemtype>0)
    //     {
    //         switch ($item->itemtype) {
    //             case '1':
    //                 $contents = Information::find()->where(['infoitem'=>$cate])->all();
    //                 $view = 'list';
    //                 break;
    //             case '2':
    //                 $contents = Videolist::find()->where(['cid'=>$cate])->all();
    //                 $view = 'videolist';
    //                 break;
    //             case '3':
    //                 $contents = Picturelist::find()->where(['cid'=>$cate])->all();
    //                 $view = 'piclist';
    //                 break;

    //             default:
    //                 exit('请在list中设置相应类别的页面');
    //                 break;
    //         }
    //         return $this->render($view,['article'=>$contents]);
    //     }else{
    //         exit('综合页面还在开发中');
    //     }    
    // }


    // public function actionDetail($id)
    // {
    //     $this->layout = "content";
    //     return $this->render('detail',['model'=>Information::findOne($id)]);
    // }

    // public function actionVdetail($id,$vid=null)
    // {
    //     $videoModel = new Video();
    //     $videos = $videoModel->find()->where(['infoid'=>$id])->orderBy('showorder')->all();

    //     return $this->render('vdetail', [
    //         'model' => Videolist::findOne($id),
    //         'videos'=>$videos,
    //         'vid'=>$vid,
    //     ]);
    // }

    // public function actionPdetail($id)
    // {
    //     $picModel = new Picture();
    //     $pics = $picModel->find()->where(['infoid'=>$id])->orderBy('showorder')->all();
    //        return $this->render('pdetail', [
    //         'model' => Picturelist::findOne($id),
    //         'pictures'=>$pics,
    //     ]);
    // }


}
