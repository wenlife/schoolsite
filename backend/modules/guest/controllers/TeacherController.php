<?php
namespace backend\modules\guest\controllers;

use Yii;
use backend\modules\guest\models\UserTeacher;
use backend\modules\guest\models\UserTeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\guest\forms\teacherUpload;
use ciniran\excel\ReadExcel;
use yii\web\UploadedFile;
use backend\libary\CommonFunction;

/**
 * TeacherController implements the CRUD actions for UserTeacher model.
 */
class TeacherController extends Controller
{
    //public $layout = '/center'; 
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserTeacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserTeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserTeacher model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserTeacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserTeacher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionImport()
    {
       
       $form = new teacherUpload();
       
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
                $subjects = CommonFunction::getAllSubjects();
                $subjects = array_flip($subjects);
                //var_export($subjects);
                //exit();
                foreach ($data as $key1 => $tm) {
                    $model = new UserTeacher();
                    $model->name = $tm['xm'];
                    $model->pinx = $tm['pinx'];

                    $model->subject = $subjects[$tm['km']];
                    $model->type = 'js';
                    $model->gender = $tm['xb'];
                    $model->school = "市七中";
                    if(!$model->save())
                    {
                        $errMSG[] = $key1.'行导入失败！';
                    }

                }
                if(!is_null($errMSG))
                {
                    $this->redirect['/index'];
                }else{
                    var_export($errMSG);
                }


            }
        }else{
            return $this->render('import',['model'=>$form]);
        }
    }

    /**
     * Updates an existing UserTeacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionSetlogin($id)
    {
       $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            if (!$model->secode) {
                 $model->secode = rand(1000,9999);
            }
             
            return $this->render('setlogin', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserTeacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserTeacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTeacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTeacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
