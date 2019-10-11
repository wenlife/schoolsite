<?php

namespace backend\modules\school\controllers;

use Yii;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachmanageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\school\forms\Teach;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachClass;
use backend\libary\CommonFunction;
use yii\helpers\ArrayHelper;


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
    public function actionIndex()
    {
        $post = Yii::$app->request->post();
        return $this->render('index', [
            'var' =>$post,
        ]);
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
