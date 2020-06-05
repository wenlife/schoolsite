<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SysNation;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '报名表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sign-sheet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>      
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if($model->verify != 0){
          if(Yii::$app->user->can('schoolPost'))
          {
            echo Html::a('已审核', ['verify', 'id' => $model->id], ['class' => 'btn btn-success btn-large']);
          }else{
            echo Html::a('已审核', [], ['class' => 'btn btn-success btn-large','disabled'=>'disabled']);
          }
           
        }else{
          echo Html::a('审核', ['verify', 'id' => $model->id], ['class' => 'btn btn-success btn-large']);
        }
        ?>
    </p>

    <style type="text/css">
        table{
            border:4px solid #ccc;
        }
        table td{
            border:1px solid #ccc;
            height: 50px
        }
        .title{
            width:100px;
        }
        .center{
            text-align: center;
            font-weight: bold;
        }
    </style>

    <table class="table table-borderd" style="width:890px">
        <tr><td class="title">报名编号</td><td><?=$model->id?></td>
            <td class="title">审核情况</td><td>
                <?php
                  $s = ['0'=>'未审核','1'=>'已通过','2'=>'未通过'];
                  echo ArrayHelper::getValue($s,$model->verify);
                ?>
            </td>
            <td class="title">审核信息</td><td colspan="2"><?=$model->verifymsg?></td>
        </tr>
        <tr><td class="title">缴费微信</td><td><?=$model->payacount?></td>
            <td class="title">缴费时间</td><td><?=$model->paytime?></td>
            <td class="title">审核人</td><td colspan="2"><?=$model->verifyadmin?></td>
        </tr>
        <tr><td class="title">姓名</td><td width="200px"><?=$model->name?></td>
            <td class="title">性别</td><td  width="200px"><?=$model->gender?></td>
            <td class="title">民族</td><td  width="200px"><?php
                //echo ArrayHelper::getValue(SysNation::getlist(),$model->minzu)
                echo $model->nation?$model->nation->nation:$model->nation;  
            ?></td>
            <td rowspan="5" style="width:181px;height: 241px"><img width="200px" id="simg" src="<?=$model->photo?>"/></td>
        </tr>
        <tr>
            <td class="title">身份证号</td><td colspan="2"><?=$model->idcard?></td>
            <td class="title">中考报名号</td><td colspan="2"><?=$model->graduate_id?></td>
        </tr>
        <tr><td class="title">毕业学校</td><td colspan="2"><?=$model->graduate?></td>
            <td class="title">报考专项</td><td colspan="2">
                <?php
                   $ss = $model->cat1;
                   if($ss == 'ty'){
                        $ss = "体育";
                   }elseif($ss == 'yy'){
                        $ss = "音乐";
                   }elseif ($ss == 'ms') {
                       $ss ='美术';
                   }else{
                    $ss = ss;
                   }
                if($model->cat2)
                   $ss.='-'.$model->cat2;
                if($model->cat3)
                    $ss.='-'.$model->cat3;
                echo $ss;
                ?></td>
        </tr>
 
        <tr>
            <td class="title">出生日期</td><td><?=$model->birth?></td>
            <td class="title">年龄</td><td><?=$model->old?></td>
            
        </tr>
        <tr>
            <td class="title">身高(cm)</td><td><?=$model->height?></td>
            <td class="title">体重(kg)</td><td><?=$model->weight?></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="title">家长姓名</td><td><?=$model->parentname?></td>
            <td class="title">关系</td><td><?=$model->parentrelation=='dady'?'父亲':'母亲'?></td>
            <td class="title">联系电话</td><td colspan="2"><?=$model->parentphone?></td>
        </tr>
        <tr><td class="title center" colspan="7">成绩</td></tr>
        <tr>
            <td>语文</td><td>数学</td><td>英语</td>
            <td>物理(0.9)</td><td>化学(0.8)</td><td>生物(0.3)</td>
            <td>实验(0.5)</td> 
        </tr>
        <tr>
            <td><?=$model->yw?></td><td><?=$model->sx?></td><td><?=$model->yy?></td>
            <td><?=$model->wl?></td><td><?=$model->hx?></td><td><?=$model->sw?></td>
            <td><?=$model->sy?></td>
        </tr>
        <tr>
            <td>政治(0.35)</td><td>历史(0.35)</td><td>地理(0.3)</td>
            <td>体育</td><td colspan="3">总分（折合）</td>
        </tr>
        <tr>
            <td><?=$model->zz?></td><td><?=$model->ls?></td><td><?=$model->dl?></td>
            <td><?=$model->ty?></td><td colspan="3"><?=$model->score?></td>
        </tr>
        <tr><td colspan="7" class="title center">获奖情况</td></tr>
        <tr><td colspan="7"><?=$model->prizedetail?></td></tr>

    </table>
</div>

<?php
$this->registerJsFile(
    'specialcontent\js\jquery.rotate.min.js',
    ['depends' => [\backend\assets\AppAsset::className()]]
);
$this->registerJs(<<<JS
$(function(){
        var image = new Image();
        image.src = $('#simg').attr('src');
        if(image.width > image.height)
        {
            $('#simg').attr('width','181px');
             //$('#simg').css('transform','rotate(90deg)');
            $('#simg').rotate(90);
        }
});

JS,View::POS_LOAD);
?>

