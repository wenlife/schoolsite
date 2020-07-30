<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
/* @var $this yii\web\View */
/* @var $model backend\models\SignBase */

$this->title = '修改录取学生数据：' . $model->xm;
$this->params['breadcrumbs'][] = ['label' => '基础信息库', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改信息';
// $setArr = array();
// if(!Yii::$app->user->can('userPost'))
// {
//    if($model->flag != 24)
//        $setArr[$model->flag] = ArrayHelper::getValue('')
// }
?>
<div class="sign-base-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kh')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'xm')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'bmd')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'flag')->radiolist(['0'=>'未录取','1'=>'已录取','24'=>'异常状态'])->label("录取状态(修改录取状态请备注原因)") ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true,'required'=>"required"])->label("特招或该生放弃录取等情况，请备注此处") ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
