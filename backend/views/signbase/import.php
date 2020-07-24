<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '导入基础数据';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">导入基础数据<small>  注意：请按照参照表做好EXCEL以后再导入</small></h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="form-group">
      <?= $form->field($model, 'imageFile')->fileInput()->label('录取信息') ?>
      <p class="help-block"><a href="example/bmmb.xls" download="导入信息模板.xls">录取信息样例表</a></p>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">导入信息到基础库</button>
  </div>
<?php ActiveForm::end() ?>
</div>


<?php
if(!is_null($errMSG)&&count($errMSG)>0) 
{
?>

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">导入内容注意事项</h3>
</div>
<div class="box-body">
  <ul>
    <?php
     foreach ($errMSG as $key => $value) {
      if(is_array($value))
      {
        //echo "<li>".var_export($value)."</li>";
        foreach ($value as $key1 => $value1) {
          echo "<li>".$value1."</li>";
        }
      }else{
        echo "<li>".$value."</li>";
      }
       
     }
    ?>
  </ul>
</div>
  <div class="box-footer">
     <?=Html::a('回到管理页面',['index','flag'=>1],['class'=>'btn btn-primary'])?>
  </div>
</div>
<?php
}
?>


</div>
</div>