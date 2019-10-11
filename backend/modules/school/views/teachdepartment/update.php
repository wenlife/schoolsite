<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDepartment */

$this->title = 'Update Teach Department: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teach Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
