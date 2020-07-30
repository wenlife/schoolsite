<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\web\cookie;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '未处理数据统计';
$this->params['breadcrumbs'][] = $this->title;
$color = ['1'=>'label label-danger','2'=>'label label-default','3'=>'label label-success']
?>
<div class="sign-kszbm-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>    
          <?= Html::a('<<回到中心', ['index'], ['class' => 'btn btn-primary']) ?>
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
                if($student->kszbm &&$student->kszbm->verify == 2)
                {
                  $i++;
                 echo "<tr><td>$i</td><td>$student->kh</td><td>$student->xm</td><td>$student->lxdh</td><td>$student->lqzf</td><td>$student->lqxx</td><td>";
                 $lqjd = CommonFunction::getLqjd();
                 echo "<label class='".ArrayHelper::getValue($color,$student->kszbm->verify)."'>";
                 echo ArrayHelper::getValue($lqjd,$student->kszbm->verify);
                 echo "</label>";
                 echo "</td><td>";
                 echo $student->note;
                 echo "</td></tr>";
                 }else{
                    continue;
                 }
           }
        ?>
            
        </tbody>
    </table>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table tabel-bordered">
        <thead>
            <tr><th style="width:100px">序号</th><th>中考考号</th><th>姓名</th><th>联系电话</th><th>录取分</th><th>录取信息</th><th>录取进度</th><th>备注</th></tr>
        </thead>
        <tbody>
        <?php
           $i = 0;
           foreach ($students as $key => $student) {

            if(!is_null($student->kszbm))
                 continue;
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
</div>

</div>


<?php
$this->registerJs(<<<JS

$('select#bmdselect').change(function(){
    $('form#form1').submit();
});


JS,View::POS_LOAD);
?>
