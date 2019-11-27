<?php
namespace backend\controllers;
use Yii;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachClass;
use backend\modules\guest\models\UserTeacher;
use common\models\BackendLoginForm;

class TcenterController extends \yii\web\Controller
{
	public $layout="tcenter";



    public function actionIndex($year=null,$subject=null,$teacher_id=null)
    {
        //$post = Yii::$app->request->post();
        $model     = new BackendLoginForm();
        $courseArr = array();
        if($teacher_id==null)
        {
            if(!Yii::$app->user->isGuest)
            {
                $teacher = UserTeacher::find()->where(['username'=>Yii::$app->user->identity->username])->one();
                if(!$teacher)
                {
                    exit('当前教师'.Yii::$app->user->identity->username.'并没有在数据库中设置自己的用户名啊！');
                }
                $subject = $teacher->subject;
                $teacher_id = $teacher->id;
            }else{
                $subject = 'yw';
            }

        }else{
            $teacher = UserTeacher::findOne($teacher_id);
            $subject = $teacher->subject;
            $teacher_id = $teacher->id;
        }
        

        if($year==null)
            $year = (new \yii\db\Query())->select(['id'])->from('teach_year_manage')->orderby('start_date desc')->indexby('id')->scalar();

        if($teacher_id!=null&&$subject!=null&&$year!=null)
        {
            //$teacher = TeachManage::find()->where(['teacher_id'=>$teacher_id])->one();

	        //$name = UserTeacher::find()->where(['id'=>$teacher])->one()->name;
	            
	        $allTeachClass = TeachManage::find()->select(['class_id','id'])->where(['teacher_id'=>$teacher_id])->indexby('class_id')->column();
	        $allCourse = TeachCourse::find()->select(['id','class_id','weekday','day_time_id'])->where(['year_id'=>$year,'subject_id'=>$subject])->andWhere(['in','class_id',$allTeachClass])->all();
	        
	        foreach ($allCourse as $key => $course) {

	            if(isset($courseArr[$course->weekday][$course->day_time_id]))
	            {
	                $courseArr[$course->weekday][$course->day_time_id] = $courseArr[$course->weekday][$course->day_time_id].'/'.$course->banji->title;
	            }else{
	                $courseArr[$course->weekday][$course->day_time_id] = $course->banji;
	            }
	            
	        }
        }

        return $this->render('index',
        	[
        		'year'=>$year,
        		'model'=>$model,
        		'courseArr'=>$courseArr,
        		'teacher_id'=>$teacher_id,
        		'subject'=>$subject,
        		'teachers'=>(new \yii\db\Query())->select(['name','id'])->from('user_teacher')
    	               ->where(['subject'=>$subject])->indexby('id')->orderby('pinx')->column(),
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

    public function actionGetteacher($subject)
    {
    	$teachers =  (new \yii\db\Query())->select(['name','id'])->from('user_teacher')
    	               ->where(['subject'=>$subject])->indexby('id')->orderby('pinx')->column();
    	return json_encode($teachers);
    }

    public function actionCal()
    {
    	//$this->layout = false;
    	return $this->render('cal');
    }

    public function actionBcourse($year=null,$class_id=null,$department=null)
    {
        $model = new BackendLoginForm();
        if($class_id!=null)
        {
            $department = TeachClass::findOne($class_id)->department_id;
        }
        return $this->render('bcourse',[
            'model'=>$model,
            'year'=>$year,
            'department'=>$department,
            'class_id'=>$class_id,
        ]);
    }

    public function actionGetclass($department)
    {
        return json_encode((new \yii\db\Query())->select(['title','id'])->from('teach_class')->where(['department_id'=>$department])->indexby('id')->column());
    }

}
