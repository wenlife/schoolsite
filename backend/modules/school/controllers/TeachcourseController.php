<?php
namespace backend\modules\school\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use ciniran\excel\ReadExcel;
use backend\libary\CommonFunction;
use backend\modules\school\forms\Tm_form;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachDaytime;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachCourseLimit;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachDepartment;
use backend\modules\guest\models\UserTeacher;
use backend\modules\school\models\TeachcourseSearch;
/**
 * TeachcourseController implements the CRUD actions for TeachCourse model.
 */
class TeachcourseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                // 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all TeachCourse models.
     * @return mixed
     */
    public function actionIndex($term=null,$department=null,$banji=null,$teacher_id=null,$subject=null)
    {
        //准备参数
        $courseArr = $tcourseArr = array();
        $name = null;
        $allTerm = TeachYearManage::getYearArray();
        $term = $term?$term:key($allTerm);
        $departments = TeachDepartment::getDepartmentArray();
        $department = $department?$department:key($departments);
        $allClass = TeachClass::getClassArray($department);
        $banji = $banji?$banji:key($allClass);
        $allDaytime = TeachDaytime::getDepartmentDaytime($department);
        //获取班级课表数据
        $courseArr = TeachCourse::getClassWeekCourse($term,$banji);

        if($teacher_id!=null&&$subject!=null&&$term!=null)
        {
           //$teacher = TeachManage::findOne(['teacher_id'=>$teacher_id]);
           $name    = UserTeacher::findOne($teacher_id)->name; 
           $tcourseArr = TeachCourse::getTeacherWeekCourse($term,$subject,$teacher_id); 
        }

        $courseCount = TeachCourse::find()
                        ->select(["count('id') as num",'subject_id'])
                        ->where(['year_id'=>$term,'class_id'=>$banji])
                        ->indexby('subject_id')
                        ->groupby('subject_id')->column();
        $courseLimit = TeachCourseLimit::find()
                        ->select(['course_limit','course_id'])
                        ->where(['department_id'=>$department])
                        ->indexby('course_id')
                        ->column();

        return $this->render('index', [
            'allTerm'=>$allTerm,
            'term'=>$term,
            'departments'=>$departments,
            'department'=>$department,
            'allClass'=>$allClass,
            'banji'=>$banji,
            'courseArr'=>$courseArr,
            'tcourseArr'=>$tcourseArr,
            'teacherName'=>$name,//=========
            'subject'=>$subject,
            'allDaytime'=>$allDaytime,
            'courseCount'=>$courseCount,
            'courseLimit'=>$courseLimit
        ]);
    }

    //负责返回顶部自动生成的选择框
    public function actionGetclass($department)
    {
        return json_encode(TeachClass::getClassArray($department));
    }

    public function actionSetcourse()
    {
        $post    = Yii::$app->request->post();
        $year    = ArrayHelper::getValue($post,'year');
        $banji   = ArrayHelper::getValue($post,'banji');
        $weekday = ArrayHelper::getValue($post,'weekday');
        $daytime = ArrayHelper::getValue($post,'daytime');
        $subject = ArrayHelper::getValue($post,'subject');

        if($year&&$banji&&$weekday&&$daytime)
        {
            $model = TeachCourse::findOne(['year_id'=>$year,'class_id' => $banji,'weekday' => $weekday,
                                                 'day_time_id' => $daytime,]);
            if(!$model){
              $model = new TeachCourse();
              $model->year_id = $year;
              $model->class_id = $banji;
              $model->weekday = $weekday;
              $model->day_time_id = $daytime;
            }
            $model->subject_id = $subject;
            if($model->save())
            {
                //返回当前任课教师的课程表
                $teacherMSG =  TeachManage::find()->where(['class_id'=>$banji,'subject'=>$subject])->one();
                if($teacherMSG){
                    $teacher_id = $teacherMSG->teacher_id;
                }else{
                    $teacher_id = "";
                }
                return  json_encode(['teacher_id'=>$teacher_id,'term'=>$year,'subject'=>$subject]);           //
            }else{
                //return 'SaveError';
                return var_export($model);
            } 
        }else{
            return 'SaveError';
           //return 'EmptyValue!';
        }
    }

    /**
     * Displays a single TeachCourse model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    // /**
    //  * Creates a new TeachCourse model.
    //  * If creation is successful, the browser will be redirected to the 'view' page.
    //  * @return mixed
    //  */
    // public function actionCreate()
    // {
    //     $model = new TeachCourse();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }


    public function actionImport($flag=0)
    {
        $form = new Tm_form();
        $errMSG = array();
        if($post=Yii::$app->request->post())
        {
            $errMSG = array();
            $form->load($post);

            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if($url = $form->upload()) {
                $excel = new ReadExcel(['path' => $url,'head' => true,'headLine' =>2,]);
                $data = $excel->getArray();
                //需要对导入的表格进行基本的验证,并添加强制导入的选项
                if(count(current($data))!=53&&$flag==0)
                { 
                    $errMSG[] = '您选择的表格似乎不是课程安排的表格，请确认后再导入！';
                    return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
                }
                // 查找班级列表
                $class_list = TeachClass::getClassSerialArray($form->department);
                $daytime_list = TeachDaytime::getDepartmentDaytime($form->department);
                //执行数据转换
                $data = CommonFunction::translateSubjects($data);
                $weekday = CommonFunction::getWeekday();
                //var_export($data);
                //exit();
                //更改逻辑： 全部删除，重新导入
                $val = TeachCourse::deleteDepartmentCourse($form->year,$form->department);
                //带记忆的搜索数组；
                $teacherArray = array();//缓存teacherID
                $searchArray = array();//缓存任教课表设置
                foreach ($weekday as $weekday_id => $weekday_title) {
                  foreach ($daytime_list as $daytime_id => $daytime_model) {
                    $daytime_serial = $daytime_model->sort;
                    // if($daytime_serial == 0)
                    //     continue;
                    $val = ''.($weekday_id+$daytime_serial/100).''; //组装出标题
                    $daytime_id_all_class_course = ArrayHelper::getColumn($data,$val);//获取列数据
                    //分班级进行存储
                     foreach ($class_list as $class_id => $class_serial) {
                        //$class_serial-1 = data[0];找到班级对应的课程安排
                        $sub = ArrayHelper::getValue($daytime_id_all_class_course,$class_serial-1);
                        if(!$sub)//跳过空课程
                            continue;
                        $model = new TeachCourse();
                        $model->year_id = $form->year;
                        $model->class_id = $class_id;
                        $model->weekday = $weekday_id."";
                        $model->day_time_id = $daytime_model->id;
                        $model->subject_id = $sub;
                        //var_export($model);
                        //
                        if($model->save())
                        {
                            //验证是否有重复的课程
                            //跳过活动课;
                            if($sub == 'hd')continue; 
                            //校验是否有同时上两个班的老师，可以存储，必须提示标红，使用记忆化搜索
                            $teacher_id = ArrayHelper::getValue($teacherArray,$class_id.'.'.$sub);
                            if(!$teacher_id)
                            {
                                $teacher_id = (new \yii\db\Query())
                                ->select(['teacher_id'])
                                ->from('teach_manage')
                                ->where(['class_id'=>$class_id,'year_id'=>$form->year,'subject'=>$sub])
                                ->scalar();
                                $teacherArray[$class_id][$sub] = $teacher_id;
                            }
                            
                            if($teacher_id)
                            {
                                $searchString = $weekday_id.'.'.$daytime_model->id.'.'.$teacher_id;
                                $ifset = ArrayHelper::getValue($searchArray,$searchString);
                                 if($ifset){
                                    $errMSG[] = "<p class='text-danger'><".$weekday_title.'><'.$class_serial."班><第".$daytime_serial."节>的教师出现同一时间的重复课程！</p>";
                                 }else{
                                    $searchArray[$weekday_id][$daytime_model->id][$teacher_id] = true;
                                 }
                            }
                            
                        }else{
                            $errMSG[] = $weekday_title.'<'.$class_serial."班>,<第".$daytime_serial."节>导入数据出现错误：".serialize($model->getErrors());
                        }
                    }
                  }
                }


        }
        //var_export($searchArray);
        //exit();
            if(count($errMSG)>0)
            {
                return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
            }else{
                return $this->redirect(['index']);
            }
        }
        return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
    }


    /**
     * Updates an existing TeachCourse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing TeachCourse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($year,$department)
    {
        if(is_numeric($year)&&is_numeric($department))
        {
            TeachCourse::deleteDepartmentCourse($year,$department);   
        }       

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeachCourse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeachCourse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeachCourse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
