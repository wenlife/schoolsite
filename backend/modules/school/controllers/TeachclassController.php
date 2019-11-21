<?php

namespace backend\modules\school\controllers;

use Yii;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachClassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $errMSG = null;
        if($post = Yii::$app->request->post())
        {
            $department = $post['department'];
            $start = $post['start'];
            $end = $post['end'];
            if(is_numeric($start)&&is_numeric($end)&&($start<=$end))
            {
                if(is_numeric($department))
                {
                    $grade = (new \yii\db\Query())->select(['year'])->from('teach_department')->where(['id'=>$department])->indexby('year')->scalar();
                    if($grade)
                    {
                        for($i=$start;$i<=$end;$i++)
                        {
                            $model = TeachClass::find()->where(['department_id'=>$department,
                                                                'grade'=>$grade,'serial'=>$i])->one();
                            if($model)
                            {
                                $errMSG.= '<li>'.$grade.'届'.$i.'班已经存在！</li>';
                                continue;
                            }
                            $model = new TeachClass();
                            $model->title = $grade.'届'.$i.'班';
                            $model->grade = $grade;
                            $model->department_id = $department;
                            $model->serial = $i;
                            $model->school = "市七中";
                            $model->type = 'lk';
                            if(!$model->save()){
                                 $errMSG.= '<li>'.$i.'班生成失败！</li>';
                            }
                        }
                    }else{
                        $errMSG.='<li>年级部无法在数据库中找到！<li>';
                    }
                }else{
                    $errMSG .= '<li>年级部选择错误！</li>';
                }

            }else{
                $errMSG = '<li>班级序号顺序选择错误，请重新开始！</li>';
            }

            if($errMSG == null)
                return $this->redirect(['index']);
        }


        return $this->render('factory',['errMSG'=>$errMSG]);

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
