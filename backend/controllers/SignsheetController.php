<?php

namespace backend\controllers;

use Yii;
use common\models\Adminuser;
use yii\filters\AccessControl;
use backend\models\SignSheet;
use backend\models\SignsheetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use ciniran\excel\SaveExcel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * SignsheetController implements the CRUD actions for SignSheet model.
 */
class SignsheetController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['index','export','view','verify','update','delete'],
                'rules' => [
                    // [
                    //     'actions' => ['create', 'query','success','CaptchaAction'],
                    //     'allow' => true,
                    //     'roles'=>['?']
                    // ],
                   [
                        'actions' => ['index','export','view','verify','update','delete'],
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

    public $layout = 'simple';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'class' => 'backend\controllers\action\CaptchaAction',
                'maxLength'=>4,
                'minLength'=>4,
                'padding'=>5,
                'height'=>39,
                'width'=>100,
                'offset'=>3,
            ],
        ];
    }

    /**
     * Lists all SignSheet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'tcenter';
        $searchModel = new SignsheetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExport()
    {

        $data = SignSheet::find()->all();
        $exportArr = [];
        $trans = ['ty'=>'体育','yy'=>'音乐','ms'=>'美术'];
        foreach ($data as $key => $sdata) {
            $exportArr[] = [
                'id'=>$sdata->id,
                'name'=>$sdata->name,
                'gender'=>$sdata->gender,
                'minzu'=>$sdata->nation?$sdata->nation->nation:'null',
                'old'=>$sdata->old,
                'idcard'=>$sdata->idcard." ",
                'birth'=>$sdata->birth,
                'graduate'=>$sdata->graduate,
                'cat1'=>ArrayHelper::getValue($trans,$sdata->cat1),
                'cat2'=>$sdata->cat2,
                'cat3'=>$sdata->cat3,
                'height'=>$sdata->height,
                'weight'=>$sdata->weight,
                'graduate_id'=>$sdata->graduate_id." ",
                'prizedetail'=>$sdata->prizedetail,
                'photo'=>$sdata->photo,
                'score'=>$sdata->score,
                'yw'=>$sdata->yw,
                'sx'=>$sdata->sx,
                'yy'=>$sdata->yy,
                'wl'=>$sdata->wl,
                'hx'=>$sdata->hx,
                'sw'=>$sdata->sw,
                'zz'=>$sdata->zz,
                'dl'=>$sdata->dl,
                'ls'=>$sdata->ls,
                'sy'=>$sdata->sy,
                'ty'=>$sdata->ty,
                'parentname'=>$sdata->parentname,
                'parentrelation'=>$sdata->parentrelation == 'dady'?'父亲':'母亲',
                'parentphone'=>$sdata->parentphone." ",
                'payacount'=>$sdata->payacount,
                'paytime'=>$sdata->paytime,
                'verify'=>$sdata->verify,
                'verifyadmin'=>$sdata->verifyadmin,
                'verifymsg'=>$sdata->verifymsg
            ];
        }
        $excel = new SaveExcel([
            'array' => $exportArr,
            'headerDataArray' => ['报名号', '姓名','性别','民族','年龄','身份证号','出生日期','毕业学校','专业一类','专业二类','专业三类','身高','体重','会考号','获奖情况','照片','会考分','语文','数学','英语','物理','化学','生物','政治','地理','历史','实验','体育','父母姓名','关系','联系电话','付款账号','付款时间','审核情况','审核人（1为通过）','审核信息',],
        ]);
        $excel->arrayToExcel();


    }

    public function actionPhoto()
    {
        $model = SignSheet::find()->all();
        foreach ($model as $key => $s) {
            $url = $s->photo;
            if(file_exists($url))
              $this->scaleImg($url,'upload', $maxx = 295, $maxy = 413);
        }
        return $this->redirect(['index']);
    }



    /**
     * Displays a single SignSheet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $admin = Adminuser::findByUsername($model->verifyadmin);
        if($admin)
           $model->verifyadmin = $admin->name;
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new SignSheet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignSheet();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            //$model->scenario = 'default';
            //自动填写出生日期 性别 年龄
            $model->birth = date('Y-m-d',strtotime(substr($model->idcard, 6, 8)));
            //echo substr('abcdef',-2,1);
            //exit(substr($model->idcard, -1, 1));
            $model->gender = substr($model->idcard, -2, 1) % 2 ? '男' : '女';
            $date=strtotime(substr($model->idcard,6,8));
            $today=strtotime('today');
            $diff=floor(($today-$date)/86400/365);
            $model->old=strtotime(substr($model->idcard,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;

            //计算成绩
            $score = $model->yw+$model->sx+$model->yy+$model->ty;
            $score += $model->wl*0.9;
            $score +=$model->hx*0.8;
            $score += ($model->zz+$model->ls)*0.35;
            $score += ($model->sw+$model->dl)*0.3;
            $score += $model->sy *0.5;
            $model->score = round($score,2);

            $model->signtime = date("Y-m-d H:i",time());


             $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($url = $model->upload()) {
                $model->photo = $url;
            }
            if($model->validate(['id','name','gender','idcard','cat1','cat2','photo','parentphone','note']))
           // if($model->validate())
            {
                $model->save(false);
                return $this->redirect(['success']);
            }else{
                var_export($model->getErrors());
            }
       
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    public function actionSuccess()
    {
        return $this->render('success');
    }

    public function actionQuery($idcard=null)
    {
        $msg = '';
        if($idcard != null)
        {
          if(is_numeric($idcard))
          {
             $msg = SignSheet::find()->where(['idcard'=>$idcard])->one();
          }

        }

        return $this->render('query',['msg'=>$msg]);
    }

    public function actionVerify($id)
    {

        $model = $this->findModel($id);
        if(Yii::$app->request->post())
        {
            // $state = Yii::$app->request->post('state');
            // $msg = Yii::$app->request->post('msg');
            // $model->verify = $state;
            // $model->verifymsg = $msg;
            $model->load(Yii::$app->request->post());
            $model->verifytime = date("Y-m-d H:i",time());
            $model->verifyadmin = Yii::$app->user->identity->username;
            if(!$model->save(false))
            {
                 exit(var_export($model->getErrors()));
            }
            $this->redirect(['index']);
        }

        return $this->render('verify',['model'=>$model]);
    }

    /**
     * Updates an existing SignSheet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->birth = date('Y-m-d',strtotime(substr($model->idcard, 6, 8)));
            $model->gender = substr($model->idcard,-2, 1) % 2 ? '男':'女';
            $date=strtotime(substr($model->idcard,6,8));
            $today=strtotime('today');
            $diff=floor(($today-$date)/86400/365);
            $model->old=strtotime(substr($model->idcard,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;

         //计算成绩
            $score = $model->yw+$model->sx+$model->yy+$model->ty;
            $score += $model->wl*0.9;
            $score +=$model->hx*0.8;
            $score += ($model->zz+$model->ls)*0.35;
            $score += ($model->sw+$model->dl)*0.3;
            $score += $model->sy *0.5;
            $model->score = round($score,2);

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile)
            {              
                if($url = $model->upload()) {
                    $model->photo = $url;
                }

            }
                        
            if($model->validate(['id','name','gender','idcard','cat1','photo','parentphone','note']))
            {
                $model->save(false);
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionRewrite($idcard)
    {

        $model = SignSheet::find()->where(['idcard'=>$idcard])->one();
        $model->scenario = 'create';
        if($model->verify == 2)
        {
            if ($model->load(Yii::$app->request->post())) {
                $model->birth = date('Y-m-d',strtotime(substr($model->idcard, 6, 8)));
                $model->gender = substr($model->idcard,-2, 1) % 2 ? '男':'女';
                $date=strtotime(substr($model->idcard,6,8));
                $today=strtotime('today');
                $diff=floor(($today-$date)/86400/365);
                $model->old=strtotime(substr($model->idcard,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;

             //计算成绩
                $score = $model->yw+$model->sx+$model->yy+$model->ty;
                $score += $model->wl*0.9;
                $score +=$model->hx*0.8;
                $score += ($model->zz+$model->ls)*0.35;
                $score += ($model->sw+$model->dl)*0.3;
                $score += $model->sy *0.5;
                $model->score = $score;

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if($model->imageFile)
                {              
                    if($url = $model->upload()) {
                        $model->photo = $url;
                    }

                }

                $model->verify = 3;
                $model->verifymsg = "";
                $model->verifyadmin = "";
                $model->verifytime = "";
                            
                if($model->validate(['id','name','gender','idcard','cat1','photo','parentphone','note']))
                {
                    $model->save(false);
                }
                
              return $this->redirect(['success']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        }else{
            exit('当前不在审核不通过的状态，不能修改！');
        }

       
        
    }

    /**
     * Deletes an existing SignSheet model.
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
     * Finds the SignSheet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SignSheet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SignSheet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function scaleImg($picName,$savePath, $maxx = 295, $maxy = 413)
    {
        $info = getimageSize($picName);//获取图片的基本信息
        $w = $info[0];//获取宽度
        $h = $info[1];//获取高度

        if($w<=$maxx&&$h<=$maxy){
            return $picName;
        }
        //获取图片的类型并为此创建对应图片资源
        switch ($info[2]) {
            case 1://gif
                $im = imagecreatefromgif($picName);
                break;
            case 2://jpg
                $im = imagecreatefromjpeg($picName);
                break;
            case 3://png
                $im = imagecreatefrompng($picName);
                break;
            default:
                die("图像类型错误");
        }
        //计算缩放比例
        if (($maxx / $w) > ($maxy / $h)) {
            $b = $maxy / $h;
        } else {
            $b = $maxx / $w;
        }
        //计算出缩放后的尺寸
        $nw = floor($w * $b);
        $nh = floor($h * $b);
        //$nw = $maxx;
        //$nh = $maxy;
        //创建一个新的图像源（目标图像）
        $nim = imagecreatetruecolor($nw, $nh);

        //透明背景变黑处理
        //2.上色
        $color=imagecolorallocate($nim,255,255,255);
        //3.设置透明
        imagecolortransparent($nim,$color);
        imagefill($nim,0,0,$color);

        //执行等比缩放
        imagecopyresampled($nim, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        //输出图像（根据源图像的类型，输出为对应的类型）
        $picInfo = pathinfo($picName);//解析源图像的名字和路径信息
        $savePath =  $picName;//$savePath. "/pic" . $picInfo["basename"];
        switch ($info[2]) {
            case 1:
                imagegif($nim, $savePath);
                break;
            case 2:
                imagejpeg($nim, $savePath);
                break;
            case 3:
                imagepng($nim, $savePath);
                break;

        }
        //释放图片资源
        imagedestroy($im);
        imagedestroy($nim);
        //返回结果
        return $savePath;
    } 
}
