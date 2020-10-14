<?php
namespace backend\controllers;
use Yii;
use common\models\BackendLoginForm;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use backend\modules\guest\models\UserTeacher;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachDaytime;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachDepartment;

class TcenterController extends \yii\web\Controller
{
        public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
               // 'only'=>['index','mcenter','cal','bcourse','bcourse','cal'],
                'only'=>['mcenter','cal','bcourse','bcourse','cal','index'],
                'rules' => [
                    // [
                    //     'actions' => ['create', 'query','success','CaptchaAction'],
                    //     'allow' => true,
                    //     'roles'=>['?']
                    // ],
                   [
                       // 'actions' => ['index','mcenter','cal','bcourse','cal'],
                        'actions' => ['mcenter','cal','bcourse','cal','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
	public $layout="tcenter";


    public function actionIndex($term=null,$subject='yw',$teacher_id=null)
    {

        $model     = new BackendLoginForm();
        $courseArr = array();
        $allTerm = TeachYearManage::getYearArray();
        $term = $term?$term:key($allTerm);

        if(!$teacher_id)
        {
            if(!Yii::$app->user->isGuest)
            {
                $teacher = UserTeacher::find()->where(['username'=>Yii::$app->user->identity->username])->one();
                if(!$teacher)
                {
                 throw new NotFoundHttpException('当前教师'.Yii::$app->user->identity->username.'用户名无法找到！');
                }
                $subject = $teacher->subject;
                $teacher_id = $teacher->id;
            }

        }else{
            $teacher = UserTeacher::findOne($teacher_id);
            $subject = $teacher->subject;
            $teacher_id = $teacher->id;
        }
        $courseArr = [];
        if($teacher_id&&$subject&&$term)
        {
           // print("term=".$term);
            $allTClass = (new \yii\db\Query())->select(['class_id'])->from('teach_manage')->where(['teacher_id'=>$teacher_id,'year_id'=>$term]);
            $courseArr = TeachCourse::getTeacherWeekCourse($term,$subject,$teacher_id); 
            //查找DEPARTMENT,以找到的第一个班级为准
            $tclass = TeachClass::findOne($allTClass->scalar());
        }
        
        if(isset($tclass))
            $department = $tclass->department_id;
        else
            $department = 1;

        return $this->render('index',
        	[
        		'model'=>$model,
        		'courseArr'=>$courseArr,
        		'teacher_id'=>$teacher_id,
        		'subject'=>$subject,
                'allTerm'=>$allTerm,
                'term'=>$term,
                'allDaytime'=> TeachDaytime::getDepartmentDaytime($department),
                'teachers'=>UserTeacher::getSubjectTeacherArray($subject),
        ]);
    }

    public function actionMcenter()
    {
        $this->layout = 'main';
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(['/tcenter']);
        }
        $username = Yii::$app->user->identity->username;
        $myself = UserTeacher::find()->where(['username'=>$username])->one();
 
        return $this->render('mcenter',[
            'myself'=>$myself
        ]);
    }

    public function actionCal()
    {
    	//$this->layout = false;
    	return $this->render('cal');
    }

    public function actionBcourse($term=null,$class_id=null,$department=null)
    {
        $model = new BackendLoginForm();
        //部门信息
        $departments = TeachDepartment::getDepartmentArray();
        $department  = $department?$department:key($departments);
        //班级信息
        $classes     = TeachClass::getClassArray($department);
        $class_id    =  $class_id?$class_id:key($classes);
        //学年信息
        $allTerm     = TeachYearManage::getYearArray();
        $term   =   $term?$term:key($allTerm);
        //任教和课程
        $weekCourse = TeachCourse::getClassWeekCourse($term,$class_id);
        $allTeach=TeachManage::find()->where(['year_id'=>$term,'class_id'=>$class_id])->indexby('subject')->all();
        return $this->render('bcourse',[
            'model' => $model,
            'department' => $department,
            'departments'=> $departments,
            'allTerm'=> $allTerm,
            'term'   => $term,
            'allDaytime'=> TeachDaytime::getDepartmentDaytime($department),
            'classes' => $classes,
            'class_id'=> $class_id,
            'weekCourse'=>$weekCourse,
            'allTeach'=>$allTeach
        ]);
    }

    public function actionAvatar()
    {
        $post = Yii::$app->request->post();
        return json_encode($post);
    }

    public function actionGetteacher($subject)
    {
        $teachers =  UserTeacher::getSubjectTeacherArray($subject);
        return json_encode($teachers);
    }

    public function actionGetclass($department)
    {
        return json_encode(TeachClass::getClassArray($department));
    }

}
