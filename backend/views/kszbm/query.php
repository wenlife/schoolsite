<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\web\cookie;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

$this->title = '新生录取查询';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-kszbm-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>    
        <?php $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>'index.php?r=kszbm/query','options'=>['class'=>'form-inline']]); ?>

        <div class="form-group">
        <?=Html::dropDownlist('bmd',$bmd,$bmds,['class'=>'form-control','id'=>'bmdselect','style'=>"max-width:120px"])?>
        </div>
   
         <?= Html::a('任务概览', ['task'], ['class' => 'btn btn-primary','target'=>"_blank"]) ?>

     <?php ActiveForm::end(); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary">
    <div class="box-header with-border">
<!--     <table class="table tabel-bordered">
        <thead>
            <tr><th style="width:300px">报名点</th><th>总数</th><th>待处理</th><th>完成数</th><th>比率</th></tr>
        </thead>
        <tbody>
            <tr><td><?=$bmd?></td><td><?=$all?></td><td><?=$prefor?></td><td><?=$complete?></td><td><?=$all>0?round($complete/$all,2):0?></td></tr>
        </tbody>
    </table> -->

    </div>
    <!-- /.box-header -->
    <div class="box-body">

    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline text-center']]); ?>
        <div class="form-group">
        <?=Html::textInput('kh',null,['placeholder'=>'请输入考号或者身份证号','class'=>'form-control','style'=>'height:50px;font-size:20px'])?>
        </div>
        <button type="submit" class="btn btn-primary" style="width:150px;height:50px;font-size:20px">查询考生</button>
     <?php ActiveForm::end(); ?>
    <hr>
     <?php
       if(is_array($msg))
       {
          echo "<table class='table tabel-bordered'>";
          echo "<tr><th>考号</th><th>姓名</th><th>总分</th><th>录取情况</th><th>报名进度</th><th>操作</th></tr>";
          echo "<tr><td>";
          echo ArrayHelper::getValue($msg,'kh');
          echo "</td><td>";
          echo ArrayHelper::getValue($msg,'xm');
          echo "</td><td>";
          echo ArrayHelper::getValue($msg,'lqzf');
          echo "</td><td>";
          echo ArrayHelper::getValue($msg,'lqxx');
          echo "</td><td>";
          $jd = CommonFunction::getLqjd();
          if(ArrayHelper::getValue($msg,'flag') == 1)
          {
              echo "<label class='label label-success'>";
          }else{
              echo "<label class='label label-danger'>";
          }
          echo ArrayHelper::getValue($jd,ArrayHelper::getValue($msg,'bmjd'));
          echo "</label>";
          echo "</td><td>";
          echo Html::a('查看详情',[ArrayHelper::getValue($msg,'url'),'id'=>ArrayHelper::getValue($msg,'id')]);
          echo "</td></tr></table";
       }else{
         echo "<p class='text-danger text-center'>$msg</p>";
       }
     ?>

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
