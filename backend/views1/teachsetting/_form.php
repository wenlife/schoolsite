<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Teachsetting */
/* @var $form yii\widgets\ActiveForm */
$allClass = (new \yii\db\Query())
            ->select(['name','id'])
            ->from('class_setting')
            ->indexby('id')
            ->column();
//var_export($allClass);
$allTeacher = (new \yii\db\Query())
            ->select(['name','id'])
            ->from('teacher')
            ->indexby('id')
            ->orderby('pinx')
            ->column();

$allSubject = (new \yii\db\Query())
            ->select(['title','id'])
            ->from('subject')
            ->indexby('id')
            ->column();

$allSemester = (new \yii\db\Query())
            ->select(['title','id'])
            ->from('semester')
            ->indexby('id')
            ->column();

?>
<div class="teachsetting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownList($allClass,['prompt'=>'请选择班级']) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList($allTeacher,['prompt'=>'请选择老师']) ?>

    <?= $form->field($model, 'subject_id')->dropDownList($allSubject,['prompt'=>'请选择科目']) ?>

    <?= $form->field($model, 'semester')->dropDownList($allSemester) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
