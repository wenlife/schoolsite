<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDepartment */

$this->title = 'Create Teach Department';
$this->params['breadcrumbs'][] = ['label' => 'Teach Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
