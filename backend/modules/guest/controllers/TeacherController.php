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
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
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

    public function actionSecode()
    {
        $teachers = UserTeacher::find()->all();
        foreach ($teachers as $key => $teacher) {
            $ifset = 1;
            while($ifset)
            {
              $code  = $this->getRandomStr(4,false);
              $ifset = UserTeacher::find()->where(['secode'=>$code])->one();
            }
            $teacher->secode = $code;
            $teacher->save();
        }

        return $this->redirect(['index']);
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
     * 获得随机字符串
     * @param $len             需要的长度
     * @param $special        是否需要特殊符号
     * @return string       返回随机字符串
     */
    protected function getRandomStr($len, $special=true){
        // $chars = array(
        //     "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        //     "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        //     "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        //     "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        //     "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        //     "3", "4", "5", "6", "7", "8", "9"
        // );
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "p", "q", "r", "s", "t", "u", "v",
            "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9"
        );

        if($special){
            $chars = array_merge($chars, array(
                "!", "@", "#", "$", "?", "|", "{", "/", ":", ";",
                "%", "^", "&", "*", "(", ")", "-", "_", "[", "]",
                "}", "<", ">", "~", "+", "=", ",", "."
            ));
        }

        $charsLen = count($chars) - 1;
        shuffle($chars);                            //打乱数组顺序
        $str = '';
        for($i=0; $i<$len; $i++){
            $str .= $chars[mt_rand(0, $charsLen)];    //随机取出一位
        }
        return $str;
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
