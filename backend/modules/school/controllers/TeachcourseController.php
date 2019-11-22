<?php

namespace backend\modules\school\controllers;

use Yii;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachManage;
use backend\modules\guest\models\UserTeacher;
use backend\modules\school\models\TeachcourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\modules\school\forms\Tm_form;
use ciniran\excel\ReadExcel;
use backend\libary\CommonFunction;

/**
 * TeachcourseController implements the CRUD actions for TeachCourse model.
 */
class TeachcourseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeachCourse models.
     * @return mixed
     */
    public function actionIndex($yearpost=null,$department=null,$banji=null,$teacher=null,$subject=null)
    {
        $courseArr = array();
        $name = null;
        if($teacher!=null&&$subject!=null&&$yearpost!=null)
        {
            $teacher_id =  $teacher;
            $teacher = TeachManage::find()->where(['teacher_id'=>$teacher_id])->one();

            $name = UserTeacher::find()->where(['id'=>$teacher_id])->one()->name;
            
            $allTeachClass = TeachManage::find()->select(['class_id','id'])->where(['teacher_id'=>$teacher_id])->indexby('class_id')->column();
            $allCourse = TeachCourse::find()->select(['id','class_id','weekday','day_time_id'])->where(['year_id'=>$yearpost,'subject_id'=>$subject])->andWhere(['in','class_id',$allTeachClass])->all();
            
            foreach ($allCourse as $key => $course) {

                if(isset($courseArr[$course->weekday][$course->day_time_id]))
                {
                    $courseArr[$course->weekday][$course->day_time_id] = $courseArr[$course->weekday][$course->day_time_id].'/'.$course->banji->title;
                }else{
                    $courseArr[$course->weekday][$course->day_time_id] = $course->banji->title;
                }
                
            }
        }
        //$post = Yii::$app->request->post();
        //var_export($post);
        return $this->render('index', [
            'var' =>['yearpost'=>$yearpost,'department'=>$department,'banji'=>$banji],
            'courseArr'=>$courseArr,
            'teacherName'=>$name,
            'subject'=>$subject
        ]);
    }

    //负责返回顶部自动生成的选择框
    public function actionGetclass($department)
    {
        //$class = (new \yii\db\Query())->select(['title','id'])->from('teach_class')->indexby('id')->column();
        return json_encode((new \yii\db\Query())->select(['title','id'])->from('teach_class')->where(['department_id'=>$department])->indexby('id')->orderby('serial')->column());
       //return  Html::dropDownList('banji',null,$class,['class'=>'form-control']);
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
            $model = TeachCourse::find()->where(['year_id'=>$year,'class_id' => $banji,'weekday' => $weekday,
                                                 'day_time_id' => $daytime,])->one();
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
                // $allTeachClass = TeachManage::find()->select(['class_id','id'])->where(['teacher_id'=>$teacher_id])->indexby('class_id')->column();
                // $allCourse = TeachCourse::find()->select(['id','class_id','weekday','day_time_id'])->where(['year_id'=>$year,'subject_id'=>$subject])->andWhere(['in','class_id',$allTeachClass])->all();
                // $courseArr = array();
                // foreach ($allCourse as $key => $course) {
                //     $courseArr[$course->weekday][$course->day_time_id] = $course->banji->title;
                // }
                if($teacherMSG){
                    $teacher_id = $teacherMSG->teacher_id;
                }else{
                    $teacher_id = "";
                }

                return  json_encode(['teacher_id'=>$teacher_id,'yearpost'=>$year,'subject'=>$subject]);           //$teacher_id;
                //return 'success';
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TeachCourse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeachCourse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionImport()
    {
        $model1 = new TeachCourse();
        //验证不能使用ar
        $form = new Tm_form();
        $errMSG = null;
        if($post=Yii::$app->request->post())
        {
            $errMSG = array();
            $form->load($post);
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if ($url = $form->upload()) {
                $excel = new ReadExcel([
                    'path' => $url,
                    'head' => true,
                    'headLine' =>2,
                ]);
                $data = $excel->getArray();
                // 查找班级列表
                $depart_year = (new \yii\db\Query())->select(['year'])->from('teach_department')->where(['id'=>$form->department])->scalar();
                $class_list = (new \yii\db\Query())->select(['serial','id'])->from('teach_class')
                               ->where(['grade'=>$depart_year])->indexby('id')->orderby('serial')->column();
                $daytime_list = (new \yii\db\Query())->select(['sort','id'])->from('teach_daytime')->indexby('id')->orderby('sort')->column();
            }

            $weekday = CommonFunction::getWeekday();
            $i = 0;
            
            //$query1 = TeachCourse::find()->where(['year_id'=>$form->year])->all();
            //var_export($query1);
            //exit();

            foreach ($weekday as $weekday_id => $weekday_title) {
                foreach ($daytime_list as $daytime_id => $daytime_serial) {
                    if($daytime_serial == 0)
                        continue;
                    $val = ''.($weekday_id+$daytime_serial/100).''; //组装出标题
                    //echo "(".$val.")";
                    $daytime_id_all_class_course = ArrayHelper::getColumn($data,$val);
                    $query1 = TeachCourse::find()->where(['year_id'=>$form->year,'weekday'=>$weekday_id,'day_time_id'=>$daytime_id])->all();
                    //var_export($daytime_id_all_class_course);
                    foreach ($class_list as $class_id => $class_serial) {
                        //录入数据，查找是否有该课程数据
                        $model = clone $model1;
                        //搜索耗时过高！！！！！！！！！！！！！！！！

                        foreach ($query1 as $q1 => $v1) {
                            if(($v1->class_id == $class_id)&&($v1->weekday == $weekday_id)&&($v1->day_time_id==$daytime_id)){
                                $model = $v1; 
                                break;    
                            }
                             $i++;
                        } 

                        $subArr = array_flip(CommonFunction::getAllSubjects());
                        $sub1 = ArrayHelper::getValue($daytime_id_all_class_course,$class_serial);
                        // if(!$sub1)
                        // {
                        //     $errMSG[] = $weekday_title.$class_serial."班，第".$daytime_serial."节导入数据无法从数据表中找到！";
                        // }

                        $sub = ArrayHelper::getValue($subArr,$sub1);
                        if(!$sub)
                        {
                             $errMSG[] = $weekday_title.$class_serial."班，第".$daytime_serial."节的课程".$sub1."名字无法被转换为系统名字！";
                             continue;//科目无法转换，跳过
                        }
                        if($model->subject_id == $sub)
                            continue;//已经存在，跳过
                        $model->year_id = $form->year;
                        $model->class_id = $class_id;
                        $model->weekday = $weekday_id."";
                        $model->day_time_id = $daytime_id;
                        $model->subject_id = $sub;
                        //var_export($model);
                        if($model->save())
                        { 

                            //校验是否有同时上两个班的老师，可以存储，必须提示标红
                            $teacher_id = (new \yii\db\Query())->select(['teacher_id'])->from('teach_manage')->where([
                                'class_id'=>$class_id,'year_id'=>$form->year,'subject'=>$sub])->indexby('teacher_id')->scalar();
                            //echo $teacher_id;


                            $classArr = (new \yii\db\Query())->select(['class_id'])->from('teach_manage')
                                    ->where(['year_id'=>$form->year,'teacher_id'=>$teacher_id,'subject'=>$sub])
                                    ->indexby('class_id')->column();
                            //var_export($classArr);

                            $single_teach_course = (new \yii\db\Query())->select(['class_id'])->from('teach_course')
                                    ->where([
                                        'year_id'=>$form->year,
                                        'weekday'=>$weekday_id,
                                        'day_time_id'=>$daytime_id,
                                        'subject_id'=>$sub
                                     ])->andWhere(['in','class_id',$classArr])->count();
                            //echo $weekday_id.'-'.$daytime_id;
                            //var_export($single_teach_course);
                            //exit();
                            if($single_teach_course>1)
                                $errMSG[] = "<p class='text-danger'>".$weekday_title.$class_serial."班，第".$daytime_serial."节的教师出现同一时间的重复课程！</p>";
                            
                        }else{
                            $errMSG[] = $weekday_title.$class_serial."班，第".$daytime_serial."节导入数据出现错误：".serialize($model->getErrors());
                        }
                    }
                }
            }
            //unset($query1);
            //echo "运行查询了".$i."次";
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

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
            $grade = (new \yii\db\Query())->select(['year'])->from('teach_department')->where(['id'=>$department])->indexby('year')->scalar();
            $classArr = (new \yii\db\Query())->select(['id'])->from('teach_class')->where(['grade'=>$grade])->indexby('id')->column();
            $models = TeachCourse::find()->where(['year_id'=>$year])->andWhere(['in','class_id',$classArr])->all();
            foreach ($models as $model) {
              $model->delete();
            }
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
