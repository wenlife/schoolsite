<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '导入成绩';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'imageFile')->fileInput()->label('教师名单') ?>
    <button class="btn btn-primary">提交</button>
<?php ActiveForm::end() ?>
</div>