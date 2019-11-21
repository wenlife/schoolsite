<?php
namespace backend\modules\school\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;
use backend\modules\school\forms\Teach;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachmanageSearch;
use backend\modules\guest\models\UserTeacher;
use ciniran\excel\ReadExcel;
use backend\modules\school\forms\Tm_form;
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeachManage models.
     * @return mixed
     */
    public function actionIndex($yearpost=null,$department=null)
    {
        $post = Yii::$app->request->post();

        $cuSubject = key(CommonFunction::getAllSubjects());

        $teachers = (new \yii\db\Query())->select(['name','id'])->from('user_teacher')->where(['subject'=>$cuSubject])->indexby('id')->column();

        return $this->render('index', [
            //'var' =>$post,
            'yearpost'=>$yearpost,
            'department'=>$department,
            'teachers'=>$teachers
        ]);
    }


    public function actionSetmanage()
    {
      $post = Yii::$app->request->post();
      if($post){
          $term    = ArrayHelper::getValue($post,'term');
          $banji   = ArrayHelper::getValue($post,'banji');
          $subject = ArrayHelper::getValue($post,'subject');
          $teacher = ArrayHelper::getValue($post,'teacher');
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
        $teachers = (new \yii\db\Query())->select(['name','id'])->from('user_teacher')->where(['subject'=>$subject])->indexby('id')->column();
        return json_encode($teachers);
    }

    /**
     * Creates a new TeachManage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeachManage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionImport()
    {       
        $form = new Tm_form();  
        if($post=Yii::$app->request->post())
        {
            $errMSG = array();
            $form->load($post);
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if ($url = $form->upload()) {
                $excel = new ReadExcel([
                    'path' => $url,
                    'head' => true,
                    'headLine' => 1,
                ]);
                $data = $excel->getArray();
                // 查找班级列表
                $depart_year = (new \yii\db\Query())->select(['year'])->from('teach_department')->where(['id'=>$form->department])->scalar();
                $class_list = (new \yii\db\Query())->select(['serial','id'])->from('teach_class')
                               ->where(['grade'=>$depart_year])->indexby('id')->orderby('serial')->column();
                //查找该科目的老师，并组成任教数据:外层循环：学科，内层循环：班级
                $subarr = CommonFunction::getAllTeachDuty();
                foreach ($subarr as $sub_en_name => $sub_cn_name) {
                    $sub_teach_duty = ArrayHelper::getColumn($data,$sub_cn_name);
                    //var_export($sub_teach_duty);
                    foreach ($class_list as $class_id => $class_serial) {

                        $sub_teacher_name = trim(ArrayHelper::getValue($sub_teach_duty,$class_serial-1));
                        //$sub_teacher_name = $sub_teach_duty[$class_serial-1];
                        if($sub_teacher_name)//找不到名字也不做任何操作
                        {
                            //$teacher = array();
                            if($sub_en_name =='bzr')
                            {
                                $teacher = UserTeacher::find()->where(['name'=>$sub_teacher_name])->all();
                            }else{
                                $teacher = UserTeacher::find()->where(['subject'=>$sub_en_name,'name'=>$sub_teacher_name])->all();
                            }
                            if(count($teacher)>1||count($teacher)<1)
                            {
                                //如果有同名或者无名教师，则跳过
                                $errMSG[] = "教师姓名<".$sub_teacher_name.">在设置<".$class_serial.">班的学科<".$sub_cn_name.">时找到".count($teacher)."个人，跳过本步骤";
                                continue;
                            }else{
                                //可以重复导入
                                $model = TeachManage::find()->where(['year_id'=>$form->year,
                                                                     'class_id'=>$class_id,
                                                                     //'teacher_id' =>$teacher[0]->id,
                                                                     'subject'=>$sub_en_name
                                                                 ])->one();
                                if(!$model)
                                {
                                    $model = new TeachManage();
                                }
                                $model->year_id = $form->year;
                                $model->class_id = $class_id;
                                $model->teacher_id = $teacher[0]->id;
                                $model->subject  = $sub_en_name;
                                if(!$model->save())
                                { 
                                    $errMSG[] = "<".$class_serial."班的任教学科<".$sub_cn_name.">保存失败！";
                                }
                            }
                        }else{
                            //$errMSG[] = $class_serial."班的".$sub_cn_name."老师的名字<".$sub_teacher_name."在表中没有设置！";
                        }
                    }
                }
            }
            if(count($errMSG)>0)
            {
                return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
            }else{
                return $this->redirect(['index']);
            }
        
        }


        // $path = 'user.xlsx';
        // $excel = new ReadExcel([
        //     'path' => $path,
        //     'head' => true,
        //     'headLine' => 1,
        // ]);
        // $data = $excel->getArray();
        // //var_export($data);
        return $this->render('import',['model'=>$form,'errMSG'=>null]);
    }


    public function actionAdd($subject,$term,$banji)
    {
        if(yii::$app->request->post())
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
        $subjectTeacher = (new \yii\db\Query())
                      ->select(['name','id'])
                      ->from('user_teacher')
                      ->where(['subject'=>$subject])
                      ->indexby('id')
                      ->orderby('pinx')
                      ->column();
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeachManage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
