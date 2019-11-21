<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use backend\libary\CommonFunction;
/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->dropDownList((new \yii\db\Query())
                                              ->select(['title','id'])
                                              ->from('teach_department')
                                              ->indexby('id')->column(),['prompt'=>"请选择部门",'id'=>'department']) ?>
    <?= $form->field($model, 'grade')->dropDownList(CommonFunction::gradelist(),['prompt'=>'请选择届次','id'=>'grade']) ?>

    <?= $form->field($model, 'serial')->dropDownList(range(0,40),['prompt'=>'请选择班级序号','id'=>'serial']) ?>

    <?= $form->field($model, 'type')->dropDownList(CommonFunction::getClassType(),['prompt'=>'请选择文理科']) ?>

    <?= $form->field($model, 'school')->dropDownList(CommonFunction::getSchool()) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
