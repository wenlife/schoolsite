<?php

namespace backend\controllers;

use Yii;
use backend\models\SignKszbm;
use backend\models\SignkszbmSearch;
use backend\models\SignBase;
use yii\web\Controller;
use yii\web\cookie;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\FindForm;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use backend\models\SysNation;
use ciniran\excel\SaveExcel;
/**
 * KszbmController implements the CRUD actions for SignKszbm model.
 */
class KszbmController extends Controller
{
    public $layout = 'tcenter';
    /**
     * {@inheritdoc}
     *
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['index','export','create','view','verify','query','task','update','delete'],
                'rules' => [
                    // [
                    //     'actions' => ['create', 'query','success','CaptchaAction'],
                    //     'allow' => true,
                    //     'roles'=>['?']
                    // ],
                   [
                        'actions' => ['index','create','export','view','query','verify','task','update','delete'],
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
     * Lists all SignKszbm models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('userPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $searchModel = new SignkszbmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SignKszbm model.
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

    public function actionExport()
    {
        if(!Yii::$app->user->can('schoolPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $data = SignKszbm::find()->all();
        $exportArr = [];
        $trans = ['ty'=>'体育','yy'=>'音乐','ms'=>'美术'];
        $nationlist = SysNation::getList();
        foreach ($data as $key => $sdata) {
            $exportArr[] = [
                'id'=>$sdata->id,
                'name'=>$sdata->name,
                'gender'=>$sdata->gender,
                "birth_place"=>$sdata->birth_place,
                "birth_date"=>$sdata->birth_date,
                "origin_place"=>$sdata->origin_place,
                'minzu'=>ArrayHelper::getValue($nationlist,$sdata->minzu),
                'id_card'=>$sdata->id_card." ",
                "hukou_place"=>$sdata->hukou_place,
                "hukou_type"=>$sdata->hukou_type,
                'height'=>$sdata->height,
                "health"=>$sdata->health,
                'address'=>$sdata->address,
                'if_pre_educate'=>$sdata->if_pre_educate,
                'if_sigle'=>$sdata->if_sigle,
                'if_alone'=>$sdata->if_alone,
                'if_ls'=>$sdata->if_ls,
                'zk_exam_id'=>$sdata->zk_exam_id." ",
                'zk_score'=>$sdata->zk_score,
                'zk_school'=>$sdata->zk_school,
                'party_type'=>$sdata->party_type,
                'speciality'=>$sdata->speciality,
                'if_live'=>$sdata->if_live,
                'if_cload'=>$sdata->if_cload,
                'if_en'=>$sdata->if_en,
                'if_help'=>$sdata->if_help,
                'dad_name'=>$sdata->dad_name,
            'dad_nation'=>ArrayHelper::getValue($nationlist,$sdata->dad_nation),
                //'dad_hukou'=>$sdata->dad_hukou,
                'dad_idcard'=>$sdata->dad_idcard." ",
                'dad_phone'=>$sdata->dad_phone." ",
                'dad_company'=>$sdata->dad_company,
                'dad_duty'=>$sdata->dad_duty,
                'mom_name'=>$sdata->mom_name,
            'mom_nation'=>ArrayHelper::getValue($nationlist,$sdata->mom_nation),
                //'mom_hukou'=>$sdata->mom_hukou,
                'mom_idcard'=>$sdata->mom_idcard." ",
                'mom_phone'=>$sdata->mom_phone." ",
                'mom_company'=>$sdata->mom_company,
                'mom_duty'=>$sdata->mom_duty,
                'if_uniform'=>$sdata->if_uniform,
                'verify'=>$sdata->verify,
                'verify_time'=>$sdata->verify_time,
                'verify_admin'=>$sdata->verify_admin,
                'verify_msg'=>$sdata->verify_msg,
                'note'=>$sdata->note

            ];
        }
        $excel = new SaveExcel([
            'array' => $exportArr,
            'headerDataArray' => ['自动编号', '姓名','性别','出生地','出生日期','籍贯','民族','身份证号','户口所在地','户口类型','身高','健康状况','家庭地址','学前教育','独生子女','孤儿','烈士','中考考号','中考分','毕业学校','政治面貌','特长','住校','云班','双语','资助','父亲姓名','父民族','父身份证号','父电话','父公司','父职务','母亲姓名','母民族','母身份证号','母电话','母公司','母职务','校服','审核（3为录取）','审核时间',"审核人","审核信息","备注"],
        ]);
        $excel->arrayToExcel();
    }

    public function actionQuery($bmd=null)
    {
        if(!Yii::$app->user->can('userPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        //设置报名点的cookie,或者重新读取
        $msg = null;
        $bmds = SignBase::find()->select(['bmd'])->distinct()->indexby('bmd')->column();
        if ($bmd!=null) {
            $cookies = Yii::$app->response->cookies; 
            $uCookie=$cookies->add(new Cookie([
              'name' => 'bmd',
              'value' =>$bmd,
              'expire' =>time()+ 30*24*3600
            ]));
        }else{
            $cookies = Yii::$app->request->cookies;
            if ($cookies->has('bmd')) {
              $bmd = $cookies->get('bmd');
            }
            if($bmd == null)
                $bmd = current($bmds);
        }
        $complete = $all = $prefor = 0;
        if($bmd!=null)
        {
            //统计该报名点的数据,暂时屏蔽该功能
            // $allItem = SignBase::find()->where(['bmd'=>$bmd])->all();
            // $all = count($allItem);

            // $ids = ArrayHelper::getColumn($allItem,'sfzh');

            // $prefor = SignKszbm::find()->where(['in','id_card',$ids])->andWhere(['verify'=>'2'])->count();

            // $complete = SignKszbm::find()->where(['in','id_card',$ids])->andWhere(['verify'=>'3'])->count();

        }
        if($post = Yii::$app->request->post())
        {
            //按顺序反向查找
            $kh = trim(ArrayHelper::getValue($post,'kh'));
            $result1 = SignKszbm::find()->where(['zk_exam_id'=>$kh])->orWhere(['id_card'=>$kh])->one();
            if($result1)
            {
                $result2 = SignBase::find()->where(['kh'=>$kh])->orWhere(['sfzh'=>$kh])->one();
                $msg = ['id'=>$result1->id,'kh'=>$result1->zk_exam_id,'xm'=>$result1->name,
                        'lqzf'=>$result1->zk_score,'lqxx'=>$result2->lqxx,'bmjd'=>$result1->verify,'flag'=>$result2->flag,'url'=>'view'];
               // return $this->redirect(['view','id'=>$result1->id]);
            }else{
                $result2 = SignBase::find()->where(['kh'=>$kh])->orWhere(['sfzh'=>$kh])->one();
                if($result2)
                    $msg = ['id'=>$result2->id,'kh'=>$result2->kh,'xm'=>$result2->xm,
                        'lqzf'=>$result2->lqzf,'lqxx'=>$result2->lqxx,
                        'bmjd'=>$result2->flag,'flag'=>$result2->flag,'url'=>'signbase/view'];
                    //$msg = ['type'=>'base','data'=>$result2,'url'=>'signbase/view'];
                    //return $this->redirect(['signbase/view','id'=>$result2->id]);
                else
                   $msg = "(".$kh.")相关数据考生不存在！";
            }
        }

        return $this->render('query',['bmd'=>$bmd,'msg'=>$msg,'bmds'=>$bmds,'all'=>$all,'prefor'=>$prefor,'complete'=>$complete]);
    }


    public function actionSummary()
    {
        $bmds = SignBase::find()->select(['bmd'])->distinct()->indexby('bmd')->column();
        $returnArr = array();
        foreach ($bmds as $key => $bmd) {
            //统计该报名点的数据
             $allItem = SignBase::find()->where(['bmd'=>$bmd])->all();
             $all = count($allItem);
             $ids = ArrayHelper::getColumn($allItem,'sfzh');
             $prefor = SignKszbm::find()->where(['in','id_card',$ids])->andWhere(['verify'=>'2'])->count();
             $complete = SignKszbm::find()->where(['in','id_card',$ids])->andWhere(['verify'=>'3'])->count();
             $returnArr[$bmd] = ['all'=>$all,'prefor'=>$prefor,'complete'=>$complete];
        }
        return $this->render('summary',['data'=>$returnArr]);
    }


    public function actionVerify($id)
    {
        if(!Yii::$app->user->can('userPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->verify_time = date("Y-m-d H:i",time());
            $model->verify_admin = Yii::$app->user->identity->username;
            $model->verify = 3;
            if($model->save())
              return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('verify', [
            'model' => $model,
        ]);
    }

    public function actionTask($bmd=null)
    {

        $bmds = SignBase::find()->select(['bmd'])->distinct()->indexby('bmd')->column();
        if($bmd == null)
        {
            $cookies = Yii::$app->request->cookies;
            if ($cookies->has('bmd')) {
              $bmd = $cookies->get('bmd');
            }
            $bmd = $bmd==null?current($bmds):$bmd;
        }
        $students = SignBase::find()->where(['bmd'=>$bmd])->all();
        foreach ($students as $key => $student) {
            $if = SignKszbm::find()->where(['id_card'=>$student->sfzh])->one();
            if($if)
            {
                $students[$key]->flag = $if->verify;
            }
        }

        return $this->render('task',['bmd'=>$bmd,'bmds'=>$bmds,'students'=>$students]);
    }

    public function actionFind()
    {
        $this->layout = 'kszbm';
        $model = new FindForm();
        $msg = '';
        if($model->load(Yii::$app->request->Post()))
        {
            $kh = trim($model->kh);
            $sfzh = trim($model->sfzh);
            $result = SignKszbm::find()->where(['zk_exam_id'=>$kh,'id_card'=>$sfzh])->one();
            if($result)
            {
                if($result->verify == 3)
                {
                    $msg = "恭喜您，您已被我校录取。欢迎来到攀枝花市第七高级中学校！";
                }else{
                    $msg = "您已经填报了报名表，请进行后续缴费事项！";
                }
                
            }else{
                $result = SignBase::find()->where(['kh'=>$kh,'sfzh'=>$sfzh])->one();
                if($result)
                {
                    return $this->render('result',['result'=>$result]);
                }else{
                    $msg = "未查询到您的信息，请检查考号或身份证号是否输入有错！";
                }
            }
        }
        return $this->render('find',['model'=>$model,'msg'=>$msg]);
    }

    public function actionReport($id)
    {
        $this->layout = 'kszbm';
        $student = SignBase::findOne($id);
        $model = new SignKszbm();
        $model->name = $student->xm;
        $model->id_card = $student->sfzh;
        $model->address = $student->txdz;
        $model->zk_exam_id = $student->kh;
        $model->zk_school = $student->byzx;
        $model->zk_score = $student->lqzf;
        if($model->load(Yii::$app->request->post()))
        {
            $model->verify = 2;
            if($model->save())
            {
                return $this->render('success');
            }else{
               // var_export($model->getErrors());
            }
        }
        return $this->render('report',['model'=>$model]);


    }

    /**
     * Creates a new SignKszbm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->can('userPost'))
        {
            exit("您没有访问该页面的权限！");
        }
        $model = new SignKszbm();

        if ($model->load(Yii::$app->request->post())) {
           // var_export($model->birth_date);
           $model->verify = 4;
           $model->verify_time = date("Y-m-d H:i",time());
           $model->verify_admin = Yii::$app->user->identity->username;
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
                
            }else{
                var_export($model->getErrors());
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SignKszbm model.
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
     * Deletes an existing SignKszbm model.
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
     * Finds the SignKszbm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SignKszbm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SignKszbm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
