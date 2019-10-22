<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourseLimit */

$this->title = 'Update Teach Course Limit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teach Course Limits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-course-limit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
