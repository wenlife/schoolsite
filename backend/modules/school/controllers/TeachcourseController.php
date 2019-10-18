<?php

namespace backend\modules\school\controllers;

use Yii;
use backend\modules\school\models\TeachCourse;
use backend\modules\school\models\TeachcourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeachCourse models.
     * @return mixed
     */
    public function actionIndex($yearpost=null,$department=null,$banji=null)
    {
        //$post = Yii::$app->request->post();
        //var_export($post);
        return $this->render('index', [
            'var' =>['yearpost'=>$yearpost,'department'=>$department,'banji'=>$banji],
        ]);
    }

    public function actionGetclass($department)
    {
        //$class = (new \yii\db\Query())->select(['title','id'])->from('teach_class')->indexby('id')->column();
        return json_encode((new \yii\db\Query())->select(['title','id'])->from('teach_class')->where(['department_id'=>$department])->indexby('id')->orderby('serial')->column());
       //return  Html::dropDownList('banji',null,$class,['class'=>'form-control']);
    }

    public function actionSetcourse()
    {
        $post = Yii::$app->request->post();
        $year = ArrayHelper::getValue($post,'year');
        $banji = ArrayHelper::getValue($post,'banji');
        $weekday = ArrayHelper::getValue($post,'weekday');
        $daytime = ArrayHelper::getValue($post,'daytime');
        $subject = ArrayHelper::getValue($post,'subject');
       if($year&&$banji&&$weekday&&$daytime)
       {
            $model = TeachCourse::find()->where([
                    'year_id'=>$year,
                    'class_id' => $banji,
                    'weekday' => $weekday,
                    'day_time_id' => $daytime,
                    ])->one();
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
                return 'success';
            }else{
                return var_export($model);
            }

            
       }else{
           return 'empty value!';
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
