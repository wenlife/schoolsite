<?php

namespace backend\controllers;

use Yii;
use backend\models\SignBase;
use backend\models\SignbaseSearch;
use backend\forms\ExcelUpload;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use ciniran\excel\ReadExcel;
use yii\filters\AccessControl;
/**
 * SignbaseController implements the CRUD actions for SignBase model.
 */
class SignbaseController extends Controller
{
    public $layout = 'tcenter';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['index','create','import','view','update','delete','del'],
                'rules' => [
                    // [
                    //     'actions' => ['create', 'query','success','CaptchaAction'],
                    //     'allow' => true,
                    //     'roles'=>['?']
                    // ],
                   [
                        'actions' => ['index','create','import','view','update','delete','del'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                   // 'export' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all SignBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('schoolPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $searchModel = new SignbaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImport()
    {
        if(!Yii::$app->user->can('schoolPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $form = new ExcelUpload();
        $errMSG = array();
        if($post=Yii::$app->request->post())
        {
            $errMSG = array();
            $form->imageFile = UploadedFile::getInstance($form, 'imageFile');
            if($url = $form->upload()) {
                $excel = new ReadExcel(['path' => $url,'head' => true,'headLine' =>1,]);
                $data = $excel->getArray();
                $keys = ['kh','xm','xb','byzx','bjdm','csny','lxdh','txdz','sfzh',
                         'yw','sx','wy','wl','hx','zz','ls','sw','dl','sy','ty',
                          'zf','lqzf','lqxx','bmd','flag'];
                $insertData = array();
                foreach ($data as $key => $lq) {
                   $insertData[] = array_values($lq);
                }
                //var_export($insertData);
                //exit();
                $res= \Yii::$app->db->createCommand()->batchInsert(SignBase::tableName(), $keys, $insertData)->execute();
                var_export($res);
                // $student  = new SignBase();
                // foreach ($data as $key => $lq) {
                //    $newStudent = clone $student;
                //    $newStudent->setAttributes($lq);
                //    //return $this->redirect(['index']);
                //    if(!$newStudent->save())
                //    {
                //        $errMSG[] = "导入中考考号为：".$lq->kh."的同学时出现如下错误：".serialize($newStudent->getErrors());
                //    }
                // }
                Yii::$app->getSession()->setFlash('success', '操作成功，共导入'.$res."条数据！");
                return $this->redirect(['index']);
                if(empty($errMSG))
                {
                    //
                }
                //var_export($data);
               
                //需要对导入的表格进行基本的验证,并添加强制导入的选项
            }
        }
        return $this->render('import',['model'=>$form,'errMSG'=>$errMSG]);
    }


    public function actionCheck()
    {
      $all = SignBase::find()->where(['flag'=>'1'])->all();

      return $this->render('check',['students'=>$all]);
    }

    /**
     * Displays a single SignBase model.
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
     * Creates a new SignBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('schoolPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $model = new SignBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SignBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->can('schoolPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SignBase model.
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

    public function actionDel()
    {
        SignBase::deleteAll();
        return $this->redirect(['index']);
    }

    /**
     * Finds the SignBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SignBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SignBase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
