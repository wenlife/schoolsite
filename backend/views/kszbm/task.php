<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\web\cookie;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = (string)$bmd.'数据';
$this->params['breadcrumbs'][] = $this->title;
$color = ['1'=>'label label-danger','2'=>'label label-default','3'=>'label label-success']
?>
<div class="sign-kszbm-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>    
        <?php $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>'index.php?r=kszbm/task','options'=>['class'=>'form-inline']]); ?>

        <div class="form-group">
          <?=Html::dropDownlist('bmd',$bmd,$bmds,['class'=>'form-control','id'=>'bmdselect'])?>
        </div>
        <div class="form-group">
          <?= Html::a('导出数据', ['bmdexport','bmd'=>(string)$bmd], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="form-group">
          <?= Html::a('<<回到查询', ['query'], ['class' => 'btn btn-primary']) ?>
        </div>
     <?php ActiveForm::end(); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary">
    <div class="box-header with-border">
    <table class="table tabel-bordered">
        <thead>
            <tr><th style="width:100px">序号</th><th>中考考号</th><th>姓名</th><th>联系电话</th><th>录取分</th><th>录取信息</th><th>录取进度</th><th>备注</th></tr>
        </thead>
        <tbody>
        <?php
           $i = 0;
           foreach ($students as $key => $student) {
            $i++;
             echo "<tr><td>$i</td><td>$student->kh</td><td>$student->xm</td><td>$student->lxdh</td><td>$student->lqzf</td><td>$student->lqxx</td><td>";
             $lqjd = CommonFunction::getLqjd();
             echo "<label class='".ArrayHelper::getValue($color,$student->flag)."'>";
             echo ArrayHelper::getValue($lqjd,$student->flag);
             echo "</label>";
             echo "</td><td>";
             echo $student->note;
             echo "</td></tr>";
           }
        ?>
            
        </tbody>
    </table>

    </div>
    <!-- /.box-header -->
    <div class="box-body">


    </div>
</div>

</div>


<?php
$this->registerJs(<<<JS

$('select#bmdselect').change(function(){
    $('form#form1').submit();
});


JS,View::POS_LOAD);
?>
