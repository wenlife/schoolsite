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
//use backend\modules\school\forms\Teach;
use backend\modules\school\forms\Tm_form;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachDepartment;
use backend\modules\school\models\TeachmanageSearch;
use backend\modules\guest\models\UserTeacher;

/**
 * TeachmanageController implements the CRUD actions for TeachManage model.
 */
class TeachmanageController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeachManage models.
     * @return mixed
     */
    public function actionIndex($term=null,$department=null)
    {
        $cuSubject = key(CommonFunction::getAllSubjects());
        $teachers = UserTeacher::getSubjectTeacherArray($cuSubject);
        $allTerm = TeachYearManage::getYearArray();
        $term = $term?$term:key($allTerm);
        $allDepartment = TeachDepartment::getDepartmentArray();
        $department = $department?$department:key($allDepartment);
        $curDepartment = TeachDepartment::findOne($department);
        //展示当前级部的设置
        $allClass = TeachClass::find()->where(['department_id'=>$department,'grade'=>$curDepartment->year])->indexby('id')->all();

        $classes = (new \yii\db\Query())->select(['id'])->from('teach_class')
                                        ->where(['department_id'=>$department]);
        $allTeach = TeachManage::find()->where(['year_id'=>$term,'class_id'=>$classes])
                                       ->indexby(function($row){
                                                  return $row['class_id'].'-'.$row['subject'];
                                                })->with('teacher')->all();
        return $this->render('index', [
            'department'=>$department,
            'teachers'=>$teachers,
            'allTerm'=>$allTerm,
            'term' =>$term,
            'allDepartment'=>$allDepartment,
            'department'=>$department,
            'allClass'=>$allClass,
            'allTeach'=>$allTeach
        ]);
    }


    public function actionSetmanage()
    {
      $request = Yii::$app->request;
      if($request->isPost){
          $term    = $request->post('term');//ArrayHelper::getValue($post,'term');
          $banji   = $request->post('banji');//ArrayHelper::getValue($post,'banji');
          $subject = $request->post('subject');//ArrayHelper::getValue($post,'subject');
          $teacher = $request->post('teacher');//ArrayHelper::getValue($post,'teacher');
          if($term&&$banji&&$subject&&$teacher)
          {
              $model = new TeachManage();
              $t1 = TeachManage::find()->where(['year_id'=>$term,'class_id'=>$banji,'subject'=>$subject])->one();
              if($t1)
                $model = $t1;  
                $model->year_id = $term;
                $model->class_id = $banji;
                $model->subject = $subject;
                $model->teacher_id = $teacher;
              if($model->save())
              {
                return 'success';
              }else{
                return 'saveError';
              }
          }
          //return var_export($post);
          return 'paramGetError';
      }else{
        return 'getError';
      }
      return 'unknownError';
    }
    /**
     * Displays a single TeachManage model.
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

    public function actionGetteachers($subject)
    {
        $teachers = UserTeacher::getSubjectTeacherArray($subject);
        return json_encode($teachers);
    }

    /**
     * Creates a new TeachManage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new TeachManage();

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
        // var_export((new UserTeacher())->getAllTeacherIndexbyName());
        // exit();
        if($form->load(Yii::$app->request->post()))
        {
            $errMSG = array();
            //$form->load($post);
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if ($url = $form->upload()) {
                $excel = new ReadExcel(['path' => $url,'head' => true,'headLine' => 1,]);
                $data = $excel->getArray();
                //需要对导入的表格进行基本的验证,并添加强制导入的选项
                if(count(current($data))!=16&&$flag==0)
                {
                      $errMSG[] = '您选择的表格似乎不是任教的表格，请确认后再导入！';
                      return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
                }
                // 查找班级列表,注意获取的不同，暂时不做修改
                 $depart_year = (new TeachDepartment())->getDepartmentYear($form->department);
                 $class_list = (new \yii\db\Query())->select(['serial','id'])->from('teach_class')
                                ->where(['grade'=>$depart_year])->indexby('id')->orderby('serial')->column();
                //$class_list = (new TeachClass())->getClassArray($form->department);
                //转换教师数据，科目也会被转换为系统值
                $data = UserTeacher::translateNametoId($data);
                $insertData = array();
                //合并错误信息
                if($err = ArrayHelper::getValue($data,'error'))
                     $errMSG =  array_merge($errMSG,$err);
                //循环导入任教信息
                $subarr = CommonFunction::getAllTeachDuty();
                //修改：删除所有内容再导入
                TeachManage::deleteDepartmentTeach($form->year,$form->department);

                foreach ($class_list as $class_id => $class_serial){
                   $teach_man = ArrayHelper::getValue($data,$class_serial);
                   foreach ($teach_man as $sub_en => $teacher_id) { 
                    
                      array_push($insertData,['year_id'=>$form->year,'class_id'=>$class_id,
                                                   'teacher_id'=>$teacher_id,'subject'=>$sub_en]);
                   }
                }
                if(count($insertData)>0)
                {
                  Yii::$app->db->createCommand()
                          ->batchInsert('teach_manage',['year_id','class_id','teacher_id','subject'],$insertData)
                          ->execute();
                   // var_export($insertData);
                  //  exit();
                }
              unlink($url);
            }    
            if(count($errMSG)>0)
            {
                return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
            }else{
                return $this->redirect(['index']);
            }  
        }
        return $this->render('import',['model'=>$form,'errMSG'=>null]);
    }


    public function actionAdd($subject,$term,$banji)
    {
        if(Yii::$app->request->post())
        {
            $post = yii::$app->request->post();
            //var_export($post);
            $model = TeachManage::find()->where(['class_id'=>$banji,'year_id'=>$term,'subject'=>$subject])->one();
            if(!$model)
            {
                $model = new TeachManage();
            }
            $model->subject = $subject;
            $model->year_id = $term;
            $model->class_id = $banji;
            $model->teacher_id = ArrayHelper::getValue($post,'teacherid');
            $model->save();
            return $this->redirect(['index']);
        }
        $subjectTeacher = UserTeacher::getSubjectTeacherArray($subject);

        return $this->render('add',['subjectteacher'=>$subjectTeacher,'term'=>$term,'banji'=>$banji]);
    }

    /**
     * Updates an existing TeachManage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing TeachManage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($term,$department)
    {
        if(is_numeric($term)&&is_numeric($department))
        {
            // $grade = (new TeachDepartment())->getDepartmentYear($department);
            // $classArr = (new \yii\db\Query())->select(['id'])->from('teach_class')->where(['grade'=>$grade])->indexby('id');
            // TeachManage::deleteAll(['year_id'=>$term,'class_id'=>$classArr]);
            TeachManage::deleteDepartmentTeach($term,$department);
        }
        return $this->redirect(['index','term'=>$term,'department'=>$department]);
    }

    /**
     * Finds the TeachManage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeachManage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeachManage::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
