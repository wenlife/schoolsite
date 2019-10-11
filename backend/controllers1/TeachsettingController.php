<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Teachsetting;
use backend\models\TeachsettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeachsettingController implements the CRUD actions for Teachsetting model.
 */
class TeachsettingController extends Controller
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
     * Lists all Teachsetting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachsettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $var = Yii::$app->request->post();
        //var_export($var);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'var'=>$var
        ]);
    }

    public function actionGetteacher($subject,$term,$banji)
    {
        if(yii::$app->request->post())
        {
            $post = yii::$app->request->post();
            //var_export($post);
            $model = Teachsetting::find()->where(['class_id'=>$banji,'semester'=>$term,'subject_id'=>$subject])->one();
            if(!$model)
            {
                $model = new Teachsetting();
            }
            $model->subject_id = $subject;
            $model->semester = $term;
            $model->class_id = $banji;
            $model->teacher_id = ArrayHelper::getValue($post,'teacherid');
            $model->save();
            return $this->redirect(['index']);
        }
        $subjectTeacher = (new \yii\db\Query())
                      ->select(['name','id'])
                      ->from('teacher')
                      ->indexby('id')
                      ->orderby('pinx')
                      ->column();
        return $this->render('getteacher',['subjectteacher'=>$subjectTeacher,'term'=>$term,'banji'=>$banji]);
    }

    /**
     * Displays a single Teachsetting model.
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
     * Creates a new Teachsetting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teachsetting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Teachsetting model.
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
     * Deletes an existing Teachsetting model.
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
     * Finds the Teachsetting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teachsetting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teachsetting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
