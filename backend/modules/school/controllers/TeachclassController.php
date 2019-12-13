<?php
namespace backend\modules\school\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\school\forms\ClassGenerate;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachClassSearch;
use backend\modules\school\models\teachDepartment;
/**
 * TeachclassController implements the CRUD actions for TeachClass model.
 */
class TeachclassController extends Controller
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
     * Lists all TeachClass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachClassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'departments'=> (new teachDepartment())->getDepartmentArray(),
        ]);
    }


    public function actionTaskline()
    {
        $classes = TeachClass::find()->all();
        return $this->render('taskline',[
            'classes'=>$classes,
        ]);
    }

    /**
     * Displays a single TeachClass model.
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
     * Creates a new TeachClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeachClass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionFactory()
    {
        $errMSG =null;
        $model = new ClassGenerate();
        if($model->load(Yii::$app->request->post()))
        {

            $department = TeachDepartment::findOne($model->department);
            if($department)
            {
                $grade = $department->year;
                for($i=$model->start;$i<=$model->end;$i++)
                {
                    $ctitle = $grade.'届'.$i.'班';
                    $tmodel = TeachClass::find()->where(['department_id'=>$model->department,
                                                        'grade'=>$grade,'serial'=>$i])->one();
                    if($tmodel)
                    {
                        $errMSG.= '  '.$ctitle.'已经存在！';
                        //$model->addError('<li>'.$grade.'届'.$i.'班已经存在！</li>');
                        continue;
                    }
                    $tmodel = new TeachClass();
                    $tmodel->attributes = ['title'=>$ctitle,'grade'=>$grade,'department_id'=>$department->id,'serial'=>$i,'school'=>"市七中",'type'=>'lk'];
                    if(!$tmodel->save()){
                        //var_export($tmodel->getErrors());
                         $errMSG.= '  '.$i.'班生成失败！';
                    }
                }
            }else{
                $errMSG='年级部无法在数据库中找到！';
            }

        if($errMSG == null)
           return $this->redirect(['index']);
        else
           Yii::$app->session->setFlash('error',$errMSG);
        }
        $departments = (new teachDepartment())->getDepartmentArray();
        return $this->render('factory',['model'=>$model,'departments'=>$departments,'errMSG'=>$errMSG]);
    }

    /**
     * Updates an existing TeachClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeachClass model.
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
     * Finds the TeachClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeachClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeachClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
