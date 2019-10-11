<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClassSetting */

$this->title = 'Update Class Setting: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Class Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="class-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
