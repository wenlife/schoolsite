<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\web\cookie;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

$this->title = '报名点数据';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sign-kszbm-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>    
          <?= Html::a('返回中心', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary">
    <div class="box-header with-border">
    <table class="table tabel-bordered">
        <thead>
            <tr><th >报名点</th><th>总人数</th><th>待处理</th><th>已完成</th><th>比率</th></tr>
        </thead>
        <tbody>
        <?php
           $i = 0;
           foreach ($data as $bmd => $bdata) {
            $i++;
            $all = ArrayHelper::getValue($bdata,'all');
            $prefor = ArrayHelper::getValue($bdata,'prefor');
            $complete = ArrayHelper::getValue($bdata,'complete');
            $rate = $all>0?round($complete/$all,2):0;
             echo "<tr><td>$bmd</td><td>$all</td><td>$prefor</td><td>$complete</td><td>$rate%</td></tr>";
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

JS,View::POS_LOAD);
?>
