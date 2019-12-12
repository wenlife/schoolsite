<?php
namespace backend\controllers;
use Yii;
use common\models\BackendLoginForm;
use yii\web\NotFoundHttpException;
use backend\modules\guest\models\UserTeacher;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachDaytime;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachDepartment;

class TcenterController extends \yii\web\Controller
{
	public $layout="tcenter";

    public function actionIndex($term=null,$subject='yw',$teacher_id=null)
    {

        $model     = new BackendLoginForm();
        $courseArr = array();
        $allTerm = (new TeachYearManage())->getYearArray();
        $term = $term?$term:key($allTerm);
        // if(!$term)
        // $term = (new \yii\db\Query())->select(['id'])->from('teach_year_manage')->orderby('start_date desc')->indexby('id')->scalar();

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
        
        if($teacher_id&&$subject&&$term)
        {
            $allTClass = (new \yii\db\Query())->select(['class_id'])->from('teach_manage')->where(['teacher_id'=>$teacher_id]);
            $allCourse = TeachCourse::find()->where(['year_id'=>$term,'subject_id'=>$subject])->andWhere(['class_id'=>$allTClass])->all();
	        
	        foreach ($allCourse as $key => $course) {

	            if(isset($courseArr[$course->weekday][$course->day_time_id]))
	            {
                    //显示同一时间被设置的重复课程
	                $courseArr[$course->weekday][$course->day_time_id] = $courseArr[$course->weekday][$course->day_time_id].'/'.$course->banji->title;
	            }else{
	                $courseArr[$course->weekday][$course->day_time_id] = $course->banji;
	            }
	            
	        }
        }

        return $this->render('index',
        	[
        		'model'=>$model,
        		'courseArr'=>$courseArr,
        		'teacher_id'=>$teacher_id,
        		'subject'=>$subject,
                'allTerm'=>$allTerm,
                'term'=>$term,
                'allDaytime'=> TeachDaytime::find()->orderby('sort')->indexby('sort')->all(),
                'teachers'=>(new UserTeacher())->getSubjectTeacherArray($subject),
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
        $departments = (new TeachDepartment())->getDepartmentArray();
        $department  = $department?$department:key($departments);
        //班级信息
        $classes     = (new TeachClass())->getClassArray($department);
        $class_id    =  $class_id?$class_id:key($classes);
        //学年信息
        $allTerm     = (new TeachYearManage())->getYearArray();
        $term   =   $term?$term:key($allTerm);
        //任教和课程
        $weekCourse = (new TeachCourse())->getWeekCourse($term,$class_id);
        $allTeach=TeachManage::find()->where(['year_id'=>$term,'class_id'=>$class_id])->indexby('subject')->all();
        return $this->render('bcourse',[
            'model' => $model,
            'department' => $department,
            'departments'=> $departments,
            'allTerm'=> $allTerm,
            'term'   => $term,
            'allDaytime'=> TeachDaytime::find()->orderby('sort')->indexby('sort')->all(),
            'classes' => $classes,
            'class_id'=> $class_id,
            'weekCourse'=>$weekCourse,
            'allTeach'=>$allTeach
        ]);
    }

    public function actionGetteacher($subject)
    {
        $teachers =  (new UserTeacher())->getSubjectTeacherArray($subject);
        return json_encode($teachers);
    }

    public function actionGetclass($department)
    {
        return json_encode((new TeachClass())->getClassArray($department));
    }

}
