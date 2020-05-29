<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="box box-primary">
<div class="box-header with-border">
	报名情况查询
</div>
    <!-- /.box-header -->
<div class="box-body">
<?php 
$form = ActiveForm::begin(['id'=>'form1','method'=>'post',
   	                      // 'action'=>Url::toRoute(['query']),
                          // 'options'=>['class'=>'form-inline',]
                          ]); 
?>

<?= $form->field($model, 'verify')->radioList(['0'=>'未审核','1'=>'已通过','2'=>'未通过']) ?>
<?= $form->field($model, 'verifymsg')->textInput(['maxlength' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('提交审核结果', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
<hr>
</div>
</div>