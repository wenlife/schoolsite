<?php
namespace backend\controllers;
use Yii;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachManage;
use backend\modules\guest\models\UserTeacher;
use common\models\BackendLoginForm;

class TcenterController extends \yii\web\Controller
{
	public $layout="tcenter";
	public function actions()
	{
	    return [
	        'crop'=>[
	            'class' => 'hyii2\avatar\CropAction',
	            'config'=>[
	                'bigImageWidth' => '200',     //大图默认宽度
	                'bigImageHeight' => '200',    //大图默认高度
	                'middleImageWidth'=> '100',   //中图默认宽度
	                'middleImageHeight'=> '100',  //中图图默认高度
	                'smallImageWidth' => '50',    //小图默认宽度
	                'smallImageHeight' => '50',   //小图默认高度
	                //头像上传目录（注：目录前不能加"/"）
	                'uploadPath' => 'uploads/avatar',
	            ]
	        ]
	    ]; 
	}
    public function actionIndex($year=null,$subject='yw',$teacher_id=null)
    {
        //$post = Yii::$app->request->post();
        $model = new BackendLoginForm();
        $courseArr = array();

        if(!Yii::$app->user->isGuest)
        {
        	$teacher = UserTeacher::find()->where(['username'=>Yii::$app->user->identity->username])->one();
            if(!$teacher)
            {
                exit('当前教师并没有在数据库中设置自己的用户名啊！');
            }
        	$subject = $teacher->subject;
        	$teacher_id = $teacher->id;
        }

        if($year==null)
            $year = (new \yii\db\Query())->select(['id'])->from('teach_year_manage')->indexby('id')->scalar();
        //echo $year;
        //exit();

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
	                $courseArr[$course->weekday][$course->day_time_id] = $course->banji->title;
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

}
