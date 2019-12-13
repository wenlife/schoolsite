<?php
namespace backend\modules\guest\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Adminuser;
use common\models\AdminuserSearch;
use common\models\AuthItem;
use common\models\AuthAssignment;
/**
 * AdminuserController implements the CRUD actions for Adminuser model.
 */
class AdminuserController extends Controller
{


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
     * Lists all Adminuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminuserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adminuser model.
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
     * Creates a new Adminuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Adminuser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Adminuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionResetpwd($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->post()) {
            $pwd = Yii::$app->request->post('pwd');
            $model->setPassword($pwd);
            $model->generateAuthKey();
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('resetpwd', [
                'model' => $model,
            ]);
        }
    }

    public function actionPrivilege($id)
    {
        //step1:找出所有权限，准备给checkboxlist；
        $allPrivilege = Authitem::find()->select(['name','description'])->where(['type'=>1])->orderby('description')->all();
        foreach ($allPrivilege as $priv) {
            $allPrivilegeArray[$priv->name] = $priv->description;
        }

        //step2: 当前用户的权限
        $AuthAssignments = AuthAssignment::find()->select(['item_name'])->where(['user_id'=>$id])->all();
        $AuthAssignmentsArray = [];
        foreach ($AuthAssignments as $AuthAssignment) {
            array_push($AuthAssignmentsArray,$AuthAssignment->item_name);
        }

        //根据post数据，设置权限
        if($post = Yii::$app->request->post())
        {
            AuthAssignment::deleteAll('user_id=:id',[':id'=>$id]);
            if(isset($post['newPri']))
            {  
                $newPri = $post['newPri'];
                for($x=0;$x<count($newPri);$x++)
                {
                    $apri = new AuthAssignment();
                    $apri->item_name = $newPri[$x];
                    $apri->user_id = $id;
                    $apri->created_at = time();
                    if($apri->save())
                    {
                        return $this->redirect(['index']);
                    }
                }
            }else{
                return $this->redirect(['index']);
            }
        }
        
        //step 4: 渲染checkboxlist
        return $this->render('privilege',['id'=>$id,
              'AuthAssignmentsArray'=>$AuthAssignmentsArray,
              'allPrivilegeArray'   =>$allPrivilegeArray
          ]);
    }

    /**
     * Deletes an existing Adminuser model.
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
     * Finds the Adminuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adminuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adminuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
